<?php
session_start();

include "connessione.php";

$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    // Pulizia delle variabili di input
    $username = trim($_POST['username']);

    // Esecuzione di una query preparata per evitare SQL injection
    $sql = "SELECT * FROM users WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifica delle password utilizzando la funzione password_verify
        if (password_verify(trim($_POST['password']), trim($user['password']))) {
            // Credenziali corrette, impostare variabili di sessione
            $_SESSION['username'] = $username;
            $_SESSION['account_type'] = $user['account_type'];
            //indirizzo alla pagina che mi interessa.
            header('Location: ../HTML/Home.php');
            exit();
        } else {
            // password  non corretta, reindirizza alla pagina di login
            header('Location: ../Index.html');
            exit();
        }
    } else {
        // Utente non trovato, reindirizza alla pagina di login
        header('Location: ../Index.html');
        exit();
    }
} else {
    // Se i campi non sono stati inviati, reindirizza alla pagina di login. 
    // In realtà il Form di Login richiede l'obbligo di inserire entrambi i campi quindi questa parte potrebbe essere omessa
    header('Location: ../Index.html');
    exit();
}

// Chiudi la connessione al database
$conn->close();
