<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1><b>Votes Results</b></h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <?php
              $sql = "SELECT * FROM positions ORDER BY priority ASC";
              $query = $conn->query($sql);
              while($row = $query->fetch_assoc()){
                echo "<h3>".$row['description']."</h3>";
                echo "<table class='table table-bordered'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Candidate</th>";
                echo "<th>Votes</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                $sql = "SELECT * FROM candidates WHERE position_id = '".$row['id']."'";
                $cquery = $conn->query($sql);
                while($crow = $cquery->fetch_assoc()){
                  $sql = "SELECT * FROM votes WHERE candidate_id = '".$crow['id']."'";
                  $vquery = $conn->query($sql);
                  $votes = $vquery->num_rows;
                  echo "<tr>";
                  echo "<td>".$crow['lastname']."</td>";
                  echo "<td>".$votes."</td>";
                  echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
              }
            ?>
          </div>
        </div>
      </section>
    </div>

    <?php include 'includes/footer.php'; ?>
  </div>

  <?php include 'includes/scripts.php'; ?>
</body>
</html>