# Test - Code smells
Refactorisez les codes en expliquant votre résonnement en commentaire (2 jours) :

- 3 exos PHP
    - J'ai installé composer dans le dossier php et restructuré et renommé les dossier afin de pouvoir respecter les convention php-fig
    - Je me suis basé sur la dernière version de php8.2.5
    - J'ai installé phpstan afin de voir les eventuel erreurs. cmd :"vendor/bin/phpstan analyse app"  il y a 0 erreur en level 9..
    - Toutes mes modifications sont expliquées dans des docblocks

- 1 exo JS
    - J'ai complété et refactorisé la méthode calculateTotalKudos() afin de corrier le script. 
    - Come je l'explique dans le fichier je n'ai pas été jusqu'au bout du refacto pour rester dans le thème de l'exo a savoir la porté des déclaration de variables (si je comprend bien la notion de shadow variable)
- 1 exo SCSS
    - J'ai utilisé les variables et mixinet l'imbrication des selecteurs css afin d'avoir du code réutilisable et pour éviter d'avoir des selecteurs en doublon qui se balladent..



PS : J'ai gitignore le dossier vendor, du coup pour lancer phpstan et phpmd, lancez "composer install"
