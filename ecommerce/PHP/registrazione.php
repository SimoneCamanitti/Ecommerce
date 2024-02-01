<?php
include "connessione.php";
// Crea la connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la connessione
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$username = $_POST["username"];
$password = $_POST["password"];
$account = "user";
//$username = "carlo.cafferata@itis.pr.it";
//$password = "Password";
//$account = "admin";
// Genera l'hash della password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Esegui la query INSERT INTO per inserire i dati nel database
$sql = "INSERT INTO users (username, password, account_type) VALUES (?, ?, '$account')";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $username, $hashedPassword);

if ($stmt->execute()) {
    echo "Utente registrato con successo!";
} else {
    echo "Query failed: " . $stmt->error;
}

// Chiudi la connessione
$stmt->close();
$conn->close();
