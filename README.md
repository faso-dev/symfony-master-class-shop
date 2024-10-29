# Symfony Shop Project

This is a Symfony-based project for managing an online shop.

## Requirements

- PHP 8.2 or higher
- Composer
- Symfony CLI (optional but recommended)

## Installation

1. **Clone the repository:**

    ```bash
    git clone git@github.com:faso-dev/symfony-master-class-shop.git
    cd symfony-shop
    ```

2. **Install PHP dependencies:**

    ```bash
    composer install
    ```

3. **Set up environment variables:**

    Copy the `.env` file and adjust the environment variables as needed:

    ```bash
    cp .env .env.local
    ```

4. **Set up the database:**

    Update your database configuration in the `.env.local` file, then run:

    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

5. **Create admin user:**

    ```bash
    php bin/console app:create-admin
    ```

## Running the Application

To start the Symfony server, run:

```bash
symfony serve
```

Then, open your browser and go to `http://localhost:8000`.
