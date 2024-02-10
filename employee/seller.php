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
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="../admin/edit-menu.css">
        <link rel="stylesheet" href="../admin/workers-attendence.css">
        <link rel="stylesheet" href="../stylesheets/nav-bar.css">        
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
                    <a href="#">ትዕዛዝ ተቀበል</a>
                    <a href="selfReport.php">የግል-ሪፖርት</a>
                    <a href="../logout.php">ውጣ</a>
                </div>
            </div>

            <div class = "tables">
                <form action="" style="display: block;">
                    <table style="border: 0px;">
                        <thead>
                            <tr>
                                <th>የምግብ/መጠጥ ስም</th>
                                <th>ዋጋ</th>
                                <th>ብዛት</th>
                                <th>ዝርዝር መረጃ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="" id="foods" onchange="loadPrice()" required>
                                    <option value="">None</option>
                                    <?php
                        $i=0;
                        $totalAmount =0;
                        $totalPrice = 0;
                        $date = date('Y-m-d');
                        $all_query = mysqli_query($conn,"select * from food");
 
                        while ($data = mysqli_fetch_array($all_query,MYSQLI_ASSOC)) {
                          $i++;
                        ?>
                                        <option value="<?php echo $data['name']?>"><?php echo $data['name']?></option>  
                        <?php 
                        }           
                        ?>
                                    </select>
                                </td>
                                <td id="price" name="price"></td>
                                <td><input type="number" min="1" name="amount" required></td>
                                <td id="description" name="description"></td>
                                <td><button style="color: rgb(242, 132, 7); padding: 0.2rem; width: 5rem; font-weight: bold; font-size: 1rem;" id="add-button" type="button" onclick="addFood()">ጨምር</button></td>
                            </tr>
                        </tbody>
                </form>
            </div>
            <div class = "tables" style="display: flex; justify-content: space-around;">
                <form method="post">
                    <table style="margin-top: 3rem; border: 0px;">
                        <thead>
                            <td></td>
                            <td>የምግብ/መጠጥ ስም</td>
                            <td>የትዕዛዝ ብዛት</td>
                            <td>አጠቃላይ ዋጋ</td>
                        </thead>
                        <tbody id="orderedList">
                            
                        </tbody>
                        <tfoot id="tableFooter">
                        </tfoot>
                    </table>
                    <div id="message">
                            
                    </div>
                    <div style="display: flex; justify-content: space-around;">
                        <input  style="margin-top: 3rem; color: white; background-color: rgb(242, 132, 7); padding: .5rem; width: 5rem; font-size: 1rem;" type="submit" name="order" id="order-button" value="እዘዝ" />
                    </div>
                </form>
            </div> 
    
        </div>
        <script src="../js/index.js"></script>
        <script src="../js/functions.js"></script>
    </body>
</html>