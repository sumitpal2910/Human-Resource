<?php
require_once "../controllers/employees.controller.php";
require_once "../models/employees.model.php";

require_once "../controllers/department.controller.php";
require_once "../models/department.model.php";

class EmployeeDataTable
{
    public function allEmployeeDataTable()
    {
        $item = NULL;
        $value = NULL;
        $result = EmployeesController::ctlrShowEmployees($item, $value);

        $jsonData = '{
           "data":[';

        foreach ($result as $no => $data) {
            $id = $data['id'];

            // SHOW DEPARTMENT AND DESIGNATION 
            $designation_id = $data['designation_id'];
            $item = "id";
            $value = $data['department_id'];
            $department = DepartmentController::ctlrShowDepartment($item, $value);
            $allDesignations = json_decode($department['designation'], true);
            $role = "<ul><li>Department: " . $department['name'] . "</li>";
            foreach ($allDesignations as $key => $design) {
                // print_r($design);
                if ($designation_id == $design['id']) {
                    $role .= "<li>Designation: <b>" . $design['name'] . "</b></li>";
                    break;
                }
            }
            $role .= "</ul>";

            // SHOW IMAGE
            if ($data['image']) {
                $image = "<img src='" . $data['image'] . "' class='img-thumbnail' width='60px'>";
            } else {
                $image = "<img src='views/img/employees/default/default.jpg'  width='60px'>";
            }

            // STATUS
            if ($data['status'] == 1) {
                $status = "<h5><p class='badge badge-success btn-xs'>Active</p></h5>";
            } else {
                $status = "<h5><p class='badge badge-danger btn-xs'>Inactive</p></h5>";
            }

            // BUTTONS
            $button = "<div class='row'><button class='btn btn-info btn-sm btnEditEmployee' employeeId='$id'><i class='fas fa-edit'></i> View/Edit</button>";
            $button .= "<button class='btn btn-danger btn-sm ml-3 btnDeleteEmployee' employeeId='$id'><i class='fas fa-trash'></i> Delete</button></div>";


            // WORKING DAYS
            $today = date("Y-m-d");
            $date1 = new DateTime($data['join_date']);
            $date2 =  $data['exit_date'] == 0 ? new DateTime($data['exit_date']) : new DateTime(date("Y-m-d"));

            $diff = $date1->diff($date2);
            $day = $diff->d + 1;
            $month = $diff->m;
            $year = $diff->y;
            if ($year == 0 && $month == 0) {
                $workDays = "$day  Day";
            } elseif ($year != 0 && $month == 0) {
                $workDays = "$year Year $day  Day";
            } elseif ($year == 0 && $month != 0) {
                $workDays = "$month Month $day  Day";
            } else {
                $workDays = "$year Year $month Month $day  Day";
            }

            $jsonData .= '[
            "' . ($no + 1) . '",
            "' . $data['code'] . '",
            "' . $image . '",
            "' . $data['name'] . '",
            "' . $data['phone'] . '",
            "' . $role . '",
            "' . $workDays . '",
            "' . $status . '",
            "' . $button . '"
        ],';
        }
        $jsonData = substr($jsonData, 0, -1);

        $jsonData .= ']}';

        echo $jsonData;
    }
}

$employee = new EmployeeDataTable();
$employee->allEmployeeDataTable();
