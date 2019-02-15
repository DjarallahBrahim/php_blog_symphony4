# Blog symfony 
### SMLALI Achraf
### DJARALLAH BRAHIM

fonctionalite:

  - crud sur les article
  - crud sur les utilisateur
  - authentification
  
Configuration de la base de données:
- Configurer la connexion à la BDD (dans le fichier .env) "DATABASE_URL=mysql://DBUsername:DBPassword@DBUrl:3306/DBName"
- pour charger les données executer : 
    `php bin/console doctrine:fixtures:load`

vous pouvez utiliser le compte suivant pour se connecter:
username : admin , password : admin