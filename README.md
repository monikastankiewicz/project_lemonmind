# project_lemonmind
Recruitment task for the lemonmind company

# Installation

## Locally
* Download project from https://github.com/monikastankiewicz/project_lemonmind.git

* Run the following commands in the project folder
```bash
composer install
npm install
npm run dev
```

* To start the local server use command
```bash
symfony serve -d
```

### Database configuration (.env file)
* In DATABASE_URL, match the parameters to your local database

* Use the following commands to create a database and migrate an existing file
```bash
php bin/console doctrine:database:create
symfony console doctrine:migrations:migrate
```
