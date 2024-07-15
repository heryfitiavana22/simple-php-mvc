# simple-php-mvc

This is a simple To-Do List application built using native `PHP` with an `MVC` architecture and `Eloquent ORM`.

## Features

- [x] **MVC Architecture**: Separation of concerns with distinct models, views, and controllers.
- [x] **Routing System**: Custom routing system similar to Laravel's routing.
- [x] **Eloquent ORM**: Database interactions are handled using Eloquent ORM.
- [x] **Environment Configuration**: Sensitive data is managed using `.env` file.
- [ ] **Validation**: Add server-side validation for form inputs.
- [ ] **CSRF Protection**: Implement Cross-Site Request Forgery protection.

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/your-username/your-repository.git
    cd your-repository
    ```

2. Install dependencies:
    ```sh
    composer install
    ```

3. Copy the example .env file and update the database configuration:
    ```sh
    cp .env.example .env
    ```
    Edit the `.env` file with your database credentials:

    ```env
    DB_DRIVER=mysql
    DB_HOST=127.0.0.1
    DB_DATABASE=db_name
    DB_USERNAME=username
    DB_PASSWORD=password
    DB_CHARSET=utf8
    DB_COLLATION=utf8_unicode_ci
    DB_PREFIX=
    ```

4. Run migrations to create the database tables:
    ```sh
    php migrate.php
    ```

5. Start the PHP built-in server:
    ```sh
    php -S localhost:8000
    ```

6. Open your browser and navigate to `http://localhost:8000` to see the application in action.

## Usage

- **List Tasks**: Go to `/tasks` to see all tasks.
- **Create Task**: Go to `/tasks/create` to create a new task.
- **Edit Task**: Go to `/tasks/edit?id={task_id}` to edit a task.
- **Delete Task**: Go to `/tasks/delete?id={task_id}` to delete a task.

## Dependencies

- [illuminate/database](https://github.com/illuminate/database)
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv)

