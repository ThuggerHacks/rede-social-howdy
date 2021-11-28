<?php  session_start();
include 'classes/Manager.class.php';





if(isset($_REQUEST['msg'])){

    //===========send Message===============

$m=new Manager();

$n=new Manager();
$n->setId($_REQUEST['recipie']);

$friend="";
foreach($n->fetchUserViaId() as $user){
$friend=$user['Nome'];
}

$m->setNumero($_REQUEST['recipie']);
$m->setTexto(filter_var($_REQUEST['msg'],FILTER_SANITIZE_SPECIAL_CHARS));
$id2=0;

$m1=new Manager();
$m1->setCelular($_SESSION['Numero']);
foreach($m1->fetchUser() as $linha){
    $id2=$linha['id_user'];
}
$m->setCelular($id2);
$m->setId($id2);
$m->sendMsg();

//==================fetch msg=========

$m11=new Manager();

$m11->setCelular($_REQUEST['recipie']);

$m12=new Manager();
$m12->setCelular($_SESSION['Numero']);
$id=0;

foreach($m12->fetchUser() as $l){
    $id=$l['id_user'];
}

$m11->setId($id);

$msg=0;
foreach($m11->fetchMessage() as $linha){

$msg=$linha['id'];


    if($linha['Numero']==$id){


if($linha['Ficheiro']!=''){


    
    $fich="";
    if($linha['Ficheiro']=='liked'){
        $fich="<img src='files/liked.png' width=70 height=70>";
    }else{
        $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
    }

    echo "<div id='p1' ><div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".$_REQUEST['recipie'].")'>".$fich."</div></div>";

}else{

    $string="";
    if($linha['Demo_Type']==1){
    $string=$linha['Demo_Msg'];
    }else{
   
        if(file_exists("img/status/".$linha['Demo_Msg'])){
            if(substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".mp4" || substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".m4a"){
                $string='<img src="svgs/solid/video.svg" width=40 height=40>';
            }else{
                $string='<img src="img/status/'.$linha['Demo_Msg'].'" width=40 height=40>';
            }
         
        }else{
            $string='<img src="files/deletar.png" width=40 height=40>';
        }
    }
    

    echo "<div id='p1' ><div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".$_REQUEST['recipie'].")'>";
             //==================fetching demo msg================

             if($linha['Demo_Msg']!=''){
                echo "<div  class='text-dark' style='border-radius:13px;padding:5px;background:rgb(240,240,240);margin-right:5px' >".$string."<br><small class='text-dark'><strong>".$friend." >> </strong><span class='text-primary'>Status</span></strong></small></div><br> ";
                }
            //=============end===============================
    echo $linha['Mensagem']."</div></div>";
}

      

    }else{

   
        if($linha['Ficheiro']!=''){
            $fich="";
            if($linha['Ficheiro']=='liked'){
                $fich="<img src='files/liked.png' width=70 height=70>";
            }else{
                $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
            }
    
            echo "<div  id='p2'><div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].")'>".$fich."</div></div>";
        }else{
    
            $string="";
            if($linha['Demo_Type']==1){
            $string=$linha['Demo_Msg'];
            }else{
          
                if(file_exists("img/status/".$linha['Demo_Msg'])){
                    if(substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".mp4" || substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".m4a"){
                        $string='<img src="svgs/solid/video.svg" width=40 height=40>';
                    }else{
                        $string='<img src="img/status/'.$linha['Demo_Msg'].'" width=40 height=40>';
                    }
                 
                }else{
                    $string='<img src="files/deletar.png" width=40 height=40>';
                }
            }
        
            
            echo "<div  id='p2'><div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].")'>";

                 //==================fetching demo msg================

      if($linha['Demo_Msg']!=''){
        echo "<div class='bg-primary ' style='border-radius:13px;padding:5px;margin-right:5px' >".$string."<br><small class='text-light'><b>Meus</b> >> <span class='text-light'>Status</span></small></div><br> ";
        }
    //=============end===============================
            echo $linha['Mensagem']."</div></div>";
    
        }

    }

   


}
echo "<input type='hidden' data-id='".$msg."' id='pvt1' data-re='".$_REQUEST['recipie']."'>";

//=================end==========================
}else if(isset($_REQUEST['p'])){

  //===========my fetch Message====================

    $m11=new Manager();

    
    $m11->setId($_REQUEST['p']);

    foreach($m11->fetchMessageViaId() as $linha){



        echo "<div id='inf' class='alert alert-info'>";
     
        echo "<div id='st'>";
        
        
       
            echo "<style>
            #inf{";
        
             
           
     
                echo "display:inline-flex;
                position:absolute;
                top:".($_REQUEST['screenY']-50)."px;
                left:".($_REQUEST['screenX'])."px;
                word-wrap:break-word;
                border:1px solid black;
                padding:10px;
            }
        
        
          @media screen and (max-width:991px){
              #inf{
                   
              left:10%; 
              top:20%;
              margin:auto;
              }
           
          }
              
            
            </style>";
        

            $time=localtime($linha['Hora'],true);
            $mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
            
            echo "<strong>Enviado: ".$time['tm_mday']." ".$mes[$time['tm_mon']]." "." ".date('Y',$linha['Hora']).", ".$time['tm_hour'].":".$time['tm_min']."</strong>";
           
           if($linha['Estado']=='unread'){
            echo "<br><strong>Nao Lida</strong><br><span class='text-danger' onclick='msgDel(".$_REQUEST['p'].",".$_REQUEST['y'].")'>delete</span";
           }else{
            echo "<br><strong>Lida</strong><br><span class='text-danger' onclick='msgDel(".$_REQUEST['p'].",".$_REQUEST['y'].")'>delete</span>";
           }
           
          
        echo "</div>";
        
        echo "</div>";
        
        
        //================end===========================



        }


    }else if(isset($_REQUEST['p1'])){

       //=============other message info================================ 
        $m11=new Manager();

    
        $m11->setId($_REQUEST['p1']);
    
        foreach($m11->fetchMessageViaId() as $linha){
    
    
    
            echo "<div id='inf1' class='alert alert-warning '>";
         
            echo "<div id='st'>";
            
            
           
                echo "<style>
                #inf1{";
            
                 
               
         
                    echo "
                    display:inline-flex;
                    position:absolute;
                    top:".$_REQUEST['screenY']."px;
                    left:".($_REQUEST['screenX']-300)."px;
                    word-wrap:break-word;
                    border:1px solid black;
                    padding:10px;
                }
            
            
              @media screen and (max-width:991px){
                  #inf1{
                       
                  left:10%; 
                  top:20%;
                  margin:auto;
                  }
               
              }
                  
                
                </style>";
            
    
                $time=localtime($linha['Hora'],true);
                $mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
                
                echo "<strong>Recebido: ".$time['tm_mday']." ".$mes[$time['tm_mon']]." "." ".date('Y',$linha['Hora']).", ".$time['tm_hour'].":".$time['tm_min']."</strong>";
               
              if($linha['Ficheiro']!='' && $linha['Ficheiro']!='liked'){
                  echo "<div class='text-primary'><a href='img/sent/".$linha['Ficheiro']."' download='img/sent/".$linha['Ficheiro']."'>download</a></div>";
              }
              
            echo "</div>";
            
            echo "</div>";
            
            
            //================end===========================

    }
    }else if(isset($_REQUEST['like'])){

//=========================send like icon=========================
$n=new Manager();
$n->setId($_REQUEST['re']);

$friend="";
foreach($n->fetchUserViaId() as $user){
$friend=$user['Nome'];
}

$prof=new Manager();
$prof->setCelular($_SESSION['Numero']);
$id=0;
foreach($prof->fetchUser() as $linha){
    $id=$linha['id_user'];
}

$r=new Manager();
$r->setCelular($id);
$r->setId($id);
$r->setNumero($_REQUEST['re']);
$r->setProfile('liked');
$r->sendLikeIcon();

if(!file_exists('img/sent/liked.png')){
    copy('files/liked.png','img/sent/liked.png');
}


//========================end========================

//==================fetch msg=========

$m11=new Manager();

$m11->setCelular($_REQUEST['re']);

$m12=new Manager();
$m12->setCelular($_SESSION['Numero']);
$id=0;

foreach($m12->fetchUser() as $l){
    $id=$l['id_user'];
}

$m11->setId($id);

$msg=0;
foreach($m11->fetchMessage() as $linha){

$msg=$linha['id'];


    if($linha['Numero']==$id){


if($linha['Ficheiro']!=''){


    
    $fich="";
            if($linha['Ficheiro']=='liked'){
                $fich="<img src='files/liked.png' width=70 height=70>";
            }else{
                $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
            }

    echo "<div id='p1' ><div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".$_REQUEST['re'].")'>".$fich."</div></div>";

}else{

    $string="";
    if($linha['Demo_Type']==1){
    $string=$linha['Demo_Msg'];
    }else{
        if(file_exists("img/status/".$linha['Demo_Msg'])){
            if(substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".mp4" || substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".m4a"){
                $string='<img src="svgs/solid/video.svg" width=40 height=40>';
            }else{
                $string='<img src="img/status/'.$linha['Demo_Msg'].'" width=40 height=40>';
            }
         
        }else{
            $string='<img src="files/deletar.png" width=40 height=40>';
        }
    }
    

    echo "<div id='p1' ><div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".$_REQUEST['re'].")'>";
             //==================fetching demo msg================

             if($linha['Demo_Msg']!=''){
                echo "<div  class='text-dark' style='border-radius:13px;padding:5px;background:rgb(240,240,240);margin-right:5px' >".$string."<br><small class='text-dark'><strong>".$friend." >> </strong><span class='text-primary'>Status</span></strong></small></div><br> ";
                }
            //=============end===============================
    echo $linha['Mensagem']."</div></div>";
}

      

    }else{

   
        if($linha['Ficheiro']!=''){
            $fich="";
            if($linha['Ficheiro']=='liked'){
                $fich="<img src='files/liked.png' width=70 height=70>";
            }else{
                if(file_exists("img/status/".$linha['Demo_Msg'])){
                    if(substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".mp4" || substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".m4a"){
                        $string='<img src="svgs/solid/video.svg" width=40 height=40>';
                    }else{
                        $string='<img src="img/status/'.$linha['Demo_Msg'].'" width=40 height=40>';
                    }
                 
                }else{
                    $string='<img src="files/deletar.png" width=40 height=40>';
                }
            }
        
    
            echo "<div  id='p2'><div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].")'>".$fich."</div></div>";
        }else{
    
            $string="";
            if($linha['Demo_Type']==1){
            $string=$linha['Demo_Msg'];
            }else{
                if(file_exists("img/status/".$linha['Demo_Msg'])){
                    if(substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".mp4" || substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".m4a"){
                        $string='<img src="svgs/solid/video.svg" width=40 height=40>';
                    }else{
                        $string='<img src="img/status/'.$linha['Demo_Msg'].'" width=40 height=40>';
                    }
                 
                }else{
                    $string='<img src="files/deletar.png" width=40 height=40>';
                }
            }
        
            
            echo "<div  id='p2'><div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].")'>";

                 //==================fetching demo msg================

      if($linha['Demo_Msg']!=''){
        echo "<div class='bg-primary ' style='border-radius:13px;padding:5px;margin-right:5px' >".$string."<br><small class='text-light'><b>Meus</b> >> <span class='text-light'>Status</span></small></div><br> ";
        }
    //=============end===============================
            echo $linha['Mensagem']."</div></div>";
    
        }

    }

   


}
echo "<input type='hidden' data-id='".$msg."' id='pvt1' data-re='".$_REQUEST['re']."'>";
//=================end==========================


    }else if(isset($_REQUEST['del'])){

        $n=new Manager();
$n->setId($_REQUEST['recipie']);

$friend="";
foreach($n->fetchUserViaId() as $user){
$friend=$user['Nome'];
}

        //===========delete message==============
        $del=new Manager();
        $del->setId($_REQUEST['del']);
       
        foreach($del->fetchMessageViaId() as $linha){
            if($linha['Ficheiro']!='' && $linha['Ficheiro']!='liked'){
                unlink('img/sent/'.$linha['Ficheiro']);
            }
        }

        $del->deletePvt();

//=====fetch msg to respond ajax==========================


//==================fetch msg=========

$m11=new Manager();

$m11->setCelular($_REQUEST['recipie']);

$m12=new Manager();
$m12->setCelular($_SESSION['Numero']);
$id=0;

foreach($m12->fetchUser() as $l){
    $id=$l['id_user'];
}

$m11->setId($id);

$msg=0;
foreach($m11->fetchMessage() as $linha){

$msg=$linha['id'];


    if($linha['Numero']==$id){


if($linha['Ficheiro']!=''){


    
           $fich="";
            if($linha['Ficheiro']=='liked'){
                $fich="<img src='files/liked.png' width=70 height=70>";
            }else{
                $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
            }

    echo "<div id='p1' ><div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".$_REQUEST['recipie'].")'>".$fich."</div></div>";

}else{

    $string="";
    if($linha['Demo_Type']==1){
    $string=$linha['Demo_Msg'];
    }else{
    
        if(file_exists("img/status/".$linha['Demo_Msg'])){
            if(substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".mp4" || substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".m4a"){
                $string='<img src="svgs/solid/video.svg" width=40 height=40>';
            }else{
                $string='<img src="img/status/'.$linha['Demo_Msg'].'" width=40 height=40>';
            }
         
        }else{
            $string='<img src="files/deletar.png" width=40 height=40>';
        }
    }
    

    echo "<div id='p1' ><div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".$_REQUEST['recipie'].")'>";
             //==================fetching demo msg================

             if($linha['Demo_Msg']!=''){
                echo "<div  class='text-dark' style='border-radius:13px;padding:5px;background:rgb(240,240,240);margin-right:5px' >".$string."<br><small class='text-dark'><strong>".$friend." >> </strong><span class='text-primary'>Status</span></strong></small></div><br> ";
                }
            //=============end===============================
    echo $linha['Mensagem']."</div></div>";
}

      

    }else{

   
        if($linha['Ficheiro']!=''){
            $fich="";
            if($linha['Ficheiro']=='liked'){
                $fich="<img src='files/liked.png' width=70 height=70>";
            }else{
                $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
            }
        
    
            echo "<div  id='p2'><div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].")'>".$fich."</div></div>";
        }else{
    
            $string="";
            if($linha['Demo_Type']==1){
            $string=$linha['Demo_Msg'];
            }else{
                if(file_exists("img/status/".$linha['Demo_Msg'])){
                    if(substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".mp4" || substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".m4a"){
                        $string='<img src="svgs/solid/video.svg" width=40 height=40>';
                    }else{
                        $string='<img src="img/status/'.$linha['Demo_Msg'].'" width=40 height=40>';
                    }
                 
                }else{
                    $string='<img src="files/deletar.png" width=40 height=40>';
                }
            }
        
            
            echo "<div  id='p2'><div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].")'>";

                 //==================fetching demo msg================

      if($linha['Demo_Msg']!=''){
        echo "<div class='bg-primary ' style='border-radius:13px;padding:5px;margin-right:5px' >".$string."<br><small class='text-light'><b>Meus</b> >> <span class='text-light'>Status</span></small></div><br> ";
        }
    //=============end===============================
            echo $linha['Mensagem']."</div></div>";
    
        }

    }

   

   


}
echo "<input type='hidden' data-id='".$msg."' id='pvt1' data-re='".$_REQUEST['recipie']."'>";
//=================end==========================
    }else if(isset($_REQUEST['load'])){

        echo "<div class='card-body' style='height:85%;overflow-y:auto;overflow-x:hidden;'>";

        $n=new Manager();
$n->setId($_REQUEST['reci']);

$friend="";
foreach($n->fetchUserViaId() as $user){
$friend=$user['Nome'];
}

        $m11=new Manager();
        
        $m11->setCelular($_REQUEST['reci']);
        
        $m12=new Manager();
        $m12->setCelular($_SESSION['Numero']);
        $id=0;
        
        foreach($m12->fetchUser() as $l){
            $id=$l['id_user'];
        }
        
        $m11->setId($id);
        $m11->setNumero($_REQUEST['load']);
        $msg=0;
        foreach($m11->loadMessage() as $linha){
        
        $msg=$linha['id'];
        
        
            if($linha['Numero']==$id){
        
        
        if($linha['Ficheiro']!=''){
        
            $fich="";
            if($linha['Ficheiro']=='liked'){
             $fich="liked.png";
            }else{
                $fich=$linha['Ficheiro'];
            }
        
            echo "<div id='p1' ><div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".base64_decode($_REQUEST['x']).")'><img src='img/sent/".$fich."' width=230 height=230></div></div>";
        
        }else{
            
        
            echo "<div id='p1' ><div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".base64_decode($_REQUEST['x']).")'>".$linha['Mensagem']."</div></div>";
        }
        
              
        
            }else{
        
                if($linha['Ficheiro']!=''){
                    $fich="";
                    if($linha['Ficheiro']=='liked'){
                        $fich="<img src='files/liked.png' width=70 height=70>";
                    }else{
                        $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
                    }
            
        
                echo "<div  id='p2'><div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].")'>".$fich."</div></div>";
            }else{
        
                echo "<div  id='p2'><div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].")'>".$linha['Mensagem']."</div></div>";
        
            }
            }
        
           
        }
        
        
        echo "</div>";
        
        echo "<div class='btn btn-outline-primary' style='margin:auto;text-align:center;padding:1px' onclick='load(".$msg.",".base64_decode($_REQUEST['x']).")'>Mais antigos</div>";
        

    }else if(isset($_REQUEST['msg1'])){

        //=======================inserir mensagem do grupo===================
$m=new Manager();
$m->setId($_REQUEST['gi']);
$m->setCelular($_SESSION['Numero']);

$demo="";
$demo1="";
$d=isset($_REQUEST['demo'])?$_REQUEST['demo']:"";
$d1=isset($_REQUEST['demo1'])?$_REQUEST['demo1']:"";

if($d!=''){
    $demo="<span style='color:purple'>".$_REQUEST['demo']."</span>";
}else{
$demo="";
}

if($d1!=''){
    $demo1=$_REQUEST['demo1'];
}else{
    $demo1="";
}

$m->setNome($demo);
$m->setTipo($demo1);



$m->setTexto(filter_var($_REQUEST['msg1'],FILTER_SANITIZE_SPECIAL_CHARS));
$m->sendGroupMsg();

//==============end===============================================


//==============fetchMessg to append==========================


//===================mensagens=============================

$m11=new Manager();


$m12=new Manager();
$m11->setId($_REQUEST['gi']);



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
echo "<div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".$_REQUEST['gi'].")'>";

echo "<br>";
//=============demo========================================
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
    
    echo "<div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".$_REQUEST['gi'].")'>";
    //=============demo========================================
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

        echo "<div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].",".$_REQUEST['gi'].")'>";
        //=============demo========================================
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
        echo "<div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].",".$_REQUEST['gi'].")'>";
        //=============demo========================================
if($linha['Demo']!=''){
    echo "<div class='bg-info' style='padding:4px;margin-right:5px;border-radius:10px;font-weight:bolder'>".$linha['Demo']."<br>".$linha['Demo_Pic']."</div>";
}
        echo $linha['Mensagem']."</div></div>";

    }
    }

   
}


echo "<input type='hidden' data-id='".$msg."' data-group='".$_REQUEST['gi']."' id='moreG1'>";

//=============end===============================================




    }else if(isset($_REQUEST['like1'])){
        $m=new Manager();
$m->setId($_REQUEST['like1']);
$m->setCelular($_SESSION['Numero']);

$demo="";
$demo1="";
$d=isset($_REQUEST['demo1'])?$_REQUEST['demo1']:"";
$d1=isset($_REQUEST['demo2'])?$_REQUEST['demo2']:"";

if($d!=''){
    $demo="<span style='color:purple'>".$_REQUEST['demo1']."</span>";
}else{
$demo="";
}

if($d1!=''){
    $demo1=$_REQUEST['demo2'];
}else{
    $demo1="";
}



if(!file_exists('img/sent/liked.png')){
    copy('files/liked.png','img/sent/liked.png');
}


$m->setNome($demo);
$m->setTipo($demo1);
$m->setProfile('liked');
$m->sendGroupFoto();


//==============fetchMessg to append==========================


//===================mensagens=============================

$m11=new Manager();


$m12=new Manager();
$m11->setId($_REQUEST['like1']);



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
echo "<div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".$_REQUEST['like1'].")'>";

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
    
    echo "<div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".$_REQUEST['like1'].")'>";
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

        echo "<div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].",".$_REQUEST['like1'].")'>";
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
        echo "<div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].",".$_REQUEST['like1'].")'>";
          //============demo==============
          if($linha['Demo']!=''){
            echo "<div class='bg-info' style='padding:4px;margin-right:5px;border-radius:10px;font-weight:bolder'>".$linha['Demo']."<br>".$linha['Demo_Pic']."</div>";
        }
        
        echo $linha['Mensagem']."</div></div>";

    }
    }

    
}

echo "<input type='hidden' data-id='".$msg."' data-group='".$_REQUEST['like1']."' id='moreG1'>";

//=============end===============================================

    }else{



        include 'includes/incluir.php';

        echo "<style>
        body{
        background: #007bff;
        }
        </style>";
        echo "<div  style='margin:10% auto;background:white;padding:10px;text-align:center;width:90%'>Nao tem permissao para ver esta pagina<br><a href='msg.php' class='btn btn-primary'>Voltar</a></div>";


        
    }



