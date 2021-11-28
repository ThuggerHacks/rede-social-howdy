<?php session_start();
include 'classes/Manager.class.php';

if(!isset($_REQUEST['pass']) || !isset($_REQUEST['number'])){
    include 'includes/incluir.php';

    echo "<style>
    body{
    background: #007bff;
    }
    </style>";
    echo "<div  style='margin:10% auto;background:white;padding:10px;text-align:center;width:90%'>Nao tem permissao para ver esta pagina<br><a href='index.php' class='btn btn-primary'>LOGIN</a></div>";
    exit;
}
if($_REQUEST['number']=='' || $_REQUEST['pass']==''){
    echo "Por favor preencha os dados";

}else{


$m=new Manager();
$m->setCelular($_REQUEST['number']);
$m->setSenha1(md5($_REQUEST['pass']));
$check=$m->checkUserPass();

if($check->rowCount()==0){
    echo "Dados incorrectos";
}else{
    $_SESSION['Numero']=$_REQUEST['number'];
    
if($_REQUEST['check']=='true'){
    setcookie('Numero',$_SESSION['Numero'],time()+60*60*24*365,"/");
}
    echo "0";



}

}