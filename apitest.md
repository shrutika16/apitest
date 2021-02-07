# API Test

API test for Futurescape Technologies

Technology used

-   Laravel 5.8
-   MySQL 5.6

## Installation

Clone this repo and cd into folder
```
git clone https://github.com/shrutika16/apitest.git
```

Copy env file
```
cp .env-example to .env
```

Run composer install for packages installation
```
composer install
```

## Database Migration
Create new database and run migration command to create all required tables.

```
php artisan migrate
```

## API Endpoint List

| Name | Method | Endpoint |
| - | - | - |
| /api/register | POST |  Register User |
| /api/login | POST | User account login |
| /api/logout | POST | User account logout |
| /api/post/create | POST | Create post |
| /api/feedback/like | POST | Like post |
| /api/feedback/dislik | POST | Dislike post |
| /api/feedback/commen | POST | To do comment on post |
| /api/subscription/follo | POST | Follow to users |
| /api/subscription/unfollo | POST | UnFollow to user |