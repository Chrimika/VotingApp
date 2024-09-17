<?php
	include 'includes/session.php';

	// Vérification que la méthode est POST et que 'candidate' et 'votes' sont définis
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])){
		$candidate = $_POST['candidate'];
		$votes = $_POST['votes'];

		// Connexion à la base de données
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Vérification de la connexion
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Vérifier si le candidat existe déjà dans candidates_plus
		$sql_check = "SELECT * FROM candidates_plus WHERE nom = ?";
		$stmt = $conn->prepare($sql_check);
		$stmt->bind_param("s", $candidate);
		$stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows > 0){
			// Candidat existe déjà, mettre à jour le nombre de voix
			$row = $result->fetch_assoc();
			$current_votes = $row['voix'] + $votes;

			$sql_update = "UPDATE candidates_plus SET voix = ? WHERE nom = ?";
			$stmt_update = $conn->prepare($sql_update);
			$stmt_update->bind_param("is", $current_votes, $candidate);

			if($stmt_update->execute()){
				$_SESSION['success'] = 'Votes updated successfully';
			} else {
				$_SESSION['error'] = 'Error updating votes: ' . $stmt_update->error;
			}
		} else {
			// Candidat n'existe pas encore, l'ajouter avec le nombre de voix initial
			$sql_insert = "INSERT INTO candidates_plus (nom, voix) VALUES (?, ?)";
			$stmt_insert = $conn->prepare($sql_insert);
			$stmt_insert->bind_param("si", $candidate, $votes);

			if($stmt_insert->execute()){
				$_SESSION['success'] = 'New candidate and votes added successfully';
			} else {
				$_SESSION['error'] = 'Error adding new candidate: ' . $stmt_insert->error;
			}
		}

		// Fermer les statements et la connexion
		$stmt->close();
		$stmt_update->close();
		$stmt_insert->close();
		$conn->close();

	} else {
		$_SESSION['error'] = 'Invalid submission or missing fields';
	}

	header('location: voters.php');
?>
