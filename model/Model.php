<?php
abstract class Model {
    private static $dbh;

    private static function setDb() {
        $dbHost     = 'localhost'; // Replace with your actual database host
        $dbUser     = 'root'; // Replace with your actual database user
        $dbPassword = 'root'; // Replace with your actual database password
        $dbName     = 'mangatheque'; // Replace with your actual database name

        try
        {
            self::$dbh = new \PDO("mysql:host=".$dbHost.";dbname=".$dbName, $dbUser, $dbPassword);
        } catch (\PDOException $e) {
	        // Echec de la connexion
            exit("Erreur: " . $e->getMessage());
        }
    }

    protected function getDb() {
        if(self::$dbh == NULL) {
            self::setDb();
        }

        return self::$dbh;
    }
}