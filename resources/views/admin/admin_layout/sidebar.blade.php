<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('admin_webu/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Journal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin_webu/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Journal</a>
            </div>
        </div>

        <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ sHelper::activeSideBar(Request::path() , ['admin']) }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @role('Author')
                <li class="nav-item has-treeview">
                    <a href="{{ url('/') }}" class="nav-link {{ sHelper::activeSideBar(Request::path() , ['admin/role-list']) }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Manage Roles
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/role-list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ url('admin/admin/role-list') }}" class="nav-link {{ (request()->is('admin/reviewers*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Manage Reviewers
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/reviewers') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reviewers List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/reviewers/create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Reviewers </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole




                <li class="nav-item has-treeview">
                    <a href="{{ url('admin/article') }}" class="nav-link {{ (request()->is('admin/article*')) ? 'active' : '' }}">
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
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->


    </div>
    <!-- /.sidebar -->
</aside>