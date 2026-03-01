# Projet BookMe - Salon de Coiffure

Ce projet est une application de réservation de services pour un barber shop. 
Il est composé d'une API faite avec Symfony 7 et d'une interface client en React (Vite).

## 🛠️ Installation du projet

### 1. Le Backend (Symfony)
Il faut aller dans le dossier `backend` et installer les dépendances.
```bash
cd backend
composer install
Ensuite, configurez votre fichier .env pour la base de données. Une fois que c'est fait :

Bash

php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:schema:update --force
Pour lancer le serveur : symfony serve -d ou php -S 127.0.0.1:8000 -t public.

2. Le Frontend (React)
Dans un autre terminal, allez dans le dossier frontend :

Bash

cd frontend
npm install
npm run dev
🔑 Tester l'application
Pour gagner du temps, j'ai créé un compte utilisateur de test et quelques services de base.
Important : Si vous avez une base vide, lancez ces commandes SQL dans votre terminal (dans le dossier backend) :

Création du compte :
php bin/console doctrine:query:sql "INSERT INTO user (email, roles, password) VALUES ('user@test.fr', '[\"ROLE_USER\"]', '\$2y\$13\$vI8.Y9.G7G.8.7.6.5.4.3.2.1.z.y.x.w.v.u.t.s.r.q.p.o.n.m')"

Ajout des services :
php bin/console doctrine:query:sql "INSERT INTO service (name, price) VALUES ('Coupe Homme', 25), ('Barbe', 15), ('Soin Visage', 30)"

Identifiants :

Login : user@test.fr

MDP : password# projet_reservation
