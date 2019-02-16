# Blog symfony 
### SMLALI Achraf
### DJARALLAH BRAHIM

fonctionalite:

  - crud sur les article
  - crud sur les utilisateur
  - authentification
  
Configuration de la base de données:
- Configurer la BDD (dans le fichier .env) `DATABASE_URL=mysql://DBUsername:DBPassword@DBUrl:3306/DBName`
- Configurer la BDD de Test (dans le fichier phpunit.xml.dis) 
`<env name="DATABASE_URL" value="mysql://DBUsername:DBPassword@DBUrl:3306/DBNameTEST" />`
- pour charger les données executer : 
    `php bin/console doctrine:fixtures:load`

vous pouvez utiliser le compte suivant pour se connecter:
username : admin , password : admin