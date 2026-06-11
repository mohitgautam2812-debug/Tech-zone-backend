<style>
    .sidebar {
        width: 250px;
        height: calc(100vh - 56px);
        position: fixed;
        top: 56px;
        left: 0;
        z-index: 40;
        background: #0f172a;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .sidebar-logo {
        padding: 16px 20px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #94a3b8;
        border-bottom: 1px solid #1e293b;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .sidebar-logo::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #6d28d9;
        display: inline-block;
        flex-shrink: 0;
    }

    .sidebar-scroll {
        flex: 1;
        overflow-y: auto;
        padding: 12px 10px 24px;
        scrollbar-width: thin;
        scrollbar-color: #1e293b transparent;
    }

    .sidebar-scroll::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-scroll::-webkit-scrollbar-thumb {
        background: #1e293b;
        border-radius: 4px;
    }

    .menu-section {
        margin-bottom: 4px;
    }

    .menu-title {
        font-size: 9.5px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #475569;
        padding: 14px 12px 5px;
        margin: 0;
    }

    .menu-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 400;
        color: #94a3b8;
        text-decoration: none;
        transition: background 0.15s, color 0.15s;
        margin-bottom: 1px;
    }

    .menu-link:hover {
        background: #1e293b;
        color: #e2e8f0;
        text-decoration: none;
    }

    .menu-link i {
        font-size: 13px;
        width: 16px;
        text-align: center;
        flex-shrink: 0;
        opacity: 0.7;
    }

    .menu-link:hover i {
        opacity: 1;
    }

    .active-menu {
        background: #1e1b4b !important;
        color: #a78bfa !important;
        font-weight: 500;
    }

    .active-menu i {
        opacity: 1 !important;
        color: #a78bfa;
    }
</style>

<div class="sidebar">

    {{-- LOGO / ROLE --}}
    <div class="sidebar-logo">
        @role('admin') Admin Panel
        @endrole
        @role('agent') Agent Panel
        @endrole
        @role('user') User Panel
        @endrole
    </div>

    {{-- SCROLL AREA --}}
    <div id="sidebarScroll" class="sidebar-scroll">

        {{-- GENERAL --}}
        <div class="menu-section">
            <p class="menu-title">General</p>
            <a href="{{ route('dashboard') }}"
                class="menu-link {{ request()->routeIs('dashboard') ? 'active-menu' : '' }}">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
        </div>

        {{-- CATEGORIES --}}
        @can('add_categories')
            <div class="menu-section">
                <p class="menu-title">Categories</p>
                <a href="{{ route('categories.index') }}"
                    class="menu-link {{ request()->routeIs('categories.*') ? 'active-menu' : '' }}">
                    <i class="fa-solid fa-layer-group"></i> Categories
                </a>
            </div>
        @endcan

        {{-- PRODUCTS --}}
        @canany(['view_products', 'add_product', 'unapproved_products', 'inventory'])
            <div class="menu-section">
                <p class="menu-title">Products</p>

                @can('view_products')
                    <a href="{{ route('products.index') }}"
                        class="menu-link {{ request()->routeIs('products.index') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-gem"></i> Products
                    </a>
                @endcan

                @can('add_product')
                    <a href="{{ route('products.create') }}"
                        class="menu-link {{ request()->routeIs('products.create') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-plus"></i> Add Product
                    </a>
                @endcan

                @can('unapproved_products')
                    <a href="{{ route('products.unapproved') }}"
                        class="menu-link {{ request()->routeIs('products.unapproved') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-ban"></i> Unapproved Products
                    </a>
                @endcan

                @can('inventory')
                    <a href="{{ route('inventory') }}"
                        class="menu-link {{ request()->routeIs('inventory') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-box"></i> Inventory
                    </a>
                @endcan
            </div>
        @endcanany

        {{-- ORDERS --}}
        @canany(['view_orders', 'pending_orders', 'delivered_orders', 'cancelled_orders'])
            <div class="menu-section">
                <p class="menu-title">Orders</p>

                @can('view_orders')
                    <a href="{{ route('orders') }}" class="menu-link {{ request()->routeIs('orders') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-cart-shopping"></i> Orders
                    </a>
                @endcan

                @can('pending_orders')
                    <a href="{{ route('orders.pending') }}"
                        class="menu-link {{ request()->routeIs('orders.pending') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-clock"></i> Pending Orders
                    </a>
                @endcan

                @can('delivered_orders')
                    <a href="{{ route('orders.delivered') }}"
                        class="menu-link {{ request()->routeIs('orders.delivered') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-truck"></i> Delivered Orders
                    </a>
                @endcan

                @can('cancelled_orders')
                    <a href="{{ route('orders.cancelled') }}"
                        class="menu-link {{ request()->routeIs('orders.cancelled') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-xmark"></i> Cancelled Orders
                    </a>
                @endcan

                @can('order_return')
                    <a href="{{ route('returns.index') }}"
                        class="menu-link {{ request()->routeIs('returns.*') ? 'active-menu' : '' }}">

                        <i class="fa-solid fa-rotate-left"></i>

                        Return Requests
                    </a>

                @endcan

                @can('return_refund')
                    <a href="{{ route('refunds.index') }}"
                        class="menu-link {{ request()->routeIs('refunds.*') ? 'active-menu' : '' }}">

                        <i class="fa-solid fa-rotate-left"></i>

                        Return Refund
                    </a>

                @endcan

            </div>
        @endcanany

        {{-- USERS --}}
        @canany(['view_users', 'view_agents', 'add_users'])
            <div class="menu-section">
                <p class="menu-title">Users</p>

                @can('view_users')
                    <a href="{{ route('users') }}" class="menu-link {{ request()->routeIs('users') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-users"></i> Users
                    </a>
                @endcan

                @can('view_agents')
                    <a href="{{ route('users.agents') }}"
                        class="menu-link {{ request()->routeIs('users.agents') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-user-tie"></i> Agents
                    </a>
                @endcan

                @can('add_users')
                    <a href="{{ route('users.create') }}"
                        class="menu-link {{ request()->routeIs('users.create') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-user-plus"></i> Add Users
                    </a>
                @endcan
            </div>
        @endcanany

        {{-- ACCOUNT (User only) --}}
        @canany(['wishlist', 'track_order', 'my_orders', 'my_profile'])
            <div class="menu-section">
                <p class="menu-title">Account</p>

                @can('wishlist')
                    <a href="{{ route('wishlist') }}"
                        class="menu-link {{ request()->routeIs('wishlist') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-heart"></i> Wishlist
                    </a>
                @endcan

                @can('track_order')
                    <a href="#" class="menu-link {{ request()->routeIs('track_order') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-location-dot"></i> Track Order
                    </a>
                @endcan

                @can('my_orders')
                    <a href="{{ route('my_orders') }}"
                        class="menu-link {{ request()->routeIs('my_orders') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-bag-shopping"></i> My Orders
                    </a>
                @endcan


            </div>
        @endcanany

        {{-- CONTROL --}}
        {{-- CONTROL --}}
        @canany(['view_inquiries', 'view_contact_inquiries', 'view_reviews'])

            <div class="menu-section">

                <p class="menu-title">Control</p>

                {{-- PRODUCT INQUIRIES --}}
                @can('view_inquiries')

                    <a href="{{ route('inquiries') }}"
                        class="menu-link {{ request()->routeIs('inquiries') ? 'active-menu' : '' }}">

                        <i class="fa-solid fa-message"></i>

                        Product Inquiries

                    </a>

                @endcan

                {{-- CONTACT INQUIRIES --}}
                @can('view_contact_inquiries')

                    <a href="{{ route('contact.inquiries') }}"
                        class="menu-link {{ request()->routeIs('contact.inquiries') ? 'active-menu' : '' }}">

                        <i class="fa-solid fa-headset"></i>

                        Contact Inquiries

                    </a>

                @endcan

            </div>

        @endcanany

        {{-- SYSTEM --}}
        @canany(['settings', 'manage_roles'])
            <div class="menu-section">
                <p class="menu-title">System</p>

                @can('manage_pages')
                    <a href="{{ route('manage.pages') }}"
                        class="menu-link {{ request()->routeIs('pages.*') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-file-lines"></i> Manage Pages
                    </a>
                @endcan

                @can('manage_blog')
                    <a href="{{ route('admin.blogs') }}"
                        class="menu-link {{ request()->routeIs('admin.blogs*') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-file-lines"></i> Manage Blogs
                    </a>
                @endcan

                @can('settings')
                    <a href="{{ route('settings') }}"
                        class="menu-link {{ request()->routeIs('settings') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-gear"></i> Settings
                    </a>
                @endcan

                @can('footer')
                    <a href="{{ route('settings.index') }}"
                        class="menu-link {{ request()->routeIs('footer') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-gear"></i> Footer
                    </a>
                @endcan

                @can('manage_roles')
                    <a href="{{ route('roles.index') }}"
                        class="menu-link {{ request()->routeIs('roles.*') ? 'active-menu' : '' }}">
                        <i class="fa-solid fa-lock"></i> Roles & Permissions
                    </a>
                @endcan
            </div>
        @endcanany

    </div>
</div>