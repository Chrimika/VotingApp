<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Connexion à la base de données
$servername = "db5016007456.hosting-data.io"; // Remplacez par votre nom de serveur
$username = "dbu3466712"; // Remplacez par votre nom d'utilisateur de base de données
$password = "System.12356"; // Remplacez par votre mot de passe de base de données
$dbname = "dbs13043795"; // Remplacez par votre nom de base de données

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Ajouter le champ 'Nom' à la table 'voters' si ce champ n'existe pas déjà

// Supprimer tous les champs de la table voters
// $sql = "DELETE FROM voters";
// if ($conn->query($sql) === TRUE) {
//     echo "Tous les enregistrements de la table voters ont été supprimés avec succès.<br>";
// } else {
//     echo "Erreur lors de la suppression des enregistrements de la table voters: " . $conn->error . "<br>";
// }

// Supprimer tous les champs de la table votes
// $sql = "DELETE FROM votes";
// if ($conn->query($sql) === TRUE) {
//     echo "Tous les enregistrements de la table votes ont été supprimés avec succès.<br>";
// } else {
//     echo "Erreur lors de la suppression des enregistrements de la table votes: " . $conn->error . "<br>";
// }

// Tableaux pour stocker les emails, les mots de passe et les mots de passe cryptés
$emails = [];
$passwords = [];
$passcrypt = [];

function sendEmail($to, $code, &$emails, &$passwords) {
    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Remplacez par votre serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'brainshub237@gmail.com'; // Remplacez par votre email
        $mail->Password = 'egocpoajglrsfoqs'; // Remplacez par votre mot de passe
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Activer le débogage SMTP
        $mail->SMTPDebug = 2; // Modifier en 0 pour désactiver en production
        $mail->Debugoutput = 'html';

        // Destinataire
        $mail->setFrom('brainshub237@gmail.com', 'Brains Hub');
        $mail->addAddress($to);

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = 'Votre code de connexion';
        $mail->Body    = "Voici votre code de connexion : <b>$code</b>";

        $mail->send();
        echo 'Message envoyé à ' . $to . '<br>';

        // Ajouter l'email et le mot de passe aux tableaux
        $emails[] = $to;
        $passwords[] = $code;

    } catch (Exception $e) {
        echo "Message non envoyé. Erreur de messagerie: {$mail->ErrorInfo}<br>";
    }
}

$emailList = [
    'josephambono@gmail.com',
    'mjejangue@yahoo.fr',
    'moitresormarius@gmail.com',
    'michye1630@gmail.com',  // corrigé de michyel630@gmail.com
    'arletteamougou34@gmail.com',
    'benohomariebrigitte@gmail.com',
    'mariejustinenyobe@gmail.com',
    'belkiwikiss@gmail.com',
    'foudangamboer@gmail.com',
    'mbilongarsene@gmail.com',
    'patricejoelle629@gmail.com',  // corrigé de patricejoelle629@gmailcom
    'franckyanicet5@gmail.com',
    'saliyussuf@yahoo.fr',
    'clairebatoum2014@gmail.com',
    'olouah1@yahoo.fr',
    'mbillaongbota@yahoo.com',  // corrigé de mbillaongbotayahoo.com
    'ahmedabdoulaye5@yahoo.fr',
    'mahamdjo1981@gmail.com',
    'david_engbwang@yahoo.fr',
    'sala_abba2006@yahoo.fr',
    'takosmi@yahoo.fr',
    'djiokeng.carine@yahoo.fr',
    'aurelieeko18@gmail.com',  // corrigé de Aurelieeko18gmail.com
    'abberodrigue1@yahoo.com',
    'nkolo.mbilong@gmail.com',
    'massomady@yahoo.fr',
    'bouloudanie@yahoo.fr',
    'roland_owono@yahoo.fr',
    'bidjoobiangaj2015@yahoo.fr',
    'maxime.djonmo@gmail.com',
    'karlmike.chinda@icloud.com',
    'rousselemm15@gmail.com',
    'fokoudanielle522@gmail.com',
    'angobertrand1986@gmail.com',
    'thierryetime@yahoo.fr',
    'atemcyrille77@gmail.com',
    'bosconjikam@gmail.com',
    'mhortence05@gmail.com',
    'benfilsdzou86@yahoo.com',
    'smakoubo@yahoo.com',
    'josettechartelle04@yahoo.fr',
    'ndamsalif79@gmail.com',
    'victorine.njollembondjo@yahoo.fr',
    'steveetabaobama@gmail.com',
    'romuald_ateba@yahoo.fr',
    'aboulamailley@gmail.com',
    'emmanuelyengo1@gmail.com',
    'danb7255@gmail.com',
    'aminatouyaya584@gmail.com',
    'mvienadege@gmail.com',
    'ingridessola@yahoo.fr',
    'awalougaldima@gmail.com',
    'labelle2deborah@yahoo.fr'
];

$nomList = [
    "Joseph AMBONO",
    "MJ WANGA EJANGUE",
    "Marius Tresor MOUYEMA",
    "Michelle Gaelle MAHOUVE",
    "Arlette MVONDO ASSOLO O",
    "Marie Brigitte BENOHO",
    "Marie Justine NGO NDJIKI",
    "Doris DJUMEGUE",
    "Elie Rodrigue FOUDA NGAMBOE",
    "Arsene MBILONG",
    "Joelle Patrice NKE NKE",
    "Franck Anicet MODOM OPANG",
    "SALI YOUSSOUFA",
    "Claire BATOUM",
    "Patrick Bertrand OLOUAH ANGOUAN D",
    "MBILLA ONGBOTA",
    "Abdoulaye AHMED",
    "Liza MAHAMDJO",
    "David ENGBWANG",
    "SALAMATOU ABBA",
    "Mireille TAKOS",
    "Carine DJIOKENG",
    "Judith Aurelie MBOKOIN",
    "Jean Rodrigue ABBE",
    "Raissa NKOLO",
    "Madeleine NGO MASSO",
    "Daniella MBALLA ETOGO",
    "Roland OWONO",
    "Jacques BIDJO OBIANGA",
    "Djonmo LOUMBELE",
    "Claire MASSOP DIDI",
    "MINKONDA ROUSSELLE",
    "Danielle FOKOU",
    "Bertrand ANGO",
    "Thierry Systeme ETIME",
    "France NDIGSHE",
    "Bosco NJIKAM",
    "MH OBAMA ATANGAN",
    "Bernard Fils DZOU",
    "Sylvie MAKOUBO",
    "Josette Chartelle MFOUOU",
    "Salif NDAM MOLUH",
    "Victorine NJOLLE BONDJO",
    "Steve ETABA OBAMA",
    "Romuald ATEBA ATEBA",
    "Herve Serge ABOULA MAILLEY",
    "Emmanuel FAI",
    "Daniel ESSAMA",
    "Aminatou YAYA",
    "Nadege MVIE",
    "Ingrid ESSOLA",
    "Galdima AWALOU",
    "Déborah Bum NDJENG"
];

// Envoi des emails avec les codes de connexion et enregistrement des emails et des mots de passe
foreach ($emailList as $key => $email) {
    $code = rand(100000, 999999); // Générer un code de connexion aléatoire
    sendEmail($email, $code, $emails, $passwords);

    // Crypter les mots de passe et les stocker dans $passcrypt
    $passcrypt[$key] = password_hash($code, PASSWORD_BCRYPT);

    // Insérer les données dans la base de données avec le champ 'Nom'
    $nom = $nomList[$key];
    $sql = "INSERT INTO voters (email, password, Nom) VALUES ('$email', '$passcrypt[$key]', '$nom')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvel enregistrement créé avec succès pour $email<br>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Sélectionner les données de la table voters
$sql = "SELECT * FROM voters";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h3>Tableau des Voters :</h3>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Email</th><th>Password</th><th>Nom</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['email'] . "</td><td>" . $row['password'] . "</td><td>" . $row['Nom'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Aucun résultat trouvé dans la table voters.";
}

// Sélectionner les données de la table votes
$sql = "SELECT * FROM votes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h3>Tableau des Votes :</h3>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Voter ID</th><th>Candidate ID</th><th>Position ID</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['voter_id'] . "</td><td>" . $row['candidate_id'] . "</td><td>" . $row['position_id'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Aucun résultat trouvé dans la table votes.";
}

// Fermer la connexion à la base de données
$conn->close();

// Affichage des tableaux d'emails, de mots de passe et de mots de passe cryptés
echo "<h3>Emails et Mots de passe générés :</h3>";
echo "<pre>";
print_r($emails);
print_r($passwords);
print_r($passcrypt);
echo "</pre>";
?>
