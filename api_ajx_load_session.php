<?php 
	include_once('config/db_connect.php');
	$v_from = @$_GET['s'];
    $v_to = @$_GET['e'];
    $sql_session = $connect->query("SELECT * FROM tbl_order_session WHERE DATE_FORMAT(os_session_date,'%Y-%m-%d') >= '$v_from' AND DATE_FORMAT(os_session_date,'%Y-%m-%d') <= '$v_to' ORDER BY os_session_date DESC,os_open_sesstion_date ASC");
    while ($row_session = mysqli_fetch_object($sql_session)) {
        if($row_session->os_id==@$_POST['txt_session']){
            echo '<option SELECTED value="'.$row_session->os_id.'">'.substr($row_session->os_open_sesstion_date,0,11).' :: '.substr($row_session->os_open_sesstion_date,11,5).' -- '.substr($row_session->os_close_sesstion_date,11,5).'</option>';   
        }else{
            echo '<option value="'.$row_session->os_id.'">'.substr($row_session->os_open_sesstion_date,0,11).' :: '.substr($row_session->os_open_sesstion_date,11,5).' -- '.substr($row_session->os_close_sesstion_date,11,5).'</option>';
        }
    }
?>