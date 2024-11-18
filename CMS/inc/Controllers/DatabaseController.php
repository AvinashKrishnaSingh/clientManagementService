<!-- DatabaseController.php -->
<?php

// Import the DatabaseModel
require_once __DIR__ . '/../Models/DatabaseModel.php';

class DatabaseController {
    // Database model instance
    private $dbModel;

    // Constructor to initialize the database model
    public function __construct() {
        $this->dbModel = new DatabaseModel();
    }

    // Setup database with initial values and tables
    public function setupDatabase() {
        try {
            // Create the database
            $this->dbModel->createDatabase();
    
            // Select the database
            $this->dbModel->selectDatabase();
    
            // Create tables
            $this->dbModel->createTables();
    
            // Ensure the default admin user exists
            $this->ensureDefaultAdminUser();
    
            // Redirect to the landing page (login screen)
            header('Location: ' . URLROOT . '/landing');
            exit();
        } catch (PDOException $e) {
            // Handle any errors during the setup process
            echo "Error initializing database: " . $e->getMessage();
            exit();
        }
    }
    

    // Function to ensure the default admin user exists
    private function ensureDefaultAdminUser() {
        try {
            // Check if the default admin user already exists
            $stmt = $this->dbModel->getDb()->prepare("SELECT COUNT(*) FROM `users` WHERE `username` = 'admin'");
            $stmt->execute();
            $count = $stmt->fetchColumn();

            // If 'admin' user doesn't exist, insert default admin values
            if ($count == 0) {
                // Hash the admin password before inserting
                $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
                
                // Insert default admin user
                $stmt = $this->dbModel->getDb()->prepare("
                    INSERT INTO `users` (`username`, `password_hash`, `email`, `role`, `created_at`)
                    VALUES ('admin', ?, 'admin@test.com', 'Admin', CURRENT_TIMESTAMP)
                ");
                $stmt->execute([$hashedPassword]);
            }
        } catch (PDOException $e) {
            // Handle any errors during the setup process
            echo "Error ensuring default admin user: " . $e->getMessage();
        }
    }
}

?>
