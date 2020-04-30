<?php
  include_once 'include/config.php';
  include_once 'include/util.php';
  include_once 'include/db.php';
  include_once 'include/Logger.php';

  include 'include/header.html';

  $logger = Logger::instance();
  $logger->debug("Here's a debugging message");
  $logger->debug(array("pi" => 3.14159, "e" => 2.71828, "i" => "SQRT(-1)"));
  $logger->debug(array(2, 3, 5, 7, 11, array("pi" => 3.14159, "e" => 2.71828, "i" => "SQRT(-1)")));

  $first_name = safeParam($_REQUEST, "first_name", "");
  $last_name = safeParam($_REQUEST, "last_name", "");
?>
  
      <div class="row">
        <div class="col-lg-12">
          <p>Which student do you want to find?</p>
          <form action="index.php" method="post">
            <div class="form-group">
              <label for="first_name">First name</label>
              <input type="text" min="1" id="first_name" name="first_name" class="form-control" placeholder="Enter first name" value="<?php echo $first_name?>"/>
            </div>
            <div class="form-group">
              <label for="last_name">Last name</label>
              <input type="text" min="1" id="last_name" name="last_name" class="form-control" placeholder="Enter last name" value="<?php echo $last_name?>"/>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
<?php
  if ($last_name || $first_name):
    $rows = findStudentByName($last_name, $first_name);
    // could use findStudentByName2 or findStudentByName3
    $logger->debug($rows);
    if ($rows):
?>
      <div class="row">
        <div class="col-lg-12">
        <table class="table table-striped" border=1>
          <thead class="thead-dark">
            <tr>
              <th>Name</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
<?php foreach ($rows as $row): ?>
  <?php $logger->debug("found student {$row['STU_FNAME']}, {$row['STU_LNAME']}"); ?>
  <tr>
    <td class="align-middle"><?php echo "{$row['STU_LNAME']}, {$row['STU_FNAME']}" ?></td>
    <td lass="align-middle">
      <div class="btn-toolbar" style="float:right">
        <button class="btn btn-primary d-flex justify-content-center align-content-between mr-1 addclickhandler" onclick="get('view.php?ID=<?php echo "{$row['STU_NUM']}"?>'"><span class="material-icons">visibility</span>&nbsp;View</button>
        <button class="btn btn-success d-flex justify-content-center align-content-between mr-1 addclickhandler" action="edit.php" stu_num="<?php echo "{$row['STU_NUM']}"?>"><span class="material-icons">mode_edit</span>&nbsp; Edit</button>
        <button class="btn btn-danger d-flex justify-content-center align-content-between addclickhandler" action="delete.php" stu_num="<?php echo "{$row['STU_NUM']}"?>"><span class="material-icons">delete</span>&nbsp;Delete</button>
      </div>
    </td>
  </tr>
<?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
<?php else: ?>
      <div class="row">
        <div class="col-lg-12">
          <p>No results found</p>
        </div>
      </div>
<?php
    endif;
  endif;
?>
    
<?php
  include 'include/footer.html';
?>