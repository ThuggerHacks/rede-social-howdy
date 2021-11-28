<style>

#aside{
    height:100%;
    width:69%;
    overflow:auto;
    float:right;
    position:relative;
    top:0%;
    
}


@font-face{
    font-family:"thugger1";
    src:url(font/BeautifulPeoplePersonalUse-dE0g.ttf)
}

@font-face{
    font-family:"thugger";
    src:url(font/PaintDropsRegular-0WaJo.ttf)
}
.home{
    background:whitesmoke;
}
 #body::-webkit-scrollbar{
        width:10px;
        background:white
    }
    
    #body::-webkit-scrollbar-thumb{
    background:gray;
    border-radius:15px;
    
    }


    #dvb1::-webkit-scrollbar{
        width:10px;
        background:white
    }
    
    #dvb1::-webkit-scrollbar-thumb{
    background:gray;
    border-radius:15px;
    
    }



    #dvb::-webkit-scrollbar{
        width:10px;
        background:white
    }
    
    #dvb::-webkit-scrollbar-thumb{
    background:gray;
    border-radius:15px;
    
    }
#emj::-webkit-scrollbar{
width:8px;
background:whitesmoke;
}
#emj::-webkit-scrollbar-thumb{
width:8px;
background:blue;
}

#aside::-webkit-scrollbar{
    width:10px;
    background:white
}

#aside::-webkit-scrollbar-thumb{
background:gray;
border-radius:15px;

}
#next,#prev,#next1,#prev1{
    text-shadow:1px 1px 2px black;
}

#status{
    width:95%;
    height:138px;
    margin:10px auto;
    padding:2px;
    display:-webkit-box;
    display:-moz-box;
    display:-o-box;
    display:-ms-box;
    overflow-x:auto;
    overflow-y:hidden;
    border:1px solid rgb(220,220,220);
  
    
  
    
}
#status::-webkit-scrollbar{
    height:5px;
    background:#00000000;

}

#status::-webkit-scrollbar-thumb{
background:#222;
border-radius:10px;

}
#status-item{
width:140px;
background:#00000000;
text-align:center;
transition:background 1s;
margin:2px;
word-wrap:break-word;
border:5px solid #007bff;;
}

#status-item:hover{
background:whitesmoke;
cursor:pointer
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


<?php   session_start();
ob_start();
date_default_timezone_set('africa/maputo');

include 'classes/Manager.class.php';
include 'includes/incluir.php';


//==============update firstTime==========================
if(isset($_REQUEST['skip'])){

    $m1=new Manager();
$m1->setCelular($_SESSION['Numero']);
$m1->updateFirstTime();

}
//=======================================================



//================delete old status=====================

$st=new Manager();

foreach($st->fetchOldStatus() as $linha){

    if($linha['Imagem']!=''){
        unlink('img/status/'.$linha['Imagem']);

    }
}

$st->deleteOldStatus();



//========================================end==================

include 'includes/nav.php';

include 'includes/section.php';


echo "<div id='aside'>";

//new status=========================

$m1=new Manager();
$m1->setCelular($_SESSION['Numero']);

echo "<div id='status' class='bg-light'>";

foreach($m1->fetchUser() as $linha){

    if($linha['Avatar']=='' && $linha['Sexo']=='Masculino'){

  
   echo "<div id='status-item' data-target='#modal' data-toggle='modal'>";
    echo "<img src='files/male.png' width=100 height=90><br>
    <span><strong>Novo Status</strong> </span><br><br>
    ";
   echo "</div>";




    }else if($linha['Avatar']=='' && $linha['Sexo']=='Femenino'){

        echo "<div id='status-item' data-target='#modal' data-toggle='modal'>";
        echo "<img src='files/female.png' width=100 height=90><br>
        <span><strong>Novo Status</strong> </span><br><br>
        ";
       echo "</div>";

    }else{

        echo "<div id='status-item' data-target='#modal' data-toggle='modal'>";
    echo "<img src='img/avatar/".$linha['Avatar']."' width=100 height=90 style='border-radius:50%'><br>
    <span><strong>Novo Status</strong> </span><br><br>
    ";
   echo "</div>";

    }
}

//======================fetching Mystatus==================
$mys=new Manager();
$mys->setCelular($_SESSION['Numero']);
foreach($mys->fetchMyStatus() as $linha){

    if($linha['Letra']=="delete"){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";' data-id='".$linha['Id']."' class='s0'><div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>Meus Status <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$mys->fetchMyStatusNoLimit()->rowCount()}</small></div>";
        echo "<div style='margin:10% auto'><del>".substr($linha['Texto'],0,8)."</del></div>";
       echo "</div>";


    }else if($linha['Letra']=='underline'){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' class='s0'><div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>Meus Status <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$mys->fetchMyStatusNoLimit()->rowCount()}</small></div>";
        echo "<div style='margin:10% auto'><u>".substr($linha['Texto'],0,15)."</u></div>";
       echo "</div>";

    }else if($linha['Letra']=='bold'){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' class='s0'><div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>Meus Status <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$mys->fetchMyStatusNoLimit()->rowCount()}</small></div>";
        echo "<div style='margin:10% auto'><strong>".substr($linha['Texto'],0,15)."</strong></div>";
       echo "</div>";

    }else if($linha['Letra']=='italico'){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' class='s0'><div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>Meus Status <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$mys->fetchMyStatusNoLimit()->rowCount()}</small></div>";
        echo "<div style='margin:10% auto'><i>".substr($linha['Texto'],0,15)."</i></div>";
       echo "</div>";
    }else if($linha['Letra']=='normal'){
        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' class='s0'><div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>Meus Status <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$mys->fetchMyStatusNoLimit()->rowCount()}</small></div>";
        echo "<div style='margin:10% auto'>".substr($linha['Texto'],0,15)."</div>";
       echo "</div>";
    }else if($linha['Imagem']!=''){


         //============checking video or img===========
         if( substr($linha['Imagem'],strlen($linha['Imagem'])-4,strlen($linha['Imagem']))=='.mp4' || substr($linha['Imagem'],strlen($linha['Imagem'])-4,strlen($linha['Imagem']))=='.m4a'){

            //=====================if video=================
            echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;background-size:cover;background-image:url(svgs/solid/video.svg);background-repeat:no-repeat' data-id='".$linha['Id']."' class='s0'><div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>Meus Status <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$mys->fetchMyStatusNoLimit()->rowCount()}</small></div>";
       echo "</div>";
        }else{

            //==============if image======================================
            echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;background-size:cover;background-image:url(img/status/".$linha['Imagem'].")' data-id='".$linha['Id']."' class='s0'><div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>Meus Status <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$mys->fetchMyStatusNoLimit()->rowCount()}</small></div>";
            echo "</div>";
        }
      
    }else if($linha['Letra']=='thugger'){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' class='s0'><div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>Meus Status <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$mys->fetchMyStatusNoLimit()->rowCount()}</small></div>";
        echo "<div style='margin:10% auto;font-family:thugger'>".substr($linha['Texto'],0,15)."</div>";
       echo "</div>";

    }else if($linha['Letra']=='thugger1'){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' class='s0'><div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>Meus Status <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$mys->fetchMyStatusNoLimit()->rowCount()}</small></div>";
        echo "<div style='margin:10% auto;font-family:thugger1'>".substr($linha['Texto'],0,15)."</div>";
       echo "</div>";

    }


}





//=========================================


//======================fetching status==================
$st=new Manager();
$st1=new Manager();
$st1->setCelular($_SESSION['Numero']);
$st->setCelular($_SESSION['Numero']);
$i=0;
$st2=new Manager();
$id=0;
foreach($st->fetchOneStatus() as $thug){
$st1->setCelular($thug['Numero']);
foreach($st1->fetchStatus() as $linha){

    if($linha['Letra']=="delete"){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";

       $st2->setCelular($linha['Numero']);
      foreach($st2->fetchUser() as $linh){
        echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,10)." <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$st1->fetchStatusNoLimit()->rowCount()}</small></div>";
      }

        echo "<div style='margin:10% auto'><del>".substr($linha['Texto'],0,15)."</del></div>";
       echo "</div>";


    }else if($linha['Letra']=='underline'){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
        $st2->setCelular($linha['Numero']);
        foreach($st2->fetchUser() as $linh){
          echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,10)." <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$st1->fetchStatusNoLimit()->rowCount()}</small></div>";
        }
        echo "<div style='margin:10% auto'><u>".substr($linha['Texto'],0,15)."</u></div>";
       echo "</div>";

    }else if($linha['Letra']=='bold'){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
        $st2->setCelular($linha['Numero']);
        foreach($st2->fetchUser() as $linh){
          echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,10)." <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$st1->fetchStatusNoLimit()->rowCount()}</small></div>";
        }
        echo "<div style='margin:10% auto'><strong>".substr($linha['Texto'],0,15)."</strong></div>";
       echo "</div>";

    }else if($linha['Letra']=='italico'){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
        $st2->setCelular($linha['Numero']);
        foreach($st2->fetchUser() as $linh){
          echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,10)." <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$st1->fetchStatusNoLimit()->rowCount()}</small></div>";
        }
        echo "<div style='margin:10% auto'><i>".substr($linha['Texto'],0,15)."</i></div>";
       echo "</div>";
    }else if($linha['Letra']=='normal'){
        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
        $st2->setCelular($linha['Numero']);
        foreach($st2->fetchUser() as $linh){
          echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,10)." <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$st1->fetchStatusNoLimit()->rowCount()}</small></div>";
        }
        echo "<div style='margin:10% auto'>".substr($linha['Texto'],0,15)."</div>";
       echo "</div>";
    }else if($linha['Imagem']!=''){

       //============checking video or img===========
       if( substr($linha['Imagem'],strlen($linha['Imagem'])-4,strlen($linha['Imagem']))=='.mp4' || substr($linha['Imagem'],strlen($linha['Imagem'])-4,strlen($linha['Imagem']))=='.m4a'){

        //=======================if video=====================

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;background-image:url(svgs/solid/video.svg);background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
        $st2->setCelular($linha['Numero']);
        foreach($st2->fetchUser() as $linh){
          echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,10)." <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$st1->fetchStatusNoLimit()->rowCount()}</small></div>";
        }
        echo "<div style='margin:10% auto'></div>";
       echo "</div>";

       }else{
//===============if image=======================================
echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;background-image:url(img/status/".$linha['Imagem'].");background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
$st2->setCelular($linha['Numero']);
foreach($st2->fetchUser() as $linh){
  echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,10)." <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$st1->fetchStatusNoLimit()->rowCount()}</small></div>";
}
echo "<div style='margin:10% auto'></div>";
echo "</div>";

       }


       
    }else if($linha['Letra']=='thugger'){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
        $st2->setCelular($linha['Numero']);
        foreach($st2->fetchUser() as $linh){
          echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,10)." <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$st1->fetchStatusNoLimit()->rowCount()}</small></div>";
        }
        echo "<div style='margin:10% auto;font-family:thugger'>".substr($linha['Texto'],0,15)."</div>";
       echo "</div>";

    }else if($linha['Letra']=='thugger1'){

        echo "<div id='status-item' data-target='#modal1' data-toggle='modal' style='font-size:25px;color:".$linha['Cor'].";background:".$linha['Cor1'].";background-size:cover;' data-id='".$linha['Id']."' id='s".$i."' onclick='seeStatus1(".$linha['Id'].")'>";
        $st2->setCelular($linha['Numero']);
        foreach($st2->fetchUser() as $linh){
          echo "<div style='font-size:12px;color:black;font-weight:bolder;background:white;padding:5px;border:1px solid black;border-bottom:0px'>".substr($linh['Nome'],0,10)." <small class='btn-danger' style='padding:1px;border-radius:4px;font-size:15px;text-align:center'>{$st1->fetchStatusNoLimit()->rowCount()}</small></div>";
        }
        echo "<div style='margin:10% auto;font-family:thugger1'>".substr($linha['Texto'],0,15)."</div>";
       echo "</div>";

    }


$id=$linha['Id'];
}

$i++;
}


echo "<div id='status-item' class='next2'>
<div class='btn btn-light' style='border-radius:50%;padding:5px;font-size:60px;color:black;width:80%;height:80%;' id='next2' data-last='".$id."'><span style='margin:auto;text-align:center;'>&rarr;</span></div>

</div>";

echo "</div>";


//=========================================




echo "</aside>";



//==================================seeMyStatus==========================




echo "<div id='dvb' style='display:none'>";

echo "<div id='st'>";

echo "<button class='close' id='closar' style='outline:none'>&times;</button>";
$fetch=new Manager();
$valor=1;
$fetch->setCelular($_SESSION['Numero']);
foreach($fetch->fetchMyStatus() as $linha){
    $view=new Manager();
    $view->setId($linha['Id']);

    echo "<div class='btn btn-light text-dark' style='border-radius:0px' data-id='".$linha['Id']."' id='views' onclick='statusView(".$linha['Id'].")'>Views </div> ";
    echo "<button  id='prev' class='btn btn-outline-dark text-light ' data-id='".$linha['Id']."' >
  prev
    </button>";
    
    echo "<button id='next' class='btn btn-outline-dark text-light'  data-id='".$linha['Id']."'>
    next
    </button>";
    echo " <div class='btn btn-danger text-light' style='border-radius:0px' data-id='".$linha['Id']."' id='del'>delete</div> <br><br>";

  
    foreach($fetch->fetchMyStatusNoLimit() as $statusNoLimit){
        echo "<div style='height:10px;background:rgba(255,255,255,.5);border-radius:10px;width:".(100/$fetch->fetchMyStatusNoLimit()->rowCount())."%;display:inline-block;border:1px solid black' id='stopStatus'>";

        if($linha['Id']==$statusNoLimit['Id']){
            echo "<div style='width:100%;background:#fff;height:100%' id='valor".$valor."' data-id='".$statusNoLimit['Id']."' ></div>";
        }else{
            echo "<div style='width:0%;background:#fff;height:100%' id='valor".$valor."' data-id='".$statusNoLimit['Id']."' ></div>";
        }
        

        echo "</div>";
        $valor++;
    }


    echo "<style>
    #dvb{";

        if($linha['Imagem']=='' ){
            echo "background:".$linha['Cor1'].";";
        }else{
            echo "background:#343a40;
            overflow:auto;
            height:100%;";
            
           
        }
       
        
        echo "width:100%;
        height:100%;
        position:fixed;
        top:0%;
        left:0%;
        word-wrap:break-word;
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
    $day=["Dom","Seg","Ter","Qua","Qui","Sex","Sab"];
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
        echo "<div style='font-size:40px;text-align:center;width:100%;height:100%' data-id='".$linha['Id']."' class='s0'>";
        echo "<center style='text-shadow:1px 1px 1px black;color:white;font-size:15px'><small>".$day[$time['tm_wday']].",".$time['tm_hour'].":".$time['tm_min']."</small></center>";
        echo "<div style='margin: auto;' >";

         
        echo "<div id='videotime' ></div><video src='img/status/".$linha['Imagem']."' class='img-fluid' id='statusVideo' ><br>";
        echo "</div><input type='hidden' value='".$linha['Id']."' id='hora'>";
       echo "</div>";
    }else{

        //===========if image==================================
        echo "<div style='font-size:40px;text-align:center;width:100%;height:100%' data-id='".$linha['Id']."' class='s0'>";
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

echo "</div>";

echo "</div>";


//================end===========================

echo "<div id='someStatus'></div>";
echo "<div id='someStatus1'></div>";
echo "<div id='statusResponse'></div>";


//============================post form==============================

echo "<div style='width:95%;margin:auto' data-target='#post' data-toggle='modal'>";
echo "<table class='table table-bordered'><tr>";

echo "<td class='bg-primary'><label for='txt'><img src='svgs/solid/camera-retro.svg' style='width:30px;margin:0px;padding:0px' >
</label></td><td style='width:95%'><input type='text' class='form-control' readonly style='background:white' placeholder='Publicar' id='txt'></td>";

echo "</tr></table>";
echo "</div>";

//==================end=======================================


//=========================fetching posts======================

$id1=0;
$post=new Manager();
echo "<div class='container' id='fp'>";
foreach($post->fetchPost() as $linha){

    $post->setCelular($linha['Numero']);
$time=localtime($linha['Hora'],true);
$day=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
$mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
    foreach($post->fetchUser() as $linh){
        echo "<div class='card' >";

        echo "<div class='card-header bg-primary'><div>";
          
       if($linh['Avatar']!=''){
         
        //=====================sessionNist------------------------------
        if($linh['Numero']==$_SESSION['Numero']){

            echo "<a href='account.php' style='text-decoration:none;color:black'><img src='img/avatar/".$linh['Avatar']."' style='width:30px;height:30px;border-radius:50%'><strong> ".substr($linh['Nome'],0,15)."</strong></a>";
            
        }else{
//==============================non========================
            echo "<a href='account.php?id=".base64_encode($linh['id_user'])."' style='text-decoration:none;color:black'><img src='img/avatar/".$linh['Avatar']."' style='width:30px;height:30px;border-radius:50%'><strong> ".substr($linh['Nome'],0,15)."</strong></a>";

        }
       

       }else if($linh['Avatar']=='' && $linh['Sexo']=='Masculino'){
    if($linh['Numero']==$_SESSION['Numero']){
        //=============sessionNist======================

        echo "<a href='account.php' style='text-decoration:none;color:black'><img src='files/male.png' style='width:30px;height:30px;'><strong> ".substr($linh['Nome'],0,15)."</strong></a>"; 
    }else{
        //=================non========================
        echo "<a href='account.php?id=".base64_encode($linh['id_user'])."' style='text-decoration:none;color:black'><img src='files/male.png' style='width:30px;height:30px;'><strong> ".substr($linh['Nome'],0,15)."</strong></a>"; 
    }

       

       }else{

        if($linh['Numero']==$_SESSION['Numero']){
            echo "<a href='account.php?id=".base64_encode($linh['id_user'])."' style='text-decoration:none;color:black'><img src='files/female.png' style='width:30px;height:30px;'><strong> ".substr($linh['Nome'],0,15)."</strong></a>"; 
        }else{
            echo "<a href='account.php' style='text-decoration:none;color:black'><img src='files/female.png' style='width:30px;height:30px;'><strong> ".substr($linh['Nome'],0,15)."</strong></a>"; 
        }

      

       }
      
        
        echo "<small style='float:right'> ".$mes[$time['tm_mon']]." ".$time['tm_mday'].",".$time['tm_hour'].":".$time['tm_min']."</small></div>";
        echo "</div>";
        echo "<div class='card-body'>";
        if($linha['Ficheiro']=='' && $linha['Mensagem']!=''){
            echo "<span>".$linha['Mensagem']."</span>";
        }else if($linha['Ficheiro']!='' && $linha['Mensagem']==''){
            echo "<center><img src='img/img/".$linha['Ficheiro']."' class='img-fluid'></center>";
        }else{
            echo "<center><span>".$linha['Mensagem']."</span></center><br>";
            echo "<center><img src='img/img/".$linha['Ficheiro']."' class='img-fluid'></center>";
        }

            

$likes=new Manager();
$likes->setId($linha['id_posts']);
$likes->setCelular($_SESSION['Numero']);

        echo "</div>";
        echo "<div class='card-footer bg-light'>";
     if($likes->fetchMyLikes()->rowCount()!=0){
        
        echo " <div class='btn btn-primary' data-like='".$linha['id_posts']."'  onclick='like(".$linha['id_posts'].")'>";
        echo "<img src='files/not.png' width=20 height=20><span class='like".$linha['id_posts']."'> {$likes->fetchLikes()->rowCount()}</span>
         </div>";
     }else{

        echo " <div class='btn btn-outline-primary' data-like='".$linha['id_posts']."'  onclick='like(".$linha['id_posts'].")'>";
        echo "<img src='files/not.png' width=20 height=20><span class='like".$linha['id_posts']."'> {$likes->fetchLikes()->rowCount()}</span>
         </div>";
     }
       
$com=new Manager();
$com->setId($linha['id_posts']);

           echo " <div class='btn btn-outline-primary' data-comment='".$linha['id_posts']."'  onclick='comment(".$linha['id_posts'].")' data-toggle='modal' data-target='#comments'>
           <img src='files/comments.png' width=20 height=20> <span class='com".$linha['id_posts']."'> {$com->fetchCom()->rowCount()}</span>
           </div>";

           if($linh['Numero']==$_SESSION['Numero']){
            echo "<div class='btn btn-outline-danger mr-3' style='float:right;' onclick='deletePost(".$linha['id_posts'].")'>delete</div>";
           }
          
        echo "</div>";
        echo "</div><br>";
    }
$id=$linha['id_posts'];
}

echo "<center><div data-id='".$id."' id='moreP' class='btn btn-outline-dark my-2 mb-2'>Mais</div>";
echo "</div></center>";

//=============================end============================

?>

<!---status modal---------->

<div class='modal fade' role='dialog' id='modal'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>
<div class='modal-body bg-light'>
<form method='post' enctype='multipart/form-data'>
<textarea class='form-control' rows=5 style='overflow:auto;resize:none;font-size:25px;background:#cc2' name='textarea' id='textarea' maxLength=120 autofocus placeholder='Digite os seus status' ></textarea>
<div id='ft1'></div><br>
<input type='button' name='btnSub' class='btn btn-primary ' id='statusBtn' value='enviar' onclick='status()'>

</div>
<div class='modal-footer bg-primary'>
<span id='tipo' style='font-size:40px;margin:5px;cursor:pointer'>T</span>
<span id='color'><img src='svgs/solid/paint-brush.svg' width=30 height=30 style='margin:5px;cursor:pointer'></span>
<span id='background'><img src='svgs/solid/paint-roller.svg' width=30 height=30 style='margin:5px;cursor:pointer'></span>

<span id='foto'>
<input type='hidden' name='hidden' value='31943040'>
<input type='file' name='file' style='position:relative;width:30px;left:50%;top:100%;opacity:0' id='ficheiro1'>
<img src='svgs/solid/camera.svg' width=30 height=30 style=';cursor:pointer'></span>
</form>
</div>
</div>
</div>

</div>

<!----end---------------->

<!---posts modal---------->

<div class='modal fade' role='dialog' id='post'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>
<div class='modal-body bg-light'>

<form method='post' enctype='multipart/form-data'>
<textarea class='form-control' rows=5 style='overflow:auto;resize:none;font-size:25px'  id='post' placeholder='Novo post' maxLength=15000 name='post' autofocus></textarea>
<div id='ft1'></div><span id='fA'></span><br>
<input type='submit' name='btnPost' class='btn btn-primary ' value='enviar' '>

</div>
<div class='modal-footer bg-primary'>
<span id='foto'>
<input type='file' name='file' style='position:relative;width:30px;left:50%;top:100%;opacity:0' id='ficheiro' class='file1'>
<img src='svgs/solid/camera.svg' width=30 height=30 style=';cursor:pointer'></span>
</form>
</div>
</div>
</div>

</div>

<!-------end---------------->





<script>
//=========================letra status======================
var x=0;
var b=0;
var c=0;

var width=0;
var valor=1;
var valo=1;
var widt=0;
$('#tipo').click(function(){
    x++;
if(x==1){
$(this).html('<i>T</i>')
$('#textarea').css('font-style','')
$('#textarea').css('text-decoration','')
$('#textarea').css('text-decoration','')
$('#textarea').css('font-weight','')
$('#textarea').css('font-style','italic')
$('#textarea').css('font-family','')
}else if(x==2){
 $(this).html('<u>T</u>')
 $('#textarea').css('font-style','')
$('#textarea').css('text-decoration','')
$('#textarea').css('text-decoration','')
$('#textarea').css('font-weight','')
 $('#textarea').css('text-decoration','underline')
 $('#textarea').css('font-family','')
}else if(x==3){
$(this).html('<del>T</del>')
$('#textarea').css('font-style','')
$('#textarea').css('text-decoration','')
$('#textarea').css('text-decoration','')
$('#textarea').css('font-weight','')
$('#textarea').css('text-decoration','line-through')
$('#textarea').css('font-family','')
}else if(x==4){
$(this).html('<strong>T</strong>')
$('#textarea').css('font-style','')
$('#textarea').css('text-decoration','')
$('#textarea').css('text-decoration','')
$('#textarea').css('font-weight','')
$('#textarea').css('font-weight','bolder')
$('#textarea').css('font-family','')
}else if(x==5){
    $(this).html('T')
    $('#textarea').css('font-style','')
$('#textarea').css('text-decoration','')
$('#textarea').css('text-decoration','')
$('#textarea').css('font-weight','')
$('#textarea').css('font-weight','')
$('#textarea').css('font-family','')
  
}else if(x==6){
    $(this).html('<span style="font-family:thugger">T</span>')
    $('#textarea').css('font-style','')
$('#textarea').css('text-decoration','')
$('#textarea').css('text-decoration','')
$('#textarea').css('font-weight','')
$('#textarea').css('font-weight','')
$('#textarea').css('font-family','thugger')

}else if(x==7){

    $(this).html('<span style="font-family:thugger1">T</span>')
    $('#textarea').css('font-style','')
$('#textarea').css('text-decoration','')
$('#textarea').css('text-decoration','')
$('#textarea').css('font-weight','')
$('#textarea').css('font-weight','')
$('#textarea').css('font-family','thugger1')


}else{
    x=0
}



})
//==========================end====================================


//==========================status color==============================


$('#color').click(function(){
    c++;
    if(c==1){
$('#textarea').css('color','')
$('#textarea').css('color','#fcc')
}else if(c==2){
    $('#textarea').css('color','')
    $('#textarea').css('color','#0f0')
}else if(c==3){
    $('#textarea').css('color','')
    $('#textarea').css('color','blue')
}else if(c==4){
    $('#textarea').css('color','')
    $('#textarea').css('color','pink')
}else if(c==5){
    $('#textarea').css('color','')
    $('#textarea').css('color','#ccc')
}else if(c==6){
    $('#textarea').css('color','')
    $('#textarea').css('color','#efe')
}else if(c==7){
    $('#textarea').css('color','')
    $('#textarea').css('color','cyan')
}else if(c==8){
    $('#textarea').css('color','')
    $('#textarea').css('color','black')
}else if(c==9){

    $('#textarea').css('color','')
    $('#textarea').css('color','white')

}else if(c==10){
    $('#textarea').css('color','')
    $('#textarea').css('color','orangered')
}else if(c==11){
    $('#textarea').css('color','')
    $('#textarea').css('color','green')
}else if(c==12){
    $('#textarea').css('color','')
    $('#textarea').css('color','brown')
}else if(c==13){
    $('#textarea').css('color','')
    $('#textarea').css('color','gray')
}else{
    c=0
}





})

//======================end========================



//==========================status background==============================


$('#background').click(function(){
    b++;
    if(b==1){
    $('#textarea').css('background','')
$('#textarea').css('background','red')
}else if(b==2){
    $('#textarea').css('background','')
    $('#textarea').css('background','-webkit-linear-gradient(top,#007bff,#0f0)')
}else if(b==3){
    $('#textarea').css('background','')
    $('#textarea').css('background','#007bff')
}else if(b==4){
    $('#textarea').css('background','')
    $('#textarea').css('background','#e83e8c')
}else if(b==5){
    $('#textarea').css('background','')
    $('#textarea').css('background','yellow')
}else if(b==6){
    $('#textarea').css('background','')
    $('#textarea').css('background','purple')
}else if(b==7){
    $('#textarea').css('background','')
    $('#textarea').css('background','-webkit-linear-gradient(top,#343a40,#6c757d)')
}else if(b==8){
    $('#textarea').css('background','')
    $('#textarea').css('background','#343a40')
}else if(b==9){
    $('#textarea').css('background','')
    $('#textarea').css('background','#cc1')
    
}else if(b==10){
    $('#textarea').css('background','')
    $('#textarea').css('background','#ffc107')


}else if(b==11){
    $('#textarea').css('background','')
    $('#textarea').css('background','-webkit-linear-gradient(top,red,yellow)')
  
}else if(b==12){
    $('#textarea').css('background','')
    $('#textarea').css('background','-webkit-linear-gradient(bottom,yellow,#0f0)')
}else if(b==13){
    $('#textarea').css('background','')
    $('#textarea').css('background','-webkit-radial-gradient(center,circle,#17a2b8,purple 100%)')
}else if(b==14){
    $('#textarea').css('background','')
    $('#textarea').css('background','-webkit-linear-gradient(top,red,purple)')

}else if(b==15){
    $('#textarea').css('background','')
    $('#textarea').css('background','-webkit-linear-gradient(top,#e83e8c,orange)')

}else{
    b=0
}





})

//======================end========================


//============================ficheiro================

$(':file').change(function(){

var file=this.files[0].name;


$('#textarea').hide(100);

if(file.substring(file.length-4,file.length)=='.m4a' || file.substring(file.length-4,file.length)=='.mp4'){
    $('#ft1').html("<small>Seram adicionados apenas os primeiros 30 segundos</small><br><img src='svgs/solid/video.svg' width=200 heigh=200><br> "+file).show(100)
}else{
    $('#ft1').html("<img src='svgs/solid/image.svg' width=200 heigh=200><br> "+file).show(100)
}

$('#statusBtn').removeAttr('type');
$('#statusBtn').removeAttr('onclick');
$('#statusBtn').attr('type','submit')



})



//=====================end========================



//===============enviar status====================

function status(){

var txta=document.getElementById('textarea')

if(txta.value.trim()!=""){

$.ajax({
url:'sendStatus.php',
type:'post',
data:{msg:txta.value,tipo:x,cor:c,background:b},
success:function(data){
  if(data==0){
      alert("Status enviado");
      open('avancar1.php','_self');
  }
}



})




}else{
    alert('Minimo numero de caractere: 1\n Maximo numero de caracteres: 120')
}




}

//==================end========================


//=================see my status========================


$(document).on('click','.s0',function(){
    var vid1=document.getElementById("statusVideo")

if(vid1!=null){
    vid1.play();

}


var id=$(this).data('id');

$.ajax({
    url:'avancar1.php',
    type:'post',
    data:{id:id},
    success:function(data){
        $('#dvb1').hide()
        $('#fp').hide(100)
        $('#dvb').show(100)
      
     
        
    }
})

})
//=close status
$(document).on('click','#closar',function(){
    var vid1=document.getElementById("statusVideo")


if(vid1!=null){
    vid1.pause();
}
    $('#dvb').fadeToggle();
    $('#fp').show()
})



//=close views
$(document).on('click','#closar11',function(){
    $('#vi').slideUp();
   
})


//===================================================


//==========================next Status===========================

$(document).on('click','#next',function(){
  
var id=$(this).data('id')


$.ajax({
    url:'nextStatus.php',
    type:'post',
    data:{id:id},
    success:function(data){

            $('#dvb').html(data)
        
    
     
        
    }
})

})



//==========================end===========================


//==========================prev Status===========================

$(document).on('click','#prev',function(){

var id=$(this).data('id')

$.ajax({
    url:'nextStatus.php',
    type:'post',
    data:{id1:id},
    success:function(data){
      
            $('#dvb').html(data)
        
    
     
        
    }
})

})



//==========================end===========================



//=========================see otherPeople Status========================




function seeStatus1(p){

    $.ajax({
    url:'status.php',
    type:'post',
    data:{idS:p},
    success:function(data){
         
       $('#someStatus').html(data)
       $('#dvb').hide()
        $('#fp').hide(100)
       $('#dvb1').show(100)

    
     
        
    }
})


}


//===========end===================================



//====================someone next status====================

$(document).on('click','#next1',function(){
valo++;
widt=0;
var id=$(this).data('id')
$('#dvbThug').hide();
$.ajax({
    url:'nextStatus.php',
    type:'post',
    data:{id2:id},
    success:function(data){

      
            $('#dvb1').show(100)
            $('#dvb1').html(data)
      
        
    
     
        
    }
})

})



//==========================end===========================

//===============================sendComents====

function comentar(p){
  
  var texto=$('#msgCom').val();
  
  if(texto.trim()!=''){
  
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




//=====end===
//========================== someone prev Status===========================

$(document).on('click','#prev1',function(){
valo--;
widt=0;
var id=$(this).data('id')
$('#dvbThug').hide();

$.ajax({
    url:'nextStatus.php',
    type:'post',
    data:{id3:id},
    success:function(data){
     
            $('#dvb1').show(100)
            $('#dvb1').html(data)
            $('#dvb').hide()
        
    
     
        
    }
})

})



//==========================end===========================

//===================delete status===================

$('#del').click(function(){
    var id=$(this).data('id')
var c=confirm("Quer mesmo remover este status?");

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


//====================comment========================

function comment(p){

$.ajax({
    url:'like.php',
    type:'post',
    data:{p1:p},
    success:function(data){
   
        $('#someStatus1').html(data)
        $('#dvb2').show(100)
        $('#fp').hide(100)
    }
})
}


//=====================endComment===================

//======================deletePosts======================


function deletePost(p){

$.ajax({
    url:'like.php',
    type:'post',
    data:{p2:p},
    success:function(data){
       open('avancar1.php','_self')
    }
})
}



//====================================================
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

//=========================================post show file name==============

$('.file1').change(function(){
    $('#fA').text(this.files[0].name)
})

//=====================================

//==============delete comments===========================

function delCom(p,y,x){
   
$.ajax({
    url:'like.php',
    type:'post',
    data:{del:p,pos:y,x:x},
    success:function(data){
        $('#body').html(data)
    }
})

}

//===========end=========================

//=====================loadStatus on scroll====================
$(document).on('click','#next2',function(){
    var s=$(this).data('last')

    $.ajax({
        url:'load.php',
        type:'post',
        data:{scroll:s},
        success:function(data){
            $('.next2').remove()
            $('#status').append(data)
        }
    })
})


//=================end========================================

//=====================loadPosts ====================
$(document).on('click','#moreP',function(){
    var s=$(this).data('id')
    $(this).html("<center><img src='files/load1.gif' width=30 height=30> Processando</center>")
    $.ajax({
        url:'load.php',
        type:'post',
        data:{post:s},
        success:function(data){
            $('#moreP').remove()
            $('#fp').append(data)
            $('#moreP').text('Mais')
        }
    })
})


//=================end========================================


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

//==============================================responder status=============
$(document).on('click','#resp',function(){
    var statusid=$(this).data('status')
    var userid=$(this).data('id')

    $.ajax({
        url:'responderStatus.php',
        type:'post',
        data:{statusid:statusid,userid:userid},
        success:function(data){
        $('#statusResponse').html(data)
        }
    })
})



//=========================end================================

//===============responder Status==============

function ResponderStatus(idStatus,userId){

    if($('#txtstatus').val().trim()!=''){
$.ajax({
    url:'responderStatus.php',
    type:'post',
    data:{status:idStatus,user:userId,msg:$('#txtstatus').val()},
    success:function(data){
        $('#txtstatus').val("")
        alert('Mensagem enviada')
        $('#dvbThug').hide();
    }
})
    }else{
        alert("Escreva algo")
    }
}


//==========================endl====================

//==================================setting video status time===========


    var vid1=document.getElementById("statusVideo")


if(vid1!=null){
    vid1.addEventListener('timeupdate',videoOfStatus);
}

var tempo=document.getElementById('videotime');

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

<?php

//==============================views append=========
echo "<div id='views2'></div";


//============end====================
//================insert posts=================

if(isset($_REQUEST['btnPost'])){

$txt=$_REQUEST['post'];
$file=$_FILES['file'];

if(trim($txt)!='' || $file['name']!=''){

    if($file['type']!='image/jpg' && $file['type']!='image/jpeg' && $file['type']!='image/png' && $file['type']!='image/gif' && $file['type']!=''){
        echo "<script>alert('Ficheiro Invalido')</script>";
        exit;
    }
$m=new Manager();
$m->setCelular($_SESSION['Numero']);
$m->setTexto(filter_var($txt,FILTER_SANITIZE_SPECIAL_CHARS));

$id=0;
foreach($m->fetchUser() as $linha){
$id=$linha['id_user'];
}



if($file['name']!=''){
$rand=rand(0,999);
    if(file_exists('img/img/'.$file['name'])){
        $m->setProfile($rand.".".$file['name']);
        move_uploaded_file($file['tmp_name'],'img/img/'.$rand.".".$file['name']);
    }else{
        move_uploaded_file($file['tmp_name'],'img/img/'.$file['name']);
        $m->setProfile($file['name']);
    }

}

$m->setId($id);


$m->insertPost();
//===================insert notification================
$m1=new Manager();
$id1=0;
foreach($m->fetcOnlyPost1() as $linha){
$id1=$linha['id_posts'];
}

$m1->setId($id1);
$m1->insertNotification();
//================================================

//=======================insert unread notifications============

$n=new Manager();

$m2=new Manager();
$n->setCelular($_SESSION['Numero']);
//=================check user to donot insert his notifications
$not=0;
foreach($n->fetchUser() as $linha){
$not=$linha['id_user'];
}
//===============end================
$n->setId($not);
foreach($n->fetchAllUsers() as $linha){

    $m2->setCelular($linha['id_user']);
    $m2->setId($id1);
$m2->insertNotificationView();
}




//==============================================


    
}

header('location:avancar1.php');
}




//========================insert Foto=====================


if(isset($_REQUEST['btnSub'])){
    $file=$_FILES['file'];
    $hidden=$_REQUEST['hidden'];

    if($file['type']=='image/jpg' || $file['type']=='image/jpeg' || $file['type']=='image/png' || $file['type']=='image/gif' || $file['type']=='video/m4a' || $file['type']=='video/mp4'){

   $status1=new Manager();
   $status1->setCelular($_SESSION['Numero']);

   
   $id=0;
    foreach($status1->fetchUser() as $linha){
  $id=$linha['id_user'];
   }
   $status1->setId($id);

$rand=rand(0,999);
if(file_exists('img/status/'.$file['name'])){
       move_uploaded_file($file['tmp_name'],'img/status/'.$rand.".".$file['name']);
       $status1->setProfile($rand.".".$file['name']);
}else{

    try{
    move_uploaded_file($file['tmp_name'],'img/status/'.$file['name']);
    }catch(Exception $e){
        echo "<script>alert('Ficheiro Invalido')</script>";
    }

    $status1->setProfile($file['name']);
}
$status1->sendStatusFoto();

   header('location:avancar1.php');
}else{
    echo "<script>alert('Ficheiro Invalido')</script>";
}

}

ob_end_flush();
?>
