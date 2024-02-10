<?php
include("../conn.php");
               if(isset($_POST['res'])){
                $selected = $_POST['res'];
                $result = mysqli_query($conn,"select unitPrice from food where name = '$selected'");
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $unitPrice = $row['unitPrice'];
                    echo $unitPrice;
                }
               }
              
                ?>