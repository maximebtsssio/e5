<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>S'inscrire</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
  <nav>
        <h1>SchoolBoost</h1>
    </nav>

 <div id="from"> 
  <form method="post">
  <label for="nom">Utilisateur :</label>
  <input type="text" id="nom" name="nom" required>

  <label for="email">E-mail :</label>
  <input type="email" id="email" name="email" required>

  <label for="mdp">Mot de passe :</label>
  <input type="password" id="mdp" name="mdp" required>

  <input type="submit" value="S'inscrire">
</form>
</div>

<?php
if (isset($_POST['nom'])){
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "E5leger";
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if (!$conn) {
    die("La connexion a échoué : " . mysqli_connect_error());
}

// Récupérer les données du formulaire
$nom = isset($_POST['nom']) ? $_POST['nom'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$motdepasse = isset($_POST['mdp']) ? $_POST['mdp'] : "";

// Vérifier les données saisies
if (empty($nom) || empty($email) || empty($motdepasse)) {
    echo "Veuillez remplir tous les champs.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "L'adresse e-mail n'est pas valide.";
} else {
    // Insérer les données dans la base de données
    $sql = "INSERT INTO connexion (utilisateur, email, mdp) VALUES ('$nom', '$email', '$motdepasse')";
    if (mysqli_query($conn, $sql)) {
        echo "Inscription réussie.";
        $_SESSION['email'] = $email;
        header("Location: accueil.html");
    } else {
        echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Fermer la connexion à la base de données
mysqli_close($conn);
}
?>

    <footer>
      <p>Copyright © 2023 - SchoolBoost</p>
    </footer>
  </body>
</html>
