<h1 align="center">
  Template PHP
</h1>

<p align="center">
    <del><a role="link" aria-disabled="true">Voir la démo</a></del>
    ·
    <a href="https://github.com/eliotmasset/template-php/issues/new/choose">Reporter un Bug</a>
    ·
    <a href="https://github.com/eliotmasset/template-php/issues/new/choose">Proposer une feature</a>
</p>

<p align="center">
<i>Tu aimes ce travail ? Tu peux m'aider en <a href="https://paypal.me/eliotmasset/10">donnant</a>  💸 un petit pourboir ;)</i>
</p>

<p align="center">
<a href="https://www.paypal.me/eliotmasset"><img src="https://img.shields.io/badge/support-PayPal-blue?logo=PayPal&style=flat-square&label=Donate" alt="sponsor github template PHP"/>
</a>
</p>

#### Fatigué de refaire ton code PHP à la main ?

Cette template te fournie plusieurs fonctionnalité comme un routeur ou un logger simplifié.

## 🚀 Démo

<a role="link" aria-disabled="true">
  Non disponible
<!--<img src="https://img.shields.io/website?url=https%3A%2F%2Frahuldkjain.github.io%2Fgh-profile-readme-generator&logo=github&style=flat-square" />-->
</a>

## 🧐 Fonctionnalités

- **Apache2 conf**

- **Routeur**

- **Model MVC**

## 🛠️ Etapes d'installation

1. Clone le repo

```bash
git clone https://github.com/eliotmasset/template-php
```

2. Change de dossier

```bash
cd template-php
```

3. Installe les dépendences

```bash
sudo apt-get install apache2 php
sudo a2enmod rewrite && sudo service apache2 restart
```

4. Change l'adresse de ton localhost

/etc/apache2/apache2.conf
```conf
<Directory /path/to/template-php>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>
```


/etc/apache2/sites-available/000-default.conf 
```conf
- DocumentRoot /var/www/html
+ DocumentRoot /path/to/template-php
```

5. Démarre apache2

```bash
sudo service apache2 start
```

6. Ouvre ton navigateur et va sur "https://localhost"

PS: version PHP >= 8.0

🌟 Tout est bon!

## 🍰 Contribution

Vous pouvez contribuer en utilisant [GitHub Flow](https://guides.github.com/introduction/flow). Créez une branche, faites des commits, et [ouvrez une pull request](https://github.com/eliotmasset/template-php/compare).

## 💻 Créer avec

- [PHP](https://www.php.net/)
- [Apache2](https://httpd.apache.org/)

<!--## 🙇 Remerciements-->

## 🙇 Sponsors

Je vous attends

<hr>
<p align="center">
Developpé en France 🇫🇷 !
</p>

<h1 align="center">
  Template PHP
</h1>

<p align="center">
    <del><a role="link" aria-disabled="true">View the demo</a></del>
    ·
    <a href="https://github.com/eliotmasset/template-php/issues/new/choose">Report a Bug</a>
    ·
    <a href="https://github.com/eliotmasset/template-php/issues/new/choose">Ask a feature</a>
</p>

<p align="center">
<i>You like my work ? You can help me by <a href="https://paypal.me/eliotmasset/10">donnating</a>  💸 ;)</i>
</p>

<p align="center">
<a href="https://www.paypal.me/eliotmasset"><img src="https://img.shields.io/badge/support-PayPal-blue?logo=PayPal&style=flat-square&label=Donate" alt="sponsor github template PHP"/>
</a>
</p>

#### Tired by remake each time your php code ?

This template give you many features, like a router or a logger.

## 🚀 Demo

<a role="link" aria-disabled="true">
  Unavailable
<!--<img src="https://img.shields.io/website?url=https%3A%2F%2Frahuldkjain.github.io%2Fgh-profile-readme-generator&logo=github&style=flat-square" />-->
</a>

## 🧐 Features

- **Apache2 conf**

- **Router**

- **MVC Model**

## 🛠️ Installation Steps

1. Clone the repo

```bash
git clone https://github.com/eliotmasset/template-php
```

2. change directory

```bash
cd template-php
```

3. Install dependencies

```bash
sudo apt-get install apache2 php
```

4. Modify the localhost address

/etc/apache2/apache2.conf
```conf
<Directory /path/to/template-php>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>
```


/etc/apache2/sites-available/000-default.conf 
```conf
- DocumentRoot /var/www/html
+ DocumentRoot /path/to/template-php
```

5. Load apache2

```bash
sudo service apache2 start
```

6. Open your browser and go on "https://localhost"

PS: version PHP >= 8.0

🌟 All rights !

## 🍰 Contributing

You can contribute with [GitHub Flow](https://guides.github.com/introduction/flow). Create a branch, do commits, and [open a pull request](https://github.com/eliotmasset/template-php/compare).

## 💻 Create with

- [PHP](https://www.php.net/)
- [Apache2](https://httpd.apache.org/)

<!--## 🙇 Thanks-->

## 🙇 Sponsors

I'm waiting you

<hr>
<p align="center">
Developped in France 🇫🇷 !
</p>
