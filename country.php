<?php 

include 'classes/Manager.class.php';





if(isset($_REQUEST['pais'])){
$p=new Manager();

$p->setId($_REQUEST['pais']);

foreach($p->fetchState() as $pais){
    echo "<option value='".$pais['id']."'>".$pais['name']."</option>";
}
}else if(isset($_REQUEST['city'])){

    $p=new Manager();

$p->setId($_REQUEST['city']);

foreach($p->fetchCity() as $pais){
    echo "<option value='".$pais['id']."'>".$pais['name']."</option>";
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