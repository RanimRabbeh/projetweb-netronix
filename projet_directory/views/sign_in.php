<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Intégration du fichier CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <!-- Formulaire de Connexion -->
        <div class="sign-in-container">
            <form action="/auth/login" method="POST">
                <h1>Connexion</h1>
                <div class="social-container">
                    <a href="#" class="social">F</a>
                    <a href="#" class="social">G+</a>
                    <a href="#" class="social">In</a>
                </div>
                <span>ou utilisez votre compte</span>
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Mot de passe" required />
                <a href="#">Mot de passe oublié ?</a>
                <button type="submit">Se connecter</button>
            </form>
        </div>
    </div>

    <!-- Intégration du fichier JavaScript -->
    <script src="/assets/js/script.js" defer></script>
</body>
</html>
