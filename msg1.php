<?php  session_start();

include 'classes/Manager.class.php';

if(isset($_REQUEST['x'])){

$m=new Manager();
$m->setId(base64_decode($_REQUEST['x']));

$friend="";
foreach($m->fetchUserViaId() as $linha){
$friend=$linha['Nome'];
}

$m11=new Manager();

$m11->setCelular(base64_decode($_REQUEST['x']));

$m12=new Manager();
$m12->setCelular($_SESSION['Numero']);
$id=0;

foreach($m12->fetchUser() as $l){
    $id=$l['id_user'];
}

$m11->setId($id);
$msg=0;
foreach($m11->fetchMessage() as $linha){

$msg=$linha['id'];


    if($linha['Numero']==$id){


if($linha['Ficheiro']!=''){

    $fich="";
    if($linha['Ficheiro']=='liked'){
        $fich="<img src='files/liked.png' width=70 height=70>";
    }else{
        $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
    }

    echo "<div id='p1' ><div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".base64_decode($_REQUEST['x']).")'>".$fich."</div></div>";

}else{
    
    $string="";
if($linha['Demo_Type']==1){
$string=$linha['Demo_Msg'];
}else{
    if(file_exists("img/status/".$linha['Demo_Msg'])){
        if(substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".mp4" || substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".m4a"){
            $string='<img src="svgs/solid/video.svg" width=40 height=40>';
        }else{
            $string='<img src="img/status/'.$linha['Demo_Msg'].'" width=40 height=40>';
        }
     
    }else{
        $string='<img src="files/deletar.png" width=40 height=40>';
    }
}



    echo "<div id='p1' >";
 

    echo "<div class='bg-primary text-light d-inline-flex'  style='padding:8px;word-break:break-word;margin-bottom:5px;border-radius:8px;' onclick='info(".$linha['id'].",".base64_decode($_REQUEST['x']).")'>";
         //==================fetching demo msg================

         if($linha['Demo_Msg']!=''){
            echo "<div  class='text-dark' style='border-radius:13px;padding:5px;background:rgb(240,240,240);margin-right:5px' >".$string."<br><small class='text-dark'><strong>".$friend." >> </strong><span class='text-primary'>Status</span></strong></small></div><br> ";
            }
        //=============end===============================

    echo " ".$linha['Mensagem']."</div></div>";
}

      

    }else{

        if($linha['Ficheiro']!=''){
            $fich="";
            if($linha['Ficheiro']=='liked'){
                $fich="<img src='files/liked.png' width=70 height=70>";
            }else{
                $fich="<img src='img/sent/".$linha['Ficheiro']."' width=230 height=230>";
            }
    

        echo "<div  id='p2'><div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].")'>".$fich."</div></div>";
    }else{

        $string="";
        if($linha['Demo_Type']==1){
        $string=$linha['Demo_Msg'];
        }else{
            if(file_exists("img/status/".$linha['Demo_Msg'])){
                if(substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".mp4" || substr($linha['Demo_Msg'],strlen($linha['Demo_Msg'])-4,strlen($linha['Demo_Msg']))==".m4a"){
                    $string='<img src="svgs/solid/video.svg" width=40 height=40>';
                }else{
                    $string='<img src="img/status/'.$linha['Demo_Msg'].'" width=40 height=40>';
                }
             
            }else{
                $string='<img src="files/deletar.png" width=40 height=40>';
            }
        }
        
        
        echo "<div  id='p2'>";
        
        echo "<div class='text-dark d-inline-flex ml-auto'  style='padding:5px;word-break:break-word;margin-bottom:8px;border-radius:8px;background:rgb(240,240,240)' onclick='info1(".$linha['id'].")'>";
        
          //==================fetching demo msg================

      if($linha['Demo_Msg']!=''){
        echo "<div class='bg-primary ' style='border-radius:13px;padding:5px;margin-right:5px' >".$string."<br><small class='text-light'><b>Meus</b> >> <span class='text-light'>Status</span></small></div><br> ";
        }
    //=============end===============================
        echo $linha['Mensagem']."</div></div>";

    }
    }

   
}

echo "<input type='hidden' data-id='".$msg."' id='pvt1' data-re='".base64_decode($_REQUEST['x'])."'>";

echo "</div>";

//================escrevendo=================

}else if(isset($_REQUEST['x1'])){

    
$m=new Manager();
$m->setId(base64_decode($_REQUEST['x1']));
$m->setNumero(base64_decode($_REQUEST['x1']));

$m12=new Manager();
$m12->setCelular($_SESSION['Numero']);
$id=0;

foreach($m12->fetchUser() as $l){
    $id=$l['id_user'];
}

$m->setCelular($id);
if($m->escrevendo()->rowCount()==0){
    $m->setTexto("");
    $m->setId($id);
    $m->sendMsg();
    $m->setId(base64_decode($_REQUEST['x1']));
    $m->setNumero($_SESSION['Numero']);
    $m->typing();
}



//============key up=========================
}else if(isset($_REQUEST['x2'])){

    $m=new Manager();
$m->setId(base64_decode($_REQUEST['x2']));
$m->setNumero(base64_decode($_REQUEST['x2']));

$m12=new Manager();
$m12->setCelular($_SESSION['Numero']);
$id=0;

foreach($m12->fetchUser() as $l){
    $id=$l['id_user'];
}

    $m->setCelular($id);

    $m->setTexto("");
    $m->deleteEscrevendo();

//============who's typing
}else if(isset($_REQUEST['x3'])){


    $m=new Manager();
    $m->setId(base64_decode($_REQUEST['x3']));
    
    foreach($m->fetchUserViaId() as $linha){
    $friend=$linha['Nome'];
    //==================================check the last time online==============
    
    $time=localtime($linha['Estado'],true);
    $tempo="";
    $week=['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
    $mes=['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
    
    if($linha['Estado']>=time() ){
    $tempo="Online";
    }else if($linha['Estado']<time() && $linha['Estado']>time()-60*60*24){
        $tempo="Online Hoje as ".$time['tm_hour'].":".$time['tm_min'];
    }else if($linha['Estado']<=time()-60*60*24 && $linha['Estado']>time()-60*60*24*2){
        $tempo="Online Ontem as ".$time['tm_hour'].":".$time['tm_min'];
    }else if($linha['Estado']<=time()-60*60*24*2 && $linha['Estado']>time()-60*60*24*7){
        $tempo="Online ".$week[$time['tm_wday']]." as ".$time['tm_hour'].":".$time['tm_min'];
    }else if($linha['Estado']<=time()-60*60*24*7 && $linha['Estado']>time()-60*60*24*14){
         $tempo="Online ha 1 sem";
    }else if($linha['Estado']<=time()-60*60*24*14 && $linha['Estado']>time()-60*60*24*28){
        $tempo="Online ha 2 sem";
    }else if($linha['Estado']<=time()-60*60*24*28 && $linha['Estado']>time()-60*60*56){
        $tempo="Online ha 1 mes";
    }else if($linha['Estado']<=time()-60*60*24*56 && $linha['Estado']>time()-60*60*24*365){
        $tempo="Online ha 2 meses";
    }else if($linha['Estado']<=time()-60*60*24*365 && $linha['Estado']>time()-60*60*24*366){
        $tempo="Online ha 1 ano";
    }else {
        $tempo="Online ".$time['tm_mday']." ".$mes[$time['tm_mon']]." ".date('Y',$linha['Estado'])." as ".$time['tm_hour'].":".$time['tm_min'];
    }
    
    
        }
    
     
    

    $m=new Manager();
$m->setId(base64_decode($_REQUEST['x3']));
$m->setNumero(base64_decode($_REQUEST['x3']));

$m12=new Manager();
$m12->setCelular($_SESSION['Numero']);
$id=0;

foreach($m12->fetchUser() as $l){
    $id=$l['id_user'];
}

$m->setCelular($id);

if($m->escrevendo()->rowCount()>0){

foreach($m->escrevendo() as $linha){
    if($linha['Demo_Msg']!=$_SESSION['Numero']){
        echo "<center style='font-weight:bolder'>escrevendo...</center>";
    }else{
        echo '<center>'.$tempo.'</center>'; 

}
}
}else{
    echo '<center>'.$tempo.'</center>'; 
}

//=============update online
}else if(isset($_REQUEST['online'])){
    $m=new Manager();
$m->setCelular($_SESSION['Numero']);
$m->updateOnline();

}
?>
