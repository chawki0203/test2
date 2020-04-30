<?php
  include_once 'include/config.php';
  include_once 'include/util.php';
  include_once 'include/db.php';
  include_once 'include/Logger.php';

  include 'include/header.html';

  STU_NUM = safeParam($_REQUEST, "STU_NUM", "");
  if (!STU_NUM) {
    die("no such student found")
  }
?>

<?php
  include 'include/footer.html';
?>