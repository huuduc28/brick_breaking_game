<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'account_game';

    $conn = new mysqli ($host, $username, $password, $dbName);
    if ($conn -> connect_error) {
        die ("Unable to connect database");
    }

?>