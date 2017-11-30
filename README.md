# jeanlorem.io

## Dump DB MySQL
Le fichier .sql contenant les données publiques de la DB est disponible à l'emplacement *jeanlorem_v1.0.0\resources\dump_db_sql*.

## Présentation
Jean Lorem est un générateur de texte aléatoire ... sauf qu'en lieu et place du classique lorem ipsum, il utilise les blagues et citations de Jean, le doyen de ma promotion à la 3WA qui nous a toujours épaté par ses envolées lyriques (bon certes, ce n'est pas toujours très fin et ce ne sera pas au goût de tous mais bon !).

L'utilisateur peut générer du texte rapidement en fonction de ses propres choix (nombre de paragraphes, type de titres (h1, h2 ...), balises <p>, contenu tous publics ou adulte).
L'administrateur (Jean, moi-même ou un tiers) peut accéder aux fonctionnalités de visualisation, d'ajout, d'édition et de suppression de blagues/citations.

## Technique
* Côté générateur :
Je voulais que l'utilisateur puisse cliquer autant de fois qu'il le souhaite sur le bouton "Générer" sans que cela génère un rechargement de page.
J'ai donc décidé de récupérer les blagues et citations contenues dans la DB dans un fichier JSON via la fonction native PHP *json_encode()*.
J'ai ensuite travaillé en JS (avec de l'AJAX) pour récupérer les blagues/citations dans le fichier *jokes.json* en fonction des choix utilisateur.
La construction du textarea dynamique se fait avec la fonction *buildRandomJeanLorem()*.

* Côté panel admin :
Je me suis entraîné à travailler avec la variable globale *$_SESSION*. 
J'ai fait un maximum de traitement PHP afin de vérifier les entrées utilisateur.

* Librairies :
J'ai choisi de m'entraîner avec jQuery sur ce projet afin de mesurer les différence avec du JS vanilla et j'ai fait des essais avec des plugins notamment pour la validation des formulaires en temps réel afin d'améliorer l'expérience utilisateur (avant les "purs" traitements PHP s'exécutant en validant les formulaires).
J'ai utilisé Bootstrap 3 pour avoir un site responsive de manière efficace et rapide ainsi que pour la mise en forme du menu, des formulaires et du tableau admin.

## Site web online
https://jeanlorem.io/