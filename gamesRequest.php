<?php session_start();

include 'classes/Manager.class.php';

if(isset($_REQUEST['usuario'])){
    // /invite user to play
$invite=new Manager();
$invite->setCelular($_SESSION['Numero']);
$iduser=0;
foreach($invite->fetchUser() as $linha){
$iduser=$linha['id_user'];
}

$invite->setCelular($iduser);
$invite->setId($_REQUEST['usuario']);
$invite->enviarPedidoDeJogo();

foreach($invite->verificarEstadoDoJoGo() as $linha){
    echo $linha['Estado'];
}

}else if(isset($_REQUEST['dados'])){
//======receber convite========
$user=new Manager();
$user->setCelular($_SESSION['Numero']);
$id=0;
foreach($user->fetchUser() as $linha){
$id=$linha['id_user'];
}
$user->setId($id);
    foreach($user->fetchPedidoJogo() as $usuarios){
        if($user->fetchPedidoJogo()->rowCount()==0){
    echo "<center><div class='card-header'>Nenhum Pedido encontrado</div></center>";
        }
        $user1=new Manager();
       $user1->setId($usuarios['id_convite']);
        foreach($user1->fetchUserViaId() as $jogador ){
            echo "<div class='card-header'>";
            echo $jogador['Nome'];
        
            echo "<input type='hidden' value='".$jogador['Nome']."' id='jog'><button class='btn btn-outline-primary ' style='float:right' id='aceitar".$jogador['id_user']."' onclick='aceitar(".$jogador['id_user'].",".$id.")'>Aceitar</button></div>";
        
        }
     
    }
    
    
}else if(isset($_REQUEST['pessoa'])){

    //======aceitar pedido=====

   $aceitar=new Manager();
   $aceitar->setId($_REQUEST['pessoa']);
   $aceitar->setCelular($_REQUEST['eu']);
   $aceitar->aceitarPedidoDeJogo(); 

   

   foreach($aceitar->fetchUserViaId() as $linha){
       echo "<center><strong class='text-light'>".$linha['Nome']."</strong></center>";
   }
 

}else if(isset($_REQUEST['jogada'])){
   $whoPlays=$_REQUEST['player1'];
   $jogada=$_REQUEST['jogada'];
   $player1=$_REQUEST['player1'];
   $player2=$_REQUEST['player2'];

   $manager=new Manager();
   $manager->setId($player2);
   $manager->setCelular($player1);
 
 

foreach($manager->CondicoesDeJogadas() as $linha){
    $dado=$linha['Dado'.$jogada];
if(($linha['whoPlays']==0 || $linha['whoPlays']==$player1) &&  $dado==""){
    $manager->setTexto("X");
    $whoPlays=$_REQUEST['player2'];
    $manager->setTipo($whoPlays);
    $manager->setNumero($jogada);
    $manager->jogadas();
    echo $whoPlays;
    
   
   
}else if($linha['whoPlays']==$player2 &&  $dado==""){
    $manager->setTexto("O");
    $whoPlays=$_REQUEST['player1'];
    $manager->setTipo($whoPlays);
    $manager->setNumero($jogada);
    $manager->jogadas();
    echo $whoPlays;
   
  
} 

}


  
}else if(isset($_REQUEST['sudo'])){

    $player1=$_REQUEST['player3'];
   $player2=$_REQUEST['player4'];
   $manager=new Manager();
    $manager->setId($player2);
    $manager->setCelular($player1);
     $manager->updatePlay();
foreach($manager->CondicoesDeJogadas() as $lin){
  
  
if($lin['Dado1']==$lin['Dado2'] && $lin['Dado2']==$lin['Dado3'] && $lin['Dado3']!=""){
    echo "<center><div class='text-light' style='font-size:30px;font-weight:bolder'>".$lin['Dado1']." Venceu</div></center>";
}else if($lin['Dado4']==$lin['Dado5'] && $lin['Dado5']==$lin['Dado6'] && $lin['Dado6']!=""){
    echo "<center><div class='text-light' style='font-size:30px;font-weight:bolder'>".$lin['Dado4']." Venceu</div></center>";
}else if($lin['Dado7']==$lin['Dado8'] && $lin['Dado8']==$lin['Dado9'] && $lin['Dado9']!=""){
    echo "<center><div class='text-light' style='font-size:30px;font-weight:bolder'>".$lin['Dado7']." Venceu</div></center>";
}else if($lin['Dado1']==$lin['Dado4'] && $lin['Dado4']==$lin['Dado7'] && $lin['Dado7']!=""){
    echo "<center><div class='text-light' style='font-size:30px;font-weight:bolder'>".$lin['Dado1']." Venceu</div></center>";
}else if($lin['Dado2']==$lin['Dado5'] && $lin['Dado5']==$lin['Dado8'] && $lin['Dado8']!=""){
    echo "<center><div class='text-light' style='font-size:30px;font-weight:bolder'>".$lin['Dado2']." Venceu</div></center>";
}else if($lin['Dado3']==$lin['Dado6'] && $lin['Dado6']==$lin['Dado9'] && $lin['Dado9']!=""){
    echo "<center><div class='text-light' style='font-size:30px;font-weight:bolder'>".$lin['Dado3']." Venceu</div></center>";
}else if($lin['Dado1']==$lin['Dado5'] && $lin['Dado5']==$lin['Dado9'] && $lin['Dado9']!=""){
    echo "<center><div class='text-light' style='font-size:30px;font-weight:bolder'>".$lin['Dado1']." Venceu</div></center>";
}else if($lin['Dado3']==$lin['Dado5'] && $lin['Dado5']==$lin['Dado7'] && $lin['Dado7']!=""){
    echo "<center><div class='text-light' style='font-size:30px;font-weight:bolder'>".$lin['Dado3']." Venceu</div></center>";
}else if($lin['Dado1']!="" && $lin['Dado2']!="" && $lin['Dado3']!="" && $lin['Dado4']!="" && $lin['Dado5']!="" && $lin['Dado6']!="" && $lin['Dado7']!="" && $lin['Dado8']!="" && $lin['Dado9']!=""){

    echo "<center><div class='text-light' style='font-size:30px;font-weight:bolder'> Empate</div></center>";
}else{
    echo "<div id='s1' onclick='play1(1,".$lin['whoPlays'].")'>".$lin['Dado1']."</div>
    <div id='s2' onclick='play1(2,".$lin['whoPlays'].")'>".$lin['Dado2']."</div>
    <div id='s3' onclick='play1(3,".$lin['whoPlays'].")'>".$lin['Dado3']."</div>
    <div id='s4' onclick='play1(4,".$lin['whoPlays'].")'>".$lin['Dado4']."</div>
    <div id='s5' onclick='play1(5,".$lin['whoPlays'].")'>".$lin['Dado5']."</div>
    <div id='s6' onclick='play1(6,".$lin['whoPlays'].")'>".$lin['Dado6']."</div>
    <div id='s7' onclick='play1(7,".$lin['whoPlays'].")'>".$lin['Dado7']."</div>
    <div id='s8' onclick='play1(8,".$lin['whoPlays'].")'>".$lin['Dado8']."</div>
    <div id='s9' onclick='play1(9,".$lin['whoPlays'].")'>".$lin['Dado9']."</div>";

}


}
}


?>
