<?php

class DepartmentController
{
    /*=================================================
    CREATE NEW DEPARTMENT
=================================================== */
    static public function ctlrCreateDepartment()
    {
        if (isset($_POST['createDepartment'])) {
            $department = $_POST['newDepartmentName'];
            $designations = $_POST['newAllDesignations'];

            $table = "department";
            $data = [':name' => $department, ":designation" => $designations];

            $result = ModelDepartment::mdlCreateDepartment($table, $data);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: '$department has been Created',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            window.location = 'departments';
                        })
                </script>";
            }
        }
    }


    /*=================================================
    SHOW DEPARTMENT
=================================================== */
    static public function ctlrShowDepartment($item, $value)
    {
        $table = "department";
        return ModelDepartment::mdlShowDepartment($table, $item, $value);
    }


    /*=================================================
    EDIT DEPARTMENT
=================================================== */
    static public function ctlrEditDepartment()
    {
        if (isset($_POST['editDepartment'])) {
            $id = $_POST['editDepartmentId'];
            $department = $_POST['editDepartmentName'];
            $designations = $_POST['editAllDesignations'];

            $table = "department";
            $data = [':name' => $department, ":designation" => $designations, ":id" => $id];
            $result = ModelDepartment::mdlEditDepartment($table, $data);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: '$department has been Updated',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            window.location = 'departments';
                        })
                </script>";
            }
        }
    }


    /*===================================================
        DELETE DEPARTMENT
    ===================================================== */
    static public function ctlrDeleteDepartment()
    {
        if (isset($_GET['deleteDepartment'])) {
            $id = $_GET['deleteDepartment'];

            $table = "department";
            $item = "id";
            $value = $id;
            $result = ModelDepartment::mdlDeleteDepartment($table, $item, $value);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Department has been Deleted',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            window.location = 'departments';
                        })
                </script>";
            }
        }
    }
}
