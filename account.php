
<style>


#aside{
    height:100%;
    width:69%;
    overflow:auto;
    float:right;
    position:relative;
    top:0%;
    
    
}
.myAc{
background:rgba(0,0,200,0.2)
}

.mmac{
    background:whitesmoke;
}

td{
    word-break:break-word;
}
#aside::-webkit-scrollbar{
    width:10px;
    background:white
}

#aside::-webkit-scrollbar-thumb{
background:gray;
border-radius:15px;

}
#back{
 
    margin:3% auto;
    background-image:url(files/profile.png);
    background-size:cover;
    background-repeat:no-repeat;
    height:300px;
    text-align:center
  

}
#img,#img1{
    border:1px solid rgb(220,220,220);
    padding:5px;
    width:180px;
    height:180px;
    margin:2% auto;
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





<?php session_start();
date_default_timezone_set('africa/maputo');
ob_start();

include 'includes/incluir.php';
include 'classes/Manager.class.php';


include 'includes/nav.php';
include 'includes/section.php';

//==========getting session user id===================
$sessao=new Manager();
$sessao->setCelular($_SESSION['Numero']);
$sess=0;
foreach($sessao->fetchUser() as $linha){
$sess=$linha['id_user'];
}



echo "<div id='aside'>";
echo "<div id='back'>";

if(!isset($_REQUEST['id'])){
$m=new Manager();
$m->setCelular($_SESSION['Numero']);

foreach($m->fetchUser() as $linha){

if($linha['Avatar']=='' && $linha['Sexo']=='Masculino'){
    echo "<br><div id='img1' ><img src='files/male.png' style='width:100%;height:100%' ></div>";

}else if($linha['Avatar']=='' && $linha['Sexo']=='Femenino'){
    echo "<br><div id='img1' ><img src='files/female.png' style='width:100%;height:100%'></div>";
}else{
    echo "<br><div id='img' data-target='#profile1' data-toggle='modal' data-id='".$linha['id_user']."'><img src='img/avatar/".$linha['Avatar']."' style='width:100%;height:100%'></div>";
}

echo "<center><div class='btn btn-outline-light' data-target='#profile' data-toggle='modal'>Editar Foto</div></center>";

//=================fetch Followers======================

$follower=new Manager();
$follower->setNumero($sess);

echo "<b>Followers: {$follower->fetchFollower()} </b> | <b>Following: {$follower->fetchFollowing()}</b>";

//========================endFollowers====================

}

echo "</div>";
echo "<div class='table-responsive'>";
echo "<br><table class='table table-hover'>";
echo "<tr>";
echo "<td style='width:90%'><small>Nome: </small><strong>".$linha['Nome']."</strong></td>";
echo "<td ><div class='btn btn-outline-primary' data-target='#nameUp' data-toggle='modal' >Editar</div></td>";
echo "</tr>";

echo "<tr>";
echo "<td style='width:90%'><small>Celular: </small><strong>".$linha['Numero']."</strong></td>";
echo "<td><div class='btn btn-outline-primary' data-target='#nrUp' data-toggle='modal' >Editar</div></td>";
echo "</tr>";

echo "<tr>";
echo "<td style='width:90%'><small>Data de Nascimeto:  </small><strong>".$linha['Data_Nascimento']."</strong></td>";
echo "<td><div class='btn btn-outline-primary' data-target='#dtUp' data-toggle='modal' >Editar</div></td>";
echo "</tr>";

echo "<tr>";
echo "<td style='width:90%'><small>Pais:  </small><strong>".$linha['Pais']."</strong></td>";
echo "<td><div class='btn btn-outline-primary' data-target='#pUp' data-toggle='modal' >Editar</div></td>";
echo "</tr>";

echo "<tr>";
echo "<td style='width:90%'><small>Estado/Provincia:  </small><strong>".$linha['Cidade']."</strong></td>";
echo "<td><div class='btn btn-outline-primary' data-target='#pUp' data-toggle='modal' >Editar</div></td>";
echo "</tr>";

if($linha['Distrito']!='none' && $linha['Distrito']!=''){
echo "<tr>";
echo "<td style='width:90%'><small>Distrito:  </small><strong>".$linha['Distrito']."</strong></td>";
echo "<td><div class='btn btn-outline-primary' data-target='#pUp' data-toggle='modal' >Editar</div></td>";
echo "</tr>";
}

if($linha['Email']!=''){
echo "<tr>";
echo "<td style='width:90%'><small>Email:  </small><strong>".$linha['Email']."</strong></td>";
echo "<td><div class='btn btn-outline-primary' data-target='#eUp' data-toggle='modal' >Editar</div></td>";
echo "</tr>";
}else{

    echo "<tr>";
    echo "<td style='width:90%'><small>Vo&ccedil;e nao tem um email</small></td>";
    echo "<td><div class='btn btn-outline-primary' data-target='#eUp' data-toggle='modal' >Add</div></td>";
    echo "</tr>";

}
echo "<tr>";
echo "<td style='width:100%'><small>Sexo:  </small><strong>".$linha['Sexo']."</strong></td><td></td>";

echo "</tr>";

echo "<tr>";
echo "<td style='width:90%;word-break:break-word'><small>Status:  </small><strong>".$linha['Estados']."</strong></td>";
echo "<td><div class='btn btn-outline-primary' data-target='#stUp' data-toggle='modal' >Editar</div></td>";
echo "</tr>";

echo "<tr ><td style='width:100%;' class='bg-primary'>
<div class='btn btn-outline-light' id='post' data-id='".$linha['id_user']."'>Posts</div>
</td><td style='width:0%' class='bg-primary'></td></tr>";

echo "</table>";
echo "</div>";

}else{

//============otherPeople's data====================

$m=new Manager();

$nr=0;
$m->setId(base64_decode($_REQUEST['id']));


foreach($m->fetchUserViaId() as $linha){

if($linha['Avatar']=='' && $linha['Sexo']=='Masculino'){
    echo "<br><div id='img1' ><img src='files/male.png' style='width:100%;height:100%'></div>";

}else if($linha['Avatar']=='' && $linha['Sexo']=='Femenino'){
    echo "<br><div id='img1' ><img src='files/female.png' style='width:100%;height:100%'></div>";
}else{
    echo "<br><div id='img' data-target='#profile1' data-toggle='modal' data-id='".$linha['id_user']."'><img src='img/avatar/".$linha['Avatar']."' style='width:100%;height:100%'></div>";
}

//==================get the session user id to follower===============

echo "<center><div class='btn btn-outline-light'><a href='mensagem.php?x=".base64_encode($linha['id_user'])."' style='text-decoration:none;color:white'>Mensagem</a></div> <button class='btn btn-outline-light' id='seguir' onclick='follow(".base64_decode($_REQUEST['id']).",".$sess.")'>";

//======================check if I gotta follow or unfollow the nigga============

$check=new Manager();
$check->setCelular($sess);
$check->setNumero(base64_decode($_REQUEST['id']));

if($check->checkFollow()->rowCount()==0){
echo "Follow";
}else{
    echo "Unfollow"; 
}

//==============================================
echo "</button></center>";


}

//===============fetchFollowers============================

$follow=new Manager();
$follow->setNumero(base64_decode($_REQUEST['id'])); 

echo "<b>Followers: <span id='followers'> {$follow->fetchFollower()}</span></b> | <b>Following: <span id='following'> {$follow->fetchFollowing()}</span></b>";

//=============end========================

echo "</div>";
echo "<div class='table-responsive'>";
echo "<br><table class='table table-hover' >";
echo "<tr>";
echo "<td style='width:90%'><small>Nome: </small><strong>".$linha['Nome']."</strong></td>";

echo "</tr>";

if($linha['Ocultar_Numero']=='false'){
echo "<tr>";
echo "<td style='width:90%'><small>Celular: </small><strong>".$linha['Numero']."</strong></td>";

echo "</tr>";
}
if($linha['Ocultar_Data']!='true'){
echo "<tr>";
echo "<td style='width:90%'><small>Data de Nascimeto:  </small><strong>".$linha['Data_Nascimento']."</strong></td>";

echo "</tr>";
}
echo "<tr>";
echo "<td style='width:90%'><small>Pais:  </small><strong>".$linha['Pais']."</strong></td>";

echo "</tr>";

echo "<tr>";
echo "<td style='width:90%'><small>Estado/Provincia:  </small><strong>".$linha['Cidade']."</strong></td>";

echo "</tr>";

if($linha['Distrito']!='none' && $linha['Distrito']!=''){
echo "<tr>";
echo "<td style='width:90%'><small>Distrito:  </small><strong>".$linha['Distrito']."</strong></td>";

echo "</tr>";
}

if($linha['Email']!='' && $linha['Ocultar_Email']!='true'){
echo "<tr>";
echo "<td style='width:90%'><small>Email:  </small><strong>".$linha['Email']."</strong></td>";

echo "</tr>";
}

echo "<tr>";
echo "<td style='width:90%'><small>Sexo:  </small><strong>".$linha['Sexo']."</strong></td>";

echo "</tr>";

echo "<tr>";
echo "<td style='width:90%;word-break:break-word'><small>Status:  </small><strong>".$linha['Estados']."</strong></td>";

echo "</tr>";

echo "<tr><td style='width:100%;text-align:center' class='bg-primary'>
<div class='btn btn-outline-light'  id='post' data-id='".$linha['id_user']."'>Posts</div>
</td></tr>";

echo "</table>";
echo "</div>";

}
echo "</aside>";

?>


<!---nameUpdate modal---------->

<div class='modal fade' role='dialog' id='nameUp'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>


<form method='post' enctype='multipart/form-data'>
<div class='modal-footer bg-primary'>
<input type='text' name='txtName' class='form-control' placeholder='Novo Nome' maxLength=40>
<input type='submit' name='btnName' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>

<!-------end---------------->


<!---numberUpdate modal---------->

<div class='modal fade' role='dialog' id='nrUp'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>


<div class='checkbox'>
<label for='check'><small>Ocultar: </small></label>
<?php
$oc=new Manager();
$oc->setCelular($_SESSION['Numero']);

foreach($oc->fetchUser() as $linha){
    if($linha['Ocultar_Numero']=='false'){
        echo "<input type='checkbox' id='check' data-oc='false'>";
    }else{
        echo "<input type='checkbox' id='check' checked data-oc='true'>";
    }
}

?>

</div>
<form method='post' enctype='multipart/form-data'>
<div class='modal-footer bg-primary'>
<input type='number' name='number' class='form-control' placeholder='Novo Numero' min=0 maxLength=16>
<input type='submit' name='btnNum' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>

<!-------end---------------->


<!---countryUpdate modal---------->

<div class='modal fade' role='dialog' id='pUp'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>


<form method='post' enctype='multipart/form-data'>
<div class=' bg-primary' style='padding:10px;'>

<small>Pais: </small>
<select class='form-control' name='pais' id='pais'>
<?php

$pais=new Manager();
foreach($pais->fetchCountry() as $linha){
    echo "<option value='".$linha['id']."'>".$linha['name']."</option>";
}

?>
</select>

<br><small>Estado/Cidade: </small>
<select name='cidade' id='city' class='form-control' disabled></select>

<br><small>Distrito: </small>
<select name='distrito' id='distrito' class='form-control' disabled></select>
<br>
<input type='submit' name='btnC' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>

<!-------end---------------->


<!---provinceUpdate modal---------->

<div class='modal fade' role='dialog' id='prUp'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>


<form method='post' enctype='multipart/form-data'>
<div class='modal-footer bg-primary'>
<input type='text' name='text' class='form-control' placeholder='Nova Provincia/Estado' min=0>
<input type='submit' name='btnPost' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>

<!-------end---------------->


<!---districtUpdate modal---------->

<div class='modal fade' role='dialog' id='dUp'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>


<form method='post' enctype='multipart/form-data'>
<div class='modal-footer bg-primary'>
<input type='text' name='number' class='form-control' placeholder='Novo Distrito' >
<input type='submit' name='btnPost' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>

<!-------end---------------->



<!---emailUpdate modal---------->

<div class='modal fade' role='dialog' id='eUp'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>
<div>
<label for='oce'><small>Ocultar: </small></label>

<?php
$oc=new Manager();
$oc->setCelular($_SESSION['Numero']);

foreach($oc->fetchUser() as $linha){
    if($linha['Ocultar_Email']=='false'){
        echo "<input type='checkbox' id='check1' data-oc='false'>";
    }else{
        echo "<input type='checkbox' id='check1' checked data-oc='true'>";
    }
}

?>

</div>

<form method='post' enctype='multipart/form-data'>
<div class='modal-footer bg-primary'>
<input type='email' name='email' class='form-control' placeholder='Novo Email'maxLength=130>
<input type='submit' name='btnE' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>

<!-------end---------------->


<!---dateUpdate modal---------->

<div class='modal fade' role='dialog' id='dtUp'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>
<div>
<label for='oce'><small>Ocultar: </small></label>

<?php
$oc=new Manager();
$oc->setCelular($_SESSION['Numero']);

foreach($oc->fetchUser() as $linha){
    if($linha['Ocultar_Data']=='false'){
        echo "<input type='checkbox' id='check2' data-oc='false'>";
    }else{
        echo "<input type='checkbox' id='check2' checked data-oc='true'>";
    }
}

?>

</div>

<form method='post' enctype='multipart/form-data'>
<div class='modal-footer bg-primary'>
<input type='date' name='dt' class='form-control' max='2004-04-04'>
<input type='submit' name='btnD' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>

<!-------end---------------->


<!---statusUpdate modal---------->

<div class='modal fade' role='dialog' id='stUp'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>


<form method='post' enctype='multipart/form-data'>
<div class='modal-footer bg-primary'>
<textarea class='form-control' placeholder='Atualizar Status' name='status' maxLength=255></textarea>
<input type='submit' name='btnS' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>

<!-------end---------------->






<!---profileUpdate modal---------->

<div class='modal fade' role='dialog' id='profile'>
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
<input type='submit' name='btnPro' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>

<!-------end---------------->


<?php

//==============================update nome=========================

if(isset($_REQUEST['btnName'])){

$name=$_REQUEST['txtName'];
if($name!='' && strlen($name)>=2 && !ctype_digit($name) && strlen($name)<=40){

$update=new Manager();
$update->setCelular($_SESSION['Numero']);
$update->setNome(filter_var(ucwords(strtolower($name)),FILTER_SANITIZE_SPECIAL_CHARS));
$update->updateNome();
header('location:account.php');


    
}else{
    echo "<script>
    
    alert('Nome Invalido')
    </script>";
}


}else if(isset($_REQUEST['btnNum'])){
    $num=$_REQUEST['number'];

if($num!='' && substr($num,0,1)!=0 && strlen($num)>=8 && strlen($num)<=15 && ctype_digit($num)){


    $nr=new Manager();
    $nr->setCelular($num);
    $nr->setNumero($_SESSION['Numero']);
    

   if($nr->fetchUser()->rowCount()==0){

$nr->updateNumero();
$_SESSION['Numero']=$num;
header('location:account.php');

   }else{

    echo "<script>
    
    alert('Numero Ja existe')
    </script>";
   }


}else{
   
    echo "<script>
    
    alert('Numero Invalido')
    </script>";

}


}else if(isset($_REQUEST['btnPro'])){

//=================update profile==========================

$file=$_FILES['file'];

if(($file['type']=='image/jpeg' || $file['type']=='image/jpg' || $file['type']=='image/png' || $file['type']=='') && $file['size']<=2097152 ){

$p=new Manager();

$rand=rand(0,999);

$p->setCelular($_SESSION['Numero']);

foreach($p->fetchUser() as $linha){

    if($linha['Avatar']!=''){
    unlink('img/avatar/'.$linha['Avatar']);
    }
}

if(file_exists('img/avatar/'.$file['name']) && $file['name']!=''){
    $p->setProfile($rand.".".$file['name']);
    move_uploaded_file($file['tmp_name'],'img/avatar/'.$rand.".".$file['name']);
}else{
    $p->setProfile($file['name']);
    move_uploaded_file($file['tmp_name'],'img/avatar/'.$file['name']);
}

$p->updateProfile();
header('location:account.php');

}else{
    echo "<script>
    
    alert('Imagem Invalida')
    </script>";

}

}else if(isset($_REQUEST['btnE'])){

    //==================update email====================

$email=$_REQUEST['email'];

if(strlen($email)<120 && (filter_var($email,FILTER_VALIDATE_EMAIL)==true || $email=='')){

$m=new Manager();
$m->setEmail(filter_var($email,FILTER_SANITIZE_SPECIAL_CHARS));
$m->setCelular($_SESSION['Numero']);
if($m->fetchUserViaEmail()->rowCount()==0){

    $m->updateEmail();

    header('location:account.php');


}else{
    echo "<script>
    
    alert('Email Ja existe')
    </script>";

}


}else{

    echo "<script>
    
    alert('Email Invalido')
    </script>";
}

}else if(isset($_REQUEST['btnD'])){

    //==================update date=====================

    $date=$_REQUEST['dt'];

    if($date!='' && $date<='2004-04-04'){

  $d=new Manager();
  $d->setData($date);
  $d->setCelular($_SESSION['Numero']);
  $d->updateData();
  header('location:account.php');

    }else{
        echo "<script>
    
        alert('Data Invalido')
        </script>";

    }

}else if(isset($_REQUEST['btnS'])){

//==================update status==========================

$status=$_REQUEST['status'];

if($status!='' && strlen($status)<=255){

$m=new Manager();
$m->setTexto(filter_var($status,FILTER_SANITIZE_SPECIAL_CHARS));
$m->setCelular($_SESSION['Numero']);
$m->updateStatus();
header('location:account.php');

}


}else if(isset($_REQUEST['btnC'])){
$city=isset($_REQUEST['cidade'])?$_REQUEST['cidade']:"";
    $m1=new Manager();

    if($_REQUEST['pais']!='' && $city!=''){

        //===============================getting country name via id=========
        $m1->setId($_REQUEST['pais']);
    $pais=$m1->fetchCountry1();
     //===============================getting state name via id=========
     $m2=new Manager();
     $m2->setId($_REQUEST['cidade']);
    
        $pais1=$m2->fetchState1();
          
     //===============================getting countrydistrict===============
     $m3=new Manager();
     $m3->setId($_REQUEST['distrito']);

            $pais2=$m3->fetchCity1();
               
    
                //==================change/update the coutries=============

            $up=new Manager();
            $up->setDistrito($pais2);
            $up->setPais($pais);
            $up->setCidade($pais1);
            $up->setCelular($_SESSION['Numero']);
            $up->updateCountry();    
        header('location:account.php');
    }
  


}

ob_end_flush();
?>
<div id='post1'></div>
<script>
$('#pais').change(function(){
var v=(this.value)
$.ajax({
url:'country.php',
type:'post',
data:{pais:v},
success:function(data){
    $('#city').removeAttr('disabled')
    $('#city').html(data)

}
})


})


$('#city').change(function(){
var v=(this.value)
$.ajax({
url:'country.php',
type:'post',
data:{city:v},
success:function(data){
    $('#distrito').removeAttr('disabled')
    $('#distrito').html(data)

}
})


})

$(document).on('click','#img',function(){
    

$.ajax({
    url:'profile.php',
    type:'post',
    data:{id:$(this).data('id')},
    success:function(data){
        $('body').append(data)
    }
})

})

$('#check').click(function(){

  $.ajax({
      url:'profile.php',
      type:'post',
      data:{nr:''},
      success:function(data){
      alert('Terminado')
      }
  })
})

$('#check1').click(function(){

$.ajax({
    url:'profile.php',
    type:'post',
    data:{em:''},
    success:function(data){
    alert('Terminado')
    }
})
})

$('#check2').click(function(){

$.ajax({
    url:'profile.php',
    type:'post',
    data:{dt:''},
    success:function(data){
    alert('Terminado')
    }
})
})


$('#post').click(function(){

$.ajax({
    url:'profile.php',
    type:'post',
    data:{post:$(this).data('id')},
    success:function(data){
   $('#post1').html(data)
   $('#dvb4').show(200)
    }
})
})

var change=false;
function follow(follow,follower){

if(change==false){
    change=true;
    $('#seguir').text("Unfollow")
}else{
    change=false;
    $('#seguir').text("Follow")
}

$.ajax({
    url:'like.php',
    type:'post',
    data:{follow:follow,follower:follower},
    success:function(data){
        $('#followers').html(data)
    }
})


}
</script>

