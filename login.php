<?php
include ("./conn.php");


if(isset($_POST['login']))
{
	
	try{

	
		if(empty($_POST['username'])){
			throw new Exception("Username is required!");
			
		}
		if(empty($_POST['password'])){
			throw new Exception("Password is required!");
			
		}

        if($_POST['logas'] == 'admin'){
            
		$row=0;
		$result=mysqli_query($conn,"select * from admin where username='$_POST[username]' and pass='$_POST[password]'");

		$row=mysqli_num_rows($result);

		if($row>0){
			session_start();
			$_SESSION['name']= "admin";
			header('location: admin/editMenu.php');
		}

		else{
			throw new Exception("Username,Password or Role is wrong, try again!");
			header('location: login.php');
		}
        }

        if ($_POST['logas'] == 'employee'){
        
        $row=0;
		$result=mysqli_query($conn,"select * from employee where username='$_POST[username]' and pass='$_POST[password]'");
        $user = $result->fetch_assoc();
		$row=mysqli_num_rows($result);

		if($row>0){
            session_start();
			$_SESSION['name']= "employee";
            setcookie("username", $_POST['username']);
            setcookie("waiter_id", $user['id']);
			header('location: employee/seller.php');
		}

		else{
			throw new Exception("Username,Password or Role is wrong, try again!");
			header('location: login.php');
		}
        }
		

	}


	catch(Exception $e){
		$error_msg=$e->getMessage();
	}
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
        <link rel="stylesheet" href="./stylesheets/sign-in.css">
        <link rel="stylesheet" href="./stylesheets/nav-bar.css">
        
    </head>
    <body>
        <div id = "header-container">

            <div id = "nav-bar">
                <div id = "first-nav" class="nav-ul-container">
                    <img id = "logo-img" src="./imgs/logo.png" alt="cafe-logo">
                    <h1 id = "cafe-name">መዓድ</h1>
                </div>

                <!-- <div id = "more-nav" class="nav-ul-container">
                        <a href="home-page.html" style="flex">ይመለሱ</a>                
                </div> -->
            </div>
            <div id = "sign-up-form">
                <form method="post">
                    <div>
                        <label for="">የመለያ ስም</label>
                        <input type ="text" name="username" required> 
                    </div>
                    <div>
                        <label for="">የይለፍ ቃል</label>
                        <input type ="password" name="password" required>
                    </div>
                    <div style="display: flex; justify-content: space-around;">
                        <select name="logas" id="">
                            <option value="admin">አስተዳዳሪ</option>
                            <option value="employee">ሰራተኛ</option>
                        </select>
                        <input id="sign-in-button" type = "submit" name="login" value="ይግቡ" style="width: 10rem;">
                    </div>
                </form>
            </div>
            <!-- <div class="center">
                <a id="forgot-password" href="forgot-password.html">የይለፍ ቃልዎን ረስተዋል?</a>
            </div> -->
        </div>
        <script src="./js/index.js" async defer></script>
    </body>
</html>