BONJOUR et MERCI d'utiliser cet outil qui j'espère vous sera utile . 


La configuration est simple :

Avant toute chose lancez : WB_start.php

CONFIGURATION :

1) Si vous avez créé une base de donné avec l'outil que vous voulez ! 
et que vous disposez de son nom Wilbert créera les tables nécessaires dessus il vous suffit de lui communiquez :

	son adresse / HOST 
	Le nom que vous lui avez donné ! 
	le nom d'utilisateur 
	et le mot de passe ! 

Si ce n'est pas le cas sachez que Wilber créera automatiquement la base de donné associé au nom que vous avez renseigné si elle n'éxiste pas.

Notez l'option très sympathique auto-fill localhost/default qui vous permet dans le cas de l'utilisation d'un logiciel comme W.A.M.P par exemple d'accélerer le procéssus de liaison en remplissant d'avance les paramètres standard . 
Vous n'avez dans ce cas qu'a rentré le nom de la base de donnée.

Si la connexion s'effectue avec succès un message apparait et un fichier de configuration qui contient un objet PDO bien configuré 
apparait .
Vous êtes redirigé vers la page WB_sql.deploy.php
_____________________________________________________________

2)Cette page va se charger de créer automatiquement les tables nécessaire à l'utilisation des classes php pour vous . 

Vous n'avez rien à faire . 

Si l'opération se déroule avec succès vous voyez normalement un message vous indiquant que tout c'est bien passé ! et vous pouvez voir un bouton vous indiquant que vous pouvez fermer cet onglet .

Si vous cliquez dessus vous serez redirigé vers : WB_accueil.php


UTILISATION DE WILBER:

-------------------------------------------------------------

L'utilisation de Wilber est très simple encore plus particulièrement si vous êtes un développeur confirmé : 

1) Assurer vous d'inclure dans l'en tête le fichier "Wilber.php" avec cette instruction par exemple : 

	require "Wilber.php";

2) Instanciez dans l'en tête du fichier un nouveau "Manager" avec le nom qui vous plaira en l'occurence j'ai choisit "gestionnaire data" 
"Cet objet contient toutes les méthodes inhérentes au traitement des données"

	$gestionnaire_data = new dataManager($pdo, $_POST);

3) A l'endroit ou vous souhaitez insérer le formulaire de votre choix (commentaire , article , contact) utiliser les lignes de codes suivantes : 

	$gestionnaire_data->add_treatment(comment::generate_form()); // pour les commentaire
	
	$gestionnaire_data->add_treatment(article::generate_form()); // pour les articles 
	
	$gestionnaire_data->add_treatment(contact::generate_form()); // pour les formulaires de contact (fonctionnalité en cours de développement)

	 
Afficher les infos depuis la base de donnée !
-------------------------------------------------------------

1) Ces trois fonctions permettent d'afficher les commentaire stocké dans la base de donné à l'endroit ou il vous plaira sur le site, ainsi que les vignettes de vos articles , par default si vous cliquez dessus vous serez rediriger vers la page d'affichage d'article de demonstration de Wilber . Dans un futur proche vous pourrez ajouter l'url de la page ou vous souhaitez voir afficher ces articles .

N'oubliez pas qu'un gestionnaire de donnée devra toujours êtres déclaré une fois avant de pouvoir utiliser ces fonctions dans L'exemple actuel je rappel que je choisis de le nommer $gestionnaire_data ce qui donne : $gestionnaire_data = new dataManager($pdo, $_POST);


	   $gestionnaire_data->show_all_comment(); // Permet d'afficher tous les commentaires stocké avec une hauteur maximal définit et une barre de défilement
	   $gestionnaire_data->show_all_article_thumbnail(); // Permet d'afficher les miniatures des articles
	   $gestionnaire_data->show_an_article(); // Permet d'afficher l'article entier .


Exemple :
----------

Le fichier WB_accueil.php peut être lancé pour voir l'utilisation de Wilber en pratique après l'étape de configuration .Cependant Wilber étant malin si vous outrepassez l'étape préalable il vous redirigera vers WB_start.php automatiquement . 


Amusez vous bien !
Et Bon codage à tous.
