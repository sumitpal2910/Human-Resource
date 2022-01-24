<?php

class AdminController
{

    /*========================================
        CREATE ADMIN
    ========================================== */
    static public function ctlrLoginAdmin()
    {
        if (isset($_POST['adminLoginBtn'])) {
            $email = $_POST['adminLoginEmail'];
            $password = $_POST['adminLoginPassword'];

            $item = "email";
            $value = $email;
            $result = AdminController::ctlrShowAdmin($item, $value);

            if ($result['email'] === $email && password_verify($password, $result['password'])) {
                $_SESSION['adminId'] = $result['id'];
                $_SESSION['role'] = "admin";
            } else {
                echo "<br><div class='alert alert-danger'>Email Password not match</div>";
            }
        }
    }

    /*========================================
        CREATE ADMIN
    ========================================== */
    static public function ctlrCreateAdmin()
    {
        if (isset($_POST['createAdmin'])) {
            $name = $_POST['newAdminName'];
            $email = $_POST['newAdminEmail'];
            $password  = $_POST['newAdminPassword'];

            $hash = password_hash($password, PASSWORD_BCRYPT);

            $table = "admin";
            $data = [":name" => $name, ":email" => $email, ":password" => $hash];

            $result = ModelAdmin::mdlCreateAdmin($table, $data);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Admin $name has been Created',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'admin';
                            }
                        })
                </script>";
            }
        }
    }


    /*============================================
        SHOW ADMIN
    ============================================== */
    static public function ctlrShowAdmin($item, $value)
    {
        $table = "admin";
        return  ModelAdmin::mdlShowAdmin($table, $item, $value);
    }


    /*================================================ 
        EDIT ADMIN
    ================================================== */
    static public function ctlrEditAdmin()
    {
        if (isset($_POST['editAdmin'])) {
            $id = $_POST['editAdminId'];
            $name = $_POST['editAdminName'];
            $email = $_POST['editAdminEmail'];
            $password = $_POST['editAdminPassword'];

            if (empty($password)) {
                $hash = $_POST['editAdminPasswordActual'];
            } else {
                $hash = password_hash($password, PASSWORD_BCRYPT);
            }

            $table = "admin";
            $data = [":name" => $name, ":email" => $email, ":password" => $hash, ":id" => $id];
            $result = ModelAdmin::mdlEditAdmin($table, $data);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Admin $name has been Updated',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'admin';
                            }
                        })
                </script>";
            }
        }
    }
}
