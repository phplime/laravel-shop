
@php
$cartCount = $cartCount ?? session('cart_count', 0);
$userInitials = $userInitials ?? collect(explode(' ', user('name') ?? 'U'))
->map(fn($w) => strtoupper($w[0]))->take(2)->implode('');
$navLinks = $navLinks ?? [
['label' => 'Home', 'url' => url('/'), 'active' => request()->is('/')],
['label' => 'Menu', 'url' => url('/menu'), 'active' => request()->is('menu*')],
['label' => 'Orders', 'url' => url('/orders'), 'active' => request()->is('orders*')],
];
$locales = [
'en' => ['flag' => '🇬🇧', 'name' => 'English'],
'fr' => ['flag' => '🇫🇷', 'name' => 'Français'],
'sw' => ['flag' => '🇰🇪', 'name' => 'Swahili'],
'es' => ['flag' => '🇪🇸', 'name' => 'Español'],
];
$currentLocale = app()->getLocale();
$currentFlag = $locales[$currentLocale]['flag'] ?? '🌐';
@endphp

{{-- ══════════════════════════════════════════════
     DESKTOP NAVBAR  (visible ≥ 768px)
══════════════════════════════════════════════ --}}
<nav class="desk-nav">

    <a href="{{ url('/') }}" class="logo">
        <span class="logo-dot"></span>
        {{ $appName ?? config('app.name', 'FoodRush') }}
    </a>

    <div class="nav-links">
        @foreach($navLinks as $link)
        <a href="{{ $link['url'] }}" class="{{ $link['active'] ? 'active' : '' }}">
            {{ $link['label'] }}
        </a>
        @endforeach
    </div>

    <div class="nav-right">

        {{-- Search --}}
        <form action="{{ url('/search') }}" method="GET" class="desk-search">
            <input type="text" name="q" placeholder="Search dishes...">
            <button type="submit" class="si-btn">
                <i class="bi bi-search"></i>
            </button>
        </form>

        {{-- Language switcher --}}
        <div class="dropdown">
            <button class="ni-btn dropdown-toggle no-caret" data-toggle="dropdown" data-display="static">
                <span class="flag-icon">{{ $currentFlag }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-header">Select Language</li>
                @foreach($locales as $code => $lang)
                <li>
                    <a class="dropdown-item {{ $currentLocale == $code ? 'active' : '' }}" href="{{ url('/lang/'.$code) }}">
                        <span>{{ $lang['flag'] }}</span> {{ $lang['name'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        {{-- Cart --}}
        <button class="ni-btn" onclick="openCart()">
            <i class="bi bi-cart2"></i>
            @livewire('cart.count')
        </button>

        {{-- Theme toggle --}}
        <button class="ni-btn" onclick="toggleTheme()" title="Toggle theme">
            <i id="themeIcon" class="bi bi-moon-stars-fill"></i>
        </button>

        {{-- User dropdown --}}
        <div class="dropdown">
            <div class="nav-avatar dropdown-toggle" data-toggle="dropdown" data-display="static">
                {{ $userInitials }}
            </div>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">Account Settings</div>
                <a class="dropdown-item" href="{{ url('/profile') }}">
                    <i class="bi bi-person-circle"></i> My Profile
                </a>
                <a class="dropdown-item" href="{{ url('/orders') }}">
                    <i class="bi bi-clock-history"></i> Order History
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="{{ url('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

    </div>
</nav>

{{-- ══════════════════════════════════════════════
     MOBILE HEADER  (visible ≤ 767px)
══════════════════════════════════════════════ --}}
<div class="mob-header" id="mobHeader">
    <div class="mob-header-top">

        {{-- Greeting + location --}}
        <div>
            <h2>Hi, {{ Str::before(user('name') ?? 'there', ' ') }} 👋</h2>
            <div class="loc">
                <i class="bi bi-geo-alt-fill"></i>
                {{ $userLocation ?? 'Nairobi, Kenya.' }}
            </div>
        </div>

        {{-- Icon buttons --}}
        <div class="mob-icons">
            <div class="dropdown">
                <button class="mob-icon-btn dropdown-toggle no-caret" data-toggle="dropdown" data-display="static">
                    <span>{{ $currentFlag }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-header">Language</li>
                    @foreach($locales as $code => $lang)
                    <li>
                        <a class="dropdown-item {{ $currentLocale == $code ? 'active' : '' }}" href="{{ url('/lang/'.$code) }}">
                            <span>{{ $lang['flag'] }}</span> {{ $lang['name'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <button class="mob-icon-btn" onclick="openCart()">
                <i class="bi bi-cart2"></i>
                @livewire('cart.count')
            </button>
            <button class="mob-icon-btn" onclick="toggleTheme()">
                <i id="themeIconMob" class="bi bi-moon-stars-fill"></i>
            </button>
        </div>

    </div>
</div>




<!-- ═════════════════════════════════════════
     MOBILE BOTTOM NAV  (exact image match)
════════════════════════════════════════════ -->
<div class="mob-bottom-nav">
    <div class="mob-bottom-inner">
        <!-- Home -->
        <a href="{{ url('/') }}" class="bn-item {{ request()->is('/') ? 'active' : '' }}">
            <i class="bi bi-house-fill"></i>
        </a>

        <!-- Search/Categories -->
        <div class="bn-item">
            <i class="bi bi-grip-vertical"></i>
        </div>

        <!-- Spacer for central floating button -->
        <div class="bn-spacer"></div>

        <!-- Orders -->
        <a href="{{ url('/orders') }}" class="bn-item {{ request()->is('orders*') ? 'active' : '' }}">
            <i class="bi bi-bag-heart"></i>
        </a>

        <!-- Profile -->
        <a href="{{ url('/profile') }}" class="bn-item {{ request()->is('profile*') ? 'active' : '' }}">
            <i class="bi bi-person"></i>
        </a>

        <!-- Floating Cart (Absolute Positioned) -->
        <div class="bn-item floating" onclick="openCart()">
            <i class="bi bi-cart2"></i>
        </div>
    </div>
</div>