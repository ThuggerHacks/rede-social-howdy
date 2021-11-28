<style>


#aside{
    height:100%;
    width:69%;
    overflow:auto;
    float:right;
    position:relative;
    top:0%;
    
    
}

#aside::-webkit-scrollbar{
    width:10px;
    background:white
}

#aside::-webkit-scrollbar-thumb{
background:gray;
border-radius:15px;

}

@media screen and (max-width:991px){
    #aside{
        width:100%
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


include 'includes/nav.php';
include 'includes/section.php';

echo "<div id='aside'>";

echo "<div class='container'><div class='card my-3 bg-primary text-light' style='padding:5px' data-toggle='modal' data-target='#newGroup'><center>Novo grupo</center></div></div>";

$fetch=new Manager();
$fetch->setCelular($_SESSION['Numero']);

if($fetch->checkGroup()->rowCount()==0){
echo "<br><div class='container'><div class='card'><center>Vo&ccedil;e nao tem nenhum grupo</center></div></div>";
}else{
    echo "<br><div class='container'><div class='card'><center>Meus grupos</center></div></div>";
}

foreach($fetch->checkGroup() as $linha){

    echo "<a href='groupMenu.php?id=".base64_encode($linha['id'])."' style='text-decoration:none;color:black'><br><div class='container'><div class='card'><span class='btn btn-outline-primary'><img src='svgs/solid/users.svg' width=50 height=50> ".$linha['Nome']."</span><center></center></div></div></a>";

}



//===============other groups=====================

$fetch=new Manager();
$fetch->setNumero($_SESSION['Numero']);
$i=0;
if($fetch->fetchMembro()->rowCount()==0){
echo "<br><div class='container'><div class='card'><center>Vo&ccedil;e nao tem outros grupos</center></div></div>";
}else{

    echo "<br><div class='container'><div class='card'><center>Outros grupos</center></div></div>";

    echo "<div id='load11'>";
    foreach($fetch->fetchMembro() as $linh){

    $i=$linh['id'];


$fetch->setId($linh['id_grupo']);
foreach($fetch->fetchGroup() as $linha){

    echo "<a href='groupMenu.php?id1=".base64_encode($linha['id'])."' style='text-decoration:none;color:black'><br><div class='container'><div class='card'><span class='btn btn-outline-primary'><img src='svgs/solid/users.svg' width=50 height=50> ".$linha['Nome']."</span><center></center></div></div></a>";

}

    }
echo "<center><div class='btn btn-primary my-3' data-id=".$i." id='loadGrupo'>Mais grupos</div></center>";
}

echo "</div>";
echo "</div>";

if(isset($_REQUEST['btnGroup'])){

    $desc=$_REQUEST['desc'];
    $nome=$_REQUEST['grupo'];
    $grupo=new Manager();
    $grupo->setCelular($_SESSION['Numero']);

    if($grupo->checkGroup()->rowCount()>=5){
        echo "<script>alert('Voce ja atingiu limite de criacao de grupos')</script>";
    }else{

    if(strlen($nome)>2 && strlen($nome)<=30 && strlen($desc)>=10 && strlen($desc)<=70){
   


  
     $grupo->setTexto(filter_var($desc,FILTER_SANITIZE_SPECIAL_CHARS));
     $grupo->setNome(filter_var($nome,FILTER_SANITIZE_SPECIAL_CHARS));
     $grupo->insertGroup();

        header('location:group.php');


    }else{

        echo "<script>alert('Erro de dados')</script>";
    
    }
}

}


//=============================

ob_end_flush();
?>

<!---posts modal---------->

<div class='modal fade' role='dialog' id='newGroup'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>
<div class='modal-body bg-light'>

</div>
<div class='container bg-primary'>

<br><form method='post' enctype='multipart/form-data'>
<input type='text' class='form-control'    id='grupo' placeholder='Nome do grupo' maxLength=30  minLength=2 name='grupo' autofocus><br>
<textarea class='form-control' placeholder='Descicao' name='desc' maxLength=70 minLength=10></textarea><br>
<input type='submit' name='btnGroup' class='btn btn-light mb-4 ' value='enviar' ><br>

</form>
</div>
</div>
</div>

</div>

<!-------end---------------->
<script>

//=============load more grupo===================

$(document).on('click','#loadGrupo',function(){
    var load=$(this).data('id');

    $.ajax({
        url:'groupRequest.php',
        type:'post',
        data:{load:load},
        success:function(data){
            $('#loadGrupo').remove()
             $('#load11').append(data)
        }
    })
})

</script>