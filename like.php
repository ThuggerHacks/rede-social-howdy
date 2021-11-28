
<?php  session_start();

include 'classes/Manager.class.php';






if(isset($_REQUEST['p'])){
    //=============likes===============
$insert=new Manager();
$insert->setCelular($_SESSION['Numero']);
$insert->setId($_REQUEST['p']);
$insert->insertLike();








echo " ".$insert->fetchLikes()->rowCount();
}else if(isset($_REQUEST['p1'])){
//==============comments====================


echo "<div id='dvb2' style='display:none' class='bg-primary'>";




    echo "<style>
    #dvb2{";

  
        

        echo "width:100%;
        height:100%;
        position:fixed;
        top:0%;
        left:0%;
        word-wrap:break-word;
        border:1px solid rgb(220,220,220);

        
    }
    #dvb2::-webkit-scrollbar{
        width:10px;
        background:white
    }
    
    #dvb2::-webkit-scrollbar-thumb{
    background:gray;
    border-radius:15px;
    
    }
#header{
    position:relative;
    top:0%;
    left:0%;
    width:100%;
    height:10%;
}

#body{
height:68%;
overflow-y:auto;
overflow-x:hidden;
word-wrap:break-word;
padding:10px;
}

#footer{


padding:10px;
margin:10px auto;


}

@media screen and (max-width:991px){

        #dvb2{
           top:0%;
           left:0%;
           width:100%;
           height:100%
        }

      
    }
    </style>";

echo "<div class='bg-primary' id='header'>";
echo "<button class='close' id='closar2'>&times;</button>";
$postN=new Manager();


$postN->setId($_REQUEST['p1']);

$texto="";
$id=0;
if($postN->fetchCom()->rowCount()==1){
    $texto="Comentario";
}else{
    $texto="Comentarios";
}


foreach($postN->fetchUserPost() as $linha){

    $postN->setCelular($linha['Numero']);

    foreach($postN->fetchUser() as $linh){
        echo "<div style='text-align:center;font-size:15px;color:white;font-weight:bolder;margin:auto'>Comentar post de <b>".substr($linh['Nome'],0,15)."</b><br><small>{$postN->fetchCom()->rowCount()} ".$texto."</small></div>";
    }

}


echo "</div>";
echo "<div class='bg-light' id='body'>";
echo "<div id='m'>";
$fetch=new Manager();
$fetch->setId($_REQUEST['p1']);
$day=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
$mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
foreach($fetch->fetchComments() as $linha){
    $time=localtime($linha['Hora_Comentario'],true);

  $fetch->setCelular($linha['Numero_poster']);

  foreach($fetch->fetchUser() as $nome){
echo "<div class='card mb-2 my-2' >
<div class='card-header'><strong>".substr($nome['Nome'],0,15)."</strong><small style='float:right'>".$mes[$time['tm_mon']]." ".$time['tm_mday'].", ".$time['tm_hour'].":".$time['tm_min']."</small></div>
<div class='card-body bg-light'>".$linha['Mensagem']."</div>";
if($linha['Numero_poster']==$_SESSION['Numero']){
    echo "<div class='card-footer bg-light'><button class='btn btn-outline-danger' style='float:right' onclick='delCom(".$linha['id'].",".$_REQUEST['p1'].")'>delete</button></div>";
}
  


echo "</div>";

  }
  $id=$linha['id'];
}


echo "</div>";
echo "<center><div class='btn btn-outline-primary mr-2 mr-2' data-id='".$id."'  data-post='".$_REQUEST['p1']."' id='comMore'>Mais</div></center>";
echo "</div>";
echo "<div class='bg-primary' id='footer'>
<textarea class='form-control' placeholder='Mensagem' id='msgCom' maxLength=10000></textarea>
<input type='button' name='comentar'  class='btn btn-light my-2 mb-2' value='comentar' onclick='comentar(".$_REQUEST['p1'].")' >
<input type='button' name='Likes'  class='btn btn-dark my-2 mb-2 text-light' value='ver likes' onclick='seeLikes(".$_REQUEST['p1'].")' >
</div>";

echo "</div>";


//==============================================see likes=====================


echo "<div id='dvblike' style='display:none' class='bg-primary'>";




    echo "<style>
    #dvblike{";

  
        

        echo "width:100%;
        height:100%;
        position:fixed;
        top:0%;
        left:0%;
        word-wrap:break-word;
        border:1px solid rgb(220,220,220);
       
        

        
    }
    #dvblike::-webkit-scrollbar{
        width:10px;
        background:white
    }
    
    #dvblike::-webkit-scrollbar-thumb{
    background:gray;
    border-radius:15px;
    
    }

   #container{
    padding:10px;height:90%;overflow:auto
   }

    #container::-webkit-scrollbar{
    width:10px;
    background:white
    }

    #container::-webkit-scrollbar-thumb{
    background:gray;
    border-radius:15px;

}
@media screen and (max-width:991px){

        #dvblike{
           top:0%;
           left:0%;
           width:100%;
           height:100%
        }

      
    }
    </style>";
    echo "";


$m=new Manager();
$m->setId($_REQUEST['p1']);
echo "<div class='card-header bg-primary' ><button class='close' id='closarLikes'>&times;</button><center style='font-weight:bolder'>Likes (".$m->fetchLikes()->rowCount().")</center></div>";
echo "<div id='container'>";
if($m->fetchLikes()->rowCount()==0){
    echo "<div class='card-header bg-light text-center'><strong class='text-center'>Nao ha likes aqui!</strong></div>";
}
foreach($m->fetchLikes() as $likes){
    $m->setCelular($likes['Numero']);
    
    foreach($m->fetchUser() as $user){
       
        if($user['Numero']!=$_SESSION['Numero']){
               echo "<div class='card-header bg-light'><a href='account.php?id=".base64_encode($user['id_user'])."' style='text-decoration:none'><strong >".$user['Nome']."</strong></a></div>";
        }else{
            echo "<div class='card-header bg-light'><a href='account.php' style='text-decoration:none'><strong >".$user['Nome']."</strong></a></div>";
        }
     
    }
}


echo "</div>";

echo "</div>";
//====================insert comments=============



//====================insert comments=============

}else if(isset($_REQUEST['idPost'])){

$com=new Manager();
$com->setCelular($_SESSION['Numero']);
$com->setId($_REQUEST['idPost']);
$com->setTexto(filter_var($_REQUEST['txt'],FILTER_SANITIZE_SPECIAL_CHARS));

$n=0;

foreach($com->fetchUser() as $linha){
    $n=$linha['id_user'];
}
$com->setNumero($n);
$com->insertComments();
$fetch=new Manager();
$fetch->setId($_REQUEST['idPost']);
$day=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
$mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
foreach($fetch->fetchComments() as $linha){
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

  echo "<center><div class='btn btn-outline-primary mr-2 mr-2' data-id='".$id."'  data-post='".$_REQUEST['idPost']."' id='comMore'>Mais</div></center>";
}else if(isset($_REQUEST['del'])){
$id=0;
    $del=new Manager();
    $del->setId($_REQUEST['del']);
    $del->deleteCom();

    $fetch=new Manager();
    $fetch->setId($_REQUEST['pos']);
    $day=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
    $mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
    foreach($fetch->fetchComments() as $linha){
        $time=localtime($linha['Hora_Comentario'],true);
    $id=$linha['id'];
      $fetch->setCelular($linha['Numero_poster']);
    
      foreach($fetch->fetchUser() as $nome){
    echo "<div class='card mb-2 my-2' >
    <div class='card-header'><strong>".$nome['Nome']."</strong><small style='float:right'>".$mes[$time['tm_mon']]." ".$time['tm_mday'].", ".$time['tm_hour'].":".$time['tm_min']."</small></div>
    <div class='card-body bg-light'>".$linha['Mensagem']."</div>";
    if($linha['Numero_poster']==$_SESSION['Numero']){
        echo "<div class='card-footer bg-light'><button class='btn btn-outline-danger' style='float:right' onclick='delCom(".$linha['id'].",".$_REQUEST['pos'].")'>delete</button></div>";
    }
      
     
    
    echo "</div>";
    
      }
    }
    
    echo "<center><div class='btn btn-outline-primary mr-2 mr-2' data-id='".$id."'  data-post='".$_REQUEST['del']."' id='comMore'>Mais</div></center>";


}else if(isset($_REQUEST['p3'])){


    $m=new Manager();
    $m->setId($_REQUEST['p3']);

    $motor=$m->fetchUserPost();
    foreach($motor as $linha){
        if($linha['Ficheiro']!=''){
        unlink('img/img/'.$linha['Ficheiro']);
    }
        
    }
    $m->deletePosts();
    $m->deleteLikes();

    $id1=0;
$post=new Manager();
$post->setId($_REQUEST['y']);
echo "<div class='container' id='fp' >";
foreach($post->fetcOnlyPost() as $linha){

    $post->setCelular($linha['Numero']);
$time=localtime($linha['Hora'],true);
$day=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
$mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
    foreach($post->fetchUser() as $linh){
        echo "<div class='card' >";

        echo "<div class='card-header bg-primary'><div>";
          
       if($linh['Avatar']!=''){
         
        //=====================sessionNist------------------------------
        if($linh['Numero']==$_SESSION['Numero']){

            echo "<a href='account.php' style='text-decoration:none;color:black'><img src='img/avatar/".$linh['Avatar']."' style='width:30px;height:30px;border-radius:50%'><strong> ".$linh['Nome']."</strong></a>";
            
        }else{
//==============================non========================
            echo "<a href='account.php?id=".base64_encode($linh['id_user'])."' style='text-decoration:none;color:black'><img src='img/avatar/".$linh['Avatar']."' style='width:30px;height:30px;border-radius:50%'><strong> ".$linh['Nome']."</strong></a>";

        }
       

       }else if($linh['Avatar']=='' && $linh['Sexo']=='Masculino'){
    if($linh['Numero']==$_SESSION['Numero']){
        //=============sessionNist======================

        echo "<a href='account.php' style='text-decoration:none;color:black'><img src='files/male.png' style='width:30px;height:30px;'><strong> ".$linh['Nome']."</strong></a>"; 
    }else{
        //=================non========================
        echo "<a href='account.php?id=".base64_encode($linh['id_user'])."' style='text-decoration:none;color:black'><img src='files/male.png' style='width:30px;height:30px;'><strong> ".$linh['Nome']."</strong></a>"; 
    }

       

       }else{

        if($linh['Numero']==$_SESSION['Numero']){
            echo "<a href='account.php?id=".base64_encode($linh['id_user'])."' style='text-decoration:none;color:black'><img src='files/female.png' style='width:30px;height:30px;'><strong> ".$linh['Nome']."</strong></a>"; 
        }else{
            echo "<a href='account.php' style='text-decoration:none;color:black'><img src='files/female.png' style='width:30px;height:30px;'><strong> ".$linh['Nome']."</strong></a>"; 
        }

      

       }
      
        
        echo "<small style='float:right'> ".$mes[$time['tm_mon']]." ".$time['tm_mday'].",".$time['tm_hour'].":".$time['tm_min']."</small></div>";
        echo "</div>";
        echo "<div class='card-body'>";
        if($linha['Ficheiro']=='' && $linha['Mensagem']!=''){
            echo "<span>".$linha['Mensagem']."</span>";
        }else if($linha['Ficheiro']!='' && $linha['Mensagem']==''){
            echo "<center><img src='img/img/".$linha['Ficheiro']."' class='img-fluid'></center>";
        }else{
            echo "<span>".$linha['Mensagem']."</span><br>";
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
            echo "<div class='btn btn-outline-danger mr-3' style='float:right;' onclick='deletePost1(".$linha['id_posts'].",".$_REQUEST['y'].")'>delete</div>";
           }
          
        echo "</div>";
        echo "</div><br>";
    }
$id1=$linha['id_posts'];
}
echo "<center><div data-id='".$id1."' id='moreP' class='btn btn-outline-dark my-2 mb-2'>Mais</div>";
echo "</div></center>";



}else if(isset($_REQUEST['notificacao'])){




//=========================fetching posts======================


echo "<div id='dvb5' style='display:none'>";

echo "<div id='st'>";

echo "<button class='close' id='closar' style='outline:none'>&times;</button>";


echo "<style>
#dvb5{";


    echo "width:100%;
    height:100%;
    position:fixed;
    top:0%;
    left:0%;
    word-wrap:break-word;
    overflow-y:auto;
    background:white
}

#dvb5::-webkit-scrollbar{
    width:10px;
    background:white
}

#dvb5::-webkit-scrollbar-thumb{
background:gray;
border-radius:15px;

}

@media screen and (max-width:991px){

    #dvb5{
       top:0%;
       left:0%;
       width:100%;
       height:100%
    }

  
}
</style>";

$id1=0;
$post=new Manager();
echo "<br><hr><div class='container' id='fp'>";
$post->setId($_REQUEST['notificacao']);
foreach($post->fetchUserPost() as $linha){

    $post->setCelular($linha['Numero']);
$time=localtime($linha['Hora'],true);
$day=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
$mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
    foreach($post->fetchUser() as $linh){
        echo "<div class='card' >";

        echo "<div class='card-header bg-primary'><div>";
          
       if($linh['Avatar']!=''){
         
        //=====================sessionNist------------------------------
        if($linh['Numero']==$_SESSION['Numero']){

            echo "<a href='account.php' style='text-decoration:none;color:black'><img src='img/avatar/".$linh['Avatar']."' style='width:30px;height:30px;border-radius:50%'><strong> ".substr($linh['Nome'],0,15)."</strong></a>";
            
        }else{
//==============================non========================
            echo "<a href='account.php?id=".base64_encode($linh['id_user'])."' style='text-decoration:none;color:black'><img src='img/avatar/".$linh['Avatar']."' style='width:30px;height:30px;border-radius:50%'><strong> ".substr($linh['Nome'],0,15)."</strong></a>";

        }
       

       }else if($linh['Avatar']=='' && $linh['Sexo']=='Masculino'){
    if($linh['Numero']==$_SESSION['Numero']){
        //=============sessionNist======================

        echo "<a href='account.php' style='text-decoration:none;color:black'><img src='files/male.png' style='width:30px;height:30px;'><strong> ".substr($linh['Nome'],0,15)."</strong></a>"; 
    }else{
        //=================non========================
        echo "<a href='account.php?id=".base64_encode($linh['id_user'])."' style='text-decoration:none;color:black'><img src='files/male.png' style='width:30px;height:30px;'><strong> ".substr($linh['Nome'],0,15)."</strong></a>"; 
    }

       

       }else{

        if($linh['Numero']==$_SESSION['Numero']){
            echo "<a href='account.php?id=".base64_encode($linh['id_user'])."' style='text-decoration:none;color:black'><img src='files/female.png' style='width:30px;height:30px;'><strong> ".substr($linh['Nome'],0,15)."</strong></a>"; 
        }else{
            echo "<a href='account.php' style='text-decoration:none;color:black'><img src='files/female.png' style='width:30px;height:30px;'><strong> ".substr($linh['Nome'],0,15)."</strong></a>"; 
        }

      

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



echo "</div>";

echo "</div>";
//=============================end============================
  



}else if(isset($_REQUEST['p2'])){

    $m=new Manager();
    $m->setId($_REQUEST['p2']);

    $motor=$m->fetchUserPost();
    foreach($motor as $linha){
        if($linha['Ficheiro']!=''){
        unlink('img/img/'.$linha['Ficheiro']);
    }
        
    }
    $m->deletePosts();
    $m->deleteLikes();

 

  
   




}else if(isset($_REQUEST['dark'])){

    //==============change theme====================
$theme=new Manager();
$theme->setCelular($_SESSION['Numero']);

$color=0;

if($_REQUEST['dark']=='true'){
    $color=2;
}else{
    $color=1;
}

$theme->setTexto($color);
$theme->changeTheme();
#==========================end====================
}else if(isset($_REQUEST['follow'])){
//==================follow and unfollow=====================

$follow=new Manager();
$follow->setNumero($_REQUEST['follow']);
$follow->setCelular($_REQUEST['follower']);
$follow->follow();

echo $follow->fetchFollower();


//===============end=================================
    
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
<script>

$('#closar2').click(function(){
    $('#dvb2').hide(100)
    $('#fp').show(100)

})

$('#closarLikes').click(function(){
    $('#dvblike').hide(100)
    $('#dvb2').show(100)

})



function seeLikes(id){
    // $('#dvblike').removeAttr('style')
$('#dvblike').slideDown(100)
}

</script>
