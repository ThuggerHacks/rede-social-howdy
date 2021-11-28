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
.msg1{
background:rgba(0,0,200,0.2)
}

.msg{
    background:whitesmoke;
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
include 'includes/incluir.php';
include 'classes/Manager.class.php';

include 'includes/nav.php';
include 'includes/section.php';



echo "<div id='aside' >";

echo "<div id='recipie'></div>";
echo "<div id='sender'></div>";

echo "</div>";

//==========end===============================
?>

<script>
$('#recipie').html('<div style="width:50%;height:50%;margin:10% auto;text-align:center"><img src="files/load2.gif" class="img-fluid" /><p>Aguarde...</p></div>')

setTimeout(()=>{
    $.ajax({
    url:'msg2.php',
    type:'post',
    data:{me:"id"},
    success:function(data){
        if(data!=''){
            $('#recipie').html('')
        $('#sender').html(data)
        }

    }

})


$.ajax({
    url:'msg2.php',
    type:'post',
    data:{me1:"id"},
    success:function(data){

if(data!=''){
    $('#recipie').html(data)
        $('#sender').html('')
       
}



    
      
      
    }

})
},1000)


</script>