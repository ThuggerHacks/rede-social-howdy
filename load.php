<?php session_start();

include 'classes/Manager.class.php';



if(isset($_REQUEST['scroll'])){
$st=new Manager();
$st1=new Manager();
$st->setCelular($_SESSION['Numero']);

$st->setId($_REQUEST['scroll']);
$i=0;
$st2=new Manager();
$id=0;


if($st->LoadMoreStatus()->rowCount()!=0){
foreach($st->LoadMoreStatus() as $thug){
$st1->setCelular($thug['Numero']);
foreach($st1->fetchStatus() as $linha){

    if($linha['Letra']=="delete"){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";

       $st2->setCelular($linha['Numero']);
      foreach($st2->fetchUser() as $linh){
        echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,30)."</div>";
      }

        echo "<div style='margin:10% auto'><del>".substr($linha['Texto'],0,8)."</del></div>";
       echo "</div>";


    }else if($linha['Letra']=='underline'){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
        $st2->setCelular($linha['Numero']);
        foreach($st2->fetchUser() as $linh){
          echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,30)."</div>";
        }
        echo "<div style='margin:10% auto'><u>".substr($linha['Texto'],0,15)."</u></div>";
       echo "</div>";

    }else if($linha['Letra']=='bold'){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
        $st2->setCelular($linha['Numero']);
        foreach($st2->fetchUser() as $linh){
          echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,30)."</div>";
        }
        echo "<div style='margin:10% auto'><strong>".substr($linha['Texto'],0,15)."</strong></div>";
       echo "</div>";

    }else if($linha['Letra']=='italico'){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
        $st2->setCelular($linha['Numero']);
        foreach($st2->fetchUser() as $linh){
          echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,30)."</div>";
        }
        echo "<div style='margin:10% auto'><i>".substr($linha['Texto'],0,15)."</i></div>";
       echo "</div>";
    }else if($linha['Letra']=='normal'){
        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
        $st2->setCelular($linha['Numero']);
        foreach($st2->fetchUser() as $linh){
          echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,30)."</div>";
        }
        echo "<div style='margin:10% auto'>".substr($linha['Texto'],0,15)."</div>";
       echo "</div>";
    }else if($linha['Imagem']!=''){
        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;background-image:url(img/status/".$linha['Imagem'].");background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
        $st2->setCelular($linha['Numero']);
        foreach($st2->fetchUser() as $linh){
          echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,30)."</div>";
        }
        echo "<div style='margin:10% auto'></div>";
       echo "</div>";
    }else if($linha['Letra']=='thugger'){
        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
        $st2->setCelular($linha['Numero']);
        foreach($st2->fetchUser() as $linh){
          echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,30)."</div>";
        }
        echo "<div style='margin:10% auto;font-family:thugger'>".substr($linha['Texto'],0,15)."</div>";
       echo "</div>";


    }else if($linha['Letra']=='thugger1'){
        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
        $st2->setCelular($linha['Numero']);
        foreach($st2->fetchUser() as $linh){
          echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,30)."</div>";
        }
        echo "<div style='margin:10% auto;font-family:thugger1'>".substr($linha['Texto'],0,15)."</div>";
       echo "</div>";


    }

$id=$linha['Id'];
}
$i++;
}


echo "<div id='status-item' class='next2'>
<div class='btn btn-light' style='border-radius:50%;padding:5px;font-size:60px;color:black;width:80%;height:80%;' data-last='".$id."' id='next2'><span style='margin:auto;text-align:center;'>&rarr;</span></div>

</div>";
}else{
    echo "<style>
    
    .next2{
        display:none
    }
    </style>";
}
}else if(isset($_REQUEST['post'])){
//=========================fetching posts======================

$id1=0;
$post=new Manager();
$post->setId($_REQUEST['post']);

if($post->loadMorePosts()->rowCount()>0){
    foreach($post->loadMorePosts() as $linha){

        $post->setCelular($linha['Numero']);
      
    $time=localtime($linha['Hora'],true);
    $day=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
    $mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
        foreach($post->fetchUser() as $linh){
            echo "<div class='card' >";
    
            echo "<div class='card-header bg-primary'><div>";
              
           if($linh['Avatar']!=''){
    
            echo "<img src='img/avatar/".$linh['Avatar']."' style='width:30px;height:30px;border-radius:50%'><strong> ".$linh['Nome']."</strong>";
    
           }else if($linh['Avatar']=='' && $linh['Sexo']=='Masculino'){
    
            echo "<img src='files/male.png' style='width:30px;height:30px;'><strong> ".$linh['Nome']."</strong>"; 
    
           }else{
    
            echo "<img src='files/female.png' style='width:30px;height:30px;'><strong> ".$linh['Nome']."</strong>"; 
    
           }
          
            
            echo "<small style='float:right'> ".$mes[$time['tm_mon']]." ".$time['tm_mday'].",".$time['tm_hour'].":".$time['tm_min']."</small></div>";
            echo "</div>";
            echo "<div class='card-body'>";
            if($linha['Ficheiro']=='' && $linha['Mensagem']!=''){
                echo "<span>".$linha['Mensagem']."</span>";
            }else if($linha['Ficheiro']!='' && $linha['Mensagem']==''){
                echo "<center><img src='img/img/".$linha['Ficheiro']."' class='img-fluid'></center>";
            }else{
                echo "<center><span>".$linha['Mensagem']."</span></center><br>";
                echo "<center><img src='img/img/".$linha['Ficheiro']."' class='img-fluid'></center>";
            }
    
                
    
    $likes=new Manager();
    $likes->setId($linha['id_posts']);
    $likes->setCelular($_SESSION['Numero']);
    
            echo "</div>";
            echo "<div class='card-footer bg-light'>";
         if($likes->fetchMyLikes()->rowCount()!=0){
            
            echo " <div class='btn btn-primary' data-like='".$linha['id_posts']."'  onclick='like(".$linha['id_posts'].")'>";
            echo "<img src='files/not.png' width=20 height=20><span class='like".$linha['id_posts']."'> {$likes->fetchLikes()->rowCount()}</span>
             </div>";
         }else{
    
            echo " <div class='btn btn-outline-primary' data-like='".$linha['id_posts']."'  onclick='like(".$linha['id_posts'].")'>";
            echo "<img src='files/not.png' width=20 height=20><span class='like".$linha['id_posts']."'> {$likes->fetchLikes()->rowCount()}</span>
             </div>";
         }
           
    $com=new Manager();
    $com->setId($linha['id_posts']);
    
               echo " <div class='btn btn-outline-primary' data-comment='".$linha['id_posts']."'  onclick='comment(".$linha['id_posts'].")' data-toggle='modal' data-target='#comments'>
               <img src='files/comments.png' width=20 height=20> <span class='com".$linha['id_posts']."'> {$com->fetchCom()->rowCount()}</span>
               </div>";
    
               if($linh['Numero']==$_SESSION['Numero']){
                echo "<div class='btn btn-outline-danger mr-3' style='float:right;' onclick='deletePost(".$linha['id_posts'].")'>delete</div>";
               }
              
            echo "</div>";
            echo "</div><br>";
        }
    $id=$linha['id_posts'];
    }
    
    echo "<center><div data-id='".$id."' id='moreP' class='btn btn-outline-dark'>Mais</div></center>";
}else{
    echo "<style>
    #moreP{display:none}
    
    </style>";
}
}else if(isset($_REQUEST['com'])){

  //====================load comments=====================
  $fetch=new Manager();
    $fetch->setId($_REQUEST['com']);
   $fetch->setNumero($_REQUEST['s1']);
    if($fetch->loadCom()->rowCount()==0){

        echo "<style>
        
        #comMore{display:none}
        </style>";   
    }


   
   $id=0;
    $day=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
    $mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
    foreach($fetch->loadCom() as $linha){
        $time=localtime($linha['Hora_Comentario'],true);
    
      $fetch->setCelular($linha['Numero_poster']);
    
      foreach($fetch->fetchUser() as $nome){
    echo "<div class='card mb-2 my-2' >
    <div class='card-header'><strong>".$nome['Nome']."</strong><small style='float:right'>".$mes[$time['tm_mon']]." ".$time['tm_mday'].", ".$time['tm_hour'].":".$time['tm_min']."</small></div>
    <div class='card-body bg-light'>".$linha['Mensagem']."</div>";
    if($linha['Numero_poster']==$_SESSION['Numero']){
        echo "<div class='card-footer bg-light'><button class='btn btn-outline-danger' style='float:right' onclick='delCom(".$linha['id'].",".$_REQUEST['idPost'].")'>delete</button></div>";
    }
      
    
    
    echo "</div>";
    
      }
      $id=$linha['id'];
    }
    
      echo "<center><div class='btn btn-outline-primary mr-2 mr-2' data-id='".$id."'  data-post='".$_REQUEST['s1']."' id='comMore'>Mais</div></center>";




    }else if(isset($_REQUEST['post1'])){
//==================load more user posts===============

//=========================fetching posts======================

$id1=0;
$id=0;
$post=new Manager();
$post->setId($_REQUEST['post1']);
$cel=0;

foreach($post->fetchUserPost() as $linh){
    $cel=$linh['Numero'];
}
$post->setCelular($cel);
if($post->loadMoreUserPosts()->rowCount()>0){
    foreach($post->loadMoreUserPosts() as $linha){

        
      
    $time=localtime($linha['Hora'],true);
    $day=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
    $mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
        foreach($post->fetchUser() as $linh){
            echo "<div class='card' >";
    
            echo "<div class='card-header bg-primary'><div>";
              
           if($linh['Avatar']!=''){
    
            echo "<img src='img/avatar/".$linh['Avatar']."' style='width:30px;height:30px;border-radius:50%'><strong> ".$linh['Nome']."</strong>";
    
           }else if($linh['Avatar']=='' && $linh['Sexo']=='Masculino'){
    
            echo "<img src='files/male.png' style='width:30px;height:30px;'><strong> ".$linh['Nome']."</strong>"; 
    
           }else{
    
            echo "<img src='files/female.png' style='width:30px;height:30px;'><strong> ".$linh['Nome']."</strong>"; 
    
           }
          
            
            echo "<small style='float:right'> ".$mes[$time['tm_mon']]." ".$time['tm_mday'].",".$time['tm_hour'].":".$time['tm_min']."</small></div>";
            echo "</div>";
            echo "<div class='card-body'>";
            if($linha['Ficheiro']=='' && $linha['Mensagem']!=''){
                echo "<span>".$linha['Mensagem']."</span>";
            }else if($linha['Ficheiro']!='' && $linha['Mensagem']==''){
                echo "<center><img src='img/img/".$linha['Ficheiro']."' class='img-fluid'></center>";
            }else{
                echo "<center><span>".$linha['Mensagem']."</span></center><br>";
                echo "<center><img src='img/img/".$linha['Ficheiro']."' class='img-fluid'></center>";
            }
    
                
    
    $likes=new Manager();
    $likes->setId($linha['id_posts']);
    $likes->setCelular($_SESSION['Numero']);
    
            echo "</div>";
            echo "<div class='card-footer bg-light'>";
         if($likes->fetchMyLikes()->rowCount()!=0){
            
            echo " <div class='btn btn-primary' data-like='".$linha['id_posts']."'  onclick='like(".$linha['id_posts'].")'>";
            echo "<img src='files/not.png' width=20 height=20><span class='like".$linha['id_posts']."'> {$likes->fetchLikes()->rowCount()}</span>
             </div>";
         }else{
    
            echo " <div class='btn btn-outline-primary' data-like='".$linha['id_posts']."'  onclick='like(".$linha['id_posts'].")'>";
            echo "<img src='files/not.png' width=20 height=20><span class='like".$linha['id_posts']."'> {$likes->fetchLikes()->rowCount()}</span>
             </div>";
         }
           
    $com=new Manager();
    $com->setId($linha['id_posts']);
    
               echo " <div class='btn btn-outline-primary' data-comment='".$linha['id_posts']."'  onclick='comment(".$linha['id_posts'].")' data-toggle='modal' data-target='#comments'>
               <img src='files/comments.png' width=20 height=20> <span class='com".$linha['id_posts']."'> {$com->fetchCom()->rowCount()}</span>
               </div>";
    
               if($linh['Numero']==$_SESSION['Numero']){
                echo "<div class='btn btn-outline-danger mr-3' style='float:right;' onclick='deletePost(".$linha['id_posts'].")'>delete</div>";
               }
              
            echo "</div>";
            echo "</div><br>";
        }
    $id=$linha['id_posts'];
    }
    
    echo "<center><div data-id='".$id."' id='moreP' class='btn btn-outline-dark'>Mais</div></center>";
}else{
    echo "<style>
    #moreP{display:none}
    
    </style>";
} 
  
}else if(isset($_REQUEST['pload'])){
    //=====================load more notifications===============
    
    
        $m=new Manager();
        $id=0;
        $m->setId($_REQUEST['pload']);
        $m->setCelular($_SESSION['Numero']);
        //=======posts notification===============
        if($m->loadMorePosts1()->rowCount()==0){
            echo "<div class='card' style='margin-bottom:2px;padding:10px' style='text-align:center;margin:auto'><center>Nao existe mais notifica&ccedil;oes aqui</center></div>";
            exit;
        }
      

           
        foreach($m->loadMorePosts1() as $linha){
            $m1=new Manager();

            $m1->setCelular($linha['Numero']);
        
            foreach($m1->fetchUser() as $li){
                if($li['Numero']!=$_SESSION['Numero']){
                echo "<div class='card' style='margin-bottom:2px;padding:10px'><b>".$li['Nome']."</b> ".substr($linha['Mensagem'],0,100)."...<br><div class='btn btn-outline-primary'  onclick='comment1(".$linha['id_posts'].")' id='ver'>Ver Post</div></div>";
                }
            }
          $id=$linha['id_posts'];
        }
        
        echo "<br><center><div class='btn btn-outline-primary' onclick='load(".$id.")' id='load'>Mais</div></center>";
            
    
    }else if(isset($_REQUEST['luser'])){
//===============load more users in users page===============



$m=new Manager();

$m->setCelular($_SESSION['Numero']);
$bi=0;
$id=0;

foreach($m->fetchUser() as $linha){
    $bi=$linha['id_user'];
}

$m->setId($bi);
$m->setNumero($_REQUEST['luser']);

if($m->fetchAllUsers2()->rowCount()==0){
    echo "<div class='card ' style='margin-bottom:2px;padding:10px'><center>Nao ha mais usuarios</center></div>";
    exit;
}
    foreach($m->fetchAllUsers2() as $li){
        if($li['Numero']!=$_SESSION['Numero']){
            
            if($li['Avatar']!=''){
                echo "<a href='account.php?id=".base64_encode($li['id_user'])."' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'><img src='img/avatar/".$li['Avatar']."' width=30 height=30 style='border-radius:50%'> <b>".$li['Nome']."</b></div></a>";
            }else if($li['Avatar']=='' and $li['Sexo']=='Masculino'){

                echo "<a href='account.php?id=".base64_encode($li['id_user'])."' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'><img src='files/male.png' width=30 height=30 > <b>".$li['Nome']."</b></div></a>";

            }else{
                echo "<a href='account.php?id=".base64_encode($li['id_user'])."' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'><img src='files/female.png' width=30 height=30 > <b>".$li['Nome']."</b></div></a>";
            }

      


        }
    
  $id=$li['id_user'];
    }


    echo "<br><center><div class='btn btn-outline-primary' data-id='".$id."' id='load'>Mais</div></center>";



    }else if(isset($_REQUEST['laudio'])){

        //=========load more audio================


        //===========fetching audios==========================
        
        $audio=new Manager();
        $id=0;
        $audio->setId($_REQUEST['laudio']);

        if($audio->loadAudio()->rowCount()==0){
            echo "<style>
            #more11{
               display:none;
            }
            </style>";

            echo "<div class='card my-2'><center>Nao ha mais audios aqui</center></div>";
        }
        foreach($audio->loadAudio() as $linha){
              $id=$linha['id'];
            $audio->setCelular($linha['Numero']);
        
            foreach($audio->fetchUser() as $user){
        
            
           echo "<div class='card mb-2 my-2'>
                 <div class='card-header bg-primary'>Publicado por: <b>".substr($user['Nome'],0,25)."</b></div>
                 <div class='card-body'>
                   <audio src='img/audio/".$linha['Ficheiro']."' class='form-control btn-outline-primary' controls></audio>
                 </div>
        
                 <div class='card-footer'><small>Titulo: </small> <strong>".$linha['Titulo']."</strong></div>
           </div>";
        
            }
        
        }
        
        
        echo "<center><div class='btn btn-outline-primary my-3' data-id='".$id."' id='more11'>Mais</div></center>";
        

    }else if(isset($_REQUEST['lmaudio'])){
         //=========load more my audio================


        //===========fetching audios==========================
        
        $audio=new Manager();
        $id=0;
        $audio->setId($_REQUEST['lmaudio']);
        $audio->setCelular($_SESSION['Numero']);
  

        if($audio->loadMyAudio()->rowCount()==0){
            echo "<style>
            #load11{
               display:none;
            }
            </style>";

            echo "<div class='card my-2 mb-2'><center>Nao ha mais audios aqui</center></div>";
        }
        foreach($audio->loadMyAudio() as $linha){
              $id=$linha['id'];
            $audio->setCelular($linha['Numero']);
        
            foreach($audio->fetchUser() as $user){
        
            
           echo "<div class='card mb-2 my-2'>
                 <div class='card-header bg-primary'>Publicado por: <b>".substr($user['Nome'],0,25)."</b></div>
                 <div class='card-body'>
                   <audio src='img/audio/".$linha['Ficheiro']."' class='form-control btn-outline-primary' controls></audio>
                 </div>
    
                 <div class='card-footer'><small>Titulo: </small> <strong>".$linha['Titulo']."</strong>   <span style='float:right' class='btn btn-danger'><a href='midia.php?del=".base64_encode($linha['id'])."&mine=true' style='text-decoration:none;color:black'>delete</a></span></div>
           </div>";
        
            }
        
        }
        
        
        echo "<center><div class='btn btn-outline-primary my-2' data-id='".$id."' id='more11'>Mais</div></center>";
    }else if(isset($_REQUEST['lvideo'])){



        //=========load video================


        //===========fetching videos==========================
        
        $video=new Manager();
        $id1=0;
        $video->setId($_REQUEST['lvideo']);
        $video->setCelular($_SESSION['Numero']);
  

        if($video->loadVideo()->rowCount()==0){
            echo "<style>
            #load12{
               display:none;
            }
            </style>";

            echo "<div class='card my-2 mb-2'><center>Nao ha mais videos aqui</center></div>";
        }
        foreach($video->loadVideo() as $linha){
              $id1=$linha['id'];
            $video->setCelular($linha['Numero']);
        
            foreach($video->fetchUser() as $user){
        
            
           echo "<div class='card mb-2 my-2'>
                 <div class='card-header bg-primary'>Publicado por: <b>".substr($user['Nome'],0,25)."</b></div>
                 <div class='card-body'>
                   <video src='img/video/".$linha['Ficheiro']."' class='form-control btn-outline-primary' controls></video>
                 </div>
    
                 <div class='card-footer'><small>Titulo: </small> <strong>".$linha['Titulo']."</strong> </div>
           </div>";
        
            }
        
        }
        
        
        echo "<center><div class='btn btn-outline-primary my-2' data-id='".$id1."' id='load12'>Mais</div></center>";

        

    }else if(isset($_REQUEST['lmvideo'])){


       //=========load more my audio================


        //===========fetching audios==========================
        
        $video=new Manager();
        $id=0;
        $video->setId($_REQUEST['lmvideo']);
        $video->setCelular($_SESSION['Numero']);
  

        if($video->loadMyVideo()->rowCount()==0){
            echo "<style>
            #load11{
               display:none;
            }
            </style>";

            echo "<div class='card my-2 mb-2'><center>Nao ha mais videos aqui</center></div>";
        }
        foreach($video->loadMyVideo() as $linha){
              $id=$linha['id'];
            $video->setCelular($linha['Numero']);
        
            foreach($video->fetchUser() as $user){
        
            
           echo "<div class='card mb-2 my-2'>
                 <div class='card-header bg-primary'>Publicado por: <b>".substr($user['Nome'],0,25)."</b></div>
                 <div class='card-body'>
                   <video src='img/video/".$linha['Ficheiro']."' class='form-control btn-outline-primary' controls></video>
                 </div>
    
                 <div class='card-footer'><small>Titulo: </small> <strong>".$linha['Titulo']."</strong>   <span style='float:right' class='btn btn-danger'><a href='midia.php?del=".base64_encode($linha['id'])."&mine=true' style='text-decoration:none;color:black'>delete</a></span></div>
           </div>";
        
            }
        
        }
        
        
        echo "<center><div class='btn btn-outline-primary my-2' data-id='".$id."' id='more11'>Mais</div></center>";

    }else if(isset($_REQUEST['ldoc'])){

//==================load docs===================================
        $doc=new Manager();
        $id=0;
        $doc->setId($_REQUEST['ldoc']);

        if($doc->loadDoc()->rowCount()==0){
            echo "<style>
            #more12{
               display:none;
            }
            </style>";

            echo "<div class='card my-2 mb-2'><center>Nao ha mais documentos aqui</center></div>";
        }
        foreach($doc->loadDoc() as $linha){
              $id=$linha['id'];
            $doc->setCelular($linha['Numero']);
        
            foreach($doc->fetchUser() as $user){
        
            
           echo "<div class='card mb-2 my-2'>
                 <div class='card-header bg-primary'>Publicado por: <b>".substr($user['Nome'],0,25)."</b></div>
                 <div class='card-body'>
                
                  <center> <span class='d-block'><img src='svgs/solid/file-word.svg' width=50 height=50>
                  <br>
                  <strong>".$linha['Titulo']."</strong>
                   </span></center>
                 </div>
                    <div class='card-footer'>
                    <a class='btn btn-outline-primary' href='img/doc/".$linha['Ficheiro']."' target='_blank'>Download</a>
                    </div>
           </div>";
        
            }
        
        }
        
        echo "</div>";
        echo "<center><div class='btn btn-outline-primary my-3' data-id='".$id."' id='more12'>Mais</div></center>";
        
        //========================================================



    }else if(isset($_REQUEST['lmdoc'])){


        $doc=new Manager();
        $doc->setCelular($_SESSION['Numero']);
        $doc->setId($_REQUEST['lmdoc']);
        

        if($doc->loadMyDoc()->rowCount()==0){
            echo "<style>
            #load14{
               display:none;
            }
            </style>";

            echo "<div class='card my-2 mb-2'><center>Nao ha mais documentos aqui</center></div>";
        }
        $id=0;
        foreach($doc->loadMyDoc() as $linha){
      
            foreach($doc->fetchUser() as $user){
        $id=$linha['id'];
        echo "<div class='card mb-2 my-2'>
        <div class='card-header bg-primary'>Publicado por: <b>".substr($user['Nome'],0,25)."</b></div>
        <div class='card-body'>
       
         <center> <span class='d-block'><img src='svgs/solid/file-word.svg' width=50 height=50>
         <br>
         <strong>".$linha['Titulo']."</strong>
          </span></center>
        </div>
           <div class='card-footer'>
           <a class='btn btn-outline-primary' href='img/doc/".$linha['Ficheiro']."' target='_blank'>Download</a>
           <a class='btn btn-outline-danger ' style='float:right' href='midia.php?del2=".base64_encode($id)."&mine2=on'>Delete</a>
           </div>
    </div>";
        
            }
        
        }
        echo "<center><div class='btn btn-outline-primary my-2' data-id='".$id."' id='load14'>Mais</div></center>";
        echo "</div>";
        echo "</div>";
        //============================end=================
        


    }else if(isset($_REQUEST['us'])){
        $user=new Manager();
        $user->setCelular($_SESSION['Numero']);
        $user->setId($_REQUEST['us']);
$id=0;

if($user->loadOnlineUser()->rowCount()==0){
    echo "<center><div class='card d-inline'>Nao ha mais usuarios online</div></center>";
    echo "<style>
    #load20{display:none}
    </style>";
}
        foreach($user->loadOnlineUser() as $linha){
            $id=$linha['id_user'];
             if($linha['Avatar']=='' and $linha['Sexo']=='Masculino'){
             
                 echo "<a href='account.php?id=".base64_encode($linha['id_user'])."' style='text-decoration:none;color:black'><div style='margin:5%;'><strong><img src='files/male.png' width=50 height=50> ".substr($linha['Nome'],0,18)." </strong><small style='float:right;color:#0f0'>online</small></div></a>";
             
             }else if($linha['Avatar']=='' and $linha['Sexo']=='Femenino'){
                 echo "<a href='account.php?id=".base64_encode($linha['id_user'])."' style='text-decoration:none;color:black'><div style='margin:5%;'><strong><img src='files/female.png' width=50 height=50> ".substr($linha['Nome'],0,18)." </strong><small style='float:right;color:#0f0'>online</small></div></a>";
             }else{
                 echo "<a href='account.php?id=".base64_encode($linha['id_user'])."' style='text-decoration:none;color:black'><div style='margin:5%;'><strong><img src='img/avatar/".$linha['Avatar']."' width=50 height=50 style='border-radius:15px'> ".substr($linha['Nome'],0,18)." </strong><small style='float:right;color:#0f0'>online</small></div></a>";
         
             }
             
             
             }
         
         
         
         echo "<center><div class='btn btn-outline-primary my-2' data-id='".$id."' id='load20'>Load</div></center>";

    }else if(isset($_REQUEST['idmsg'])){
        //=================load more messages from pvt==================
        $n=new Manager();
$n->setId($_REQUEST['re']);

$friend="";
foreach($n->fetchUserViaId() as $user){
$friend=$user['Nome'];
}
        $m11=new Manager();

        $m11->setCelular($_REQUEST['re']);
        $m11->setNumero($_REQUEST['idmsg']);
        
        $m12=new Manager();
        $m12->setCelular($_SESSION['Numero']);
        $id=0;
        
        foreach($m12->fetchUser() as $l){
            $id=$l['id_user'];
        }
        
        $m11->setId($id);
        $msg=0;
        foreach($m11->loadMessage() as $linha){
        
        $msg=$linha['id'];
        
        
            if($linha['Numero']==$id){
        
        
        if($linha['Ficheiro']!=''){
        
            $fich="";
            if($linha['Ficheiro']=='liked'){
                $fich="<img src='files/liked.png' width=70 height=70>";
            }else{
                if(file_exists("img/status/".$linha['Demo_Msg'])){
                    $string='<img src="img/status/'.$linha['Demo_Msg'].'" width=40 height=40>';
            }else{
        
                if(substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))){
                    $string='<img src="svgs/solid/video.svg" width=40 height=40>';
                }else{
                    $string='<img src="files/deletar.png" width=40 height=40>';
                }
             
            }
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
        
            echo "<input type='hidden' data-id='".$msg."' id='pvt1' data-re='".$_REQUEST['re']."'>";
     
            if($m11->loadMessage()->rowCount()==0){
                echo "<style>
                #pvt{display:none}
                </style>";
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

?>


