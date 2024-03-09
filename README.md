# TrouveTonEvenement

- [TrouveTonEvenement](#trouvetonevenement)
  - [Description](#description)
  - [Branches \& Workflow ](#branches--workflow-)
  - [UI Theme](#ui-theme)
  - [Tech Stack](#tech-stack)
  - [Roadmap](#roadmap)
  - [Installation Instructions](#installation-instructions)
  - [License](#license)


## Description
An event publishing and booking web platform. This is a personal project intended to be used for demonstration purposes and will be the subject of videos on YouTube.

## Branches & Workflow ![GitHub last commit (by committer)](https://img.shields.io/github/last-commit/DamienVassart/TrouveTonEvenement)
You will find the specifications, the UML Diagrams and the final mockups [in this repository](https://github.com/DamienVassart/tte-preprod).\
This project will be conducted using **GitFlow** methodology. Therefore, there will always be at least 2 other branches:
- `main`, which will host the production code
- `develop`, which will host the code with the features just finished and ready to be reviewed prior to release and production.

## UI Theme
The design is based on [HTML Codex JobEntry theme](https://htmlcodex.com/job-portal-website-template/) for the front-office part and on [Start Bootstrap SB Admin theme](https://startbootstrap.com/template/sb-admin) for the back-office part. Please note that these themes may require buying a license for any commercial use.

## Tech Stack
- Back-End: ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) (v. 8) ![Symfony](https://img.shields.io/badge/symfony-%23000000.svg?style=for-the-badge&logo=symfony&logoColor=white) (v. 6.4)
- Front-End: ![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E) ![jQuery](https://img.shields.io/badge/jquery-%230769AD.svg?style=for-the-badge&logo=jquery&logoColor=white) ![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)
- Database: ![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)
- APIs & Libraries:
  - [Stripe](https://stripe.com/fr)
  - [OpenStreetMap](https://www.openstreetmap.org/)
  - [Leaflet](https://leafletjs.com/)
  - [DataTables](https://datatables.net/)
  - [TinyMCE](https://www.tiny.cloud/)
  - [select2](https://select2.org/)
  - [SweetAlert](https://sweetalert2.github.io/)
  - [Form Fields Repeater](https://www.jqueryscript.net/form/Form-Fields-Repeater.html)

## Roadmap
An up to date roadmap of the project can be seen [here](https://view.monday.com/1360435266-fc2bcf8205a4fba9938ea7d39d15d930?r=euc1)

## Installation Instructions
The installation process is valid for **UNIX** based systems. For **Windows**, it may depend on your configuration.\

`git clone`\
`cd TrouveTonEvenement`\
\
You may choose either an automatic or a manual installation.

### A. Automatic Installation
Run `make init`

This option will set **DATABASE_URL** in **.env.local** to **mysql://root@127.0.0.1:3306/tte?serverVersion=5.7**

### B. Manual Installation
1. `touch .env.local`
2. `composer install`
3. `php bin/console app:secret:generate`
4. `php bin/console app:database:define`
   - You will have to pass the following arguments:
     - database [sqlite, mysql, postgresql] - **!Required**
     - db_username - **!Required**
     - db_name (the name of the database) - **!Required**
     - server_version - **!Required**
     - [db_password] - *?optional*
     - [host] - *?optional* - default value:  127.0.0.1
     - [port] - *?optional* - default value: 3306
5. `php bin/console doctrine:database:create`
6. `php bin/console doctrine:migrations:migrate`
7. `php bin/console doctrine:fixtures:load`

*To be continued*

## License
[![GPLv3 license](https://img.shields.io/badge/License-GPLv3-blue.svg)](http://perso.crans.org/besson/LICENSE.html) This project is under **GPLv3 License**