<?php

include 'classes/Manager.class.php';
include 'includes/incluir.php';


$user=isset($_REQUEST['user'])?$_REQUEST['user']:"";
$pais=isset($_REQUEST['pais'])?$_REQUEST['pais']:"";
$city=isset($_REQUEST['city'])?$_REQUEST['city']:"";
$distrito=isset($_REQUEST['distrito'])?$_REQUEST['distrito']:"";
$pass1=isset($_REQUEST['pass1'])?$_REQUEST['pass1']:"";
$pass2=isset($_REQUEST['pass2'])?$_REQUEST['pass2']:"";
$sexo=isset($_REQUEST['sexo'])?$_REQUEST['sexo']:"";
$nbr=isset($_REQUEST['nbr'])?$_REQUEST['nbr']:"";
$date=isset($_REQUEST['date'])?$_REQUEST['date']:"";
$email=isset($_REQUEST['email'])?$_REQUEST['email']:"";

if($user=='' || $pais=='' || $city=='' ||  $pass1=='' || $pass2=='' || $sexo=='' || $nbr=='' || $date==''){
echo "<img src='files/deletar.png' width=100 height=100><br>Nao foi possivel Registar devido a insuficiencia de dados";
}else if($date>'2004-04-04'){
    echo "<img src='files/deletar.png' width=100 height=100><br>Nao foi possivel Registar devido a sua idade";
}else if($pass1!=$pass2){
    echo "<img src='files/deletar.png' width=100 height=100><br>Erro ao registar, inserio passwords diferentes";
}else if(!ctype_digit($nbr)){
    echo "<img src='files/deletar.png' width=100 height=100><br>Erro ao registar, inseriu um numero incorrecto";
}else if(ctype_digit($user)){
    echo "<img src='files/deletar.png' width=100 height=100><br>Erro ao registar, nome de usuario invalido";
}else if(filter_var($email,FILTER_VALIDATE_EMAIL)==false && $email!=''){
    echo "<img src='files/deletar.png' width=100 height=100><br>Erro ao registar, email invalido";
}else if($nbr<0){
    echo "<img src='files/deletar.png' width=100 height=100><br>Erro ao registar, numero invalido";
}else{

    $m=new Manager();
    $m->setCelular($nbr);
    $m->setEmail($email);
    if($m->checkUser()->rowCount()!=0){
        echo "<img src='files/deletar.png' width=100 height=100><br>Erro ao registar, Numero ou Email ja existem";
    }else{
        //====getting pais name from the id========
      $c=new Manager();
      $c->setId($pais);
      $country=$c->fetchCountry1();
//=[end]-============================

        //====getting state name from the id========
        $c1=new Manager();
        $c1->setId($city);
        $cidade=$c1->fetchState1();
  //=[end]-============================
  

          //====getting distrito name from the id========
          $c2=new Manager();
          $c2->setId($distrito);
          $distrito1=$c2->fetchCity1();
    //=[end]-============================
    

       $m1=new Manager();
       $m1->setEmail($email);
       $m1->setCelular($nbr);
       $m1->setNome(filter_var(ucwords(strtolower($user)),FILTER_SANITIZE_SPECIAL_CHARS));
       $m1->setData($date);
       $m1->setSexo($sexo);
       $m1->setPais($country);
       $m1->setCidade($cidade);
       $m1->setDistrito($distrito1);
       $m1->setSenha1(md5($pass1));
       $m1->registar();

       echo "<img src='files/concluido.png' width=100 height=100><br>Registado com sucesso, seja bem vindo ao Howdy";

    }



}