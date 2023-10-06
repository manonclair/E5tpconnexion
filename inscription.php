<?php
include ('hhf/head.php');

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=E5_connexion;charset=utf8', 'root', '', array(PDO::ATTR_PERSISTENT => true));
if(isset($_POST['boutton'])){

    if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmation'])){
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];
        $confirmation = $_POST['confirmation'];

        if($password === $confirmation) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $insertUsers = $bdd->prepare('INSERT INTO contact (email, password) VALUES (?, ?)');

            $insertUsers->execute(array($email,$passwordHash));

            $userId = $bdd->lastInsertId();
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $userId;
            header('Location: accueil.php');
            echo "<script> alert('Inscription réussie !') </script>";
        } else {
            echo "<script> alert('La confirmation du mot de passe ne correspond pas.') </script>";
        }
    }   else {
        echo "<script> alert('Veuillez remplir tous les champs.') </script>";
    }
}
?>

<html lang="fr">
<body class="body_page">
<div id="test">
    <form id="form_inscription" method="post" action="" align="center">
        <h2 class="titre">Inscription</h2>
        <br>
        <input type="email" name="email" placeholder="E-mail" required autocomplete="off">
        <br>
        <input type="password" name="password" placeholder="Mot de passe" required autocomplete="off">
        <br>
        <input type="password" name="confirmation" placeholder="Confirmation du mot de passe" required autocomplete="off">
        <br>
        <input type="submit" name="boutton">
        <br><br>
        <h3>Vous avez déjà un compte ? <a href="connexion.php">Cliquez ici</a></h3>
    </form>
</div>
</body>
</html>