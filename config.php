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
<!----page  styles--->
<style>

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
    background:rgba(0,0,0,.8);
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
     margin:15% auto;
     
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


<?php session_start();
ob_start();

include 'includes/incluir.php';
include 'classes/Manager.class.php';

include 'includes/nav.php';
include 'includes/section.php';


//=======================trocar senha==================================
if(isset($_REQUEST['x'])){


    echo "<div id='aside' class='bg-light'>";
echo "<div class='card'>
<form method='post'>
<div id='form'>
<div id='signIn1'>
<label for='user'><img src='svgs/solid/lock.svg' width=20 height=20 ></label> <input type='password' name='pass' id='user' placeholder='Senha antiga' maxLength=15 minLength=4><hr>
<label for='pass2'><img src='svgs/solid/lock.svg' width=20 height=20></label> <input type='password' name='pass1' id='pass2' placeholder='Senha nova' maxLength=15 minLength=4><hr>
<label for='pass3'><img src='svgs/solid/lock-open.svg' width=20 height=20></label> <input type='password' name='pass2' id='pass3' placeholder='Confirmar senha nova'maxLength=15 minLength=4><hr>
<br>
</div>
<center><input type='submit' id='btn2' value='Enviar' class='btn btn-outline-primary text-dark' name='btnSenha'></center><br>
</form>
</div>";

    echo "</div>";

    if(isset($_REQUEST['btnSenha'])){

        $p1=$_REQUEST['pass'];
        $p2=$_REQUEST['pass1'];
        $p3=$_REQUEST['pass2'];

        if($p1=='' || $p2=='' || $p3==''){
            echo "<script>
            alert('Preencha os espacos em branco')
            </script>";
        }else if($p2!=$p3){
            echo "<script>
            alert('Senhas diferentes')
            </script>";
        }else if(strlen($p2)<4){
            echo "<script>
            alert('Senha curta')
            </script>";

        }else if(strlen($p2)>15){
            echo "<script>
            alert('Senha Longa')
            </script>";

        }else{

             $m=new Manager();
             $m->setCelular($_SESSION['Numero']);

             foreach($m->fetchUser() as $linha){
                 if($linha['Senha']!=md5($p1)){
                    echo "<script>
                    alert('Senha invalida')
                    </script>";
                 }else{

                   $m->setSenha1(md5($p2));
                   $m->updatePass();
                   setcookie('Numero',$_SESSION['Numero'],time()-1000,'/');
                   unset($_SESSION['Numero']);
                   header('location:index.php');


                 }
             }

        }

    }
    
 exit;
    }
    
//=============end===========================================

echo "<div id='aside' class='bg-light'>";




                echo "<a href='config.php?x=xsklsTrke9eid' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'>Mudar de senha</div></a>";
      

//================================theme============================
                echo "<div class='card d-block bg-dark text-light' style='margin-bottom:2px;padding:10px' >Modo escuro <span>";
                
                //======================check if the theme is dark or white===============
                $m12=new Manager();
                $m12->setCelular($_SESSION['Numero']);

                foreach($m12->fetchUser() as $linha){

                         if($linha['theme']==2){
                            echo "<input type='checkbox' id='checkbox' name='checkbox' style='float:right;margin-right:10px' onclick='dark()' checked>";
                
                         }else{
                            echo "<input type='checkbox' id='checkbox' name='checkbox' style='float:right;margin-right:10px' onclick='dark()'>";
                
                         }
                           

                   


                }

               //====================end================================
                echo "</span></div>";
//===============================endTheme=======================

                echo "<div class='card d-block bg-danger text-light' style='margin-bottom:2px;padding:10px' onclick='remover1()'>Remover Conta</div>";

        
echo "</div>";

//==========end===============================

//=============remover conta via ajax==================

if(isset($_REQUEST['r'])){

$m1=new Manager();
$m1->setCelular($_SESSION['Numero']);

foreach($m1->fetchUser() as $linha){
    if($linha['Avatar']!=''){
        unlink('img/avatar/'.$linha['Avatar']);
    }
}
$m1->removeAccount();
setcookie('Numero',$_SESSION['Numero'],time()-1000,'/');
unset($_SESSION['Numero']);

}


//=======================================

ob_end_flush();
?>

<script>
function remover1(){
    var f=confirm("Pretende mesmo remover a sua conta")

    if(f){
        $.ajax({
            url:'config.php',
            type:'post',
            data:{r:'ok'},
            success:function(data){
                open("index.php",'_self')
              
            }
        })
    }
}



function dark(){
  
var dark=false;

var el=document.getElementById('checkbox');

if(el.checked){
    dark=true
}


alert(dark)
$.ajax({
    url:'like.php',
    type:'post',
    data:{dark:dark},
    success:function(data){

    }

})


}

</script>