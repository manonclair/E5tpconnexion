<?php
session_start();
include ('hhf/head.php');
include ('hhf/header_index.php');

?>
<html lang="fr">

<body>
<div>

    <h2 class="titre">Information de votre compte : <br><br><br> </h2>
    <p class="text"> Votre id : <?php echo $_SESSION['id']; ?><br><br></p>
    <p class="text"> Votre email : <?php echo $_SESSION['email']; ?></p>

</div>
</body>
