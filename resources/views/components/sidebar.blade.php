<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">TOKO SMOGA JAYA</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            {{-- <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}"> --}}
            <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('home') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('home') }}">Dashboard Umum</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ $type_menu === 'layoutmasteronline' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Master Toko</span></a>
                <ul class="dropdown-menu">
                    @if (Auth::user()->roles == 'ADMIN')
                        <li class='{{ Request::is(['user','user/*']) ? 'active' : '' }}'>
                            <a class="nav-link"
                                href="{{ route('user.index') }}">User</a>
                        </li>
                    @endif
                    <li class='{{ Request::is(['category','category/*']) ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('category.index') }}">Kategori Produk</a>
                    </li>
                    <li class='{{ Request::is(['product','product/']) ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('product.index') }}">Produk</a>
                    </li>
                </ul>
            </li>
    </aside>
</div>
