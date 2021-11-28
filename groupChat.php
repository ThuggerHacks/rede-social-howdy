<style>

#aside{
    height:100%;
    width:69%;
    float:right;
    position:relative;
    top:0%;
    
}
#p1{
width:80%;

margin-bottom:5px;
cursor:pointer;
}
.msg1{
    background:rgba(0,0,200,0.2)
}
#p2{
width:80%;

margin-bottom:5px;

cursor:pointer;


}
#aside::-webkit-scrollbar{
    width:10px;
    background:white
}
#pcOnly{
    margin:10px auto;
}
#aside::-webkit-scrollbar-thumb{
background:gray;
border-radius:15px;

}
span.btn{
    display:none
}
.card{
    height:100%
}

.card-body::-webkit-scrollbar{
    width:10px;
    background:#00000000;

}
#emj::-webkit-scrollbar{
width:8px;
background:whitesmoke;
}
#emj::-webkit-scrollbar-thumb{
width:8px;
background:blue;
}
.card-body::-webkit-scrollbar-thumb{
background:#222;
border-radius:10px;
width:8px

}
@media screen and (max-width:991px){
    #aside{
        width:100%
    }
    #pcOnly{
  width:100%;
  height:100%;
  padding:0px;
  margin:0px
    }
    #pcmenu,#mmenu,#btnm{
        display:none;
    }
   
.card{
    height:100%;
    width:100%;
}
span.btn{
    display:inline-block;
}
#p1,#p2{
    width:95%
}
}

@media screen and (min-width:992px) and (max-width:1024px){
    #aside{
       width:64%;
    }

}
</style>
<?php session_start();
ob_start();

include 'classes/Manager.class.php';
include 'includes/incluir.php';

if(!isset($_REQUEST['id'])){
    echo "<style>
    body{
    background: #007bff;
 
    }
    #aside,#section,#pcmenu,#mmenu{display:none}
    </style>";
    echo "<div  style='margin:10% auto;background:white;padding:10px;text-align:center;width:90%'>Erro de pagina<br><a href='group.php' class='btn btn-primary'>Voltar</a></div>";
    exit;
}

//===============checking if the user is a member=============
$check=new Manager();
$check->setId(base64_decode($_REQUEST['id']));
$check->setNumero($_SESSION['Numero']);

$adm=0;

if($check->checkMembro()->rowCount()==0 && !isset($_REQUEST['mm'])){
echo "<style>
body{
    background-image:url(files/error.png);
    background-size:cover;
    background-repeat:no-repeat;
}

</style>";

echo "<div class='container'>
<div style='padding:10px;background:#fff;border:1px solid rgb(220,220,220);margin-top:10%'>
Vo&ccedil;e nao faz parte deste grupo<br>
<a href='group.php' style='text-decoration:none;color:#fff'><button class='btn btn-primary'>Voltar</button></a>
</div>
</div>";

    exit;
}
//===========================end===============

include 'includes/nav.php';
include 'includes/section.php';




echo "<div id='aside'>";

echo "<div  id='pcOnly'>";
echo "<div class='card'>";
echo "<div class='card-header'>";
echo "<div display:flex;flex-wrap:wrap>";

//=============nome do grupo=================

$nome=new Manager();
$nome->setId(base64_decode($_REQUEST['id']));

foreach($nome->fetchGroup() as $linha){
    echo "<a href='group.php' style='color:white;text-decoration:none'><span class='btn btn-primary' style='font-size:15px'><</span></a> <img src='svgs/solid/users.svg' width=30 height=30><strong onclick='groupInfo()'> ".substr($linha['Nome'],0,15)."</strong>";
}


echo '</center>';



echo "  <img src='svgs/solid/smile.svg' width=30 height=30 class='close ml-2' data-target='#emoji' data-toggle='modal'> ";

echo "<img src='svgs/solid/camera.svg' width=30 height=30 class='close' data-toggle='modal' data-target='#foto'>";
echo '<br><center>';


echo "</div>";
echo "</div>";
echo "<div class='card-body' style='height:85%;overflow-y:auto;overflow-x:hidden;'>";

//===================mensagens=============================

$m11=new Manager();


$m12=new Manager();
$m11->setId(base64_decode($_REQUEST['id']));



$msg=0;
foreach($m11->fetchGroupMsg() as $linha){

$msg=$linha['id'];


    if($linha['Numero']==$_SESSION['Numero']){


if($linha['Ficheiro']!=''){

    $fich="";
    if($linha['Ficheiro']=='liked'){
        $fich="<img src='files/liked.png' width=70 height=70>";
    }else{
        $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
    }
    echo "<div id='p1' >";
    
    //===============getting name and profile of the sender============

    $m12->setCelular($linha['Numero']);
    
    foreach($m12->fetchUser() as $lin){

        if($lin['Avatar']!=''){
            echo "<strong ><div class='d-inline'><img src='img/avatar/".$lin['Avatar']."' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }else if($lin['Avatar']=='' and $lin['Sexo']=='Masculino'){
            echo "<strong ><div class='d-inline'><img src='files/male.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }else{

            echo "<strong ><div class='d-inline'><img src='files/female.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }
       
    }
//==========================end===========================================

//==========================fetch message foto============================
echo "<div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".base64_decode($_REQUEST['id']).")'>";

echo "<br>";
//=============demo========================================
if($linha['Demo']!=''){
    echo "<div class='bg-info' style='padding:4px;margin-right:5px;border-radius:10px;font-weight:bolder;'>".$linha['Demo']."<br>".$linha['Demo_Pic']."</div>";
}

echo $fich."</div></div>";

}else{
    

    echo "<div id='p1' >";
    
        //===============getting name and profile of the sender============
    $m12->setCelular($linha['Numero']);
    
    foreach($m12->fetchUser() as $lin){

        if($lin['Avatar']!=''){
            echo "<strong ><div class='d-inline'><img src='img/avatar/".$lin['Avatar']."' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }else if($lin['Avatar']=='' and $lin['Sexo']=='Masculino'){
            echo "<strong ><div class='d-inline'><img src='files/male.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }else{

            echo "<strong ><div class='d-inline'><img src='files/female.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }
       
    }
    //==============================end=============================

    //============================fetchMessage=============================
    
    echo "<div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".base64_decode($_REQUEST['id']).")'>";
    
    //=================demo=================================
    if($linha['Demo']!=''){
        echo "<div class='bg-info ' style='padding:4px;margin-right:5px;border-radius:10px;font-weight:bolder;'>".$linha['Demo']."<br>".$linha['Demo_Pic']."</div>";
    }
    
    
    echo "<div>".$linha['Mensagem']."</div></div></div><br>";
}

      

    }else{

        if($linha['Ficheiro']!=''){
            $fich="";
            if($linha['Ficheiro']=='liked'){
                $fich="<img src='files/liked.png' width=70 height=70>";
            }else{
                $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
            }

        echo "<div  id='p2'>";
            //===============getting name and profile of the sender============
        $m12->setCelular($linha['Numero']);
    
        foreach($m12->fetchUser() as $lin){
    
            if($lin['Avatar']!=''){
                echo "<strong ><div class='d-inline'><img src='img/avatar/".$lin['Avatar']."' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }else if($lin['Avatar']=='' and $lin['Sexo']=='Masculino'){
                echo "<strong ><div class='d-inline'><img src='files/male.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }else{
    
                echo "<strong ><div class='d-inline'><img src='files/female.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }
           
        }
//===================================end=================================

//===================================fetch  foto msg================

        echo "<div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].",".base64_decode($_REQUEST['id']).")'>";
        
        //=========demo================
        if($linha['Demo']!=''){
            echo "<div class='bg-info' style='padding:4px;margin-right:5px;border-radius:10px;font-weight:bolder'>".$linha['Demo']."<br>".$linha['Demo_Pic']."</div>";
        }
        
        
        echo $fich."</div></div>";
    }else{

        echo "<div  id='p2'>";
            //===============getting name and profile of the sender============
        $m12->setCelular($linha['Numero']);
    
        foreach($m12->fetchUser() as $lin){
    
            if($lin['Avatar']!=''){
                echo "<strong ><div class='d-inline'><img src='img/avatar/".$lin['Avatar']."' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }else if($lin['Avatar']=='' and $lin['Sexo']=='Masculino'){
                echo "<strong ><div class='d-inline'><img src='files/male.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }else{
    
                echo "<strong ><div class='d-inline'><img src='files/female.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }
           
        }
        
        //==================================end============================

        //====================fetch my msg============================
        echo "<div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].",".base64_decode($_REQUEST['id']).")'>";
        
        //============demo==============
        if($linha['Demo']!=''){
            echo "<div class='bg-info' style='padding:4px;margin-right:5px;border-radius:10px;font-weight:bolder'>".$linha['Demo']."<br>".$linha['Demo_Pic']."</div>";
        }
        
        echo $linha['Mensagem']."</div></div>";

    }
    }

   
}
 

echo "<input type='hidden' data-id='".$msg."' data-group='".base64_decode($_REQUEST['id'])."' id='moreG1'>";

//=============end===============================================
echo "</div>";

if($m11->fetchGroupMsg()->rowCount()>=20){
echo "<center ><small class='btn btn-outline-primary' style='padding:2px' id='moreG'>Mais</small></center>";
}

echo "<div class='card-footer bg-primary' >";

echo "<table>";

echo "<tr><td style='width:95%'>

<div id='demo' class='text-light bg-info' style='border:none;border-top-left-radius:10px;border-top-right-radius:10px;padding:5px;display:none;word-wrap:break-word'></div>

<textarea class='form-control' placeholder='Mensagem' id='men' maxLength=15000></textarea></td>";
echo "<td style='width:5%'> <button class='btn btn-outline-light my-2 mb-0 ml-2' onclick='sendMsg()' data-id='".base64_decode($_REQUEST['id'])."' id='send'><img src='files/liked.png' width=30 height=30 id='imagem1'></button></td></tr>";
echo "</table>";
echo "</div>";

echo "</div>";
echo "</div>";
echo "</div>";


echo "<div id='info1'></div>";
//==============send foto========================

if(isset($_REQUEST['btnPro'])){

    $file=$_FILES['file'];
    
    if($file['name']!='' && ($file['type']=='image/jpg' || $file['type']=='image/jpeg' || $file['type']=='image/png') && $file['size']<=2097152){
    
    $foto=new Manager();
    $foto->setCelular($_SESSION['Numero']);
    

    $foto->setId(base64_decode($_REQUEST['id']));

    
    if(file_exists('img/sent/'.$file['name'])){
    $rand=rand(0,999);
        $foto->setProfile($rand.".".$file['name']);
    
    move_uploaded_file($file['tmp_name'],'img/sent/'.$rand.".".$file['name']);
    }else{
        $foto->setProfile($file['name']);
    
    move_uploaded_file($file['tmp_name'],'img/sent/'.$file['name']);
    
    }
    $foto->sendGroupFoto();

    if(isset($_REQUEST['mm'])){
    header('location:groupChat.php?id='.$_REQUEST['id'].'&mm='.md5('ss'));
    }else{
        header('location:groupChat.php?id='.$_REQUEST['id']);
    }
        
    
    }else{
    
        echo "<script>
        
        alert('Ficheiro Invalido')
        </script>";
    
    }
    
    }
    
    //==============end========================
    


    //=================group info===================================

echo "<div id='vi2' style='display:none'>";

echo "<div id='st'>";

echo "<button class='close' id='closar13' style='outline:none'>&times;</button><br><hr>";

    echo "<style>
    #vi2{";

     
            echo "background:#343a40;
            overflow:auto;
            height:100%;";
            
    
       
        
        echo "width:100%;
        height:100%;
        position:fixed;
        top:0%;
        left:0%;
        word-wrap:break-word;
    }

    #vi2::-webkit-scrollbar{
        width:10px;
        background:white
    }
    
    #vi2::-webkit-scrollbar-thumb{
    background:gray;
    border-radius:15px;
    
    }

    @media screen and (max-width:991px){

        #vi2{
           top:0%;
           left:0%;
           width:100%;
           height:100%
        }

      
    }
    </style>";

$user=new Manager();
$id="";
$temp="";

$user->setId(base64_decode($_REQUEST['id']));

echo "<div class='container table-responsive'><table class='table table-striped table-hover text-light'>";
echo "<tr>
<th>Nome do grupo</th>
<th>Data de cria&ccedil;ao</th>
<th>Administrador do grupo</th>
<th>Descricao</th>
</tr>";
foreach($user->fetchGroup() as $linha){
 $user->setCelular($linha['Numero']);
$adm=$linha['Numero'];
 foreach($user->fetchUser() as $li){
     $id=$li['Nome'];
     $temp=$li['Estado'];
 }


    $time=localtime($linha['Data_Criacao'],true);
    $mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
echo "<tr>


<td>".$linha['Nome']."</td>
<td>".$mes[$time['tm_mon']]." ".$time['tm_mday']." ".date("Y",$linha['Data_Criacao'])."</td>
<td>";


if($temp>time()){
    echo $id." <div style='background:#0f0;width:10px;height:10px;border-radius:50%;display:inline-flex'></div>";
}else{
    echo $id;
}


echo "</td>
<td style='word-break:break-word'>".$linha['Descricao']."</td>
</tr>";


}

echo "</table></div>";

echo "</div>";

echo "<br><center><button class='btn btn-outline-light mr-2 mb-2' onclick='membros()'>Membros</button><br>";

//=============sair adm=============================
if(!isset($_REQUEST['mm'])){
    echo "<a href='groupChat.php?sair=true&id=".$_REQUEST['id']."' style='text-decoration:none;'><button class='btn btn-outline-danger'>Sair do grupo</button></a><br>";
}


if($_SESSION['Numero']==$adm){
    echo "<a href='groupChat.php?apagar=true&id=".$_REQUEST['id']."&mm=t' style='text-decoration:none;'><button class='btn btn-outline-danger ml-2 mr-2 mb-2 my-2'>Apagar Grupo</button></a><br><button class='btn btn-outline-light ml-2 mr-2 my-2 mb-2' data-target='#newName' data-toggle='modal'>Editar Nome</button>";
}

echo "</center>
</div>";

echo "</div>";


//================end===========================




//=================gmembros modal===================================

echo "<div id='vi3' style='display:none'>";

echo "<div id='st'>";

echo "<button class='close' id='closar14' style='outline:none'>&times;</button><br><hr>";

    echo "<style>
    #vi3{";

     
            echo "background:#343a40;
            overflow:auto;
            height:100%;";
            
    
       
        
        echo "width:100%;
        height:100%;
        position:fixed;
        top:0%;
        left:0%;
        word-wrap:break-word;
    }

    #vi3::-webkit-scrollbar{
        width:10px;
        background:white
    }
    
    #vi3::-webkit-scrollbar-thumb{
    background:gray;
    border-radius:15px;
    
    }

    @media screen and (max-width:991px){

        #vi3{
           top:0%;
           left:0%;
           width:100%;
           height:100%
        }

      
    }
    </style>";

$user=new Manager();
$user->setId(base64_decode($_REQUEST['id']));
echo "<div class='container' id='rem'>";

if($user->fetchAllMembros()->rowCount()==0){
    echo "<div  style='width:100%;padding:5px;background:#fff'><strong>Nao existem membros neste grupo</strong>";
  echo "</div>";
}

echo "<div style='width:100%;padding:5px;background:#007bff'>Membros ({$user->fetchAllMembros()->rowCount()})</div>";
foreach($user->fetchAllMembros() as $li){

    $user->setCelular($li['Numero']);
    
    foreach($user->fetchUser() as $linha){
      

        if($linha['Estado']>time()){
            echo "<div  style='width:100%;padding:5px;background:#fff'><strong>".$linha['Nome']." <div style='border-radius:50%;width:10px;height:10px;background:#0f0;display:inline-flex'></div></strong> ";   
        }else{
            echo "<div  style='width:100%;padding:5px;background:#fff'><strong>".$linha['Nome']."</strong>";
        }
        
        
          if($_SESSION['Numero']==$adm){
              echo "<span style='float:right;margin-right:2px' onclick='removerMembro(".$linha['id_user'].",".base64_decode($_REQUEST['id']).")' id='remover1".$linha['id_user']."'>Remover</span>";
          }

        echo "</div>";
       
    }

}

echo "</div></div>";

echo "</div>";


//================end===========================
//================sair do grupo======================
if(isset($_REQUEST['sair'])){
    $sair=new Manager();
    $sair->setCelular($_SESSION['Numero']);
    $sair->setId(base64_decode($_REQUEST['id']));
    $sair->sairGrupo();

    
    header('location:group.php');
}


//=====================================


//================apagar grupo======================
if(isset($_REQUEST['apagar'])){
    $sair=new Manager();
    $sair->setCelular($_SESSION['Numero']);
    $sair->setId(base64_decode($_REQUEST['id']));
    $sair->deleteGrupo();

    header('location:group.php');
}


//=====================================


//===============update groupName=================

if(isset($_REQUEST['btnName'])){
    $up=new Manager();
    $up->setId(base64_decode($_REQUEST['id']));
    $up->setNome(filter_var($_REQUEST['txtName']),FILTER_SANITIZE_SPECIAL_CHARS);
    $up->updateGroupName();

    header('location:groupChat.php?id='.$_REQUEST['id']."&mm=t");
}



ob_end_flush();
?>


<script>

</script>


<!---sendPic modal---------->

<div class='modal fade' role='dialog' id='foto'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>


<form method='post' enctype='multipart/form-data'>
<div class='modal-footer bg-primary'>
<div style='text-align:center;margin:auto'>
<input type='file' name='file' style='width:80px;height:100px;position:relative;left:50%;top:8%;opacity:0'>
<img src='svgs/solid/camera.svg' width=80 height=80 style=';cursor:pointer'></span>
</div>
<input type='submit' name='btnPro' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>

<!-------end---------------->


<!---nameUpdate modal---------->

<div class='modal fade' role='dialog' id='newName'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>


<form method='post' enctype='multipart/form-data'>
<input type='hidden' name='id' value='<?php echo $_REQUEST['id']?>'>
<div class='modal-footer bg-primary'>
<input type='text' name='txtName' class='form-control' placeholder='Novo Nome' maxLength=40>
<input type='submit' name='btnName' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>

<!-------end---------------->
<!------emoji modal-------------------------->

<div class='modal fade' role='dialog' id='emoji'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>
<div class='modal-body bg-primary'>
<div class='container' style='display:flex;flex-wrap:wrap;font-size:25px;height:150px;overflow:auto;cursor:pointer' id='emj'>

<span onclick='emoji("&#x1F600")' class='emoji'>&#x1F600;</span>
<span onclick='emoji("&#x1F601")' class='emoji'>&#x1F601;</span>
<span onclick='emoji("&#x1F604")' class='emoji'>&#x1F604;</span>
<span onclick='emoji("&#x1F606")' class='emoji'>&#x1F606;</span>
<span onclick='emoji("&#x1F605")' class='emoji'>&#x1F605;</span>

<span onclick='emoji("&#x1F602")' class='emoji'>&#x1F602;</span>
<span onclick='emoji("&#x1F642")' class='emoji'>&#x1F642;</span>
<span onclick='emoji("&#x1F609")' class='emoji'>&#x1F609;</span>
<span onclick='emoji("&#x1F60A")' class='emoji'>&#x1F60A;</span>
<span onclick='emoji("&#x1F607")' class='emoji'>&#x1F607;</span>

<span onclick='emoji("&#x1F60D")' class='emoji'>&#x1F60D;</span>
<span onclick='emoji("&#x1F618")' class='emoji'>&#x1F618;</span>
<span onclick='emoji("&#x1F617")' class='emoji'>&#x1F617;</span>
<span onclick='emoji("&#x1F60B")' class='emoji'>&#x1F60B;</span>
<span onclick='emoji("&#x1F61B")' class='emoji'>&#x1F61B;</span>

<span onclick='emoji("&#x1F61C")' class='emoji'>&#x1F61C;</span>
<span onclick='emoji("&#x1F61D")' class='emoji'>&#x1F61D;</span>
<span onclick='emoji("&#x1F610")' class='emoji'>&#x1F610;</span>
<span onclick='emoji("&#x1F611")' class='emoji'>&#x1F611;</span>
<span onclick='emoji("&#x1F636")' class='emoji'>&#x1F636;</span>

<span onclick='emoji("&#x1F60F")' class='emoji'>&#x1F60F;</span>
<span onclick='emoji("&#x1F612")' class='emoji'>&#x1F612;</span>
<span onclick='emoji("&#x1F62C")' class='emoji'>&#x1F62C;</span>
<span onclick='emoji("&#x1F62E")' class='emoji'>&#x1F62E;</span>
<span onclick='emoji("&#x1F60C")' class='emoji'>&#x1F60C;</span>


<span onclick='emoji("&#x1F614")' class='emoji'>&#x1F614;</span>
<span onclick='emoji("&#x1F62A")' class='emoji'>&#x1F62A;</span>
<span onclick='emoji("&#x1F634")' class='emoji'>&#x1F634;</span>
<span onclick='emoji("&#x1F637")' class='emoji'>&#x1F637;</span>
<span onclick='emoji("&#x1F635")' class='emoji'>&#x1F635;</span>


<span onclick='emoji("&#x1F60E")' class='emoji'>&#x1F60E;</span>
<span onclick='emoji("&#x1F61F")' class='emoji'>&#x1F61F;</span>
<span onclick='emoji("&#x1F641")' class='emoji'>&#x1F641;</span>
<span onclick='emoji("&#x1F62E")' class='emoji'>&#x1F62E;</span>
<span onclick='emoji("&#x1F62F")' class='emoji'>&#x1F62F;</span>


<span onclick='emoji("&#x1F632")' class='emoji'>&#x1F632;</span>
<span onclick='emoji("&#x1F633")' class='emoji'>&#x1F633;</span>
<span onclick='emoji("&#x1F641")' class='emoji'>&#x1F641;</span>
<span onclick='emoji("&#x1F626")' class='emoji'>&#x1F626;</span>
<span onclick='emoji("&#x1F627")' class='emoji'>&#x1F627;</span>

<span onclick='emoji("&#x1F628")' class='emoji'>&#x1F628;</span>
<span onclick='emoji("&#x1F625")' class='emoji'>&#x1F625;</span>
<span onclick='emoji("&#x1F622")' class='emoji'>&#x1F622;</span>
<span onclick='emoji("&#x1F62D")' class='emoji'>&#x1F62D;</span>
<span onclick='emoji("&#x1F631")' class='emoji'>&#x1F631;</span>

<span onclick='emoji("&#x1F616")' class='emoji'>&#x1F616;</span>
<span onclick='emoji("&#x1F61F")' class='emoji'>&#x1F61F;</span>
<span onclick='emoji("&#x1F629")' class='emoji'>&#x1F629;</span>
<span onclick='emoji("&#x1F62B")' class='emoji'>&#x1F62B;</span>
<span onclick='emoji("&#x1F624")' class='emoji'>&#x1F624;</span>

<span onclick='emoji("&#x1F621")' class='emoji'>&#x1F621;</span>
<span onclick='emoji("&#x1F620")' class='emoji'>&#x1F620;</span>
<span onclick='emoji("&#x1F608")' class='emoji'>&#x1F608;</span>
<span onclick='emoji("&#x1F47F")' class='emoji'>&#x1F47F;</span>
<span onclick='emoji("&#x1F480")' class='emoji'>&#x1F480;</span>

<span onclick='emoji("&#x1F4A9")' class='emoji'>&#x1F4A9;</span>
<span onclick='emoji("&#x1F479")' class='emoji'>&#x1F479;</span>
<span onclick='emoji("&#x1F47A")' class='emoji'>&#x1F47A;</span>
<span onclick='emoji("&#x1F47B")' class='emoji'>&#x1F47B;</span>
<span onclick='emoji("&#x1F47D")' class='emoji'>&#x1F47D;</span>

<span onclick='emoji("&#x1F47E")' class='emoji'>&#x1F47E;</span>
<span onclick='emoji("&#x1F48B")' class='emoji'>&#x1F48B;</span>
<span onclick='emoji("&#x1F48C")' class='emoji'>&#x1F48C;</span>
<span onclick='emoji("&#x1F498")' class='emoji'>&#x1F498;</span>
<span onclick='emoji("&#x1F49D")' class='emoji'>&#x1F49D;</span>

<span onclick='emoji("&#x1F496")' class='emoji'>&#x1F496;</span>
<span onclick='emoji("&#x1F497")' class='emoji'>&#x1F497;</span>
<span onclick='emoji("&#x1F493")' class='emoji'>&#x1F493;</span>
<span onclick='emoji("&#x1F49E")' class='emoji'>&#x1F49E;</span>
<span onclick='emoji("&#x1F495")' class='emoji'>&#x1F495;</span>

<span onclick='emoji("&#x1F49F")' class='emoji'>&#x1F49F;</span>
<span onclick='emoji("&#x1F494")' class='emoji'>&#x1F494;</span>
<span onclick='emoji("&#x1F525")' class='emoji'>&#x1F525;</span>
<span onclick='emoji("&#x2764")' class='emoji'>&#x2764;</span>
<span onclick='emoji("&#x1F49B")' class='emoji'>&#x1F49B;</span>

<span onclick='emoji("&#x1F49A")' class='emoji'>&#x1F49A;</span>
<span onclick='emoji("&#x1F499")' class='emoji'>&#x1F499;</span>
<span onclick='emoji("&#x1F49C")' class='emoji'>&#x1F49C;</span>
<span onclick='emoji("&#x1F90E")' class='emoji'>&#x1F90E;</span>
<span onclick='emoji("&#x1F4AD")' class='emoji'>&#x1F4AD;</span>

<span onclick='emoji("&#x1F44B")' class='emoji'>&#x1F44B;</span>
<span onclick='emoji("&#x270B")' class='emoji'>&#x270B;</span>
<span onclick='emoji("&#x1F44C")' class='emoji'>&#x1F44C;</span>
<span onclick='emoji("&#x270C")' class='emoji'>&#x270C;</span>
<span onclick='emoji("&#x1F448")' class='emoji'>&#x1F448;</span>

<span onclick='emoji("&#x1F449")' class='emoji'>&#x1F449;</span>
<span onclick='emoji("&#x1F446")' class='emoji'>&#x1F446;</span>
<span onclick='emoji("&#x1F447")' class='emoji'>&#x1F447;</span>
<span onclick='emoji("&#x261D")' class='emoji'>&#x261D;</span>
<span onclick='emoji("&#x1F44D")' class='emoji'>&#x1F44D;</span>

<span onclick='emoji("&#x1F44E")' class='emoji'>&#x1F44E;</span>
<span onclick='emoji("&#x270A")' class='emoji'>&#x270A;</span>
<span onclick='emoji("&#x1F44A")' class='emoji'>&#x1F44A;</span>
<span onclick='emoji("&#x1F44F")' class='emoji'>&#x1F44F;</span>
<span onclick='emoji("&#x1F466")' class='emoji'>&#x1F466;</span>
<span onclick='emoji("&#x1F467")' class='emoji'>&#x1F467;</span>


<span onclick='emoji("&#x1F64C")' class='emoji'>&#x1F64C;</span>
<span onclick='emoji("&#x1F450")' class='emoji'>&#x1F450;</span>
<span onclick='emoji("&#x1F64F")' class='emoji'>&#x1F64F;</span>
<span onclick='emoji("&#x270D")' class='emoji'>&#x270D;</span>
<span onclick='emoji("&#x1F485")' class='emoji'>&#x1F485;</span>
<span onclick='emoji("&#x1F933")' class='emoji'>&#x1F933;</span>

<span onclick='emoji("&#x1F4AA")' class='emoji'>&#x1F4AA;</span>
<span onclick='emoji("&#x1F9BE")' class='emoji'>&#X1F9BE;</span>
<span onclick='emoji("&#x1F9B5")' class='emoji'>&#x1F9B5;</span>
<span onclick='emoji("&#x1F9B6")' class='emoji'>&#x1F9B6;</span>
<span onclick='emoji("&#x1F442")' class='emoji'>&#x1F442;</span>
<span onclick='emoji("&#x1F9BB")' class='emoji'>&#x1F9BB;</span>

<span onclick='emoji("&#x1F443")' class='emoji'>&#x1F443;</span>
<span onclick='emoji("&#x1F440")' class='emoji'>&#X1F440;</span>
<span onclick='emoji("&#x1F441")' class='emoji'>&#x1F441;</span>
<span onclick='emoji("&#x1F445")' class='emoji'>&#x1F445;</span>
<span onclick='emoji("&#x1F444")' class='emoji'>&#x1F444;</span>
<span onclick='emoji("&#x1F476")' class='emoji'>&#x1F476;</span>

<span onclick='emoji("&#x1F9D1")' class='emoji'>&#x1F9D1;</span>
<span onclick='emoji("&#x1F471")' class='emoji'>&#X1F471;</span>
<span onclick='emoji("&#x1F468")' class='emoji'>&#x1F468;</span>
<span onclick='emoji("&#x1F9D4")' class='emoji'>&#x1F9D4;</span>
<span onclick='emoji("&#x1F468")' class='emoji'>&#x1F468;</span>
<span onclick='emoji("&#x1F469")' class='emoji'>&#x1F469;</span>

<span onclick='emoji("&#x1F64D")' class='emoji'>&#x1F64D;</span>
<span onclick='emoji("&#x1F64E")' class='emoji'>&#X1F64E;</span>
<span onclick='emoji("&#x1F645")' class='emoji'>&#x1F645;</span>
<span onclick='emoji("&#x1F646")' class='emoji'>&#x1F646;</span>
<span onclick='emoji("&#x1F481")' class='emoji'>&#x1F481;</span>
<span onclick='emoji("&#x1F64B")' class='emoji'>&#x1F64B;</span>

<span onclick='emoji("&#x1F9CF")' class='emoji'>&#x1F9CF;</span>
<span onclick='emoji("&#x1F91E")' class='emoji'>&#X1F91E;</span>
<span onclick='emoji("&#x1F91F")' class='emoji'>&#x1F91F;</span>
<span onclick='emoji("&#x1F919")' class='emoji'>&#x1F919;</span>
<span onclick='emoji("&#x1F596")' class='emoji'>&#x1F596;</span>
<span onclick='emoji("&#x1F590")' class='emoji'>&#x1F590;</span>
<span onclick='emoji("&#x1F92C")' class='emoji'>&#x1F92C;</span>

<span onclick='emoji("&#x1F921")' class='emoji'>&#x1F921;</span>
<span onclick='emoji("&#x1F971")' class='emoji'>&#x1F971;</span>
<span onclick='emoji("&#x1F973")' class='emoji'>&#x1F973;</span>
<span onclick='emoji("&#x1F920")' class='emoji'>&#x1F920;</span>
<span onclick='emoji("&#x1F92F")' class='emoji'>&#x1F92F;</span>

<span onclick='emoji("&#x1F97A")' class='emoji'>&#x1F97A;</span>
<span onclick='emoji("&#x1F925")' class='emoji'>&#x1F925;</span>
<span onclick='emoji("&#x1F924")' class='emoji'>&#x1F924;</span>
<span onclick='emoji("&#x1F912")' class='emoji'>&#x1F912;</span>
<span onclick='emoji("&#x1F915")' class='emoji'>&#x1F915;</span>

<span onclick='emoji("&#x1F922")' class='emoji'>&#x1F922;</span>
<span onclick='emoji("&#x1F92E")' class='emoji'>&#x1F92E;</span>
<span onclick='emoji("&#x1F644")' class='emoji'>&#x1F644;</span>
<span onclick='emoji("&#x1F929")' class='emoji'>&#x1F929;</span>
<span onclick='emoji("&#x1F92A")' class='emoji'>&#x1F92A;</span>
<span onclick='emoji("&#x1F911")' class='emoji'>&#x1F911;</span>

<span onclick='emoji("&#x1F917")' class='emoji'>&#x1F917;</span>
<span onclick='emoji("&#x1F92B")' class='emoji'>&#x1F92B;</span>
<span onclick='emoji("&#x1F914")' class='emoji'>&#x1F914;</span>
<span onclick='emoji("&#x1F910")' class='emoji'>&#x1F910;</span>
<span onclick='emoji("&#x1F923")' class='emoji'>&#x1F923;</span>

<span onclick='emoji("&#x1F643")' class='emoji'>&#x1F643;</span>
<span onclick='emoji("&#x1F970")' class='emoji'>&#x1F970;</span>
<span onclick='emoji("&#x1F595")' class='emoji'>&#x1F595;</span>
<span onclick='emoji("&#x1F91B")' class='emoji'>&#x1F91B;</span>
<span onclick='emoji("&#x1F91C")' class='emoji'>&#x1F91C;</span>
<span onclick='emoji("&#x1F4A4")' class='emoji'>&#x1F4A4;</span>

</div>
</div>

</div>
</div>

</div>

<!-------end---------------->
<script>
function sendMsg(){

var demo,demo1;
    if($('#demo').html()!=''){
        demo=$('#demo strong').text()
        demo1=$('#demo #respSpan').html()
        
    }
   
var re=$('#hidden').val()
var msg=$('#men').val()
if(msg.trim()!=''){
$.ajax({
    url:'sendMsg.php',
    type:'post',
    data:{msg1:msg,gi:$('#send').data('id'),demo:demo,demo1:demo1},
    success:function(data){
        $('.card-body').html(data)
        $('#men').val("")
        $('#imagem1').attr('src','files/liked.png')
        $('#demo').html("")
        $('#demo').hide()
       
     
    }
})

}else{

    var demo,demo1;
    if($('#demo').html()!=''){
        demo=$('#demo strong').text()
        demo1=$('#demo #respSpan').html()
        
    }

    var re=$('#hidden').val()
    $.ajax({
    url:'sendMsg.php',
    type:'post',
    data:{like1:$('#send').data('id'),demo1:demo,demo2:demo1},
    success:function(data){
        $('.card-body').html(data)
        $('#men').val("")
        $('#demo').html("")
       $('#demo').hide()
     
    }
})




}

}


$('#men').keyup(function(){

if($(this).val().trim()!=''){
    $('#imagem1').attr('src','files/sent.png')
}else{
    $('#imagem1').attr('src','files/liked.png')
    
}


})

//=close views
$(document).on('click','#closar13',function(){
    $('#vi2').slideUp();
   
})

function groupInfo(){
    $('#vi2').slideToggle()
}

//=close views
$(document).on('click','#closar14',function(){
    $('#vi3').slideUp();
   
})

function membros(){
    $('#vi3').slideToggle()
}

//=============remove member==================
function removerMembro(p,y){
var c=confirm("Pretende mesmo remover este usuario?");

if(c){

$.ajax({
    url:'groupRequest.php',
    type:'post',
    data:{mr:p,gi1:y},
    success:function(data){
$('#remover1'+p).text(data)
    }
})


}


}

//=================end================

//=========================message info=====================

function info(p,y){

$.ajax({
    url:'groupRequest.php',
    type:'post',
    data:{info:p,id:y},
    success:function(data){
        $('#info1').html(data)
    }
})

}


$('body').click(function(){
    $('#inf1').hide(100)
})

$('.card-body').scroll(function(){
    $('#inf1').hide(100)
})

//===========================================================


function info1(p,y){
    $.ajax({
    url:'groupRequest.php',
    type:'post',
    data:{info1:p,id1:y},
    success:function(data){
        $('#info1').html(data)
    }
})


}

//===============delete chats==============

function msgDel(p,y){
    $.ajax({
        
  url:'groupRequest.php',
  type:'post',
  data:{del:p,delid:y},
  success:function(data){
$('.card-body').html(data)
  }

    })
}

//==================================

//======load group messages=========

$(document).on('click','#moreG',function(){
    var msg=$('#moreG1').data('id')
    var gid=$('#moreG1').data('group')

$.ajax({
    url:'groupRequest.php',
    type:'post',
    data:{msg4:msg,gid4:gid},
    success:function(data){
        $('#moreG1').remove()
        $('.card-body').append(data)
    }
})
 
})

function emoji(x){
 document.getElementById('men').value+=x
    
}

//=======================responder===========================

function answer(text,id){
    $.ajax({
        url:'groupRequest.php',
        type:'post',
        data:{text:text,id:id},
        success:function(data){
         $('#demo').html(data).show(200);
        }
    })
}

function fecharResposta(){
    $('#demo').hide(200)
    $('#demo').html("");
  
}
</script>