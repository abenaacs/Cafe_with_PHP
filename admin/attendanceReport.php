<?php

ob_start();
session_start();

if($_SESSION['name']!='admin')
{
  header('location: login.php');
}
?>
<?php
include("../conn.php");
?>
<!DOCTYPE html>     
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="edit-menu.css">
        <link rel="stylesheet" href="workers-attendence.css">
        <link rel="stylesheet" href="../stylesheets/nav-bar.css"> 
    </head>
    <body>
        <div id = "header-container">
            <div id="nav-bar">
                <div id = "first-nav" class="nav-ul-container">
                    <img id = "logo-img" src="../imgs/logo.png" alt="cafe-logo">
                    <h1 id = "cafe-name">መዓድ</h1>
                </div>
                <!-- <div id="more-nav">
                    <a href="../admin/attendence.php">ተመለስ</a>
                </div> -->
            </div>            
            <div class = "tables">
                <table style="border: 0px; margin-top: 3rem;">
                    <thead>
                        <td>የሰራተኛ መለያ</td>
                        <td>የተገኘበት ቀናት</td>
                        <td>የቀረበት ቀናት</td>
                    </thead>
                    <?php
                        $i=0;
                        $totalAmount =0;
                        $totalPrice = 0;
                        $date = date('Y-m-d');
                        $all_query = mysqli_query($conn,"select * from attendance where date = '$date'");
 
                        $sql = "SELECT worker_id, date, presence FROM attendance";
                        $result = $conn->query($sql);
                       $attendanceCounts = array();
                       while ($row = $result->fetch_assoc()) {
                            $employeeId = $row['worker_id'];
                            $status = $row['presence'];
                            
                      
                            if (!isset($attendanceCounts[$employeeId])) {
                                $attendanceCounts[$employeeId] = array(
                                    'absence' => 0,
                                    'presence' => 0
                                );
                            }
                            
                            if ($status === 'Absent') {
                                $attendanceCounts[$employeeId]['absence']++;
                            } else {
                                $attendanceCounts[$employeeId]['presence']++;
                            }
                        }
                        
                        
                        foreach ($attendanceCounts as $employeeId => $counts) {
                            echo '<tr>';
                            echo '<td>' . $employeeId . '</td>';
                            echo '<td>' . $counts['presence'] . '</td>';
                            echo '<td>' . $counts['absence'] . '</td>';
                            echo '</tr>';
                        }
                                        
                     ?>                      
                        
                </table>
            </div>
            <div style="display:flex; justify-content: space-around;">
                <button id="print-btn">ፕሪንት</button>
            </div>
        </div>
        <script src="../js/print.js" async defer></script>
    </body>
</html>