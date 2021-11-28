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
.nt{
background:rgba(0,0,200,0.2)
}

.nt1{
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
date_default_timezone_set('africa/maputo');
include 'includes/incluir.php';
include 'classes/Manager.class.php';

include 'includes/nav.php';
include 'includes/section.php';

//=================update views==============

$not=new Manager();
$not->setCelular($_SESSION['Numero']);

$id=0;
foreach($not->fetchUser() as $li){
$id=$li['id_user'];
}
$not->setId($id);
$not->updateNotView();

//====================================

echo "<div id='aside' class='bg-light'>";

$m=new Manager();
//=======posts notification===============
if($m->fetchPost()->rowCount()==0){
    echo "<div class='card' style='margin-bottom:2px;padding:10px' style='text-align:center;margin:auto'><center>Nao existe notifica&ccedil;oes aqui</center></div>";
    exit;
}
$id=0;
foreach($m->fetchPost() as $linha){

    $m->setCelular($linha['Numero']);

    foreach($m->fetchUser() as $li){
        if($li['Numero']!=$_SESSION['Numero']){
        echo "<div class='card' style='margin-bottom:2px;padding:10px'><b>".$li['Nome']."</b> ".substr($linha['Mensagem'],0,100)."...<br><div class='btn btn-outline-primary'  onclick='comment1(".$linha['id_posts'].")' id='ver'>Ver Post</div></div>";
        }
    }
  $id=$linha['id_posts'];
}


    echo "<br><center><div class='btn  btn-outline-primary' onclick='load(".$id.")' id='load'>Mais</div></center>";


    
echo "</div>";

//==========end===============================




?>
<div id='post1'></div>
<script>

//===============================see post comments====
function comment(p){

$.ajax({
    url:'like.php',
    type:'post',
    data:{p1:p},
    success:function(data){
   
        $('#post1').html(data)
        $('#dvb2').show(100)
        $('#fp').hide(100)
    }
})
}

function comentar(p){
  
  var texto=$('#msgCom').val();
  
  if(texto!=''){
  
  $.ajax({
      url:'like.php',
      type:'post',
      data:{idPost:p,txt:texto},
      success:function(data){
         $('#msgCom').val("")
         $('#body').html(data);
      }
      
      
  })
  
  }
  
  }

//==============delete comments===========================

function delCom(p,y){
   
   $.ajax({
       url:'like.php',
       type:'post',
       data:{del:p,pos:y},
       success:function(data){
           $('#body').html(data)
       }
   })
   
   }
   
   //===========end=========================

   //=====================loadComents ====================
$(document).on('click','#comMore',function(){
    var s=$(this).data('id')
    var s1=$(this).data('post')
    $(this).html("<center><img src='files/load1.gif' width=30 height=30> Processando</center>")
    $.ajax({
        url:'load.php',
        type:'post',
        data:{com:s,s1:s1},
        success:function(data){
            $('#comMore').remove()
            $('#body').append(data)
            $('#comMore').text('Mais')
        }
    })
})


//=================end========================================

function comment1(p){

$.ajax({
    url:'like.php',
    type:'post',
    data:{notificacao:p},
    success:function(data){
      
        $('#post1').html(data)
        $('#dvb5').show(200)
    }
})


}

//====================like========================

function like(p){

$.ajax({
    url:'like.php',
    type:'post',
    data:{p:p},
    success:function(data){
        $('.like'+p).html(data)
    }
})
}


//=====================endlike===================

//=close status
$(document).on('click','#closar',function(){
    $('#dvb5').fadeToggle();
    $('#fp').show()
})


function load(p){
    $('#load').html("<center><img src='files/load1.gif' width=30 height=30> Processando</center>")

    $.ajax({
        url:'load.php',
        type:'post',
        data:{pload:p},
        success:function(data){
            $('#aside').append(data);
            $('#load').remove()
            $('#load').text('Mais')

        }
    })
}
</script>