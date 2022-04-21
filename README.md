## Setup

This project is developed using [Laravel](https://laravel.com) framework which required [PHP 7.4](https://www.php.net/downloads.php) and [Composer](https://getcomposer.org/) package dependency.

### Steps

1. Duplicate `.env.example` file and paste it into `root` folder, then rename it to `.env`.
2. Open `.env` file and make changes to the sections as follows:

```
APP_DEBUG=false
APP_URL=[Paste your URL here]

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=[Paste your database name here]
DB_USERNAME=[Paste your database username here]
DB_PASSWORD=[Paster your database password here]

MORALIS_API_KEY=[Paste your Moralis API key here]
WEB3_CHAIN=[Paste WEB3 chain here]

```

3. Install Composer package dependency and run `composer install` via `cmd` in this project.
4. Your are all set!
