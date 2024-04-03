<!-- login.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <h2>Connexion</h2>
    <?php if (isset($error_message)): ?>
        <p>
            <?= $error_message ?>
        </p>
    <?php endif; ?>
    <form action="../../controllers/agentController.php" method="post">
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" name="login" value="Se connecter">
    </form>
</body>

</html>