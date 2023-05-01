<?php
require_once __DIR__ . '/../config/database.php';

function connectDB() {
global $pdo;
return $pdo;
}
//複数の関数で$pdoの共有