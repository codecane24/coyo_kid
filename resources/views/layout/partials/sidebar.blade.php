<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li>
                    <a href="javascript:void(0);" class="d-flex align-items-center border bg-white rounded p-2 mb-4">
                        <img src="build/img/icons/global-img.svg" class="avatar avatar-md img-fluid rounded"
                            alt="Profile">

                        @if (Session::get('branch_id') != null)
                            <span class="text-dark ms-2 fw-normal"> {{ Session::get('branch_name') }} </span>
                        @else
                            <span class="text-dark ms-2 fw-normal"> Superadmin Login </span>
                        @endif
                    </a>
                </li>
            </ul>
            <ul>
                <li>
                    <h6 class="submenu-hdr"><span>Main</span></h6>
                    <ul>
                        <li class="submenu">

                            <a href="javascript:void(0);"
                                class="{{ Request::is('/', 'index', 'teacher-dashboard', 'student-dashboard', 'parent-dashboard', 'activities') ? 'subdrop active' : '' }}"><i
                                    class="ti ti-layout-dashboard"></i><span>Dashboard</span><span
                                    class="menu-arrow"></span></a>
                        </li>
                        <li class="submenu">

                            <a href="javascript:void(0);"
                                class="{{ Request::is('chat', 'call', 'calendar', 'email', 'todo', 'notes', 'file-manager', 'video-call') ? 'subdrop active' : '' }}"><i
                                    class="ti ti-layout-list"></i><span>User Management</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a class="{{ Request::is('user') ? 'active' : '' }}"
                                        href="{{ route('superadmin.users.index') }}">User List</a></li>
                                <li><a class="{{ Request::is('permission') ? 'active' : '' }}"
                                        href="{{ route('superadmin.permissions.index') }}">Permission List</a></li>
                                <li><a class="{{ Request::is('role') ? 'active' : '' }}"
                                        href="{{ route('superadmin.roles.index') }}">Role List</a></li>
                                <li><a class="{{ Request::is('branch') ? 'active' : '' }}"
                                        href="{{ route('superadmin.branches.index') }}">Branch List</a></li>
                            </ul>
                        </li>

                        <li class="submenu">

                            <a href="javascript:void(0);"
                                class="{{ Request::is('inquiry') ? 'subdrop active' : '' }}"><i
                                    class="ti ti-layout-list"></i><span>Inquiry Management</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a class="{{ Request::is('inquiry') ? 'active' : '' }}"
                                        href="{{ route('admin.inquiries.index') }}">Inquiry List</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
