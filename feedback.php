<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'lacharia');
define('DB_PASS', '123');
define('DB_NAME', 'monsite');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// check connection
if ($conn->connect_error) {
  die("Connection Failed " . $conn->connect_error);
}
//echo "CONNECTED!";
?>
<?php
$nom = $email = $sujet = $message = '';
$nomErr = $emailErr = $sujetErr = $messageErr = '';
// Form Validation
if (isset($_POST['submit'])) {
  // Validate name
  if (empty($_POST['nom'])) {
    $nomErr = 'Name is required';
  } else {
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  // Validate Subject
  if (empty($_POST['sujet'])) {
    $sujetErr = 'Subject is required';
  } else {
    $sujet = filter_input(INPUT_POST, 'sujet', FILTER_SANITIZE_EMAIL);
  }

  // Validate email
  if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
  } else {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  }


  // Validate message
  if (empty($_POST['message'])) {
    $messageErr = 'Message is required';
  } else {
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  if (empty($nomErr) && empty($sujetErr) && empty($emailErr) && empty($messageErr)) {
    // Add to database
    $sql = "INSERT INTO clients (nom, sujet, email, message) VALUES ('$nom', '$sujet', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
      // Success
      header("Location: index.php");
    } else {
      // Error
      echo 'Error ' . mysqli_error($conn);
    }
  }
}

?>
