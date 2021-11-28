CREATE TABLE usuarios(
Nome                  VARCHAR(50) NOT NULL,
Numero                 INT NOT NULL ,
Email                   VARCHAR(100),
Senha                    VARCHAR(120) NOT NULL,
Avatar                    VARCHAR(100),
Sexo                         VARCHAR(20),
Pais                         VARCHAR(100),
Cidade                          VARCHAR(100),
Distrito                         VARCHAR(100),
Estados                        VARCHAR(255),
Estado                         VARCHAR(100),
Data_Nascimento                    DATE,
Ocultar_Data                     VARCHAR(10),
Ocultar_Numero                     VARCHAR(10),
Ocultar_Email                     VARCHAR(10),
First_Time                         INT,
id_user                               INT NOT NULL PRIMARY KEY AUTO_INCREMENT                                

);

CREATE TABLE posts (
Mensagem             TEXT,
Ficheiro              VARCHAR(200),
id_posts               INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
Hora                    VARCHAR(200),
Numero                    INT,
id_user                   INT ,
Estado                            VARCHAR(20),
FOREIGN KEY (id_user) REFERENCES usuarios (id_user) ON DELETE CASCADE ON UPDATE CASCADE

);

CREATE TABLE pvt(
Mensagem                   TEXT,
Ficheiro                   VARCHAR(100),
Hora                          VARCHAR(200),
Recipie                          INT,
Sender                           INT,
Numero                           INT,
id               INT   NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_user                            INT ,
Estado                            VARCHAR(20),
FOREIGN KEY (id_user) REFERENCES usuarios (id_user) ON DELETE CASCADE ON UPDATE CASCADE

);
CREATE TABLE comentarios (

Numero                INT NOT NULL,
Mensagem                 TEXT,
Hora                     VARCHAR(200),
Comentario               TEXT,
Hora_Comentario          VARCHAR(299),
Numero_poster              INT,
Ficheiro                  VARCHAR(100),
id               INT   NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_user            INT ,
FOREIGN KEY (id_user) REFERENCES usuarios (id_user) ON DELETE CASCADE ON UPDATE CASCADE


);
CREATE TABLE likes (
Numero            INT,
Hora_post          VARCHAR(200),
Numero_post         INT,
Mensagem             TEXT,
Hora                 VARCHAR(200),
id               INT   NOT NULL PRIMARY KEY AUTO_INCREMENT

);

CREATE TABLE Grupo(

Nome           VARCHAR(50),
Numero         INT,
Membros          INT,
id             INT  PRIMARY KEY AUTO_INCREMENT,
Avatar          VARCHAR(150),
Sender          INT,
Data_Criacao    VARCHAR(200),
id_membro         INT,
Tipo             VARCHAR(100),
Genero            VARCHAR(30),
Tipo_Ficheiro    VARCHAR(20),
Mensagem          TEXT,
Hora_Post         VARCHAR(200),
Ficheiro           VARCHAR(150),
Descricao           VARCHAR(200)

);

CREATE TABLE especiais(
Numero         INT,
Titulo         VARCHAR(50),
Ficheiro       VARCHAR(200),
Tipo           VARCHAR(50),
id               INT   NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_user             INT ,

FOREIGN KEY (id_user) REFERENCES usuarios (id_user) ON DELETE CASCADE ON UPDATE CASCADE



);


CREATE TABLE Estado (

Imagem          VARCHAR(200),
Texto           TEXT,
Letra           VARCHAR(50),
Cor              VARCHAR(50),
Numero             INT,
Timer              VARCHAR(200),
Id                  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_user              INT,
Cor1                 VARCHAR(50),
Foreign Key (id_user) REFERENCES usuarios (id_user) ON DELETE CASCADE ON UPDATE CASCADE





);

CREATE TABLE StatusView (

Id                INT PRIMARY KEY AUTO_INCREMENT,
Id_viewer          INT,
id_status          INT

);

CREATE TABLE Notificacao (

    Id                INT PRIMARY KEY AUTO_INCREMENT,
    Id_viewer          INT,
    id_status          INT,
    Estado             VARCHAR(100)
    
    );
    


  CREATE TABLE Love (
Id           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
Numero_Sender    INT,
Numero_Request    INT,
Hora              VARCHAR(250),
Request           VARCHAR(100),
Bonus              VARCHAR(250),
Id_user             INT,
Numero               INT,
Sobre                 VARCHAR(200),
Interesse                VARCHAR(100),
FOREIGN KEY (Id_user) REFERENCES usuarios(Id_user) ON DELETE CASCADE ON UPDATE NO ACTION





    );
    CREATE TABLE Games(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    id_user  INT,
    Pontos  INT,
     Game   VARCHAR(40),
     FOREIGN KEY (id_user) REFERENCES usuarios(id_user) ON DELETE CASCADE ON UPDATE NO ACTION
    
    
    );
    
    CREATE TABLE GrupoMsg(
        id   INT PRIMARY KEY AUTO_INCREMENT,
        id_msg  INT,
        Numero INT,
      Mensagem   TEXT,
      Ficheiro   VARCHAR(250),
      Hora        VARCHAR(120),

        
       FOREIGN KEY  (id_msg) REFERENCES Grupo(id) ON DELETE CASCADE ON UPDATE NO ACTION
        
        );
        
        CREATE TABLE Membros(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    id_grupo  INT,
    Numero INT,
   Bonus   VARCHAR(40),
    
   FOREIGN KEY  (id_grupo) REFERENCES Grupo(id) ON DELETE CASCADE ON UPDATE NO ACTION
    
    );
    
    CREATE TABLE NotificacaoView(
id   INT PRIMARY KEY AUTO_INCREMENT,
id_viewer  INT,
id_notificacao INT,
Estado    VARCHAR(40)


);

CREATE TABLE Bloqueio(

id INT PRIMARY KEY AUTO_INCREMENT,
id_bloqueiado    INT,
id_bloqueiador    INT

);

CREATE TABLE CallChat(
id   int primary key AUTO_INCREMENT,
sender   int,
recipie   int,
time       varchar(100),
disponibilidade varchar(5)


);

CREATE TABLE followers (
id    INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
Follower   INT,
Followed   INT

);

CREATE TABLE GameDeDois(
id    INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_convidado    INT,
id_convite      INT,
Tempo_Jogo      VARCHAR(250),
Estado          VARCHAR(100),
Dado1           VARCHAR(10),
Dado2           VARCHAR(10),
Dado3           VARCHAR(10),
Dado4           VARCHAR(10),
Dado5           VARCHAR(10),
Dado6           VARCHAR(10),
Dado7           VARCHAR(10),
Dado8           VARCHAR(10),
Dado9           VARCHAR(10),
whoPlays        INT
);