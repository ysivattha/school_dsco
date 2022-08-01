<?php 
    include_once 'config/db_connect.php';
    $v_qp = (@$_GET['q']=="true")?('1'):('0');
    $file = fopen("currency_kh.txt","w");
    fwrite($file,$v_qp);
    fclose($file);
?>