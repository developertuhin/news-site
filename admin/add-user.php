<?php 
include "header.php"; 
if ($_SESSION['user_role'] == '0') {
  header("Location:post.php");
}

if (isset($_POST['save'])) {
    include "config.php";

    $fname =mysqli_real_escape_string($conn,$_POST['fname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $uname = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,md5($_POST['password']));
    $role = mysqli_real_escape_string($conn,$_POST['role']);

    $sql = "SELECT username FROM user WHERE username = '{$uname}'";

    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result)) {
      echo "<p style='color:red; margin:10px 0px; text-align:center;'>Username Alreade exist !!</p>";
    }else{
      $sql1 = "INSERT INTO user (first_name,last_name,username,password,role) VALUES ('{$fname}','{$lname}','{$uname}','{$password}','{$role}')";

      if (mysqli_query($conn,$sql1)) {
        header("Location:users.php");
      }
    }
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0"> User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
