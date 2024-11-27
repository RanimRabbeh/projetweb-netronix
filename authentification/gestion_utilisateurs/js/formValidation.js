// Fonction pour valider le formulaire
function validateForm() {
    // Récupérer les valeurs des champs
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    // Vérification du nom
    if (name === "") {
        alert("Le nom est requis.");
        return false;  // Empêche l'envoi du formulaire
    }
    
    // Vérification de l'email
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (email === "") {
        alert("L'email est requis.");
        return false;
    } else if (!emailPattern.test(email)) {
        alert("Veuillez entrer un email valide.");
        return false;
    }
    
    // Vérification du mot de passe (doit être au moins 6 caractères)
    if (password === "") {
        alert("Le mot de passe est requis.");
        return false;
    } else if (password.length < 6) {
        alert("Le mot de passe doit contenir au moins 6 caractères.");
        return false;
    }
    
    // Si toutes les validations sont réussies
    return true;
}
