<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Journal system</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" 
                    data-toggle="collapse" 
                    data-target="#collapseUtilities"
                    aria-expanded="false" 
                    aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Manage Roles</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar" style="">
                    <div class="bg-white py-2 collapse-inner rounded">
                        {{-- <h6 class="collapse-header">Custom Utilities:</h6> --}}
                        {{-- <a class="collapse-item" href="{{ url('admin/permission') }}">Add Permission</a> --}}
                        {{-- <a class="collapse-item" href="{{ url('admin/permission-list') }}">Permission List</a> --}}
                        {{-- <a class="collapse-item" href="{{ url('admin/role') }}">Add Role</a> --}}
                        <a class="collapse-item" href="{{ url('admin/role-list') }}">Role List</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Reviewers</span>
                </a>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2/ collapse-inner rounded">
                        {{-- <h6 class="collapse-header">Custom Components:</h6> --}}

                        <a class="collapse-item" href="{{ url('admin/reviewers') }}">Reviewers List</a>
                        <a class="collapse-item" href="{{ url('admin/reviewers/create') }}">Add Reviewers</a>

                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->

            <!-- Divider -->


            <!-- Heading -->


            <!-- Nav Item - Pages Collapse Menu -->


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>






        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
