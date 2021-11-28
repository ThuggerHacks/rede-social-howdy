<?php  session_start();

include 'classes/Manager.class.php';


if(!isset($_REQUEST['background']) || !isset($_REQUEST['cor']) || !isset($_REQUEST['tipo']) || !isset($_SESSION['Numero'])){
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

$status=new Manager();
$status->setCelular($_SESSION['Numero']);
$status->setTexto(filter_var($_REQUEST['msg'],FILTER_SANITIZE_SPECIAL_CHARS));

//===============background===============

$back=$_REQUEST['background'];
$bg="";

if($back==1){
$bg="red";
}else if($back==2){
    $bg="-webkit-linear-gradient(top,#007bff,#0f0)";
}else if($back==3){
    $bg="#007bff";
}else if($back==4){
    $bg="#e83e8c";
}else if($back==5){
    $bg="yellow";
}else if($back==6){
    $bg="purple";
}else if($back==7){
    $bg="-webkit-linear-gradient(top,#343a40,#6c757d)";
}else if($back==8){
    $bg="#343a40";
}else if($back==9){
    $bg="#cc1";
}elseif($back==10){
$bg="#ffc107";
}elseif($back==11){
    $bg="-webkit-linear-gradient(top,red,yellow)";
}elseif($back==12){
    $bg="-webkit-linear-gradient(bottom,yellow,#0f0)";
}else if($back==13){
    $bg="-webkit-radial-gradient(center,circle,#17a2b8,purple 100%)";
}else if($back==14){
    $bg="-webkit-linear-gradient(top,red,purple)";
}else if($back==15){
    $bg="-webkit-linear-gradient(top,#e83e8c,orange)";  
}else{
    $bg="#cc1";
}

$status->setBackground($bg);

//===============cor==================  

$cor=$_REQUEST['cor'];
$clr="";

if($cor==1){
$clr="#fcc";
}else if($cor==2){
    $clr="#0f0";
}else if($cor==3){
    $clr="blue";
}else if($cor==4){
    $clr="pink";
}else if($cor==5){
    $clr="#ccc";
}else if($cor==6){
    $clr="#efe";
}else if($cor==7){
    $clr="cyan";
}else if($cor==8){
    $clr="black";
}else if($cor==9){
    $clr="white";
}elseif($cor==10){
    $clr="orangered";
    }elseif($cor==11){
        $clr="green";
    }elseif($cor==12){
        $clr="brown";
    }else if($cor==13){
        $clr="gray";
    }else{
        $clr="black";  
    }

$status->setCorLetra($clr);

//==============tipo letra===============


$tipo=$_REQUEST['tipo'];

$tp="";

if($tipo==1){
$tp="italico";

}else if($tipo==2){
    $tp="underline";
}else if($tipo==3){
    $tp="delete";
}else if($tipo==4){
    $tp="bold";
}else if($tipo==6){
  $tp="thugger";
}else if($tipo==7){
    $tp="thugger1";
}else{
    $tp="normal";
}

$status->setTipoLetra($tp);

//===================set id===================
$id=0;
foreach($status->fetchUser() as $linha){
$id=$linha['id_user'];
}

$status->setId($id);
$status->sendStatus();

echo "0";
