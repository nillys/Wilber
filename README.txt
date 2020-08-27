BONJOUR et MERCI d'utiliser cet outil qui j'espère vous sera utile . 


La configuration est simple :

CONFIGURATION :

1) Assurez vous d'avoir créé une base de donné avec l'outil que vous voulez ! 
et de disposer de 

	son adresse / HOST 
	Le nom que vous lui avez donné ! 
	le nom d'utilisateur 
	et le mot de passe ! 

Si ce n'est pas le cas sachez que Wilber créera automatiquement la base de donné associé au nom que vous avez renseigné si elle n'éxiste pas.

->	Lancer WB_start.php !

Une fennêtre s'ouvre vous invitant à renseigner ces informations . 
Si la connexion s'effectue avec succès un message apparait et un fichier de configuration qui contient un objet PDO bien configuré 
apparait . et vous êtes redirigé vers la page WB_sql.deploy.php
_____________________________________________________________

2)Cette page va se charger de créer les tables nécessaire à l'utilisation des classes php pour vous . vous n'avez rien à faire . 

Si l'opération se déroule avec succès vous voyez normalement un message vous indiquant que tout c'est bien passé ! et vous pouvez voir un bouton vous indiquant que vous pouvez fermer cet onglet . Si vous cliquez dessus vous serez redirigé vers : WB_accueil.php

UTILISATION :

Formulaire ajout base de donné , traitement des formulaires !
-------------------------------------------------------------

L'utilisation de Wilber est très simple : 

1) Assurer vous d'inclure dans l'en tête le fichier "Wilber.php" avec cette instruction par exemple : 

	require "Wilber.php";

2) Instanciez dans l'en tête du fichier un nouveau "Manager" avec le nom qui vous plaira en l'occurence j'ai choisit "gestionnaire data" 

	$gestionnaire_data = new dataManager($pdo, $_POST);

3) A l'endroit ou vous souhaitez insérer le formulaire de votre choix (commentaire , article , contact) avec l'instruction suivante exemple pour commentaire :

	$gestionnaire_data->add_treatment(comment::generate_form()); // pour les commentaire
	$gestionnaire_data->add_treatment(article::generate_form()); // pour les articles (fonctionnalité en cours de développement)
	$gestionnaire_data->add_treatment(contact::generate_form()); // pour les formulaires de contact (fonctionnalité en cours de développement)


4) Si vous le souhaitez (ce qui est vivement conseillé) vous pouvez placer directement après le formulaire(c'est pour l'instant imperatif) le retour d'info concernant le traitement du formulaire pour l'utilisateur (message d'érreur ou de succès)

	 $gestionnaire_data->show_processing_message();
	 
	 
	 
Afficher les infos depuis la base de donnée !
-------------------------------------------------------------

1) en l'occurence la seul fonction disponible pour l'instant est celle ci . elle permet d'afficher les commentaire stocké dans la base de donné à l'endroit ou il vous plaira sur le site elle requiert simplement de déclarer un gestionnaire de donné dans la page 

	   $gestionnaire_data->show_all_comment();


Exemple :
----------

Le fichier WB_accueil.php peut être lancé pour voir l'utilisation du module .
