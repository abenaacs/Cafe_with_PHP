<?php
ob_start();
session_start();

if($_SESSION['name']!='employee')
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
        <meta content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="self-report.css"> -->
        <link rel="stylesheet" href="../admin/workers-attendence.css">
        <link rel="stylesheet" href="../stylesheets/nav-bar.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    </head>
    <body>
        <div id = "header-container">

            <div id="nav-bar">
                <div id = "first-nav" class="nav-ul-container">
                    <img id = "logo-img" src="../imgs/logo.png" alt="cafe-logo">
                    <h1 id = "cafe-name">መዓድ</h1>
                </div>
                <div id="toggle-button" href="#">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
                <div id="more-nav">
                    <a href="seller.php">ትዕዛዝ ተቀበል</a>
                    <a href="#">የግል-ሪፖርት</a>
                    <a href="../logout.php">ውጣ</a>
                </div>
            </div>
            <div id = "table-container" style="margin-top: 5rem; display: flex; justify-content: space-around;">
                <form action="">
                    <table>
                        <thead>
                            <tr>
                                <th> </th>
                                <th>ትዕዛዝ</th>
                                <th>የሸቀጥ ብዛት</th>
                                <th> </th>
                                <th>የትዕዛዝ ዋጋ</th>
                                
                            </tr>
                        </thead>
                        <?php
                        $i=0;
                        $totalAmount =0;
                        $totalPrice = 0;
                        $date = date('Y-m-d');
                        $waiterId = $_COOKIE['waiter_id'];
                        $all_query = mysqli_query($conn,"select * from orders where waiter_id  = '$waiterId' and  date = '$date'");
 
                        while ($data = mysqli_fetch_array($all_query,MYSQLI_ASSOC)) {
                          $i++;
                            $totalAmount += $data['amount'];
                            $totalPrice += $data['totalPrice'];
                        ?>
                    <tbody>
                    <tr>
                                        <td><?php echo $i?></td>  
                                        <td><?php  echo $data['food'];?>  
                                        </td> 
                                        <td>
                                        <?php   echo $data['amount']; ?>
                                        </td> 
                                        <td> </td>                             
                                        <td><?php  echo $data['totalPrice'];?>  
                                        </td>                                 
                    </tr>             
                    </tbody>
                    <?php 
          }           
      ?>
                        <tfoot>
                        <tr>
                            <td> </td>
                            <td>ጠቅላላ ትዕዛዞች</td>
                            <td><?php echo $totalAmount?></td> 
                          <td>ጠቅላላ ሽያጭ</td>
                          <td><?php echo $totalPrice . " birr"?></td>
                        </tr>
                    </tfoot>
                    </table>
                </form>
            </div>    
            </div>
        </div>
        <script src="../js/index.js" async defer></script>
    </body>
</html>