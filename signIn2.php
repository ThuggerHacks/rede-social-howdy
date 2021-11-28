<?php
include 'classes/Manager.class.php';

$manager=new Manager();

$country=$manager->fetchCountry();

?>


<!----sign in3--->
<div id='form'>
<div id='signIn1'>

<h4 style='border-bottom:1px solid black;text-align:center;margin:auto;width:90%'>Sexo:</h4>
<label for='male'>Masculino</label> <input type='radio' name='rad' id='male' value='Masculino' checked><br>

<label for='female'>Femenino</label> <input type='radio' name='rad' id='female' value='Femenino'><hr>

<label for='pais'><img src='svgs/regular/flag.svg' width=20 height=20></label><select id='pais' >
<option disabled>Selecione o seu pais</option>

<?php
foreach($country as $pais){
    echo "<option value='".$pais['id']."'>".$pais['name']."</option>";
}
?>

</select><hr>

</div>
<center><input type='button' id='btn3' value='Continuar' class='btn btn-outline-success text-light' onclick='cont3()'></center><br>
<span style='color:white;cursor:no-drop'>Tem conta? </span><span style='color:white;font-weight:bolder;cursor:pointer' onclick='Up()' id='s'>Log In</span>
</div>
<!--end-->

