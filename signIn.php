
<style>

</style>

<?php
include 'includes/incluir.php';

?>

<!----sign in1--->
<div id='form'>
<div id='signIn1'>
<label for='user'><img src='svgs/regular/user.svg' width=20 height=20 ></label> <input type='text' id='user' placeholder='Nome' maxLength=40 minLength=2><hr>
<label for='pass2'><img src='svgs/solid/lock.svg' width=20 height=20></label> <input type='password' id='pass2' placeholder='Senha' maxLength=15 minLength=4><hr>
<label for='pass3'><img src='svgs/solid/lock-open.svg' width=20 height=20></label> <input type='password' id='pass3' placeholder='Confirmar senha'maxLength=15 minLength=4><hr>
<br>
</div>
<center><input type='button' id='btn2' value='Continuar' class='btn btn-outline-dark text-light' onclick='cont()'></center><br>
<span style='color:white;cursor:no-drop'>Tem conta? </span><span style='color:white;font-weight:bolder;cursor:pointer' onclick='Up()' id='s'>Log In</span>
</div>
<!--end-->

<!--alert-->




<script>

var pais,date,number,email,sexo,pass1,pass2,user,email,c,distrito,cidade,x


//=================back to login=============
function Up(){
   $(document).ready(function(){
       $('#login1').show(1000)
       $('#signIn').hide(1000)
       $('.progress').hide(1000)
       $('.progress-bar').attr('style','width:2%')
       


   })



}

//==================end=============================

//======================continue1====================

function cont(){
    $('#wait').html("<center><img src='files/load2.gif' width=30 height=30> Processando</center>")
$('#wait').show()
$('body').attr('style','cursor:progress')
$('body').css('background','#007bff')
user=document.getElementById('user')
 pass1=document.getElementById('pass2')
pass2=document.getElementById('pass3')

if(user.value.length==0 || pass1.value.length==0 || pass2.value.length==0){
    $('#wait').hide(1000)
alert('preencha os espacos')
$('body').attr('style','cursor:default')
$('body').css('background','#007bff')

}else if(pass1.value!=pass2.value){
    $('#wait').hide(1000)
alert('Senhas diferentes')

$('body').attr('style','cursor:default')
$('body').css('background','#007bff')

}else if(user.value.length>40){
    $('#wait').hide(1000)
  alert('usuario nao deve exceder 40 caracteres')
  $('body').css('background','#007bff')
  
  $('body').attr('style','cursor:default')

}else if(user.value.length<2){
    $('#wait').hide(1000)
    alert('usuario nao deve ter menos de 2 caracteres')
    $('body').attr('style','cursor:default')
    $('body').css('background','#007bff')


}else if(pass1.value.length>15){
    $('#wait').hide(1000)
  alert('senha deve ter no maximo 15 caracteres')
  $('body').attr('style','cursor:default')
  $('body').css('background','#007bff')


}else if(pass1.value.length<4){
    $('#wait').hide(1000)
  alert('senha deve ter no minimo 4 caracteres')
  $('body').attr('style','cursor:default')
  $('body').css('background','#007bff')



}else{
  
var xml;

if(window.XMLHttpRequest){
xml=new XMLHttpRequest();
}else{
xml=new ActiveXObject("MICROSOFT.XMLHTTP")
}

xml.onreadystatechange=function(){
    if(this.status==200 && this.readyState==4){
        document.getElementById('signIn').innerHTML=xml.responseText
        $('.progress-bar').attr('style','width:50%')
        
            $('#wait').hide()
            $('body').attr('style','cursor:default')
            $('body').css('background','#007bff')
    }
}
xml.open('GET',`signIn1.php?user=${user.value}&pass1=${pass1.value}&pass2=${pass2.value}`,true);
xml.send()





}


}

//=================end================================

//=====================continue2====================
function cont2(){
    $('#wait').html("<center><img src='files/load2.gif' width=30 height=30> Processando</center>")
$('#wait').show()
$('body').attr('style','cursor:progress')
$('body').css('background','#007bff')
    $('#alert ').delay(1000).hide(500)

date=document.getElementById('date')
number=document.getElementById('nbr2')
email=document.getElementById('email')

if(date.value.length==0 || number.value.length==0){
    $('#wait').hide(1000)
alert('preencha todos os campos')
$('body').attr('style','cursor:default')
$('body').css('background','#007bff')
}else if(number.value.length>15){
    $('#wait').hide(1000)
    alert('Numero nao deve exceder 15 digitos')
    $('body').attr('style','cursor:default')
    $('body').css('background','#007bff')
}else if(number.value.length<8){
    $('#wait').hide(1000)
   alert('Numero invalido')
 
   $('body').attr('style','cursor:default')
   $('body').css('background','#007bff')


}else if(number.value.substr(0,1)==0){
    $('#wait').hide(1000)
alert('Numero invalido')
$('body').attr('style','cursor:default')
$('body').css('background','#007bff')
 
}else{
  
var xml;

if(window.XMLHttpRequest){
xml=new XMLHttpRequest();
}else{
xml=new ActiveXObject("MICROSOFT.XMLHTTP")
}

xml.onreadystatechange=function(){
    if(this.status==200 && this.readyState==4){
        document.getElementById('signIn').innerHTML=xml.responseText
        $('.progress-bar').attr('style','width:85%')
              
        $('#wait').hide()
        $('body').attr('style','cursor:default')
        $('body').css('background','#007bff')
    }
}
xml.open('GET',`signIn2.php?nbr=${number.value}&email=${email.value}&date=${date.value}`,true);
xml.send()





}


}

//=======================end===================

//====================last continue=============

//=====================continue3====================
function cont3(){
    $('#wait').html("<center><img src='files/load2.gif' width=30 height=30> Processando</center>")
$('#wait').show()
$('body').attr('style','cursor:progress')
$('body').css('background','#007bff')

pais=document.getElementById('pais')
sexo=document.getElementsByName('rad')


 
if(sexo[0].checked){
    x='Masculino'
}else{
    x='Femenino';
}

sessionStorage.sexo=x;

var xml;
if(window.XMLHttpRequest){
xml=new XMLHttpRequest();
}else{
xml=new ActiveXObject("MICROSOFT.XMLHTTP")
}

xml.onreadystatechange=function(){
    if(this.status==200 && this.readyState==4){
        document.getElementById('signIn').innerHTML=xml.responseText
        $('.progress-bar').attr('style','width:100%')
        $('body').css('background','#007bff')
      
$('#wait').hide()
$('body').attr('style','cursor:default')
    }
}
xml.open('GET',`signIn3.php?pais=${pais.value}`,true);
xml.send()








}

//=======================end===================

//====get District==========================================
function change(){
    $('#wait').html("<center><img src='files/load2.gif' width=30 height=30> Processando</center>")
$('#wait').show()
$('body').attr('style','cursor:progress')
$('body').css('background','#007bff')

cidade=document.getElementById('cidade')
sessionStorage.cidade=cidade.value

    var xml;

if(window.XMLHttpRequest){
xml=new XMLHttpRequest();
}else{
xml=new ActiveXObject("MICROSOFT.XMLHTTP")
}

xml.onreadystatechange=function(){
    if(this.status==200 && this.readyState==4){
        document.getElementById('signIn').innerHTML=xml.responseText
        $('.progress-bar').attr('style','width:100%')
        $('.distrito').removeAttr('disabled')
       
$('#wait').hide()
$('body').attr('style','cursor:default')
$('body').css('background','#007bff')
    }
}
xml.open('GET',`signIn3.php?cidade=${cidade.value}&pais=${pais.value}`,true);
xml.send()





}
//====end=================================


//==============end==================


function terminar(){
    $('body').attr('style','cursor:progress')
    distrito=document.getElementById('distrito')
    $('#wait').html("<center><img src='files/load2.gif' width=30 height=30> Processando</center>")
    $('body').css('background','#007bff')
$('#wait').show()


if(sessionStorage.cidade=='none'){
    $('#wait').delay(1000).hide(1000)
  alert('Por favor escolha uma Provincia/Cidade')
  $('body').attr('style','cursor:default')
  $('body').css('background','#007bff')

}else{
  
var xml;


if(window.XMLHttpRequest){
xml=new XMLHttpRequest();
}else{
xml=new ActiveXObject("MICROSOFT.XMLHTTP")
}

var city=sessionStorage.cidade;
var sexo1=sessionStorage.sexo;

xml.onreadystatechange=function(){
    if(this.status==200 && this.readyState==4){
         document.getElementById('signIn1').innerHTML=xml.responseText
         $('.progress').remove()
         $('#btn4').remove()
         $('#account').remove()
      
    
      
$('#wait').hide()
$('body').attr('style','cursor:default;background:#007bff')
$('body').css('background','#007bff')
    }
}

xml.open('GET',`end.php?user=${user.value}&pass1=${pass1.value}&pass2=${pass2.value}&nbr=${number.value}&date=${date.value}&city=${city}&pais=${pais.value}&distrito=${distrito.value}&sexo=${sexo1}&email=${email.value}`,true);
xml.send()








}
}
//=================end======================

</script>

