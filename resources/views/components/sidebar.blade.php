<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">ONLINE SHOP SMOGA JAYA</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            {{-- <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}"> --}}
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('home') }}">General Dashboard</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Master</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('user.*') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('user.index') }}">User</a>
                    </li>
                    <li class='{{ Request::is('category.*') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('category.index') }}">Category Product</a>
                    </li>
                    <li class='{{ Request::is('product.*') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('product.index') }}">Product</a>
                    </li>
                </ul>
            </li>
    </aside>
</div>
