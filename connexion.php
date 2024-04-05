<?php

function getConnection() {
    $connection = new PDO(
        "mysql:host=localhost;dbname=recrutementbd",
        "societe_recrutement",
        "password"
    );
    return $connection;
}