# Symfony Shop Project

This is a Symfony-based project for managing an online shop.

## Requirements

- PHP 7.4 or higher
- Composer
- Node.js and npm
- Symfony CLI (optional but recommended)

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/symfony-shop.git
    cd symfony-shop
    ```

2. **Install PHP dependencies:**

    ```bash
    composer install
    ```

3. **Install JavaScript dependencies:**

    ```bash
    npm install
    ```

4. **Set up environment variables:**

    Copy the `.env` file and adjust the environment variables as needed:

    ```bash
    cp .env .env.local
    ```

5. **Set up the database:**

    Update your database configuration in the `.env.local` file, then run:

    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

6. **Install assets:**

    ```bash
    npm run dev
    ```

## Running the Application

To start the Symfony server, run:

```bash
symfony serve
```

Then, open your browser and go to `http://localhost:8000`.
