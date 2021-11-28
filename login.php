<?php session_start();

include 'includes/incluir.php';
if(isset($_COOKIE['Numero'])){
    $_SESSION['Numero']=$_COOKIE['Numero'];
}

?>

<!----page  styles--->
<style>
body{
  background:#007bff;
}

@font-face{
    font-family:"thugger";
    src:url(font/PaintDropsRegular-0WaJo.ttf)
}

#wait{
    width:40%;
    position:absolute;
    top:80%;
    left:30%;
    display:none;

}

#pais::-webkit-scrollbar{
    width:2px;
    background:cyan;
}

#alert{
    position:absolute;
    top:30%;
    left:30%;
    width:40%;
    background:pink;
    opacity:0.6;
    display:none;
    text-align:center;
    color:red;
    font-weight:bolder;
    font-size:30px;
    margin-top:20px

    
}

#body{
    position:absolute;
    left:0px;
    top:0px;
    width:100%;
    height:100%;
  
}
#body h1{
    color:white;
    font-weight:bolder;
    margin:15px auto;
    text-align:center;
}

#login{
    margin:5% auto;
    width:35%;
    background:ghostwhite;
    padding:20px;
    border-radius:5px;
    box-shadow:1px 1px 2px black;

}


#signIn1{
    margin:5% auto;
    width:35%;
    background:ghostwhite;
    padding:10px;
    border-radius:5px;
    box-shadow:1px 1px 2px black  
}
#nbr1,#nbr2,#user,#pais,#cidade{
   
    width:80%;
    margin:5% auto;
    outline:none;
    padding:3px;
    border:none;
    background:ghostwhite;

}
#pass1,#pass2,#pass3,#email,#date,#distrito{
    width:80%;
    margin:auto;
    outline:none;
    padding:3px;
    border:none;
    background:ghostwhite;
}

#form{
    margin:auto;
    width:100%;
    text-align:center;
}
.progress{
    width:30%;
}
@media screen and (max-width:500px){
#login{
    width:90%;
     margin:15% auto;
}
.progress{
    width:90%;
}

#signIn1{
    width:90%;
   
     
}
#alert{
    width:90%;
    left:5%
}
}

@media screen and (min-width:501px) and (max-width:800px){
    #login{
    width:65%;
     margin-bottom:5px;
   
}

#signIn1{
    width:65%;
     margin-bottom:5px;
  
}
#alert{
    width:60%;
    left:20%;
}
}

@media screen and (min-width:801px) and (max-width:1024px){
    #login{
    width:65%;
  
 

}

#signIn1{
    width:65%;

}
#alert{
    width:50%;
   top:10%;
   left:25%;
}
}
</style>


<!---end---->


<!--login form--->

<div id='body'>
<h1 style='font-family:thugger'>HOWDY</h1>
<?php

if(isset($_SESSION['Numero']) ){
    include 'classes/Manager.class.php';
    $m=new Manager();
    $m->setCelular($_SESSION['Numero']);
   
echo "<section class='container card ' style='text-align:center'>";

foreach($m->fetchUser() as $linha){
        echo "<div class='card-header'>";

        if($linha['Avatar']=='' and $linha['Sexo']=='Masculino'){
            echo "<img src='files/male.png' width=80 height=80 style='border-radius:50%;border:5px solid #007bff'>";
        }else if($linha['Avatar']=='' and $linha['Sexo']=='Femenino'){
            echo "<img src='files/female.png' width=80 height=80 style='border-radius:50%;border:5px solid #007bff'>";
        }else{
            echo "<img src='img/avatar/".$linha['Avatar']."' width=80 height=80 style='border-radius:50%;border:5px solid #007bff'>";
        }
        
        echo "<h2>".$linha['Nome']."</h2></div>";
}

echo "<div class='card-footer'><a href='avancar.php' style='text-decoration:none'><button class='btn btn-outline-primary'>Continuar</button></a> <a href='login.php?exit=true' style='text-decoration:none'><button class='btn btn-outline-primary'>Sair</button></a></div>";
echo "</section>";


if(isset($_REQUEST['exit'])){
    unset($_SESSION['Numero']);
    setcookie('Numero',$_SESSION['Numero'],time()-1000,"/");
    header('location:index.php');
}

    exit;
}

?>

<section class='container' id='login1'>
<div id='form' >
<div  id='login'>
<label for='nbr1'><img src='svgs/regular/calendar.svg' width=20 height=20 ></label> <input type='number' id='nbr1' placeholder='Numero' min=0><hr>
<label for='pass1'><img src='svgs/solid/lock.svg' width=20 height=20></label> <input type='password' id='pass1' placeholder='Senha'><hr>

</div>
<label for='check' class='text-light'><small>Salvar conta</small></label> <input type='checkbox' id='check'>
<center><input type='button' id='btn1' value='Log In' class='btn btn-outline-dark text-light' onclick='entar()'></center><br>
<span style='color:white;cursor:no-drop'>Nao tem conta? </span><span style='color:white;font-weight:bolder;cursor:pointer' onclick='signIn()' id='l'>Sign in</span>
</div>

</section>

<!---end login---->


<!--progress-->

<br><div class='progress ' style='display:none;width:30%;margin:auto'>
<div class='progress-bar progress-bar-success progress-bar-striped progress-bar-animated' style='width:2%' ></div>
</div>
<!--end-->

<!---signin----->
<section id='signIn' class='container' style='display:none'></section>
</div>
<!---end------>





<!--end--->


<!--wait--->

<div  class='alert alert-warning' id='wait'></div>

<!--end--->

<script>

//=============================sign==================
function signIn(){
    $(document).ready(function(){
        
  


$('#wait').html("<center><img src='files/load2.gif' width=30 height=30> Processando</center>")
$('#wait').show()
$('#login1').hide(1000)
$('#signIn').show(1000)
$('.progress').show(1000)
     $.ajax({
         url:'signIn.php',
         type:'post',
         data:{d:''},
         success:function(data){
             $('#signIn').html(data)
             $('#wait').text('')
             $('#wait').hide()
             $('body').css('background','#007bff')

     
         }
     })




    })

}
//====================end======================


   //========================entar==================

function entar(){

    $('#wait').html("<center><img src='files/load2.gif' width=30 height=30> Processando</center>")
$('body').attr('style','cursor:progress')
$('body').css('background','#007bff')

var numero=document.getElementById('nbr1')
var pass=document.getElementById('pass1')

if(numero.value.length==0 || pass.value.length==0){
    
    $('#wait').hide(500)
   alert('Por favor preencha todos os espaços')
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

        if(xml.responseText==0){
        open('avancar.php','_self')
        $('#wait').hide()
        $('body').attr('style','cursor:default')
        $('body').css('background','#007bff')
        }else{
         alert(xml.responseText)
        $('#wait').hide()
        $('body').attr('style','cursor:default')
        $('body').css('background','#007bff')
        }
   
    }
}

var check=document.getElementById('check')

var ch;

if(check.checked){
    ch='true'
}else{
    ch='false'
}
xml.open('GET',`logIn1.php?number=${numero.value}&pass=${pass.value}&check=${ch}`,true);
xml.send()






}


}


   //=================end===============

</script>