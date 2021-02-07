# apitest

api test for Futurescape Technologies

Technology used

-   Laravel
-   MySQL

## Installation

Clone this repo and cd into folder

copy .env-example to .env

#### Install Package

```bash
    composer install
```

### Database Setup

1. Create new database and update connection details in .env
2. Create Migration

```bash
    php artisan migrate
```

#### API Endpoint List

1. http://localhost:8000/api/register
2. http://localhost:8000/api/login
3. http://localhost:8000/api/logout
4. http://localhost:8000/api/post/create
5. http://localhost:8000/api/feedback/like
6. http://localhost:8000/api/feedback/dislike
7. http://localhost:8000/api/feedback/comment
8. http://localhost:8000/api/subscription/follow
9. http://localhost:8000/api/subscription/unfollow
