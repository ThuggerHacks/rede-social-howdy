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
.more{
    background:rgba(0,0,200,0.2)
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



echo "<div id='aside' class='bg-light '>";
                echo "<a href='account.php' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'>Minha conta</div></a>";
      
                echo "<a href='users.php' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'>Utilizadores</div></a>";

           

                echo "<a href='midia.php' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'>Midia</div></a>";

                echo "<a href='group.php' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'>Grupos</div></a>";

                echo "<a href='games.php' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'>Games</div></a>";

                echo "<a href='config.php' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'>Configura&ccedil;oes</div></a>";
                if($_SESSION['Numero']=='848499142'){

                    echo "<a href='analytics.php' style='text-decoration:none;color:black' ><div class='card d-block' style='margin-bottom:2px;padding:10px'>Analytics</div></a>";
                }
                echo "<a href='help.php' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'>Ajuda</div></a>";

                echo "<a href='help.php?h=xhdTh' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'>Sobre</div></a>";

                echo "<a href='exit.php' style='text-decoration:none;color:black'><div class='card d-block' style='margin-bottom:2px;padding:10px'>Sair</div></a>";
echo "</div>";

//==========end===============================




?>

