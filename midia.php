<?php session_start();
ob_start();

include 'includes/incluir.php';
include 'classes/Manager.class.php';


?>


<style>


#aside{
    height:100%;
    width:69%;
    overflow:auto;
    float:right;
    position:relative;
    top:2%;
    padding:10px;
    
}


.more{
    background:rgba(0,0,200,0.2)
}
#aside::-webkit-scrollbar{
    width:10px;
    background:white
}

#aside::-webkit-scrollbar-thumb{
background:gray;
border-radius:15px;

}


@media screen and (max-width:991px){
    #aside{
        width:100%
    }
 
   
}

@media screen and (min-width:992px) and (max-width:1024px){
    #aside{
       width:64%;
    }

}


</style>

<!---new Audio modal---------->

<div class='modal fade' role='dialog' id='newFile'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>
<form method='post' enctype='multipart/form-data'>

<div class='container'><input type='text' id='txt' name='txt' class='form-control my-3 mb-3' placeholder='Titulo' maxLength=70 minLength=2></div>

<div class='modal-footer bg-primary'>
<div style='text-align:center;margin:auto'>
<input type='file' name='file' style='width:80px;height:100px;position:relative;left:50%;top:8%;opacity:0'>
<img src='svgs/solid/file-audio.svg' width=80 height=80 style=';cursor:pointer'></span>
</div>
<input type='submit' name='btnAudio' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>



<!-----script------------------>



<!---new video modal---------->

<div class='modal fade' role='dialog' id='newFileVideo'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>
<form method='post' enctype='multipart/form-data'>

<div class='container'><input type='text' id='txt' name='txt' class='form-control my-3 mb-3' placeholder='Titulo' maxLength=70 minLength=2></div>

<div class='modal-footer bg-primary'>
<div style='text-align:center;margin:auto'>
<input type='file' name='file' style='width:80px;height:100px;position:relative;left:50%;top:8%;opacity:0'>
<img src='svgs/solid/file-video.svg' width=80 height=80 style=';cursor:pointer'></span>
</div>
<input type='submit' name='btnVideo' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>





<!---new doc modal---------->

<div class='modal fade' role='dialog' id='newFileDoc'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>
<form method='post' enctype='multipart/form-data'>

<div class='container'><input type='text' id='txt' name='txt' class='form-control my-3 mb-3' placeholder='Titulo' maxLength=70 minLength=2></div>

<div class='modal-footer bg-primary'>
<div style='text-align:center;margin:auto'>
<input type='file' name='file' style='width:80px;height:100px;position:relative;left:50%;top:8%;opacity:0'>
<img src='svgs/solid/file-pdf.svg' width=80 height=80 style=';cursor:pointer'></span>
</div>
<input type='submit' name='btnDoc' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>
<!-----script------------------>



<script>
//==========================load more audio===========
$(document).ready(function(){
$(document).on('click','#more11',function(){
    var x=$(this).data('id')
 

    $.ajax({
        url:'load.php',
        type:'post',
        data:{laudio:x},
        success:function(data){

            $('#more11').remove()
            $('.aside').append(data)
          
        }
    })
})


//==========================load more doc===========

$(document).on('click','#more12',function(){
    var x=$(this).data('id')
 

    $.ajax({
        url:'load.php',
        type:'post',
        data:{ldoc:x},
        success:function(data){

            $('#more12').remove()
            $('.aside1').append(data)
          
        }
    })
})


//====================load my audio====================
$(document).on('click','#load11',function(){
    var x=$(this).data('id')
 

    $.ajax({
        url:'load.php',
        type:'post',
        data:{lmaudio:x},
        success:function(data){

            $('#load11').remove()
            $('#myAud').append(data)
          
        }
    })
})

//====================load my video====================
$(document).on('click','#load13',function(){
    var x=$(this).data('id')
 

    $.ajax({
        url:'load.php',
        type:'post',
        data:{lmvideo:x},
        success:function(data){

            $('#load13').remove()
            $('#myVid').append(data)
          
        }
    })
})


//====================load my docs====================
$(document).on('click','#load14',function(){
    var x=$(this).data('id')
 

    $.ajax({
        url:'load.php',
        type:'post',
        data:{lmdoc:x},
        success:function(data){

            $('#load14').remove()
            $('#myDoc').append(data)
          
        }
    })
})
<?php if(isset($_REQUEST['audio'])){?>
//=======================search audio============================
$('#search').attr('placeholder','Audio');

$('#search').keyup(function(){
    $.ajax({
        url:'profile.php',
        type:'post',
        data:{audio:$(this).val()},
        success:function(data){
            $('.aside').html(data);
        }
    })
})




<?php
}
?>


<?php if(isset($_REQUEST['video'])){?>
//=======================search video============================
$('#search').attr('placeholder','Video');

$('#search').keyup(function(){
    $.ajax({
        url:'profile.php',
        type:'post',
        data:{video:$(this).val()},
        success:function(data){
            $('.video').html(data);
        }
    })
})




<?php
}else if(isset($_REQUEST['doc'])){
?>

//==================================searchDoc============

//=======================search video============================
$('#search').attr('placeholder','Documentos');

$('#search').keyup(function(){
    $.ajax({
        url:'profile.php',
        type:'post',
        data:{doc:$(this).val()},
        success:function(data){
            $('.aside1').html(data);
        }
    })
})



<?php
}
?>

})
//==========================load more videos=================


$(document).on('click','#load12',function(){
    var x=$(this).data('id')
 

    $.ajax({
        url:'load.php',
        type:'post',
        data:{lvideo:x},
        success:function(data){

            $('#load12').remove()
            $('.video').append(data)
          
        }
    })
})


</script>

<!-----end-->

<!-------end---------------->

<?php


include 'includes/nav.php';
include 'includes/section.php';



//================my docs===================


//=======================my video===============

if(isset($_REQUEST['mine2'])){
    echo "<div id='aside' class='bg-light '>";
    
    
    echo "<div class='card d-block' style='padding:5px'><a href='midia.php?doc=true style='text-decoration:none;color:black'><span class='ml-2 mr-2 btn btn-primary'>>></span></a></div>";
    
    
    echo "<div id='myDoc'>";
    $audio=new Manager();
    $audio->setCelular($_SESSION['Numero']);
    
    foreach($audio->fetchMyDoc() as $linha){
    $id=0;
        foreach($audio->fetchUser() as $user){
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
    
    
    
    //================deleting doc========================
    
    if(isset($_REQUEST['del2'])){
    
        $m=new Manager();
        $m->setId(base64_decode($_REQUEST['del2']));

        foreach($m->fetchDocToDel() as $linha){
            if(file_exists('img/doc/'.$linha['Ficheiro'])){
                unlink('img/doc/'.$linha['Ficheiro']);
            }
        }
        $m->deleteDoc();
        header('location:midia.php?mine2=true');
        
        
        }
        
        
        //======================end=================================
    
    

        exit;
}


//=================end==========================



//=======================my audios===============

if(isset($_REQUEST['mine'])){
echo "<div id='aside' class='bg-light '>";


echo "<div class='card d-block' style='padding:5px'><a href='midia.php?audio=true style='text-decoration:none;color:black'><span class='ml-2 mr-2 btn btn-primary'>>></span></a></div>";


echo "<div id='myAud'>";
$audio=new Manager();
$audio->setCelular($_SESSION['Numero']);

foreach($audio->fetchMyAudio() as $linha){
$id=0;
    foreach($audio->fetchUser() as $user){
$id=$linha['id'];
   echo "<div class='card mb-2 my-2'>
         <div class='card-header bg-primary'>Publicado por: <b>".substr($user['Nome'],0,25)."</b></div>
         <div class='card-body'>
           <audio src='img/audio/".$linha['Ficheiro']."' class='form-control btn-outline-primary' controls></audio>
         </div>

         <div class='card-footer'><small>Titulo: </small> <strong>".$linha['Titulo']."</strong><span style='float:right' class='btn btn-danger'><a href='midia.php?del=".base64_encode($linha['id'])."&mine=true' style='text-decoration:none;color:black'>delete</a></span></div>
   </div>";

    }

}
echo "<center><div class='btn btn-outline-primary my-2' data-id='".$id."' id='load11'>Mais</div></center>";
echo "</div>";
echo "</div>";
//============================end=================



//================deleting audio========================

if(isset($_REQUEST['del'])){

    $m=new Manager();
    $m->setId(base64_decode($_REQUEST['del']));

    foreach($m->fetchAudioToDel() as $linha){
        if(file_exists('img/audio/'.$linha['Ficheiro'])){
            unlink('img/audio/'.$linha['Ficheiro']);
        }
    }

    $m->deleteAudio();
    header('location:midia.php?mine=true');
    
    
    }
    
    
    //======================end=================================

exit;
}


//=============audio===================

if(isset($_REQUEST['audio'])){

    echo "<div id='aside' class='bg-light'>";

echo "<div class='card d-block'><a href='midia.php?mine=true' style='text-decoration:none;color:black'><span class='ml-5 mr-5'><img src='svgs/solid/folder.svg' width=50 height=50></span></a> <span   data-target='#newFile' data-toggle='modal'><img src='svgs/solid/plus.svg' width=50 height=50></span></div>";

//===========fetching audios==========================
echo "<div class='aside'>";
$audio=new Manager();
$id=0;
foreach($audio->fetchAudio() as $linha){
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

echo "</div>";
echo "<center><div class='btn btn-outline-primary my-3' data-id='".$id."' id='more11'>Mais</div></center>";

//========================================================
echo "</div>";



//=================inserir audio==================

if(isset($_REQUEST['btnAudio'])){

    if($_REQUEST['txt']!='' && $_FILES['file']['name']!='' && ($_FILES['file']['type']=='audio/mpeg' || $_FILES['file']['type']=='audio/mp3' || substr($_FILES['file']['name'],strlen($_FILES['file']['name'])-4)=='.m4a' && strlen($_REQUEST['txt'])>=2 && strlen($_REQUEST['txt'])<71) && $FILES['file']['size']<31457280){
    $m=new Manager();
    $m->setTexto(filter_var($_REQUEST['txt'],FILTER_SANITIZE_SPECIAL_CHARS));
    $m->setCelular($_SESSION['Numero']);
    
    $id=0;

    foreach($m->fetchUser() as $li){
        $id=$li['id_user'];
    }

    $m->setId($id);

  if(file_exists('img/audio/'.$_FILES['file']['name'])){
      $rand=rand(0,999);
      $m->setProfile($rand.'.'.$_FILES['file']['name']);
      move_uploaded_file($_FILES['file']['tmp_name'],'img/audio/'.$rand.".".$_FILES['file']['name']);

  }else{
    $m->setProfile($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'],'img/audio/'.$_FILES['file']['name']);

  }

$m->insertAudio();
header('location:midia.php?audio=true');

}else{

    echo "<script>alert('Audio invalido')</script>";

}
    


}


//=========================end==========================

    exit;
}

//====================end===================


//===============================doc============================


if(isset($_REQUEST['doc'])){



    echo "<div id='aside' class='bg-light'>";

echo "<div class='card d-block'><a href='midia.php?mine2=true' style='text-decoration:none;color:black'><span class='ml-5 mr-5'><img src='svgs/solid/folder.svg' width=50 height=50></span></a> <span   data-target='#newFileDoc' data-toggle='modal'><img src='svgs/solid/plus.svg' width=50 height=50></span></div>";

//===========fetching docs==========================
echo "<div class='aside1'>";
$doc=new Manager();
$id=0;
foreach($doc->fetchDoc() as $linha){
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
echo "</div>";



//=================inserir audio==================

if(isset($_REQUEST['btnDoc'])){

    if($_REQUEST['txt']!='' && $_FILES['file']['name']!='' && ($_FILES['file']['type']=='application/pdf' || $_FILES['file']['type']=='application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||  $_FILES['file']['type']=='application/vnd.openxmlformats-officedocument.presentationml.presentation' || $_FILES['file']['type']=='text/plain') && strlen($_REQUEST['txt'])>=2 && strlen($_REQUEST['txt'])<71 && $FILES['file']['size']<31457280) {

    $m=new Manager();
    $m->setTexto(filter_var($_REQUEST['txt'],FILTER_SANITIZE_SPECIAL_CHARS));
    $m->setCelular($_SESSION['Numero']);
    
    $id=0;

    foreach($m->fetchUser() as $li){
        $id=$li['id_user'];
    }

    $m->setId($id);

  if(file_exists('img/audio/'.$_FILES['file']['name'])){
      $rand=rand(0,999);
      $m->setProfile($rand.'.'.$_FILES['file']['name']);
      move_uploaded_file($_FILES['file']['tmp_name'],'img/doc/'.$rand.".".$_FILES['file']['name']);

  }else{
    $m->setProfile($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'],'img/doc/'.$_FILES['file']['name']);

  }

$m->insertDoc();
header('location:midia.php?doc=on');

}else{

    echo "<script>alert('Documento invalido')</script>";

}
    



}
exit;
}

//=========================end==========================








//=========================================video=====================

if(isset($_REQUEST['video'])){



//=======================my videos===============

if(isset($_REQUEST['mine1'])){
    echo "<div id='aside' class='bg-light '>";
    
    
    echo "<div class='card d-block' style='padding:5px;'><a href='midia.php?video=true style='text-decoration:none;color:black'><span class='ml-2 mr-2 btn btn-primary' style=''>>></span></a></div>";
    
    
    echo "<div id='myVid'>";
    $video=new Manager();
    $video->setCelular($_SESSION['Numero']);
    
    foreach($video->fetchMyVideo() as $linha){
    $id=0;
        foreach($video->fetchUser() as $user){
    $id=$linha['id'];
       echo "<div class='card mb-2 my-2'>
             <div class='card-header bg-primary'>Publicado por: <b>".substr($user['Nome'],0,25)."</b></div>
             <div class='card-body'>
               <video src='img/video/".$linha['Ficheiro']."' class='form-control btn-outline-primary' controls></video>
             </div>
    
             <div class='card-footer'><small>Titulo: </small> <strong>".$linha['Titulo']."</strong><span style='float:right' class='btn btn-danger'><a href='midia.php?del1=".base64_encode($linha['id'])."&mine1=true' style='text-decoration:none;color:black'>delete</a></span></div>
       </div>";
    
        }
    
    }
    echo "<center><div class='btn btn-outline-primary my-3' data-id='".$id."' id='load13'>Mais</div></center>";
    echo "</div>";
    echo "</div>";
    //============================end=================
    
    
    

    
    exit;
    }
    




    echo "<div id='aside' class='bg-light ' >";
    echo "<div class='card d-block'><a href='midia.php?mine1=true&video=true' style='text-decoration:none;color:black'><span class='ml-5 mr-5'><img src='svgs/solid/folder.svg' width=50 height=50></span></a> <span   data-target='#newFileVideo' data-toggle='modal'><img src='svgs/solid/plus.svg' width=50 height=50></span></div>";
echo "<div class='video'>";
    $video=new Manager();
    $id=0;
    foreach($video->fetchVideo() as $linha){
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
    
    
    echo "<center><div class='btn btn-outline-primary my-2' data-id='".$id."' id='load12'>Mais</div></center>";
    
    echo "</div></div>";
    //========================================================


  echo "</div>";


//===============insert video======================

if(isset($_REQUEST['btnVideo'])){

$txt=$_REQUEST['txt'];
$file=$_FILES['file'];

if($txt!='' && strlen($txt)>1 && strlen($txt)<70 && $file['type']=='video/mp4' && $file['size']<31457280){


$video=new Manager();
$video->setTexto(filter_var($txt,FILTER_SANITIZE_SPECIAL_CHARS));
$video->setCelular($_SESSION['Numero']);

$id=0;

foreach($video->fetchUser() as $li){
    $id=$li['id_user'];
}

$video->setId($id);

if(file_exists('img/video/'.$_FILES['file']['name'])){
  $rand=rand(0,999);
  $video->setProfile($rand.'.'.$_FILES['file']['name']);
  move_uploaded_file($_FILES['file']['tmp_name'],'img/video/'.$rand.".".$_FILES['file']['name']);

}else{
$video->setProfile($_FILES['file']['name']);
move_uploaded_file($_FILES['file']['tmp_name'],'img/video/'.$_FILES['file']['name']);

}

$video->insertVideo();
header('location:midia.php?video=true');

}else{

    echo "<script>alert('Video invalido')</script>";

}





}



//==========================================




    exit;
}




//================================================================end===




echo "<div id='aside' class='bg-light '>";

                echo "<a href='midia.php?audio=yes' style='text-decoration:none;color:black'><div class='card d-block bg-primary text-light' style='margin-bottom:2px;padding:10px'>Audio</div></a>";
      
                echo "<a href='midia.php?video=true' style='text-decoration:none;color:black'><div class='card d-block bg-primary text-light' style='margin-bottom:2px;padding:10px'>Video</div></a>";

           

                echo "<a href='midia.php?doc=on' style='text-decoration:none;color:black'><div class='card d-block bg-primary text-light' style='margin-bottom:2px;padding:10px'>Documentos</div></a>";

     
echo "</div>";

//==========end===============================



    //================deleting video========================
    
    if(isset($_REQUEST['del1'])){
    
        $m=new Manager();
        $m->setId(base64_decode($_REQUEST['del1']));
        foreach($m->fetchVideoToDel() as $linh){
            if(file_exists('img/video/'.$linh['Ficheiro'])){
                unlink('img/video/'.$linh['Ficheiro']);
            }
        }

        $m->deleteVideo();
        header('location:midia.php?mine1=true&video=true');
        
        
        }
        
        
        //======================end=================================


ob_end_flush();

?>

