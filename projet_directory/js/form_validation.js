document.addEventListener("DOMContentLoaded", function () {

    // Validation pour le formulaire de connexion
    const loginForm = document.querySelector('form[action="login.php"]');
    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            let isValid = true;
            const email = loginForm.querySelector('input[name="email"]');
            const password = loginForm.querySelector('input[name="password"]');

            // Validation de l'email
            if (!email.value || !validateEmail(email.value)) {
                isValid = false;
                alert("Veuillez entrer un email valide.");
            }

            // Validation du mot de passe
            if (!password.value || password.value.length < 6) {
                isValid = false;
                alert("Le mot de passe doit contenir au moins 6 caractères.");
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    }

    // Validation pour le formulaire d'inscription
    const registerForm = document.querySelector('form[action="register.php"]');
    if (registerForm) {
        registerForm.addEventListener("submit", function (event) {
            let isValid = true;
            const name = registerForm.querySelector('input[name="name"]');
            const email = registerForm.querySelector('input[name="email"]');
            const password = registerForm.querySelector('input[name="password"]');

            // Validation du nom
            if (!name.value) {
                isValid = false;
                alert("Veuillez entrer votre nom.");
            }

            // Validation de l'email
            if (!email.value || !validateEmail(email.value)) {
                isValid = false;
                alert("Veuillez entrer un email valide.");
            }

            // Validation du mot de passe
            if (!password.value || password.value.length < 6) {
                isValid = false;
                alert("Le mot de passe doit contenir au moins 6 caractères.");
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    }

    // Validation pour le formulaire de réinitialisation du mot de passe
    const resetPasswordForm = document.querySelector('form[action="reset_password.php"]');
    if (resetPasswordForm) {
        resetPasswordForm.addEventListener("submit", function (event) {
            let isValid = true;
            const email = resetPasswordForm.querySelector('input[name="email"]');
            const verificationCode = resetPasswordForm.querySelector('input[name="verification_code"]');
            const newPassword = resetPasswordForm.querySelector('input[name="new_password"]');

            // Validation de l'email
            if (!email.value || !validateEmail(email.value)) {
                isValid = false;
                alert("Veuillez entrer un email valide.");
            }

            // Validation du code de vérification
            if (!verificationCode.value || verificationCode.value.length !== 6) {
                isValid = false;
                alert("Le code de vérification doit avoir 6 chiffres.");
            }

            // Validation du nouveau mot de passe
            if (!newPassword.value || newPassword.value.length < 6) {
                isValid = false;
                alert("Le mot de passe doit contenir au moins 6 caractères.");
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    }

    // Fonction pour valider l'email
    function validateEmail(email) {
        const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return regex.test(email);
    }

});
