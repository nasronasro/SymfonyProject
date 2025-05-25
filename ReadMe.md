# APPLICATION CRM

## Description du Projet

Cette application est un système de gestion de la relation client (CRM) complet, conçu pour permettre aux utilisateurs de gérer efficacement leurs clients et les factures associées. Elle répond à toutes les exigences fonctionnelles et techniques spécifiées, y compris la gestion des utilisateurs (avec authentification sécurisée), la gestion des clients (avec leurs détails et leurs factures), et la gestion des factures (avec des numéros uniques, des dates, des montants et des statuts). Le projet a été développé en adhérant scrupuleusement aux meilleures pratiques de conception logicielle pour garantir une architecture robuste, maintenable, sécurisée et performante.

## Architecture et Bonnes Pratiques

L'application adhère à une architecture modulaire et est structurée autour des principes de séparation des préoccupations, ce qui facilite le développement, les tests et la maintenance. Les couches principales sont les suivantes :

- **Entity (Entité)** :
    
    - Représente les objets métier et la structure des données persistantes.
        
    - Chaque entité est une représentation claire et concise d'un concept du domaine métier, souvent mappée directement à une table de base de données.
        
    - Elles encapsulent les données et parfois des comportements métier intrinsèques à l'objet lui-même.
        
- **Repository (Dépôt)** :
    
    - Fournit une abstraction pour l'accès aux données.
        
    - Il est responsable de la persistance et de la récupération des entités, masquant les détails techniques de la base de données.
        
    - Permet une gestion propre des opérations CRUD (Create, Read, Update, Delete) et des requêtes complexes, découplant la logique métier de la logique d'accès aux données.
        
- **Service (Service)** :
    
    - Contient la logique métier principale de l'application.
        
    - Les services orchestrent les interactions entre les dépôts, les entités et d'autres composants.
        
    - Ils sont conçus pour être réutilisables et pour encapsuler des processus métier spécifiques, garantissant que les règles métier sont appliquées de manière cohérente.
        
- **Form (Formulaire)** :
    
    - Gère la validation et la manipulation des données soumises par l'utilisateur via des formulaires web.
        
    - Assure l'intégrité des données en définissant des règles de validation strictes avant que les données n'atteignent la logique métier ou la couche de persistance.
        
    - Facilite la création et le rendu des formulaires côté client et la gestion de leur soumission côté serveur.
        
- **Controller (Contrôleur)** :
    
    - Agit comme un point d'entrée pour les requêtes HTTP.
        
    - Il est responsable de la réception des requêtes, de l'appel des services appropriés pour exécuter la logique métier, et de la préparation de la réponse (souvent en rendant une vue ou en retournant des données JSON).
        
    - Les contrôleurs sont légers et se concentrent sur la gestion du flux de la requête/réponse.
        
- **Security (Sécurité)** :
    
    - Intégré à travers toutes les couches pertinentes pour protéger l'application contre les accès non autorisés et les vulnérabilités.
        
    - Cela inclut l'authentification (vérification de l'identité des utilisateurs), l'autorisation (définition des actions que les utilisateurs authentifiés peuvent effectuer), la protection contre les attaques courantes (CSRF, XSS, injection SQL), et la gestion des sessions.
        
    - Des mécanismes de sécurité robustes sont mis en place pour garantir la confidentialité et l'intégrité des données.
        

Cette structure favorise le principe SOLID, en particulier la séparation des responsabilités (Single Responsibility Principle) et l'inversion de dépendance (Dependency Inversion Principle), rendant le code plus testable, plus flexible et plus facile à faire évoluer.

## Installation et Démarrage

Pour configurer et exécuter cette application en local, suivez les étapes ci-dessous :

1. **Prérequis** :
    
    - PHP 8.x
        
    - Composer
        
    - MySQL
        
    - Docker et Docker Compose (recommandé pour l'environnement de développement)
        
2. **Cloner le dépôt** :
    
    ```
    git clone [URL_DE_VOTRE_DEPOT_GITLAB]
    cd [nom-du-répertoire-de-votre-application]
    ```
    
3. **Construction initiale de l'application (avec Docker Compose)** : Pour la première construction de l'application et la mise en place de l'environnement Docker, utilisez la commande suivante :
    
    ```
    make build
    ```
    
    Cette commande va typiquement construire les images Docker, démarrer les services (App, Webserver, DB, Phpmyadmin) et installer les dépendances.
    
4. **Installation des dépendances (si non géré par `make build`)** : Si `make build` ne gère pas l'installation des dépendances Composer ou npm/yarn, exécutez :
    
    ```
    composer install
    ```
    
5. **Configuration de l'environnement** :
    
    - Créez un fichier `.env` à la racine du projet (souvent à partir d'un fichier `.env.example`).
        
    - Configurez les variables d'environnement nécessaires (ex: `DATABASE_URL`, `APP_ENV`, etc.).
        
6. **Configuration de la base de données** :
    
    ```
    # Ex: pour Symfony/Doctrine
    php bin/console make:migration
    php bin/console doctrine:migrations:migrate
    ```
    
    _Note_ : Si vous utilisez Docker Compose, ces commandes peuvent être exécutées à l'intérieur du conteneur PHP (par exemple, `docker-compose exec app php bin/console ...`).
    
7. **Démarrage du serveur de développement** : Si vous utilisez Docker Compose, les services devraient déjà être démarrés après `make build`. Sinon, pour un environnement local sans Docker :
    
    ```
    make start
    ```
    
    L'application devrait être accessible à l'adresse `http://127.0.0.1:8000` (ou l'adresse spécifiée par votre serveur). Pour l'accès via Docker Compose, vérifiez la configuration de votre `docker-compose.yml` (souvent `http://localhost`).
    

## Monitoring

Cette application intègre des outils de monitoring pour la base de données MySQL :

- **Prometheus** : Utilisé pour la collecte et le stockage des métriques de performance de MySQL.
    
- **Grafana** : Fournit des tableaux de bord interactifs et visuellement riches pour visualiser les données collectées par Prometheus, permettant une surveillance en temps réel de la santé et des performances de la base de données.
    

La configuration spécifique de Prometheus et Grafana se trouve dans les fichiers Docker Compose et les fichiers de configuration dédiés (ex: `prometheus.yml`, `grafana/dashboards/`).

## Contribution

Les contributions sont les bienvenues ! Veuillez lire nos [lignes directrices de contribution](LIEN_VERS_CONTRIBUTING.md "null") pour plus de détails.

## Licence

**Développé avec passion et les meilleures pratiques.**"# SymfonyProject" 
