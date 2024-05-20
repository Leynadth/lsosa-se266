<?php

$ini = parse_ini_file(__DIR__ . '/dbconfig.ini');

try {
    $db = new PDO(
        "mysql:host=" . $ini['servername'] . 
        ";port=" . $ini['port'] . 
        ";dbname=" . $ini['dbname'], 
        $ini['username'], 
        $ini['password']
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>
