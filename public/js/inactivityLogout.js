let logoutTimer;

function resetLogoutTimer() {
    clearTimeout(logoutTimer);
    logoutTimer = setTimeout(logout, 600000); // 600000ms = 10 minutes
}

function logout() {
    // Rediriger vers la route de déconnexion de Symfony
    window.location.href = '/logout';
}

// Réinitialiser le timer sur les événements d'activité
['click', 'mousemove', 'keypress'].forEach(event => {
    document.addEventListener(event, resetLogoutTimer, false);
});

resetLogoutTimer(); // Initialiser le timer lors du chargement de la page
