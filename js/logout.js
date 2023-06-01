document.getElementById("logout-form").addEventListener("submit", function(event) {
    event.preventDefault();

    fetch("../api/process-logout.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
    .then(function(response) {
        if (response.ok) {
            // Rafraîchir la page
            window.location.reload();
        } else {
            throw new Error("Erreur lors de la déconnexion");
        }
    })
    .catch(function(error) {
        console.error(error);
    });
});