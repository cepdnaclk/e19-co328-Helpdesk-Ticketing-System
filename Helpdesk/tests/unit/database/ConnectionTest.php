<?php

require __DIR__ . '/../../../vendor/autoload.php'; // Include Composer's autoloader

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__. '/../../../');
$dotenv->load();

class ConnectionTest extends TestCase
{
    public function testDatabaseConnection()
    {
        $db = new mysqli('localhost', $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], 'techub');
        $this->assertNull($db->connect_error);
    }
}