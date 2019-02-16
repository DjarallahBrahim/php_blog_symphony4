# Blog symfony 
### SMLALI Achraf
### DJARALLAH BRAHIM

fonctionalite:

  - crud sur les article
  - crud sur les utilisateur
  - authentification
  
les etapes pour executer le projet:
- cree le fichier '.env' dans la racine du project avec la ligne suivant pour configurer la BDD : `DATABASE_URL=mysql://DBUsername:DBPassword@DBUrl:3306/DBName`
- Configurer la BDD de Test (dans le fichier phpunit.xml.dis) on ajoutant la lign suivante a la tag php:
`<env name="DATABASE_URL" value="mysql://DBUsername:DBPassword@DBUrl:3306/DBNameTEST" />`
- executer la cmd `composer install` pour installer les dependance.
- executer la cmd `php bin/console doctrine:database:create` pour cree la BDD
- executer la cmd `php bin/console doctrine:schema:update --force` pour cree les schema
- executer la cmd `php bin/console doctrine:fixtures:load` pour charger les données .
- executer la cmd `php bin/console server:run`

vous pouvez utiliser le compte suivant pour se connecter:
username : admin , password : admin

executer la cmd `php bin/phpunit` pour les tests