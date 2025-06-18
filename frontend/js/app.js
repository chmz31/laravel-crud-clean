document.addEventListener("DOMContentLoaded", () => {
    fetch("http://127.0.0.1:8000/api/products/get")
      .then(res => res.json())
      .then(data => {
        const container = document.getElementById("productGrid");

        data.forEach(product => {
         const col = document.createElement("div");
            col.className = `col-6 col-sm-4 col-md-3 product-card tipo-${product.id}`;

          col.innerHTML = `
          <a href="product.html?id=${product.id}" class="text-decoration-none text-dark">
            <img alt="${product.name}">
            <div class="product-category">${product.category?.name || 'Haircare'}</div>
            <div class="product-name">${product.name}</div>
            <div class="product-price">${parseFloat(product.price).toFixed(2)} €</div>
          `;

          container.appendChild(col);
        });
      })
      .catch(err => console.error("Error al cargar productos:", err));
  });

  document.getElementById('openCart').addEventListener('click', function (e) {
  e.preventDefault();
  Cart.open();
});

// search dropdown
document.addEventListener("DOMContentLoaded", () => {
  const openSearchBtn = document.getElementById('openSearch');
  const searchDropdown = document.getElementById('searchDropdown');
  const closeSearchBtn = document.getElementById('closeSearch');

  if (openSearchBtn) {
    openSearchBtn.addEventListener('click', e => {
      e.preventDefault();
      searchDropdown.classList.remove('d-none');
    });
  }

  if (closeSearchBtn) {
    closeSearchBtn.addEventListener('click', () => {
      searchDropdown.classList.add('d-none');
    });
  }
});

  // futuro: fetch a /api/search cuando el usuario escriba

