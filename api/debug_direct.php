<?php
// Debug script direct connection
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "127.0.0.1";
$dbname = "u808450138_capacitaciones";
$username = "root";
$password = "12345678";
$port = "3307";

echo "Connecting to $dbname on $host:$port...\n";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
    echo "Connected successfully.\n";
    
    // Check if table exists
    echo "Checking table tracking_profesionales...\n";
    $stmt = $conn->query("SHOW TABLES LIKE 'tracking_profesionales'");
    if($stmt->rowCount() > 0) {
        echo "Table tracking_profesionales EXISTS.\n";
        
        // Count rows
        $stmt = $conn->query("SELECT count(*) FROM tracking_profesionales");
        echo "Total Rows: " . $stmt->fetchColumn() . "\n";
        
        // Count active rows
        $stmt = $conn->query("SELECT count(*) FROM tracking_profesionales WHERE activo=1");
        echo "Active Rows: " . $stmt->fetchColumn() . "\n";

        // Call SP
        echo "Calling SP sp_tracking_profesionales_listado_v2('')...\n";
        try {
            $stmt = $conn->prepare("CALL sp_tracking_profesionales_listado_v2('')");
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "SP Result Count: " . count($res) . "\n";
            print_r($res);
        } catch (Exception $e) {
            echo "Error calling SP: " . $e->getMessage() . "\n";
        }
        
    } else {
        echo "Table tracking_profesionales DOES NOT EXIST in database $dbname.\n";
    }

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
