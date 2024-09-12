// Confirmación para eliminar un usuario
function confirmarEliminacion() {
    return confirm('¿Estás seguro de que deseas eliminar este usuario?');
}

// Animación al hacer hover en los botones de envío
document.querySelectorAll('input[type="submit"]').forEach(function(button) {
    button.addEventListener('mouseover', function() {
        button.style.transform = 'scale(1.05)';
    });
    button.addEventListener('mouseout', function() {
        button.style.transform = 'scale(1)';
    });
});
