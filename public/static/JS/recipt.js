(function injectCartIcon() {
    // const nav = document.querySelector('.navegacion-principal');
    // if (!nav) return;

    // const link = document.createElement('a');
    // link.href = '/src/carrito.php';
    // link.id = 'cart-nav-link';
    // link.innerHTML = '<span id="cart-count">0</span>';
    // nav.appendChild(link);

    updateCartCount();
})();

function updateCartCount() {
    const badge = document.getElementById('cart-count');
    if (!badge) return;
    const cart = getCart();
    const total = cart.reduce((sum, item) => sum + Number(item.quantity || 1), 0);
    badge.textContent = total;
}

function getCart() {
    try {
        return JSON.parse(localStorage.getItem('cart')) || [];
    } catch {
        return [];
    }
}

function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}

const form = document.getElementById('add-to-cart');

if (form) {
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const selectValue = form['form-variant']?.value;
        const inputValue = form['form-quantity']?.value;
        const nameValue = form['form-product']?.value;
        const priceValue = form['form-product']?.dataset.price;

        if (!inputValue || Number(inputValue) < 1) {
            alert('Por favor ingresa una cantidad valida.');
            return;
        }

        const cart = getCart();
        cart.push({
            product: nameValue,
            variant: selectValue || null,
            quantity: inputValue,
            price: priceValue,
        });
        saveCart(cart);
        updateCartCount();

        const btn = form.querySelector('[type="submit"]');
        const original = btn.value;
        btn.value = 'Agregado';
        btn.disabled = true;
        setTimeout(() => {
            btn.value = original;
            btn.disabled = false;
        }, 1500);
    });
}
