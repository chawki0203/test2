<?php
  include_once 'include/config.php';
  include_once 'include/util.php';
  include_once 'include/db.php';
  include_once 'include/Logger.php';

  include 'include/header.html';

  $stu_num = safeParam($_REQUEST, "STU_NUM", "");
  if (!$stu_num) {
    die("no student number given");
  }

  $student = findStudentById($stu_num);
  $advisor = findEmployeeById($student['EMP_NUM']);

  $fields = array (
    "STU_FNAME" => "First name",
    "STU_LNAME" => "Last name",
    "STU_INITIAL" => "Middle initial",
    "STU_DOB" => "Date of birth",
    "STU_HRS" => "Hours",
    "STU_CLASS" => "Class",
    "DEPT_CODE" => "Department code",
    "STU_PHONE" => "Phone number",
  );

?>
<div class="row">
  <div class="col-lg-12">
    <form>

<?php foreach($fields as $field => $description): ?>
      <div class="form-group">
        <label for="<?php echo "{$field}"; ?>"><?php echo "{$description}"; ?></label>
        <input type="text" min="1" id="<?php echo "{$field}"; ?>" name="<?php echo "{$field}"; ?>" class="form-control" value="<?php echo $student[$field]; ?>" disabled />
      </div>
<?php endforeach; ?>
  
    </form>
    <p>Advisor: <?php echo "{$advisor['EMP_LNAME']}, {$advisor['EMP_FNAME']}"; ?></p>
    <button class="btn btn-primary d-flex justify-content-center align-content-between mr-1" onclick="get('/index.php')"><span class="material-icons">arrow_back</span>&nbsp;Back</button>

        </div>
      </div>
<?php
  include 'include/footer.html';
?>