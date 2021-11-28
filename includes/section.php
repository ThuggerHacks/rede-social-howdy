
<style>
#section::-webkit-scrollbar{
        width:10px;
        background:white
    }
    
    #section::-webkit-scrollbar-thumb{
    background:gray;
    border-radius:15px;
    
    }

#section{
    height:100%;
    width:30%;
    overflow:auto;
    float:left;
    border:1px solid rgb(220,220,220);


}

@media screen and (min-width:992px) and (max-width:1024px){
    #section{
       width:35%;
    }

}

@media screen and (max-width:991px){
    #section{
        display:none
    }
}


</style>


<div id='section' class='bg-light'>
<div id='sc1'></div>

<?php

$user=new Manager();
$user->setCelular($_SESSION['Numero']);
$id=0;
//=======================me==========================

foreach($user->fetchUser() as $linha){
   
if($linha['Avatar']=='' and $linha['Sexo']=='Masculino'){

    echo "<div style='margin:5%;'><strong><img src='files/male.png' width=50 height=50 > ".substr($linha['Nome'],0,18)." </strong><small style='float:right;color:#0f0'>online</small></div>";

}else if($linha['Avatar']=='' and $linha['Sexo']=='Femenino'){
    echo "<div style='margin:5%;'><strong><img src='files/female.png' width=50 height=50> ".substr($linha['Nome'],0,18)." </strong><small style='float:right;color:#0f0'>online</small></div>";
}else{
    echo "<div style='margin:5%;'><strong><img src='img/avatar/".$linha['Avatar']."' width=50 height=50 style='border-radius:15px'> ".substr($linha['Nome'],0,18)." </strong><small style='float:right;color:#0f0'>online</small></div>";
}


}
echo "<small><strong>Chat (".$user->fetchOnlineUserNoLimit()->rowCount().")</strong></small><hr>";
//=======================other users=============
echo "<div id='user1'>";
foreach($user->fetchOnlineUser() as $linha){
   $id=$linha['id_user'];
    if($linha['Avatar']=='' and $linha['Sexo']=='Masculino'){
    
        echo "<a href='account.php?id=".base64_encode($linha['id_user'])."' style='text-decoration:none;color:black'><div style='margin:5%;'><strong><img src='files/male.png' width=50 height=50> ".substr($linha['Nome'],0,18)." </strong><small style='float:right;color:#0f0'>online</small></div></a>";
    
    }else if($linha['Avatar']=='' and $linha['Sexo']=='Femenino'){
        echo "<a href='account.php?id=".base64_encode($linha['id_user'])."' style='text-decoration:none;color:black'><div style='margin:5%;'><strong><img src='files/female.png' width=50 height=50> ".substr($linha['Nome'],0,18)." </strong><small style='float:right;color:#0f0'>online</small></div></a>";
    }else{
        echo "<a href='account.php?id=".base64_encode($linha['id_user'])."' style='text-decoration:none;color:black'><div style='margin:5%;'><strong><img src='img/avatar/".$linha['Avatar']."' width=50 height=50 style='border-radius:15px'> ".substr($linha['Nome'],0,18)." </strong><small style='float:right;color:#0f0'>online</small></div></a>";

    }
    
    
    }

echo "</div>";
?>
<center><div class='btn btn-outline-primary my-2' data-id='<?php echo $id;?>' id='load20'>Load</div></center>
</div>

<script>

//===================show mobile chat============

$(document).ready(function(){


$('#chat').click(function(){
  
  if(window.innerHeight<=991){
    $('#section').attr('style','width:100%;');
    $('#section').show(500);
    $('#mmenu').hide();
    $('.navbar-toggler').hide()
    $('#sc1').html('<button class="close remover" onclick="remover()">&times;</button>')
  }
})
    


})

function remover(){
    $('#section').hide(500)
    $('#mmenu').show(500);
    $('.navbar-toggler').show(500)
}

//===========================


//==========load more users==================

$(document).on('click','#load20',function(){
    $('#load20').html("<center><img src='files/load1.gif' width=30 height=30> Processando</center>")
    $.ajax({
        url:'load.php',
        type:'post',
        data:{us:$(this).data('id')},
        success:function(data){
            $('#load20').remove()
          $('#user1').append(data)
        
        }
    })
})


setInterval(() => {
   $.ajax({
       url:'msg1.php',
       type:'post',
       data:{online:''},
       success:function(data){
        
       }
   }) 
},2000);
</script>