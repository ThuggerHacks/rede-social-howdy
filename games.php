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

#nivel{
    opacity:0;
    border:none;
    background:#007bff;
    outline:none;
    margin:auto;
    text-align:center
}

#vpoints{
    color:#fff;
    font-weight:bolder;
    opacity:0;
}
#tabuleiro{
    width:220px;
    height:220px;
    margin:auto;
    display:flex;
    flex-wrap:wrap;
opacity:0

}

#tabuleiro2{
    width:220px;
    height:220px;
    margin:auto;
    display:flex;
    flex-wrap:wrap;
}

#s1,#s2,#s3,#s4,#s5,#s6,#s7,#s8,#s9{
    width:72.6px;
    height:72.6px;
    cursor:pointer;
    text-align:center;
    font-size:30px;
    font-weight:bolder;
    color:white
  
   

}
#who{
    color:white
}
#s1{
    border-right:1px solid white;
    border-bottom:1px solid white;
}
#s2{
    border-left:1px solid white;
    border-bottom:1px solid white;
    border-right:1px solid white
}
#s3{
    border-bottom:1px solid white;
    border-bottom:1px solid white;
}

#s4{
    border-bottom:1px solid white;
    border-right:1px solid white
}
#s5{
    border:1px solid white;
}
#s6{
    border-bottom:1px solid white
}

#s7{
    border-right:1px solid white
}
#s8{
    border-right:1px solid white
}
#aside::-webkit-scrollbar{
    width:10px;
    background:white
}

#aside::-webkit-scrollbar-thumb{
background:gray;
border-radius:15px;

}
#el{
    display:flex;
    flex-wrap:wrap
}
table{
    margin:5% auto;
    text-align:center
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



<?php session_start();
ob_start();

include 'includes/incluir.php';
include 'classes/Manager.class.php';

include 'includes/nav.php';
include 'includes/section.php';




echo "<div id='aside' class='bg-light'>";


echo "<div style='text-align:center'><div class='card  ' >
<span style='font-size:80px'><b>F</b></span>
<div class='card-body'>
<div class='card-text '>Jogo da forca</div>
<div class='btn btn-outline-primary my-2' id='play'>Play</div>
<div class='btn btn-outline-primary my-2' data-target='#ajuda1' data-toggle='modal'>Ajuda</div>

</div>
</div></div>";

echo "<br><div style='text-align:center'><div class='card  ' >
<span style='font-size:80px'><b>V</b></span>
<div class='card-body'>
<div class='card-text '>Jogo da Velha</div>
<div class='btn btn-outline-primary my-2' id='play1'>Play</div>
<div class='btn btn-outline-primary my-2' data-target='#ajuda2' data-toggle='modal'>Ajuda</div>
</div>
</div></div>";

        
echo "</div>";

//================================play modal jogo da forca========================

echo "<div id='dvb11' style='display:none'>";

echo "<div id='st'>";

echo "<a href='games.php' style='text-decoration:none'><button class='close' id='closar' style='outline:none'>&times;</button></a><br><hr>";


    echo "<style>
    #dvb11{";
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
    #dvb11::-webkit-scrollbar{
        width:10px;
        background:white
    }
    
    #dvb11::-webkit-scrollbar-thumb{
    background:gray;
    border-radius:15px;
    
    }

    @media screen and (max-width:991px){

        #dvb11{
           top:0%;
           left:0%;
           width:100%;
           height:100%
        }

      
    }
    </style>";


//=========================game=====================

echo "<div class='container bg-primary' id='all'>
<label for='tipo' class='text-light'>Selecione uma categoria</label><br>
<select class='form-control ' id='tipo'>
<option>Selecione uma categoria</option>
<option>Paises/Cidades</option>
<option>Animais</option>
<option>Linguas</option>
<option>Famosos</option>
</select>

<br><div class='table-responsive'>
<table class='table'>
<tr><th style='text-align:justify'>Jogadores</th><th>Pontos</th></tr>

";

//==============fetch Game  Points============================

$points=new Manager();
$points->setTexto('jogoDaVelha');
$points->setCelular($_SESSION['Numero']);
$id=0;
$point=0;


$points->setId($id);
$motor=$points->fetchAllPoints();

foreach($motor as $lin){
      $points->setId($lin['id_user']);
    foreach($points->fetchUserViaId() as $linha ){
    
    
    $point=$lin['Pontos'];
    echo "<tr><td style='word-break:break-word;text-align:justify' class='text-light'>".$linha['Nome']."</td><td style='word-break:break-word' class='text-light'> ".$lin['Pontos']."</td></tr>";

    }
}



echo "</table></div>
</div>";


echo "<div id='tipo1' class='container' style='display:none'>
<div id='img'></div><br>
<div id='pontos' class='text-light'>Pontos: ";
//==============fetch Game  Points============================

$points=new Manager();
$points->setTexto('jogoDaVelha');
$points->setCelular($_SESSION['Numero']);
$id=0;
$point=0;

foreach($points->fetchUser() as $linha ){
    $id=$linha['id_user'];
}
$points->setId($id);
$motor=$points->fetchPoints();

foreach($motor as $lin){
    $point=$lin['Pontos'];
    echo $lin['Pontos'];
}


echo "</div> <div id='acertos' class='text-light'>Acertos: 0</div>
<div id='erros' class='text-light'>Erros: 0</div>
<br>
<div class='text-light' id='type'></div><br>
<div id='el'></div><br>
<input type='hidden' id='point' value='".$point."'>
<input type='text' id='text' style='width:50px;height:50px;color:white;background:#222;text-align:center;font-size:30px' maxLength=1><br>
<button class='my-2 btn btn-light' onclick='okay()'>Ok</button>
<button class='my-2 btn btn-light' onclick='next()'>Next</button>
<button class='my-2 btn btn-primary' onclick='dica()' id='btn'>Dica 3</button>

</div>";
//=====================end===============================

echo "</div>";

echo "</div>";


//================end===========================


//================================play modal jogo da velha========================

echo "<div id='dvb12' style='display:none'>";

echo "<div id='st'>";

echo "<a href='games.php' style='text-decoration:none'><button class='close' id='closar' style='outline:none'>&times;</button></a><br><hr>";


    echo "<style>
    #dvb12{";
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
    #dvb12::-webkit-scrollbar{
        width:10px;
        background:white
    }
    
    #dvb12::-webkit-scrollbar-thumb{
    background:gray;
    border-radius:15px;
    
    }
    @media screen and (max-width:991px){

        #dvb12{
           top:0%;
           left:0%;
           width:100%;
           height:100%
        }

      
    }
    </style>";


//=========================game=====================
echo "<center id='game2'><div class='btn btn-outline-primary'>Jogar Contra Howdy</div></center><br>
<center id='game3'><div class='btn btn-outline-primary'>Jogar Contra Usuario</div></center>
<div class='table-responsive'>
<table class='table bg-primary'>
<tr><th style='text-align:justify'>Jogadores</th><th>Pontos</th></tr>

";

//==============fetch Game  Points============================

$points=new Manager();
$points->setTexto('jogoDaForca');
$points->setCelular($_SESSION['Numero']);
$id=0;
$point=0;


$points->setId($id);
$motor=$points->fetchAllPoints();

foreach($motor as $lin){
      $points->setId($lin['id_user']);
    foreach($points->fetchUserViaId() as $linha ){
    
    
    $point=$lin['Pontos'];
    echo "<tr><td style='word-break:break-word;text-align:justify' class='text-light'>".$linha['Nome']."</td><td style='word-break:break-word' class='text-light'> ".$lin['Pontos']."</td></tr>";

    }
}



echo "</table></div>
</div>";

echo "<div>
<center><select id='nivel'>
<option value='none'>Selecionar Nivel</option>
<option value='1'>Nivel 1</option>
<option value='2'>Nivel 2</option>
<option value='3'>Nivel 3</option>
<option value='4'>Nivel 4</option>
</select><br><span id='vpoints'>Pontos: ";
//==============fetch Game  Points============================

$points=new Manager();
$points->setTexto('jogoDaForca');
$points->setCelular($_SESSION['Numero']);
$id=0;
$point=0;

foreach($points->fetchUser() as $linha ){
    $id=$linha['id_user'];
}
$points->setId($id);
$motor=$points->fetchPoints();

foreach($motor as $lin){
    $point=$lin['Pontos'];
    echo $lin['Pontos'];
}

echo "<input type='hidden' id='point1' value='".$point."'></span></center><br>

<div id='tabuleiro'>
<div id='s1' onclick='play(1)'></div>
<div id='s2' onclick='play(2)'></div>
<div id='s3' onclick='play(3)'></div>
<div id='s4' onclick='play(4)'></div>
<div id='s5' onclick='play(5)'></div>
<div id='s6' onclick='play(6)'></div>
<div id='s7' onclick='play(7)'></div>
<div id='s8' onclick='play(8)'></div>
<div id='s9' onclick='play(9)'></div>

</div></div>";
//==============end=================================
echo "</div>";

echo "</div>";


//================end===========================


//======================================================



//===========================play against user modal


echo "<div id='dvbUser' style='display:none'>";

echo "<div id='st'>";

echo "<a href='games.php' style='text-decoration:none'><button class='close' id='closar' style='outline:none'>&times;</button></a><br><hr>";


    echo "<style>
    #dvbUser{";
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
    #dvbUser::-webkit-scrollbar{
        width:10px;
        background:white
    }
    
    #dvbUser::-webkit-scrollbar-thumb{
    background:gray;
    border-radius:15px;
    
    }

    @media screen and (max-width:991px){

        #dvbUser{
           top:0%;
           left:0%;
           width:100%;
           height:100%
        }

      
    }
    </style>";

echo "<center><button class='btn btn-outline-primary' id='rec' onclick='receber()'>RECEBER</button>
<button class='btn btn-outline-primary' id='env' onclick='enviarPedidoDeJogo()'>ENVIAR</button>
</center>";

//======enviar convite========
$user=new Manager();
$user->setCelular($_SESSION['Numero']);
$id=0;
foreach($user->fetchUser() as $linha){
$id=$linha['id_user'];
}

$user->setId($id);
echo "<div class='card' style='margin:2px' id='jogo' >";
foreach($user->fetchAllUsers() as $usuarios){
   
    echo "<div class='card-header'>";
    echo $usuarios['Nome'];

    echo "<button class='btn btn-outline-primary ' style='float:right' id='convidar".$usuarios['id_user']."' onclick='convidar(".$usuarios['id_user'].")'>Convidar</button></div>";

}



echo "</div>";


//=========receber convite========

echo "<div class='card' style='margin:2px' id='jogo1' ></div>";
$manager=new Manager();
$manager->deletePlay();

//======tabuleiro====

$userid=new Manager();
$userid->setCelular($_SESSION['Numero']);
$motor=$userid->fetchUser();
$iduser=0;

foreach($motor as $linha){
    $iduser=$linha['id_user'];
}

echo "<div id='player1' data-iduser='".$iduser."'></div>";
echo "<div id='player2' data-iduser='".$iduser."'></div>";
echo "<div id='tabuleiro2' style='display:none'>
<div id='s1' onclick='play1(1,0)'></div>
<div id='s2' onclick='play1(2,0)'></div>
<div id='s3' onclick='play1(3,0)'></div>
<div id='s4' onclick='play1(4,0)'></div>
<div id='s5' onclick='play1(5,0)'></div>
<div id='s6' onclick='play1(6,0)'></div>
<div id='s7' onclick='play1(7,0)'></div>
<div id='s8' onclick='play1(8,0)'></div>
<div id='s9' onclick='play1(9,0)'></div>

</div>";


echo "</div>";

echo "</div>";


//================end===========================






ob_end_flush();
?>

<script>

$('#play').click(function(){
$('#dvb11').show(200)
})


$('#play1').click(function(){
$('#dvb12').show(200)
})



//=========jogo da forca=======================
var x;
var arr=[];
var dicas=3;
var i=1;
var vpoints=document.getElementById('vpoints')
var vp=document.getElementById('point1').value;
$('#tipo').change(function(){
$('#all').hide();
$('#tipo1').show()
x=$('#tipo').val()
ini()
start()
})


function ini(){

    

if(x=='Paises/Cidades'){
    $('#type').text('Paises e Cidades')
    arr=["Brasil","Portugal","Paris","Lisboa","Pemba","Nairobe","Roma","Sofia","Cairo","China","Riade","Irao","USA","CapeTown","Zimbabwe","Mexico","Haite","Noruega","Kenya","Zumbo","Florida","Dubai","Durban","Mocambique","Qatar"];

}else if(x=='Animais'){
    $('#type').text('Animais')
    arr=["Cao","Cobra","Leao","Tigre","Hiena","Avestruz","Minhoca","Urso","Gato","Rato","Pato","Galo","Formiga","Mosca","Cabrito","Boi","Medusa","Flamingo","Peru","Camelo"];
}else if(x=='Linguas'){
    $('#type').text('Linguas')
         arr=["Frances","Ingles","Portugues","Chines","Japones","Kswahil","Espanhol","Romano","Turco","Holandes","Coti","Sueco","Latin"];
}else if(x=='Famosos'){
    $('#type').text('Famosos')
    arr=["JuiceWRLD","twoPac","Quavo","CardiB","Durk","Wayne","BirdMan","TwoChains","Pique","Grizman","Khalid","Smith","JadenSmith","Justin","Pump","Akon","Travis","Drake","Bander","Dygo","Moster"];

}

}
var rand
function start(){
    i=1;
    dicas=3;
rand=Math.floor(Math.random()*arr.length);

var el;
for(var i=0;i<arr[rand].length;i++){
el=document.createElement('div');
el.setAttribute('style','width:50px;height:50px;color:white;background:#222;text-align:center;margin:2px;font-size:30px;');
el.setAttribute('id','el'+i);
document.getElementById('el').appendChild(el)
}

}

var acertos=0;
var pontos=document.getElementById('point').value;
var pont;
var erros=0;

function okay(){

    var text=document.getElementById('text');

if(text.value.length>0){

if(arr[rand].toLowerCase().search(text.value.toLowerCase())!=-1){

var div=arr[rand].toLowerCase().search(text.value.toLowerCase());

document.getElementById('el'+div).innerHTML=text.value.toUpperCase()
text.value=''
acertos++;
document.getElementById('acertos').innerHTML="Acertos: "+acertos;


if(acertos==arr[rand].length){
    pontos++;
    acertos=0
    erros=0;
    dicas=3;
    i=1;


$.ajax({
    url:'gameRecords.php',
    type:'post',
    data:{pontos:pontos,game:'jogoDaVelha'},
    success:function(data){
        
    }
})


    document.getElementById('pontos').innerHTML="Pontos: "+pontos
    document.getElementById('el').innerHTML=""
    start()
}



}else{

    if((erros*-1)>=5){
        erros=0;
        pontos--;
    }
  erros--;
  document.getElementById('erros').innerHTML="Erros: "+(erros)*-1;
  document.getElementById('text').innerHTML=""

  document.getElementById('pontos').innerHTML="Pontos: "+pontos
   

$.ajax({
    url:'gameRecords.php',
    type:'post',
    data:{pontos:pontos,game:'jogoDaVelha'},
    success:function(data){
        
    }
})



}
}
}




function dica(){
  
  

if(dicas!=0){
    
    var d=arr[rand].slice(0,i);
    alert(d);
    document.getElementById('btn').innerHTML="Dica "+dicas
    dicas--;

}else{
    alert('Ja usou todas as dicas')

}

i++;

}

function next(){
    i=1;
    dicas=3;
    acertos=0;
    erros=0;
    document.getElementById('el').innerHTML=''
    start()
}

//==============endGame===================================================

//====================jogo da velha==============================

$('#game2').click(function(){
    $('#game2').hide()
    $('#game3').hide()
    $('#game1').hide()
    $('#tabuleiro').attr('style','opacity:1')
    $('#nivel').attr('style','opacity:1')
    $('#vpoints').css('opacity','1')
    $('.table-responsive').css('display','none')

})

$('#game3').click(function(){
  $('#dvbUser').show();

})


var v=0;
var whoPlays=0;
var playing=false;
var table=[];
var content=[];


function inicia(){

table=[
    ["","",""],
    ["","",""],
    ["","",""]
];

content=[
    [document.getElementById('s1'),document.getElementById('s2'),document.getElementById('s3')],
    [document.getElementById('s4'),document.getElementById('s5'),document.getElementById('s6')],
    [document.getElementById('s7'),document.getElementById('s8'),document.getElementById('s9')]
];

content[0][0].innerHTML=''
content[0][1].innerHTML=''
content[0][2].innerHTML=''
content[1][0].innerHTML=''
content[1][1].innerHTML=''
content[1][2].innerHTML=''
content[2][0].innerHTML=''
content[2][1].innerHTML=''
content[2][2].innerHTML=''





}


$('#nivel').change(function(){

v=$(this).val()
playing=true;
inicia()


})

function cpu(){

if(whoPlays==1 && playing){

if(v==1 && v!='none'){

    var l,c;
//============nivel 1=================

if(table[0][0]=='' || table[0][1]=='' || table[0][2]=='' || table[1][0]=='' || table[1][1]=='' || table[1][2]=='' || table[2][0]=='' || table[2][1]=='' || table[2][2]==''){
do{
l=Math.round(Math.random()*2)
c=Math.round(Math.random()*2)
}while(table[l][c]!='')
table[l][c]='O'
whoPlays=0;
}


}else if(v==3 && v!='none'){
    //================nivel 3

//===================primeira linha==============
if((table[0][0]=='X' && table[0][1]=='X' && table[0][2]=='')){
    table[0][2]="O"
}else if(table[0][0]=="X" && table[0][1]=='' && table[0][2]=="X"){
    table[0][1]="O"
}else if(table[0][0]=='' && table[0][1]=='X' && table[0][2]=="X"){
    table[0][0]="O"
}else
//=============================================

//===================================segunda linha==================

if(table[1][0]=="X" && table[1][1]=="X" && table[1][2]==''){
    table[1][2]="O"
}else if(table[1][0]=="" && table[1][1]=="X" && table[1][2]=='X'){
    table[1][0]="O"
}else if(table[1][0]=="X" && table[1][1]=="" && table[1][2]=='X'){
    table[1][1]="O"
}else
//================end============================================

//===================================terceira linha=================

if(table[2][0]=="X" && table[2][1]=="X" && table[2][2]==""){
    table[2][2]="O"
}else if(table[2][0]=="" && table[2][1]=="X" && table[2][2]=="X"){
table[2][0]="O"
}else if(table[2][0]=="X" && table[2][1]=="" && table[2][2]=="X"){
    table[2][1]="O"
}else
//=========================end=======================

//================coluna 1=========================

if(table[0][0]=="X" && table[1][0]=="X" && table[2][0]==""){
    table[2][0]="O"
}else if(table[0][0]=="" && table[1][0]=="X" && table[2][0]=="X"){
table[0][0]="O"
}else if(table[0][0]=="X" && table[1][0]=="" && table[2][0]=="X"){
table[1][0]="O"
}else
//=========================================================

//===============coluna 2========================================

if(table[0][1]=="X" && table[1][1]=="X" && table[2][1]==""){
    table[2][1]="O"
}else if(table[0][1]=="" && table[1][1]=="X" && table[2][1]=="X"){
table[0][1]="O"
}else if(table[0][1]=="X" && table[1][1]=="" && table[2][1]=="X"){
table[1][1]="O"
}else


//================================================

//========================coluna 3========================



if(table[0][2]=="X" && table[1][2]=="X" && table[2][2]==""){
    table[2][2]="O"
}else if(table[0][2]=="" && table[1][2]=="X" && table[2][2]=="X"){
table[0][2]="O"
}else if(table[0][2]=="X" && table[1][2]=="" && table[2][2]=="X"){
table[1][2]="O"
//======================diagonal1=======================
}else if(table[0][0]=="X" && table[1][1]=="" && table[2][2]=="X"){

table[1][1]="O"

}else if(table[0][0]=="" && table[1][1]=="X" && table[2][2]=="X"){
    table[0][0]="O"

}else if(table[0][0]=="X" && table[1][1]=="X" && table[2][2]==""){
    table[2][2]="O"

    //=================================================
}else if(table[0][2]=="X" && table[1][1]=="X" && table[2][0]==""){
    //=============diagonal2=========================
    table[2][0]="O"


}else if(table[0][2]=="X" && table[1][1]=="" && table[2][0]=="X"){
    table[1][1]="O"
}else if(table[0][2]=="" && table[1][1]=="X" && table[2][0]=="X"){
    table[0][2]="O"
//=================================================================
}else{

    if(table[0][0]=='' || table[0][1]=='' || table[0][2]=='' || table[1][0]=='' || table[1][1]=='' || table[1][2]=='' || table[2][0]=='' || table[2][1]=='' || table[2][2]==''){
do{
l=Math.round(Math.random()*2)
c=Math.round(Math.random()*2)
}while(table[l][c]!='')
table[l][c]='O'

}

}

//==================================
whoPlays=0;
}else if(v==2 && v!='none'){

  //================nivel 2

//===================primeira linha==============
if((table[0][0]=='O' && table[0][1]=='O' && table[0][2]=='')){
    table[0][2]="O"
}else if(table[0][0]=="O" && table[0][1]=='' && table[0][2]=="O"){
    table[0][1]="O"
}else if(table[0][0]=='' && table[0][1]=='O' && table[0][2]=="O"){
    table[0][0]="O"
}else
//=============================================

//===================================segunda linha==================

if(table[1][0]=="O" && table[1][1]=="O" && table[1][2]==''){
    table[1][2]="O"
}else if(table[1][0]=="" && table[1][1]=="O" && table[1][2]=='O'){
    table[1][0]="O"
}else if(table[1][0]=="O" && table[1][1]=="" && table[1][2]=='O'){
    table[1][1]="O"
}else
//================end============================================

//===================================terceira linha=================

if(table[2][0]=="O" && table[2][1]=="O" && table[2][2]==""){
    table[2][2]="O"
}else if(table[2][0]=="" && table[2][1]=="O" && table[2][2]=="O"){
table[2][0]="O"
}else if(table[2][0]=="O" && table[2][1]=="" && table[2][2]=="O"){
    table[2][1]="O"
}else
//=========================end=======================

//================coluna 1=========================

if(table[0][0]=="O" && table[1][0]=="O" && table[2][0]==""){
    table[2][0]="O"
}else if(table[0][0]=="" && table[1][0]=="O" && table[2][0]=="O"){
table[0][0]="O"
}else if(table[0][0]=="O" && table[1][0]=="" && table[2][0]=="O"){
table[1][0]="O"
}else
//=========================================================

//===============coluna 2========================================

if(table[0][1]=="O" && table[1][1]=="O" && table[2][1]==""){
    table[2][1]="O"
}else if(table[0][1]=="" && table[1][1]=="O" && table[2][1]=="O"){
table[0][1]="O"
}else if(table[0][1]=="O" && table[1][1]=="" && table[2][1]=="O"){
table[1][1]="O"
}else


//================================================

//========================coluna 3========================



if(table[0][2]=="O" && table[1][2]=="O" && table[2][2]==""){
    table[2][2]="O"
}else if(table[0][2]=="" && table[1][2]=="O" && table[2][2]=="O"){
table[0][2]="O"
}else if(table[0][2]=="O" && table[1][2]=="" && table[2][2]=="O"){
table[1][2]="O"
//======================diagonal1=======================
}else if(table[0][0]=="O" && table[1][1]=="" && table[2][2]=="O"){

table[1][1]="O"

}else if(table[0][0]=="" && table[1][1]=="O" && table[2][2]=="O"){
    table[0][0]="O"

}else if(table[0][0]=="O" && table[1][1]=="O" && table[2][2]==""){
    table[2][2]="O"

    //=================================================
}else if(table[0][2]=="O" && table[1][1]=="O" && table[2][0]==""){
    //=============diagonal2=========================
    table[2][0]="O"


}else if(table[0][2]=="O" && table[1][1]=="" && table[2][0]=="O"){
    table[1][1]="O"
}else if(table[0][2]=="" && table[1][1]=="O" && table[2][0]=="O"){
    table[0][2]="O"
//=================================================================
}else{

    if(table[0][0]=='' || table[0][1]=='' || table[0][2]=='' || table[1][0]=='' || table[1][1]=='' || table[1][2]=='' || table[2][0]=='' || table[2][1]=='' || table[2][2]==''){
do{
l=Math.round(Math.random()*2)
c=Math.round(Math.random()*2)
}while(table[l][c]!='')
table[l][c]='O'

}

}

//==================================
whoPlays=0;

}else if(v==4 && v!='none'){


  //================nivel 4

//===================primeira linha==============
if((table[0][0]=='O' && table[0][1]=='O' && table[0][2]=='')){
    table[0][2]="O"
}else if(table[0][0]=="O" && table[0][1]=='' && table[0][2]=="O"){
    table[0][1]="O"
}else if(table[0][0]=='' && table[0][1]=='O' && table[0][2]=="O"){
    table[0][0]="O"
}else
//=============================================

//===================================segunda linha==================

if(table[1][0]=="O" && table[1][1]=="O" && table[1][2]==''){
    table[1][2]="O"
}else if(table[1][0]=="" && table[1][1]=="O" && table[1][2]=='O'){
    table[1][0]="O"
}else if(table[1][0]=="O" && table[1][1]=="" && table[1][2]=='O'){
    table[1][1]="O"
}else
//================end============================================

//===================================terceira linha=================

if(table[2][0]=="O" && table[2][1]=="O" && table[2][2]==""){
    table[2][2]="O"
}else if(table[2][0]=="" && table[2][1]=="O" && table[2][2]=="O"){
table[2][0]="O"
}else if(table[2][0]=="O" && table[2][1]=="" && table[2][2]=="O"){
    table[2][1]="O"
}else
//=========================end=======================

//================coluna 1=========================

if(table[0][0]=="O" && table[1][0]=="O" && table[2][0]==""){
    table[2][0]="O"
}else if(table[0][0]=="" && table[1][0]=="O" && table[2][0]=="O"){
table[0][0]="O"
}else if(table[0][0]=="O" && table[1][0]=="" && table[2][0]=="O"){
table[1][0]="O"
}else
//=========================================================

//===============coluna 2========================================

if(table[0][1]=="O" && table[1][1]=="O" && table[2][1]==""){
    table[2][1]="O"
}else if(table[0][1]=="" && table[1][1]=="O" && table[2][1]=="O"){
table[0][1]="O"
}else if(table[0][1]=="O" && table[1][1]=="" && table[2][1]=="O"){
table[1][1]="O"
}else


//================================================

//========================coluna 3========================



if(table[0][2]=="O" && table[1][2]=="O" && table[2][2]==""){
    table[2][2]="O"
}else if(table[0][2]=="" && table[1][2]=="O" && table[2][2]=="O"){
table[0][2]="O"
}else if(table[0][2]=="O" && table[1][2]=="" && table[2][2]=="O"){
table[1][2]="O"
//======================diagonal1=======================
}else if(table[0][0]=="O" && table[1][1]=="" && table[2][2]=="O"){

table[1][1]="O"

}else if(table[0][0]=="" && table[1][1]=="O" && table[2][2]=="O"){
    table[0][0]="O"

}else if(table[0][0]=="O" && table[1][1]=="O" && table[2][2]==""){
    table[2][2]="O"

    //=================================================
}else if(table[0][2]=="O" && table[1][1]=="O" && table[2][0]==""){
    //=============diagonal2=========================
    table[2][0]="O"


}else if(table[0][2]=="O" && table[1][1]=="" && table[2][0]=="O"){
    table[1][1]="O"
}else if(table[0][2]=="" && table[1][1]=="O" && table[2][0]=="O"){
    table[0][2]="O"
//=================================================================
}else


//===================primeira linha==============
if((table[0][0]=='X' && table[0][1]=='X' && table[0][2]=='')){
    table[0][2]="O"
}else if(table[0][0]=="X" && table[0][1]=='' && table[0][2]=="X"){
    table[0][1]="O"
}else if(table[0][0]=='' && table[0][1]=='X' && table[0][2]=="X"){
    table[0][0]="O"
}else
//=============================================

//===================================segunda linha==================

if(table[1][0]=="X" && table[1][1]=="X" && table[1][2]==''){
    table[1][2]="O"
}else if(table[1][0]=="" && table[1][1]=="X" && table[1][2]=='X'){
    table[1][0]="O"
}else if(table[1][0]=="X" && table[1][1]=="" && table[1][2]=='X'){
    table[1][1]="O"
}else
//================end============================================

//===================================terceira linha=================

if(table[2][0]=="X" && table[2][1]=="X" && table[2][2]==""){
    table[2][2]="O"
}else if(table[2][0]=="" && table[2][1]=="X" && table[2][2]=="X"){
table[2][0]="O"
}else if(table[2][0]=="X" && table[2][1]=="" && table[2][2]=="X"){
    table[2][1]="O"
}else
//=========================end=======================

//================coluna 1=========================

if(table[0][0]=="X" && table[1][0]=="X" && table[2][0]==""){
    table[2][0]="O"
}else if(table[0][0]=="" && table[1][0]=="X" && table[2][0]=="X"){
table[0][0]="O"
}else if(table[0][0]=="X" && table[1][0]=="" && table[2][0]=="X"){
table[1][0]="O"
}else
//=========================================================

//===============coluna 2========================================

if(table[0][1]=="X" && table[1][1]=="X" && table[2][1]==""){
    table[2][1]="O"
}else if(table[0][1]=="" && table[1][1]=="X" && table[2][1]=="X"){
table[0][1]="O"
}else if(table[0][1]=="X" && table[1][1]=="" && table[2][1]=="X"){
table[1][1]="O"
}else


//================================================

//========================coluna 3========================



if(table[0][2]=="X" && table[1][2]=="X" && table[2][2]==""){
    table[2][2]="O"
}else if(table[0][2]=="" && table[1][2]=="X" && table[2][2]=="X"){
table[0][2]="O"
}else if(table[0][2]=="X" && table[1][2]=="" && table[2][2]=="X"){
table[1][2]="O"
//======================diagonal1=======================
}else if(table[0][0]=="X" && table[1][1]=="" && table[2][2]=="X"){

table[1][1]="O"

}else if(table[0][0]=="" && table[1][1]=="X" && table[2][2]=="X"){
    table[0][0]="O"

}else if(table[0][0]=="X" && table[1][1]=="X" && table[2][2]==""){
    table[2][2]="O"

    //=================================================
}else if(table[0][2]=="X" && table[1][1]=="X" && table[2][0]==""){
    //=============diagonal2=========================
    table[2][0]="O"


}else if(table[0][2]=="X" && table[1][1]=="" && table[2][0]=="X"){
    table[1][1]="O"
}else if(table[0][2]=="" && table[1][1]=="X" && table[2][0]=="X"){
    table[0][2]="O"
//=================================================================
}else{

    if(table[0][0]=='' || table[0][1]=='' || table[0][2]=='' || table[1][0]=='' || table[1][1]=='' || table[1][2]=='' || table[2][0]=='' || table[2][1]=='' || table[2][2]==''){
do{
l=Math.round(Math.random()*2)
c=Math.round(Math.random()*2)
}while(table[l][c]!='')
table[l][c]='O'

}

}

//==================================
whoPlays=0;
}else if(v==2 && v!='none'){

  //================nivel 2

//===================primeira linha==============
if((table[0][0]=='O' && table[0][1]=='O' && table[0][2]=='')){
    table[0][2]="O"
}else if(table[0][0]=="O" && table[0][1]=='' && table[0][2]=="O"){
    table[0][1]="O"
}else if(table[0][0]=='' && table[0][1]=='O' && table[0][2]=="O"){
    table[0][0]="O"
}else
//=============================================

//===================================segunda linha==================

if(table[1][0]=="O" && table[1][1]=="O" && table[1][2]==''){
    table[1][2]="O"
}else if(table[1][0]=="" && table[1][1]=="O" && table[1][2]=='O'){
    table[1][0]="O"
}else if(table[1][0]=="O" && table[1][1]=="" && table[1][2]=='O'){
    table[1][1]="O"
}else
//================end============================================

//===================================terceira linha=================

if(table[2][0]=="O" && table[2][1]=="O" && table[2][2]==""){
    table[2][2]="O"
}else if(table[2][0]=="" && table[2][1]=="O" && table[2][2]=="O"){
table[2][0]="O"
}else if(table[2][0]=="O" && table[2][1]=="" && table[2][2]=="O"){
    table[2][1]="O"
}else
//=========================end=======================

//================coluna 1=========================

if(table[0][0]=="O" && table[1][0]=="O" && table[2][0]==""){
    table[2][0]="O"
}else if(table[0][0]=="" && table[1][0]=="O" && table[2][0]=="O"){
table[0][0]="O"
}else if(table[0][0]=="O" && table[1][0]=="" && table[2][0]=="O"){
table[1][0]="O"
}else
//=========================================================

//===============coluna 2========================================

if(table[0][1]=="O" && table[1][1]=="O" && table[2][1]==""){
    table[2][1]="O"
}else if(table[0][1]=="" && table[1][1]=="O" && table[2][1]=="O"){
table[0][1]="O"
}else if(table[0][1]=="O" && table[1][1]=="" && table[2][1]=="O"){
table[1][1]="O"
}else


//================================================

//========================coluna 3========================



if(table[0][2]=="O" && table[1][2]=="O" && table[2][2]==""){
    table[2][2]="O"
}else if(table[0][2]=="" && table[1][2]=="O" && table[2][2]=="O"){
table[0][2]="O"
}else if(table[0][2]=="O" && table[1][2]=="" && table[2][2]=="O"){
table[1][2]="O"
//======================diagonal1=======================
}else if(table[0][0]=="O" && table[1][1]=="" && table[2][2]=="O"){

table[1][1]="O"

}else if(table[0][0]=="" && table[1][1]=="O" && table[2][2]=="O"){
    table[0][0]="O"

}else if(table[0][0]=="O" && table[1][1]=="O" && table[2][2]==""){
    table[2][2]="O"

    //=================================================
}else if(table[0][2]=="O" && table[1][1]=="O" && table[2][0]==""){
    //=============diagonal2=========================
    table[2][0]="O"


}else if(table[0][2]=="O" && table[1][1]=="" && table[2][0]=="O"){
    table[1][1]="O"
}else if(table[0][2]=="" && table[1][1]=="O" && table[2][0]=="O"){
    table[0][2]="O"
//=================================================================
}else{

    if(table[0][0]=='' || table[0][1]=='' || table[0][2]=='' || table[1][0]=='' || table[1][1]=='' || table[1][2]=='' || table[2][0]=='' || table[2][1]=='' || table[2][2]==''){
do{
l=Math.round(Math.random()*2)
c=Math.round(Math.random()*2)
}while(table[l][c]!='')
table[l][c]='O'

}

}


}

}











if(win()!=''){
    alert(win()+" Venceu")
 
    if(win()=='X'){

        vp++;
        vpoints.innerHTML="Pontos: "+vp

        $.ajax({
            url:'gameRecords.php',
            type:'post',
            data:{vp:vp,game:'jogoDaForca'},
            success:function(data){

            }
        })
        
    }else if(win()=='O'){
        vp--;
        vpoints.innerHTML="Pontos: "+vp

        $.ajax({
            url:'gameRecords.php',
            type:'post',
            data:{vp:vp,game:'jogoDaForca'},
            success:function(data){
                
            }
        })
    }

    playing=false
   
   

}

concat()
}


//==============================winner================

function win(){

//=============linha====================

for(var l=0;l<3;l++){
    if((table[l][0]==table[l][1]) && (table[l][1]==table[l][2])){
        return table[l][0];
    }
}

//=============coluna==========================

for(var c=0;c<3;c++){
    if((table[0][c]==table[1][c]) && (table[2][c]==table[1][c])){
        return table[0][c];
    }
}

//============================diagonal 1====================

if((table[0][0]==table[1][1]) && (table[1][1]==table[2][2])){
    return table[0][0];
}

//===========================diagonal 2=========================

if((table[0][2]==table[1][1]) && (table[1][1]==table[2][0])){
    return table[1][1];
}

return "";
}



function play(p){
    if(playing){
    switch(p){
    case 1:
    if(table[0][0]=='' && whoPlays==0){
      
        whoPlays=1;
        table[0][0]='X'

    }

    break;

    case 2:
    if(table[0][1]=='' && whoPlays==0){
   
        whoPlays=1;
        table[0][1]='X'

    }

    break;

    case 3:
    if(table[0][2]=='' && whoPlays==0){

        whoPlays=1;
        table[0][2]='X'

    }

    break;

    case 4:
    if(table[1][0]=='' && whoPlays==0){
  
        whoPlays=1;
        table[1][0]='X'

    }

    break;

    case 5:
    if(table[1][1]=='' && whoPlays==0){
       
        whoPlays=1;
        table[1][1]='X'

    }

    break;

    case 6:
    if(table[1][2]=='' && whoPlays==0){
       
        whoPlays=1;
        table[1][2]='X'

    }

    break;

    case 7:
    if(table[2][0]=='' && whoPlays==0){
     
        whoPlays=1;
        table[2][0]='X'

    }

    break;

    case 8:
    if(table[2][1]=='' && whoPlays==0){
       
        whoPlays=1;
        table[2][1]='X'

    }

    break;

    default:
    if(table[2][2]=='' && whoPlays==0){
       
        whoPlays=1;
        table[2][2]='X'

    }

 
    }

  if(whoPlays==1){
        cpu()
      
  }

  
    }
}


function concat(){

for(var l=0;l<3;l++){
    for(var c=0;c<3;c++){
       if(table[l][c]=='X'){
       content[l][c].innerHTML='X';
       content[l][c].style.cursor="no-drop"
       }else if(table[l][c]=='O'){
        content[l][c].innerHTML='O';
       content[l][c].style.cursor="no-drop"
       }else{
        content[l][c].innerHTML='';
       content[l][c].style.cursor="pointer"
       }
    }
}



}


//=================jogar contra um usuario do howdy
var user1,user2,whoPlays1;
$('#jogo').hide();
function enviarPedidoDeJogo(){
    $('#env').hide();
    $('#rec').hide();
    $('#jogo').show();
}

var int1;
function convidar(usuario){
nome=usuario;
    int1=setInterval(function(daa){
    var user=document.getElementById("convidar"+usuario);
    
    $.ajax({
        url:'gamesRequest.php',
        type:'post',
        data:{usuario:usuario},
        success:function(data){

          if(data=="Aceite"){
            $('#jogo').hide(100); 
            $('#tabuleiro2').show(100)
          }
        user.innerHTML=data
        if($('#player2').data('iduser')!=usuario){
              $('#player2').html('<center class="text-light">Player_<span>'+usuario+'</span></center>');
              user2=usuario;
              user1=$('#player2').data('iduser')
          }else{
            $('#player2').html('<center class="text-light">Eu</center>')
          }
        }
    })
},1000)

}

var int;
//=====receber pedidos de jogo
$('#jogo1').hide();
function receber(){
    $('#jogo1').show(1000);
    $('#env').hide();
    $('#rec').hide();
    int=setInterval(() => {
       $.ajax({
           url:'gamesRequest.php',
           type:'post',
           data:{dados:""},
           success:function(data){
            $('#jogo1').html("");
               $('#jogo1').html(data);
               $('#jogo').hide();
           }
       }) 
    },1000);
}

function aceitar(pessoa,eu){
    clearInterval(int)
    clearInterval(int1)
    user1=pessoa; 
    user2=eu;
    $.ajax({
        url:'gamesRequest.php',
           type:'post',
           data:{pessoa:pessoa,eu:eu},
           success:function(data){
            $('#jogo1').hide(100);
            $('#tabuleiro2').show(100)
          if($('#player1').data('iduser')==eu){
              $('#player1').html('<center class="text-light">Player_<span>'+pessoa+'</span></center>');

             
          }else{
            $('#player1').html('<center class="text-light">'+eu+'</center>');
          }
         
       
           }
    })
    
}



//======jogadas=========






function play1(y,whoPlays1){

   if(whoPlays1==$('#player2').data('iduser')){
        $.ajax({
    url:'gamesRequest.php',
    type:'post',
    data:{jogada:y,player1:user1,player2:user2},
    success:function(data){
     
    }
        
}) 
   } 

}


setInterval(() => {
    $.ajax({
    url:'gamesRequest.php',
    type:'post',
    data:{player3:user1,player4:user2,sudo:""},
    success:function(data){
    $('#tabuleiro2').html(data)
    }
    
})
}, 100);

window.addEventListener('load',inicia)

</script>
<!---modal ajuda1---------->

<div class='modal fade' role='dialog' id='ajuda1'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header'>
<h3>Jogo da forca</h3>
<button class='close' data-dismiss='modal'>&times;</button>
</div>
<div class='modal-body'>
<h6>Objectivo:</h6><br>
completar uma palavra da categoria escolhida, advinhando letra por letra desta palavra.<br>
Se por exemplo tiver escolhido a categoria de "<b>Animais</b>" sera listado varios animais, e escolhidos um por um aleatoriamente, tente acertar as letras ate completar o nome do animal, depois de ter completado toda a palavra ganhara um ponto, e se tiver errado 5 vezes em uma unica palavra tera -1 ponto.<br>

<h6>Mais</h6><br>
Os pontos nao tem limites, na tabela estara listado todos os usuarios que jogam este game e os seus pontos, o melhor estara destacado na primeira linha da tabela
</div>

</div>

</div>

</div>

<!---modal ajuda2---------->

<div class='modal fade' role='dialog' id='ajuda2'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header'>
<h3>Jogo da Velha</h3>
<button class='close' data-dismiss='modal'>&times;</button>
</div>
<div class='modal-body'>
<div class='container'>
Tente ganhar o maximo numero de pontos possiveis jogado contra o Howdy, existem 4 niveis diferentes:
<ul>
<li>Primeiro nivel</li><br>
O robot do howdy joga aleatoriamente sem pensar, sendo assim facil de ganhar o jogo<br>
<li>Segundo Nivel</li><br>
O robot do howdy joga pra ganhar, ele observa as jogadas dele e ve quais sao as possibilidades de ganhar<br>
<li>Terceiro nivel</li><br>
O robot do howdy joga para se defender, observando a jogada do usuario e bloqueiando ele, tornando o jogo mais dificil<br>
<li>Quarto nivel</li><br>
O quarto nivel o robot do howdy tem as habilidades do primeiro, segundo e terceiro nivel
</ul><br>
Quando o robot ganha, os pontos do usuario seram diminuidos em uma unidade
</div>
</div>
</div>

</div>

</div>