<?php

class AwardController
{
    /**================================================
     *      CREATE AWARD
     * ================================================*/
    static public function ctlrCreateAward()
    {
        if (isset($_POST['createAward'])) {
            $name = $_POST['newAwardName'];
            $gift = $_POST['newAwardGift'];
            $cashPrice = $_POST['newAwardCashPrice'];
            $employeeId = $_POST['newAwardEmpId'];
            $month = $_POST['newAwardMonth'];
            $year = $_POST['newAwardYear'];

            $table = "awards";
            $data = [
                ":employee_id" => $employeeId, ":name" => $name, ":gift" => $gift,
                ":cash_price" => $cashPrice, ":month" => $month, ":year" => $year
            ];

            $result = ModelAward::mdlCreateAward($table, $data);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            text: 'Award has been Given',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'awards';
                            }
                        })
                </script>";
            }
        }
    }


    /*=======================================
    *   SHOW AWARD    
    =========================================*/
    static public function ctlrShowAward($item, $value)
    {
        $table = "awards";
        return ModelAward::mdlShowAward($table, $item, $value);
    }


    /*=======================================
    *   EDIT AWARD    
    =========================================*/
    static public function ctlrEditAward()
    {
        if (isset($_POST['editAward'])) {
            $id = $_POST['editAwardId'];
            $name = $_POST['editAwardName'];
            $gift = $_POST['editAwardGift'];
            $cashPrice = $_POST['editAwardCashPrice'];
            $employeeId = $_POST['editAwardEmpId'];
            $month = $_POST['editAwardMonth'];
            $year = $_POST['editAwardYear'];

            $table = "awards";
            $data = [
                ":employee_id" => $employeeId, ":name" => $name, ":gift" => $gift,
                ":cash_price" => $cashPrice, ":month" => $month, ":year" => $year, ":id" => $id
            ];

            $result = ModelAward::mdlEditAward($table, $data);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            text: 'Award has been Updated',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'awards';
                            }
                        })
                </script>";
            }
        }
    }


    /*=======================================
    *   DELETE AWARD    
    =========================================*/
    static public function ctlrDeleteAward()
    {
        if (isset($_GET['deleteAward'])) {
            $table = "awards";
            $item = "id";
            $value = $_GET['deleteAward'];

            $result = ModelAward::mdlDeleteAward($table, $item, $value);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            text: 'Award has been Deleted',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'awards';
                            }
                        })
                </script>";
            }
        }
    }
}
