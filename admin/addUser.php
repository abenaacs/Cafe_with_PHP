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
        <link rel="stylesheet" href="../stylesheets/nav-bar.css">
        <link rel="stylesheet" href="register-workers.css">
    </head>
    <body>
       
        <div id = "header-container">
                <?php include "./adminNav.php"?>  
                <?php
                    if(isset($_POST['register']))
                    {
                        
                        try{
                
                    if(empty($_POST['username'])){
                        throw new Exception("username is required!");
                        
                    }
                    if(empty($_POST['password'])){
                        throw new Exception("password is required!");
                        
                    }
                    if($_POST['password'] == $_POST['confirm']){
                    
                        $sql = "INSERT INTO `employee`(`fname`, `lname`, `phone`, `username`, `pass`) VALUES ('".$_POST['fname']."','".$_POST['lname']."','".$_POST['phone']."','".$_POST['username']."','".$_POST['password']."')";
                        $result = mysqli_query($conn,$sql);
                        
                        if($result == false){
                            throw new Exception(mysqli_error($conn));
                        }
                        else{
                        $sql = null;
                        unset($_POST['fname']);
                        unset($_POST['lname']);
                        unset($_POST['phone']);
                        unset($_POST['username']);
                        unset($_POST['password']);
                        echo "added successfully";
                        }
                        }
                        else{
                        throw new Exception("password is not confirmed!");
                            
                        }
                                
                        }
                        catch(Exception $e){
                            $error_msg=$e->getMessage();
                        }
                        }   
                ?>         
                <div id = "sign-up-form">
                    <form method="post">
                        <div>
                            <label for="">የመጀመርያ ስም</label>
                            <input type ="text" name="fname" required>
                        </div>
                        <div>
                            <label for="">የአባት ስም</label>
                            <input type ="text" name="lname" required>
                        </div>
                        <div>
                            <label for="">ስልክ ቁጥር</label>
                            <input type ="tel" name="phone" required>
                        </div>
                        <div>
                            <label for="">የመለያ ስም</label>
                            <input type ="text" name="username" required>
                        </div>
                        <div>
                            <label for="">የይለፍ ቃል</label>
                            <input class="passwords" type ="password" name="password" required>
                        </div>
                        <div>
                            <label for="">የይለፍ ቃል ማረጋገጫ</label>
                            <input class="passwords" type ="password" name="confirm" required>
                        </div>
                        <div class = "make-center">
                            <input id="create-account" type = "submit" name="register" value="መዝግብ">
                        </div>
                    </form>
                </div>
        </div>
        
        <script src="../js/index.js" async defer></script>
    </body>
</html>