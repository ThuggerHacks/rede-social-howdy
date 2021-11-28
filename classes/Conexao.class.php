<?php

class Conexao{

public function connect(){
try{
$con=new PDO("mysql:dbname=Howdy;host=localhost","root","Thugger11");

}catch(PDOException $e){

echo "Erro desconhecido";

}

return $con;
}


public function close(){
    $con=$this->connect();
    $con=null;
}
}