document.addEventListener("DOMContentLoaded", () => {
  const params = new URLSearchParams(window.location.search);
  const id = params.get("id");

  if (!id) {
    document.getElementById("productDetail").innerHTML = "<p>Producto no especificado.</p>";
    return;
  }

  fetch(`http://127.0.0.1:8000/api/products/get/${id}`)
    .then(res => res.json())
    .then(data => {
      if (!data.status || !data.product) {
        document.getElementById("productDetail").innerHTML = "<p>Producto no encontrado.</p>";
        return;
      }

      const product = data.product;

      const html = `
        <div class="row align-items-center">
          <div class="col-md-6 text-center tipo-${product.id}">
            <img alt="${product.name}" class="img-fluid mb-4" style="max-height: 400px;">
          </div>
          <div class="col-md-6">
            <h2 class="mb-3">${product.name}</h2>
            <p class="fs-4 fw-semibold">${parseFloat(product.price).toFixed(2)} €</p>
            <p class="text-muted">${product.description}</p>
            <button id="addToCart" class="btn btn-dark mt-3">ADD TO CART</button>
          </div>
        </div>
      `;

      document.getElementById("productDetail").innerHTML = html;

      // ✅ Ahora sí: addToCart ya existe en el DOM
      document.getElementById("addToCart").addEventListener("click", () => {
        Cart.add({
          id: product.id,
          name: product.name,
          price: parseFloat(product.price)
        });
        Cart.open();
      });
    })
    .catch(err => {
      console.error("Error al cargar producto:", err);
      document.getElementById("productDetail").innerHTML = "<p>Error al cargar producto.</p>";
    });

  document.getElementById("openCart").addEventListener("click", function (e) {
    e.preventDefault();
    Cart.open();
  });
});


