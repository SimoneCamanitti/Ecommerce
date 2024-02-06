<?php
include "connessione.php";
// Crea la connessione
$conn = new mysqli($hostname, $username, $password, $dbname);

// Verifica la connessione
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$username = $_POST["username"];
$password = $_POST["password"];
$account = 2;
//$username = "carlo.cafferata@itis.pr.it";
//$password = "Password";
//$account = "admin";
// Genera l'hash della password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Esegui la query INSERT INTO per inserire i dati nel database
$sql = "INSERT INTO Utenti (Email, password_utente, tipo) VALUES (?, ?, '$account')";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $username, $hashedPassword);

if ($stmt->execute()) {
    echo "Utente registrato con successo!";
    header("Location: ../Index.html");
} else {
    echo "Query failed: " . $stmt->error;
}

// Chiudi la connessione
$stmt->close();
$conn->close();
