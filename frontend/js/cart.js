const Cart = {
  key: 'cart',
  items: [],

  init() {
    this.load();
    this.updateBadge();
  },

  load() {
    const saved = localStorage.getItem(this.key);
    this.items = saved ? JSON.parse(saved) : [];
  },

  save() {
    localStorage.setItem(this.key, JSON.stringify(this.items));
    this.render();
    this.updateBadge();
  },

  add(product) {
    const existing = this.items.find(p => p.id === product.id);
    if (existing) {
      existing.qty++;
    } else {
      product.qty = 1;
      this.items.push(product);
    }
    this.save();
  },

  remove(id) {
    this.items = this.items.filter(p => p.id !== id);
    this.save();
  },

  open() {
  const sidebar = document.getElementById('cartSidebar');
  sidebar.classList.add('cart-open');
  sidebar.classList.remove('cart-closed');
  this.render();
},

 close() {
  const sidebar = document.getElementById('cartSidebar');
  sidebar.classList.remove('cart-open');
  sidebar.classList.add('cart-closed');
},

  updateBadge() {
    const total = this.items.reduce((sum, p) => sum + p.qty, 0);
    const badge = document.getElementById('cartCount');
    if (badge) badge.textContent = total;
  },

 render() {
  const container = document.getElementById('cartItems');
  const subtotal = this.items.reduce((sum, p) => sum + p.price * p.qty, 0);

  // Render básico sin botones aún
  container.innerHTML = this.items.map(p => `
    <div class="mb-3 cart-item" data-id="${p.id}">
      <strong>${p.name}</strong><br>
      ${p.qty} × ${p.price.toFixed(2)}€
      <button class="btn btn-sm btn-outline-danger float-end remove-item">x</button>
    </div>
  `).join('');
 // Agregar listeners a los botones
  document.querySelectorAll('.remove-item').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const parent = btn.closest('.cart-item');
      const id = parseInt(parent.getAttribute('data-id'));
      Cart.remove(id);
    });
  });
  document.getElementById('cartSubtotal').textContent = `${subtotal.toFixed(2)}€`;
  document.getElementById('cartTotal').textContent = `${(subtotal + 5).toFixed(2)}€`;

  this.updateBadge(); // también se asegura de que el número cambie dinámicamente
 }
};

document.addEventListener("DOMContentLoaded", () => {
  Cart.init();

  const openCartBtn = document.getElementById("openCart");
  if (openCartBtn) {
    openCartBtn.addEventListener("click", e => {
      e.preventDefault();
      Cart.open();
    });
  }
});


