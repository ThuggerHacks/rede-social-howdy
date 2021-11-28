<?php

include 'Controller.class.php';
date_default_timezone_set("Africa/Maputo");
class Manager extends Controller{


//=====insert registar data==============

public function Registar(){
    $con=$this->connect();

    $sql="INSERT INTO usuarios (Nome,Numero,Email,Senha,Sexo,Pais,Cidade,Distrito,Estados,Estado,Data_Nascimento,Ocultar_Numero,Ocultar_Email,Ocultar_Data) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $registar=$con->prepare($sql);
    $registar->execute([
      $this->getNome(),
      $this->getCelular(),
      $this->getEmail(),
      $this->getSenha1(),
      $this->getSexo(),
      $this->getPais(),
      $this->getCidade(),
      $this->getDistrito(),
      "Hey Howdy",
      time()+300,
      $this->getData(),
      "false",
      "false",
      "false"
    ]);
}

//==============end===================


//=====fetch Coutry=================

public function fetchCountry(){
    $con=$this->connect();

    $sql="SELECT*FROM country";
    $pais=$con->prepare($sql);
    $pais->execute();
    
    return $pais;
}


//==============================



//=====fetch state=================

public function fetchState(){
    $con=$this->connect();

    $sql="SELECT*FROM state WHERE country_id=?";
    $pais=$con->prepare($sql);
    $pais->execute([$this->getId()]);
    
    return $pais;
}


//==============================

//=====fetch state=================

public function fetchCity(){
    $con=$this->connect();

    $sql="SELECT*FROM city WHERE state_id=?";
    $pais=$con->prepare($sql);
    $pais->execute([$this->getId()]);
    
    return $pais;
}


//==============================

//==========checkUser===========

public function checkUser(){
    $con=$this->connect();

    $sql="SELECT*FROM usuarios WHERE (Numero=? OR Email=?) AND Email<>?";
    $motor=$con->prepare($sql);
    $motor->execute([
    $this->getCelular(),
    $this->getEmail(),
    ""
    ]);

    return $motor;
}


//==============end==========


//===========fetch coutry===========

public function fetchCountry1(){
    $con=$this->connect();

    $name="";

    $sql="SELECT*FROM country WHERE id=?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId()]);

    foreach($motor as $linha){
        $name=$linha['name'];
    }
return $name;
}



//==========end=================



//===========fetch state1===========

public function fetchState1(){
    $con=$this->connect();

    $name="";

    $sql="SELECT*FROM state WHERE id=?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId()]);

    foreach($motor as $linha){
        $name=$linha['name'];
    }
return $name;
}



//==========end=================


//===========fetch city1===========

public function fetchCity1(){
    $con=$this->connect();

    $name="";

    $sql="SELECT*FROM city WHERE id=?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId()]);

    foreach($motor as $linha){
        $name=$linha['name'];
    }
return $name;
}



//==========end=================


//================checkUserAndPass==============

public function checkUserPass(){
    $con=$this->connect();

    $sql="SELECT*FROM usuarios WHERE Senha=? AND Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getSenha1(),$this->getCelular()]);

    return $motor;
}


//====================end=====================



//====================fetch firsTime===================

public function fetchFirstTime(){

$con=$this->connect();

$sql="SELECT*FROM usuarios WHERE First_Time=? AND Numero=?";
$motor=$con->prepare($sql);
$motor->execute([0,$this->getCelular()]);

return $motor;

}


//==============================================

//================Update Profile=========

public function updateProfile(){

    $con=$this->connect();

    $sql="UPDATE usuarios SET Avatar=? WHERE Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getProfile(),
        $this->getCelular()
    ]);
header('location:avancar1.php');
}

//========================over================


//================Update Profile=========

public function updateFirstTime(){

    $con=$this->connect();

    $sql="UPDATE usuarios SET First_Time=? WHERE Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        1,
        $this->getCelular()
    ]);

}


//============fetchUser===================

public function fetchUser(){

$con=$this->connect();

$sql="SELECT*FROM usuarios WHERE Numero=?";
$motor=$con->prepare($sql);
$motor->execute([$this->getCelular()]);

return $motor;


}


//========================


//===========================update online user==============

public function updateOnline(){
    $con=$this->connect();

    $sql="UPDATE usuarios SET Estado=? WHERE Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute([time()+300,$this->getCelular()]);
}

//==================end=======================


//============fetchUserOnline===================

public function fetchOnlineUser(){

    $con=$this->connect();
    
    $sql="SELECT*FROM usuarios WHERE  Estado>? AND Numero<>? ORDER BY id_user ASC LIMIT 20";
    $motor=$con->prepare($sql);
    $motor->execute([time(),$this->getCelular()]);
    
    return $motor;
    
    
    }
    
    
    //========================


    //==============================enviar status=======================

    public function sendStatus(){

        $con=$this->connect();

        $sql="INSERT INTO Estado (Texto,Letra,Cor,Numero,Timer,id_user,Cor1) VALUES(?,?,?,?,?,?,?)";
        $motor=$con->prepare($sql);
        $motor->execute([
       $this->getTexto(),
       $this->getTipoLetra(),
       $this->getCorLetra(),
       $this->getCelular(),
       time()+60*60*24,
       $this->getId(),
       $this->getBackground()
        ]);
        

    }


    //====================================================


    //====================fetchMyStatus=================

public function fetchMyStatus(){
    $con=$this->connect();
    $sql="SELECT*FROM Estado WHERE Numero=? AND Timer>? ORDER BY Id DESC LIMIT 1";
    $motor=$con->prepare($sql);
    $motor->execute([
    $this->getCelular(),
    time()
    ]);

    return $motor;
}

    //============================================

   //====================fetchStatus=================

   public function fetchStatus(){
    $con=$this->connect();
    $sql="SELECT*FROM Estado WHERE Numero=? AND Timer>? ORDER BY Id DESC LIMIT 1";
    $motor=$con->prepare($sql);
    $motor->execute([
    $this->getCelular(),
    time()
    ]);

    return $motor;
}

    //============================================


     //====================fetchStatus=================

   public function fetchOneStatus(){
    $con=$this->connect();
    $sql="SELECT DISTINCT Numero FROM Estado WHERE Numero<>? AND Timer>? ORDER BY Id ASC LIMIT 15";
    $motor=$con->prepare($sql);
    $motor->execute([
    $this->getCelular(),
    time(),
    ]);

    return $motor;
}

    //============================================


     //====================fetchStatus=================

   public function fetchNextStatus(){
    $con=$this->connect();
    $sql="SELECT*FROM Estado WHERE Numero=? AND Timer>? AND Id<? AND Id>0 ORDER BY Id DESC LIMIT 1";
    $motor=$con->prepare($sql);
    $motor->execute([
    $this->getCelular(),
    time(),
    $this->getId()
    ]);

    return $motor;
}

    //============================================


        //====================fetchStatus=================

   public function fetchPrevStatus(){
    $con=$this->connect();
    $sql="SELECT*FROM Estado WHERE Numero=? AND Timer>? AND Id>? AND Id>0 ORDER BY Id ASC LIMIT 1";
    $motor=$con->prepare($sql);
    $motor->execute([
    $this->getCelular(),
    time(),
    $this->getId()
    ]);

    return $motor;
}

    //============================================




       //====================fetchStatus=================

   public function fetchStatusViaId(){
    $con=$this->connect();
    $sql="SELECT*FROM Estado WHERE Id=? AND Timer>? ORDER BY Id DESC LIMIT 1";
    $motor=$con->prepare($sql);
    $motor->execute([
    $this->getId(),
    time()
    ]);

    return $motor;
}

    //============================================


    //=======================insertViews====================
public function insertViews(){

$con=$this->connect();

$sql="SELECT*FROM StatusView WHERE Id_viewer=? AND id_status=?";
$motor=$con->prepare($sql);
$motor->execute([$this->getCelular(),$this->getId()]);

if($motor->rowCount()==0){

    $insert="INSERT INTO StatusView (Id_viewer,id_status) VALUES(?,?)";
    $mot=$con->prepare($insert);
    $mot->execute([$this->getCelular(),$this->getId()]);

}

}



    //============================================


    //=========================fetch Status=====================
public function fetchViews(){

    $con=$this->connect();

$sql="SELECT*FROM StatusView WHERE  id_status=?";
$motor=$con->prepare($sql);
$motor->execute([$this->getId()]);


return $motor;

}



    //===========================================


//===================delete Status======================

function deleteStatus(){
    $con=$this->connect();
    $sql="DELETE FROM Estado WHERE Id=?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId()]);


    $con=$this->connect();
    $sql2="DELETE FROM StatusView WHERE id_status=?";
    $motor2=$con->prepare($sql2);
    $motor2->execute([$this->getId()]);
}


//====================================


//====================insertPosts===========================

public function insertPost(){
    $con=$this->connect();

    $sql="INSERT INTO posts (Mensagem,Ficheiro,Numero,id_user,Hora,Estado) VALUES(?,?,?,?,?,?)";

    $motor=$con->prepare($sql);
    $motor->execute([
    $this->getTexto(),
    $this->getProfile(),
    $this->getCelular(),
    $this->getId(),
    time(),
    "unread"


    ]);
}


//==========================================

//=====================fetch posts======================

public function fetchPost(){
    $con=$this->connect();
    $sql="SELECT*FROM posts ORDER BY id_posts DESC LIMIT 20";
    $mot=$con->prepare($sql);
    $mot->execute();

    return $mot;
}


//=========================================

//==========================insertLikes=====================

public function insertLike(){
    $con=$this->connect();
    $sql="SELECT*FROM likes WHERE Numero=? AND Numero_post=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getCelular(),
        $this->getId()
    ]);

    if($motor->rowCount()==0){
        $s="INSERT INTO likes (Numero,Numero_post) VALUES(?,?)";
        $mo=$con->prepare($s);
        $mo->execute([
            $this->getCelular(),
            $this->getId()
        ]);
    }else{
        $u="DELETE FROM likes WHERE Numero=? AND Numero_post=?";
        $mo1=$con->prepare($u);
        $mo1->execute([
            $this->getCelular(),
            $this->getId()
        ]);
    }
}
//===================end=======================

//=================fetchLikes==================
public function fetchLikes(){

    $con=$this->connect();
    $sql="SELECT*FROM likes WHERE  Numero_post=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId()
    ]);

    return $motor;
}
//===================================

//=================fetchLikes==================
public function fetchMyLikes(){

    $con=$this->connect();
    $sql="SELECT*FROM likes WHERE  Numero_post=? AND Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId(),
        $this->getCelular()
    ]);

    return $motor;
}
//===================================

//===============deletPosts=================

public function deletePosts(){

$con=$this->connect();

$sql="DELETE FROM posts WHERE id_posts=?";
$m=$con->prepare($sql);
$m->execute([$this->getId()]);


}


//=================end============================


//=====================fetch posts======================

public function fetchUserPost(){
    $con=$this->connect();
    $sql="SELECT*FROM posts WHERE id_posts=? ORDER BY id_posts DESC";
    $mot=$con->prepare($sql);
    $mot->execute([$this->getId()]);

    return $mot;
}


//=========================================

//=====================fetch user post======================

public function fetcOnlyPost(){
    $con=$this->connect();
    $sql="SELECT*FROM posts WHERE id_user=? ORDER BY id_posts DESC LIMIT 20";
    $mot=$con->prepare($sql);
    $mot->execute([$this->getId()]);

    return $mot;
}


//=========================================


//=============delete likes===================


public function deleteLikes(){
    $con=$this->connect();

    $u="DELETE FROM likes WHERE  Numero_post=?";
    $mo1=$con->prepare($u);
    $mo1->execute([
        $this->getId()
    ]);
}



//=============================fetchComments=============
public function fetchComments(){
    $con=$this->connect();
    $sql="SELECT*FROM comentarios WHERE Numero=? ORDER BY id DESC LIMIT 20";
    $mot=$con->prepare($sql);
    $mot->execute([$this->getId()]);

    return $mot;
}



//==================end======================

//===============insert Comments==============

public function insertComment(){

    $con=$this->connect();

    $s="INSERT INTO comentarios (Numero,Comentario,Hora_Comentario,Numero_poster) VALUES(?,?,?,?)";
    $mo=$con->prepare($s);
    $mo->execute([
        $this->getId(),
        $this->getTexto(),
        time(),
        $this->getCelular()
    ]);
}


//========================================


   //==============================enviar Foto status=======================

   public function sendStatusFoto(){

    $con=$this->connect();

    $sql="INSERT INTO Estado (Imagem,Timer,id_user,Numero) VALUES(?,?,?,?)";
    $motor=$con->prepare($sql);
    $motor->execute([
   $this->getProfile(),
   time()+60*60*24,
   $this->getId(),
   $this->getCelular()
    ]);
    

}


//====================================================


   //====================fetchStatusTodelete=================

   public function fetchStatusTodel(){
    $con=$this->connect();
    $sql="SELECT*FROM Estado WHERE Id=? AND Timer>? ORDER BY Id DESC LIMIT 1";
    $motor=$con->prepare($sql);
    $motor->execute([
    $this->getId(),
    time()
    ]);

    return $motor;
}

    //============================================

    //=============insert comentarios==============
public function insertComments(){

    $con=$this->connect();

    $sql="INSERT INTO comentarios (Numero,Mensagem,Hora_Comentario,Numero_poster,id_user) VALUES(?,?,?,?,?)";
    $mo=$con->prepare($sql);
    $mo->execute([
        $this->getId(),
        $this->getTexto(),
        time(),
        $this->getCelular(),
        $this->getNumero()
    ]);

}


    //=========end==========================


    //============fetch Comments===================

public function fetchCom(){
    $con=$this->connect();
    $sql="SELECT*FROM comentarios WHERE Numero=? ORDER BY id DESC ";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId()]);

    return $motor;
}


    //==============================

    //=====================delete comments=====================
public function deleteCom(){
    $con=$this->connect();
    $sql="DELETE FROM comentarios WHERE id=?";
    $motor=$con->prepare($sql);
    $motor->execute(array($this->getId()));
    
}



    //==============================================

    
     //====================Load More status=================

   public function loadMoreStatus(){
    $con=$this->connect();
    $sql="SELECT DISTINCT Numero FROM Estado WHERE Numero<>? AND Timer>? AND Id>?  ORDER BY Id ASC LIMIT 5";
    $motor=$con->prepare($sql);
    $motor->execute([
    $this->getCelular(),    
    time(),
    $this->getId()
    ]);

    return $motor;

   
}

    //============================================


    //=====================fetch posts======================

public function loadMorePosts(){
    $con=$this->connect();
    $sql="SELECT*FROM posts  WHERE id_posts<? AND id_posts>0 ORDER BY id_posts DESC LIMIT 20";
    $mot=$con->prepare($sql);
    $mot->execute([$this->getId()]);

    return $mot;
}


//=========================================


//=============================fetchComments=============
public function loadCom(){
    $con=$this->connect();
    $sql="SELECT*FROM comentarios WHERE  id<? AND id>0 AND Numero=? ORDER BY id DESC LIMIT 10";
    $mot=$con->prepare($sql);
    $mot->execute([$this->getId(),$this->getNumero()]);

    return $mot;
}



//==================end======================


//============fetchUserViaId===================

public function fetchUserViaId(){

    $con=$this->connect();
    
    $sql="SELECT*FROM usuarios WHERE id_user=?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId()]);
    
    return $motor;
    
    
    }
    
    
    //========================

    //======================updateNome===================

public function updateNome(){
    $con=$this->connect();

    $sql="UPDATE usuarios SET Nome=? WHERE Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute(array(
        $this->getNome(),
        $this->getCelular()
    ));
}

    //=======================================


        //======================updateNumero===================

public function updateNumero(){
    $con=$this->connect();

    $sql="UPDATE usuarios SET Numero=? WHERE Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute(array(
        $this->getCelular(),
        $this->getNumero()
    ));
}

    //=======================================


        //======================updateEmail===================

public function updateEmail(){
    $con=$this->connect();

    $sql="UPDATE usuarios SET Email=? WHERE Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute(array(
        $this->getEmail(),
        $this->getCelular()
    ));
}

    //=======================================


        //======================updateData===================

public function updateData(){
    $con=$this->connect();

    $sql="UPDATE usuarios SET Data_Nascimento=? WHERE Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute(array(
        $this->getData(),
        $this->getCelular()
    ));
}

    //=======================================

        //======================updateStatus===================

public function updateStatus(){
    $con=$this->connect();

    $sql="UPDATE usuarios SET Estados=? WHERE Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute(array(
        $this->getTexto(),
        $this->getCelular()
    ));
}

    //=======================================


    //============fetchUserEmail===================

public function fetchUserViaEmail(){

    $con=$this->connect();
    
    $sql="SELECT*FROM usuarios WHERE Email=? AND Email<>?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getEmail(),""]);
    
    return $motor;
    
    
    }
    

    //==================update Country==============

public function updateCountry(){
    $con=$this->connect();

    $sql="UPDATE usuarios SET Distrito=?,Pais=?,Cidade=? WHERE Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getDistrito(),
        $this->getPais(),
        $this->getCidade(),
        $this->getCelular()
    ]);
}
    //=========end===================



    //====================select old status=====================

public function fetchOldStatus(){

    $con=$this->connect();
    $sql="SELECT*FROM Estado WHERE Timer<?";
    $motor=$con->prepare($sql);
    $motor->execute([
        time()
    ]);
return $motor;
}


    //============end========================



    //=============================delete old status======


    public function deleteOldStatus(){
        $con=$this->connect();
        $sql="DELETE FROM Estado WHERE Timer<?";
        $motor=$con->prepare($sql);
        $motor->execute(array(time()));
    }

    //===============end=========================

//==============ocultar numero===============

public function ocultarNumero(){
    $con=$this->connect();
     $this->setCelular($this->getCelular());
    foreach($this->fetchUser() as $linha){
      
        if($linha['Ocultar_Numero']=='false'){

            $sql="UPDATE usuarios SET Ocultar_Numero=? WHERE Numero=?";
            $motor=$con->prepare($sql);
            $motor->execute([
            'true',
            $this->getCelular()
            ]);
        }else{
            $sql="UPDATE usuarios SET Ocultar_Numero=? WHERE Numero=?";
            $motor=$con->prepare($sql);
            $motor->execute([
                'false',
                $this->getCelular()
        
            ]);
        }
    }

}


//===============end===================



//==============ocultar Email===============

public function ocultarEmail(){
    $con=$this->connect();
     $this->setCelular($this->getCelular());
    foreach($this->fetchUser() as $linha){
      
        if($linha['Ocultar_Email']=='false'){

            $sql="UPDATE usuarios SET Ocultar_Email=? WHERE Numero=?";
            $motor=$con->prepare($sql);
            $motor->execute([
            'true',
            $this->getCelular()
            ]);
        }else{
            $sql="UPDATE usuarios SET Ocultar_Email=? WHERE Numero=?";
            $motor=$con->prepare($sql);
            $motor->execute([
                'false',
                $this->getCelular()
        
            ]);
        }
    }

}


//===============end===================


//==============ocultar Data===============

public function ocultarData(){
    $con=$this->connect();
     $this->setCelular($this->getCelular());
    foreach($this->fetchUser() as $linha){
      
        if($linha['Ocultar_Data']=='false'){

            $sql="UPDATE usuarios SET Ocultar_Data=? WHERE Numero=?";
            $motor=$con->prepare($sql);
            $motor->execute([
            'true',
            $this->getCelular()
            ]);
        }else{
            $sql="UPDATE usuarios SET Ocultar_Data=? WHERE Numero=?";
            $motor=$con->prepare($sql);
            $motor->execute([
                'false',
                $this->getCelular()
        
            ]);
        }
    }

}


//===============end===================

//=======================moreUser posts
public function loadMoreUserPosts(){
    $con=$this->connect();
    $sql="SELECT*FROM posts  WHERE id_posts<? AND id_posts>0 AND Numero=? ORDER BY id_posts DESC LIMIT 20";
    $mot=$con->prepare($sql);
    $mot->execute([$this->getId(),$this->getCelular()]);

    return $mot;
}


//=========================================

//===================sendMsg====================


public function sendMsg(){
    $con=$this->connect();
    $sql="INSERT INTO pvt (Recipie,Sender,Mensagem,Hora,Numero,id_user,Estado) VALUES(?,?,?,?,?,?,?)";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getNumero(),
        $this->getCelular(),
        $this->getTexto(),
        time(),
        $this->getCelular(),
        $this->getId(),
     "unread"
    ]); 
}

///=====end=======================

//================fetch message=========

public function fetchMessage(){
    $con=$this->connect();
    $sql="SELECT*FROM pvt WHERE (Recipie=? AND Sender=? AND (Mensagem<>? OR Ficheiro<>?)) OR (Recipie=? AND Sender=? AND (Mensagem<>? OR Ficheiro<>?)) ORDER BY id DESC LIMIT 20";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId(),
        $this->getCelular(),
        '',
        '',
        $this->getCelular(),
        $this->getId(),
        '',
        ''
    ]);

    return $motor;
}

//=======================

//================fetch message=========

public function loadMessage(){
    $con=$this->connect();
    $sql="SELECT*FROM pvt WHERE ((Recipie=? AND Sender=?) OR (Recipie=? AND Sender=?)) AND Id<? AND Id>0 ORDER BY id DESC LIMIT 20";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId(),
        $this->getCelular(),
        $this->getCelular(),
        $this->getId(),
        $this->getNumero()
    ]);

    return $motor;
}

//=======================


//================fetch message=========

public function fetchMessageViaId(){
    $con=$this->connect();
    $sql="SELECT*FROM pvt WHERE id=? ORDER BY id DESC";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId()
    ]);

    return $motor;
}

//=======================

//===================sendMsg Icon Like====================


public function sendLikeIcon(){
    $con=$this->connect();
    $sql="INSERT INTO pvt (Recipie,Sender,Ficheiro,Hora,Numero,id_user,Estado) VALUES(?,?,?,?,?,?,?)";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getNumero(),
        $this->getCelular(),
        $this->getProfile(),
        time(),
        $this->getCelular(),
        $this->getId(),
     "unread"
    ]);
}

///=====end=======================

//===============update status to read============================



public function readState(){
    $con=$this->connect();

    $sql="UPDATE pvt SET Estado=? WHERE Recipie=? AND Sender=?";
    $motor=$con->prepare($sql);
    $motor->execute(['read',$this->getCelular(),$this->getNumero()]);
}

//============end================================ 

//=========================fetching my msgs================

public function fetchOnepvt(){

    $con=$this->connect();
    $sql="SELECT DISTINCT Recipie,id_user FROM pvt WHERE (Recipie=? AND Sender<>?) OR (Recipie<>? AND Sender=?) ORDER BY id DESC LIMIT 100";
    $motor=$con->prepare($sql);
    $motor->execute([ 
    $this->getId(),
    $this->getId(),
    $this->getId(),
    $this->getId()
    ]);

    return $motor;
}



//======================================



//================fetch message for msg page=========

public function fetchMessageLimit1(){
    $con=$this->connect();
    $sql="SELECT*FROM pvt WHERE (Recipie=? AND Sender=?) OR (Recipie=? AND Sender=?) ORDER BY id DESC LIMIT 1";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId(),
        $this->getCelular(),
        $this->getCelular(),
        $this->getId()
    ]);

    return $motor;
}

//=======================




public function fetchUnreadMsg(){
    $con=$this->connect();
    $sql="SELECT*FROM pvt WHERE ((Recipie=? AND Sender=?) OR (Recipie=? AND Sender=?)) AND Estado=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId(),
        $this->getCelular(),
        $this->getCelular(),
        $this->getId(),
        'unread'
    ]);

    return $motor;
}

//=======================

//============delete messages====================
public function deletePvt(){
    $con=$this->connect();
    $sql="DELETE FROM pvt WHERE id=?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId()]);
}



//======================================


//============searchUser===================

public function searchUser(){

    $con=$this->connect();
    
    $sql="SELECT*FROM usuarios WHERE Numero LIKE ? OR Nome LIKE ? LIMIT 50";
    $motor=$con->prepare($sql);
    $motor->execute(['%'.$this->getCelular().'%','%'.$this->getCelular().'%']);
    
    return $motor;
    
    
    }
    
    
    //========================


    //============searchUser===================

public function searchUser1(){

    $con=$this->connect();
    
    $sql="SELECT*FROM usuarios WHERE Numero LIKE ? OR Nome LIKE ? LIMIT 10";
    $motor=$con->prepare($sql);
    $motor->execute(['%'.$this->getCelular().'%','%'.$this->getCelular().'%']);
    
    return $motor;
    
    
    }
    
    
    //========================


    
public function searchNextUser(){

    $con=$this->connect();
    
    $sql="SELECT*FROM usuarios WHERE (Numero LIKE ? OR Nome LIKE ?) AND id_user>? LIMIT 10";
    $motor=$con->prepare($sql);
    $motor->execute(['%'.$this->getCelular().'%','%'.$this->getCelular().'%',$this->getId()]);
    
    return $motor;
    
    
    }
    
    
    //========================


    //=========================fetching my msgs for status bar================

public function message(){

    $con=$this->connect();
    $sql="SELECT * FROM pvt WHERE Recipie=? AND Estado<>?";
    $motor=$con->prepare($sql);
    $motor->execute([ 
    $this->getId(),
    'read'
    ]);

    return $motor;
}

 //=========================fetching messages to analytics================

 public function Analyticsmessage(){

    $con=$this->connect();
    $sql="SELECT * FROM pvt WHERE Recipie=? ";
    $motor=$con->prepare($sql);
    $motor->execute([ 
    $this->getId()

    ]);

    return $motor;
}


//========================inserir==notificacao============

public function insertNotification(){
    $con=$this->connect();
    $sql="INSERT INTO Notificacao (id_status) VALUES(?)";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId()]);
}


//=================
//=======================create table Notification===============


public function createTable(){

$con=$this->connect();
$sql="CREATE TABLE NotificacaoView(
id   INT PRIMARY KEY AUTO_INCREMENT,
id_viewer  INT,
id_notificacao INT,
Estado    VARCHAR(40)


)";

}


//===========================================================


//=====================fetch user post======================

public function fetcOnlyPost1(){
    $con=$this->connect();
    $sql="SELECT*FROM posts WHERE id_user=? ORDER BY id_posts ASC";
    $mot=$con->prepare($sql);
    $mot->execute([$this->getId()]);

    return $mot;
}


//=========================================

//===========================insertNotViews========
public function insertNotificationView(){
    $con=$this->connect();
    $sql="INSERT INTO NotificacaoView (id_notificacao,id_viewer,Estado) VALUES(?,?,?)";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId(),$this->getCelular(),'unread']);

}


//==============================================

//=================fetchNotification views================
public function fetchNotificacao(){

    $con=$this->connect();
    $sql="SELECT*FROM NotificacaoView WHERE id_viewer=? AND Estado=?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId(),'unread']);
    return $motor;

}



//==========================================


//============fetchUserViaId===================

public function fetchAllUsers(){

    $con=$this->connect();
    
    $sql="SELECT*FROM usuarios WHERE id_user<>?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId()]);
    
    return $motor;
    
    
    }

//=========================update status notificacao============

public function updateNotView(){
    $con=$this->connect();
    $sql="UPDATE NotificacaoView SET Estado=? WHERE id_viewer=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        'read',
        $this->getId()
    ]);
}


//==================================================

    //=====================fetch posts======================

    public function loadMorePosts1(){
        $con=$this->connect();
        $sql="SELECT*FROM posts  WHERE id_posts<? AND id_posts>0 AND Numero<>? ORDER BY id_posts DESC LIMIT 20 ";
        $mot=$con->prepare($sql);
        $mot->execute([$this->getId(),$this->getCelular()]);
    
        return $mot;
    }
    
    
    //=========================================


    //============fetchUserViaId===================

public function fetchAllUsers1(){

    $con=$this->connect();
    
    $sql="SELECT*FROM usuarios WHERE id_user<>?  ORDER BY id_user ASC LIMIT 20";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId()]);
    
    return $motor;
    
    
    }
//==========================================



    //============fetchUserViaId===================

    public function fetchAllUsers2(){

        $con=$this->connect();
        
        $sql="SELECT*FROM usuarios WHERE id_user<>? AND id_user>? ORDER BY id_user ASC LIMIT 20";
        $motor=$con->prepare($sql);
        $motor->execute([$this->getId(),$this->getNumero()]);
        
        return $motor;
        
        
        }

      //===========================update online user==============

public function updateOffline(){
    $con=$this->connect();

    $sql="UPDATE usuarios SET Estado=? WHERE Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute([time()-500,$this->getCelular()]);
}

//==================end=======================

//=======================update senha================

public function updatePass(){
    $con=$this->connect();
    $sql="UPDATE usuarios SET Senha=? WHERE Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getSenha1(),$this->getCelular()]);
}


//================end==============================

//==============delete account===============

public function removeAccount(){
    $con=$this->connect();
    $sql="DELETE FROM usuarios WHERE Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute(array($this->getCelular()));
}

//=================end==========================

//===============insertAudio=================

public function insertAudio(){
    $con=$this->connect();
    $sql="INSERT INTO especiais (Numero,Ficheiro,Tipo,Titulo,id_user) VALUES(?,?,?,?,?)";
    $motor=$con->prepare($sql);
    $motor->execute(array($this->getCelular(),$this->getProfile(),'audio',$this->getTexto(),$this->getId()));
}


//=================end=================

//==========================fetching Audios======================

public function fetchAudio(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE Tipo=? ORDER BY id DESC LIMIT 15";
    $motor=$con->prepare($sql);
    $motor->execute(['audio']);

    return $motor;
    
}


//=================================================


//==========================fetching Audios======================

public function loadAudio(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE id<? AND id>0 AND Tipo=? ORDER BY id DESC LIMIT 10";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId(),'audio']);

    return $motor;
    
}


//=================================================



//==========================fetching My Audios======================

public function fetchMyAudio(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE Numero=? AND Tipo=? ORDER BY id DESC LIMIT 15";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getCelular(),'audio']);

    return $motor;
    
}


//=================================================

//================deletAudio==========================

public function deleteAudio(){
$con=$this->connect();
$sql="DELETE FROM especiais WHERE id=?";
$motor=$con->prepare($sql);
$motor->execute([$this->getId()]);

}

//=============================================

//====================search Audio=====================
public function searchAudio(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE Titulo LIKE ? AND Tipo=? ORDER BY id DESC LIMIT 30";
    $motor=$con->prepare($sql);
    $motor->execute(['%'.$this->getTexto().'%','audio']);

    return $motor;
}

//====================================


//====================search MyAudio=====================
public function searchMyAudio(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE Titulo LIKE ? AND Tipo=? AND Numero=? ORDER BY id DESC LIMIT 30";
    $motor=$con->prepare($sql);
    $motor->execute(['%'.$this->getTexto().'%','audio',$this->getCelular()]);

    return $motor;
}

//====================================


//==========================fetching Audios======================

public function loadMyAudio(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE id<? AND id>0 AND Numero=? AND Tipo=? ORDER BY id DESC LIMIT 10";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId(),$this->getCelular(),'audio']);

    return $motor;
    
}


//=================================================


//===============insertVideo=================

public function insertVideo(){
    $con=$this->connect();
    $sql="INSERT INTO especiais (Numero,Ficheiro,Tipo,Titulo,id_user) VALUES(?,?,?,?,?)";
    $motor=$con->prepare($sql);
    $motor->execute(array($this->getCelular(),$this->getProfile(),'video',$this->getTexto(),$this->getId()));
}


//=================end=================



//==========================fetching Audios======================

public function fetchVideo(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE Tipo=? ORDER BY id DESC LIMIT 10";
    $motor=$con->prepare($sql);
    $motor->execute(['video']);

    return $motor;
    
}


//=================================================


//================deletVideo==========================

public function deleteVideo(){
    $con=$this->connect();
    $sql="DELETE FROM especiais WHERE id=?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId()]);
    
    }
    
    //=============================================


    //==========================fetching My Audios======================

public function fetchMyVideo(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE Numero=? AND Tipo=? ORDER BY id DESC LIMIT 10";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getCelular(),'video']);

    return $motor;
    
}


//=================================================


//==========================load videos======================

public function loadVideo(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE id<? AND id>0 AND Tipo=? ORDER BY id DESC LIMIT 5";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId(),'video']);

    return $motor;
    
}


//=================================================


//====================search Video=====================
public function searchVideo(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE Titulo LIKE ? AND Tipo=? ORDER BY id DESC LIMIT 30";
    $motor=$con->prepare($sql);
    $motor->execute(['%'.$this->getTexto().'%','video']);

    return $motor;
}

//====================================


//==========================fetching Audios======================

public function loadMyVideo(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE id<? AND id>0 AND Numero=? AND Tipo=? ORDER BY id DESC LIMIT 5";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId(),$this->getCelular(),'video']);

    return $motor;
    
}

//=================================================



//===============insertDoc=================

public function insertDoc(){
    $con=$this->connect();
    $sql="INSERT INTO especiais (Numero,Ficheiro,Tipo,Titulo,id_user) VALUES(?,?,?,?,?)";
    $motor=$con->prepare($sql);
    $motor->execute(array($this->getCelular(),$this->getProfile(),'doc',$this->getTexto(),$this->getId()));
}


//=================end=================


//==========================fetching Audios======================

public function fetchDoc(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE Tipo=? ORDER BY id DESC LIMIT 15";
    $motor=$con->prepare($sql);
    $motor->execute(['doc']);

    return $motor;
    
}


//=================================================

    //==========================fetching My Docs======================

    public function fetchMyDoc(){
        $con=$this->connect();
        $sql="SELECT*FROM especiais WHERE Numero=? AND Tipo=? ORDER BY id DESC LIMIT 15";
        $motor=$con->prepare($sql);
        $motor->execute([$this->getCelular(),'doc']);
    
        return $motor;
        
    }
    
    
    //=================================================


    //==========================load videos======================

public function loadDoc(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE id<? AND id>0 AND Tipo=? ORDER BY id DESC LIMIT 5";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId(),'doc']);

    return $motor;
    
}


//=================================================


//==========================fetching Audios======================

public function loadMyDoc(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE id<? AND id>0 AND Numero=? AND Tipo=? ORDER BY id DESC LIMIT 5";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId(),$this->getCelular(),'doc']);

    return $motor;
    
}


//=================================================

//================deletAudio==========================

public function deleteDoc(){
    $con=$this->connect();
    $sql="DELETE FROM especiais WHERE id=?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId()]);
    
    }
    
    //=============================================


    //====================search Video=====================
public function searchDoc(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE Titulo LIKE ? AND Tipo=? ORDER BY id DESC LIMIT 30";
    $motor=$con->prepare($sql);
    $motor->execute(['%'.$this->getTexto().'%','doc']);

    return $motor;
}

//====================================

//===========================================create group===============

public function insertGroup(){

$con=$this->connect();
$sql="INSERT INTO Grupo (Nome,Numero,Data_Criacao,Descricao) VALUES(?,?,?,?)";
$moto=$con->prepare($sql);
$moto->execute([
$this->getNome(),
$this->getCelular(),
time(),
$this->getTexto()


]);

}

//====================end===========================

//==================check if he has more than five groups==============
public function checkGroup(){
    $con=$this->connect();
    $sql="SELECT*FROM Grupo WHERE Numero=?";
    $motor=$con->prepare($sql);
    $motor->bindValue(1,$this->getCelular(),PDO::PARAM_INT);
    $motor->execute();

    return $motor;
}


//============end================================

//=======================create tableGrupoMembers===============


public function createTableGrupo(){

    $con=$this->connect();
    $sql="CREATE TABLE Membros(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    id_grupo  INT,
    Numero INT,
   Bonus   VARCHAR(40),
    
   FOREIGN KEY  (id_grupo) REFERENCES Grupo(id) ON DELETE CASCADE ON UPDATE NO ACTION
    
    )";
    
    }
    
    
    //====================grupo msg=======================================

    public function createTableGrupoMsg(){

        $con=$this->connect();
        $sql="CREATE TABLE GrupoMsg(
        id   INT PRIMARY KEY AUTO_INCREMENT,
        id_msg  INT,
        Numero INT,
      Mensagem   TEXT,
      Ficheiro   VARCHAR(250),
      Hora        VARCHAR(120),

        
       FOREIGN KEY  (id_msg) REFERENCES Grupo(id) ON DELETE CASCADE ON UPDATE NO ACTION
        
        )";
        
        }
        
        
        //===========================================================

        //==========================check  membros======================

public function checkMembro(){
    $con=$this->connect();
    $sql="SELECT*FROM Membros WHERE Numero=? AND id_grupo=?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getNumero(),$this->getId()]);

    return $motor;
}

        //===============end============================

    //=================insert membros===================
    public function insertMembro(){
  $con=$this->connect();
  $sql="INSERT INTO Membros (id_grupo,Numero) VALUES(?,?)";
  $motor=$con->prepare($sql);
  $motor->execute([$this->getId(),$this->getCelular()]);


    }
    

    //========================================

    //==================check if he has more than five groups==============
public function fetchGroup(){
    $con=$this->connect();
    $sql="SELECT*FROM Grupo WHERE id=?";
    $motor=$con->prepare($sql);
    $motor->bindValue(1,$this->getId(),PDO::PARAM_INT);
    $motor->execute();

    return $motor;
}


//============end================================

//================send Group Msg================

public function sendGroupMsg(){

    $con=$this->connect();
    $sql="INSERT INTO GrupoMsg (id_msg,Numero,Mensagem,Hora,Demo,Demo_Pic) VALUES(?,?,?,?,?,?)";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId(),
        $this->getCelular(),
        $this->getTexto(),
        time(),
        $this->getNome(),
        $this->getTipo()

    ]);
}


//======================end===============================



public function sendGroupFoto(){

    $con=$this->connect();
    $sql="INSERT INTO GrupoMsg (id_msg,Numero,Ficheiro,Hora,Demo,Demo_Pic) VALUES(?,?,?,?,?,?)";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId(),
        $this->getCelular(),
        $this->getProfile(),
        time(),
        $this->getNome(),
        $this->getTipo()
    ]);
}


//======================end===============================

//=========================fetchGroup Message=============

public function fetchGroupMsg(){

    $con=$this->connect();
    $sql="SELECT*FROM GrupoMsg WHERE id_msg=? ORDER BY id DESC LIMIT 20";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId()
    ]);

    return $motor;
}

//=======================================FETCH MEMBROS=============

public function fetchMembro(){
    $con=$this->connect();
    $sql="SELECT*FROM Membros WHERE Numero=? ORDER BY id DESC LIMIT 10";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getNumero()]);

    return $motor;
}

        //===============end============================


        //==============sair do grupo===================
public function sairGrupo(){
    $con=$this->connect();
    $sql="DELETE FROM Membros WHERE Numero=? AND id_grupo=?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getCelular(),$this->getId()]);



    $sql1="DELETE FROM GrupoMsg WHERE Numero=? AND id_msg=?";
    $motor1=$con->prepare($sql1);
    $motor1->execute([$this->getCelular(),$this->getId()]);
}


        //=============================================

        //======================delete group===============
        public function deleteGrupo(){
            $con=$this->connect();
            $sql="DELETE FROM Grupo WHERE  id=?";
            $motor=$con->prepare($sql);
            $motor->execute([$this->getId()]);
        

        }

        //=======================end======================


        //==================fetchAllMembros
public function fetchAllMembros(){
    $con=$this->connect();
    $sql="SELECT*FROM Membros WHERE id_grupo=?";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getId()]);

    return $motor;
}

        //===============end============================


        //=====================update Nome==========================
public function updateGroupName(){
$con=$this->connect();
$sql="UPDATE Grupo SET Nome=? WHERE id=?";
$motor=$con->prepare($sql);
$motor->execute([$this->getNome(),$this->getId()]);

}


        //==================end=======================



        //=========================fetchGroup Message=============

public function groupMsgInfo(){

    $con=$this->connect();
    $sql="SELECT*FROM GrupoMsg WHERE id_msg=? AND id=? ORDER BY id DESC";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId(),
        $this->getNumero()
    ]);

    return $motor;
}
//=======================delete msg group==================


public function deleteGroupMsg(){
    $con=$this->connect();
    $sql="DELETE FROM GrupoMsg WHERE id_msg=? AND id=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId(),
        $this->getNumero()
    ]);
}

//========================load Grupos=====================
public function loadMembro(){
    $con=$this->connect();
    $sql="SELECT*FROM Membros WHERE Numero=? AND id<? AND id>0 ORDER BY id DESC LIMIT 10";
    $motor=$con->prepare($sql);
    $motor->execute([$this->getNumero(),$this->getId()]);

    return $motor;
}

        //===============end============================



//=======================================


//============loadUserOnline===================

public function loadOnlineUser(){

    $con=$this->connect();
    
    $sql="SELECT*FROM usuarios WHERE  Estado>? AND Numero<>? AND id_user>? ORDER BY id_user ASC LIMIT 20";
    $motor=$con->prepare($sql);
    $motor->execute([time(),$this->getCelular(),$this->getId()]);
    
    return $motor;
    
    
    }
    
    
    //========================


    //=======================create table Notification===============


public function createTableGames(){

    $con=$this->connect();
    $sql="CREATE TABLE Games(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    id_user  INT,
    Pontos  INT,
     Game   VARCHAR(40),
     FOREIGN KEY (id_user) REFERENCES usuarios(id_user) ON DELETE CASCADE ON UPDATE NO ACTION
    
    
    )";
    
    }


    //=======================insertUpdateGames===========================

    public function insertGames(){

$con=$this->connect();

$sql="SELECT*FROM Games WHERE id_user=? AND Game=?";
$motor=$con->prepare($sql);
$motor->execute([
    $this->getId(),
    $this->getTexto()
]);

if($motor->rowCount()==0){

$s="INSERT INTO Games (id_user,Game,Pontos) VALUES(?,?,?)";
$moto=$con->prepare($s);
$moto->execute([
    $this->getId(),
    $this->getTexto(),
    $this->getPontos()
]);

}else{

    $u="UPDATE Games SET Pontos=? WHERE id_user=? AND Game=?";

$mot=$con->prepare($u);
$mot->execute([
    $this->getPontos(),
    $this->getId(),
    $this->getTexto()

]);

}

    }
    
//==============ffetch game points========================

public function fetchPoints(){
    $con=$this->connect();

    $sql="SELECT*FROM Games WHERE Game=? AND id_user=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getTexto(),
        $this->getId()
    ]);

    return $motor;
}

//==============ffetch game points========================

public function fetchAllPoints(){
    $con=$this->connect();

    $sql="SELECT*FROM Games WHERE Game=? ORDER BY Pontos DESC";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getTexto()
    ]);

    return $motor;
}

   //====================fetchAll status=================

   public function fetchAllStatus(){
    $con=$this->connect();
    $sql="SELECT*FROM Estado  ORDER BY Id DESC ";
    $motor=$con->prepare($sql);
    $motor->execute();

    return $motor;
}

    //============================================

    
//=======================================FETCH MEMBROS=============

public function fetchAllMembro(){
    $con=$this->connect();
    $sql="SELECT*FROM Grupo ";
    $motor=$con->prepare($sql);
    $motor->execute();

    return $motor;
}

        //===============end============================

        public function fetchAllGrupos(){
            $con=$this->connect();
            $sql="SELECT*FROM Membros ";
            $motor=$con->prepare($sql);
            $motor->execute();
        
            return $motor;
        }
        
                //===============end============================
        
//=============================fetchComments=============
public function fetchAllComments(){
    $con=$this->connect();
    $sql="SELECT*FROM comentarios ";
    $mot=$con->prepare($sql);
    $mot->execute();

    return $mot;
}


//================fetch message=========

public function fetchAllMessage(){
    $con=$this->connect();
    $sql="SELECT*FROM pvt ";
    $motor=$con->prepare($sql);
    $motor->execute();

    return $motor;
}

//=======================


//=================fetchLikes==================
public function fetchAllLikes(){

    $con=$this->connect();
    $sql="SELECT*FROM likes ";
    $motor=$con->prepare($sql);
    $motor->execute();

    return $motor;
}
//===================================

//============================delete Audio from server====================

public function fetchAudioToDel(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE Tipo=? AND Id=? ORDER BY id DESC LIMIT 15";
    $motor=$con->prepare($sql);
    $motor->execute(['audio',$this->getId()]);

    return $motor;
    
}


//=================================================

//============================delete video from server====================

public function fetchVideoToDel(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE Tipo=? AND Id=? ORDER BY id DESC LIMIT 15";
    $motor=$con->prepare($sql);
    $motor->execute(['video',$this->getId()]);

    return $motor;
    
}


//=================================================

//============================delete Doc from server====================

public function fetchDocToDel(){
    $con=$this->connect();
    $sql="SELECT*FROM especiais WHERE Tipo=? AND Id=? ORDER BY id DESC LIMIT 15";
    $motor=$con->prepare($sql);
    $motor->execute(['doc',$this->getId()]);

    return $motor;
    
}


//=================================================

//============fetchUserOnline===================

public function fetchOnlineUserNoLimit(){

    $con=$this->connect();
    
    $sql="SELECT*FROM usuarios WHERE  Estado>? AND Numero<>? ";
    $motor=$con->prepare($sql);
    $motor->execute([time(),$this->getCelular()]);
    
    return $motor;
    
    
    }
    
    
    //========================

    //================fetchBloqueio=========================


    public function fetchBlock(){
        $con=$this->connect();
        $sql="SELECT*FROM Bloqueio WHERE (Id_bloqueiado=? AND Id_bloqueiador=?) OR (Id_bloqueiado=? AND Id_bloqueiador=?)";
        $motor=$con->prepare($sql);
        $motor->execute([
            $this->getNumero(),
            $this->getCelular(),
            $this->getCelular(),
            $this->getNumero()
        ]);

        return $motor;
    }

    //======================insert bloqueio=====================

    public function insertBloqueio(){

        if($this->fetchBlock()->rowCount()==0){
        $con=$this->connect();
        $sql="INSERT INTO Bloqueio (Id_bloqueiado,Id_bloqueiador) VALUES(?,?)";
        $motor=$con->prepare($sql);
        $motor->execute(array($this->getNumero(),$this->getCelular()));
        }
    }

    //=================delete bloqueio====================


    public function deleteBlock(){
        $con=$this->connect();
        $sql="DELETE FROM Bloqueio WHERE id=?";
        $motor=$con->prepare($sql);
        $motor->execute([$this->getId()]);

    }


    //=========================loadGroup Message=============

public function loadGroupMsg(){

    $con=$this->connect();
    $sql="SELECT*FROM GrupoMsg WHERE id_msg=? AND id<? AND id>0 ORDER BY id DESC LIMIT 20";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId(),
        $this->getCelular()
    ]);

    return $motor;
}


//==============callchat==================


public function call(){
    $con=$this->connect();

    $sq="SELECT*FROM  CallChat WHERE (recipie=? AND sender=?) OR (recipie=? AND sender=?)";
    $m=$con->prepare($sq);
    $m->execute([
        $this->getNumero(),
        $this->getCelular(),
        $this->getCelular(),
        $this->getNumero()
    ]);

if($m->rowCount()==0){
    $sql="INSERT INTO CallChat (sender,recipie,time,disponibilidade) VALUES(?,?,?,?)";
    $moto=$con->prepare($sql);
    $moto->execute([
        $this->getCelular(),
        $this->getNumero(),
        time(),
        '0'
    ]);
}
}

//====================checking if I got call======================

public function checkCall(){
    $con=$this->connect();
    $sql="SELECT*FROM CallChat WHERE recipie=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId()
    ]);

    return $motor;
}


//======================change theme=======================================

public function changeTheme(){

    $con=$this->connect();
    $sql="UPDATE usuarios SET theme=? WHERE Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getTexto(),
        $this->getCelular()
    ]);

}

//===================sendStatusResponse====================


public function sendStatusResponse(){
    $con=$this->connect();
    $sql="INSERT INTO pvt (Recipie,Sender,Mensagem,Hora,Numero,id_user,Estado,Demo_Msg,Demo_Type) VALUES(?,?,?,?,?,?,?,?,?)";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getNumero(),
        $this->getCelular(),
        $this->getTexto(),
        time(),
        $this->getCelular(),
        $this->getId(),
     "unread",
     $this->getProfile(),
     $this->getTipo()
    ]);
}

///=====end=======================

//=========================fetchGroup Message=============

public function fetchGroupMsgViaId(){

    $con=$this->connect();
    $sql="SELECT*FROM GrupoMsg WHERE id=? ORDER BY id DESC LIMIT 20";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId()
    ]);

    return $motor;
}


public function follow(){
    $con=$this->connect();
    $sql="SELECT*FROM followers WHERE Follower=? AND Followed=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getCelular(),
        $this->getNumero()
    ]);

    //============se nao estiver seguindo========================
    if($motor->rowCount()==0){
        $sql1="INSERT INTO followers (Follower,Followed) VALUES(?,?)";
        $motor1=$con->prepare($sql1);
        $motor1->execute([
         $this->getCelular(),
         $this->getNumero()
        ]);

        //=========================se ja estiver seguindo==================
    }else{
   $sql2="DELETE FROM followers WHERE Follower=? AND Followed=?";
   $motor2=$con->prepare($sql2);
   $motor2->execute([
    $this->getCelular(),
    $this->getNumero()
   ]);

    }


}

public function fetchFollower(){
    $con=$this->connect();
        //=====================retornar numero de seguidores total=================
        $sql3="SELECT*FROM followers WHERE Followed=?";
        $motor3=$con->prepare($sql3);
        $motor3->execute([
    $this->getNumero()
        ]);
    
    
    return $motor3->rowCount();
}

public function fetchFollowing(){
    $con=$this->connect();
        //=====================retornar numero de seguidores total=================
        $sql3="SELECT*FROM followers WHERE Follower=?";
        $motor3=$con->prepare($sql3);
        $motor3->execute([
    $this->getNumero()
        ]);
    
    
    return $motor3->rowCount();
}


public function checkFollow(){
    $con=$this->connect();
    $sql="SELECT*FROM followers WHERE Follower=? AND Followed=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getCelular(),
        $this->getNumero()
    ]);

    return $motor;
}


    //====================fetchMyStatusNoLimit=================

    public function fetchMyStatusNoLimit(){
        $con=$this->connect();
        $sql="SELECT*FROM Estado WHERE Numero=? AND Timer>? ORDER BY Id DESC ";
        $motor=$con->prepare($sql);
        $motor->execute([
        $this->getCelular(),
        time()
        ]);
    
        return $motor;
    }


       //====================fetchStatusNoLimit=================

   public function fetchStatusNoLimit(){
    $con=$this->connect();
    $sql="SELECT*FROM Estado WHERE Numero=? AND Timer>? ORDER BY Id DESC ";
    $motor=$con->prepare($sql);
    $motor->execute([
    $this->getCelular(),
    time()
    ]);

    return $motor;
}

//======inserir convite de jogo==========

public function enviarPedidoDeJogo(){
    $con=$this->connect();
    $sql="SELECT*FROM gameDeDois WHERE (id_convidado=? AND id_convite=?) OR (id_convidado=? AND  id_convite=?)";
    $motor=$con->prepare($sql);
    $motor->execute(array($this->getId(),$this->getCelular(),$this->getId(),$this->getCelular()));

    if($motor->rowCount()==0){
      
     $sql1="INSERT INTO gameDeDois (id_convite,id_convidado,Tempo_Jogo,Estado,whoPlays) VALUES(?,?,?,?,?)";

     $motor1=$con->prepare($sql1);
     $motor1->execute([$this->getCelular(),$this->getId(),time()+50,'Pendente',0]);



    }
}

//=========verificr se o jogo foi aceite ou nao

public function verificarEstadoDoJoGo(){
    $con=$this->connect();
    $sql="SELECT*FROM gameDeDois WHERE (id_convidado=? AND id_convite=?) OR (id_convidado=? AND  id_convite=?)";
    $motor=$con->prepare($sql);
    $motor->execute(array($this->getId(),$this->getCelular(),$this->getId(),$this->getCelular()));

    return $motor;
}

//=============aceitar pedidos de jogo

public function fetchPedidoJogo(){
    $con=$this->connect();
    $sql="SELECT*FROM gameDeDois WHERE id_convidado=? AND Estado=?";
    $motor=$con->prepare($sql);
    $motor->execute(array($this->getId(),'Pendente'));

    return $motor;
}

public function aceitarPedidoDeJogo(){
    $con=$this->connect();
    $sql="UPDATE gameDeDois SET Estado=?,whoPlays=? WHERE  (id_convidado=? AND id_convite=?)";
$motor=$con->prepare($sql);
$motor->execute(['Aceite',$this->getId(),$this->getCelular(),$this->getId()]);
}

//=============update gametime
public function updatePlay(){
    $con=$this->connect();
    $sql="UPDATE gameDeDois SET Tempo_Jogo=? WHERE  (id_convidado=? AND id_convite=?)";
    $motor=$con->prepare($sql);
    $motor->execute([
        time()+10,
        $this->getId(),
        $this->getCelular()
    ]);
  
}

//===========delete expired play
public function deletePlay(){
    $con=$this->connect();
    $sql="DELETE FROM gameDeDois WHERE   Tempo_Jogo<?";
    $motor=$con->prepare($sql);
    $motor->execute([
      time()
    ]);
  
}

//=============aceitar pedidos de jogo

public function fetchPlayer(){
    $con=$this->connect();
    $sql="SELECT*FROM gameDeDois WHERE (id_convidado=? OR id_convite=?) AND Estado=? ";
    $motor=$con->prepare($sql);
    $motor->execute(array($this->getId(),$this->getId(),'Aceite'));

    return $motor;
}

//=============jogadas

public function jogadas(){
    $dado="Dado".$this->getNumero();
    $con=$this->connect();
    $sql="UPDATE gameDeDois SET $dado=?,whoPlays=? WHERE id_convidado=? AND id_convite=?";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getTexto(),
        $this->getTipo(),
        $this->getId(),
        $this->getCelular()
    ]);
}

public function CondicoesDeJogadas(){
    $con=$this->connect();
$sql="SELECT*FROM gameDeDois WHERE id_convidado=? AND id_convite=?";
$motor=$con->prepare($sql);
$motor->execute([
    $this->getId(),
    $this->getCelular()
]);

return $motor;
}

//===================================escrevendo================

//================fetch message=========

public function escrevendo(){
    $con=$this->connect();
    $sql="SELECT*FROM pvt WHERE (Recipie=? AND Sender=? AND Mensagem=?) OR (Recipie=? AND Sender=? AND Mensagem=?)";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId(),
        $this->getCelular(),
        '',
        $this->getCelular(),
        $this->getId(),
        ''
    ]);

    return $motor;
}

//============delete messages====================
public function deleteEscrevendo(){
    $con=$this->connect();
    $sql="DELETE FROM pvt WHERE (Recipie=? AND Sender=? AND Mensagem=?) OR (Recipie=? AND Sender=? AND Mensagem=?)";
    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getId(),
        $this->getCelular(),
        '',
        $this->getCelular(),
        $this->getId(),
        ''

    ]);
}

//===================who's typing

public function typing(){
    $con=$this->connect();
    $sql="UPDATE pvt SET Demo_Msg=? WHERE (Recipie=? AND Sender=? AND Mensagem=?) OR (Recipie=? AND Sender=? AND Mensagem=?)";

    $motor=$con->prepare($sql);
    $motor->execute([
        $this->getNumero(),
        $this->getId(),
        $this->getCelular(),
        '',
        $this->getCelular(),
        $this->getId(),
        ''

    ]);
}
}




