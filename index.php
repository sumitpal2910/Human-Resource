<?php

require_once "controllers/templete.controller.php";
require_once "controllers/employees.controller.php";
require_once "controllers/department.controller.php";
require_once "controllers/admin.controller.php";
require_once "controllers/awards.controller.php";
require_once "controllers/expense.controller.php";
require_once "controllers/holidays.controller.php";
require_once "controllers/leave-types.controller.php";
require_once "controllers/attendance.controller.php";
require_once "controllers/leave.controller.php";

require_once "models/employees.model.php";
require_once "models/department.model.php";
require_once "models/admin.model.php";
require_once "models/awards.model.php";
require_once "models/expense.model.php";
require_once "models/holidays.model.php";
require_once "models/leave-types.model.php";
require_once "models/attendance.model.php";
require_once "models/leave.model.php";


$templete = new Templete();
$templete->ctlrTemplete();
