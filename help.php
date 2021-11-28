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
<!----page  styles--->
<style>

@font-face{
    font-family:"thugger";
    src:url(font/PaintDropsRegular-0WaJo.ttf)
}

#wait{
    width:40%;
    position:absolute;
    top:80%;
    left:30%;
    display:none;

}

#pais::-webkit-scrollbar{
    width:2px;
    background:cyan;
}

#alert{
    position:absolute;
    top:30%;
    left:30%;
    width:40%;
    background:pink;
    opacity:0.6;
    display:none;
    text-align:center;
    color:red;
    font-weight:bolder;
    font-size:30px;
    margin-top:20px

    
}
@font-face{
    font-family:"thugger";
    src:url(font/PaintDropsRegular-0WaJo.ttf)
}

#body{
    position:absolute;
    left:0px;
    top:0px;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.8);
}
#body h1{
    color:white;
    font-weight:bolder;
    margin:15px auto;
    text-align:center;
}

#login{
    margin:5% auto;
    width:35%;
    background:ghostwhite;
    padding:20px;
    border-radius:5px;
    box-shadow:1px 1px 2px black;

}


#signIn1{
    margin:5% auto;
    width:35%;
    background:ghostwhite;
    padding:10px;
    border-radius:5px;
    box-shadow:1px 1px 2px black  
}
#nbr1,#nbr2,#user,#pais,#cidade{
   
    width:80%;
    margin:5% auto;
    outline:none;
    padding:3px;
    border:none;
    background:ghostwhite;

}
#pass1,#pass2,#pass3,#email,#date,#distrito{
    width:80%;
    margin:auto;
    outline:none;
    padding:3px;
    border:none;
    background:ghostwhite;
}

#form{
    margin:auto;
    width:100%;
    text-align:center;
}
.progress{
    width:30%;
}
@media screen and (max-width:500px){
#login{
    width:90%;
     margin:15% auto;
}
.progress{
    width:90%;
}

#signIn1{
    width:90%;
     margin:15% auto;
     
}
#alert{
    width:90%;
    left:5%
}
}

@media screen and (min-width:501px) and (max-width:800px){
    #login{
    width:65%;
     margin-bottom:5px;
   
}

#signIn1{
    width:65%;
     margin-bottom:5px;
  
}
#alert{
    width:60%;
    left:20%;
}
}

@media screen and (min-width:801px) and (max-width:1024px){
    #login{
    width:65%;
  
 

}

#signIn1{
    width:65%;

}
#alert{
    width:50%;
   top:10%;
   left:25%;
}
}
</style>


<?php session_start();
ob_start();

include 'includes/incluir.php';
include 'classes/Manager.class.php';

include 'includes/nav.php';
include 'includes/section.php';


    echo "<div id='aside' class='bg-light'>";
if(isset($_REQUEST['h'])){

              echo '<center>  <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            Nome : Braimo Selimane Joao Braimo
                        </h3>                      
                        <h5>Personalidade</h5> 
                        <p>
                          Programador do Howdy
                        </p>
  
                        <div class="d-flex flex-row justify-content-center">
                            <div class="p-3">
                                <a href="https://web.facebook.com/Thugger-Hacks-109687957055841" target="_blank">
                                    <img src="svgs/brands/facebook-square.svg" class="img-fluid" width="50"><br>
                                </a>
                            </div>
  
                              <div class="p-3">
                                <a href="https://www.youtube.com/channel/UC6iLhSEa1e5psf4XSTvXLkw" target="_blank">
                                    <img src="svgs/brands/youtube.svg" class="img-fluid" width="50"><br>
                                </a>
                            </div>
                           
  
                            <div class="p-3">
                                <span data-toggle="modal" data-target="#myModal" style="cursor:pointer" autofocus>
                                    <img src="CSS/ICON.ico" class="img-fluid" width="50"><br>
                              </span>
                            </div>
  
                        </div>
  
                    </div>
             </center>';
  
  

}else{
  
echo "<div style='font-family:thugger;font-size:60px;tex-align:center;margin:auto'>Ajuda</div>
<span style='color:blue;font-weight:bolder;'>MENU DE NAVEGA&Ccedil;AO</span><br>
<span>

No menu de navega&ccedil;ao que se encontra encima da pagina, podemos ter atraves dele um acesso rapido e facil a algumas paginas do nosso site, come&ccedil;ando do \"Home\" ate ao \"Mais\", basta clicar em um dos links do menu de navega&ccedil;&atilde;o e sera rapidamente direcionado ao local desejado, muito rapido e simples.


</span><br><br>

<span style='color:blue;font-weight:bolder;'>MENU DE CHAT</span><br>
<span>

O menu de chat pode ser encontrado no lado esquerdo do nosso site, em todas as paginas do nosso site ( Em um computador), para facilitar a visualiza&ccedil;&atilde;o de usuarios online e para garantir um rapido acesso ao chat, todos os utilizadores do site estarao disponiveis no menu de chat (sem excep&ccedil;os).
</span><br><br>

<span style='color:blue;font-weight:bolder;'>HOME</span><br>
<span>

\"HOME\" ou \"PAGINA PRINCIPAL\" eh nesta pagina onde podemos encontrar todos os posts dos utilizadores do <strong>HOWDY</strong>, podemos ver os posts, podemos gostar dos posts, podemos comentar nos posts, podemos postar, e muito mais, tambem encontra-se disponivel acima do campo de texto de postagem um local reservado para os \"STATUS\", onde a pessoa podera postar os seus status, textos, imagens, trocar a cor do background e da fonte, e podera visualizar status dos outros utilizadores dando um click neles.

Clicando no nome de um usuario que postou algum conteudo, podera ter acesso a algumas das suas informa&ccedil;oes que nao se encontram ocultas.

Nb: Por nquanto ,os status e posts so aceitam ficheiros do tipo (Imagem)
</span><br><br>


<span style='color:blue;font-weight:bolder;'>MINHA CONTA</span><br>
<span>

Em \"Minha Conta\" Poderas ter acesso aos seus dados pessoais, assim como altera-los, com a excep&ccedil;ao de Genero, podera alterar a foto do perfil, nome de usuario, numero de usuario (para um numero nao existente no HOWDY),
Email (para um email nao existente no HOWDY), data de nascimento,pais,estado/provincia e cidade, podera alterar os seus status, podera ocultar o numero de celular, o email e a data de nascimento, basta clicar em editar e logo depois do botao \"editar\" poderas ocultar os referidos dados.

</span><br><br>

<span style='color:blue;font-weight:bolder;'>NOTIFICA&Ccedil;OES</span><br>
<span>

Quando alguem faz um post, gosta da tua publica&ccedil;ao, comenta na tua publica&ccedil;ao, na pagina de notifica&ccedil;oes sera enviado um alerta para que fiques a saber sobre novas atualiza&ccedil;oes, clicando no link \"ver mais\" ou \"ver likes\" poderas ser direcionado ao post ou aos likes do post

</span><br><br>

<span style='color:blue;font-weight:bolder;'>UTILIZADORES</span><br>
<span>

Nesta pagina teras acesso a lista de usuarios do <strong>HOWDY</strong>, caso queira conversar com um dos utilizadores, basta clicar no link \"Mensagem\" a esquerda dos nomes dos utilizadores e sera direcionado a pagina de mensagem.

</span><br><br>


<span style='color:blue;font-weight:bolder;'>MENSAGEM</span><br>
<span>

Nesta pagina tera acesso as suas mensagens, a cada mensagem recebida ira receber uma notifica&ccedil;ao nesta pagina alertando quantas mensagens nao lidas existem, basta clicar nas mensagens, as mensagens deixam de ser nao lidas, passando assim a serem mensagens lidas.

Na barra de pesquisa poderas fazer pesquisa de mensagens atraves do nome do usuario.

</span><br><br>


<span style='color:blue;font-weight:bolder;'>BARRA DE PESQUISA</span><br>
<span>

A bara de pesquisa se encontra no menu de navega&ccedil;ao, quando pretender pesquisar or um usuario basta escrever o nome ou o numero do usuario (se tiver), e clicar em \"search\", e a pesquisa sera efectuada, ira aparecer todos os resultados encontrados, clicando no nome dos usuarios encontrados ira ser direcionado a uma pagina em que podera ver os dados do usuario, ou ate mesmo os posts que ele fez na pagina PRINCIPAL, clicando o link (ver posts), na pagina ver posts, teras acesso as informa&ccedil;oes de quantos likes o usuario em questao ja teve em todos os seus posts, quantos comentarios ele ja teve e quantos posts ele ja fez.

clicando no outro link (Mensagem) podera conversar com o usuario em questao.

Ups: A barra de pesquisa funciona consoante a pagina em que o utilizador se encontra, podera pesquisar por usuarios quando estiver em todas as paginas exceptuando:

<ul>
<li>Mensagem</li>
<li>Midia</li>
<li>Love</li>

</ul>

nestas 3 paginas seram pesquisados conteudos relacionados com as paginas
</span><br><br>



<span style='color:blue;font-weight:bolder;'>MAIS</span><br>
<span>

Quando estiver nesta pagina, ira encontrar algumas paginas diferentes das que estao no menu de navega&ccedil;ao, e outras semelhantes.

Agora falarei das paginas que ainda nao foram explicadas

<ul>
<li>CHAT</li><br>
esta pagina apresenta usuarios online, quando clicado no icon de mensagem a direita dos utilizadores podera ter uma conversa com o utilizador,eh tambem a unica forma de ver usuarios online nos mobiles, viste que nao existe um menu de usuarios online como no computador<br><br>
<li>CONFIGURA&Ccedil;OES</li><br>
Nas configura&ccedil;oes podemos alterar a nossa senha de usuario, basta inserir a senha atual uma vez no primeiro campo, e nos ultimos dois campos inserir a nova senha, nas configura&ccedil;oes ainda, podemos eliminar a nossa conta, deixando assim de ser um utilizador do <strong>HOWDY</strong>, antes de eliminar a conta, existe uma op&ccedil;ao para cancelar e outra para continuar
</ul>
</span><br><br>

<span style='color:blue;font-weight:bolder;'>MIDIA</span><br>
<span>

Nesta pagina, poderas postar videos, audios, documentos com maximo de (30mb), e tambem encontraras posts de outros usuarios nessas 3 categorias, existe um pequeno menu onde poderas escolher se pretende ver um documento, um audio ou um video.

Para postar um desses ficheiros, precisara de primeiro clicar em um dos links do menu desta pagina \"Documentos,audios ou videos\" e depois fazer o post.

nesta pagina, a barra de pesquisa serve para procurar posts disponiveis nesta mesma pagina.

Para pesquisar, basta digitar o conteudo na barra de pesquisa e clicar em \"pesquisar\", e depois escolher se esta procurando por um video, audio ou documento e o resultado sera mostrado.
</span><br><br>

<span style='color:blue;font-weight:bolder;'>GRUPOS</span><br>
<span>

Nesta pagina, podes criar grupos (no maximo 5), clicando no card escrito \"novo grupo\" e escolhendo o nome do grupo, imagem do grupo, quem pode ver o grupo, e finalizar.

Nos grupos podem ser postados videos e imagens,por enquanto  nao existe um sistema de \"likes\" apenas sistema de comentarios, sendo admistrador de um grupo, podes eliminar posts, editar perfil do grupo, ou ate mesmo apagar o grupo, basta clicar no nome do grupo e tera as op&ccedil;oes para fazer as referidas a&ccedil;oes
</span><br><br>


<span style='color:blue;font-weight:bolder;'>SOBRE</span><br>
<span>

Aqui encontraras informa&ccedil;oes relacionadas ao desenvolvedor do HOWDY e os seus contactos
</span><br><br>

<span style='color:blue;font-weight:bolder;'>AJUDA</span><br>
<span>
Aqui iras encontrar as possiveis ajudas para a sua questao, mais ajuda brevemente...
</span><br><br>";

}



   
echo"</div>";





?>

<script>

</script>
<!---adm message modal---------->

<div class='modal fade' role='dialog' id='myModal'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header bg-primary'>
<button class='close' data-dismiss='modal'>&times;</button>
</div>


<form method='post' enctype='multipart/form-data'>
<div class='modal-footer bg-primary'>
<textarea class='form-control' placeholder='Mensagem para Braimo' name='status' maxLength=1000></textarea>
<input type='submit' name='btnS' class='btn btn-primary ' value='enviar' >
</form>
</div>
</div>
</div>

</div>

<!-------end---------------->

<?php

if(isset($_REQUEST['btnS'])){

$user=new Manager();
$user->setTexto(filter_var($_REQUEST['status'],FILTER_SANITIZE_SPECIAL_CHARS));
$user->setCelular($_SESSION['Numero']);
$user->setNumero("1234");
$id=0;

foreach($user->fetchUser() as $linh){
    $id=$linh['id_user'];
}
$user->setId($id);
$user->sendMsg();

echo "<script>alert('Mensagem enviada')</script>";
header('location:help.php?h=true');

}

ob_end_flush();
?>