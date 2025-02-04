# Projet API Countries,News & Job Offers

Application Symfony intégrant les APIs REST Countries et NewsAPI.

## Prérequis
- PHP 8.1+
- Composer
- Symfony CLI

## Installation

```bash
# Cloner le projet
git clone https://github.com/votre-username/rest-countries-news.git
cd rest-countries-news

# Installer les dépendances
composer install

# Configurer l'environnement
cp .env.local.example .env.local
```

## Configuration

1. Obtenir une clé API sur [NewsAPI](https://newsapi.org/)
2. Modifier `.env.local`:
```
NEWS_API_KEY=votre_clé_api
```

## Démarrage

```bash
symfony serve
```
Accéder à `http://localhost:8000`

## Fonctionnalités
- Liste des pays avec drapeaux et informations
- Actualités récentes par pays
- Interface responsive

## Structure
```
src/
  ├── Controller/
  │   ├── HomeController.php
  │   └── CountryController.php
  ├── Service/
  │   ├── CountriesService.php
  │   └── NewsService.php
  └── templates/
      ├── home/
      └── country/
```

## APIs Utilisées
- [REST Countries](https://restcountries.com/)
- [NewsAPI](https://newsapi.org/)
