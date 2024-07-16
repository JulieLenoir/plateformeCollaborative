#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: projet
#------------------------------------------------------------

CREATE TABLE projet(
        id_projet          Int  Auto_increment  NOT NULL ,
        titre_projet       Varchar (255) NOT NULL ,
        description_projet Varchar (255) NOT NULL ,
        date_projet        Varchar (255) NOT NULL ,
        langage_projet     Varchar (255) NOT NULL
	,CONSTRAINT projet_PK PRIMARY KEY (id_projet)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user(
        id_user       Int  Auto_increment  NOT NULL ,
        nom_user      Varchar (255) NOT NULL ,
        prenom_user   Varchar (255) NOT NULL ,
        email_user    Varchar (255) NOT NULL ,
        password_user Varchar (255) NOT NULL ,
        role_user     Bool NOT NULL
	,CONSTRAINT user_PK PRIMARY KEY (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: tache
#------------------------------------------------------------

CREATE TABLE tache(
        id_tache          Int  Auto_increment  NOT NULL ,
        nom_tache         Varchar (255) NOT NULL ,
        description_tache Varchar (255) NOT NULL ,
        statut_tache      Varchar (255) NOT NULL ,
        date_tache        Varchar (255) NOT NULL ,
        id_user           Int NOT NULL ,
        id_projet         Int NOT NULL
	,CONSTRAINT tache_PK PRIMARY KEY (id_tache)

	,CONSTRAINT tache_user_FK FOREIGN KEY (id_user) REFERENCES user(id_user)
	,CONSTRAINT tache_projet0_FK FOREIGN KEY (id_projet) REFERENCES projet(id_projet)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commentaire
#------------------------------------------------------------

CREATE TABLE commentaire(
        id_comm      Int  Auto_increment  NOT NULL ,
        content_comm Longtext NOT NULL ,
        id_projet    Int NOT NULL ,
        id_user      Int NOT NULL
	,CONSTRAINT commentaire_PK PRIMARY KEY (id_comm)

	,CONSTRAINT commentaire_projet_FK FOREIGN KEY (id_projet) REFERENCES projet(id_projet)
	,CONSTRAINT commentaire_user0_FK FOREIGN KEY (id_user) REFERENCES user(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Appartenir
#------------------------------------------------------------

CREATE TABLE Appartenir(
        id_user   Int NOT NULL ,
        id_projet Int NOT NULL
	,CONSTRAINT Appartenir_PK PRIMARY KEY (id_user,id_projet)

	,CONSTRAINT Appartenir_user_FK FOREIGN KEY (id_user) REFERENCES user(id_user)
	,CONSTRAINT Appartenir_projet0_FK FOREIGN KEY (id_projet) REFERENCES projet(id_projet)
)ENGINE=InnoDB;

