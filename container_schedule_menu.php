<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from container_schedule_menu where conm_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
            //<!-- update id1 -->
            $checkbox1 = $_POST['checkbox_name1'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox1'
									WHERE conm_id=1 " ;
			mysqli_query($connect, $sql);

            //<!-- update id2 -->
            $checkbox2 = $_POST['checkbox_name2'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox2'
									WHERE conm_id=2 " ;
			mysqli_query($connect, $sql);

            //<!-- update id3 -->
            $checkbox3 = $_POST['checkbox_name3'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox3'
									WHERE conm_id=3 " ;
			mysqli_query($connect, $sql);

            //<!-- update id4 -->
            $checkbox4 = $_POST['checkbox_name4'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox4'
									WHERE conm_id=4 " ;
			mysqli_query($connect, $sql);

            //<!-- update id5 -->
            $checkbox5 = $_POST['checkbox_name5'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox5'
									WHERE conm_id=5 " ;
			mysqli_query($connect, $sql);

            //<!-- update id6 -->
            $checkbox6 = $_POST['checkbox_name6'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox6'
									WHERE conm_id=6 " ;
			mysqli_query($connect, $sql);

            //<!-- update id7 -->
            $checkbox7 = $_POST['checkbox_name7'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox7'
									WHERE conm_id=7 " ;
			mysqli_query($connect, $sql);

            //<!-- update id8 -->
            $checkbox8 = $_POST['checkbox_name8'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox8'
									WHERE conm_id=8 " ;
			mysqli_query($connect, $sql);

            //<!-- update id9 -->
            $checkbox9 = $_POST['checkbox_name9'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox9'
									WHERE conm_id=9 " ;
			mysqli_query($connect, $sql);

            //<!-- update id10 -->
            $checkbox10 = $_POST['checkbox_name10'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox10'
									WHERE conm_id=10 " ;
			mysqli_query($connect, $sql);

            //<!-- update id11 -->
            $checkbox11 = $_POST['checkbox_name11'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox11'
									WHERE conm_id=11 " ;
			mysqli_query($connect, $sql);

            //<!-- update id12 -->
            $checkbox12 = $_POST['checkbox_name12'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox12'
									WHERE conm_id=12 " ;
			mysqli_query($connect, $sql);

            //<!-- update id13 -->
            $checkbox13 = $_POST['checkbox_name13'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox13'
									WHERE conm_id=13 " ;
			mysqli_query($connect, $sql);

            //<!-- update id14 -->
            $checkbox14 = $_POST['checkbox_name14'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox14'
									WHERE conm_id=14 " ;
			mysqli_query($connect, $sql);

            //<!-- update id15 -->
            $checkbox15 = $_POST['checkbox_name15'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox15'
									WHERE conm_id=15 " ;
			mysqli_query($connect, $sql);

            //<!-- update id16 -->
            $checkbox16 = $_POST['checkbox_name16'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox16'
									WHERE conm_id=16 " ;
			mysqli_query($connect, $sql);

            //<!-- update id17 -->
            $checkbox17 = $_POST['checkbox_name17'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox17'
									WHERE conm_id=17 " ;
			mysqli_query($connect, $sql);

            //<!-- update id18 -->
            $checkbox18 = $_POST['checkbox_name18'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox18'
									WHERE conm_id=18 " ;
			mysqli_query($connect, $sql);

            //<!-- update id19 -->
            $checkbox19 = $_POST['checkbox_name19'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox19'
									WHERE conm_id=19 " ;
			mysqli_query($connect, $sql);

            //<!-- update id20 -->
            $checkbox20 = $_POST['checkbox_name20'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox20'
									WHERE conm_id=20 " ;
			mysqli_query($connect, $sql);

            //<!-- update id21 -->
            $checkbox21 = $_POST['checkbox_name21'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox21'
									WHERE conm_id=21 " ;
			mysqli_query($connect, $sql);

            //<!-- update id22 -->
            $checkbox22 = $_POST['checkbox_name22'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox22'
									WHERE conm_id=22 " ;
			mysqli_query($connect, $sql);

            //<!-- update id23 -->
            $checkbox23 = $_POST['checkbox_name23'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox23'
									WHERE conm_id=23 " ;
			mysqli_query($connect, $sql);

            //<!-- update id24 -->
            $checkbox24 = $_POST['checkbox_name24'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox24'
									WHERE conm_id=24 " ;
			mysqli_query($connect, $sql);

            //<!-- update id25 -->
            $checkbox25 = $_POST['checkbox_name25'];
			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$checkbox25'
									WHERE conm_id=25 " ;
			mysqli_query($connect, $sql);

			header("location:container_schedule.php?message=update");
	}	
?>
<style>
    .textp{
        font-size: 16px;
        padding-top: 3px;
    }
</style>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h4 class="text-primary">Edit Show/Hide</h4>
                
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
                                <input type="hidden" name="id" value="1">  
								<div class="form-group col-xs-12">
                                <p class="textp">
                                         
                                    <input type="checkbox" name="checkbox_name1" value="1"
									<?php
                                    $sql1 = "SELECT * from container_schedule_menu where conm_id=1";
                                    $result1 = mysqli_query($connect, $sql1);
                                    $row1 = mysqli_fetch_array($result1);	
										if($row1['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Export
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name2" value="1"
									<?php
                                    $sql2 = "SELECT * from container_schedule_menu where conm_id=2";
                                    $result2 = mysqli_query($connect, $sql2);
                                    $row2 = mysqli_fetch_array($result2);	
										if($row2['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Border
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name3" value="1"
									<?php
                                    $sql3 = "SELECT * from container_schedule_menu where conm_id=3";
                                    $result3 = mysqli_query($connect, $sql3);
                                    $row3 = mysqli_fetch_array($result3);	
										if($row3['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Bill No
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name4" value="1"
									<?php
                                    $sql4 = "SELECT * from container_schedule_menu where conm_id=4";
                                    $result4 = mysqli_query($connect, $sql4);
                                    $row4 = mysqli_fetch_array($result4);	
										if($row4['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Container No
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name5" value="1"
									<?php
                                    $sql5 = "SELECT * from container_schedule_menu where conm_id=5";
                                    $result5 = mysqli_query($connect, $sql5);
                                    $row5 = mysqli_fetch_array($result5);	
										if($row5['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Seal No
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name6" value="1"
									<?php
                                    $sql6 = "SELECT * from container_schedule_menu where conm_id=6";
                                    $result6 = mysqli_query($connect, $sql6);
                                    $row6 = mysqli_fetch_array($result6);	
										if($row6['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Cont Type
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name7" value="1"
									<?php
                                    $sql7 = "SELECT * from container_schedule_menu where conm_id=7";
                                    $result7 = mysqli_query($connect, $sql7);
                                    $row7 = mysqli_fetch_array($result7);	
										if($row7['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Customer ID
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name8" value="1"
									<?php
                                    $sql8 = "SELECT * from container_schedule_menu where conm_id=8";
                                    $result8 = mysqli_query($connect, $sql8);
                                    $row8 = mysqli_fetch_array($result8);	
										if($row8['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Handing Remark
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name9" value="1"
									<?php
                                    $sql9 = "SELECT * from container_schedule_menu where conm_id=9";
                                    $result9 = mysqli_query($connect, $sql9);
                                    $row9 = mysqli_fetch_array($result9);	
										if($row9['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> ETD
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name10" value="1"
									<?php
                                    $sql10 = "SELECT * from container_schedule_menu where conm_id=10";
                                    $result10 = mysqli_query($connect, $sql10);
                                    $row10 = mysqli_fetch_array($result10);	
										if($row10['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> ETA
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name11" value="1"
									<?php
                                    $sql11 = "SELECT * from container_schedule_menu where conm_id=11";
                                    $result11 = mysqli_query($connect, $sql11);
                                    $row11 = mysqli_fetch_array($result11);	
										if($row11['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Tran Mode
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name12" value="1"
									<?php
                                    $sql12 = "SELECT * from container_schedule_menu where conm_id=12";
                                    $result12 = mysqli_query($connect, $sql12);
                                    $row12 = mysqli_fetch_array($result12);	
										if($row12['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Commodity
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name13" value="1"
									<?php
                                    $sql13 = "SELECT * from container_schedule_menu where conm_id=13";
                                    $result13 = mysqli_query($connect, $sql13);
                                    $row13 = mysqli_fetch_array($result13);	
										if($row13['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Destination
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name14" value="1"
									<?php
                                    $sql14 = "SELECT * from container_schedule_menu where conm_id=14";
                                    $result14 = mysqli_query($connect, $sql14);
                                    $row14 = mysqli_fetch_array($result14);	
										if($row14['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Qty
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name15" value="1"
									<?php
                                    $sql15 = "SELECT * from container_schedule_menu where conm_id=15";
                                    $result15 = mysqli_query($connect, $sql15);
                                    $row15 = mysqli_fetch_array($result15);	
										if($row15['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Package Type
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name16" value="1"
									<?php
                                    $sql16 = "SELECT * from container_schedule_menu where conm_id=16";
                                    $result16 = mysqli_query($connect, $sql16);
                                    $row16 = mysqli_fetch_array($result16);	
										if($row16['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> GW
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name17" value="1"
                                    <?php
                                    $sql17 = "SELECT * from container_schedule_menu where conm_id=17";
                                    $result17 = mysqli_query($connect, $sql17);
                                    $row17 = mysqli_fetch_array($result17);	
										if($row17['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> CBM
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name18" value="1"
                                    <?php
                                    $sql18 = "SELECT * from container_schedule_menu where conm_id=18";
                                    $result18 = mysqli_query($connect, $sql18);
                                    $row18 = mysqli_fetch_array($result18);	
										if($row18['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Truck No VN
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name19" value="1"
                                    <?php
                                    $sql19 = "SELECT * from container_schedule_menu where conm_id=19";
                                    $result19 = mysqli_query($connect, $sql19);
                                    $row19 = mysqli_fetch_array($result19);	
										if($row19['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Note
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name20" value="1"
                                    <?php
                                    $sql20 = "SELECT * from container_schedule_menu where conm_id=20";
                                    $result20 = mysqli_query($connect, $sql20);
                                    $row20 = mysqli_fetch_array($result20);	
										if($row20['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Note1
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name21" value="1"
                                    <?php
                                    $sql21 = "SELECT * from container_schedule_menu where conm_id=21";
                                    $result21 = mysqli_query($connect, $sql21);
                                    $row21 = mysqli_fetch_array($result21);	
										if($row21['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Note2
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name22" value="1"
                                    <?php
                                    $sql22 = "SELECT * from container_schedule_menu where conm_id=22";
                                    $result22 = mysqli_query($connect, $sql22);
                                    $row22 = mysqli_fetch_array($result22);	
										if($row22['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Reefer Con
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name23" value="1"
                                    <?php
                                    $sql23 = "SELECT * from container_schedule_menu where conm_id=23";
                                    $result23 = mysqli_query($connect, $sql23);
                                    $row23 = mysqli_fetch_array($result23);	
										if($row23['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Truck No
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name24" value="1"
                                    <?php
                                    $sql24 = "SELECT * from container_schedule_menu where conm_id=24";
                                    $result24 = mysqli_query($connect, $sql24);
                                    $row24 = mysqli_fetch_array($result24);	
										if($row24['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> AP Trucking Vendor
                                </p>
                                <p class="textp">
                                    <input type="checkbox" name="checkbox_name25" value="1"
                                    <?php
                                    $sql25 = "SELECT * from container_schedule_menu where conm_id=25";
                                    $result25 = mysqli_query($connect, $sql25);
                                    $row25 = mysqli_fetch_array($result25);	
										if($row25['conm_show_hide']==1){
											echo "checked";
										}
									?>
									> Delivery Date
                                </p>



		                                

									
		                        </div>
		                        
								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="container_schedule.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>