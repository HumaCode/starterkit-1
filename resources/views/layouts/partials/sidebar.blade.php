<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-logo"><i class="bi bi-box-seam"></i></div>
        <span>AdminPanel</span>
    </div>


    <nav class="sidebar-menu">
        @php
            $menusByCategory = menus();
        @endphp

        @forelse($menusByCategory as $category => $menus)
            <div class="menu-label">{{ $category }}</div>

            @foreach($menus as $menu)
                <a href="{{ getMenuUrl($menu->url) }}"
                   class="menu-item {{ isMenuActive($menu->url) ? 'active' : '' }}">
                    <i class="bi {{ $menu->icon ?? 'bi bi-circle' }} menu-icon"></i>
                    <span class="menu-text">{{ $menu->name }}</span>
                </a>
            @endforeach

        @empty
            <div class="menu-label">Menu</div>
            <a href="{{ route('dashboard') }}" class="menu-item active">
                <i class="bi bi-grid-1x2 menu-icon"></i>
                <span class="menu-text">Dashboard</span>
            </a>
        @endforelse
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-footer-content">
            <div class="footer-icon"><i class="bi bi-headset"></i></div>
            <div class="sidebar-footer-text">
                <p>Butuh bantuan?</p><span>support@admin.com</span>
            </div>
        </div>
    </div>
</aside>
