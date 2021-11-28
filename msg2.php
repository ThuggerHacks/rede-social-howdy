<?php session_start();

include 'classes/Manager.class.php';

//======getting messages if I'm the sender
if(isset($_REQUEST['me'])){

//==================fetching only one message==========================

$man=new Manager();
$new=new Manager();
$man->setCelular($_SESSION['Numero']);
$id=0;

//=====================fetching user id=======================
foreach($man->fetchUser() as $linha){
$id=$linha['id_user'];
}
$man->setId($id);

//=========================fetching the nname of the senders================

if($man->fetchOnepvt()->rowCount()==0){
    echo "<div class='card' style='text-align:center'>Nao existem mensagens aqui</div>";
    exit;
}
foreach($man->fetchOnepvt() as $l){

    if($l['id_user']!=$id){
         echo '<a href="mensagem.php?x='.base64_encode($l['id_user']).'" style="text-decoration:none;color:black"><div  style="padding:5px;border-bottom:1px solid #ccc;margin:5px">';
    $nome=new Manager();
    $nome->setId($l['id_user']);

    foreach($nome->fetchUserViaId() as $linha){
      
        if($linha['Avatar']!=''){
            echo '<b><img src="img/avatar/'.$linha['Avatar'].'" width=30 height=30 style="border-radius:50%"> '.$linha['Nome'].'</b><br>';
        }else if($linha['Avatar']=='' and $linha['Sexo']=='Masculino'){
            echo '<b><img src="files/male.png" width=30 height=30 > '.$linha['Nome'].'</b><br>';
        }else{
            echo '<b><img src="files/female.png" width=30 height=30 > '.$linha['Nome'].'</b><br>';
        }

    
    }
    
 
    $new->setId($l['id_user']);
    $new->setCelular($id);
    //===================fetching messages====================
    
    foreach($new->fetchMessageLimit1() as $li){
   if($li['Mensagem']!=''){

         if($li['Sender']==$id){
             
                if($li['Estado']=='unread'){
                    echo '<small><b>Voce: </b>'.substr($li['Mensagem'],0,30).' <img src="svgs/solid/check.svg" width=20 height=15></small>';
                }else{
                    echo '<small><b>Voce: </b>'.substr($li['Mensagem'],0,30).' <img src="svgs/solid/check-double.svg" width=20 height=15 class="text-primary"></small>';
                }

         }else{
               if($li['Estado']=='unread'){
                echo '<small><b>'.$linha['Nome'].'</b>: '.substr($li['Mensagem'],0,30).' <span class="bg-primary text-light" style="padding:4px">'.$new->fetchUnreadMsg()->rowCount().'</span></small>';
                    }else{
                        echo '<small><b>'.$linha['Nome'].'</b>: '.substr($li['Mensagem'],0,30).'</small>';
                    }
           
         }
    
    }else{
        //====================mostrar mensagens lidas e nao lidas do usuario=============
        if($li['Sender']==$id){
             
            if($li['Estado']=='unread'){
                echo '<small><b>Voce: </b>enviou uma <img src="svgs/solid/camera.svg" width=20 height=20> Foto <img src="svgs/solid/check.svg" width=20 height=15></small>';
            }else{
                echo '<small><b>Voce: </b>enviou uma <img src="svgs/solid/camera.svg" width=20 height=20> Foto <img src="svgs/solid/check-double.svg" width=20 height=15 class="text-primary"></small>';
            }
//======================end===============================================
           
        }else{
            //===========================numero de mensagens recebidas===============

            if($li['Estado']=='unread'){
                echo '<small><b>'.$linha['Nome'].': </b><img src="svgs/solid/camera.svg" width=20 height=20> Foto <span class="bg-primary text-light" style="padding:4px">'.$new->fetchUnreadMsg()->rowCount().'</span></small>';
            }else{
                echo '<small><b>'.$linha['Nome'].':  </b>enviou uma <img src="svgs/solid/camera.svg" width=20 height=20> Foto</small>';
            }
         
        }
   
    }
    //===========================================end==============
}
    
   echo ' </div></a>';

    }

}
    //=getting messages if he is the sender

}else if(isset($_REQUEST['me1'])){

    $man=new Manager();
$new=new Manager();
$man->setCelular($_SESSION['Numero']);
$id=0;

//=====================fetching user id=======================
foreach($man->fetchUser() as $linha){
$id=$linha['id_user'];
}
$man->setId($id);



if($man->fetchOnepvt()->rowCount()==0){
    echo "<div class='card' style='text-align:center'>Nao existem mensagens aqui</div>";
    exit;
}
foreach($man->fetchOnepvt() as $l){
    if($l['id_user']==$id){
    echo '<a href="mensagem.php?x='.base64_encode($l['Recipie']).'" style="text-decoration:none;color:black"><div  style="padding:5px;border-bottom:1px solid #ccc;margin:5px">';
    $nome=new Manager();
    $nome->setId($l['Recipie']);

    foreach($nome->fetchUserViaId() as $linha){
      
        if($linha['Avatar']!=''){
            echo '<b><img src="img/avatar/'.$linha['Avatar'].'" width=30 height=30 style="border-radius:50%"> '.$linha['Nome'].'</b><br>';
        }else if($linha['Avatar']=='' and $linha['Sexo']=='Masculino'){
            echo '<b><img src="files/male.png" width=30 height=30 > '.$linha['Nome'].'</b><br>';
        }else{
            echo '<b><img src="files/female.png" width=30 height=30 > '.$linha['Nome'].'</b><br>';
        }

    
    }
    
 
    $new->setId($l['Recipie']);
    $new->setCelular($id);
    //===================fetching messages====================
    
    foreach($new->fetchMessageLimit1() as $li){
   if($li['Mensagem']!=''){

         if($li['Sender']==$id){
             
                if($li['Estado']=='unread'){
                    echo '<small><b>Voce: </b>'.substr($li['Mensagem'],0,30).' <img src="svgs/solid/check.svg" width=20 height=15></small>';
                }else{
                    echo '<small><b>Voce: </b>'.substr($li['Mensagem'],0,30).' <img src="svgs/solid/check-double.svg" width=20 height=15 class="text-primary"></small>';
                }

         }else{
               if($li['Estado']=='unread'){
                echo '<small><b>'.$linha['Nome'].'</b>: '.substr($li['Mensagem'],0,30).' <span class="bg-primary text-light" style="padding:4px">'.$new->fetchUnreadMsg()->rowCount().'</span></small>';
                    }else{
                        echo '<small><b>'.$linha['Nome'].'</b>: '.substr($li['Mensagem'],0,30).'</small>';
                    }
           
         }
    
    }else{
        //====================mostrar mensagens lidas e nao lidas do usuario=============
        if($li['Sender']==$id){
             
            if($li['Estado']=='unread'){
                echo '<small><b>Voce: </b>enviou uma <img src="svgs/solid/camera.svg" width=20 height=20> Foto <img src="svgs/solid/check.svg" width=20 height=15></small>';
            }else{
                echo '<small><b>Voce: </b>enviou uma <img src="svgs/solid/camera.svg" width=20 height=20> Foto <img src="svgs/solid/check-double.svg" width=20 height=15 class="text-primary"></small>';
            }
//======================end===============================================
           
        }else{
            //===========================numero de mensagens recebidas===============

            if($li['Estado']=='unread'){
                echo '<small><b>'.$linha['Nome'].': </b><img src="svgs/solid/camera.svg" width=20 height=20> Foto <span class="bg-primary text-light" style="padding:4px">'.$new->fetchUnreadMsg()->rowCount().'</span></small>';
            }else{
                echo '<small><b>'.$linha['Nome'].':  </b>enviou uma <img src="svgs/solid/camera.svg" width=20 height=20> Foto</small>';
            }
         
        }
   
    }
}
echo ' </div></a>';
    }

    //===========================================end==============
}

}


