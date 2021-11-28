<style>


#aside{
    height:100%;
    width:69%;
    overflow:auto;
    float:right;
    position:relative;
    top:2%;
    padding:10px;
    
}
.container{
    text-align:justify;
}

.more{
    background:rgba(0,0,200,0.2)
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

include 'includes/incluir.php';
include 'classes/Manager.class.php';

if($_SESSION['Numero']=='848499142'){





include 'includes/nav.php';
include 'includes/section.php';




echo "<div id='aside' class='bg-light '>";

if(isset($_REQUEST['x'])){

    $msg=new Manager();
    $msg->setId(1234);
    
    echo "<div class='container'>";
    
if($msg->Analyticsmessage()->rowCount()==0){
    echo "<div class='card'><center>Nenhuma mensagem disponivel</center></div><br>";
}

    foreach($msg->Analyticsmessage() as $lin){
        $msg->setCelular($lin['Numero']);
    
        foreach($msg->fetchUser() as $linha){
            echo "<div class='card'><strong>".$linha['Nome']."</strong>".$lin['Mensagem']."<span ><a href='analytics.php?del=".$lin['id']."' style='color:red;float:right'>delete</a></span></div><br>";
        }
    
    
    }
    
    echo "</div>";
    
    
    
    
    
        exit;
    }



$users=new Manager();
$user->setCelular($_SESSION['Numero']);
$id=0;
foreach($user->fetchUser() as $lin){
    $id=$lin['id_user'];
}

$user->setId($id);

echo "<div class='container'>
<div class='card'><center>{$user->fetchAllUsers()->rowCount()} usuarios</center></div><br>

<div class='card'><center>{$user->fetchPost()->rowCount()} posts</center></div><br>

<div class='card'><center>{$user->fetchAllStatus()->rowCount()} status</center></div><br>

<div class='card'><center>{$user->fetchAllMembro()->rowCount()} grupos</center></div><br>

<div class='card'><center>{$user->fetchAllGrupos()->rowCount()} membros</center></div><br>

<div class='card'><center>{$user->fetchAllComments()->rowCount()} comentarios</center></div><br>

<div class='card'><center>{$user->fetchAllMessage()->rowCount()} mensagens</center></div><br>

<div class='card'><center>{$user->fetchAudio()->rowCount()} audios</center></div><br>

<div class='card'><center>{$user->fetchVideo()->rowCount()} videos</center></div><br>

<div class='card'><center>{$user->fetchDoc()->rowCount()} documentos</center></div><br>";

$user->setTexto('jogoDaVelha');
echo "<div class='card'><center>{$user->fetchAllPoints()->rowCount()} jogadores do jogo da forca</center></div><br>";

$user->setTexto('jogoDaForca');
echo "<div class='card'><center>{$user->fetchAllPoints()->rowCount()} jogadores do jogo da velha</center></div><br>";

$user->setTexto('jogoDaForca');
echo "<div class='card'><center>{$user->fetchAllLikes()->rowCount()} likes</center></div><br>";



echo "<a href='analytics.php?x=x' style='text-decoration:none;color:black'><div class='card bg-primary'><center>Mensagem</center></div></a><br>";

echo "</div>";




              echo "</div>";

//==========end===============================


}

if(isset($_REQUEST['del'])){
    $pvt=new Manager();
    $pvt->setId($_REQUEST['del']);
    $pvt->deletePvt();
    header("location:analytics.php?x=x");
}

ob_end_flush();
?>

