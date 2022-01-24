<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
// $_SESSION['loginSession'] = "ok";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Human Resource Management System</title>

    <!-- -----------------------------------------
            CSS SECTION
    ---------------------------------------------- -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="views/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="views/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="views/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="views/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="views/plugins/fullcalendar/main.min.css">
    <link rel="stylesheet" href="views/plugins/fullcalendar-daygrid/main.min.css">
    <link rel="stylesheet" href="views/plugins/fullcalendar-timegrid/main.min.css">
    <link rel="stylesheet" href="views/plugins/fullcalendar-bootstrap/main.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- -----------------------------------------
            JAVASCIPT SECTION
    ------------------------------------------------>
    <!-- jQuery -->
    <script src="views/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Moment js -->
    <script src="views/plugins/moment/moment.min.js"></script>
    <!-- AdminLTE App -->
    <script src="views/dist/js/adminlte.min.js"></script>
    <!-- DataTables -->
    <script src="views/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="views/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- InputMask -->
    <script src="views/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="views/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Select2 -->
    <script src="views/plugins/select2/js/select2.full.min.js"></script>
    <!-- jQuery UI -->
    <script src="views/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- fullCalendar 2.2.5 -->
    <!-- <script src="views/plugins/moment/moment.min.js"></script> -->
    <script src="views/plugins/fullcalendar/main.min.js"></script>
    <script src="views/plugins/fullcalendar-daygrid/main.min.js"></script>
    <script src="views/plugins/fullcalendar-timegrid/main.min.js"></script>
    <script src="views/plugins/fullcalendar-interaction/main.min.js"></script>
    <script src="views/plugins/fullcalendar-bootstrap/main.min.js"></script>
    <!-- ChartJS -->
    <script src="views/plugins/chart.js/Chart.min.js"></script>
</head>


<?php
if (isset($_SESSION['loginSession']) && $_SESSION['loginSession'] === "ok") {

    echo "<body class='hold-transition sidebar-mini sidebar-collapse'>";

    echo '<div class="wrapper">';

    /*==================================
        HEADER
    ===================================== */
    include "views/modules/header.php";




    if (isset($_GET['root'])) {
        $root = $_GET['root'];
        if ($_SESSION['role'] === "employee") {
            /*==================================
                SIDEBAR
            ===================================== */
            include "views/modules/sidebar.php";


            if (
                $root === 'home' || $root === 'logout' || $root === 'employees' || $root === "add-employee" ||
                $root === 'edit-employee' || $root === 'departments' || $root === 'admin' || $root === 'add-admin' ||
                $root === 'edit-admin' || $root === 'awards' || $root === 'add-award' || $root === 'edit-award' ||
                $root === 'expenses' || $root === 'add-expense' || $root === 'edit-expense' || $root === 'holidays' ||
                $root === 'leave-types' || $root === 'emp-attendance' || $root === 'mark-attendance' || $root === 'view-attendance' ||
                $root === 'apply-leave' || $root === 'view-leave' || $root === 'attendance-calender' || $root === 'attendance-list'
            ) {

                include "views/modules/" . $root . ".php";
            } else {

                include "views/modules/404.php";
            }
        }
    } else {
        include "views/modules/home.php";
    }

    /*==================================
        FOOTER
    ===================================== */
    include "views/modules/footer.php";

    echo "</div>";
} else {

    echo "<body class='hold-transition login-page'>";

    if (isset($_GET['root'])) {
        $root = $_GET['root'];

        if ($root === 'login' || $root === 'admin-login') {
            include "views/modules/" . $root . ".php";
        }
    } else {
        include "views/modules/login.php";
    }
}
?>





<script src="views/js/template.js"></script>
<script src="views/js/functions.js"></script>
<script src="views/js/employees.js"></script>
<script src="views/js/department.js"></script>
<script src="views/js/admin.js"></script>
<script src="views/js/awards.js"></script>
<script src="views/js/expenses.js"></script>
<script src="views/js/holidays.js"></script>
<script src="views/js/leaveTypes.js"></script>
<script src="views/js/emp-attendance.js"></script>
<script src="views/js/view-attendance.js"></script>
<script src="views/js/attendance-list.js"></script>
<script src="views/js/attendance-calendar.js"></script>
<script src="views/js/leaves.js"></script>

</body>

</html>