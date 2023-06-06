-- Active: 1681300895595@@127.0.0.1@3306@distrit
/*Afficher la liste des commandes ( la liste doit faire apparaitre la date, les informations du client, le plat et le prix )*/
/*SELECT 'date', nom_client, telephone_client, email_client, plat.libelle ,plat.prix FROM commande, plat

/*Afficher la liste des plats en spécifiant la catégorie
select plat.libelle, categorie.libelle from plat
join categorie on categorie.id=id_categorie ;

Afficher les catégories et le nombre de plats actifs dans chaque catégorie
*/select categorie.libelle,count(plat.id)from categorie join plat ON plat.id_categorie=categorie.id where plat.active="Yes" GROUP BY categorie.libelle ;

/*Ecrivez une requête permettant de supprimer les plats non actif de la base de données 
DELETE FROM plat
WHERE active = 'No'

/*Ecrivez une requête permettant de supprimer les commandes avec le statut livré
DELETE FROM commande
WHERE etat = 'Livrée'

/*Ecrivez un script sql permettant d'ajouter une nouvelle catégorie et un plat dans cette nouvelle catégorie.
insert into categorie (id, libelle, image, active) 
values (2,'Indian Food', 'indian_food.jpg', 'Yes');
insert into plat (categorie_id, libelle, description, prix, image, active)
values (2, 'Riz Indien', 'Super bon',6, 'indian_food.jpg', 'No');

