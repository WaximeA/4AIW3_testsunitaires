

# Tests unitaires

[Klaxoon](https://app.klaxoon.com/)
ZW27UE

- Test unitaire : tester une fonction par rapport à ce quelle renvoi
- Text d'intégration : vérifie le fonctionnement d'enssemble de la fonction dans le système d'exécution
- Test système : tester un scénario complet dans les même conditions que la prod
- Test d'acceptation : validation du logiciel métier par rapport aux futurs utilisateurs (ux)

- Test de montée en charge : simuler l'app avec un nombre croissant d'utilisateur pour voir ce qui pète en premier
- Stress test : simuler l'activité maximale jusqu'à ce qu'il y a une défaillance

- Test en boite noire : sans rien savoir du code ou du fonctionnement etc
- Test en boite blanche : en connaissant le fonctionnement du site, les url etc

## Un test unitaire :
- Est unitaire : il test un seul comportement
- Doit être réalisé par le dev
- Fait parti du code applicatif
- Sur un env de dev
- Il s'assure que la méthode fonctionne correctement


## Etapes d'un TU
1. Setup pour mettre en place le contexte : instanciation des objets etc
2. Calls : appel de la méthode
3. Verify : vérification du return de la méthode
4. Teardown : clean les infos du tu

## Les outils :
- php : PHPUnit
- java : JUnit
- javascript : Jasmine/Mocha

# PhpUnit

Test command : `$ vendor/bin/phpunit Test/CalculatriceTest.php`