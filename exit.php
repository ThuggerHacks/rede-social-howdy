<?php session_start();
include 'classes/Manager.class.php';

if(isset($_SESSION['Numero'])){
 $m=new Manager();
 $m->setCelular($_SESSION['Numero']);
 $m-> updateOffline();   
session_destroy();
setcookie('Numero',$_SESSION['Numero'],time()-1000,"/");
header('location:index.php');
}