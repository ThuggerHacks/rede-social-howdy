<?php session_start();
include 'classes/Manager.class.php';


if(isset($_REQUEST['pontos'])){

$game=new Manager();
$game->setTexto($_REQUEST['game']);
$game->setPontos($_REQUEST['pontos']);

$game->setCelular($_SESSION['Numero']);
$id=0;

foreach($game->fetchUser() as $linha){
    $id=$linha['id_user'];
}

$game->setId($id);
$game->insertGames();



}else if(isset($_REQUEST['vp'])){
    $game=new Manager();
    $game->setTexto($_REQUEST['game']);
    $game->setPontos($_REQUEST['vp']);
    
    $game->setCelular($_SESSION['Numero']);
    $id=0;
    
    foreach($game->fetchUser() as $linha){
        $id=$linha['id_user'];
    }
    
    $game->setId($id);
    $game->insertGames();
    
    

}