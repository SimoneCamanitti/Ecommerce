<?php 
    session_start();
    $id=$_POST["id"];
    include "connessione.php";
    $conn = new mysqli($hostname, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    
?>



      <?php
        $query="INSERT INTO ordini (data_Ordine,data_Consegna) VALUES (".date('Y-m-d').",".strtotime(date('Y-m-d') . ' +3 days').");";
        $conn->query($query);
        $query="INSERT INTO dettaglioordine (id_Ordine) SELECT o.id FROM ordini o;";
        $conn->query($query);
        $query="INSERT INTO dettaglioordine (id_Prodotto,prezzo_Prodotto) SELECT prodotti.id,prodotti.prezzo FROM prodotti;";
        $conn->query($query);
        $query="INSERT INTO dettaglioordine (quantita_Ordinata) VALUES (".$_SESSION["quantita"].");";
        $conn->query($query);
        header("Location: Dettaglio_Ordine.php");
      ?>
 


