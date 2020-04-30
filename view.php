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
        <div class="col-lg-8 offset-2">
          <form action="index.php" method="post">
            
          </form>
          <p>Advisor: <?php echo "{$advisor['EMP_LNAME']}, {$advisor['EMP_FNAME']}"; ?></p>
        </div>
      </div>
<?php
  include 'include/footer.html';
?>