

<style>

@font-face{
    font-family:"thugger";
    src:url(font/PaintDropsRegular-0WaJo.ttf)
}


@font-face{
    font-family:"thugger1";
    src:url(font/YouthTouchDemoRegular-4VwY.ttf)
}
</style>

<?php session_start();


include 'includes/incluir.php';
include 'classes/Manager.class.php';


$m=new Manager();
$m->setCelular($_SESSION['Numero']);
$motor=$m->fetchFirstTime();

if($motor->rowCount()!=0){

//===========styles=============

echo "<style>

#dvInfo{
    width:80%;
    background:white;
    margin:5% auto;
    text-align:center
    
 }

body{
    background:#007bff;
}

</style>";

//================over==============
echo "<br><center><h3 class='text-light' style='font-family:thugger'>HOWDY</h3></center>";
echo "<div id='dvInfo'>

<br><center><h4>Actualize a sua foto de perfil</h4></center><hr>";
foreach($motor as $linha){
    if($linha['Sexo']=='Masculino'){

        echo "<img src='files/male.png' width=180 height=180>";
    }else{
        echo "<img src='files/female.png' width=180 height=180>";
    }
}


echo "<br><div  class='btn btn-outline-primary text-dark' data-toggle='modal' data-target='#modal'><b>Atualizar</b></div><a style='margin:20px'  class='btn btn-light text-dark' href='avancar1.php?skip=true'><b>Pular</b></a>";

"</div>";

}else{

    echo "<style>

  #cardW{
      margin:10% auto;
      width:80%;
      text-align:center
      
  }
  body{background:#007bff}
    
    </style>";

echo "<div class='card' id='cardW'>

<div class='card-body'>
<div class='card-item'>";


echo '<span style="font-weight:bolder;font-size:35px;">Ola, Seja Bem vindo(a) ao Howdy</span>';
echo "<br><br><a class='btn btn-outline-primary' href='avancar1.php'>Continuar</a>";

"</div>

</div>

</div>";

}

?>

<!---profileUpdate modal---------->

<div class='modal fade' role='dialog' id='modal'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>


<form method='post' enctype='multipart/form-data'>
<div class='modal-footer bg-primary'>
<div style='text-align:center;margin:auto'>
<input type='file' name='file' style='width:80px;height:100px;position:relative;left:50%;top:8%;opacity:0'>
<img src='svgs/solid/camera.svg' width=80 height=80 style=';cursor:pointer'></span>
</div>
<input type='submit' name='btnFoto' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>

<!-------end---------------->

<?php

if(isset($_REQUEST['btnFoto'])){

$file=$_FILES['file'];

if($file['type']!='image/jpeg' && $file['type']!='image/png' && $file['type']!='image/jpg'){
    echo "<script>
    alert('Invalid profile picture')
    </script>";
}else if($file['size']>2147483648){
    echo "<script>
    alert('Invalid profile size')
    </script>";
}else{
    move_uploaded_file($file['tmp_name'],'img/avatar/'.$file['name']);

    $m1=new Manager();
$m1->setCelular($_SESSION['Numero']);
$m1->setProfile($file['name']);
$m1->updateFirstTime();
$m1->updateProfile();



}




}



?>