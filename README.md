# Helpdesk Ticketing System

This Helpdesk Ticketing System is a web application built with PHP for managing customer support tickets. It allows users to create tickets, assign them to agents, track their status, and resolve issues effectively.

## Getting Started

Follow these instructions to get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Make sure you have the following installed on your machine:

- PHP 7.4 or higher
- Composer (for dependency management)
- MySQL (or any compatible database server)

### Installation

1. **Clone the repository**
    ```bash
    git clone https://github.com/cepdnaclk/e19-co328-Helpdesk-Ticketing-System.git
    cd e19-co328-Helpdesk-Ticketing-System/Helpdesk
    ```

2. **Install PHP dependencies with Composer**

    ```bash
    composer install
    ```

    This command will install all PHP dependencies listed in `composer.json`.

3. **Create a `.env` file**
    - Duplicate `.env.example` and rename it to `.env`
    - Update the database credentials (`DB_USERNAME`, `DB_PASSWORD`) in `.env` to match your local setup.

4. **Import the database schema**
    - Use your preferred MySQL client or command line to import the SQL schema.
    ```bash
    mysql -u username -p
    create DATABASE TecHub;
    use tecHub;
    source sql/techub.sql
    ```

5. **Start the PHP server**

    ```bash
    php -S localhost:8000
    ```

6. **Access the application**

    Open your web browser and navigate to `http://localhost:8000` to use the Helpdesk Ticketing System.

### Usage

- **Admin Dashboard**: Access `/admin` to manage users, tickets, and system settings.
- **Agent Dashboard**: Access `/agent` to view assigned tickets and manage ticket status.
- **Customer Dashboard**: Access `/customer` to create new tickets and view existing ones.


### Running PHPUnit Tests

1. **Configure PHPUnit**

   If PHPUnit is not globally installed, you can install it locally using Composer:
   ```bash
   composer require --dev phpunit/phpunit
   ```

2. **Run PHPUnit Tests**

    Use PHPUnit to execute the test suite. PHPUnit configuration and tests should be located in a tests/ directory.
    ```
    bash
    ./vendor/bin/phpunit
    ```

    This command runs all tests located in the tests/ directory.