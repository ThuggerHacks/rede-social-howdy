<?php
include 'classes/Manager.class.php';

$manager=new Manager();



$manager->setId($_REQUEST['pais']);
$country=$manager->fetchState();


?>


<!----sign in3--->
<div id='form'>
<div id='signIn1'>
<label for='cidade'><img src='svgs/regular/flag.svg' width=20 height=20></label><select id='cidade'  onchange='change()'>
<option value='none'>Selecione a sua provincia</option>

<?php
foreach($country as $pais){
    echo "<option value='".$pais['id']."'>".$pais['name']."</option>";
}

?>

<label for='distrito'><img src='svgs/regular/flag.svg' width=20 height=20></label></select><hr>
<select id='distrito' >

<?php



if(isset($_REQUEST['cidade'])){
$m=new Manager();
$m->setId($_REQUEST['cidade']);
$cidade=$m->fetchCity();
foreach($cidade as $pais){
    echo "<option value='".$pais['id']."'>".$pais['name']."</option>";
}


}

?>

</select>
<hr>
<div style='font-weight:bolder;font-size:25px;margin:auto;text-align:center'>ALMOST DONE!</div>
<hr>

</div>
<center><input type='button' id='btn4' value='Finalizar' class='btn btn-outline-success text-light' onclick='terminar()'></center><br>
<span style='color:white;cursor:no-drop' id='account'>Tem conta? </span><span style='color:white;font-weight:bolder;cursor:pointer' onclick='Up()' id='s'>Log In</span>
</div>
<!--end-->

