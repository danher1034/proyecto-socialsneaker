// resources/js/app.js
function openNav() {
    document.getElementById("mobile-menu").style.width = "100%";
}

function closeNav() {
    document.getElementById("mobile-menu").style.width = "0%";
}

// Exportar las funciones para asegurarse de que estén en el ámbito global
window.openNav = openNav;
window.closeNav = closeNav;

