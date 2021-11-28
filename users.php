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

#aside::-webkit-scrollbar{
    width:10px;
    background:white
}

#aside::-webkit-scrollbar-thumb{
background:gray;
border-radius:15px;

}
.us{
background:rgba(0,0,200,0.2)
}

.us1{
    background:whitesmoke;
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
include 'includes/incluir.php';
include 'classes/Manager.class.php';

include 'includes/nav.php';
include 'includes/section.php';



echo "<div id='aside' class='bg-light'>";

$m=new Manager();

$m->setCelular($_SESSION['Numero']);
$bi=0;
$id=0;

foreach($m->fetchUser() as $linha){
    $bi=$linha['id_user'];
}

$m->setId($bi);

    foreach($m->fetchAllUsers1() as $li){
        if($li['Numero']!=$_SESSION['Numero']){
            
            if($li['Avatar']!=''){
                echo "<a href='account.php?id=".base64_encode($li['id_user'])."' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'><img src='img/avatar/".$li['Avatar']."' width=30 height=30 style='border-radius:50%'> <b>".$li['Nome']."</b></div></a>";
            }else if($li['Avatar']=='' and $li['Sexo']=='Masculino'){

                echo "<a href='account.php?id=".base64_encode($li['id_user'])."' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'><img src='files/male.png' width=30 height=30 > <b>".$li['Nome']."</b></div></a>";

            }else{
                echo "<a href='account.php?id=".base64_encode($li['id_user'])."' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'><img src='files/female.png' width=30 height=30 > <b>".$li['Nome']."</b></div></a>";
            }

      


        }
    
  $id=$li['id_user'];
    }


    echo "<br><center><div class='btn btn-outline-primary' data-id='".$id."' id='load'>Mais</div></center>";


    
echo "</div>";

//==========end===============================




?>

<script>

$(document).on('click','#load',function(){
    $('#load').html("<center><img src='files/load1.gif' width=30 height=30> Processando</center>")
$.ajax({
    url:'load.php',
    type:'post',
    data:{luser:$(this).data('id')},
    success:function(data){
        $('#load').text('Mais')
        $('#aside').append(data)
        $('#load').remove();
    }
  

})

})
</script>