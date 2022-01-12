<div id="sidebar" class="sidebar responsive ace-save-state">
    <ul class="nav nav-list">
        <li class="">
            <a href="{{ url('admin/dashboard') }}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Category </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="{{ url('admin/category') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Category List
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="{{ url('admin/category/create') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Add Category
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Job </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="{{ url('admin/job') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Job List
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="{{ url('admin/job/create') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Add Job
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>