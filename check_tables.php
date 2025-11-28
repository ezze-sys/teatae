<?php
$pdo = new PDO('mysql:host=localhost;dbname=sinarterang', 'root', '');
$stmt = $pdo->query("SHOW TABLES");
while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
    echo $row[0] . "\n";
}
