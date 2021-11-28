<?php session_start();
include 'includes/incluir.php';
include 'classes/Manager.class.php';


if((!isset($_REQUEST['idS']) && !isset($_REQUEST['id'])) || !isset($_SESSION['Numero'])){
    include 'includes/incluir.php';

  

    echo "<style>
    body{
    background: #007bff;
 
    }
    #aside,#section,#pcmenu,#mmenu,#btnm{display:none}
    </style>";
    echo "<div  style='margin:10% auto;background:white;padding:10px;text-align:center;width:90%'>Erro de pagina<br><a href='avancar1.php' class='btn btn-primary'>Voltar</a></div>";
    
        
       exit;
}



//=================insert view===============
$id=0;
if(isset($_REQUEST['idS'])){
$id=$_REQUEST['idS'];
}else if(isset($_REQUEST['id'])){
    $id=$_REQUEST['id'];
}


$view=new Manager();
$view->setCelular($_SESSION['Numero']);
$view->setId($id);
$view->insertViews();

//================================



//==================================seeStatus==========================


if(isset($_REQUEST['idS'])){

    $view=new Manager();
    $view->setId($_REQUEST['idS']);

    echo "<div id='dvb1' style='display:none'>";
    
    echo "<div id='st1'>";
    
    echo "<button class='close' id='closar1' style='outline:none'>&times;</button>";
    $fetch1=new Manager();
    $fetch1->setId($_REQUEST['idS']);
    $n=0;

    foreach($fetch1->fetchStatusViaId() as $thug){
        $n=$thug['Numero'];
    }

    $fetch1->setCelular($n);
    foreach($fetch1->fetchStatus() as $linha){

        //=======================selecionar qual usuario eh pra responder os status===========
        $resp=new Manager();
        $resp->setId($linha['Id']);
        foreach($resp->fetchStatusViaId() as $lin){
            echo "<div class='btn btn-light text-dark' style='border-radius:0px' data-id='".$lin['id_user']."' id='resp' data-status='".$linha['Id']."'>Responder</div> ";
        }
      //===========================================end============================

        $time=localtime($linha['Timer'],true);

        $day=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];

        echo "<button  id='prev1' class='btn btn-outline-dark text-light ' data-id='".$linha['Id']."' >
      prev
        </button>";
        
        echo "<button id='next1' class='btn btn-outline-dark text-light'  data-id='".$linha['Id']."'>
        next
        </button><br><br>";
    
        $valor=1;
        foreach($fetch1->fetchStatusNoLimit() as $statusNoLimit){
            echo "<div style='height:10px;background:rgba(255,255,255,.5);border-radius:10px;width:".(100/$fetch1->fetchStatusNoLimit()->rowCount())."%;display:inline-block;border:1px solid black' id='stopStatus'>";
//=====================================pint the status bar in whitecolor
            if($linha['Id']==$statusNoLimit['Id']){
                echo "<div style='width:100%;background:#fff;height:100%' id='valo".$valor."' data-id='".$statusNoLimit['Id']."' data-num='".$fetch1->fetchStatusNoLimit()->rowCount()."'></div>";
            }else{
                echo "<div style='width:0%;background:#fff;height:100%' id='valo".$valor."' data-id='".$statusNoLimit['Id']."' data-num='".$fetch1->fetchStatusNoLimit()->rowCount()."'></div>";
            }
          


            echo "</div>";
            $valor++;
        }
        echo "<style>
        @font-face{
            font-family:'thugger';
            src:url(font/PaintDropsRegular-0WaJo.ttf)
        }

        
@font-face{
    font-family:'thugger1';
    src:url(font/BeautifulPeoplePersonalUse-dE0g.ttf)
}
        #dvb1{";

            if($linha['Imagem']==''){
                echo "background:".$linha['Cor1'].";";
            }else{
                echo "background:#343a40;
                overflow:auto;";
               
            }
           
            

            echo "width:100%;
            height:100%;
            position:fixed;
            top:0%;
            left:0%;
            word-wrap:break-word;
        }
    
    
        @media screen and (max-width:991px){
    
            #dvb1{
               top:0%;
               left:0%;
               width:100%;
               height:100%
            }
    
          
        }
        </style>";
    
        if($linha['Letra']=="delete"){
    
          
    
            echo "<div   style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' >";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto'><del>".$linha['Texto']."</del></div>";
           echo "</div>";
    
    
        }else if($linha['Letra']=='underline'){
    
         
    
            echo "<div  style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' >";
            echo "<center style='text-shadow:1px 1px 1px blackcolor:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto'><u>".$linha['Texto']."</u></div>";
           echo "</div>";
        }else if($linha['Letra']=='bold'){
    
         
    
            echo "<div   style='font-size:40px;color:".$linha['Cor'].";text-align:center; data-id='".$linha['Id']."' >";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto'><b>".$linha['Texto']."</b></div>";
           echo "</div>";
    
        }else if($linha['Letra']=='italico'){
    
            echo "<div   style='font-size:40px;color:".$linha['Cor'].";text-align:center; data-id='".$linha['Id']."' >";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto'><i>".$linha['Texto']."</i></div>";
           echo "</div>";
        }else if($linha['Letra']=='normal'){
    
         
    
            echo "<div style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' >";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto'>".$linha['Texto']."</div>";
           echo "</div>";
        }else if($linha['Imagem']!=''){

                       //============checking video or img===========
   if( substr($linha['Imagem'],strlen($linha['Imagem'])-4,strlen($linha['Imagem']))=='.mp4' || substr($linha['Imagem'],strlen($linha['Imagem'])-4,strlen($linha['Imagem']))=='.m4a'){

    //=========if video==============
    echo "<div style='font-size:40px;text-align:center;' data-id='".$linha['Id']."' >";
    echo "<center style='text-shadow:1px 1px 1px black;color:white;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
    echo "<div style='margin: auto'>
    <video src='img/status/".$linha['Imagem']."' class='img-fluid' id='statusVideo1' autoplay>
    
    </div><input type='hidden' value='".$linha['Id']."' id='hora1'>";
    echo "<div id='videotime1'></div></div>";
   }else{
       //============if image=================
       echo "<div style='font-size:40px;text-align:center;' data-id='".$linha['Id']."' >";
       echo "<center style='text-shadow:1px 1px 1px black;color:white;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
       echo "<div style='margin: auto'>
       <img src='img/status/".$linha['Imagem']."' class='img-fluid'>
       
       </div>";
      echo "</div>";
   }
           
    
        }else if($linha['Letra']=='thugger'){

            echo "<div style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' >";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto;font-family:thugger'>".$linha['Texto']."</div>";
           echo "</div>";

        }else if($linha['Letra']=='thugger1'){

            echo "<div style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' >";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto;font-family:thugger1'>".$linha['Texto']."</div>";
           echo "</div>";

        }
    
    
    
    
    }
    
    echo "</div>";
    echo "</div>";
    }else if(isset($_REQUEST['id'])){

        
 $delete=new Manager();
 $delete->setId($_REQUEST['id']);

 foreach($delete->fetchStatusTodel() as $linha){

    if($linha['Imagem']!=''){
        unlink('img/status/'.$linha['Imagem']);
    }
 }


 $delete->deleteStatus();

 

 
}

    ?>

    <script>
    //=close status
$(document).on('click','#closar1',function(){

    var vid=document.getElementById("statusVideo1")


if(vid!=null){
    vid.pause();
}


    $('#dvbThug').hide();
    $('#dvb1').hide(100);
    $('#fp').show(100)
  
  
})


//==================================setting video status time===========


var vid=document.getElementById("statusVideo1")
 

if(vid!=null){
  vid.addEventListener('timeupdate',videoOfStatus);
}

var tempo=document.getElementById('videotime1');

function videoOfStatus(){
    tempo.style.position='absolute';
tempo.style.top='20%';
// tempo.style.margin='auto';
tempo.style.color='#007bff';
tempo.style.boxShadow="1px 2px 2px black";
tempo.style.textShadow="1px 2px 2px black";
tempo.style.opacity=0.5

// tempo.style.background='rgba(0,0,0,.2)';
// tempo.style.width="100%"
tempo.style.width="80px"
tempo.style.height="80px"
tempo.style.borderRadius="100%"
tempo.style.border="5px solid #007bff"
        tempo.innerText=Math.round(this.currentTime);
    if(this.currentTime>30){
        this.currentTime=0;
    }
}

    </script>