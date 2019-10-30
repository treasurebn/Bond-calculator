
<?php
  session_start();
   if (isset($_POST['submit']))
    {
        $loan =  $_POST['loan'];
        $interest = $_POST['interest'];
        $term = $_POST['term'];
        $down = $_POST['down'];

        $loan = $loan - $down;
        $pay = (($interest / 100 / 12) * $loan) / (1 - pow((1 + $interest /100 / 12), -$term * 12));

        $_SESSION['pay'] = round($pay, 2);
        $_SESSION['years'] = $term;

        $month = $term * 12;
        $cur = 1;
        $this_year_interest_paid = 0;
        $this_year_principal_paid  = 0;
        $total = 0;
        $cur_year = 1;
        
        echo'
        <div class="container">
        <hr>
        <div id="section" class="container-fluid bg-success" style="padding-top:70px;padding-bottom:70px">
            <h1>Results</h1>
            <p> Your house price: R'.round( $_POST['loan'], 2).'</p>
            <p> interest rate: '.$_POST['interest'].'%</p>
            <p> Period of: '.$_POST['term'].' years</p>
            <p> Down Payment: R'.$_POST['down'].'</p>
            <p> Your Monthly payment is: R'.round($pay, 2).'</p>
            <p> </p>
        </div>
        <hr>
        </div>
        
        ';
        ?>
        <div class="container">
        
        <table class = "table table-bordered table-striped">
        <?php
        $int = $loan;
        $arr1 = array();
        $arr2 = array();
        $arr3 = array();
        $totala = array();

       ?>
       <tr>
        <th>Number Of Years</th>
        <th>Interest in %</th>
        <th>Capital in %</th>
       </tr>
       <?php
        while ($cur <= $month)
        {

            $interest_paid     = $loan * $interest / 100 / 12;
            $interest_sam     = $int * $interest / 100 / 12;
            $loan_paid    = $pay - $interest_paid;
            $remaining_balance = $loan - $loan_paid;

            $this_year_interest_paid  = $this_year_interest_paid + $interest_paid;
            $this_year_principal_paid = $this_year_principal_paid + $loan_paid;

            if (!($cur % 12))
            {
                $total_spent_this_year = $this_year_interest_paid + $this_year_principal_paid;
                $total = $total + $total_spent_this_year;
                $perc = ($interest_paid / $interest_sam) * 100;
                $perc1 = 100 - $perc;

                
                array_push($arr1, round($perc, 2));
                array_push($arr2, round($perc1, 2));
                array_push($arr3, round($total, 2));
                ?>
                <tr>
                  
                    <td> <?php echo round($cur_year, 2) ?></td>
                    <td> <?php echo round($perc, 2)."%" ?></td>
                    <td> <?php echo round($perc1, 2)."%" ?></td>
                </tr>
                <?php
                $cur_year++;
                $this_year_interest_paid = 0;
                $this_year_principal_paid  = 0;
            }
            $loan = $remaining_balance;
            $cur++;
    }
    $_SESSION['arr'] = implode(",",$arr1);
    $_SESSION['arr1']= implode(",",$arr2);
    $_SESSION['arr2']= implode(",",$arr3);
    ?>
    </table>
    </div>
    <?php
    }
    if (isset($_POST['save']))
    {
        $name = $_POST['name'];
        if (empty($name))
        {
            echo '<script>alert("No name entered")</script>';
            '<script>window.location = "index.php"</script>';
            exit();
        }
        elseif(empty($_SESSION['pay'] || empty($_SESSION['arr'])) || empty($_SESSION['arr1']) || empty($_SESSION['years']))
        {
            echo '<script>alert("No Calculations to be saved")</script>';
            echo '<script>window.location = "index.php"</script>';
            exit();
        }
        else{
            try{
                include_once('connection.php');
                $sql  = $con->prepare("INSERT INTO saved_data (username, payment, interest_b, interest_p, years, year_spent) VALUES (?,?,?,?,?,?)");
                $arr = array($name, $_SESSION['pay'], $_SESSION['arr'], $_SESSION['arr1'], $_SESSION['years'], $_SESSION['arr2']);

                if ($sql->execute($arr))
                {
                    echo '<div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong> Successful.
                  </div>';
                    
                    session_unset();
                    session_destroy();
                }
                else
                {
                    echo '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong> Could not add information.
                  </div>';
                    
                    session_unset();
                    session_destroy();

                }
                $con = null;
            }
            catch(PDOException $e)
            {
                echo $e;
            }
        }
    }
    if (isset($_POST['display']))
    {
        include_once('connection.php');
        $name = $_POST['name_d'];
        
        $sql = $con->prepare("SELECT * FROM saved_data WHERE username = ?");
        if ($sql->execute([$name]))
        {
            $res = $sql->fetchAll(PDO::FETCH_ASSOC);

            $x = 0;
            foreach ($res as $x =>$value)
            {
            $username = $res[$x]['username'];
            $amount = $res[$x]['payment'];
            $interest_b = array(explode(",", $res[$x]['interest_b']));
            $interest_p = array(explode(",", $res[$x]['interest_p']));
            $years = $res[$x]['years'];
            
            ?>
            <div class = "container">
        </div>
        <hr>
            <table class = "table table-bordered table-striped">
        <?php
                $i = 0;
                ?>
                <tr><th> Monthly Payment: R<?php echo $amount?></tr>
               <tr><th>Number Of Years</th><th>Interest in %</th><th>Capital in %</th></tr>
                  <?php
                    foreach ($interest_b[0] as $i =>$v)
                    {
                        $va = 100 - $v;
                        $ii = $i + 1;
                        ?>
                     <tr><td><?php echo $ii ?></td><td><?php echo $v ?></td><td><?php echo $va ?></td></tr>
                     <?php
                    }
                }
        ?>
            </table>
            }
            </div>
        <?php
        }
        ?>
        <div class = "container">
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <?php
    }

    $dataPoints = array(
        array("x"=> 10, "y"=> 41),
        array("x"=> 20, "y"=> 35, "indexLabel"=> "Lowest"),
        array("x"=> 30, "y"=> 50),
        array("x"=> 40, "y"=> 45),
        array("x"=> 50, "y"=> 52),
        array("x"=> 60, "y"=> 68),
        array("x"=> 70, "y"=> 38),
        array("x"=> 80, "y"=> 71, "indexLabel"=> "Highest"),
        array("x"=> 90, "y"=> 52),
        array("x"=> 100, "y"=> 60),
        array("x"=> 110, "y"=> 36),
        array("x"=> 120, "y"=> 49),
        array("x"=> 130, "y"=> 41)
    );  
?>
</body>
<head>

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
   animationEnabled: true,
   exportEnabled: true,
   theme: "light1", // "light1", "light2", "dark1", "dark2"
   title:{
       text: "Simple Column Chart with Index Labels"
   },
   data: [{
       type: "column", //change type to bar, line, area, pie, etc
       //indexLabel: "{y}", //Shows y value on all Data Points
       indexLabelFontColor: "#5A5757",
       indexLabelPlacement: "outside",   
       dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
   }]
});
chart.render();
}
</script>
</html>