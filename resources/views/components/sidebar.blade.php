<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="home"><img src="{{ asset('img/adina150.svg') }}" alt="Logo"></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="home"><img src="{{ asset('img/iconsidebar.svg') }}" alt="Logo"></a>
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
                <a href="{{route('companies.show', 1) }}"class="nav-link"><i class="fas fa-thumb-tack"></i>
                    <span>Kantor</span></a>

            </li>
            <li class="nav-item ">
                <a href="{{route('attendances.index') }}"class="nav-link"><i class="fas fa-archive"></i>
                    <span>Kehadiran</span></a>

            </li>
            <li class="nav-item ">
                <a href="{{route('permissions.index') }}"class="nav-link"><i class="fas fa-file-lines"></i>
                    <span>Perizinan</span></a>
                    <li class="nav-item ">
                         <!--  <a href="3   " class="nav-link"><i class="fas fa-calendar-alt"></i><span>Cuti</span></a>
                    </li>
          sidebar.blade.php -->
           <li class="nav-item ">
                <a href="{{route('reports.index')}}" class="nav-link"><i class="fas fa-print"></i><span>Laporan</span></a>
            </li>



    </aside>
</div>
