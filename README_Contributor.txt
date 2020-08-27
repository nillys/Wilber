CONVENTION EN VIGUEUR POUR L'UTILISATION GIT DU PROJET 

chaque nouveau commit reçoit en titre : Le but requis pour passer à la version suivante : 

ex: Implementer la fonctionnalité de ARTICLE

Un tableau à trois colonne : la première valeur étant le numéro de la version à partir de la quelle est éffectué l'amérlioration , la deuxième : étant la valeur actuel , la troisième étant le numéro de version corespondant au travail voulant être apporté . 

ex: 0.0.07 -> 0.0.09 => 0.0.10

Un tableau aux nombre de colonnes indéterminé présentant un apperçu pratique et simple des diférrentes thématiques propre au logiciel ayant été amélioré au cours du dernier travail. Le plus indiquant en proportion l'amélioration apporté pour chaque catégorie

Voici le glossaire de la terminologie : 

FUNC : fonctionnalités 

DOC : Documentation

FILE : Toute modification apporté sur la structure des dossiers et fichiers

MODULAR : La capacité du logiciel a être facilement amélioré , maintenu , sa modularité , la façon dont il codé

ORG : Organisation , Convention , méthode 

ex : [ Func.++ | DOC . + | File . ++ | Modular . ++ | ORG . +]


Ensuite par CATEGORIE les AMELIORATIONS sont listé séparé par un simple espace , puis suivit par : LES POINTS A AMELIORER pour atteindre l'objectif relatif à la version suivante sont listé avec ce symbole ->/

================================================================================
*/FILE // nom de la catégorie

// LISTES DES POINTS EFFECTUE

Décomposition des classes data en plusieurs sous classes afin de
faciliter la lisibilité et la maintenance du logiciel.

Creation d'un nouveau fichier WB_SHOW_ARTICLE qui va servir à afficher
les articles

Création d'un dossier Post_images servant à receptionner le contenu
afférant aux différents envoi d'image .




->/ Il faudra renomer le fichier exemple en : WB_accueil.php

->/ Travailler sur les conventions de nomage des fichiers et sur le nom
des fichiers thèmes css de wilber


Le symbole ? -> veut dire que ce a quoi il est fait référence s'est vu documenté et ajouté (probablement dans le README) , ce qui suit ce symbole est juste une courte description et est indenté.

