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
        <link rel="stylesheet" href="../employee/selling-page.css">
        <link rel="stylesheet" href="workers-attendence.css">
        <link rel="stylesheet" href="../stylesheets/nav-bar.css">
    </head>
    <body>
        <div id = "header-container">
            <?php include "./adminNav.php"?>                       
            <div class = "tables">
                <table>
                     <caption>የዛሬ ትዕዛዞች</caption>
                    <thead>
                        <td></td>
                        <td>ምግብ</td>
                        <td>የትዕዛዝ ብዛት</td>
                        <td>የተቆጣጣሪ መለያ</td>
                        <td>አጠቃላይ ዋጋ</td>
                    </thead>
                    <?php
                        $i=0;
                        $totalAmount =0;
                        $totalPrice = 0;
                        $date = date('Y-m-d');
                        $all_query = mysqli_query($conn,"select * from orders where date = '$date'");
 
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
                                <td><?php  echo $data['amount'];?>  
                                </td>     
                                <td>
                                <?php   echo $data['waiter_id']; ?>
                                </td>                                 
                                <td>
                                <?php   echo $data['totalPrice']; ?>
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
            </div>
            <div class = "tables">
                <table style="margin-top: 5rem;">
                <caption>የወሩ ትዕዛዞች</caption>
                    <thead>
                        <td>ጠቅላላ የትዕዛዝ ብዛት</td>
                        <td>ጠቅላላ ትዕዛዞች</td>
                        <td>አጠቃላይ ዋጋ</td>
                        <td>ቀን</td>
                        <td>የተቀባይ መለያ ቁጥር</td>
                    </thead>
                        <?php
                            $i=0;
                            $totalAmount =0;
                            $totalPrice = 0;
                            $date = date('Y-m');
                            $all_query = mysqli_query($conn,"select * from orders where date between '$date-1' and '$date-30'  ");
                            while ($data = mysqli_fetch_array($all_query,MYSQLI_ASSOC)) {
                            $i++;
                                $totalAmount += $data['amount'];
                                $totalPrice += $data['totalPrice'];
                        ?>
                            <tbody>
                                <tr> 
                                    <td><?php  echo $data['amount'];?>  
                                    </td>                            
                                    <td><?php  echo $data['food'];?>  
                                    </td>   
                                    </td>                            
                                    <td><?php  echo $data['totalPrice'];?>  
                                    </td>   
                                    <td>
                                    <?php   echo $data['date']; ?>
                                    </td>                                 
                                    <td>
                                    <?php   echo $data['waiter_id']; ?>
                                    </td> 
                                </tr>
                            </tbody>
                                <?php 
                        }           
                            ?>    
                </table>
            </div>
            <div style="display:flex; justify-content: space-around;">
                <button id="print-btn">ፕሪንት</button>
            </div>
        </div>
        <script src="../js/index.js"></script>
        <script src="../js/print.js" async defer></script>
    </body>
</html>