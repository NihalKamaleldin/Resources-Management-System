
<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Main)-->
            <div class="sidenav-menu-heading">Main</div>
            <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>
           
            <!-- Sidenav Accordion (Pages)-->
            {{-- 
            <div class="collapse" id="collapsePages" data-bs-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesCustomers">
                    <!-- Nested Sidenav Accordion (Pages -> People)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#pagesCollapseCustomers" aria-expanded="false" aria-controls="pagesCollapseCustomers">
                        Customers
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseCustomers" data-bs-parent="#accordionSidenavPagesCustomers">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="#">Show All</a>
                        </nav>
                    </div>
                    <a class="nav-link" href="#">Customers</a>
                </nav>
            </div> --}}

            <!-- Sidenav Heading (Pages)-->
            <div class="sidenav-menu-heading">Resources</div>
            <a class="nav-link {{ Request::is('customers*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Customers
            </a>
            <a class="nav-link {{ Request::is('suppliers*') ? 'active' : '' }}" href="{{ route('suppliers.index') }}">
                <div class="nav-link-icon"><i class="fa-solid fa-users"></i></div>
                Suppliers
            </a>

            
</nav>
