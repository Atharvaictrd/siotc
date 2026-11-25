<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class BackupController extends Controller
{
    public function downloadBackup()
    {
        // Database configuration
        $dbConfig = config('Database')->default;

        $host = $dbConfig['hostname'];
        $user = $dbConfig['username'];
        $password = $dbConfig['password'];
        $database = $dbConfig['database'];

        // Connect to the database
        $conn = new \mysqli($host, $user, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            return $this->response->setStatusCode(500)->setBody('Database connection failed: ' . $conn->connect_error);
        }

        // Get all tables in the database
        $tables = [];
        $result = $conn->query("SHOW TABLES");
        while ($row = $result->fetch_row()) {
            $tables[] = $row[0];
        }

        // Create the SQL backup content
        $sqlBackup = "-- Database Backup for: $database\n-- Generated on: " . date('Y-m-d H:i:s') . "\n\n";
        foreach ($tables as $table) {
            // Get CREATE TABLE statement
            $createTableResult = $conn->query("SHOW CREATE TABLE `$table`");
            $createTableRow = $createTableResult->fetch_row();
            $sqlBackup .= "\n\n" . $createTableRow[1] . ";\n\n";

            // Get INSERT statements for table data
            $dataResult = $conn->query("SELECT * FROM `$table`");
            while ($dataRow = $dataResult->fetch_assoc()) {
                $sqlBackup .= "INSERT INTO `$table` VALUES(";
                $sqlBackup .= "'" . implode("','", array_map([$conn, 'real_escape_string'], $dataRow)) . "'";
                $sqlBackup .= ");\n";
            }
        }

        // Close the connection
        $conn->close();

        // File name for the backup
        $fileName = 'database_backup_' . date('Y-m-d') . '.sql';

        // Set headers to force download
        return $this->response
            ->setHeader('Content-Type', 'application/octet-stream')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $fileName . '"')
            ->setBody($sqlBackup);
    }
}


?>