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
include ("../private/functions.php");

    try{
    if(isset($_POST['add'])){
      foreach ($_POST['status'] as $i => $status) {
        $fname = $_POST['fname'][$i];
        $id = $_POST['id'][$i];
        $date = date('Y-m-d');
        
        $result = mysqli_query($conn,"insert into attendance(worker_id,fname,presence,date) values('$id','$fname','$status','$date')");
        if($result == false){
            throw new Exception(mysqli_error($conn));
        }
      }
      if(mysqli_error($conn) == null){
            echo "success";
    }
  }
}
  catch(Execption $e){
    $error_msg = $e->$getMessage();
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
        <link rel="stylesheet" href="workers-attendence.css">
        <link rel="stylesheet" href="../stylesheets/nav-bar.css">     
    </head>
    <body>
        <div id = "header-container">

          <?php include("./adminNav.php")?> 
               
              <div id = "menu-form" class="make-center">
                <form method="post">
                  <div id ="#table-container">
                            <table style="border: 0px;">
                                <thead>
                                    <tr>
                                        <th>መለያ ቁጥር</th>
                                        <th>ስም</th>
                                        <th>ተገኝትዋል/ለች?</th>
                                    </tr>
                                </thead>
                                <?php
                                    $i=0;
                                    $radio = 0;
                                    $all_query = mysqli_query($conn,"select * from employee");
                                        
                                    while ($data = mysqli_fetch_array($all_query,MYSQLI_ASSOC)) {
                                    $i++;
                                    ?>
                                <tbody>
                                <tr>
                                        <td><?php echo $data['id']; ?>  <input type="hidden" name="id[]" value="<?php echo $data['id']; ?>"></td>
                                          <td><?php echo $data['fname'] ." " . $data['lname'] ; ?>
                                          <input type="hidden" name="fname[]" value="<?php echo $data['fname']; ?>">
                                        </td>
                                          <td class="smaller-text">
                                            <div>
                                              <label>አዎ</label>
                                              <input type="radio" name="status[<?php echo $radio; ?>]" value="Present" >
                                            </div>
                                            <div>
                                              <label>አይ</label>
                                              <input type="radio" name="status[<?php echo $radio; ?>]" value="Absent" checked>
                                              </div>
                                        </td>
                                        </tr>
                                  
                                </tbody> 
                                <?php

                                      $radio++;
                                      } 
                                      ?>
                                          
                            </table>
                            <div class = "make-center">
                              <input type="submit" class= "edit-menu-button" name="add" value = "መዝግብ">
                            </div>
                            <div class ="report-button">
                              <a  class = "reportLink edit-menu-button" href="attendanceReport.php">ሪፖርት አሳይ</a>
                            </div>
                    </div>
                          <!-- <div id="confirmation-msg"> -->
                              <!-- <output>ያለስህተት ተመዝግብዋል!!</output> -->
                          <!-- </div> -->
                          
                </form>
              </div>
        </div>
        <script src="../js/index.js" async defer></script>
    </body>
</html>