<?php  session_start();


include 'classes/Manager.class.php';





if(isset($_REQUEST['id'])){
?>


<!---profileUpdate modal---------->

<div class='modal fade' role='dialog' id='profile1'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<span>
<?php
$m=new Manager();
$m->setId($_REQUEST['id']);

foreach($m->fetchUserViaId() as $linha){
    echo "<b>".$linha['Nome']."</b>";
}

?>
</span>
<button class='close' data-dismiss='modal'>&times;</button>
</div>
<div class='modal-body bg-light'>
<?php
foreach($m->fetchUserViaId() as $linha){
    echo "<img src='img/avatar/".$linha['Avatar']."' class='img-fluid'>";
}

?>
</div>

<div class='modal-footer bg-primary'>
<?php
foreach($m->fetchUserViaId() as $linha){
    echo "<b><span style='word-break:break-word'>".substr($linha['Estados'],0,20)."</span></b>";
}

?>
</div>
</div>
</div>
</div>


<!-------end---------------->

<?php
}else if(isset($_REQUEST['nr'])){
//ocultar numero
$m=new Manager();
$m->setCelular($_SESSION['Numero']);
$m->ocultarNumero();

}else if(isset($_REQUEST['em'])){
//ocultar email
    $m=new Manager();
    $m->setCelular($_SESSION['Numero']);
    $m->ocultarEmail();

}else if(isset($_REQUEST['dt'])){
    //ocultar Data
    $m=new Manager();
    $m->setCelular($_SESSION['Numero']);
    $m->ocultarData();
}else if(isset($_REQUEST['post'])){


    echo "<div id='dvb4' style='display:none' class='bg-light'>";
    echo "<button class='close' id='fecharPost'>&times;</button><br><hr>";
    echo "<div id='st'>";
  
        echo "<style>
        #dvb4{";
    
                echo "border:1px solid rgb(220,220,220);
                
                height:100%;";
                
       
           
            
            echo "width:100%;
            height:100%;
            position:fixed;
            top:0%;
            left:0%;
            word-wrap:break-word;
            overflow-y:auto;
            overflow-x:hidden;
        }
        #dvb4::-webkit-scrollbar{
            width:8px;
            background:#00000000;
        
        }
        
        #dvb4::-webkit-scrollbar-thumb{
        background:#222;
        border-radius:10px;
       
        
        }
    
        @media screen and (max-width:991px){
    
            #dvb4{
               top:0%;
               left:0%;
               width:100%;
               height:100%
            }
    
          
        }
        </style>";

//=========================fetching posts======================
echo "<div id='card'>";
$id1=0;
$post=new Manager();
$post->setId($_REQUEST['post']);
echo "<div class='container' id='fp' >";

if($post->fetcOnlyPost()->rowCount()<=0){
    echo "<br><center><h3>Nao existem posts aqui</h3></center>";
  
}
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
            echo "<div class='btn btn-outline-danger mr-3' style='float:right;' onclick='deletePost1(".$linha['id_posts'].",".$_REQUEST['post'].")'>delete</div>";
           }
          
        echo "</div>";
        echo "</div><br>";
    }
$id1=$linha['id_posts'];
}

echo "<center><div data-id='".$id1."' id='moreP' class='btn btn-outline-dark my-2 mb-2'>Mais</div>";
echo "</div></center>";

//=============================end============================

    echo "</div>";
    
    echo "</div>";
    
    
    //================end===========================
    



}else if(isset($_REQUEST['audio'])){


    $audio=new Manager();
    $id=0;
    $audio->setTexto(filter_var($_REQUEST['audio'],FILTER_SANITIZE_SPECIAL_CHARS));

    if($audio->searchAudio()->rowCount()==0){
        echo "<div class='card my-3 mb-3'><center>Nenhum resultado encontrado para a sua pesquisa</center></div>";
    }
    foreach($audio->searchAudio() as $linha){
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
    
    
  
}else if(isset($_REQUEST['video'])){

    $video=new Manager();
    $id=0;
    $video->setTexto(filter_var($_REQUEST['video'],FILTER_SANITIZE_SPECIAL_CHARS));

    if($video->searchVideo()->rowCount()==0){
        echo "<div class='card my-3 mb-3'><center>Nenhum resultado encontrado para a sua pesquisa</center></div>";
    }
    foreach($video->searchVideo() as $linha){
          $id=$linha['id'];
        $video->setCelular($linha['Numero']);
    
        foreach($video->fetchUser() as $user){
    
        
       echo "<div class='card mb-2 my-2'>
             <div class='card-header bg-primary'>Publicado por: <b>".substr($user['Nome'],0,25)."</b></div>
             <div class='card-body'>
               <video src='img/video/".$linha['Ficheiro']."' class='form-control btn-outline-primary' controls></video>
             </div>
    
             <div class='card-footer'><small>Titulo: </small> <strong>".$linha['Titulo']."</strong></div>
       </div>";
    
        }
    
    }
}else if(isset($_REQUEST['doc'])){


    $doc=new Manager();
    $id=0;
    $doc->setTexto(filter_var($_REQUEST['doc'],FILTER_SANITIZE_SPECIAL_CHARS));

    if($doc->searchDoc()->rowCount()==0){
        echo "<div class='card my-3'><center>Nenhum resultado encontrado para a sua pesquisa</center></div>";
    }
     foreach($doc->searchDoc() as $linha){
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

    
    //========================================================



}else{

    include 'includes/incluir.php';

    echo "<style>
    body{
    background: #007bff;
    }
    </style>";
    echo "<div  style='margin:10% auto;background:white;padding:10px;text-align:center;width:90%'>Nao tem permissao para ver esta pagina<br><a href='index.php' class='btn btn-primary'>LOGIN</a></div>";
    
   

}

echo "<div id='someStatus1'></div>";
?>
<script>


//====================like========================

function like(p){

$.ajax({
    url:'like.php',
    type:'post',
    data:{p:p},
    success:function(data){
        $('.like'+p).html(data)
    }
})
}


//=====================endlike===================

//====================comment========================

function comment(p){

$.ajax({
    url:'like.php',
    type:'post',
    data:{p1:p},
    success:function(data){
   
        $('#someStatus1').html(data)
        $('#dvb2').show(100)
        $('#fp').hide(100)
    }
})
}


//=====================endComment===================

//======================deletePosts======================


function deletePost1(p,y){

$.ajax({
    url:'like.php',
    type:'post',
    data:{p3:p,y:y},
    success:function(data){
$('#card').html(data)
    }
})
}



//====================================================
//=====================loadPosts ====================
$(document).on('click','#moreP',function(){
    var s=$(this).data('id')
    $(this).html("<center><img src='files/load1.gif' width=30 height=30> Processando</center>")
    $.ajax({
        url:'load.php',
        type:'post',
        data:{post1:s},
        success:function(data){
            $('#moreP').remove()
            $('#fp').append(data)
            $('#moreP').text('Mais')
        }
    })
})


//=================end========================================

//=close post
$(document).on('click','#fecharPost',function(){
    $('#dvb4').slideUp();
   
})

//=====================loadComents ====================
$(document).on('click','#comMore',function(){
    var s=$(this).data('id')
    var s1=$(this).data('post')
    $(this).html("<center><img src='files/load1.gif' width=30 height=30> Processando</center>")
    $.ajax({
        url:'load.php',
        type:'post',
        data:{com:s,s1:s1},
        success:function(data){
            $('#comMore').remove()
            $('#body').append(data)
            $('#comMore').text('Mais')
        }
    })
})


//=================end========================================

//===============================sendComents====

function comentar(p){
  
  var texto=$('#msgCom').val();
  
  if(texto!=''){
  
  $.ajax({
      url:'like.php',
      type:'post',
      data:{idPost:p,txt:texto},
      success:function(data){
         $('#msgCom').val("")
         $('#body').html(data);
      }
      
      
  })
  
  }
  
  }




//=====end===

//==============delete comments===========================

function delCom(p,y){
   
   $.ajax({
       url:'like.php',
       type:'post',
       data:{del:p,pos:y},
       success:function(data){
           $('#body').html(data)
       }
   })
   
   }
   
   //===========end=========================

</script>

