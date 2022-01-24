   <div class="col-12">
       <div class="card">
           <div class="card-header">
               <h5 class="card-title">Expenses</h5>
           </div>
           <div class="card-body">
               <div class="chart">
                   <canvas id="expenseChart" style="min-height: 250px; height: 400px; max-height: 500px; max-width: 100%;"></canvas>
               </div>
           </div>
       </div>
   </div>

   <?php
    error_reporting(0);

    $view = "month";
    $item = "purchase_date";

    if (isset($_POST['expenseChartSearch'])) {
        $view = $_POST['expenseChartView'];

        $start = substr($_POST['expenseChartStartDate'], 0, 7);
        $end = substr($_POST['expenseChartEndDate'], 0, 7);
        $ed = date("t", strtotime($_POST['expenseChartEndDate']));

        $value1 = $start . "-01";
        $value2 = $end . "-" . $ed;
    } else {
        $value1 = "2021-01-01";
        $value2 = "2021-12-31";
    }
    $expenses = ExpenseController::ctlrExpenseDateRange($item, $value1, $value2);

    $arrayDates = [];
    $arraySales = [];
    $totalExpenses = [];

    // MONTH WISE VIEW
    foreach ($expenses as $key => $data) {
        $singleDate =  $view === "month" ? substr($data['purchase_date'], 0, 7) : substr($data['purchase_date'], 0, 4);

        #single date push in arrayDate
        array_push($arrayDates, $singleDate);

        # capture the sales
        $arraySales = [$singleDate => $data['price']];

        # add payment in month payment
        foreach ($arraySales as $key => $value) {
            $totalExpenses[$key] += $value;
        }
    }
    ksort($totalExpenses);


    $labels = [];
    foreach ($totalExpenses as $key => $value) {
        if ($view === "month") {
            $m = $key . "-01";
            $label = date("F", strtotime($m)) . " " . substr($key, 0, 4);
        } else {
            $label = $key;
        }
        array_push($labels, $label);
        if (count($totalExpenses) === 1) {
            array_push($labels, $label);
        }
    }
    ?>
   <script>
       //-------------
       //- LINE CHART -
       //--------------
       let expenseChartCanvas = $('#expenseChart');


       let expenseChart = new Chart(expenseChartCanvas, {
           type: 'line',
           data: {
               labels: <?php echo json_encode($labels); ?>,
               datasets: [{
                   label: 'Expense ₹',
                   backgroundColor: 'rgba(255, 99, 132, 0.1)',
                   borderColor: 'rgb(255, 99, 132)',
                   data: [<?php
                            foreach ($totalExpenses as $key => $ex) {
                                echo $ex . ",";
                            }
                            echo $ex;

                            ?>]
               }]
           }
       })
   </script>