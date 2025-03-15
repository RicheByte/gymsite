document.addEventListener("DOMContentLoaded", function () {
    // Fetch products
    fetch('php/get_products.php')
      .then(response => response.json())
      .then(products => {
        const productGrid = document.getElementById('product-grid');
        products.forEach(product => {
          const productCard = `
            <div class="col-md-4">
              <div class="product-card">
                <img src="${product.image}" alt="${product.name}">
                <h3>${product.name}</h3>
                <p>$${product.price}</p>
                <button class="btn-add-to-cart" data-id="${product.id}">Add to Cart</button>
              </div>
            </div>
          `;
          productGrid.innerHTML += productCard;
        });
  
        // Add to cart functionality
        document.querySelectorAll('.btn-add-to-cart').forEach(button => {
          button.addEventListener('click', e => {
            const productId = e.target.getAttribute('data-id');
            addToCart(productId);
          });
        });
      });
  
    // Update cart count
    updateCartCount();
  });
  
  function addToCart(productId) {
    fetch('php/add_to_cart.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ product_id: productId })
    })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          alert('Product added to cart!');
          updateCartCount();
        } else {
          alert(data.message);
        }
      });
  }
  
  function updateCartCount() {
    fetch('php/get_cart.php')
      .then(response => response.json())
      .then(cartItems => {
        document.getElementById('cart-count').textContent = cartItems.length;
      });
  }
  
  function placeOrder() {
    fetch('php/place_order.php', {
      method: 'POST'
    })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          alert('Order placed successfully!');
          window.location.href = 'shop.html';
        } else {
          alert(data.message);
        }
      });
  }