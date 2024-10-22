<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <nav class="mt-2">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">WISM.TC</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('admin-dashboard')}}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>หน้าหลัก</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-table"></i>
                        <span>จัดการตารางงาน</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">จัดการตารางงาน:</h6>
                            <a class="collapse-item" href="{{route('projects')}}">ตารางาน</a>
                            <a class="collapse-item" href="{{route('add-task')}}">จัดการการเพิ่มข้อมูลงาน</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-user"></i>
                        <span>บุคลากร</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">บุคลากร:</h6>
                            <a class="collapse-item" href="{{route('personal')}}">บุคลากร</a>
                            <a class="collapse-item" href="{{route('addpersonal')}}">จัดการเพิ่มข้อมูลบุคลากร</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="tables.html">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>รายงาน</span></a>
                </li>

                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="{{route('account_setting')}}">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>จัดการบัญชีผู้ใช้</span></a>
                </li>

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="{{route('system-setting')}}">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>จัดการระบบ</span></a>
                </li>
            </ul>
            </nav>

                {{-- <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-logout" type="submit">ออกจากระบบ</button>
                </form> --}}
                <form method="POST" action="{{ route('logout') }}" >
                    @csrf
                    <button class="btn btn-logout" type="submit">ออกจากระบบ</button>
                    <nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </nav-link>
                </form>

  </aside>
