# Time capsules project

Time capsules project is a web application which allows you to store time capsule, close them and reopen them after an amount of time.

## Installation

Get the repo
`git clone https://github.com/botflux/capsule.git`

Download back-end dependencies
`composer install`

Download front-end dependencies
`yarn install`

Edit the .env files to add your database
`DATABASE_URL=mysql://DB_USER:DB_PASSWORD@127.0.0.1:3306/DB_NAME`

Run bin/console commands to update your database
`php bin/console doctrine:migrations:migrate`

Run yarn file watcher
`yarn encore dev --watch`

Run devlopment server
`php bin/console server:run`