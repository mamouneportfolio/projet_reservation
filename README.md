Projet Barber Shop - Systeme de Reservation
1. Structure du projet
L'application est decomposee en deux parties principales :

Dossier /backend : Developpe avec Symfony 7. Il contient l'API REST, la logique metier, les entites (User, Service, Appointment) et la gestion de la base de donnees via Doctrine.

Dossier /frontend : Developpe avec React et Vite. Il s'agit de l'interface utilisateur stylisee pour la consultation des services et la prise de rendez-vous.

2. Instructions d'installation detaillees
Prerequisites
PHP 8.2 ou superieur

Composer

Node.js et npm

Serveur MySQL

Configuration du Backend
Accedez au dossier : cd backend

Installez les dependances : composer install

Configurez la base de donnees dans le fichier .env (voir section Variables d'environnement).

Creez la base de donnees : php bin/console doctrine:database:create --if-not-exists

Executez les migrations : php bin/console doctrine:schema:update --force

Configuration du Frontend
Accedez au dossier : cd frontend

Installez les dependances : npm install

3. Variables d'environnement necessaires
Backend (Fichier .env)
Le fichier .env à la racine du dossier backend doit contenir :

DATABASE_URL : URL de connexion (ex: mysql://root:password@127.0.0.1:3306/nom_bdd)

APP_ENV : Mode d'execution (dev ou prod)

CORS_ALLOW_ORIGIN : Doit inclure l'URL du frontend (http://localhost:5173)

Frontend
Si une variable de base est utilisee pour l'API, elle doit être definie dans un fichier .env :

VITE_API_URL : http://127.0.0.1:8001/api

4. Commandes de lancement
Environnement de Developpement (Dev)
Lancer l'API (Backend) : Dans le dossier /backend, executez symfony serve -d ou php -S 127.0.0.1:8001 -t public.

Lancer l'interface (Frontend) : Dans le dossier /frontend, executez npm run dev.

Environnement de Production (Prod)
Backend : Optimisez l'autoloader avec composer install --no-dev --optimize-autoloader.

Frontend : Generez le build statique avec npm run build. Le contenu du dossier /dist doit être servi par un serveur web (Nginx/Apache).

5. Initialisation des donnees de test
Pour tester l'application avec des donnees pre-remplies, executez les commandes SQL suivantes dans votre terminal (dossier backend) :

Compte utilisateur (Identifiants : user@test.fr / password) :
php bin/console doctrine:query:sql "INSERT INTO user (email, roles, password) VALUES ('user@test.fr', '[\"ROLE_USER\"]', '\$2y\$13\$vI8.Y9.G7G.8.7.6.5.4.3.2.1.z.y.x.w.v.u.t.s.r.q.p.o.n.m')"

Services :
php bin/console doctrine:query:sql "INSERT INTO service (name, price) VALUES ('Coupe Homme', 25), ('Taille de Barbe', 15), ('Soin Visage', 30)"
