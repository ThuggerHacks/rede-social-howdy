<?php session_start();

include 'classes/Manager.class.php';

if(isset($_REQUEST['m'])){

$m=new Manager();
$m->setId($_REQUEST['g']);

$user=new Manager();
$user->setId($_REQUEST['m']);
$id=0;
foreach($user->fetchUserViaId() as $li){
    $id=$li['Numero'];
}

$m->setCelular($id);


    $m->insertMembro();
 echo "Membro";




}else if(isset($_REQUEST['mr'])){

    //===============remove group member==================
    
    $re=new Manager();
    $re1=new Manager();
    $re1->setId($_REQUEST['gi1']);
    $re->setId($_REQUEST['mr']);
$id1=0;
    foreach($re->fetchUserViaId() as $linh){
        $id1=$linh['Numero'];
    }


$re1->setCelular($id1);
    $re1->sairGrupo();

    echo "Removido";
    
    
    
    
    
        }else if(isset($_REQUEST['info'])){
//====================group  info============================

//===========my fetch Message====================

$m11=new Manager();

    
$m11->setNumero($_REQUEST['info']);
$m11->setId($_REQUEST['id']);

foreach($m11->groupMsgInfo() as $linha){



    echo "<div id='inf1' class='alert alert-info'>";
 
    echo "<div id='st'>";
    
    
   
        echo "<style>
        #inf1{";
    
         
       
 
            echo "display:inline-flex;
            position:absolute;
            top:20%;
            left:20%;
            word-wrap:break-word;
            border:1px solid black;
            padding:10px;
        }
    
    
      @media screen and (max-width:991px){
          #inf1{
               
          left:10%; 
          margin:auto;
          }
       
      }
          
        
        </style>";
    

        $time=localtime($linha['Hora'],true);
        $mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
        
        echo "<strong>Enviado: ".$time['tm_mday']." ".$mes[$time['tm_mon']]." "." ".date('Y',$linha['Hora']).", ".$time['tm_hour'].":".$time['tm_min']."</strong>";
       
 
        echo "<br><span class='text-primary' onclick='answer(".$_REQUEST['info'].",".$_REQUEST['id'].")'>Responder</span>";

        echo "<br><span class='text-danger' onclick='msgDel(".$_REQUEST['info'].",".$_REQUEST['id'].")'>delete</span";
       
       
      
    echo "</div>";
    
    echo "</div>";
    
    
    //================end===========================



    }
//=====================end=====================================


        }else if(isset($_REQUEST['info1'])){


//===========my fetch Message====================

$m11=new Manager();

    
$m11->setNumero($_REQUEST['info1']);
$m11->setId($_REQUEST['id1']);

foreach($m11->groupMsgInfo() as $linha){



    echo "<div id='inf1' class='alert alert-warning'>";
 
    echo "<div id='st'>";
    
    
   
        echo "<style>
        #inf1{";
    
         
       
 
            echo "display:inline-flex;
            position:absolute;
            top:20%;
            left:20%;
            word-wrap:break-word;
            border:1px solid black;
            padding:10px;
        }
    
    
      @media screen and (max-width:991px){
          #inf1{
               
          left:10%; 
          margin:auto;
          }
       
      }
          
        
        </style>";
    

        $time=localtime($linha['Hora'],true);
        $mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
        
        echo "<strong>Recebido: ".$time['tm_mday']." ".$mes[$time['tm_mon']]." "." ".date('Y',$linha['Hora']).", ".$time['tm_hour'].":".$time['tm_min']."</strong>";

        echo "<br><span class='text-primary' onclick='answer(".$_REQUEST['info1'].",".$_REQUEST['id1'].")'>Responder</span>";


        if($linha['Ficheiro']!=''  && $linha['Ficheiro']!='liked'){
            echo "<div class='text-primary'><a href='img/sent/".$linha['Ficheiro']."' download='img/sent/".$linha['Ficheiro']."'>download</a></div>";
        }
    
    echo "</div>";
    
    echo "</div>";
    
    
    //================end===========================



    }


        }else if(isset($_REQUEST['del'])){

//=============delete group msg=============================

$del=new Manager();
$del->setId($_REQUEST['delid']);
$del->setNumero($_REQUEST['del']);

foreach($del->groupMsgInfo() as $linha){
    if($linha['Ficheiro']!=''){
    if(file_exists('img/sent/'.$linha['Ficheiro'])){
        unlink('img/sent/'.$linha['Ficheiro']);
    }
}
}
$del->deleteGroupMsg();


//==============fetchMessg to append==========================


//===================mensagens=============================

$m11=new Manager();


$m12=new Manager();
$m11->setId($_REQUEST['delid']);



$msg=0;
foreach($m11->fetchGroupMsg() as $linha){

$msg=$linha['id'];


    if($linha['Numero']==$_SESSION['Numero']){


if($linha['Ficheiro']!=''){

    $fich="";
    if($linha['Ficheiro']=='liked'){
        $fich="<img src='files/liked.png' width=70 height=70>";
    }else{
        $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
    }

    echo "<div id='p1' >";
    
    //===============getting name and profile of the sender============

    $m12->setCelular($linha['Numero']);
    
    foreach($m12->fetchUser() as $lin){

        if($lin['Avatar']!=''){
            echo "<strong ><div class='d-inline'><img src='img/avatar/".$lin['Avatar']."' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }else if($lin['Avatar']=='' and $lin['Sexo']=='Masculino'){
            echo "<strong ><div class='d-inline'><img src='files/male.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }else{

            echo "<strong ><div class='d-inline'><img src='files/female.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }
       
    }
//==========================end===========================================

//==========================fetch message foto============================
echo "<div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".$_REQUEST['delid'].")'>";

echo "<br>";
  //============demo==============
  if($linha['Demo']!=''){
    echo "<div class='bg-info' style='padding:4px;margin-right:5px;border-radius:10px;font-weight:bolder'>".$linha['Demo']."<br>".$linha['Demo_Pic']."</div>";
}

echo $fich."</div></div>";

}else{
    

    echo "<div id='p1' >";
    
        //===============getting name and profile of the sender============
    $m12->setCelular($linha['Numero']);
    
    foreach($m12->fetchUser() as $lin){

        if($lin['Avatar']!=''){
            echo "<strong ><div class='d-inline'><img src='img/avatar/".$lin['Avatar']."' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }else if($lin['Avatar']=='' and $lin['Sexo']=='Masculino'){
            echo "<strong ><div class='d-inline'><img src='files/male.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }else{

            echo "<strong ><div class='d-inline'><img src='files/female.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }
       
    }
    //==============================end=============================

    //============================fetchMessage=============================
    
    echo "<div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".$_REQUEST['delid'].")'>";
      //============demo==============
      if($linha['Demo']!=''){
        echo "<div class='bg-info' style='padding:4px;margin-right:5px;border-radius:10px;font-weight:bolder'>".$linha['Demo']."<br>".$linha['Demo_Pic']."</div>";
    }
    
    
    echo $linha['Mensagem']."</div></div><br>";
}

      

    }else{

        if($linha['Ficheiro']!=''){
            $fich="";
            if($linha['Ficheiro']=='liked'){
                $fich="<img src='files/liked.png' width=70 height=70>";
            }else{
                $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
            }
    

        echo "<div  id='p2'>";
            //===============getting name and profile of the sender============
        $m12->setCelular($linha['Numero']);
    
        foreach($m12->fetchUser() as $lin){
    
            if($lin['Avatar']!=''){
                echo "<strong ><div class='d-inline'><img src='img/avatar/".$lin['Avatar']."' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }else if($lin['Avatar']=='' and $lin['Sexo']=='Masculino'){
                echo "<strong ><div class='d-inline'><img src='files/male.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }else{
    
                echo "<strong ><div class='d-inline'><img src='files/female.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }
           
        }
//===================================end=================================

//===================================fetch my foto msg================

        echo "<div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].",".$_REQUEST['delid'].")'>";
          //============demo==============
          if($linha['Demo']!=''){
            echo "<div class='bg-info' style='padding:4px;margin-right:5px;border-radius:10px;font-weight:bolder'>".$linha['Demo']."<br>".$linha['Demo_Pic']."</div>";
        }
        
        echo $fich."</div></div>";
    }else{

        echo "<div  id='p2'>";
            //===============getting name and profile of the sender============
        $m12->setCelular($linha['Numero']);
    
        foreach($m12->fetchUser() as $lin){
    
            if($lin['Avatar']!=''){
                echo "<strong ><div class='d-inline'><img src='img/avatar/".$lin['Avatar']."' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }else if($lin['Avatar']=='' and $lin['Sexo']=='Masculino'){
                echo "<strong ><div class='d-inline'><img src='files/male.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }else{
    
                echo "<strong ><div class='d-inline'><img src='files/female.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }
           
        }
        
        //==================================end============================

        //====================fetch my msg============================
        echo "<div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].",".$_REQUEST['delid'].")'>";
          //============demo==============
          if($linha['Demo']!=''){
            echo "<div class='bg-info' style='padding:4px;margin-right:5px;border-radius:10px;font-weight:bolder'>".$linha['Demo']."<br>".$linha['Demo_Pic']."</div>";
        }
        
        echo $linha['Mensagem']."</div></div>";

    }
    }

   
}
 

echo "<input type='hidden' data-id='".$msg."' data-group='".$_REQUEST['del']."' id='moreG1'>";

//=============end===============================================

        }else if(isset($_REQUEST['load'])){

            //================load more grupos=======================
//===============other groups=====================

$fetch=new Manager();
$fetch->setNumero($_SESSION['Numero']);
$fetch->setId($_REQUEST['load']);
$i=0;
if($fetch->loadMembro()->rowCount()==0){
echo "<br><div class='container'><div class='card'><center>Vo&ccedil;e nao tem mais grupos</center></div></div>";

echo "<style>
#loadGrupo{
    display:none;
}

</style>";
}
            foreach($fetch->loadMembro() as $linh){

                $i=$linh['id'];
            
            
            $fetch->setId($linh['id_grupo']);
            foreach($fetch->fetchGroup() as $linha){
            
                echo "<a href='groupMenu.php?id1=".base64_encode($linha['id'])."' style='text-decoration:none;color:black'><br><div class='container'><div class='card'><span class='btn btn-outline-primary'><img src='svgs/solid/users.svg' width=50 height=50> ".$linha['Nome']."</span><center></center></div></div></a>";
            
            }
            
                }
            echo "<center><div class='btn btn-primary my-3' data-id=".$i." id='loadGrupo'>Mais grupos</div></center>";
            }else if(isset($_REQUEST['gid4'])){



//===================LOAD GROUP mensagens=============================

$m11=new Manager();


$m12=new Manager();
$m11->setId($_REQUEST['gid4']);
$m11->setCelular($_REQUEST['msg4']);

if($m11->loadGroupMsg()->rowCount()==0){
    echo "<style>
    #moreG{display:none}
    </style>";
}

$msg=0;
foreach($m11->loadGroupMsg() as $linha){

$msg=$linha['id'];


    if($linha['Numero']==$_SESSION['Numero']){


if($linha['Ficheiro']!=''){

    $fich="";
    if($linha['Ficheiro']=='liked'){
        $fich="<img src='files/liked.png' width=70 height=70>";
    }else{
        $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
    }

    echo "<div id='p1' >";
    
    //===============getting name and profile of the sender============

    $m12->setCelular($linha['Numero']);
    
    foreach($m12->fetchUser() as $lin){

        if($lin['Avatar']!=''){
            echo "<strong ><div class='d-inline'><img src='img/avatar/".$lin['Avatar']."' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }else if($lin['Avatar']=='' and $lin['Sexo']=='Masculino'){
            echo "<strong ><div class='d-inline'><img src='files/male.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }else{

            echo "<strong ><div class='d-inline'><img src='files/female.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }
       
    }
//==========================end===========================================

//==========================fetch message foto============================
echo "<div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".$_REQUEST['gid4'].")'>";

echo "<br>";
  //============demo==============
  if($linha['Demo']!=''){
    echo "<div class='bg-info' style='padding:4px;margin-right:5px;border-radius:10px;font-weight:bolder'>".$linha['Demo']."<br>".$linha['Demo_Pic']."</div>";
}

echo $fich."</div></div>";

}else{
    

    echo "<div id='p1' >";
    
        //===============getting name and profile of the sender============
    $m12->setCelular($linha['Numero']);
    
    foreach($m12->fetchUser() as $lin){

        if($lin['Avatar']!=''){
            echo "<strong ><div class='d-inline'><img src='img/avatar/".$lin['Avatar']."' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }else if($lin['Avatar']=='' and $lin['Sexo']=='Masculino'){
            echo "<strong ><div class='d-inline'><img src='files/male.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }else{

            echo "<strong ><div class='d-inline'><img src='files/female.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
        }
       
    }
    //==============================end=============================

    //============================fetchMessage=============================
    
    echo "<div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".$_REQUEST['gid4'].")'>";
      //============demo==============
      if($linha['Demo']!=''){
        echo "<div class='bg-info' style='padding:4px;margin-right:5px;border-radius:10px;font-weight:bolder'>".$linha['Demo']."<br>".$linha['Demo_Pic']."</div>";
    }
    
    echo $linha['Mensagem']."</div></div><br>";
}

      

    }else{

        if($linha['Ficheiro']!=''){
            $fich="";
            if($linha['Ficheiro']=='liked'){
                $fich="<img src='files/liked.png' width=70 height=70>";
            }else{
                $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
            }
    

        echo "<div  id='p2'>";
            //===============getting name and profile of the sender============
        $m12->setCelular($linha['Numero']);
    
        foreach($m12->fetchUser() as $lin){
    
            if($lin['Avatar']!=''){
                echo "<strong ><div class='d-inline'><img src='img/avatar/".$lin['Avatar']."' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }else if($lin['Avatar']=='' and $lin['Sexo']=='Masculino'){
                echo "<strong ><div class='d-inline'><img src='files/male.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }else{
    
                echo "<strong ><div class='d-inline'><img src='files/female.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }
           
        }
//===================================end=================================

//===================================fetch my foto msg================

        echo "<div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].",".$_REQUEST['gid4'].")'>";
          //============demo==============
          if($linha['Demo']!=''){
            echo "<div class='bg-info' style='padding:4px;margin-right:5px;border-radius:10px;font-weight:bolder'>".$linha['Demo']."<br>".$linha['Demo_Pic']."</div>";
        }
        
        echo $fich."</div></div>";
    }else{

        echo "<div  id='p2'>";
            //===============getting name and profile of the sender============
        $m12->setCelular($linha['Numero']);
    
        foreach($m12->fetchUser() as $lin){
    
            if($lin['Avatar']!=''){
                echo "<strong ><div class='d-inline'><img src='img/avatar/".$lin['Avatar']."' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }else if($lin['Avatar']=='' and $lin['Sexo']=='Masculino'){
                echo "<strong ><div class='d-inline'><img src='files/male.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }else{
    
                echo "<strong ><div class='d-inline'><img src='files/female.png' width=40 height=40 style='border-radius:100%;border:3px solid #007bff;'></div><small> ".$lin['Nome']."</small></strong><br><br>";
            }
           
        }
        
        //==================================end============================

        //====================fetch my msg============================
        echo "<div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].",".$_REQUEST['gid4'].")'>";
          //============demo==============
          if($linha['Demo']!=''){
            echo "<div class='bg-info' style='padding:4px;margin-right:5px;border-radius:10px;font-weight:bolder'>".$linha['Demo']."<br>".$linha['Demo_Pic']."</div>";
        }
        
        echo $linha['Mensagem']."</div></div>";

    }
    }

   
}
 

echo "<input type='hidden' data-id='".$msg."' data-group='".$_REQUEST['gid4']."' id='moreG1'>";


//=============end===============================================


            }else if(isset($_REQUEST['text']) && isset($_REQUEST['id'])){

//=================responder===============================
$m=new Manager();
$m->setId($_REQUEST['text']);

foreach($m->fetchGroupMsgViaId() as $li){
   $m->setCelular($li['Numero']);

   foreach($m->fetchUser() as $user){

       $msg="";
       if($li['Mensagem']!=''){
           if(strlen($li['Mensagem'])>20){
            $msg=substr($li['Mensagem'],0,20)."...";  
           }else{
            $msg=$li['Mensagem'];
           }
         
       }else if($li['Ficheiro']!='' and $li['Ficheiro']!='liked'){
           $msg="<img src='img/sent/".$li['Ficheiro']."' width=60 height=60>";
       }else{
        $msg="<img src='files/liked.png' width=60 height=60>";
       }
       echo "<span class='close text-dark' onclick='fecharResposta()'>&times;</span><strong>".$user['Nome'].":</strong><br><span id='respSpan'>".$msg."</span>";
   }
}



            }else{
                include 'includes/incluir.php';

        echo "<style>
        body{
        background: #007bff;
        }
        </style>";
        echo "<div  style='margin:10% auto;background:white;padding:10px;text-align:center;width:90%'>Nao tem permissao para ver esta pagina<br><a href='index.php' class='btn btn-primary'>LOGIN</a></div>";
        
       
            }
            

        