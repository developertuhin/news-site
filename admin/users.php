<?php 
include "header.php"; 

if ($_SESSION['user_role'] == '0') {
  header("Location:post.php");
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                
      <!-- code for show users from db -->
                <?php 
                  include "config.php";

                  if (isset($_GET['page'])) {
                    $page= $_GET['page'];
                  }
                  else {
                    $page = 1;
                  }
                  $limit = 5;

                  $offset = ($page - 1)*$limit;

                  $sql = "SELECT * FROM user ORDER BY user_id  LIMIT {$offset},{$limit}";

                  $result = mysqli_query($conn,$sql);
                  if (mysqli_num_rows($result) >0) {

                 ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php 
                            while ($rows= mysqli_fetch_assoc($result)) {                                                            
                         ?>
                          <tr>
                              <td class='id'><?php echo $rows['user_id'] ?></td>
                              <td><?php echo $rows['first_name']." ".$rows['last_name']?></td>
                              <td><?php echo $rows['username'] ?></td>
                              <td><?php
                                if ($rows['role'] ==1) {
                                  echo 'admin';
                                }else{
                                  echo 'user';
                                }

                               ?>
                               </td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $rows['user_id'] ?>'><i style="color:navy;" class='fa fa-edit'></i></a></td>
                              <td class='delete'><a onclick = "return confirm('Are you Sure to Delete ?')" href='delete-user.php?id=<?php echo $rows['user_id'] ?>'><i style="color:red;" class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php 
                            }
                           ?>
                      </tbody>
                  </table>
                  <?php } 
                    $sql1 = "SELECT * FROM user";
                    $result1= mysqli_query($conn,$sql1);
                    
                    if (mysqli_num_rows($result1) >0) {

                      $total_records = mysqli_num_rows($result1);
                      
                      $total_pages = ceil($total_records/$limit);

                      echo "<ul class='pagination admin-pagination'>";
                      

                      if ($page>1) {
                        echo '<li><a href="users.php?page='.($page-1).'">Prev</a></li>';
                      }
                      for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $page) {
                          $active = "active";
                        }
                        else {
                          $active = "";
                        }
                        echo '<li class="'.$active.'"><a href="users.php?page='.$i.'">'.$i.'</a></li>';
                      }
                      if ($total_pages >$page) {
                        echo '<li><a href="users.php?page='.($page+1).'">Next</a></li>';
                      }
                      echo '</ul>';

                    }
                 
                  ?>
                      <!-- <li class="active"><a>1</a></li> -->
                    
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
