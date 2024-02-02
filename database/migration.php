<?php

use Database\Database;


$db = Database::getInstance()->getConnection();

$directory = BASE_PATH . '/database/tables';
$sqlFiles = glob($directory . '/*.sql');

$tableSql = file_get_contents(BASE_PATH . '/database/database.sql');
$db->exec($tableSql);

foreach($sqlFiles as $singleTable){
    $sql = file_get_contents($singleTable);
    $db->exec($sql);

    $logger->log("$singleTable TABLE MIGRATED!");
}


$logger->log("MIGRATION COMPLETED GRACEFULLY!");
