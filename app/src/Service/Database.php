<?php

namespace Service;

use PDO;

/**
 * Class Database
 *
 * Database connection service.
 */
class Database
{
    /**
     * @var PDO Database connection object.
     */
    private $connection;

    /**
     * Database constructor.
     *
     * Connects to the database using environment variables for configuration.
     */
    public function __construct()
    {
        $dsn = "mysql:dbname=" . getenv('DATABASE_NAME') . ";host=" . getenv('PMA_HOST');
        $this->connection = new PDO($dsn, getenv('PMA_USER'), getenv('MYSQL_ROOT_PASSWORD'));
    }

    /**
     * Gets the PDO database connection object.
     *
     * @return PDO The PDO database connection object.
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}

