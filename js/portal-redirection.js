
document.getElementById('portal-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire par défaut
    
    // Effectuez votre redirection ici
    window.location.href = '../front/portal.php';
});

