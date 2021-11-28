<?php
include 'Conexao.class.php';

class Controller extends Conexao{
    private $nome;
    private $senha1;
    private $senha2;
    private $pais;
    private $celular;
    private $sexo;
    private $data;
    private $email;
    private $cidade;
    private $distrito;
    private $id;
    private $profile;
    private $texto;
    private $tipoLetra;
    private $corLetra;
    private $background;
    private $numero;
    private $tipo;
    private $pontos;
    





    public function setPontos($id){
        $this->pontos=$id;
    }
    
    public function getPontos(){
        return $this->pontos;
    }


    public function setNumero($id){
        $this->numero=$id;
    }
    
    public function getNumero(){
        return $this->numero;
    }



    public function setTipo($id){
        $this->tipo=$id;
    }
    
    public function getTipo(){
        return $this->tipo;
    }
    
    
    public function setBackground($id){
        $this->background=$id;
    }
    
    public function getBackground(){
        return $this->background;
    }

    public function setCorLetra($id){
        $this->corLetra=$id;
    }
    
    public function getCorLetra(){
        return $this->corLetra;
    }

    public function setTexto($id){
        $this->texto=$id;
    }
    
    public function getTexto(){
        return $this->texto;
    }


    public function setTipoLetra($id){
        $this->tipoLetra=$id;
    }
    
    public function getTipoLetra(){
        return $this->tipoLetra;
    }


    public function setProfile($id){
        $this->profile=$id;
    }
    
    public function getProfile(){
        return $this->profile;
    }
    public function setId($id){
        $this->id=$id;
    }
    
    public function getId(){
        return $this->id;
    }
    
public function setNome($nome){
    $this->nome=$nome;
}

public function getNome(){
    return $this->nome;
}



public function setCidade($c){
    $this->cidade=$c;
}

public function getCidade(){
    return $this->cidade;
}

public function setDistrito($d){
    $this->distrito=$d;
}

public function getDistrito(){
    return $this->distrito;
}


public function setSexo($sexo){
    $this->sexo=$sexo;
}

public function getSexo(){
    return $this->sexo;
}

public function setSenha1($senha1){
    $this->senha1=$senha1;
}

public function getSenha1(){
    return $this->senha1;
}


public function setSenha2($senha2){
    $this->senha2=$senha2;
}

public function getSenha2(){
    return $this->senha2;
}


public function setPais($pais){
    $this->pais=$pais;
}

public function getPais(){
    return $this->pais;
}

public function setCelular($celular){
    $this->celular=$celular;
}

public function getCelular(){
    return $this->celular;
}

public function setData($data){
    $this->data=$data;
}

public function getData(){
    return $this->data;
}

public function setEmail($email){
    $this->email=$email;
}

public function getEmail(){
    return $this->email;
}


}