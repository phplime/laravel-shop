<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FoodRush – Fast Delivery</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ═══════════════════════════════════════════
   TOKENS
═══════════════════════════════════════════ */
:root {
  --green:       #2ECC71;
  --green-dark:  #27ae60;
  --orange:      #e8621a;
  --bg:          #f5f5f2;
  --surface:     #ffffff;
  --surface2:    #f0f0eb;
  --text:        #1a1a1a;
  --text-muted:  #888;
  --border:      #e5e5e0;
  --nav-bg:      #111111;
  --shadow:      0 4px 20px rgba(0,0,0,0.08);
  --tr:          0.25s cubic-bezier(.4,0,.2,1);
}
[data-theme="dark"] {
  --bg:          #111111;
  --surface:     #1c1c1c;
  --surface2:    #252525;
  --text:        #f0f0f0;
  --text-muted:  #888;
  --border:      #2e2e2e;
  --nav-bg:      #090909;
  --shadow:      0 4px 24px rgba(0,0,0,0.5);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body {
  font-family: 'DM Sans', sans-serif;
  background: var(--bg);
  color: var(--text);
  transition: background var(--tr), color var(--tr);
  min-height: 100vh;
}

/* ═══════════════════════════════════════════
   DESKTOP NAVBAR  (visible ≥ 768px)
═══════════════════════════════════════════ */
.desk-nav {
  background: var(--nav-bg);
  height: 64px;
  display: flex;
  align-items: center;
  padding: 0 2rem;
  position: sticky;
  top: 0;
  z-index: 900;
  gap: 0;
  box-shadow: 0 2px 16px rgba(0,0,0,0.35);
}
.desk-nav .logo {
  font-family: 'Syne', sans-serif;
  font-weight: 800;
  font-size: 1.35rem;
  color: #fff;
  text-decoration: none;
  display: flex; align-items: center; gap: 8px;
  letter-spacing: -.4px;
  flex-shrink: 0;
}
.desk-nav .logo-dot {
  width: 9px; height: 9px;
  background: var(--green);
  border-radius: 50%;
}
.desk-nav .nav-links {
  display: flex; align-items: center; gap: 2px;
  margin-left: 2rem;
}
.desk-nav .nav-links a {
  color: rgba(255,255,255,.6);
  text-decoration: none;
  font-size: .875rem;
  font-weight: 500;
  padding: 6px 14px;
  border-radius: 8px;
  transition: all var(--tr);
}
.desk-nav .nav-links a:hover { color: #fff; background: rgba(255,255,255,.09); }
.desk-nav .nav-links a.active { color: var(--green); }

.desk-nav .nav-right {
  margin-left: auto;
  display: flex; align-items: center; gap: 8px;
}

/* search */
.desk-search { position: relative; }
.desk-search input {
  background: rgba(255,255,255,.09);
  border: 1px solid rgba(255,255,255,.13);
  border-radius: 10px;
  color: #fff;
  font-family: 'DM Sans', sans-serif;
  font-size: .85rem;
  padding: 7px 14px 7px 36px;
  width: 190px;
  transition: all var(--tr);
}
.desk-search input::placeholder { color: rgba(255,255,255,.35); }
.desk-search input:focus { outline: none; border-color: var(--green); width: 230px; background: rgba(255,255,255,.13); }
.desk-search .si {
  position: absolute; left: 11px; top: 50%; transform: translateY(-50%);
  color: rgba(255,255,255,.38); font-size: .9rem; pointer-events: none;
}

/* lang dropdown */
.lang-wrap { position: relative; }
.lang-btn {
  background: rgba(255,255,255,.09);
  border: 1px solid rgba(255,255,255,.13);
  color: rgba(255,255,255,.8);
  border-radius: 10px;
  padding: 6px 12px;
  font-size: .8rem;
  font-weight: 500;
  display: flex; align-items: center; gap: 6px;
  cursor: pointer;
  transition: all var(--tr);
  font-family: 'DM Sans', sans-serif;
}
.lang-btn:hover { background: rgba(255,255,255,.15); color: #fff; }
.lang-menu {
  background: #1c1c1c;
  border: 1px solid #333;
  border-radius: 10px;
  min-width: 138px;
  padding: 4px;
}
.lang-menu .dropdown-item {
  color: rgba(255,255,255,.7); font-size: .85rem;
  border-radius: 7px; padding: 8px 12px;
  display: flex; align-items: center; gap: 8px;
}
.lang-menu .dropdown-item:hover { background: rgba(255,255,255,.08); color: #fff; }

/* icon btn */
.ni-btn {
  width: 38px; height: 38px;
  background: rgba(255,255,255,.09);
  border: 1px solid rgba(255,255,255,.13);
  border-radius: 10px;
  color: rgba(255,255,255,.75);
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; font-size: 1rem;
  transition: all var(--tr);
  position: relative;
  flex-shrink: 0;
  text-decoration: none;
}
.ni-btn:hover { background: rgba(255,255,255,.16); color: #fff; }

.cart-badge {
  position: absolute; top: -5px; right: -5px;
  background: var(--orange); color: #fff;
  font-size: .6rem; font-weight: 700;
  width: 17px; height: 17px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  border: 2px solid var(--nav-bg);
}

.nav-avatar {
  width: 38px; height: 38px;
  border-radius: 10px;
  background: linear-gradient(135deg, var(--green), var(--green-dark));
  color: #fff; font-weight: 700; font-size: .82rem;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer;
  border: 2px solid transparent;
  transition: all var(--tr);
  flex-shrink: 0;
}
.nav-avatar:hover { border-color: var(--green); transform: scale(1.05); }

/* ═══════════════════════════════════════════
   CART SIDEBAR
═══════════════════════════════════════════ */
.cart-overlay {
  position: fixed; inset: 0;
  background: rgba(0,0,0,.55); backdrop-filter: blur(4px);
  z-index: 1100; opacity: 0; pointer-events: none;
  transition: opacity var(--tr);
}
.cart-overlay.open { opacity: 1; pointer-events: all; }
.cart-sidebar {
  position: fixed; top: 0; right: 0; bottom: 0;
  width: 360px;
  background: var(--surface);
  z-index: 1101;
  transform: translateX(100%);
  transition: transform var(--tr);
  display: flex; flex-direction: column;
  box-shadow: -8px 0 40px rgba(0,0,0,.25);
}
.cart-sidebar.open { transform: translateX(0); }
.cart-hd {
  padding: 1.25rem 1.5rem;
  border-bottom: 1px solid var(--border);
  display: flex; align-items: center; justify-content: space-between;
}
.cart-hd h5 { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 1.05rem; }
.cart-x {
  width: 30px; height: 30px; border-radius: 8px;
  background: var(--surface2); border: none; cursor: pointer;
  color: var(--text); display: flex; align-items: center; justify-content: center;
  transition: all var(--tr);
}
.cart-x:hover { background: var(--border); }
.cart-body { flex: 1; overflow-y: auto; padding: 1rem 1.5rem; }
.cart-row {
  display: flex; align-items: center; gap: 12px;
  padding: 12px 0; border-bottom: 1px solid var(--border);
}
.cart-row img { width: 58px; height: 58px; border-radius: 10px; object-fit: cover; }
.cri { flex: 1; }
.cri h6 { font-weight: 600; font-size: .88rem; margin-bottom: 2px; }
.cri .cp { color: var(--green); font-weight: 700; font-size: .83rem; }
.cri .ck { font-size: .7rem; color: var(--text-muted); }
.cqty { display: flex; align-items: center; gap: 7px; }
.cq-btn {
  width: 25px; height: 25px; border-radius: 50%; border: none;
  background: var(--surface2); color: var(--text);
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; font-size: .82rem; transition: all var(--tr);
}
.cq-btn:hover { background: var(--green); color: #fff; }
.cart-ft { padding: 1.25rem 1.5rem; border-top: 1px solid var(--border); }
.cart-row-total { display: flex; justify-content: space-between; font-size: .9rem; margin-bottom: 6px; }
.cart-row-total.big { font-weight: 800; font-size: 1rem; margin-top: 8px; margin-bottom: 14px; }
.checkout-btn {
  width: 100%; background: var(--green); color: #fff;
  border: none; border-radius: 12px; padding: 13px;
  font-weight: 700; font-size: .92rem; cursor: pointer;
  font-family: 'DM Sans', sans-serif;
  transition: background var(--tr);
}
.checkout-btn:hover { background: var(--green-dark); }

/* ═══════════════════════════════════════════
   PAGE LAYOUT
═══════════════════════════════════════════ */
.page-wrap { max-width: 1080px; margin: 0 auto; padding: 2rem 1.25rem; }

/* ── Desktop greeting (top of desktop page) ── */
.desk-greeting {
  display: flex; align-items: flex-start; justify-content: space-between;
  margin-bottom: 1.75rem;
}
.desk-greeting h2 { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.6rem; }
.desk-greeting .loc { color: var(--text-muted); font-size: .85rem; margin-top: 3px; display: flex; align-items: center; gap: 5px; }
.desk-greeting .loc i { color: var(--orange); }

/* ── Mobile-only header (replaces navbar on mobile) ── */
.mob-header {
  display: none;
  background: var(--bg);
  padding: 1rem 1.1rem 0;
}
.mob-header-top {
  display: flex; align-items: flex-start; justify-content: space-between;
  margin-bottom: .75rem;
}
.mob-header-top h2 { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.45rem; line-height: 1.2; }
.mob-header-top .loc { font-size: .82rem; color: var(--text-muted); display: flex; align-items: center; gap: 4px; margin-top: 3px; }
.mob-header-top .loc i { color: var(--orange); font-size: .85rem; }
.mob-icons { display: flex; gap: 10px; }
.mob-icon-btn {
  width: 40px; height: 40px;
  background: var(--surface2);
  border: 1px solid var(--border);
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  color: var(--text); font-size: 1rem; cursor: pointer;
  position: relative;
  transition: all var(--tr);
}
[data-theme="dark"] .mob-icon-btn {
  background: #252525;
  border-color: #333;
}
.mob-icon-btn:hover { background: var(--border); }

/* ── Search bar ── */
.search-bar {
  position: relative; margin-bottom: 1.5rem;
}
.search-bar input {
  width: 100%;
  background: var(--surface);
  border: 1.5px solid var(--border);
  border-radius: 50px;
  padding: 11px 44px 11px 42px;
  font-size: .9rem;
  color: var(--text);
  font-family: 'DM Sans', sans-serif;
  transition: all var(--tr);
}
.search-bar input:focus { outline: none; border-color: var(--green); }
.search-bar input::placeholder { color: var(--text-muted); }
.search-bar .si { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--text-muted); }
.search-bar .fi { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: var(--text-muted); cursor: pointer; font-size: .95rem; }

/* ── Categories ── */
.cats-row { display: flex; gap: 10px; overflow-x: auto; padding-bottom: 4px; margin-bottom: 1.5rem; scroll-snap-type: x mandatory; }
.cats-row::-webkit-scrollbar { display: none; }
.cat-item {
  display: flex; flex-direction: column; align-items: center; gap: 6px;
  flex-shrink: 0; scroll-snap-align: start; cursor: pointer;
  min-width: 64px;
}
/* Image circle — matches the design exactly */
.cat-img {
  width: 62px; height: 62px;
  border-radius: 50%;
  overflow: hidden;
  border: 2.5px solid transparent;
  transition: all var(--tr);
  background: var(--surface);
  box-shadow: var(--shadow);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.9rem;
}
.cat-item:hover .cat-img, .cat-item.active .cat-img {
  border-color: var(--green);
  transform: translateY(-2px);
}
.cat-label {
  font-size: .68rem; font-weight: 500;
  color: var(--text-muted); text-align: center;
  line-height: 1.3;
  max-width: 64px;
}
.cat-item.active .cat-label { color: var(--green); font-weight: 700; }

/* ── Promo Banner ── */
.promo-banner {
  border-radius: 18px;
  background: linear-gradient(120deg, #1e1000 0%, #3b1f00 55%, #522c00 100%);
  display: flex; align-items: flex-end; justify-content: space-between;
  padding: 1.4rem 1.4rem 1.4rem 1.5rem;
  margin-bottom: 1.75rem;
  overflow: hidden;
  position: relative;
  min-height: 165px;
}
.promo-text { z-index: 1; flex: 1; }
.promo-text .pt { color: rgba(255,255,255,.6); font-size: .78rem; font-weight: 600; letter-spacing: .3px; margin-bottom: 6px; }
.promo-text h3 {
  color: #fff; font-family: 'Syne', sans-serif; font-weight: 700;
  font-size: 1.05rem; line-height: 1.4; margin-bottom: 14px;
}
.promo-text h3 .hl { color: var(--orange); }
.promo-order-btn {
  display: inline-flex; align-items: center;
  background: var(--orange); color: #fff;
  border: none; border-radius: 10px;
  padding: 9px 20px; font-weight: 700; font-size: .85rem;
  cursor: pointer; font-family: 'DM Sans', sans-serif;
  transition: all var(--tr);
}
.promo-order-btn:hover { background: #cf5316; transform: scale(1.03); }
.promo-chef {
  width: 120px; flex-shrink: 0; align-self: flex-end;
  margin-bottom: -1.4rem; margin-right: -0.3rem;
  position: relative; z-index: 1;
}
.promo-chef img { width: 100%; object-fit: contain; display: block; }

/* ── Section header ── */
.sec-hd { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; }
.sec-hd h4 { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 1.05rem; }
.sec-hd a { color: var(--green); font-size: .85rem; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 3px; }
.sec-hd a:hover { color: var(--green-dark); }

/* ── Food cards ── */
.food-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
  gap: 1.25rem;
}
.food-card {
  background: var(--surface);
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid var(--border);
  box-shadow: var(--shadow);
  transition: all var(--tr);
}
.food-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,.13); }
.fc-img { height: 145px; overflow: hidden; }
.fc-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s ease; }
.food-card:hover .fc-img img { transform: scale(1.06); }
.fc-body { padding: 12px 13px 13px; }
.fc-kitchen { font-size: .7rem; color: var(--text-muted); margin-bottom: 3px; }
.fc-name { font-weight: 700; font-size: .92rem; margin-bottom: 5px; }
.fc-price { font-weight: 700; font-size: .92rem; margin-bottom: 5px; }
.fc-meta { display: flex; align-items: center; gap: 5px; font-size: .72rem; color: var(--text-muted); margin-bottom: 11px; }
.fc-meta .star { color: #f5a623; font-size: .78rem; }
.fc-actions { display: flex; align-items: center; gap: 8px; }
.order-btn {
  flex: 1; background: var(--green); color: #fff;
  border: none; border-radius: 30px;
  padding: 9px 0; font-weight: 700; font-size: .85rem;
  cursor: pointer; font-family: 'DM Sans', sans-serif;
  transition: all var(--tr);
}
.order-btn:hover { background: var(--green-dark); }
.qty-ctrl { display: flex; align-items: center; gap: 5px; }
.qb {
  width: 26px; height: 26px; border-radius: 50%; border: none;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; font-size: .88rem; font-weight: 700;
  transition: all var(--tr);
}
.qb.minus { background: #fde8e8; color: #e74c3c; }
.qb.plus  { background: #e8f5e9; color: var(--green-dark); }
[data-theme="dark"] .qb.minus { background: #3d1515; }
[data-theme="dark"] .qb.plus  { background: #1a3d1a; }
.qb:hover { transform: scale(1.12); }
.qn { font-weight: 700; font-size: .88rem; min-width: 14px; text-align: center; }

/* ═══════════════════════════════════════════
   MOBILE BOTTOM NAV
═══════════════════════════════════════════ */
.mob-bottom-nav {
  display: none;
  position: fixed; bottom: 0; left: 0; right: 0;
  z-index: 800;
  padding: 0 1rem 1.5rem;
  background: transparent;
  pointer-events: none;
}
.mob-bottom-inner {
  background: #111;
  border-radius: 30px;
  display: flex; align-items: center; justify-content: space-around;
  padding: 10px 8px;
  pointer-events: all;
  box-shadow: 0 -4px 30px rgba(0,0,0,.4);
}
[data-theme="dark"] .mob-bottom-inner { background: #0a0a0a; }
.bn-item {
  display: flex; align-items: center; justify-content: center;
  width: 46px; height: 46px;
  border-radius: 50%;
  color: rgba(255,255,255,.45);
  cursor: pointer; font-size: 1.2rem;
  transition: all var(--tr);
}
.bn-item:hover { color: rgba(255,255,255,.8); }
.bn-item.active {
  background: var(--green);
  color: #fff;
}

/* ═══════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════ */

/* Tablet: hide lang on smaller desktop */
@media (max-width: 960px) {
  .lang-wrap { display: none !important; }
}

/* Mobile: ≤ 767px */
@media (max-width: 767px) {
  /* Hide desktop nav entirely */
  .desk-nav { display: none; }

  /* Show mobile header */
  .mob-header { display: block; }

  /* Show mobile bottom nav */
  .mob-bottom-nav { display: flex; }

  /* Page padding accounts for bottom nav */
  .page-wrap { padding: 0 0 90px; }

  /* Desktop greeting hidden */
  .desk-greeting { display: none; }

  /* Search bar full-width, inside page-wrap on mobile */
  .mob-search-wrap {
    padding: 0.85rem 1.1rem 0;
  }

  /* Categories */
  .cats-row { padding-left: 1.1rem; padding-right: 1.1rem; }

  /* Promo */
  .promo-wrap { padding: 0 1.1rem; }
  .promo-banner { min-height: 150px; padding: 1.1rem 1rem 0 1.2rem; border-radius: 16px; }
  .promo-text h3 { font-size: .95rem; }
  .promo-chef { width: 100px; }

  /* Section header */
  .sec-hd-wrap { padding: 0 1.1rem; }
  .sec-hd { margin-bottom: .75rem; }

  /* 2-column food grid on mobile — EXACTLY like the image */
  .food-grid-wrap { padding: 0 1.1rem; }
  .food-grid {
    grid-template-columns: 1fr 1fr;
    gap: .85rem;
  }
  .fc-img { height: 110px; }
  .fc-body { padding: 9px 10px 11px; }
  .fc-name { font-size: .83rem; }
  .fc-price { font-size: .83rem; }
  .fc-meta { font-size: .67rem; gap: 4px; }
  .order-btn { font-size: .78rem; padding: 8px 0; }
  .qb { width: 22px; height: 22px; font-size: .8rem; }
  .qn { font-size: .8rem; }
  .fc-actions { gap: 5px; }
}

/* ═══════════════════════════════════════════
   ANIMATIONS
═══════════════════════════════════════════ */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(18px); }
  to   { opacity: 1; transform: translateY(0); }
}
.food-card { animation: fadeUp .38s ease both; }
.food-card:nth-child(2) { animation-delay: .05s; }
.food-card:nth-child(3) { animation-delay: .10s; }
.food-card:nth-child(4) { animation-delay: .15s; }
.food-card:nth-child(5) { animation-delay: .20s; }
.food-card:nth-child(6) { animation-delay: .25s; }
</style>
</head>
<body>

<!-- ═════════════════════════════════════════
     DESKTOP NAVBAR
════════════════════════════════════════════ -->
<nav class="desk-nav">
  <a href="#" class="logo"><span class="logo-dot"></span>FoodRush</a>

  <div class="nav-links">
    <a href="#" class="active">Home</a>
    <a href="#">Menu</a>
    <a href="#">Orders</a>
  </div>

  <div class="nav-right">
    <!-- Search -->
    <div class="desk-search">
      <i class="bi bi-search si"></i>
      <input type="text" placeholder="Search dishes...">
    </div>

    <!-- Language -->
    <div class="lang-wrap dropdown">
      <button class="lang-btn dropdown-toggle" data-bs-toggle="dropdown">
        <i class="bi bi-globe2"></i> EN
      </button>
      <ul class="dropdown-menu lang-menu">
        <li><a class="dropdown-item" href="#">🇬🇧 English</a></li>
        <li><a class="dropdown-item" href="#">🇫🇷 Français</a></li>
        <li><a class="dropdown-item" href="#">🇰🇪 Swahili</a></li>
        <li><a class="dropdown-item" href="#">🇪🇸 Español</a></li>
      </ul>
    </div>

    <!-- Cart -->
    <button class="ni-btn" onclick="openCart()">
      <i class="bi bi-cart2"></i>
      <span class="cart-badge" id="cartCount">3</span>
    </button>

    <!-- Theme toggle -->
    <button class="ni-btn" onclick="toggleTheme()" title="Toggle theme">
      <i id="themeIcon" class="bi bi-moon-stars-fill"></i>
    </button>

    <!-- Profile -->
    <div class="nav-avatar">SH</div>
  </div>
</nav>

<!-- ═════════════════════════════════════════
     CART SIDEBAR
════════════════════════════════════════════ -->
<div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>
<div class="cart-sidebar" id="cartSidebar">
  <div class="cart-hd">
    <h5><i class="bi bi-cart3 me-2" style="color:var(--green)"></i>Your Cart <span style="color:var(--text-muted);font-weight:400;font-size:.82rem">(3 items)</span></h5>
    <button class="cart-x" onclick="closeCart()"><i class="bi bi-x-lg"></i></button>
  </div>
  <div class="cart-body">
    <div class="cart-row">
      <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=120&h=120&fit=crop" alt="Pizza">
      <div class="cri">
        <h6>Pizza Pepperoni</h6>
        <div class="cp">Ksh 1,500</div>
        <div class="ck">Kitchen: Dominos</div>
      </div>
      <div class="cqty">
        <button class="cq-btn">−</button>
        <span style="font-weight:700;font-size:.88rem">1</span>
        <button class="cq-btn">+</button>
      </div>
    </div>
    <div class="cart-row">
      <img src="https://images.unsplash.com/photo-1626645738196-c2a7c87a8f58?w=120&h=120&fit=crop" alt="Fries">
      <div class="cri">
        <h6>Fries and Chicken</h6>
        <div class="cp">Ksh 1,200</div>
        <div class="ck">Kitchen: Galitos</div>
      </div>
      <div class="cqty">
        <button class="cq-btn">−</button>
        <span style="font-weight:700;font-size:.88rem">2</span>
        <button class="cq-btn">+</button>
      </div>
    </div>
    <div class="cart-row">
      <img src="https://images.unsplash.com/photo-1547592180-85f173990554?w=120&h=120&fit=crop" alt="Sushi">
      <div class="cri">
        <h6>Sushi Platter</h6>
        <div class="cp">Ksh 2,400</div>
        <div class="ck">Kitchen: Tokyo House</div>
      </div>
      <div class="cqty">
        <button class="cq-btn">−</button>
        <span style="font-weight:700;font-size:.88rem">1</span>
        <button class="cq-btn">+</button>
      </div>
    </div>
  </div>
  <div class="cart-ft">
    <div class="cart-row-total"><span>Subtotal</span><span style="color:var(--green);font-weight:700">Ksh 6,300</span></div>
    <div class="cart-row-total"><span style="color:var(--text-muted)">Delivery fee</span><span style="color:var(--text-muted)">Ksh 150</span></div>
    <div class="cart-row-total big"><span>Total</span><span>Ksh 6,450</span></div>
    <button class="checkout-btn"><i class="bi bi-bag-check me-2"></i>Checkout</button>
  </div>
</div>

<!-- ═════════════════════════════════════════
     MOBILE HEADER (visible only on mobile)
════════════════════════════════════════════ -->
<div class="mob-header" id="mobHeader">
  <div class="mob-header-top">
    <div>
      <h2>Hi, Sheila</h2>
      <div class="loc"><i class="bi bi-geo-alt-fill"></i> Kenyatta university, Nairobi.</div>
    </div>
    <div class="mob-icons">
      <button class="mob-icon-btn" onclick="openCart()">
        <i class="bi bi-cart2"></i>
        <span class="cart-badge" style="border-color:var(--surface2)">3</span>
      </button>
      <button class="mob-icon-btn">
        <i class="bi bi-bell"></i>
      </button>
    </div>
  </div>
</div>

<!-- ═════════════════════════════════════════
     MAIN PAGE
════════════════════════════════════════════ -->
<main class="page-wrap">

  <!-- Desktop greeting -->
  <div class="desk-greeting">
    <div>
      <h2>Hi, Sheila 👋</h2>
      <div class="loc"><i class="bi bi-geo-alt-fill"></i> Kenyatta University, Nairobi.</div>
    </div>
  </div>

  <!-- Search -->
  <div class="mob-search-wrap">
    <div class="search-bar">
      <i class="bi bi-search si"></i>
      <input type="text" placeholder="Local and international dishes">
      <i class="bi bi-sliders fi"></i>
    </div>
  </div>

  <!-- Categories -->
  <div class="cats-row">
    <div class="cat-item active" onclick="selectCat(this)">
      <div class="cat-img">🍚</div>
      <div class="cat-label">Rice and chicken</div>
    </div>
    <div class="cat-item" onclick="selectCat(this)">
      <div class="cat-img">🍲</div>
      <div class="cat-label">Vegetable soup</div>
    </div>
    <div class="cat-item" onclick="selectCat(this)">
      <div class="cat-img">🍔</div>
      <div class="cat-label">Beef burger</div>
    </div>
    <div class="cat-item" onclick="selectCat(this)">
      <div class="cat-img">🍣</div>
      <div class="cat-label">Sushi</div>
    </div>
    <div class="cat-item" onclick="selectCat(this)">
      <div class="cat-img">🥟</div>
      <div class="cat-label">Dumplings</div>
    </div>
    <div class="cat-item" onclick="selectCat(this)">
      <div class="cat-img">🍕</div>
      <div class="cat-label">Pizza</div>
    </div>
    <div class="cat-item" onclick="selectCat(this)">
      <div class="cat-img">🌮</div>
      <div class="cat-label">Tacos</div>
    </div>
  </div>

  <!-- Promo -->
  <div class="promo-wrap">
    <div class="promo-banner">
      <div class="promo-text">
        <div class="pt">Hurry now!!</div>
        <h3>Get your favorite meal<br>for a <span class="hl">50%</span> discount this<br>seasonal period</h3>
        <button class="promo-order-btn">Order now</button>
      </div>
      <div class="promo-chef">
        <img src="https://images.unsplash.com/photo-1583394293214-c6a40ef01808?w=240&h=320&fit=crop&crop=top" alt="Chef">
      </div>
    </div>
  </div>

  <!-- Most Popular -->
  <div class="sec-hd-wrap" style="margin-top:1.5rem">
    <div class="sec-hd">
      <h4>Most popular</h4>
      <a href="#">see all <i class="bi bi-chevron-right"></i></a>
    </div>
  </div>

  <div class="food-grid-wrap">
    <div class="food-grid">

      <!-- Card 1 -->
      <div class="food-card">
        <div class="fc-img">
          <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=500&h=300&fit=crop" alt="Pizza Pepperoni">
        </div>
        <div class="fc-body">
          <div class="fc-kitchen">Kitchen: Dominos</div>
          <div class="fc-name">Pizza Pepperoni</div>
          <div class="fc-price">Ksh 1,500</div>
          <div class="fc-meta"><span class="star">★</span><span>(5.0)</span><span>2000+ Orders</span></div>
          <div class="fc-actions">
            <button class="order-btn" onclick="addToCart(this)">Order</button>
            <div class="qty-ctrl">
              <button class="qb minus" onclick="decQty(this)">−</button>
              <span class="qn">1</span>
              <button class="qb plus" onclick="incQty(this)">+</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="food-card">
        <div class="fc-img">
          <img src="https://images.unsplash.com/photo-1626645738196-c2a7c87a8f58?w=500&h=300&fit=crop" alt="Fries and Chicken">
        </div>
        <div class="fc-body">
          <div class="fc-kitchen">Kitchen: Galitos</div>
          <div class="fc-name">Fries and chicken</div>
          <div class="fc-price">Ksh 1,200</div>
          <div class="fc-meta"><span class="star">★</span><span>(5.0)</span><span>1200+ Orders</span></div>
          <div class="fc-actions">
            <button class="order-btn" onclick="addToCart(this)">Order</button>
            <div class="qty-ctrl">
              <button class="qb minus" onclick="decQty(this)">−</button>
              <span class="qn">1</span>
              <button class="qb plus" onclick="incQty(this)">+</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="food-card">
        <div class="fc-img">
          <img src="https://images.unsplash.com/photo-1547592180-85f173990554?w=500&h=300&fit=crop" alt="Sushi Platter">
        </div>
        <div class="fc-body">
          <div class="fc-kitchen">Kitchen: Tokyo House</div>
          <div class="fc-name">Sushi Platter</div>
          <div class="fc-price">Ksh 2,400</div>
          <div class="fc-meta"><span class="star">★</span><span>(4.8)</span><span>850+ Orders</span></div>
          <div class="fc-actions">
            <button class="order-btn" onclick="addToCart(this)">Order</button>
            <div class="qty-ctrl">
              <button class="qb minus" onclick="decQty(this)">−</button>
              <span class="qn">1</span>
              <button class="qb plus" onclick="incQty(this)">+</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="food-card">
        <div class="fc-img">
          <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500&h=300&fit=crop" alt="Beef Burger">
        </div>
        <div class="fc-body">
          <div class="fc-kitchen">Kitchen: Burger Barn</div>
          <div class="fc-name">Beef Burger Deluxe</div>
          <div class="fc-price">Ksh 950</div>
          <div class="fc-meta"><span class="star">★</span><span>(4.9)</span><span>3200+ Orders</span></div>
          <div class="fc-actions">
            <button class="order-btn" onclick="addToCart(this)">Order</button>
            <div class="qty-ctrl">
              <button class="qb minus" onclick="decQty(this)">−</button>
              <span class="qn">1</span>
              <button class="qb plus" onclick="incQty(this)">+</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="food-card">
        <div class="fc-img">
          <img src="https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=500&h=300&fit=crop" alt="Ramen">
        </div>
        <div class="fc-body">
          <div class="fc-kitchen">Kitchen: Noodle Palace</div>
          <div class="fc-name">Tonkotsu Ramen</div>
          <div class="fc-price">Ksh 1,100</div>
          <div class="fc-meta"><span class="star">★</span><span>(4.7)</span><span>620+ Orders</span></div>
          <div class="fc-actions">
            <button class="order-btn" onclick="addToCart(this)">Order</button>
            <div class="qty-ctrl">
              <button class="qb minus" onclick="decQty(this)">−</button>
              <span class="qn">1</span>
              <button class="qb plus" onclick="incQty(this)">+</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 6 -->
      <div class="food-card">
        <div class="fc-img">
          <img src="https://images.unsplash.com/photo-1555126634-323283e090fa?w=500&h=300&fit=crop" alt="Dumplings">
        </div>
        <div class="fc-body">
          <div class="fc-kitchen">Kitchen: Dim Sum Co.</div>
          <div class="fc-name">Steamed Dumplings</div>
          <div class="fc-price">Ksh 800</div>
          <div class="fc-meta"><span class="star">★</span><span>(4.6)</span><span>410+ Orders</span></div>
          <div class="fc-actions">
            <button class="order-btn" onclick="addToCart(this)">Order</button>
            <div class="qty-ctrl">
              <button class="qb minus" onclick="decQty(this)">−</button>
              <span class="qn">1</span>
              <button class="qb plus" onclick="incQty(this)">+</button>
            </div>
          </div>
        </div>
      </div>

    </div><!-- /food-grid -->
  </div><!-- /food-grid-wrap -->

</main>

<!-- ═════════════════════════════════════════
     MOBILE BOTTOM NAV  (exact image match)
════════════════════════════════════════════ -->
<div class="mob-bottom-nav">
  <div class="mob-bottom-inner">
    <!-- Home – active green circle -->
    <div class="bn-item active">
      <i class="bi bi-house-fill"></i>
    </div>
    <!-- Cart -->
    <div class="bn-item" onclick="openCart()">
      <i class="bi bi-cart2"></i>
    </div>
    <!-- Orders / bag-location -->
    <div class="bn-item">
      <i class="bi bi-bag-heart"></i>
    </div>
    <!-- Profile -->
    <div class="bn-item">
      <i class="bi bi-person"></i>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script>
  let cartCount = 3;

  /* Theme */
  function toggleTheme() {
    const html = document.documentElement;
    const dark = html.getAttribute('data-theme') === 'dark';
    html.setAttribute('data-theme', dark ? 'light' : 'dark');
    document.getElementById('themeIcon').className = dark ? 'bi bi-moon-stars-fill' : 'bi bi-sun-fill';
  }

  /* Cart sidebar */
  function openCart() {
    document.getElementById('cartOverlay').classList.add('open');
    document.getElementById('cartSidebar').classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeCart() {
    document.getElementById('cartOverlay').classList.remove('open');
    document.getElementById('cartSidebar').classList.remove('open');
    document.body.style.overflow = '';
  }

  /* Category selection */
  function selectCat(el) {
    document.querySelectorAll('.cat-item').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
  }

  /* Qty controls */
  function incQty(btn) {
    const n = btn.previousElementSibling;
    n.textContent = parseInt(n.textContent) + 1;
  }
  function decQty(btn) {
    const n = btn.nextElementSibling;
    const v = parseInt(n.textContent);
    if (v > 0) n.textContent = v - 1;
  }

  /* Add to cart */
  function addToCart(btn) {
    cartCount++;
    document.querySelectorAll('#cartCount, .cart-badge').forEach(el => el.textContent = cartCount);
    const orig = btn.textContent;
    btn.textContent = '✓ Added';
    btn.style.background = 'var(--green-dark)';
    setTimeout(() => { btn.textContent = orig; btn.style.background = ''; }, 1300);
  }

  /* Bottom nav active state */
  document.querySelectorAll('.bn-item').forEach(item => {
    item.addEventListener('click', function() {
      if (this.getAttribute('onclick')) return;
      document.querySelectorAll('.bn-item').forEach(i => i.classList.remove('active'));
      this.classList.add('active');
    });
  });
</script>
</body>
</html>