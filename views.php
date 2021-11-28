<?php session_start();
include 'classes/Manager.class.php';


if(!isset($_REQUEST['p2']) || !isset($_SESSION['Numero'])){
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
//=================views====================================

echo "<div id='vi' >";

echo "<div id='st'>";

echo "<button class='close' id='closar11' style='outline:none'>&times;</button>";
$fetch=new Manager();
$fetch->setCelular($_SESSION['Numero']);
foreach($fetch->fetchMyStatus() as $linha){
    $view=new Manager();
    $view->setId($linha['Id']);

    echo "<div class='btn btn-light text-dark' style='border-radius:0px' data-id='".$linha['Id']."' id='views' onclick='statusView(".$linha['Id'].")'>Views</div> ";
 
}
    echo "<style>
    #vi{";

     
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

    #vi::-webkit-scrollbar{
        width:10px;
        background:white
    }
    
    #vi::-webkit-scrollbar-thumb{
    background:gray;
    border-radius:15px;
    
    }

    @media screen and (max-width:991px){

        #vi{
           top:0%;
           left:0%;
           width:100%;
           height:100%
        }

      
    }
    </style>";

    $m=new Manager();
$m->setId($_REQUEST['p2']);

if($m->fetchViews()->rowCount()==0){

    echo "<div class='container'><div class='card my-2'><strong ><center>Nao ha visualiza&ccedil;oes aqui</center></strong></div></div>";  
}

echo "<div class='container'><div class='card my-2 bg-primary text-light'><strong ><center>Views ({$m->fetchViews()->rowCount()})</center></strong></div></div>"; 

foreach($m->fetchViews() as $linha){
    $m->setCelular($linha['Id_viewer']);
foreach($m->fetchUser() as $lin){
      
    echo "<a style='text-decoration:none;color:black' href='account.php?id=".base64_encode($lin['id_user'])."'><div class='container'><div class='card my-2'><strong >".$lin['Nome']."</strong></div></div></a>";

}

}

echo "</div>";

echo "</div>";


//================end===========================
