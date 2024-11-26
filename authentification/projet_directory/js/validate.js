// Fonction pour valider l'email
function validateEmail(email) {
    const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return re.test(email);
}

// Fonction pour valider le mot de passe (par exemple, au moins 6 caractères)
function validatePassword(password) {
    return password.length >= 6;
}

// Fonction de validation globale du formulaire
function validateForm(event) {
    const email = document.querySelector('input[name="email"]').value;
    const password = document.querySelector('input[name="new_password"]').value;
    
    // Vérification de l'email
    if (!validateEmail(email)) {
        alert("Veuillez entrer un email valide.");
        event.preventDefault();
        return false;
    }
    
    // Vérification du mot de passe
    if (!validatePassword(password)) {
        alert("Le mot de passe doit contenir au moins 6 caractères.");
        event.preventDefault();
        return false;
    }
    
    return true; // Si tout est valide, le formulaire est envoyé
}
