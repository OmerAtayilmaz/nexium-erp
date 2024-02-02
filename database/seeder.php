<?php

use Database\Database;

$db = Database::getInstance()->getConnection();

$directory = BASE_PATH . '/database/seeds';

$seedSqlFiles = glob($directory . '/*.sql');

$tableSql = file_get_contents(BASE_PATH . '/database/database.sql');
$db->exec($tableSql);

foreach($seedSqlFiles as $singleSeed){
    $sql = file_get_contents($singleSeed);
    $db->exec($sql);
    $logger->log("$singleSeed TABLE SEEDER EXECUTED.");
}

$logger->log("SEEDERS COMPLETED GRACEFULLT!");