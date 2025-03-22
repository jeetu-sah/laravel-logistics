<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/dashboard') }}" class="brand-link">
        <img src="{{ asset('admin_webu/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Logistics</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin_webu/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ url('/dashboard') }}" class="d-block">Logistics</a>
            </div>
        </div>

        <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}"
                        class="nav-link {{ sHelper::activeSideBar(Request::path(), ['branch-user/dashboard', 'admin/dashboard']) }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @role('Admin')
                    <li class="nav-item has-treeview {{ request()->is('admin/role-list*') ? 'menu-open' : '' }} ">
                        <a href="{{ url('/') }}"
                            class="nav-link {{ sHelper::activeSideBar(Request::path(), ['admin/role-list']) }}">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Manage Roles
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('admin/role-list') }}"
                                    class="nav-link {{ request()->is('admin/role-list') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endrole

                @role('Branchuser')
                    <li class="nav-item has-treeview {{ request()->is('branch-user/employees*') ? 'menu-open' : '' }} ">
                        <a href="{{ url('branch-user/employees') }}"
                            class="nav-link {{ request()->is('branch-user/employees*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Manage Employees
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('branch-user/employees') }}"
                                    class="nav-link {{ request()->is('branch-user/employees') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Employees List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('branch-user/employees/create') }}"
                                    class="nav-link {{ request()->is('branch-user/employees/create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Employees </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole




                <!-- <li class="nav-item has-treeview">
                    <a href="{{ url('admin/article') }}"
                        class="nav-link {{ request()->is('admin/article*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Manage Manuscript
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/article/create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Article</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/reviewers/create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Article List </p>
                            </a>
                        </li>
                    </ul>
                </li> -->
                @role('Admin')
                    <li class="nav-item has-treeview {{ request()->is('admin/distances*') ? 'menu-open' : '' }}">
                        <a href="{{ url('admin/distances') }}"
                            class="nav-link {{ request()->is('admin/distances*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Branch Distances
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('admin/distances') }}"
                                    class="nav-link {{ request()->is('admin/distances') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Branch Distances List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/distances/create') }}"
                                    class="nav-link {{ request()->is('admin/distances/create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Branch Distances</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ request()->is('admin/branches*') ? 'menu-open' : '' }}">
                        <a href="{{ url('admin/branches') }}"
                            class="nav-link {{ request()->is('admin/branches*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Branch
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('admin/branches') }}"
                                    class="nav-link {{ request()->is('admin/branches') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Branch List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/branches/create') }}"
                                    class="nav-link {{ request()->is('admin/branches/create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Branch</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ request()->is('admin/clients*') ? 'menu-open' : '' }} ">
                        <a href="{{ url('admin/admin/role-list') }}"
                            class="nav-link {{ request()->is('admin/clients*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Client
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('admin/clients') }}"
                                    class="nav-link {{ request()->is('admin/clients') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Client List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/clients/create') }}"
                                    class="nav-link {{ request()->is('admin/clients/create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Client </p>
                                </a>
                            </li>


                        </ul>
                    </li>
                @endrole
                @role('Branchuser')
                    <li class="nav-item has-treeview">
                        <a href="{{ url('admin/bookings/create?no-bill-bookings=true') }}"
                            class="nav-link {{ request()->is('admin/bookings/create?no-bill-bookings=true') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                NB Booking
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview {{ request()->is('admin/bookings*') ? 'menu-open' : '' }} ">
                        <a href="{{ url('admin/admin/role-list') }}"
                            class="nav-link {{ request()->is('admin/bookings*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Booking
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('admin/bookings/incoming-load') }}"
                                    class="nav-link {{ request()->is('admin/bookings/incoming-load') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Incoming Load</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/bookings') }}"
                                    class="nav-link {{ request()->is('admin/bookings') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Booking List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/bookings/create ') }}"
                                    class="nav-link {{ request()->is('admin/bookings/create ') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Booking </p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ url('admin/bookings/to-pay-booking') }}"
                                    class="nav-link {{ request()->is('admin/bookings/to-pay-booking') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>To Pay Booking </p>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ url('admin/bookings/clients') }}"
                                    class="nav-link {{ request()->is('admin/bookings/clients') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Client Booking </p>
                                </a>
                            </li>


                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ request()->is('admin/challans*') ? 'menu-open' : '' }} ">
                        <a href="{{ url('admin/challans') }}"
                            class="nav-link {{ request()->is('admin/challans*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Manifest
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('admin/challans/create') }}"
                                    class="nav-link {{ request()->is('admin/challans/create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Manifest</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/challans') }}"
                                    class="nav-link {{ request()->is('admin/challans') || request()->is('admin/challans') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manifest List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ url('admin/delivery') }}"
                            class="nav-link {{ request()->is('admin/delivery') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Delivery
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{ request()->is('admin/report*') ? 'menu-open' : '' }} ">
                        <a href="{{ url('admin/report') }}"
                            class="nav-link {{ request()->is('admin/report*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Reports
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('admin/reports/bookings-report') }}"
                                    class="nav-link {{ request()->is('admin/reports/bookings-report') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Bookings Reports</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/reports/clients') }}"
                                    class="nav-link {{ request()->is('admin/reports/clients') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Clients Bookings Reports</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/report/chalan-reports') }}"
                                    class="nav-link {{ request()->is('admin/report/chalan-reports') || request()->is('admin/report') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Challan Reports</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/report/delevery-reports') }}"
                                    class="nav-link {{ request()->is('admin/report/delevery-reports') || request()->is('admin/challans') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Delevery Reports</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ url('branch-user/settings') }}"
                            class="nav-link {{ request()->is('branch-user/settings') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Settings
                            </p>
                        </a>
                    </li>
                @endrole
            </ul>
        </nav>
        <!-- /.sidebar-menu -->


    </div>
    <!-- /.sidebar -->
</aside>
