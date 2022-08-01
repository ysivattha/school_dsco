<?php
include 'config/db_connect.php';

$select = "SELECT * FROM invoice Order by transaction_id desc";
  $query_select = $connect->query($select);
  $sel = $query_select->fetch_array();
  $tt = $query_select->num_rows;
  $no = $sel['transaction_id'];
  $no1 = $sel['inv_no'];
  $finalcode = '';

  if($tt > 0 ){
     $finalcode = $no1 + 1;
  }
  else{
     $finalcode = $no + 1;
  }

  if (isset($_GET['b'])) {
     header("location:sale.php?cash=cash&invoice=$finalcode");
  }


?>