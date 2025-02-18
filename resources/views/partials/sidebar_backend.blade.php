<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <h1 class="text-info">E-Library</h1>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item  ">
                    <a href="{{route('dashboard')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Books</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="{{route('categories.index')}}" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Category</span>
                    </a>
                </li>
                <li class="sidebar-item ">
                    <a href="{{route('user.index')}}" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Users</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="table.html" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Permission</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>