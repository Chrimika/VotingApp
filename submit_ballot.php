<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'includes/session.php';
include 'includes/slugify.php';

if (isset($_POST['vote'])) {
    if (count($_POST) == 1) {
        $_SESSION['error'][] = 'Veuillez voter pour au moins un candidat.';
    } else {
        // Vérifier si l'utilisateur a déjà voté pour cette élection
        $sql_check_voted = "SELECT * FROM votes WHERE voters_id = '" . $voter['id'] . "'";
        $result_check_voted = $conn->query($sql_check_voted);

        if ($result_check_voted->num_rows > 0) {
            $_SESSION['error'][] = 'Vous avez déjà voté pour cette élection.';
        } else {
            $_SESSION['post'] = $_POST;
            $sql = "SELECT * FROM positions";
            $query = $conn->query($sql);
            $error = false;
            $sql_array = array();

            while ($row = $query->fetch_assoc()) {
                $position = slugify($row['description']);
                $pos_id = $row['id'];

                if (!isset($_POST[$position]) || empty($_POST[$position])) {
                    $error = true;
                    $_SESSION['error'][] = 'Veuillez choisir un candidat pour tous les postes.';
                    break;  // Quitter la boucle dès qu'une erreur est détectée
                }

                if ($row['max_vote'] > 1 && is_array($_POST[$position])) {
                    if (count($_POST[$position]) > $row['max_vote']) {
                        $error = true;
                        $_SESSION['error'][] = 'Vous ne pouvez choisir que ' . $row['max_vote'] . ' candidats pour ' . $row['description'];
                        break;  // Quitter la boucle dès qu'une erreur est détectée
                    } else {
                        foreach ($_POST[$position] as $candidate) {
                            $sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('" . $voter['id'] . "', '$candidate', '$pos_id')";
                        }
                    }
                } else {
                    $candidate = $_POST[$position];
                    $sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('" . $voter['id'] . "', '$candidate', '$pos_id')";
                }
            }

            if (!$error) {
                foreach ($sql_array as $sql_row) {
                    if (!$conn->query($sql_row)) {
                        $_SESSION['error'][] = 'Erreur de base de données : ' . $conn->error;
                        $error = true;
                        break;  // Quitter la boucle dès qu'une erreur est détectée
                    }
                }

                if (!$error) {
                    unset($_SESSION['post']);
                    $_SESSION['success'] = 'Bulletin soumis';
                }
            }
        }
    }
} else {
    $_SESSION['error'][] = 'Veuillez sélectionner les candidats à voter d\'abord.';
}

header('location: home.php');
exit();
?>
