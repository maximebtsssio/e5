<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Se connecter</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
  <nav>
        <h1>SchoolBoost</h1>
    </nav>
    <?php
session_start(); // Démarrage de la session

if (isset($_POST['email']) && isset($_POST['mdp'])) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ="E5leger";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if (!$conn) {
        die("La connexion a échoué : " . mysqli_connect_error());
    }

    // Requête pour récupérer l'utilisateur correspondant à l'email et au mot de passe saisis
    $sql = "SELECT * FROM connexion WHERE email='$email' AND mdp='$mdp'";
    $result = mysqli_query($conn, $sql);

    // Vérifier si l'utilisateur existe dans la base de données
    if (mysqli_num_rows($result) > 0) {
        // Utilisateur trouvé, démarrage de la session et redirection vers la page d'accueil
        $_SESSION['email'] = $email;
        header("Location: accueil.html");
    } else {
        // Utilisateur non trouvé, message d'erreur
        echo "Adresse e-mail ou mot de passe incorrect.";
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);
}
?>

<form action="login.php" method="post">
    <label for="email">E-mail :</label>
    <input type="email" id="email" name="email" required>

    <label for="mdp">Mot de passe :</label>
    <input type="password" id="mdp" name="mdp" required>

    <input type="submit" value="Se connecter">
</form>

    <footer>
      <p>Copyright © 2023 - SchoolBoost</p>
    </footer>
  </body>
</html>
