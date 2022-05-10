# Sample API (Movie database api)

This is a simple RESTful API around a movie database (database/sqlite), that calls a 3rd party API service if the movie does not exist locally.

If a result is found in the 3rd party API, then it stores the results in the local database and return a match to the user.

The local restful API has the following endpoints:

### Movies

- `GET` `/api/movies` that supports pagination
  - Optional request params:
    - `title`
    - `year`
    - `actor`
  - Returns a collection of movies that match the requested criteria with their associated actors, genres and notes

## Installation:

### PHP 8.1 for GNU/Linux
```bash
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php -y
sudo apt-get update
sudo apt-get install composer php8.1-cli php8.1-dev php8.1-xml php8.1-mbstring php8.1-curl php8.1-pcov php8.1-gd php8.1-sqlite3 sqlite3
sudo pecl install pcov
```

### Setup
``` bash
$ composer install
$ touch database/database.sqlite
$ php artisan migrate:fresh
```

## Database Seeding:

When running the `UserSeeder` this will create a user account that can be used with the api, the details will be sent to std out.

For example:
```bash
User created with email address: angela.johns@rice.net
User created with password: ',>o$%Zn)=</comment>
User api auth header: Bearer 1|qnfsOch4SsPryY8q9iNmwSN1cvHBaXi3HmdHAiZK
```

``` bash
$ php artisan db:seed --class=UserSeeder
```

## Running the in built server:

```bash
$ php artisan serve
```

## Authenticating with the API:

There are two api endpoints `/api/register` and `/api/login`

`POST : /api/register`

Body:

```
- name
- email
- password
```

Response:

```
- token
- type
```

`POST : /api/login`

Body:

```
- email
- password
```

Response:

```
- token
- type
```

## Examples

To get a movie, where title is Rocky
```bash
curl --location --request GET 'http://localhost:8000/api/movies?title=Rocky' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer Cvd5aNu71Uvf6GAe87C5a3wZaSXkFuFPxMhOldYY'
```