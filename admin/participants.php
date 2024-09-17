<?php
// Connexion à la base de données
$conn = mysqli_connect("db5016007456.hosting-data.io", "dbu3466712", "System.12356", "dbs13043795");

// Vérification de la connexion
if (!$conn) {
    die("Erreur de connexion : ". mysqli_connect_error());
}

// Requête SQL pour récupérer les données des électeurs et de leur statut de vote
$sql = "SELECT v.Nom, v.email, IF(v.id IN (SELECT voters_id FROM votes), 'Oui', 'Non') AS vote_status
        FROM voters v
        ORDER BY vote_status DESC";
$result = mysqli_query($conn, $sql);

// Affichage des données dans une table HTML avec des styles CSS
echo '<html><head><style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.min.js"></script>
  body {
    font-family: Arial, sans-serif;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ddd;
  }
  th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
  }
  th {
    background-color: #f0f0f0;
  }
 .center {
    text-align: center;
  }
</style></head><body>';

echo "<table id='table'>";
echo "<tr><th>Nom</th><th>Email</th><th>A voté?</th></tr>";

while($row = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td>". $row['Nom']. "</td>";
  echo "<td>". $row['email']. "</td>";
  echo "<td>". $row['vote_status']. "</td>";
  echo "</tr>";
}

echo "</table>";

echo '<div class="center"><button onclick="printPDF()">Export to PDF</button></div>';

echo '</body></html>';

// Fermeture de la connexion
mysqli_close($conn);
?>

<script>
function printPDF() {
  var doc = new jsPDF();
  var html = document.getElementById('table').innerHTML;
  doc.fromHTML(html, 15, 15);
  doc.save('voters.pdf');
}
</script>