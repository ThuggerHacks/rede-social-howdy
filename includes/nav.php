<?php

date_default_timezone_set('africa/maputo');


if(isset($_COOKIE['Numero'])){
    $_SESSION['Numero']=$_COOKIE['Numero'];
}

include 'includes/incluir.php';

if(!isset($_SESSION['Numero'])){

echo "<style>
body{
background: #007bff;
}
</style>";
echo "<div  style='margin:10% auto;background:white;padding:10px;text-align:center;width:90%'>Fa&ccedil;a login para ver esta pagina<br><a href='index.php' class='btn btn-primary'>LOGIN</a></div>";

    exit;
}


//====================================================msg mobile===========





//================end===========================

?>

<style>
@font-face{
    font-family:"thugger";
    src:url(font/PaintDropsRegular-0WaJo.ttf)
}




#search{
    border:none;
    border-bottom:1px solid black;
    outline:none;
}

#small{
    margin:5px;
    padding:10px;
}
.navbar-toggler{
    outline:none;
    display:none;
}
#mmenu{
    display:none;
    position:absolute;
    opacity:0;
    top:-1000%;
  
}
#more-menu{
    display:none;

}
@media screen and (max-width:991px){
    #mmenu{
    display:none;
   opacity:1;
    width:100%;
    height:85%;
    text-align:center;
    position:relative;
    top:0%;
 
} 
#small{
    display:none;
    
}
#small .navbar-nav .nav-item a{
    color:black;
    font-weight:bolder;
    transition:background 1s;
}

#small .navbar-nav .nav-item{
    transition:background 1s;
}

#small .navbar-nav .nav-item :hover{
background:#007bff;
}

#more-menu li:hover{
    background:#f8f9fa;
}
.navbar-toggler{
    outline:none;
    display:block;
}
}
</style>

<div id='pcmenu'>

<nav class='navbar navbar-expand-lg navbar-dark bg-primary navbar-fixed-top'>
<div class='container'>
<a class='navbar-brand ' href='avancar1.php' style=' font-family:thugger'><strong>HOWDY</strong></a>
<div  class='collapse navbar-collapse'>

<ul class='navbar-nav'>
<li class='nav-item'>
<a class='nav-link myAc' href='account.php' >MINHA CONTA</a>

</li>
<?php


$m=new Manager();
$m->setCelular($_SESSION['Numero']);
$id=0;

foreach($m->fetchUser() as $linha){
    $id=$linha['id_user'];
}

$m->setId($id);
if($m->message()->rowCount()>0){
$n=0;

if($m->message()->rowCount()<=99){
    $n=$m->message()->rowCount();
}else{
    $n="99+";
}


    echo "<li class='nav-item'><a class='nav-link' href='msg.php'>MENSAGENS <div class='bg-danger text-light d-inline msg1' style='padding:2px'>".$n."</div></a></li>";
    
}else{
    echo "<li class='nav-item'><a class='nav-link msg1' href='msg.php'>MENSAGENS</a></li>";
}









?>

<?php

$m4=new Manager();
$m4->setCelular($_SESSION['Numero']);
$id2=0;
foreach($m4->fetchUser() as $linha){
$id2=$linha['id_user'];
}

$m4->setId($id2);

if($m4->fetchNotificacao()->rowCount()>0){

$num=0;

if($m4->fetchNotificacao()->rowCount()<=99){
    $num=$m4->fetchNotificacao()->rowCount();

}else{
    $num="99+";
}    
    echo "<li class='nav-item'>
    <a class='nav-link nt' href='notificacao.php'>NOTIFICA&Ccedil;OES <div class='bg-danger text-light d-inline ' style='padding:2px'>".$num."</div></a></li>";
    
}else{
    echo "<li class='nav-item'>
<a class='nav-link nt' href='notificacao.php'>NOTIFICA&Ccedil;OES</a></li>";
}



?>

<li class='nav-item'>
<a class='nav-link us' href='users.php'>UTILIZADORES</a>

</li>
<li class='nav-item'>
<a class='nav-link more' href='mais.php' media='scree and (min-width:992px)'>MAIS</a>

</li>



</ul>



</div>
<form method='post' action='search.php'>
<input type='search' name='search' id='search' class='bg-primary ' placeholder='search' maxLength=200>
<input type='submit' name='btnS' value='OK' class='btn btn-primary '>

</form>
</nav>


</div>


</div>


<!---mobileMenu-------------->

<button class='navbar-toggler navbar-light ' style='outline:none' id='btnm'>
<span class='navbar-toggler-icon '></span>
<span class='close'></span>
</button>
<div id='mmenu' >


<div>

<div  id='small' >

<ul class='navbar-nav'>
<li class='nav-item'>
<a class='nav-link mmac' href='account.php' >MINHA CONTA</a>

</li>

<?php


$m=new Manager();
$m->setCelular($_SESSION['Numero']);
$id=0;

foreach($m->fetchUser() as $linha){
    $id=$linha['id_user'];
}

$m->setId($id);
if($m->message()->rowCount()>0){
$n=0;

if($m->message()->rowCount()<=99){
    $n=$m->message()->rowCount();
}else{
    $n="99+";
}


    echo "<li class='nav-item'><a class='nav-link msg' href='msg.php'>MENSAGENS <div class='bg-danger text-light d-inline msg' style='padding:2px'>".$n."</div></a></li>";
    
}else{
    echo "<li class='nav-item'><a class='nav-link msg' href='msg.php'>MENSAGENS</a></li>";
}









?>
<?php

$m4=new Manager();
$m4->setCelular($_SESSION['Numero']);
$id2=0;
foreach($m4->fetchUser() as $linha){
$id2=$linha['id_user'];
}

$m4->setId($id2);

if($m4->fetchNotificacao()->rowCount()>0){

$num=0;

if($m4->fetchNotificacao()->rowCount()<=99){
    $num=$m4->fetchNotificacao()->rowCount();

}else{
    $num="99+";
}    
    echo "<li class='nav-item'>
    <a class='nav-link nt1' href='notificacao.php'>NOTIFICA&Ccedil;OES <div class='bg-danger text-light d-inline ' style='padding:2px'>".$num."</div></a></li>";
    
}else{
    echo "<li class='nav-item'>
<a class='nav-link nt1' href='notificacao.php'>NOTIFICA&Ccedil;OES</a></li>";
}



?>
<li class='nav-item'>
<a class='nav-link us1' href='users.php'>UTILIZADORES</a>

</li>
<li class='nav-item'>
<a class='nav-link dropdown more1' href='#' id='more'>MAIS</a>
</li>






</ul>
<ul class='navbar-nav'>
<div id='more-menu' >


<li class='nav-item'><a style='font-weight:bolder;text-decoration:none;color:black' href='#' id='chat'>Chat</a></li>


<li class='nav-item'><a href='midia.php' style='font-weight:bolder;text-decoration:none;color:black'> Midia</a></li>

<li class='nav-item'>
<a href='group.php' style='font-weight:bolder;text-decoration:none;color:black'> Grupos</a></li>

<li class='nav-item'><a href='games.php' style='font-weight:bolder;text-decoration:none;color:black'> Games</a></li>
<li class='nav-item'><a href='config.php' style='font-weight:bolder;text-decoration:none;color:black'> Configura&ccedil;oes</a></li>
<?php
if($_SESSION['Numero']=='848499142'){

    echo "<li class='nav-item'><a href='analytics.php' style='font-weight:bolder;text-decoration:none;color:black'>Analytics</a></li>";
}

?>
<li class='nav-item'><a href='help.php' style='font-weight:bolder;text-decoration:none;color:black'>Ajuda</a></li>
<li class='nav-item'><a href='help.php?h=lsU==' style='font-weight:bolder;text-decoration:none;color:black'> Sobre</a></li>
<li class='nav-item'><a href='exit.php' style='font-weight:bolder;text-decoration:none;color:black'> Sair</a></li>
</ul>

</div>

</div>

</div>



</div>

<script>

$(document).ready(function(){

   

   
 
$('.navbar-toggler').click(function(){




$('#mmenu').slideToggle(500)
$('#small').toggle(500)
$('#aside').toggle(500)



})
    
$('#more').click(function(){
    $('#more-menu').toggle(500)
})



})


$('#msg2').click(function(){

$('#msg1').show(200)
$('#mmenu').hide(200)
$('#pcmenu').hide(200)


})



</script>