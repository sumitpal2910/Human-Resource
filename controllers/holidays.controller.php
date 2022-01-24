<?php

class HolidayController
{
    /**=============================================
     *      CREATE HOLIDAY
     * =============================================*/
    static public function ctlrCreateHoliday()
    {
        if (isset($_POST['createHoliday'])) {
            $allDates = $_POST['newHolidayDate'];
            $allOccasion = $_POST['newHolidayOccasion'];
            $res = [];

            for ($i = 0; $i < count($allDates); $i++) {
                $date = $allDates[$i];
                $occasion = $allOccasion[$i];
                $day = date("l", strtotime($date));
                $monthNo = substr($date, 5, 2);
                $year = substr($date, 0, 4);
                $month = date("F", mktime(0, 0, 0, $monthNo));

                // SEND DATA TO MODEL PAGE
                $table = "holidays";
                $data = [":holiday_date" => $date, ":month_no" => $monthNo, ":occasion" => $occasion, ":day" => $day, ":month" => $month, ":year" => $year];
                $result = ModelHoliday::mdlCreateHoliday($table, $data);
                array_push($res, $result);
            }

            if (!in_array("error", $res)) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Holiday has been Added',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'holidays';
                            }
                        })
                </script>";
            }
        }
    }


    /**=============================================
     *      MARK ALL SUNDAY AS HOLIDAY
     * =============================================*/
    // GET ALL SUNDAY
    static private function getSunday($y, $m)
    {
        $date = "$y-$m-01";
        $first_day = date('N', strtotime($date));
        $first_day = 7 - $first_day + 1;
        $last_day =  date('t', strtotime($date));
        $days = array();
        for ($i = $first_day; $i <= $last_day; $i = $i + 7) {
            $days[] = $i;
        }
        return  $days;
    }
    static public function ctlrMarkSundayHoliday()
    {
        if (isset($_POST['sundayHoliday'])) {
            $occasion = "Sunday";
            $dayName = "Sunday";
            $year = date("Y");
            $res = [];

            for ($i = 0; $i < 12; $i++) {
                $monthNo = $i + 1;
                $days = HolidayController::getSunday($year, $monthNo);

                foreach ($days as $key => $day) {

                    if (strlen($day) == 1) {
                        $day = "0" . $day;
                    }
                    if (strlen($monthNo) == 1) {
                        $monthNo = "0" . $monthNo;
                    }

                    $holidayDate = "$year-$monthNo-$day";
                    $monthName = date("F", mktime(0, 0, 0, $monthNo));

                    $table = "holidays";
                    $data = [":holiday_date" => $holidayDate, ":month_no" => $monthNo, ":occasion" => $occasion, ":day" => $dayName, ":month" => $monthName, ":year" => $year];
                    $result = ModelHoliday::mdlCreateHoliday($table, $data);
                    array_push($res, $result);
                }
            }

            // SHOW ALERT ON SUCCESS
            if (!in_array("error", $res)) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'All Sunday Mark as Holiday',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'holidays';
                            }
                        })
                </script>";
            }
        }
    }

    
    /**=============================================
     *      SHOW HOLIDAY
     * =============================================*/
    static public function ctlrShowHoliday($item, $value)
    {
        $table = "holidays";
        return ModelHoliday::mdlShowHoliday($table, $item, $value);
    }


    /**=============================================
     *      DELETE HOLIDAY
     * =============================================*/
    static public function ctlrDeleteHoliday()
    {
        if (isset($_GET['deleteHoliday'])) {
            $table = "holidays";
            $item = "id";
            $value = $_GET['deleteHoliday'];
            $result = ModelHoliday::mdlDeleteHoliday($table, $item, $value);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Holiday has been Deleted',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            if(res.value){
                                window.location = 'holidays';
                            }
                        })
                </script>";
            }
        }
    }
}
