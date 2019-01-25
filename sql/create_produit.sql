create table produit (
    idproduit int unsigned not null auto_increment primary key,
    designation varchar(256),
    image varchar(256),
    prix decimal(6,3),
    stock int(2)
);