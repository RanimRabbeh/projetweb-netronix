document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const nameInput = document.getElementById("name");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");

    form.addEventListener("submit", function (event) {
        let errors = [];

        // Validation du nom
        if (!nameInput.value.trim()) {
            errors.push("Le champ 'Nom' est obligatoire.");
        } else if (nameInput.value.length < 3) {
            errors.push("Le nom doit contenir au moins 3 caractères.");
        }

        // Validation de l'email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailInput.value.trim()) {
            errors.push("Le champ 'Email' est obligatoire.");
        } else if (!emailRegex.test(emailInput.value)) {
            errors.push("L'adresse email n'est pas valide.");
        }

        // Validation du mot de passe (facultatif si non modifié)
        if (passwordInput && passwordInput.value.trim()) {
            if (passwordInput.value.length < 6) {
                errors.push("Le mot de passe doit contenir au moins 6 caractères.");
            }
            if (!/[A-Z]/.test(passwordInput.value)) {
                errors.push("Le mot de passe doit contenir au moins une lettre majuscule.");
            }
            if (!/[a-z]/.test(passwordInput.value)) {
                errors.push("Le mot de passe doit contenir au moins une lettre minuscule.");
            }
            if (!/[0-9]/.test(passwordInput.value)) {
                errors.push("Le mot de passe doit contenir au moins un chiffre.");
            }
            if (!/[!@#$%^&*]/.test(passwordInput.value)) {
                errors.push("Le mot de passe doit contenir au moins un caractère spécial (!@#$%^&*).");
            }
        }

        // Affichage des erreurs
        if (errors.length > 0) {
            event.preventDefault(); // Empêche l'envoi du formulaire
            alert(errors.join("\n")); // Affiche toutes les erreurs dans une alerte
        }
    });
});
