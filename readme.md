# TestGenerator

La configuration se trouve dans le fichier à exécuter.

Dans `entry.php`, vous pouvez renseigner le template qui sera utilisé pour générer les fichiers de tests.

Dans ce template (ici `base.playplus`) il vous faut des string facilement reconnaissable pour faire du search & replace.

L'idée du générateur c'est qu'il va générer autant de fichiers qu'il est possible de créer de combinaisons quand on prend les valeurs des remplacements.

Ces remplacements doivent être défini dans le tableau `$changes`.

Le nom de chaque fichier est composé d'une combinaison de chaque valeur de remplacement. Sauf si la valeur de recherche 
se trouve dans la variable `$count_instead_of_writing_the_search`, qui va faire en sorte de compter au lieu d'afficher la valeur.

```shell
php7.2 entry.php
```

vla
