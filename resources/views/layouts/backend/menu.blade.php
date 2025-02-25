<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <nav class="mt-2">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center">
                    <div class="sidebar-brand-icon">
                        <img src="https://upload.wikimedia.org/wikipedia/th/e/e0/RMUTI_KORAT.png" alt="Logo"
                            style="width: 50px; height: auto;">
                    </div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-3"> <!-- ปรับระยะห่างของเส้นแบ่ง -->

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin-dashboard') }}">
                        <i class="fas fa-fw fa-home"></i>
                        <span>หน้าหลัก</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-table"></i>
                        <span>ข้อมูลงาน</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('projects') }}">ข้อมูลตารางงาน</a>
                            <a class="collapse-item" href="{{ route('add-task') }}">เพิ่มข้อมูลงาน</a>
                            {{-- <a class="collapse-item" href="{{ route('summary-schedule') }}">สรุปตารางงาน</a> --}}
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Utilities Collapse Menu -->
                @can('can-view-function')
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                            aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-fw fa-user"></i>
                            <span>ข้อมูลบุคลากร</span>
                        </a>
                        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="{{ route('personal') }}">บุคลากร</a>
                                <a class="collapse-item" href="{{ route('addpersonal') }}">เพิ่มบุคลากร</a>
                            </div>
                        </div>
                    </li>
                @endcan
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account_setting') }}">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>บัญชีผู้ใช้</span></a>
                </li>

                @can('can-view-function')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('restore') }}">
                            <i class="fas fa-fw fa-trash"></i>
                            <span>กู้คืนบัญชี</span></a>
                    </li>
                @endcan
                @can('can-view-function')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('restore-task') }}">
                            <i class="fas fa-fw fa-trash"></i>
                            <span>กู้คืนข้อมูลงาน</span></a>
                    </li>
                @endcan

                <!-- Nav Item - Tables -->
                @can('can-view-function')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('send-email-tasks') }}">
                            <i class="fas fa-fw fa-envelope"></i>
                            <span>ส่งเมล (ทดสอบ)</span>
                        </a>
                    </li>
                @endcan
            </ul>
    </nav>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-logout" type="submit">ออกจากระบบ</button>
        <nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
            {{ __('Log Out') }}
        </nav-link>
    </form>

</aside>
