<style>


#aside{
    height:100%;
    width:69%;
    overflow:auto;
    float:right;
    position:relative;
    top:0%;
    
    
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



<?php session_start();
include 'classes/Manager.class.php';
include 'includes/incluir.php';


include 'includes/nav.php';
include 'includes/section.php';


if(isset($_REQUEST['id'])){

echo "<div id='aside'>";

echo "<br><div class='container' onclick='addMembro()'><div class='card'><span class='btn btn-outline-primary'><img src='svgs/solid/plus.svg' width=50 height=50> Adicionar Membros</span><center></center></div></div>";

echo "<br><a href='groupChat.php?id=".$_REQUEST['id']."&mm=".md5('s')."' style='text-decoration:none;color:black'><div class='container'><div class='card'><span class='btn btn-outline-primary'><img src='svgs/solid/sms.svg' width=50 height=50> Ir ao chat</span><center></center></div></div></a>";

echo "<br><a href='group.php' style='text-decoration:none;color:black'><div class='container'><div class='card'><span class='btn btn-outline-primary'><img src='svgs/solid/backward.svg' width=50 height=50> Voltar</span><center></center></div></div></a>";

echo "</div>";

}else if(isset($_REQUEST['id1'])){
    echo "<div id='aside'>";
    
echo "<br><a href='groupChat.php?id=".$_REQUEST['id1']."' style='text-decoration:none;color:black'><div class='container'><div class='card'><span class='btn btn-outline-primary'><img src='svgs/solid/sms.svg' width=50 height=50> Ir ao chat</span><center></center></div></div></a>";

echo "<br><a href='group.php' style='text-decoration:none;color:black'><div class='container'><div class='card'><span class='btn btn-outline-primary'><img src='svgs/solid/backward.svg' width=50 height=50> Voltar</span><center></center></div></div></a>";

echo "</div>";
}else{


        echo "<style>
        body{
        background: #007bff;
     
        }
        #aside,#section,#pcmenu,#mmenu,#btnm{display:none}
        </style>";
        echo "<div  style='margin:10% auto;background:white;padding:10px;text-align:center;width:90%'>Erro de pagina<br><a href='group.php' class='btn btn-primary'>Voltar</a></div>";
        
    
}





//=================add membros to the group modal====================================

echo "<div id='vi1' style='display:none'>";

echo "<div id='st'>";

echo "<button class='close' id='closar12' style='outline:none'>&times;</button><br><hr>";

    echo "<style>
    #vi1{";

     
            echo "background:#343a40;
            overflow:auto;
            height:100%;";
            
    
       
        
        echo "width:100%;
        height:100%;
        position:fixed;
        top:0%;
        left:0%;
        word-wrap:break-word;
    }

    #vi1::-webkit-scrollbar{
        width:10px;
        background:white
    }
    
    #vi1::-webkit-scrollbar-thumb{
    background:gray;
    border-radius:15px;
    
    }

    @media screen and (max-width:991px){

        #vi1{
           top:0%;
           left:0%;
           width:100%;
           height:100%
        }

      
    }
    </style>";

$user=new Manager();
$id=0;
$user->setCelular($_SESSION['Numero']);

foreach($user->fetchUser() as $linha){
    $id=$linha['id_user'];
}

$user->setId($id);
echo "<div class='container table-responsive'><table class='table table-hover bg-primary text-dark'>";
foreach($user->fetchAllUsers() as $linha){
    $user->setNumero($linha['Numero']);
    $user->setId(base64_decode($_REQUEST['id']));
  
    if($user->checkMembro()->rowCount()==0){
       echo "<tr><td style='width:95%'><div class='card my-2 '><strong>".$linha['Nome'].'</strong></td><td><button class="btn btn-outline-primary text-dark" onclick="add('.$linha['id_user'].','.base64_decode($_REQUEST['id']).')" id="s'.$linha['id_user'].'">Adicionar</button><br></div></td></tr>';
    }else{
        echo "<tr><td style='width:95%'><div class='card my-2 '><strong>".$linha['Nome'].'</strong></td><td><div class="btn btn-outline-primary text-dark" >Membro</div><br></div></td></tr>';
    }
    

}

echo "</table></div></div>";

echo "</div>";


//================end===========================
?>
<script>

//=close views
$(document).on('click','#closar12',function(){
    $('#vi1').slideUp();
   
})


function add(p,y){
    
$.ajax({
    url:'groupRequest.php',
    type:'post',
    data:{m:p,g:y},
    success:function(data){
$('#s'+p).text(data)
$('#s'+p).removeAttr('onclick')
    }
})

}

function addMembro(){
    $('#vi1').slideToggle()
}
</script>