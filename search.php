<style>

#aside{
    height:100%;
    width:69%;
    overflow:auto;
    float:right;
    position:relative;
    top:2%;
    background:whitesmoke;
    padding:10px
    
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

include 'includes/incluir.php';
include 'classes/Manager.class.php';

include 'includes/nav.php';
include 'includes/section.php';

if(!isset($_REQUEST['search']) || !isset($_SESSION['Numero'])){
    include 'includes/incluir.php';

  

    echo "<style>
    body{
    background: #007bff;
 
    }
    #aside,#section,#pcmenu,#mmenu,#btnm{display:none}
    </style>";
    echo "<div  style='margin:10% auto;background:white;padding:10px;text-align:center;width:90%'>Erro de pagina<br><a href='avancar1.php' class='btn btn-primary'>Voltar</a></div>";
    
        
       exit;
}



echo "<div id='aside'>";

//=======================fetch User searched================

$search=new Manager();
$search->setCelular(filter_var($_REQUEST['search'],FILTER_SANITIZE_SPECIAL_CHARS));

if($search->searchUser()->rowCount()==0 || $_REQUEST['search']==''){
    echo "<div class='card' style='text-align:center'>Nenhum resultado encontrado para: <b>\"".filter_var($_REQUEST['search'],FILTER_SANITIZE_SPECIAL_CHARS)."\"</b></div>";
    exit;
}

echo "<div class='card' style='text-align:center'>Resultado encontrado para: <b>\"".filter_var($_REQUEST['search'],FILTER_SANITIZE_SPECIAL_CHARS)."\" ({$search->searchUser()->rowCount()})</b></div><br>";
$id=0;
foreach($search->searchUser1() as $linha){

if($linha['Numero']!=$_SESSION['Numero']){

    echo "<a href='account.php?id=".base64_encode($linha['id_user'])."' style='text-decoration:none;color:black'><div class='card d-block' style='padding:5px;margin-bottom:2px'>";
    if($linha['Avatar']=='' and $linha['Sexo']=='Masculino'){
echo "<img src='files/male.png' width=30 height=30> ";
    }else if($linha['Avatar']=='' and $linha['Sexo']=='Femenino'){
        echo "<img src='files/female.png' width=30 height=30> ";
    }else{
        echo "<img src='img/avatar/".$linha['Avatar']."' width=30 height=30 style='border-radius:15px'> ";
    }
    
    echo "<b>".$linha['Nome']."</b>";
    echo "</div></a>";
}else{

    echo "<a href='account.php' style='text-decoration:none;color:black'><div class='card d-block' style='padding:5px;margin-bottom:2px'>";
    if($linha['Avatar']=='' and $linha['Sexo']=='Masculino'){
echo "<img src='files/male.png' width=30 height=30> ";
    }else if($linha['Avatar']=='' and $linha['Sexo']=='Femenino'){
        echo "<img src='files/female.png' width=30 height=30> ";
    }else{
        echo "<img src='img/avatar/".$linha['Avatar']."' width=30 height=30 style='border-radius:15px'> ";
    }
    
    echo "<b>".$linha['Nome']."</b>";
    echo "</div></a>";

}
$id=$linha['id_user'];
}

if($search->searchUser1()->rowCount()>=10){
    echo "<center><a class='btn btn-outline-primary' href='search1.php?id=".base64_encode($id)."&src=".base64_encode($_REQUEST['search'])."' style='text-decoration:none'>Mais</a></center>";
}




echo "</div>";

?>

