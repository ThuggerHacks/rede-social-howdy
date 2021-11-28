<?php session_start();

include 'incluir.php';
include 'conexao.php';
//===================================verificar sessao============================

if(!isset($_SESSION['Numero'])){
    echo "<section id='e'>Fa&ccedil;a login para ver esta pagina<hr><a href='index.php'>LogIn</a></section>";
    exit;
}

if(isset($_REQUEST['n'])){
    
 
    $sql="DELETE FROM pvt WHERE Hora=? AND Sender=?";
    $motor=$con->prepare($sql);
    $motor->execute(array($_REQUEST['n'],$_SESSION['Numero']));
    unlink('img/sent/'.$_REQUEST['f']);
    header("location:conversa.php?x=".$_REQUEST['c']);
}

if(isset($_REQUEST['n1'])){


    $sql="DELETE FROM posts WHERE Hora=? AND Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute(array($_REQUEST['n1'],$_SESSION['Numero']));

    //=========================delete todos os comentarios do posts====================


    $sql="DELETE FROM comentarios WHERE Hora=? AND Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute(array($_REQUEST['n1'],$_SESSION['Numero']));


//=========================DELETING LIKES======================


    $sql="DELETE FROM likes WHERE Hora=? AND Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute(array($_REQUEST['n1'],$_SESSION['Numero']));

    unlink('img/img/'.$_REQUEST['v']);
    header("location:avancar.php");
}

if(isset($_REQUEST['h1'])){
  
    $sql="DELETE FROM comentarios WHERE Hora_Comentario=? AND Numero_poster=?";
    $motor=$con->prepare($sql);
    $motor->execute(array($_REQUEST['h1'],$_SESSION['Numero']));
    unlink('img/img/'.$_REQUEST['v']);
    header("location:coment.php?n=".urlencode($_REQUEST['n'])."&c=".urlencode($_REQUEST['c'])."&h=".urlencode($_REQUEST['h']));
}

if(isset($_REQUEST['x1'])){

    $sql="DELETE FROM posts WHERE Hora=? AND Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute(array($_REQUEST['x1'],$_SESSION['Numero']));

    //=========================delete todos os comentarios do posts====================


    $sql="DELETE FROM comentarios WHERE Hora=? AND Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute(array($_REQUEST['x1'],$_SESSION['Numero']));


//=========================DELETING LIKES======================

 
    $sql="DELETE FROM likes WHERE Hora=? AND Numero=?";
    $motor=$con->prepare($sql);
    $motor->execute(array($_REQUEST['x1'],$_SESSION['Numero']));

    unlink('img/img/'.$_REQUEST['v']);
    header("location:posts.php");

}

//=====================delete video=====================
if(isset($_REQUEST['video'])){

unlink('img/video/'.$_REQUEST['video']);

$sql="DELETE FROM especiais WHERE Ficheiro=?";
$moto=$con->prepare($sql);
$moto->execute(array($_REQUEST['video']));
header("location:especial.php");

}

//=========================delete audio========================
if(isset($_REQUEST['audio'])){

    unlink('img/audio/'.$_REQUEST['audio']);
    
    $sql="DELETE FROM especiais WHERE Ficheiro=?";
    $moto=$con->prepare($sql);
    $moto->execute(array($_REQUEST['audio']));
    header("location:especial.php?a=".md5("a"));
    
    }
//=============================delet docs======================
    if(isset($_REQUEST['doc'])){

        unlink('img/doc/'.$_REQUEST['doc']);
        
        $sql="DELETE FROM especiais WHERE Ficheiro=?";
        $moto=$con->prepare($sql);
        $moto->execute(array($_REQUEST['doc']));
        header("location:especial.php?d=".md5("d"));
        
        }

        //=====================delete posts from groups===============

        if(isset($_REQUEST['nome']) and !isset($_REQUEST['h'])){

            
unlink("img/group/img/".$_REQUEST['file']);
unlink("img/group/video/".$_REQUEST['file']);

$s1="DELETE FROM Grupo WHERE Sender=? AND Hora_Post=? AND id_membro=?";
$mt=$con->prepare($s1);
$mt->execute(array($_SESSION['Numero'],$_REQUEST['data'],$_REQUEST['id']));

//============================delete coments=================

$s1="DELETE FROM comentarios WHERE  Numero=? AND Hora=?";
$mt=$con->prepare($s1);
$mt->execute(array($_SESSION['Numero'],$_REQUEST['data']));

header("location:grupo.php?nome=".urlencode($_REQUEST['nome'])."&numero=".$_REQUEST['numero']."&id=".$_REQUEST['id']."&data=".$_REQUEST['data1']."&avatar=".urlencode($_REQUEST['avatar']));



        }
        //============delete comments from groups============

        if(isset($_REQUEST['nome1']) ){
            unlink("img/group/img/".$_REQUEST['file']);
            unlink("img/group/video/".$_REQUEST['file']);
            
            //============================delete coments=================
            
            $s1="DELETE FROM comentarios WHERE  Numero_poster=? AND Hora_Comentario=? AND Numero=?";
            $mt=$con->prepare($s1);
            $mt->execute(array($_SESSION['Numero'],$_REQUEST['data'],$_REQUEST['numero']));
            
            header("location:grupo1.php?n=".$_REQUEST['n']."&h=".$_REQUEST['h']."&c=".urlencode($_REQUEST['c'])."&nome=".urlencode($_REQUEST['nome'])."&numero=".$_REQUEST['numero2']."&avatar=".$_REQUEST['avatar']."&data=".$_REQUEST['data2']."&id=".$_REQUEST['id']);
            
            
            
                    }

                    //================================adm deliting posts===================


                    if(isset($_REQUEST['h18'])){

                       

            
                            unlink("img/group/img/".$_REQUEST['file']);
                            unlink("img/group/video/".$_REQUEST['file']);
                            
                            $s1="DELETE FROM Grupo WHERE Sender=? AND Hora_Post=? AND id_membro=?";
                            $mt=$con->prepare($s1);
                            $mt->execute(array($_REQUEST['h18'],$_REQUEST['data'],$_REQUEST['id']));
                            
                            //============================delete coments=================
                            
                            $s1="DELETE FROM comentarios WHERE  Numero=? AND Hora=?";
                            $mt=$con->prepare($s1);
                            $mt->execute(array($_REQUEST['h18'],$_REQUEST['data']));
                            
                            header("location:grupo.php?nome=".urlencode($_REQUEST['nome'])."&numero=".$_REQUEST['numero']."&id=".$_REQUEST['id']."&data=".$_REQUEST['data1']."&avatar=".urlencode($_REQUEST['avatar'])."&h18=h");
                            
                            
                            
                                    

                    }

                    //==============================delete status=====================

                    if(isset($_REQUEST['next'])){

                   unlink('img/status/'.$_REQUEST['fich']);
                        $sql="DELETE FROM Estado WHERE Id=?";
                        $m=$con->prepare($sql);
                        $m->execute(array($_REQUEST['next']));
                        header("location:avancar.php");

                    }


                    $con=null;