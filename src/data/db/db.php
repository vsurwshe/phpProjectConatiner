<?php
 /* ---- For Local Testing ---- */ 
  $link = mysqli_connect("192.168.1.110", "root", "root");
  if (!$link) {
      die("Database connection failed: " . mysqli_connect_error());
  }
  $db = mysqli_select_db($link, "vany");
  if (!$db) {
      die("Database selection failed: " . mysqli_connect_error());
  }
  echo "Database Connections Successfully......";
  mysqli_set_charset($link, 'UTF8');
?>  

<?php
/* ----- For Hosting Account ----- */
  // $link = mysqli_connect("sql310.epizy.com", "epiz_22507512", "Vishvanath1");
  // if (!$link) {
  //     die("Database connection failed: " . mysqli_connect_error());
  // }
  // $db = mysqli_select_db($link, "epiz_22507512_vany");
  // if (!$db) {
  //     die("Database selection failed: " . mysqli_connect_error());
  // }
?>  


