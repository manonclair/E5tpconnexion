<?php
include ('hhf/head.php');

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=E5_connexion;charset=utf8', 'root', '', array(PDO::ATTR_PERSISTENT => true));
if (isset($_POST['boutton'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];
        $recupUser = $bdd->prepare('SELECT * FROM contact WHERE email = ?');
        $recupUser->execute(array($email));
        $user = $recupUser->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $user['id'];
            getUserInfo($bdd, $email, 'id');
            getUserInfo($bdd, $email, 'email');
            header('Location: accueil.php');
            exit();
        } else {
            echo "<script> alert('Mot de passe incorrect !') </script>";
        }
    } else {
        echo "<script> alert('Veuillez remplir tous les champs...') </script>";
    }
}

function getUserInfo($bdd, $mail, $x){
    $recup = $bdd->prepare("SELECT $x FROM contact WHERE email = ?");
    $recup->execute(array($mail));
    $utilisateur = $recup->fetch();
    $_SESSION[$x] = $utilisateur[$x];
}
?>

<html lang="fr">
<head>
    <title class="titre">Connexion</title>
</head>
<body class="body_page">
<div>
    <form method="post" action="">
        <h2 class="titre">Connexion</h2>
        <br>
        <input class="form" type="email" name="email" placeholder="Email" autocomplete="off">
        <br>
        <input class="form form2" type="password" name="password" placeholder="Mot de passe" autocomplete="off">
        <br>
        <input class="form" type="submit" name="boutton" value="Se connecter">
        <br>
        <br>
        <h3>Vous n'avez pas de compte ? <a href="inscription.php">Cliquez ici</a></h3>
    </form>
</div>
</body>
</html>


