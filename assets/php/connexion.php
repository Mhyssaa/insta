<head>
    <link rel="stylesheet" href="css/connexion.css">
</head>

<main>

    <form method="POST" action="assets/bdd/connexion_action.php">

        <h3>Connexion</h3>

        <div class="content-form">
            <label for="pseudo">Pseudo *</label>
            <input type="text" name="pseudo" required>
        </div>

        <div class="content-form">
            <label for="mdp">Mot de passe *</label>
            <input type="password" name="mdp" required>
        </div>


        <div class="content-form">
            <input type="submit">
        </div>

    </form>

</main>