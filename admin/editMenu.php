<?php
    include("../conn.php");
    ob_start();
    session_start();

    if($_SESSION['name']!='admin')
    {
    header('location: login.php');
    }
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
        <link rel="stylesheet" href="../stylesheets/nav-bar.css">
    </head>
    <body>
        <div id = "header-container">
            <?php include "./adminNav.php"
?>           
            <div id = "menu-form">
                <form method="post">
                    <div>
                        <title >ማውጫ ማረሚያ ገጽ</title>
                    </div>


                    <fieldset>
                        <div>
                            <label for="">ስም</label>
                            <input type="text" placeholder = "የምግብ/መጠጥ ስያ?"  name= "name" required>
                        </div>
                        <div>
                            <label for="" required>ዝርዝር መግለጫ</label>
                            <input  type="textarea" name="description" required>
                        </div>
                        <div>
                            <label for="">አይነት</label>
                            <select name="type" id="">
                                <option value="ምግብ" selected>ምግብ</option>
                                <option value="መጠጥ">መጠጥ</option>
                                <option value="ሎሎች">ሎሎች</option>
                            </select>
                        </div>
                        <div>
                            <label for="">ዋጋ</label>
                            <input type="number" name="price" min="0" required>
                        </div>
                        <div>
                            <input type="submit" id = "add-menu-button" name="add" value="ጨምር">
                        </div>
                    </fieldset>
                    <?php

    
    if(isset($_POST['add']))
    {
        try{
    /////////////////you are stuck here!!!!!!!!!!!!!
        
            if(empty($_POST['name'])){
                throw new Exception("name is required!");
                
            }
            if(empty($_POST['price'])){
                throw new Exception("price is required!");
                
            }
            if (isset($_POST['description'])){
            $sql = "INSERT INTO `food` (`name`, `unitPrice`, `type`, `description`) VALUES ('" . $_POST['name'] . "', '" . $_POST['price'] . "', '" . $_POST['type'] . "', '" . $_POST['description'] . "')";
            }
            else{
                $sql = "INSERT INTO `food` (`name`, `unitPrice`, `type`) VALUES ('" . $_POST['name'] . "', '" . $_POST['price'] . "', '" . $_POST['type'] . "')";          
            }
            $result = mysqli_query($conn,$sql);

            if($result == false){
                throw new Exception(mysqli_error($conn));
            }
            else{
                $sql = null;
                unset($_POST['name']);
                unset($_POST['price']);
                unset($_POST['type']);
                unset($_POST['description']);
                // <div id="confirmation-msg">
                    echo "added successfully";
                // </div>
            }
                
        }
        catch(Exception $e){
            $error_msg=$e->getMessage();
        }
    }
    ?>     
</form>
<div>

<div class="pop-up">
    <form method="post">
        <fieldset>
            <div id="back-container">
                <button  id="back-from-edit"><img height="20px" width="25px" src="../imgs/arrowhead-up.png" alt="" ></button>
            </div>
            <div>
                <label for="">ስም</label>
                <input id="tbe-name" type="text" name="name" placeholder = "የምግብ/መጠጥ ስያ?" required>
                <input id="tbe-hidden" type="hidden" name="oldName" placeholder = "የምግብ/መጠጥ ስያ?" required>
            </div>
            <div>
                <label for=""  required>ዝርዝር መግለጫ</label>
                <input type="textarea" id="tbe-description" name="description" required>
            </div>
            <div>
                <label for="">አይነት</label>
                <select name="type" id="tbe-type">
                    <option value="ምግብ" selected>ምግብ</option>
                    <option value="መጠጥ">መጠጥ</option>
                    <option value="leሎች">leሎች</option>
                </select>
            </div>
            <div>
                <label for="">ዋጋ</label>
                <input type="number" min="0" id="tbe-price" name="price" required>
            </div>
            <div id="editing-buttons">
                <input id ="edit-button" type="submit" name="edit" class = "smaller-buttons" value="አስተካክል">
                <button id = "delete-button" onclick="callDelete()" class = "smaller-buttons">አጥፋ</button>
            </div>
        </fieldset>
        <?php
    if(isset($_POST['edit']))
    {
        
        try{
            if(empty($_POST['name'])){
                throw new Exception("name is required!");
                
            }
            if(empty($_POST['price'])){
                throw new Exception("price is required!");
                
            }
            
            if (isset($_POST["name"]) && isset($_POST["type"]) && isset($_POST["price"])) {
                $sql = "UPDATE `food` SET `name` = '" . $_POST["name"] . "' , `unitPrice` = '" . $_POST["price"] . "' , `type` = '" . $_POST["type"] .  "', `description` = '" . $_POST["description"] . "' WHERE `name` = '" . $_POST["oldName"] . "'";
         
            
            $result = mysqli_query($conn,$sql);

            if($result == false){
                throw new Exception(mysqli_error($conn));
            }
            else{
                $sql = null;
                unset($_POST['name']);
                unset($_POST['price']);
                unset($_POST['type']);  
            }
            }
                
        }
        catch(Exception $e){
            $error_msg=$e->getMessage();
        }
    }
    ?>  
    </form>
</div>
                </form method="post">
                <!-- <div id="confirmation-msg"> -->
                    <!-- <output>ያለስህተት ተጨምርዋል!!</output> -->
                <!-- </div> -->
                <?php 
                
                ?>
                <div id = "table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ስም</th>
                                <th>አይነት</th>
                                <th>ዋጋ</th>
                            </tr>
                        </thead>
                        <?php
                        $i=0;
 
                        $all_query = mysqli_query($conn,"select * from food");
 
                        while ($data = mysqli_fetch_array($all_query,MYSQLI_ASSOC)) {
                          $i++;
 
                        ?>
                                <tbody>
                                    <tr>
                                        <td><?php if (isset($data['name'])) {
                                                echo $data['name']; }?></td>                            
                                        <td><?php if (isset($data['type'])) {
                                                echo $data['type']; }?>  
                                        </td>     
                                        <td>
                                        <?php if (isset($data['unitPrice'])) {
                                                echo $data['unitPrice']; }?>
                                        </td> 
                                        <td>
                                        <?php if (isset($data['description'])) {
                                                echo $data['description']; }?>
                                        </td>                                 
                                        <td>
                                        <button class="edit-button" >Edit</button>
                                        </td>                         
                                    </tr><br>    
                                </tbody> 
                                <?php 
          }           
      ?>
                    </table>
                </div>
            </div>

            <div class="pop-up">
                <form>      
                        <fieldset>
                            <div>
                                <label for="">ስም</label>
                                <input type="text" placeholder = "የምግብ/መጠጥ ስያ?"required>
                            </div>
                            <div>
                                <label for="" required>ዝርዝር መግለጫ</label>
                                <input type="textarea" min="0" required>
                            </div>
                            <div>
                                <label for="">አይነት</label>
                                <select name="" id="">
                                    <option value="" selected>ምግብ</option>
                                    <option value="">መጠጥ</option>
                                    <option value="">leሎች</option>
                                </select>
                            </div>
                            <div>
                                <label for="">ዋጋ</label>
                                <input type="number" min="0" required>
                            </div>
                            <div>
                                <input type="submit" id = "add-menu-button" value="ጨምር">
                            </div>
                        </fieldset>
                    </form>
            </div>
        </div>
        <script src="../js/index.js" async ></script>
        <script src="../js/editMenu.js" async ></script>
    </body>
</html>