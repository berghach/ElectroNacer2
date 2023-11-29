CREATE DATABASE ElectroNacer;
use ElectroNacer;

CREATE TABLE adm(
    id INT NOT NULL AUTO_INCREMENT,
    e_mail varchar(20),
    psw varchar(20),
    primary key(id)
);

DESCRIBE adm;

INSERT INTO adm (e_mail,psw)
value ('first_admin@mail.com','Adm#1234');

CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT,
    e_mail varchar(20),
    psw varchar(20),
    activ_account BOOLEAN DEFAULT 0,
    primary key(id)
);

DESCRIBE user;

CREATE TABLE category(
    id INT not NULL AUTO_INCREMENT,
    cat_name varchar(100),
    cat_descr varchar(255),
    img varchar(100),
    primary key(id)
);

DESCRIBE category;

INSERT INTO category(cat_name, cat_descr, img)
VALUES
    ('Carte de Développement', 'des cartes de développement, des cartes programmeurs, Arduino, etc...', 'carte_de_développement.jpg'),
    ('Composant Electronique', 'diodes, bouttons, LED, modules, shields, capteurs, condensateur, buzzers, etc...', 'composants_électroniques.jpg'),
    ('Energie', 'battries, convertisseurs, chargeurs, etc...', 'composants_électroniques.jpg'),
    ('Moteurs', 'moteurs, régulateurs et controleurs de vitesse, roues, etc...', 'motors.jpg'),
    ('Robot & KIT', 'Raspberry Pi Robot Kit, 3D Printer Kit, Quadcopter Drone Kit, and more...', 'robot&kit.jpg'),
    ('Imprimante 3D ET Machine CNC', 'CNC Router Kit, Ultimaker 3D Printer Kit, 3D Printer, etc...', 'Imprimante_3D&CNC.jpg'),
    ('uncategorized',NULL,NULL);


CREATE TABLE product(
    ref INT not NULL primary key AUTO_INCREMENT ,
    prod_name varchar(100),
    bar_code INT(9),
    img varchar(100),
    sell_price float(2),
    final_price float(2),
    offer_price float(2),
    prod_desc varchar(255),
    min_quant INT,
    stock_quant INT,
    category_id INT,
    foreign key(category_id) references category(id)
);

DESCRIBE product;
