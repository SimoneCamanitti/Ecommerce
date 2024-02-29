<?php 
    include "connessione.php";
    session_start();
    $id=$_POST["id"];

    $conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
    if (isset($_SESSION["conferma"])) {
       if ($_SESSION["conferma"]) {
           $email=$_SESSION["username"];
        $query="SELECT id FROM Utenti WHERE Email='$email';";
        $res=$conn->query($query);
        $id_utente=mysqli_fetch_array($res)["id"];
        $query="INSERT INTO carrelli (id_utente,id_prodotto) VALUES (".$id_utente.",".$id.");";
        $conn->query($query);
        header('Location: Carrello.php');
    }
    }else{
        echo "Per favore registrarsi al seguente link per acquistare";
        echo "<a href='../HTML/Login.html'>Login</a>";
    }

?>