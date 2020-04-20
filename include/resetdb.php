<?php
  include_once "util.php";
  $file=CONFIG['databaseFile'];
  $output = `sqlite3 /app/sample.db3 < /app/sample.sql 2>&1`;
  if ($output) {
    debug($output);
  } else {
    redirect("/");
  }
?>