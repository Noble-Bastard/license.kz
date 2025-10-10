<?php
$config = require 'C:\Users\CoolPC\Documents\license.kz\config\database.php';
try {
    $connection = new PDO(
        'mysql:host=' . $config['connections']['mysql']['host'] . ';dbname=' . $config['connections']['mysql']['database'],
        $config['connections']['mysql']['username'],
        $config['connections']['mysql']['password']
    );
    $result = $connection->query('DESCRIBE service_journal_ext');
    echo "Columns in service_journal_ext:\n";
    foreach ($result as $row) {
        echo $row['Field'] . "\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
