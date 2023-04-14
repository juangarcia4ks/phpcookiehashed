<?php

return new PDO(
    'mysql:host=<TU_HOST>;dbname=<TU_DBNAME>',
    '<TU_USERNAME>',
    '<TU_PASSWORD>',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
    ]
);
