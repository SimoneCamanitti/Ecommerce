<?php 
    session_start();
    include "connessione.php";
    $conn = new mysqli($hostname, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
?>
</html>
<!DOCTYPE html>
<html lang="it">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrello</title>
  <link rel="stylesheet" href="../CSS/carrello.css">
  <style>
    body {
      background-color: #222222;
      color: #ffffff;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
  </style>
</head>
<body>
      <?php
        $prezzo_totale=0;
            $query="SELECT c.id AS id,id_prodotto,p.Nome AS nome_prodotto,p.quantita AS quantita,p.prezzo AS prezzo,s.Nome AS nome_opzione,s.quantita AS opzione_quantita,s.prezzo AS opzione_prezzo FROM carrelli c INNER JOIN prodotti p ON c.id_prodotto=p.id INNER JOIN prodotti s ON p.id_opzioni=s.id; ";
            $res=$conn->query($query);
        echo "<div class='my-3 py-3'>
        <h2 class='display-5'>Carrello</h2>";
        while ($row=mysqli_fetch_array($res)){
          $id=$row["id"];
          $prezzo_totale+=$row["prezzo"];
        echo "<div id='carrello'>
        <h2>Il tuo carrello</h2>
        
        <ul class='carrello-articoli'>
          <li class='articolo'>
            <img src='immagine_prodotto1.jpg' alt='Prodotto 1'>
            <div class='dettagli'>
              <h3>".$row["nome_prodotto"]." </h3>
              <p>Quantità: ".$row["quantita"]."</p>
              <p>Prezzo: ".$row["prezzo"]."</p>
              <p>".$row["nome_opzione"]."</p>
              <p>Quantità opzione: ".$row["opzione_quantita"]."</p>
              <p>Prezzo opzione: ".$row["opzione_prezzo"]."</p>
            </div>
            <button class='rimuovi'>Rimuovi</button>
          </li>
        </ul>
        <form action='Ordine.php' method='post'>
        <button type='submit' value='".$id."' name='id'>Vai all'ordine </button>
      </from>
      </div>
      ";}
      $_SESSION["Prezzo_tot"]=$prezzo_totale;
      ?>
 
</body>
</html>