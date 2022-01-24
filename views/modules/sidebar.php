<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home" class="brand-link">
        <img src="views\img\template\icon-white.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Human Resource</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php
                if ($_SESSION['image']) {
                    echo "<img src='" . $_SESSION['image'] . "' class='img-circle elevation-2'>";
                } else {
                    echo "<img src='views/img/employees/default/default.jpg' class='img-circle elevation-2'>";
                }
                ?>
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['name'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="home" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="awards" class="nav-link">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>Award</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="holidays" class="nav-link">
                        <i class="nav-icon fas fa-paper-plane"></i>
                        <p>Holidays</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Attendance <i class="right fas fa-angle-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="attendance-calender" class="nav-link">
                                <i class="nav-icon fas fa-calendar"></i>
                                <p>Calender Overview</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="view-attendance" class="nav-link">
                                <i class="nav-icon fas fa-eye"></i>
                                <p>View Attendance</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="attendance-list" class="nav-link">
                                <i class="nav-icon fas fa-check"></i>
                                <p> Attendance List</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="leave-types" class="nav-link">
                                <i class="nav-icon fas fa-sitemap"></i>
                                <p> Leave Type</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="view-leave" class="nav-link">
                        <i class="nav-icon fas fa-paper-plane"></i>
                        <p>Leave Application</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>