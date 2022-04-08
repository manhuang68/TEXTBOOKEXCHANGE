
--user 
create table user
(id int unsigned not null,
email varchar(40) not null,
password varchar(40),
lastname varchar(40),
firstname varchar(40),
active_ind char(1),
date_entered timestamp not null default current_timestamp,
primary key (id));

INSERT INTO `user` (`id`,`email`,`password`,`lastname`,`firstname`,`active_ind`,`date_entered`) VALUES
(1,'123@gmail.com','123','yoga','lenovo','Y','2017-02-26 20:52:46');
--Table to store the products of a website
create table products
(id int(11) not null auto_increment,
seller_email varchar(255) not null,
seller_id int(11),
title varchar(255),
author varchar(255),
publisher varchar(255),
isbn varchar(255),
edition varchar(255),
productprice decimal(6,2),
shippingcost decimal(6,2),
conditions varchar(255),
productImage1 varchar(255),
date_entered timestamp not null default current_timestamp,
primary key (id)
);


INSERT INTO `products` (`seller_email`,`seller_id`,`title`,`author`,`publisher`,`isbn`,`edition`,`productprice`,`shippingcost`,`conditions`,`productImage1`) VALUES 
('123@gmail.com',1,'Cracking the Coding Interview','Gayle Laakmann McDowell','CareerCup','0984782850','6th Edition',26,10,'New','cracking.png'),
('123@gmail.com',1,'C Programming Language','Brian W. Kernighan','Prentice Hall','0131103628','2nd edition',51,5,'Used','C.png'),
('123@gmail.com',1,'Python for Data Analysis','Wes McKinney','O Reilly Media','1491957662','2nd Edition',28,8,'New','python.png'),
('123@gmail.com',1,'Deep Medicine','Eric Topol','Basic Books','1541644638','1st edition',14.69,6.7,'Used','medicine.jpg');

--Table to generate the invoice order
create table invoice
(id int(11) not null auto_increment,
buyer_id int(11),
seller_id int(11),
product_id int(11),
product_name varchar(255),
shipping_cost decimal(6,2),
total decimal(6,2),
date_entered timestamp not null default current_timestamp,
primary key (id)
);

--table to review history orders 
create table orders
(id int(11) not null auto_increment,
buyer_id int(11),
seller_id int(11),
product_id int(11),
invoice_number int(11),
product_name varchar(255),
author varchar(255),
publisher varchar(255),
edition varchar(255),
isbn varchar(255),
quantity int(11),
price decimal(6,2),
shipping decimal(6,2),
conditions varchar(255),
status varchar(255),
date_entered timestamp not null default current_timestamp,
primary key (id)
);

--table to add/update the address for shipping
create table address
(id int(11) not null auto_increment,
user_id int(11),
contact_name varchar(255),
country varchar(255),
street_address varchar(255),
apt_suite varchar(255),
state varchar(255),
city varchar(255),
zip varchar(255),
phone varchar(255),
date_entered timestamp not null default current_timestamp,
primary key (id)
);


-- Indexes for table `admin`
--


--ALTER TABLE `products`
 -- ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


--ALTER TABLE `products`
 -- MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

 -- https://www.fiverr.com/rajbahadur776/design-database-erd-use-case-diagrams-uml-diagrams
  --https://www.semanticscholar.org/paper/Challenges-in-database-design-with-Letkowski/2c5272bbbb109180d967e8e43742c89aebf795b1
  --https://www.visual-paradigm.com/VPGallery/datamodeling/EntityRelationshipDiagram.html