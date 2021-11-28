<?php session_start();
//==================================seeStatus==========================

include 'classes/Manager.class.php';





if(isset($_REQUEST['id'])){

    $view=new Manager();
    $view->setId($_REQUEST['id']);

echo "<button class='close' id='closar' style='outline:none'>&times;</button>";
$fetch=new Manager();
$fetch->setId($_REQUEST['id']);
$n=0;

foreach($fetch->fetchStatusViaId() as $linha){
    $n=$linha['Numero'];
}
$fetch->setCelular($n);



if($fetch->fetchNextStatus()->rowCount()>0){
    
  
foreach($fetch->fetchNextStatus() as $linha){
    echo "<div class='btn btn-light text-dark' style='border-radius:0px' data-id='".$linha['Id']."' id='views' onclick='statusView(".$linha['Id'].")'>Views </div> ";
    echo "<button  id='prev' class='btn btn-outline-dark text-light ' data-id='".$linha['Id']."' >
  prev
    </button>";
    
    echo "<button id='next' class='btn btn-outline-dark text-light'  data-id='".$linha['Id']."'>
    next
    </button>";
    echo " <div class='btn btn-danger text-light' style='border-radius:0px' data-id='".$linha['Id']."' id='del'>delete</div><br><br> ";

    $valor=1;
    foreach($fetch->fetchMyStatusNoLimit() as $statusNoLimit){
        echo "<div style='height:10px;background:rgba(255,255,255,.5);border-radius:10px;width:".(100/$fetch->fetchMyStatusNoLimit()->rowCount())."%;display:inline-block;border:1px solid black' id='stopStatus'>";

        //=============pint the status bar in whitecolor
        if($linha['Id']<=$statusNoLimit['Id']){
            echo "<div style='width:100%;background:#fff;height:100%' id='valor".$valor."' data-id='".$statusNoLimit['Id']."' ></div>";
        }else{
            echo "<div style='width:0%;background:#fff;height:100%' id='valor".$valor."' data-id='".$statusNoLimit['Id']."' ></div>";
        }
        

        echo "</div>";
        $valor++;
    }
    echo "<style>
    #dvb{";

        

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

    @font-face{
        font-family:'thugger';
        src:url(font/PaintDropsRegular-0WaJo.ttf)
    }
    @font-face{
        font-family:'thugger1';
        src:url(font/BeautifulPeoplePersonalUse-dE0g.ttf)
    }
    @media screen and (max-width:991px){

        #dvb{
           top:0%;
           left:0%;
           width:100%;
           height:100%
        }

      
    }
    </style>";

    $time=localtime($linha['Timer'],true);
    $day=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
    if($linha['Letra']=="delete"){

      

        echo "<div   style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' class='s0'>";
        echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
        echo "<div style='margin:10% auto'><del>".$linha['Texto']."</del></div>";
       echo "</div>";


    }else if($linha['Letra']=='underline'){

     

        echo "<div  style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' class='s0'>";
        echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
        echo "<div style='margin:10% auto'><u>".$linha['Texto']."</u></div>";
       echo "</div>";
    }else if($linha['Letra']=='bold'){

     

        echo "<div   style='font-size:40px;color:".$linha['Cor'].";text-align:center; data-id='".$linha['Id']."' class='s0'>";
        echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
        echo "<div style='margin:10% auto'><b>".$linha['Texto']."</b></div>";
       echo "</div>";

    }else if($linha['Letra']=='italico'){

        echo "<div   style='font-size:40px;color:".$linha['Cor'].";text-align:center; data-id='".$linha['Id']."' class='s0'>";
        echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
        echo "<div style='margin:10% auto'><i>".$linha['Texto']."</i></div>";
       echo "</div>";
    }else if($linha['Letra']=='normal'){

     

        echo "<div style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' class='s0'>";
        echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
        echo "<div style='margin:10% auto'>".$linha['Texto']."</div>";
       echo "</div>";
    }else if($linha['Imagem']!=''){
   //============checking video or img===========
   if( substr($linha['Imagem'],strlen($linha['Imagem'])-4,strlen($linha['Imagem']))=='.mp4' || substr($linha['Imagem'],strlen($linha['Imagem'])-4,strlen($linha['Imagem']))=='.m4a'){

    //=============if video================================
    echo "<div style='font-size:40px;text-align:center;' data-id='".$linha['Id']."' class='s0'>";
    echo "<center style='text-shadow:1px 1px 1px black;color:white;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
    echo "<div style='margin: auto;' >";

     
    echo "<video src='img/status/".$linha['Imagem']."' class='img-fluid' id='statusVideo' autoplay ontimeupdate='videoOfStatus(1,this)'>";
    echo "</div><input type='hidden' value='".$linha['Id']."' id='hora'>";
    echo "<div id='videotime1' ></div></div>";
}else{

    //===========if image==================================
    echo "<div style='font-size:40px;text-align:center;' data-id='".$linha['Id']."' class='s0'>";
    echo "<center style='text-shadow:1px 1px 1px black;color:white;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
    echo "<div style='margin: auto;' >";

     
    echo "<img src='img/status/".$linha['Imagem']."' class='img-fluid'>";
    echo "</div>";
   echo "</div>";
}
  
    }else if($linha['Letra']=='thugger'){

        echo "<div style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' class='s0'>";
        echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
        echo "<div style='margin:10% auto;font-family:thugger'>".$linha['Texto']."</div>";
       echo "</div>"; 
    }else if($linha['Letra']=='thugger1'){

        echo "<div style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' class='s0'>";
        echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
        echo "<div style='margin:10% auto;font-family:thugger1'>".$linha['Texto']."</div>";
       echo "</div>"; 
    }




}


}else{
    echo "<script>
    $('#fp').show()
    open('avancar1.php','_self')
    </script>";

}

//================end===========================

}else if(isset($_REQUEST['id1'])){

$view=new Manager();
$view->setId($_REQUEST['id1']);
//=========================my prev Status==================

    echo "<button class='close' id='closar' style='outline:none'>&times;</button>";
    $fetch=new Manager();
    $fetch->setId($_REQUEST['id1']);
    $n=0;

    foreach($fetch->fetchStatusViaId() as $linha){
        $n=$linha['Numero'];
    }
    $fetch->setCelular($n);
    
    if($fetch->fetchPrevStatus()->rowCount()>0){
        
      
    foreach($fetch->fetchPrevStatus() as $linha){
        echo "<div class='btn btn-light text-dark' style='border-radius:0px' data-id='".$linha['Id']."' id='views' onclick='statusView(".$linha['Id'].")'>Views </div> ";
        echo "<button  id='prev' class='btn btn-outline-dark text-light ' data-id='".$linha['Id']."' >
      prev
        </button>";
        
        echo "<button id='next' class='btn btn-outline-dark text-light'  data-id='".$linha['Id']."'>
        next
        </button>";
        echo " <div class='btn btn-danger text-light' style='border-radius:0px' data-id='".$linha['Id']."' id='del'>delete</div> <br><br>";
        $valor=1;
        foreach($fetch->fetchMyStatusNoLimit() as $statusNoLimit){
            echo "<div style='height:10px;background:rgba(255,255,255,.5);border-radius:10px;width:".(100/$fetch->fetchMyStatusNoLimit()->rowCount())."%;display:inline-block;border:1px solid black' id='stopStatus'>";
//=======================pint the status bar in white color
            if($linha['Id']<=$statusNoLimit['Id']){
                echo "<div style='width:100%;background:#fff;height:100%' id='valor".$valor."' data-id='".$statusNoLimit['Id']."' ></div>";
            }else{
                echo "<div style='width:0%;background:#fff;height:100%' id='valor".$valor."' data-id='".$statusNoLimit['Id']."' ></div>";
            }
            
    
            echo "</div>";
            $valor++;
        }
        echo "<style>
        #dvb{";

           

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
        @font-face{
            font-family:'thugger';
            src:url(font/PaintDropsRegular-0WaJo.ttf)
        }
        @font-face{
            font-family:'thugger1';
            src:url(font/BeautifulPeoplePersonalUse-dE0g.ttf)
        }
        @media screen and (max-width:991px){
    
            #dvb{
               top:0%;
               left:0%;
               width:100%;
               height:100%
            }
    
          
        }
        </style>";
    $time=localtime($linha['Timer'],true);
    $day=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
        if($linha['Letra']=="delete"){
    
          
    
            echo "<div   style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' class='s0'>";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto'><del>".$linha['Texto']."</del></div>";
           echo "</div>";
    
    
        }else if($linha['Letra']=='underline'){
    
         
    
            echo "<div  style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' class='s0'>";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto'><u>".$linha['Texto']."</u></div>";
           echo "</div>";
        }else if($linha['Letra']=='bold'){
    
         
    
            echo "<div   style='font-size:40px;color:".$linha['Cor'].";text-align:center; data-id='".$linha['Id']."' class='s0'>";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto'><b>".$linha['Texto']."</b></div>";
           echo "</div>";
    
        }else if($linha['Letra']=='italico'){
    
            echo "<div   style='font-size:40px;color:".$linha['Cor'].";text-align:center; data-id='".$linha['Id']."' class='s0'>";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto'><i>".$linha['Texto']."</i></div>";
           echo "</div>";
        }else if($linha['Letra']=='normal'){
    
         
    
            echo "<div style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' class='s0'>";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto'>".$linha['Texto']."</div>";
           echo "</div>";
        }else if($linha['Imagem']!=''){
           //============checking video or img===========
   if( substr($linha['Imagem'],strlen($linha['Imagem'])-4,strlen($linha['Imagem']))=='.mp4' || substr($linha['Imagem'],strlen($linha['Imagem'])-4,strlen($linha['Imagem']))=='.m4a'){

    //=============if video================================
    echo "<div style='font-size:40px;text-align:center;' data-id='".$linha['Id']."' class='s0'>";
    echo "<center style='text-shadow:1px 1px 1px black;color:white;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
    echo "<div style='margin: auto;' >";

     
    echo "<video src='img/status/".$linha['Imagem']."' class='img-fluid' id='statusVideo' autoplay ontimeupdate='videoOfStatus(1,this)'>";
    echo "</div><input type='hidden' value='".$linha['Id']."' id='hora'>";
    echo "<div id='videotime1' ></div></div>";
}else{

    //===========if image==================================
    echo "<div style='font-size:40px;text-align:center;' data-id='".$linha['Id']."' class='s0'>";
    echo "<center style='text-shadow:1px 1px 1px black;color:white;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
    echo "<div style='margin: auto;' >";

     
    echo "<img src='img/status/".$linha['Imagem']."' class='img-fluid'>";
    echo "</div>";
   echo "</div>";
}
        }else if($linha['Letra']=='thugger'){

            echo "<div style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' class='s0'>";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto;font-family:thugger'>".$linha['Texto']."</div>";
           echo "</div>";

        }else if($linha['Letra']=='thugger1'){

            echo "<div style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' class='s0'>";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto;font-family:thugger1'>".$linha['Texto']."</div>";
           echo "</div>";

        }
    
    
    
    
    }
    
    
    }else{
        echo "<script>
        $('#fp').show()
        open('avancar1.php','_self')
        
    </script>";
    }
    
}else if(isset($_REQUEST['id2'])){
//===================================newxSomeoneStatus


//=================insert view===============
$view=new Manager();
$view->setCelular($_SESSION['Numero']);
$view->setId($_REQUEST['id2']);
$view->insertViews();

//================================
    echo "<button class='close' id='closar1' style='outline:none'>&times;</button>";
    $fetch=new Manager();
    $fetch->setId($_REQUEST['id2']);
    $n=0;
    
    foreach($fetch->fetchStatusViaId() as $linha){
        $n=$linha['Numero'];
    }
    $fetch->setCelular($n);
    
    
    
    if($fetch->fetchNextStatus()->rowCount()>0){
        
      
    foreach($fetch->fetchNextStatus() as $linha){
 //=======================selecionar qual usuario eh pra responder os status===========
 $resp=new Manager();
 $resp->setId($linha['Id']);
 foreach($resp->fetchStatusViaId() as $lin){
     echo "<div class='btn btn-light text-dark' style='border-radius:0px' data-id='".$lin['id_user']."' id='resp' data-status='".$linha['Id']."'>Responder</div> ";
 }
//===========================================end============================

        echo "<button  id='prev1' class='btn btn-outline-dark text-light ' data-id='".$linha['Id']."' >
      prev
        </button>";
        
        echo "<button id='next1' class='btn btn-outline-dark text-light'  data-id='".$linha['Id']."'>
        next
        </button><br><br>";
        $valor2=1;
        foreach($fetch->fetchStatusNoLimit() as $statusNoLimit){
            echo "<div style='height:10px;background:rgba(255,255,255,.5);border-radius:10px;width:".(100/$fetch->fetchStatusNoLimit()->rowCount())."%;display:inline-block;border:1px solid black' id='stopStatus'>";
//=====================================pint the status bar in whitecolor
            if($linha['Id']<=$statusNoLimit['Id']){
                echo "<div style='width:100%;background:#fff;height:100%' id='valo".$valor2."' data-id='".$statusNoLimit['Id']."' data-num='".$fetch->fetchStatusNoLimit()->rowCount()."'></div>";
            }else{
                echo "<div style='width:0%;background:#fff;height:100%' id='valo".$valor2."' data-id='".$statusNoLimit['Id']."' data-num='".$fetch->fetchStatusNoLimit()->rowCount()."'></div>";
            }
          


            echo "</div>";
            $valor2++;
        }
        echo "<style>
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
    
        @font-face{
            font-family:'thugger';
            src:url(font/PaintDropsRegular-0WaJo.ttf)
        }
        @font-face{
            font-family:'thugger1';
            src:url(font/BeautifulPeoplePersonalUse-dE0g.ttf)
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
    $time=localtime($linha['Timer'],true);
    $day=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
        if($linha['Letra']=="delete"){
    
          
    
            echo "<div   style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' >";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto'><del>".$linha['Texto']."</del></div>";
           echo "</div>";
    
    
        }else if($linha['Letra']=='underline'){
    
         
    
            echo "<div  style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' >";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
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
    echo "<div style='margin:auto'>
    <video src='img/status/".$linha['Imagem']."' class='img-fluid' id='statusVideo1' autoplay ontimeupdate='videoOfStatus(2,this)'>
    
    </div><input type='hidden' value='".$linha['Id']."' id='hora'>";
    echo "<div id='videotime2' ></div></div>";
   }else{
       //============if image=================
       echo "<div style='font-size:40px;text-align:center;' data-id='".$linha['Id']."' >";
       echo "<center style='text-shadow:1px 1px 1px black;color:white;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
       echo "<div style='margin:auto'>
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
    
 
    }else{
        echo "<script>
        $('#dvb1').slideUp()
        $('#fp').show()
        
        </script>";
    
    }
}else if(isset($_REQUEST['id3'])){



//=========================prevSomeoneStatus
    
$view=new Manager();
$view->setCelular($_SESSION['Numero']);
$view->setId($_REQUEST['id3']);

    echo "<button class='close' id='closar1' style='outline:none'>&times;</button>";
    $fetch=new Manager();
    $fetch->setId($_REQUEST['id3']);
    $n=0;

    foreach($fetch->fetchStatusViaId() as $linha){
        $n=$linha['Numero'];
    }
    $fetch->setCelular($n);
    
    if($fetch->fetchPrevStatus()->rowCount()>0){
        
      
    foreach($fetch->fetchPrevStatus() as $linha){
    //=======================selecionar qual usuario eh pra responder os status===========
    $resp=new Manager();
    $resp->setId($linha['Id']);
    foreach($resp->fetchStatusViaId() as $lin){
        echo "<div class='btn btn-light text-dark' style='border-radius:0px' data-id='".$lin['id_user']."' id='resp' data-toggle='modal' data-target='#msgresp' data-status='".$linha['Id']."'>Responder</div> ";
    }
  //===========================================end============================

        echo "<button  id='prev1' class='btn btn-outline-dark text-light ' data-id='".$linha['Id']."' >
      prev
        </button>";
        
        echo "<button id='next1' class='btn btn-outline-dark text-light'  data-id='".$linha['Id']."'>
        next
        </button><br><br>";
    
        $valor=1;
        foreach($fetch->fetchStatusNoLimit() as $statusNoLimit){
            echo "<div style='height:10px;background:rgba(255,255,255,.5);border-radius:10px;width:".(100/$fetch->fetchStatusNoLimit()->rowCount())."%;display:inline-block;border:1px solid black' id='stopStatus'>";
//=====================================pint the status bar in whitecolor
            if($linha['Id']<=$statusNoLimit['Id']){
                echo "<div style='width:100%;background:#fff;height:100%' id='valo".$valor."' data-id='".$statusNoLimit['Id']."' data-num='".$fetch->fetchStatusNoLimit()->rowCount()."'></div>";
            }else{
                echo "<div style='width:0%;background:#fff;height:100%' id='valo".$valor."' data-id='".$statusNoLimit['Id']."' data-num='".$fetch->fetchStatusNoLimit()->rowCount()."'></div>";
            }
          


            echo "</div>";
            $valor++;
        }
        echo "<style>
        #dvb1{";

            if($linha['Imagem']==''){
                echo "background:".$linha['Cor1'].";";
            }else{
                echo "background:#343a40;
                overflow:auto;";
            }
           

            echo "width:190%;
            height:100%;
            position:fixed;
            top:0%;
            left:0%;
            word-wrap:break-word;
        }
    
        @font-face{
            font-family:'thugger';
            src:url(font/PaintDropsRegular-0WaJo.ttf)
        }
        @font-face{
            font-family:'thugger1';
            src:url(font/BeautifulPeoplePersonalUse-dE0g.ttf)
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
    
        $time=localtime($linha['Timer'],true);
        $day=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
        if($linha['Letra']=="delete"){
    
          
    
            echo "<div   style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' >";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
            echo "<div style='margin:10% auto'><del>".$linha['Texto']."</del></div>";
           echo "</div>";
    
    
        }else if($linha['Letra']=='underline'){
    
         
    
            echo "<div  style='font-size:40px;color:".$linha['Cor'].";text-align:center;' data-id='".$linha['Id']."' >";
            echo "<center style='text-shadow:1px 1px 1px black;color:black;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
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
    <video src='img/status/".$linha['Imagem']."' class='img-fluid' id='statusVideo1' autoplay ontimeupdate='videoOfStatus(2,this)'>
    
    </div><input type='hidden' value='".$linha['Id']."' id='hora'>";
    echo "<div id='videotime2' ></div></div>";
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
    
    
    }else{
        echo "<script>
  $('#dvb1').slideUp()
  $('#fp').show()
    </script>";
    }
}else{

    include 'includes/incluir.php';

    echo "<style>
    body{
    background: #007bff;
    }
    </style>";
    echo "<div  style='margin:10% auto;background:white;padding:10px;text-align:center;width:90%'>Nao tem permissao para ver esta pagina<br><a href='index.php' class='btn btn-primary'>LOGIN</a></div>";
    
   

}


?>

<script>

//===================delete status===================

$('#del').click(function(){
    var id=$(this).data('id')

var c=confirm('Quer mesmo eliminar este status?')

if(c){
$.ajax({
    url:'status.php',
    type:'post',
    data:{id:id},
    success:function(data){
        alert('Eliminado')
    }
})
}
})

//=================================================


//=========================================see status views===================

function statusView(p){

$.ajax({
    url:'views.php',
    type:'post',
    data:{p2:p},
    success:function(data){
     alert(data)
    }
})
}

//=close views
$(document).on('click','#closar11',function(){
    $('#dvbThug').hide();
    $('#vi').slideUp();
  
   
})

//=========================================see status views===================

function statusView(p){

$.ajax({
    url:'views.php',
    type:'post',
    data:{p2:p},
    success:function(data){
        $('#vi').show();
    $('#views2').html(data)
    }
})
}


//===============================================
//===============================================


//==================================setting video status time===========

function videoOfStatus(tempo1,el){
 
var tempo=document.getElementById('videotime'+tempo1);
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
        tempo.innerText=Math.round(el.currentTime);
    if(el.currentTime>30){
        el.currentTime=0;
    }


}
</script>