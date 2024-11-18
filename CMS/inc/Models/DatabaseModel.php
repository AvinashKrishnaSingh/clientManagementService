<!-- DatabaseModel.php -->
<?php

// DatabaseModel class for handling database operations
class DatabaseModel {
    private $db;

    // Constructor to establish database connection and initialize
    public function __construct() {
        try {
            // Establish database connection
            $this->db = new PDO("mysql:host=localhost", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if the database and required tables exist
            $this->setupDatabase();
        } catch (PDOException $e) {
            // Handle database connection or query errors
            echo "Error: " . $e->getMessage();
        }
    }

    // Getter method for accessing the database connection
    public function getDb() {
        return $this->db;
    }

    // Function to set up the database
    public function setupDatabase() {
        // Create the serviceswift database if it does not exist
        $this->createDatabase();
    
        // Select the serviceswift database
        $this->selectDatabase();
    
        // Create the required tables if they do not exist
        $this->createTables();
    }
    
    // Function to create the database
    public function createDatabase() {
        $stmt = $this->db->query("CREATE DATABASE IF NOT EXISTS clientManagementSystem");
    }

    // Function to select the database
    public function selectDatabase() {
        $this->db->query("USE clientManagementSystem");
    }

    // Function to create tables
    public function createTables() {
        // SQL code for creating tables
        $sql = "
            -- Table structure for table `users`
            CREATE TABLE IF NOT EXISTS `users` (
                `first_name` varchar(50) NOT NULL,
                `last_name` varchar(50) NOT NULL,
                `email` varchar(100) NOT NULL,
                `telephone` varchar(20) NOT NULL,
                `username` varchar(50) NOT NULL,
                `password` varchar(255) NOT NULL,
                `address` varchar(255) NOT NULL,
                `village` varchar(100) NOT NULL,
                `ward` varchar(100) NOT NULL,
                `service_type` varchar(100) DEFAULT NULL,
                `userrole` varchar(20) NOT NULL,
                `account_status` varchar(20) NOT NULL DEFAULT 'Active',
                PRIMARY KEY (`username`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    
            -- Table structure for table `admin`
            CREATE TABLE IF NOT EXISTS `admin` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `first_name` varchar(255) NOT NULL,
                `last_name` varchar(255) NOT NULL,
                `username` varchar(255) NOT NULL,
                `email` varchar(255) NOT NULL,
                `password` varchar(255) NOT NULL,
                `address` varchar(255) DEFAULT NULL,
                `contact` varchar(20) DEFAULT NULL,
                `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                `userrole` varchar(255) NOT NULL DEFAULT 'admin',
                `designation` varchar(255) DEFAULT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `username` (`username`),
                UNIQUE KEY `email` (`email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    
            -- Table structure for table `makerequests`
            CREATE TABLE IF NOT EXISTS `makerequests` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `date_scheduled` date NOT NULL,
                `service_location` varchar(255) NOT NULL,
                `client_name` varchar(255) NOT NULL,
                `comments` text DEFAULT NULL,
                `requester_username` varchar(255) NOT NULL,
                `service_provider_username` varchar(255) NOT NULL,
                `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                `status` varchar(20) NOT NULL DEFAULT 'Pending',
                PRIMARY KEY (`id`),
                KEY `customer` (`requester_username`),
                KEY `serviceprovider` (`service_provider_username`),
                CONSTRAINT `customer` FOREIGN KEY (`requester_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `serviceprovider` FOREIGN KEY (`service_provider_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    
            -- Table structure for table `accountrequests`
            CREATE TABLE IF NOT EXISTS `accountrequests` (
                `request_id` int(11) NOT NULL AUTO_INCREMENT,
                `requester_username` varchar(255) NOT NULL,
                `request_text` text NOT NULL,
                `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
                PRIMARY KEY (`request_id`),
                KEY `username` (`requester_username`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        ";
    
        // Explode the SQL string into individual statements
        $sqlStatements = explode(";", $sql);
    
        // Execute each SQL statement
        foreach ($sqlStatements as $sqlStatement) {
            // Trim any whitespace and execute the statement
            $trimmedStatement = trim($sqlStatement);
            if (!empty($trimmedStatement)) {
                $this->db->exec($trimmedStatement);
            }
        }
    }
}

?>