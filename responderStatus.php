<?php session_start();

include 'classes/Manager.class.php';
if(isset($_REQUEST['statusid'])){

    //====================form to write message to respond status========

echo "<div id='dvbThug' >";
    
echo "<div id='st1'>";

echo "<button class='close' id='closar2' >&times;</button>";

    echo "<style>
    #dvbThug{";

        echo "width:70%;
        background: #007bff;
        position:fixed;
        top:70%;
        left:20%;
        word-wrap:break-word;
    }


    @media screen and (max-width:991px){

        #dvbThug{
           top:80%;
           left:0%;
           width:100%;
      
        }

      
    }
    </style>";

 echo "<table class='table'>
 <tr>
 <td style='width:90%'><textarea class='form-control' id='txtstatus' maxLength=250>
 </textarea></td>
 <td style='width:10%;'><input type='image' src='files/sent.png' width=70 height=60 class='btn btn-outline-light' onclick='ResponderStatus(".$_REQUEST['statusid'].",".$_REQUEST['userid'].")'></td>
 </tr>
 </table>
 ";

echo "</div>";
echo "</div>";
}else if(isset($_REQUEST['user'])){

    //================sending status response to the database=========
    
    $m=new Manager();
    $m->setNumero($_REQUEST['user']);

    $n=new Manager();
    $iduser=0;
    $n->setCelular($_SESSION['Numero']);

    foreach($n->fetchUser() as $linha){
        $iduser=$linha['id_user'];
    }
    

    $m->setCelular($iduser);
    $m->setTexto($_REQUEST['msg']);
    $m->setId($iduser);
   
    $string="";
    $tipo=0;
  $n->setId($_REQUEST['status']);
    
  foreach($n->fetchStatusViaId() as $lin){
      if($lin['Texto']!=''){
          $string=$lin['Texto'];
          $tipo=1;
      }else{
          $string=$lin['Imagem'];
          $tipo=2;
      }
  }

    $m->setProfile($string);
    $m->setTipo($tipo);
   $m->sendStatusResponse();

echo $_REQUEST['msg'];

}
?>

<script>

//=close views
$(document).on('click','#closar2',function(){
    $('#dvbThug').slideUp();
   
})

//=========================================



</script>