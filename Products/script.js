document.querySelectorAll('.product-row').forEach(row => {
    row.addEventListener('click', function() {
        const medicamentId = this.getAttribute('data-id');
        window.location.href = `productDetail.php?productId=${medicamentId}`;
    });
});

document.querySelector('.add-product-row').addEventListener('click', function() {
    window.location.href = 'createProduct.php';
});

var messages = document.getElementsByClassName('message');
if (messages.length > 0) {
    // Affichage du premier message
    setTimeout(function() {
        messages[0].style.opacity = '1';
    }, 100);

    // faire disparaître le message après 3 secondes
    setTimeout(function() {
        messages[0].style.opacity = '0';

        // masquer complètement l'élément après la transition
        setTimeout(function() {
            messages[0].style.display = 'none';
        }, 1000);
    }, 3000);
}