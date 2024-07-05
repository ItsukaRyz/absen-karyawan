<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">ADINA</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">ad</a>
        </div>
        <ul class="sidebar-menu">

            <li class="nav-item ">
                <a href="{{route('home')}}"class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>

            </li>

            <li class="nav-item ">
                <a href="{{route('users.index') }}"class="nav-link"><i class="fas fa-user "></i>
                    <span>User</span></a>

            </li>
            <li class="nav-item ">
                <a href="{{route('companies.show', 1) }}"class="nav-link"><i class="fas fa-archive"></i>
                    <span>Kantor</span></a>

            </li>
            <li class="nav-item ">
                <a href="{{route('attendances.index') }}"class="nav-link"><i class="fas fa-folder-open"></i>
                    <span>Kehadiran</span></a>

            </li>
            <li class="nav-item ">
                <a href="{{route('permissions.index') }}"class="nav-link"><i class="fas fa-file-lines"></i>
                    <span>Perizinan</span></a>

            </li>

    </aside>
</div>
