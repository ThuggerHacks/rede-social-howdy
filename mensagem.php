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
display:inline-flex;
margin-bottom:5px;
cursor:pointer;
}
.msg1{
    background:rgba(0,0,200,0.2)
}
#p2{
width:80%;
display:inline-flex;
margin-bottom:5px;
float:right;
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
#emj::-webkit-scrollbar{
width:8px;
background:whitesmoke;
}
#emj::-webkit-scrollbar-thumb{
width:8px;
background:blue;
}
.card-body::-webkit-scrollbar{
    width:10px;
    background:#00000000;

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

if(!isset($_REQUEST['x']) ){
    include 'includes/incluir.php';

        echo "<style>
        body{
        background: #007bff;
        }
        </style>";
        echo "<div  style='margin:10% auto;background:white;padding:10px;text-align:center;width:90%'>Nao tem permissao para ver esta pagina<br><a href='index.php' class='btn btn-primary'>LOGIN</a></div>";
        
       exit;
}


include 'includes/nav.php';
include 'includes/section.php';


//===================update all messages as read===================
$friend="";
$upd=new Manager();
$upd->setCelular($_SESSION['Numero']);
$bi=0;

foreach($upd->fetchUser() as $linha){
    $bi=$linha['id_user'];
}




$mot=new Manager();
$mot->setCelular($bi);

$mot->setNumero(base64_decode($_REQUEST['x']));

$mot->readState();


//=============end================================



echo "<div id='aside'>";

echo "<div  id='pcOnly'>";
echo "<div class='card'>";
echo "<div class='card-header'>";
echo "<div >";

$m=new Manager();
$m->setId(base64_decode($_REQUEST['x']));

foreach($m->fetchUserViaId() as $linha){
$friend=$linha['Nome'];
//==================================check the last time online==============

$time=localtime($linha['Estado'],true);
$tempo="";
$week=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
$mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];

if($linha['Estado']>=time() ){
$tempo="Online";
}else if($linha['Estado']<time() && $linha['Estado']>time()-60*60*24){
    $tempo="Online Hoje as ".$time['tm_hour'].":".$time['tm_min'];
}else if($linha['Estado']<=time()-60*60*24 && $linha['Estado']>time()-60*60*24*2){
    $tempo="Online Ontem as ".$time['tm_hour'].":".$time['tm_min'];
}else if($linha['Estado']<=time()-60*60*24*2 && $linha['Estado']>time()-60*60*24*7){
    $tempo="Online ".$week[$time['tm_wday']]." as ".$time['tm_hour'].":".$time['tm_min'];
}else if($linha['Estado']<=time()-60*60*24*7 && $linha['Estado']>time()-60*60*24*14){
     $tempo="Online ha 1 sem";
}else if($linha['Estado']<=time()-60*60*24*14 && $linha['Estado']>time()-60*60*24*28){
    $tempo="Online ha 2 sem";
}else if($linha['Estado']<=time()-60*60*24*28 && $linha['Estado']>time()-60*60*56){
    $tempo="Online ha 1 mes";
}else if($linha['Estado']<=time()-60*60*24*56 && $linha['Estado']>time()-60*60*24*365){
    $tempo="Online ha 2 meses";
}else if($linha['Estado']<=time()-60*60*24*365 && $linha['Estado']>time()-60*60*24*366){
    $tempo="Online ha 1 ano";
}else {
    $tempo="Online ".$time['tm_mday']." ".$mes[$time['tm_mon']]." ".date('Y',$linha['Estado'])." as ".$time['tm_hour'].":".$time['tm_min'];
}




//================end==========================




    if($linha['Numero']!=$_SESSION['Numero']){
    if($linha['Avatar']=='' && $linha['Sexo']=='Masculino'){
        echo '<strong style="width:35%"><a href="msg.php" style="text-decoration:none"><span class="btn btn-primary"><</span></a> <span data-toggle="modal" data-target="#block"><img src="files/male.png" width=40 height=40> '.substr($linha['Nome'],0,15).'</span></strong>';
    }else if($linha['Avatar']=='' && $linha['Sexo']=='Femenino'){
        echo '<strong style="width:35%"><a href="msg.php" style="text-decoration:none"><span class="btn btn-primary"><</span></a> <span data-toggle="modal" data-target="#block"><img src="files/female.png" width=40 height=40> '.substr($linha['Nome'],0,15).'</span></strong>';
    }else{
        echo '<strong style="width:35%"><a href="msg.php" style="text-decoration:none"><span class="btn btn-primary"><</span></a> <span data-toggle="modal" data-target="#block"><img src="img/avatar/'.$linha['Avatar'].'" width=40 height=40> '.substr($linha['Nome'],0,15).'</span></strong>';
    }
}
}



echo "  <img src='svgs/solid/smile.svg' width=30 height=30 class='close ml-2' data-target='#emoji' data-toggle='modal'> ";
echo " <img src='svgs/solid/camera.svg' width=30 height=30 class='close' data-toggle='modal' data-target='#foto'>";



echo '<br><small id="escrever"><center>'.$tempo.'</center></small>';
echo "</div>";
echo "</div>";
echo "<div class='card-body' style='height:85%;overflow-y:auto;overflow-x:hidden;'>";

$m11=new Manager();

$m11->setCelular(base64_decode($_REQUEST['x']));

$m12=new Manager();
$m12->setCelular($_SESSION['Numero']);
$id=0;

foreach($m12->fetchUser() as $l){
    $id=$l['id_user'];
}

$m11->setId($id);
$msg=0;
foreach($m11->fetchMessage() as $linha){

$msg=$linha['id'];


    if($linha['Numero']==$id){


if($linha['Ficheiro']!=''){

    $fich="";
    if($linha['Ficheiro']=='liked'){
        $fich="<img src='files/liked.png' width=70 height=70>";
    }else{
        $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
    }

    echo "<div id='p1' ><div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".base64_decode($_REQUEST['x']).")'>".$fich."</div></div>";

}else{
    
    $string="";
if($linha['Demo_Type']==1){
$string=$linha['Demo_Msg'];
}else{


    if(file_exists("img/status/".$linha['Demo_Msg'])){
        if(substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".mp4" || substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".m4a"){
            $string='<img src="svgs/solid/video.svg" width=40 height=40>';
        }else{
            $string='<img src="img/status/'.$linha['Demo_Msg'].'" width=40 height=40>';
        }
     
    }else{
        $string='<img src="files/deletar.png" width=40 height=40>';
    }

}



    echo "<div id='p1' >";
 

    echo "<div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".base64_decode($_REQUEST['x']).")'>";
         //==================fetching demo msg================

         if($linha['Demo_Msg']!=''){
            echo "<div  class='text-dark' style='border-radius:13px;padding:5px;background:rgb(240,240,240);margin-right:5px' >".$string."<br><small class='text-dark'><strong>".$friend." >> </strong><span class='text-primary'>Status</span></strong></small></div><br> ";
            }
        //=============end===============================

    echo " ".$linha['Mensagem']."</div></div>";
}

      

    }else{

        if($linha['Ficheiro']!=''){
            $fich="";
            if($linha['Ficheiro']=='liked'){
                $fich="<img src='files/liked.png' width=70 height=70>";
            }else{
                $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
            }
    

        echo "<div  id='p2'><div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].")'>".$fich."</div></div>";
    }else{

        $string="";
        if($linha['Demo_Type']==1){
        $string=$linha['Demo_Msg'];
        }else{
            if(file_exists("img/status/".$linha['Demo_Msg'])){
                if(substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".mp4" || substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".m4a"){
                    $string='<img src="svgs/solid/video.svg" width=40 height=40>';
                }else{
                    $string='<img src="img/status/'.$linha['Demo_Msg'].'" width=40 height=40>';
                }
             
            }else{
                $string='<img src="files/deletar.png" width=40 height=40>';
            }
        }
        
        
        echo "<div  id='p2'>";
        
        echo "<div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].")'>";
        
          //==================fetching demo msg================

      if($linha['Demo_Msg']!=''){
        echo "<div class='bg-primary ' style='border-radius:13px;padding:5px;margin-right:5px' >".$string."<br><small class='text-light'><b>Meus</b> >> <span class='text-light'>Status</span></small></div><br> ";
        }
    //=============end===============================
        echo $linha['Mensagem']."</div></div>";

    }
    }

   
}

echo "<input type='hidden' data-id='".$msg."' id='pvt1' data-re='".base64_decode($_REQUEST['x'])."'>";

echo "</div>";

if($m11->fetchMessage()->rowCount()>=20){
echo "<small><center><div class='btn btn-outline-primary' id='pvt' ><small>Mais</small></div></center></small>";
}


$block=new Manager();
$block->setNumero(base64_decode($_REQUEST['x']));
$id=0;
$m=new Manager();
$m->setCelular($_SESSION['Numero']);

foreach($m->fetchUser() as $linha){
    $id=$linha['id_user'];
}

$block->setCelular($id);

if($block->fetchBlock()->rowCount()==0){

echo "<div class='card-footer bg-primary' >";
echo "<table>";
echo "<input type='hidden' value='".base64_decode($_REQUEST['x'])."' id='hidden'>";
echo "<tr> <td style='width:95%'><textarea class='form-control' placeholder='Mensagem' id='men' maxLength=15000></textarea></td>";
echo "<td style='width:5%'> <button class='btn btn-outline-light my-2 mb-0 ml-2' onclick='sendMsg()'><img src='files/liked.png' width=30 height=30 id='imagem1'></button></td></tr>";
echo "</table>";
echo "</div>";
}
echo "</div>";
echo "</div>";
echo "</div>";

echo "<input type='hidden'  id='pvt2' data-re1='".$_REQUEST['x']."'>";

echo "<div id='info1'></div>";

//==============blobk  ===========================

if(isset($_REQUEST['y'])){

    $block=new Manager();
    $block->setNumero(base64_decode($_REQUEST['x']));
    $id=0;
    $m=new Manager();
    $m->setCelular($_SESSION['Numero']);

    foreach($m->fetchUser() as $linha){
        $id=$linha['id_user'];
    }

    $block->setCelular($id);
    $block->insertBloqueio();
    header('location:mensagem.php?x='.$_REQUEST['x']);

}



//================================
//===========desbloqueiar==================
if(isset($_REQUEST['z'])){

$unb=new Manager();
$unb->setId(base64_decode($_REQUEST['z']));
$unb->deleteBlock();
header('location:mensagem.php?x='.$_REQUEST['x']);

}



//=============================


//==============send foto========================

if(isset($_REQUEST['btnPro'])){

$file=$_FILES['file'];

if($file['name']!='' && ($file['type']=='image/jpg' || $file['type']=='image/jpeg' || $file['type']=='image/png') && $file['size']<=2097152){

$foto=new Manager();
$foto->setCelular($_SESSION['Numero']);
$bi1=0;

foreach($foto->fetchUser() as $linha){
    $bi1=$linha['id_user'];
}

$foto1=new Manager();
$foto1->setCelular($bi1);
$foto->setId($bi1);
$foto1->setId($bi1);
$foto1->setNumero(base64_decode($_REQUEST['x']));

if(file_exists('img/sent/'.$file['name'])){
$rand=rand(0,999);
    $foto1->setProfile($rand.".".$file['name']);

move_uploaded_file($file['tmp_name'],'img/sent/'.$rand.".".$file['name']);
}else{
    $foto1->setProfile($file['name']);

move_uploaded_file($file['tmp_name'],'img/sent/'.$file['name']);

}
$foto1->sendLikeIcon();
header('location:mensagem.php?x='.$_REQUEST['x']);

    

}else{

    echo "<script>
    
    alert('Ficheiro Invalido')
    </script>";

}

}

//==============end========================

ob_end_flush();
?>


<script>
var anm;

$('#men').keyup(function(){

if($(this).val().trim()!=''){
    $('#imagem1').attr('src','files/sent.png')
}else{
    $('#imagem1').attr('src','files/liked.png')
    
}


})

function sendMsg(){

var re=$('#hidden').val()

var msg=$('#men').val()


if(msg.trim()!=''){

//=================================load before come from db=================

    $('#p1').html("<div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' >"+msg+" <img src='files/load3.gif' width=20 height=20><br></div>")

$.ajax({
    url:'sendMsg.php',
    type:'post',
    data:{msg:msg,recipie:re},
    success:function(data){
        $('.card-body').html(data)
        $('#men').val("")
        $('#imagem1').attr('src','files/liked.png')
     
    }
})

}else{
//=================================load before come from db=================

    $('#p1').html("<div id='p1' ><div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;'><img src='files/liked.png' width=70 height=70> <img src='files/load3.gif' width=20 height=20></div></div>")

    var re=$('#hidden').val()
    $.ajax({
    url:'sendMsg.php',
    type:'post',
    data:{like:'',re:re},
    success:function(data){
        $('.card-body').html(data)
        $('#men').val("")
       
     
    }
})




}

}


function info(p,y){
   var screenX=this.event.screenX
   var screenY=this.event.screenY
$.ajax({
    url:'sendMsg.php',
    type:'post',
    data:{p:p,y:y,screenX:screenX,screenY:screenY},
    success:function(data){
        $('#info1').html(data)
       
    }
})
}

$('body').click(function(){
  $('#inf').hide(200)
  $('#inf1').hide(200)
})


function info1(p){
    var screenX=this.event.screenX
   var screenY=this.event.screenY
$.ajax({

   
    url:'sendMsg.php',
    type:'post',
    data:{p1:p,screenX:screenX,screenY:screenY},
    success:function(data){
        $('#info1').html(data)

    }
})
}

$('body').click(function(){
  $('#inf1').hide(200)
  $('#inf').hide(200)
})


$('.card-body').scroll(function(){
    $('#inf1').hide(200)
  $('#inf').hide(200) 
})

function msgDel(p,y){
    $.ajax({
        
  url:'sendMsg.php',
  type:'post',
  data:{del:p,recipie:y},
  success:function(data){
$('.card-body').html(data)
  }

    })
}

//==============loadPvt===========================

$(document).on('click','#pvt',function(){
    clearInterval(anm)
    var idmsg=$('#pvt1').data('id');
    var re=$('#pvt1').data('re');
    $.ajax({
        url:'load.php',
        type:'post',
        data:{idmsg:idmsg,re:re},
        success:function(data){
            $('#pvt1').remove()
            $('.card-body').append(data)
        }
    })
})


  


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


<!---block=n modal---------->

<div class='modal fade' role='dialog' id='block'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<?php

//================userName==========================
$u=new Manager();
$u->setId(base64_decode($_REQUEST['x']));
foreach($u->fetchUserViaId() as $linha){
    echo '<div style="font-weight:bold;color:white">'.$linha['Nome'].'</div>';
}
//==================================end============================
?>
<button class='close' data-dismiss='modal'>&times;</button>
</div>
<!--videoChat bar--->



<!--end---->

<div class='modal-footer bg-primary'>

<?php
echo "<a style='text-decoration:none;color:black;' href='account.php?id=".$_REQUEST['x']."'><button class='btn btn-light'>Perfil</button></a>";

$block=new Manager();
$block->setNumero(base64_decode($_REQUEST['x']));
$id=0;
$m=new Manager();
$m->setCelular($_SESSION['Numero']);

foreach($m->fetchUser() as $linha){
    $id=$linha['id_user'];
}

$block->setCelular($id);

foreach($block->fetchBlock() as $linha){

    if($linha['id_bloqueiador']==$id && $block->fetchBlock()->rowCount()>0){
?>
<center><a class='btn btn-danger' href='mensagem.php?x=<?php echo $_REQUEST['x']?>&z=<?php echo base64_encode($linha['id']); ?>'>Desbloqueiar</a></center>

<style>
.blc{display:none}
</style>

<?php
}else if($linha['id_bloqueiador']!=$id && $block->fetchBlock()->rowCount()>0){
?>

<center><a class='btn btn-danger' href='mensagem.php?x=<?php echo $_REQUEST['x']?>&y=y'>Bloqueiar</a></center>
<style>
.blc{display:none}
</style>

<?php
}
?>


<?php
}

?>

<center><a  class='btn btn-danger blc' href='mensagem.php?x=<?php echo $_REQUEST['x']?>&y=y'>Bloqueiar</a></center>
</div>

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

function emoji(x){
 document.getElementById('men').value+=x
    
}

anm=setInterval(msgUpdate,2000)

function msgUpdate(){
    $.ajax({
        url:'msg1.php',
        type:'post',
        data:{x:$('#pvt2').data('re1')},
        success:function(data){
            $('.card-body').html(data)
        }
    })
}

//=========================ESCREVENDO=============

$('#men').keydown(function(){

 $.ajax({
    url:'msg1.php',
        type:'post',
        data:{x1:$('#pvt2').data('re1')},
        success:function(data){
           
        }
 })
})


$('#men').keyup(function(){

 $.ajax({
    url:'msg1.php',
        type:'post',
        data:{x2:$('#pvt2').data('re1')},
        success:function(data){
        
        }
 })
})

setInterval(() => {
    
$.ajax({
    url:'msg1.php',
    type:'post',
    data:{x3:$('#pvt2').data('re1')},
    success:function(data){
        $('#escrever').html(data)
    }

})



},1000);


//=========end escrevendo=============================



</script>


