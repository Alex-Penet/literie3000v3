create Database literie3000

use literie3000;

create table matelas
(
id INT  auto_increment,
marque Varchar(255),
image Varchar(255),
dimension  Varchar(255),
prix int,
prix_promo int,

PRIMARY KEY (id)
);

insert into matelas
(marque, image, dimension_id, prix,prix_promo)
VALUES
("emma","matelas-emma.jpg","90 X 190",759,529),
("dreamway","matelas-dreamway.jpg","90 X 190",809,709),
("bultex","matelas-bultex.jpg","140 X 190",759,529),
("emma","matelas_emma(2).webp","160 X 200",1019,509);

