document.addEventListener("DOMContentLoaded", function () {

    // Fonction pour valider l'email
    function validateEmail(email) {
        const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return regex.test(email);
    }

    // Fonction pour ajouter un message d'erreur sous un champ
    function showError(input, message) {
        let errorMessage = input.parentElement.querySelector('.error-message');
        if (!errorMessage) {
            errorMessage = document.createElement('div');
            errorMessage.classList.add('error-message');
            input.parentElement.appendChild(errorMessage);
        }
        errorMessage.textContent = message;
    }

    // Fonction pour effacer les messages d'erreur
    function clearErrors() {
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(msg => msg.remove());
    }

    // Fonction générique de validation des formulaires
    function validateForm(form, validationRules) {
        let isValid = true;
        clearErrors(); // Effacer les erreurs existantes

        validationRules.forEach(rule => {
            const input = form.querySelector(rule.selector);
            if (input) {
                const value = input.value.trim();

                if (rule.required && !value) {
                    isValid = false;
                    showError(input, rule.errorMessage);
                } else if (rule.regex && !rule.regex.test(value)) {
                    isValid = false;
                    showError(input, rule.errorMessage);
                } else if (rule.minLength && value.length < rule.minLength) {
                    isValid = false;
                    showError(input, rule.errorMessage);
                }
            }
        });

        return isValid;
    }

    // Validation pour le formulaire de connexion
    const loginForm = document.querySelector('form[action="login.php"]');
    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            const validationRules = [
                {
                    selector: 'input[name="email"]',
                    required: true,
                    regex: /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/,
                    errorMessage: "Veuillez entrer un email valide."
                },
                {
                    selector: 'input[name="password"]',
                    required: true,
                    minLength: 6,
                    errorMessage: "Le mot de passe doit contenir au moins 6 caractères."
                }
            ];

            if (!validateForm(loginForm, validationRules)) {
                event.preventDefault();
            }
        });
    }

    // Validation pour le formulaire d'inscription
    const registerForm = document.querySelector('form[action="register.php"]');
    if (registerForm) {
        registerForm.addEventListener("submit", function (event) {
            const validationRules = [
                {
                    selector: 'input[name="name"]',
                    required: true,
                    errorMessage: "Veuillez entrer votre nom."
                },
                {
                    selector: 'input[name="email"]',
                    required: true,
                    regex: /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/,
                    errorMessage: "Veuillez entrer un email valide."
                },
                {
                    selector: 'input[name="password"]',
                    required: true,
                    minLength: 6,
                    errorMessage: "Le mot de passe doit contenir au moins 6 caractères."
                }
            ];

            if (!validateForm(registerForm, validationRules)) {
                event.preventDefault();
            }
        });
    }

    // Validation pour le formulaire de réinitialisation du mot de passe
    const resetPasswordForm = document.querySelector('form[action="reset_password.php"]');
    if (resetPasswordForm) {
        resetPasswordForm.addEventListener("submit", function (event) {
            const validationRules = [
                {
                    selector: 'input[name="email"]',
                    required: true,
                    regex: /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/,
                    errorMessage: "Veuillez entrer un email valide."
                },
                {
                    selector: 'input[name="verification_code"]',
                    required: true,
                    minLength: 6,
                    errorMessage: "Le code de vérification doit avoir 6 chiffres."
                },
                {
                    selector: 'input[name="new_password"]',
                    required: true,
                    minLength: 6,
                    errorMessage: "Le mot de passe doit contenir au moins 6 caractères."
                }
            ];

            if (!validateForm(resetPasswordForm, validationRules)) {
                event.preventDefault();
            }
        });
    }

});
