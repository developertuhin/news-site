<?php include "header.php"; 

if ($_SESSION['user_role'] == '0') {
  header("Location:post.php");
}

// --------------------------------code to update data get by id---------------------- 
if (isset($_POST['submit'])) {
    include "config.php";
    $userid=mysqli_real_escape_string($conn,$_POST['user_id']);
    $fname =mysqli_real_escape_string($conn,$_POST['f_name']);
    $lname = mysqli_real_escape_string($conn,$_POST['l_name']);
    $uname = mysqli_real_escape_string($conn,$_POST['username']);
    // $password = mysqli_real_escape_string($conn,md5($_POST['password']));
    $role = mysqli_real_escape_string($conn,$_POST['role']);

    $sql1 = "UPDATE user SET first_name='{$fname}', last_name='{$lname}', username='{$uname}', role='{$role}' WHERE user_id = '{$userid}'";

    $result = mysqli_query($conn,$sql1);

      if ($result) {
        header("Location:users.php");
      }
    }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">

 <!----------------------code for show data in input field for update------------------- -->
                <?php 
                  include "config.php";
                  $user_id = $_GET['id'];

                  $sql = "SELECT * FROM user WHERE user_id='{$user_id}'" or die('Query Failed');
                  $result = mysqli_query($conn,$sql);

                   if (mysqli_num_rows($result) >0) {
                    while ($rows = mysqli_fetch_assoc($result)) {                  
                   
               ?>

                  <!-- Form Start -->
                  <form  action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $rows['user_id'] ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $rows['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $rows['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $rows['username'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>

                          
                            <select class="form-control" name="role" value="<?php echo $rows['role']?>">
                              <?php

                              if ($rows['role'] ==1) {
                                echo "<option value='0'> User</option>
                              <option value='1' selected>Admin</option>";
                              }else{
                                echo "<option value='0'selected> User</option>
                              <option value='1' >Admin</option>";
                              }
                             ?> 
                          </select>

                           

                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->

                  <?php 
                  }
                }
                ?>


              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
