<?php
session_start();
include('hhf/head.php');
include('hhf/header_accueil.php');

?>


<html lang="fr">

<body>
<div>

    <h2 class="titre">Bienvenue <?php echo $_SESSION['email']; ?>  !</h2>

</div>
</body>
