# Gite NC

## Installation de la base de donnée MySQL :
Créer un nouvelle base de données nommée : ***gitenc*** dans MySQL.

## Installation du Projet :
Copier le fichier ".env.example" et renommer le ".env" :
``` 
cp .env.example .env
``` 

Ouvrir le fichier ".env" et effectuer ces changements : 
```
APP_NAME=Gite_NC
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gitenc
```

Créer quelques données avec cette commande :
```
php artisan db:seed
```

## Lancement du Projet :
``` 
php artisan serve 
```