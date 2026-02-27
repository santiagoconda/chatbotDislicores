
console.log('🛒 Cart module loaded');

const csrf = document.querySelector('meta[name="csrf-token"]').content;

async function request(url, data) {
    const res = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .content
        },
        body: JSON.stringify(data)
    });

    return await res.json();
}

function showNotification(message, type = 'success') {
    const old = document.querySelector('.cart-notification');
    if (old) old.remove();

    const div = document.createElement('div');
    div.className = `cart-notification cart-notification-${type}`;
    div.textContent = message;

    document.body.appendChild(div);

    setTimeout(() => div.classList.add('show'), 10);

    setTimeout(() => {
        div.classList.remove('show');
        setTimeout(() => div.remove(), 300);
    }, 2500);
}


/* =========================================
   Badge
========================================= */

function updateCartBadge(count) {
    const badge = document.getElementById('cart-badge');
    if (!badge) return;

    badge.textContent = count;
    badge.style.display = count > 0 ? 'flex' : 'none';
}


/* =========================================
   Add to Cart
========================================= */

async function addToCart(id, name, price, image = null) {
    const data = await request('/cart/add', {
        product_id: id,
        name,
        price,
        image,
        quantity: 1
    });

    if (data.success) {
        showNotification('✅ Producto agregado');
        updateCartBadge(data.cart_count);
    }
}


/* =========================================
   Remove Item
========================================= */

async function removeItem(id) {
    const data = await request('/cart/remove', {
        product_id: id
    });

    if (data.success) {
        showNotification('🗑️ Eliminado');
        updateCartBadge(data.cart_count);
        location.reload();
    }
}


/* =========================================
   Update Quantity
========================================= */

async function updateQuantity(id, qty) {
    console.log('Updating quantity:', id, qty);
    const data = await request('/cart/update', {
        product_id: id,
        quantity: qty
    });

    if (data.success) {
        updateCartBadge(data.cart_count);
        location.reload();
    }
}


/* =========================================
   Clear Cart
========================================= */

async function clearCart() {
    const data = await request('/cart/clear');

    if (data.success) {
        showNotification('🧹 Carrito vacío');
        updateCartBadge(0);
        location.reload();
    }
}


/* =========================================
   Checkout Modal
========================================= */

function openModal() {
    document.getElementById('checkoutModal')?.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('checkoutModal')?.classList.remove('active');
    document.body.style.overflow = 'auto';
}


/* =========================================
   Load Cart Count
========================================= */

async function loadCartCount() {
    try {
        const res = await fetch('/cart/data');
        const data = await res.json();
        updateCartBadge(data.count);
    } catch {}
}


/* =========================================
   Events (NO onclick)
========================================= */

document.addEventListener('DOMContentLoaded', () => {

    loadCartCount();

    // Add buttons
    document.querySelectorAll('[data-add-cart]').forEach(btn => {
        btn.addEventListener('click', () => {
            addToCart(
                btn.dataset.id,
                btn.dataset.name,
                btn.dataset.price,
                btn.dataset.image
            );
        });
    });

    // Remove buttons
    document.querySelectorAll('[data-remove]').forEach(btn => {
        btn.addEventListener('click', () => {
            removeItem(btn.dataset.remove);
        });
    });

    // Quantity buttons
    // document.querySelectorAll('[data-qty]').forEach(btn => {
    //     btn.addEventListener('click', () => {
    //         updateQuantity(btn.dataset.id, btn.dataset.qty);
    //     });
    // });
    document.querySelectorAll('[data-qty]').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const input = document.querySelector(`[data-qty-input][data-id="${id}"]`);
        const currentQty = parseInt(input.value);
        const amount = parseInt(btn.dataset.amount); // +1 o -1
        const newQty = currentQty + amount;

        if (newQty < 1) return;

        input.value = newQty;
        updateQuantity(id, newQty); // 👈 asegúrate de pasar el nuevo valor, no el viejo
    });
});

    // Clear cart
    document.getElementById('clearCartBtn')
        ?.addEventListener('click', clearCart);

    // Modal
    document.getElementById('checkoutBtn')
        ?.addEventListener('click', openModal);

    document.querySelector('.modal-overlay')
        ?.addEventListener('click', closeModal);

});
document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('checkoutForm');

    form?.addEventListener('submit', submitOrder);

});

// async function submitOrder(e) {
//     e.preventDefault();

//     const form = document.getElementById('checkoutForm');

//     const body = {
//         name: form.name.value,
//         phone: form.phone.value,
//         address: form.address.value,
//         notes: form.notes.value
//     };

//     try {
//         const res = await fetch('/cart/whatsapp', {
//             method: 'POST',
//             credentials: 'same-origin',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': document
//                     .querySelector('meta[name="csrf-token"]').content,
//                 'Accept': 'application/json'
//             },
//             body: JSON.stringify(body)
//         });

//         const data = await res.json();

//         if (data.success) {
//             window.open(data.whatsapp_url, '_blank');

//             closeModal();   // opcional
//             clearCart();    // opcional
//         } else {
//             alert(data.message);
//         }

//     } catch (err) {
//         console.error(err);
//         alert('Error al generar pedido');
//     }
// }

async function submitOrder(e) {
    e.preventDefault();

    const form = document.getElementById('checkoutForm');

    const body = {
        name: form.name.value,
        phone: form.phone.value,
        address: form.address.value,
        notes: form.notes.value
    };

    try {
        const res = await fetch('/cart/whatsapp', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify(body)
        });

        const data = await res.json();

        if (data.success) {
            const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent);
            const isMobile = /Android|iPhone|iPad/.test(navigator.userAgent);

            if (isMobile) {
                // Intenta abrir la app nativa
                window.location.href = data.whatsapp_app_url;

                // Fallback a wa.me si la app no está instalada
                setTimeout(() => {
                    window.location.href = data.whatsapp_url;
                }, 1500);
            } else {
                // Desktop: abre WhatsApp Web en nueva pestaña
                window.open(data.whatsapp_url, '_blank');
            }

            closeModal();
            clearCart();
        } else {
            alert(data.message);
        }

    } catch (err) {
        console.error(err);
        alert('Error al generar pedido');
    }
}