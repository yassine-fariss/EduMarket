<div align="center">
  <h1>📚 EduMarket</h1>
  <p><strong>Plateforme e-commerce éducative — Laravel 13 + Bootstrap 5</strong></p>
  <p>
    <img src="https://img.shields.io/badge/Laravel-13.8-FF2D20?style=flat-square&logo=laravel" alt="Laravel">
    <img src="https://img.shields.io/badge/PHP-^8.3-777BB4?style=flat-square&logo=php" alt="PHP">
    <img src="https://img.shields.io/badge/Bootstrap-5-7952B3?style=flat-square&logo=bootstrap" alt="Bootstrap">
    <img src="https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql" alt="MySQL">
    <img src="https://img.shields.io/badge/Locale-Français-0055A4?style=flat-square" alt="Locale">
  </p>
  <p>
    <a href="#features">Fonctionnalités</a> •
    <a href="#quick-start">Installation</a> •
    <a href="#architecture">Architecture</a> •
    <a href="#admin-panel">Administration</a> •
    <a href="#screenshots">Captures d'écran</a>
  </p>
</div>

---

**EduMarket** est une plateforme e-commerce spécialisée dans la vente de fournitures scolaires, livres, calculatrices, matériel pédagogique et produits éducatifs. Développée avec Laravel 13 et Bootstrap 5, elle offre une expérience utilisateur complète avec un catalogue de 100+ produits répartis en 12 catégories, un panier session-based, un checkout sécurisé, et une interface d'administration complète.

---

## ✨ Fonctionnalités

### 🛍️ Côté Client
| Module | Détails |
|--------|---------|
| **Boutique** | Catalogue avec filtres (catégorie, prix, recherche, stock) |
| **Fiche produit** | Image, description, prix, stock, quantité, produits similaires |
| **Catégories** | Listing complet avec nombre de produits |
| **Panier** | Session-based (invité + connecté), mise à jour AJAX, badge navbar |
| **Checkout** | Formulaire de commande avec nom, téléphone, ville, adresse |
| **Commandes** | Historique avec statuts et détails |
| **Pages** | Accueil, À propos, Contact |

### 🔧 Administration
| Module | Détails |
|--------|---------|
| **Tableau de bord** | Statistiques (produits, catégories, clients, commandes), revenus mensuels, graphique Chart.js, produits les plus vendus, stock faible |
| **Produits** | CRUD complet avec upload image (JPEG/PNG/WebP), génération automatique de slug, filtres |
| **Catégories** | CRUD avec slug auto, suppression bloquée si produits liés |
| **Commandes** | Liste avec recherche et filtres (statut, dates), détail client + produits, mise à jour statut, facture imprimable |

### 🛡️ Sécurité
- Authentification Laravel Breeze (Blade stack)
- Middleware `AdminMiddleware` avec guard `admin` (403)
- Validation des types de fichiers image
- Protection contre les doublons de commande (fenêtre 5 min)
- Transactions SQL pour la déduction de stock

---

## 🚀 Quick Start

```bash
# 1. Cloner le projet
git clone <url-du-repo> edumarket
cd edumarket

# 2. Configuration de l'environnement
copy .env.example .env
# Éditer .env : DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 3. Dépendances
composer install
npm install

# 4. Générer la clé
php artisan key:generate

# 5. Base de données
php artisan migrate --seed

# 6. Assets
npm run build

# 7. Lancer le serveur
php artisan serve

# 8. Ouvrir dans le navigateur
# http://localhost:8000
```

### Identifiants de test

| Rôle | Email | Mot de passe |
|------|-------|-------------|
| **Admin** | `admin@edumarket.com` | `password` |
| **Client** | `client@edumarket.com` | `password` |

---

## 🏗️ Architecture

```
EduMarket/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/       # Dashboard, Catégories, Produits, Commandes
│   │   │   ├── Auth/        # Breeze authentication
│   │   │   ├── Cart/        # Panier session-based
│   │   │   ├── Checkout/    # Commande + confirmation
│   │   │   ├── Order/       # Historique client
│   │   │   ├── Product/     # Catalogue + détail
│   │   │   └── Page/        # Accueil, À propos, Contact
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   ├── Models/               # User, Category, Product, Order, OrderItem
│   ├── Services/
│   │   └── CartService.php   # Logique métier du panier
│   └── View/Components/      # Layouts App, Guest, Admin, Customer
├── database/
│   ├── factories/            # ProductFactory (100+ templates réels)
│   ├── migrations/           # 7 migrations
│   └── seeders/              # Admin + 19 users + 12 catégories + 100 produits
├── resources/views/
│   ├── admin/                # Dashboard, CRUD produits/catégories/commandes
│   ├── shop/                 # Listing + détail produit
│   ├── cart/                 # Panier
│   ├── checkout/             # Formulaire + confirmation
│   ├── components/           # 20+ composants Blade réutilisables
│   └── layouts/              # 4 layouts (app, admin, guest, customer-nav)
└── routes/
    └── web.php               # Toutes les routes
```

### Schéma de la base de données

```
┌─────────────┐       ┌──────────────┐
│    users    │       │  categories  │
├─────────────┤       ├──────────────┤
│ id          │       │ id           │
│ name        │       │ name         │
│ email       │       │ slug         │
│ password    │       │ description  │
│ is_admin    │       │ timestamps   │
│ timestamps  │       └──────┬───────┘
└──────┬──────┘              │
       │                     │ has many
       │ has many            │
       │              ┌──────▼───────┐
       │              │   products   │
       │              ├──────────────┤
       │              │ id           │
       │              │ title        │
       │              │ slug         │
       │              │ description  │
       │              │ price        │
       │              │ stock        │
       │              │ image        │
       │              │ category_id  │◄────────┘
       │              │ status       │
       │              │ timestamps   │
       │              └──────┬───────┘
       │                     │
       │                     │ has many
       │              ┌──────▼──────────┐
       │              │   order_items   │
       │              ├─────────────────┤
       │              │ id              │
       │              │ order_id        │
       │              │ product_id      │◄────────┘
       │              │ price           │
       │              │ quantity        │
       │              │ subtotal        │
       │              │ timestamps      │
       │              └──────┬──────────┘
       │                     │
       │              ┌──────▼──────────┐
       └──────────────┤     orders     │
                      ├────────────────┤
                      │ id             │
                      │ user_id        │◄────────┘
                      │ order_number   │
                      │ total          │
                      │ status         │
                      │ full_name      │
                      │ phone          │
                      │ city           │
                      │ shipping_addr  │
                      │ notes          │
                      │ timestamps     │
                      └────────────────┘
```

---

## 🧪 Catalogue Produits

100 produits réels répartis en 12 catégories :

| Catégorie | Produits |
|-----------|----------|
| 📖 Livres | Manuels scolaires, dictionnaires, Bescherelle, Atlas |
| 🎓 Manuels Universitaires | Économie, Droit, Médecine, Informatique, Marketing |
| ✏️ Fournitures Scolaires | Stylos, cahiers, classeurs, trousses, crayons |
| 🧮 Calculatrices | Casio, Texas, NumWorks, HP — scientifique à graphique |
| 🎨 Outils de Dessin | Crayons aquarelle, pastels, Posca, toiles, pinceaux |
| 🔬 Kits Pédagogiques | Robotique, chimie, microscope, télescope, Arduino |
| 📄 Papeterie | Ramettes, enveloppes, blocs, carnets, chemises |
| 🏫 Matériel de Classe | Tableaux, horloges, pupitres, affichages |
| ⚗️ Sciences & Expériences | Microscope, télescope, kits chimie, ADN, météo |
| 🌐 Langues Étrangères | Assimil (anglais, espagnol, allemand), dictionnaires |
| 💻 Informatique | PC portable, claviers, souris, USB, routeurs |
| 🖌️ Arts Créatifs | Acrylique, gouache, pâte à modeler, origami, mosaïque |

---

## 🛠️ Stack Technique

| Domaine | Technologie |
|---------|-------------|
| **Backend** | Laravel 13.8 (PHP ^8.3) |
| **Frontend** | Blade, Bootstrap 5, Chart.js, Bootstrap Icons |
| **Build** | Vite, PostCSS, Laravel Breeze |
| **Base de données** | MySQL (configurable via `.env`) |
| **Authentification** | Laravel Breeze Blade stack |
| **Locale** | Français — traduction complète (`lang/fr/`) |
| **Stockage images** | `storage/app/public/products/` + URLs distantes |

---

## 📦 API & Points d'entrée

### Routes principales

| Méthode | URI | Description |
|---------|-----|-------------|
| `GET` | `/` | Accueil |
| `GET` | `/shop` | Catalogue avec filtres |
| `GET` | `/shop/{slug}` | Détail produit |
| `GET/POST` | `/cart` | Panier |
| `GET/POST` | `/checkout` | Commande |
| `GET` | `/orders` | Historique client |
| `GET/POST` | `/admin/dashboard` | Admin |
| `GET/POST` | `/admin/products` | CRUD produits |
| `GET/POST` | `/admin/categories` | CRUD catégories |
| `GET/POST` | `/admin/orders` | Gestion commandes |
| `GET` | `/admin/orders/{id}/invoice` | Facture imprimable |

---

## 📋 Prérequis

- **PHP** ^8.3
- **Composer** 2.x
- **MySQL** 8.0+
- **Node.js** 18+ (pour Vite)
- Extensions PHP requises : `BCMath`, `Ctype`, `Fileinfo`, `JSON`, `Mbstring`, `OpenSSL`, `PDO`, `Tokenizer`, `XML`

---

## ⚠️ Limitations

- PHP 8.3+ requis (non compatible 8.2)
- Pas de passerelle de paiement intégrée
- Pas de notifications email
- Pas de système de notation / avis
- Français uniquement
- Pas de suite de tests automatisés

---

## 🔮 Évolutions possibles

- [ ] Intégration Stripe / PayPal
- [ ] Notifications email (confirmation, expédition)
- [ ] Avis et notes sur les produits
- [ ] Liste de souhaits
- [ ] Système de coupons et réductions
- [ ] Facture PDF téléchargeable
- [ ] Galerie multi-images par produit
- [ ] API REST pour application mobile
- [ ] Tests automatisés (Pest / PHPUnit)
- [ ] Configuration Docker / Laravel Sail

---

<div align="center">
  <p>
    <strong>EduMarket</strong> — Projet de soutenance<br>
    Développé avec Laravel 13 • Bootstrap 5 • MySQL
  </p>
</div>
