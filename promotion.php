<?php include 'config/db_connect.php';
 
    $sql = "SELECT * FROM customer";

    $result = mysqli_query($connect, $sql);

//		 header('location:vender.php?message=success');
//        Cus
if(isset($_POST['btnadd'])){
        $v_name = $_POST['txt_prom_name'];
        $v_date_start = $_POST['txt_date_start'];
        $v_date_end = $_POST['txt_date_end'];
        $v_buy = $_POST['txt_buy'];
        $v_free = $_POST['txt_free'];
        $v_note = $_POST['txt_note'];
        $sql = "INSERT INTO tbl_promotion (prom_name, prom_date_start, prom_date_end, prom_buy, prom_free, prom_note) VALUES ('$v_name','$v_date_start', '$v_date_end', '$v_buy', '$v_free', '$v_note')";
            $result = mysqli_query($connect, $sql);
            if($result){
                header('location: promotion.php?message=success');
            }
            else
                echo "ERROR";
            }
    else if(isset($_POST['btnupdate'])){
        $v_prom_id = $_POST['txt_prom_id'];
        $v_name = $_POST['txt_prom_name'];
        $v_date_start = $_POST['txt_date_start'];
        $v_date_end = $_POST['txt_date_end'];
        $v_buy = $_POST['txt_buy'];
        $v_free = $_POST['txt_free'];
        $v_note = $_POST['txt_note'];
        $sql = "UPDATE tbl_promotion SET 
                                   prom_name = '$v_name',
                                   prom_date_start = '$v_date_start',
                                   prom_date_end = '$v_date_end',
                                   prom_buy = '$v_buy',
                                   prom_free = '$v_free',
                                   prom_note = '$v_note'
                               WHERE prom_id = '$v_prom_id'";
        $result = mysqli_query($connect, $sql);
        if($result){
            header('location: promotion.php?message=update');
        }else{
            echo "ERORR";
        }
    }
else if(isset($_GET["id"])){
     $id = $_GET["id"];

     $sql = "DELETE FROM tbl_promotion WHERE prom_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {
        header("location:promotion.php?message=delete");
     }
} 
?>
<?php include 'header.php';?>
<div class="row">
    <div class="col-xs-12">
        <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add Customer</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update Customer</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete Customer</h4>';
                      echo '</div>';
                    }
                    ?>
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h2 class="text-primary">Promotion List</h2>
                <hr>
                <!--          Add New-->

                <!-- Modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"><i class="fa fa-user" aria-hidden="true"></i> Add New</button>

                <!-- Modal -->
                <div class="modal fade" id="myModal1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header  btn-primary">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><i class="fa fa-user" aria-hidden="true"></i> Customer</h4>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <form method="post" enctype="multipart/form-data" action="" autocomplete="off">
                                        <input class="form-control" name="no" type="hidden">
                                        <div class="form-group col-xs-12">
                                            <label for="">Promotion Name :</label>
                                            <input class="form-control" autocomplete="off" required name="txt_prom_name" type="text" placeholder="enter promotion name" >
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label for="">Date Start :</label>
                                            <input class="form-control" required name="txt_date_start" type="text" placeholder="date start promotion" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label for="">Date End :</label>
                                            <input class="form-control" required name="txt_date_end" type="text" placeholder="date end promotion" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label for="">Buy :</label>
                                            <input class="form-control" required="" name="txt_buy" type="text" placeholder="10">
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label for="">Free :</label>
                                            <input class="form-control" required name="txt_free" type="text" placeholder="1">
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="note">Note:</label>
                                            <textarea class="form-control" rows="4" name="txt_note" placeholder="note"></textarea>
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <button type="submit" name="btnadd" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Save</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Promotion Name</th>
                                <th>Date Start</th>
                                <th>Date End</th>
                                <th>Buy</th>
                                <th>Free</th>
                                <th>Note</th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM tbl_promotion ORDER BY prom_id ASC";
                                $result = mysqli_query($connect, $sql);
                            	$i= 1;
								while($row = $result->fetch_assoc()) 
								{		
							?>
                                <tr>
                                    <td>
                                        <?php echo $i++;?>
                                    </td>
                                    <td><?= $row['prom_name'] ?></td>
                                    <td><?= $row['prom_date_start'] ?></td>
                                    <td><?= $row['prom_date_end'] ?></td>
                                    <td><?= $row['prom_buy'] ?></td>
                                    <td><?= $row['prom_free'] ?></td>
                                    <td><?= $row['prom_note'] ?></td>
                                    <td class="text-center">
                                        <!--				Edit-->
                                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#<?= $row['prom_id']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>

                                        <!-- Modal -->
                                        <div id="<?= $row['prom_id']?>" class="modal fade text-left" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header  btn-primary">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title"><i class="fa fa-user" aria-hidden="true"></i> Customer</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-md-12">
                                                            <form method="Post" action="" enctype="multipart/form-data">
                                                                <input type="hidden" value="<?= $row['prom_id']?>" name="txt_prom_id">
                                                                <div class="form-group col-xs-12">
                                                                    <label for="">Promotion Name :</label>
                                                                    <input class="form-control" autocomplete="off" required name="txt_prom_name" type="text" placeholder="enter promotion name" value="<?= $row['prom_name']?>">
                                                                </div>
                                                                <div class="form-group col-xs-6">
                                                                    <label for="">Date Start :</label>
                                                                    <input class="form-control" required name="txt_date_start" type="text" placeholder="date start promotion" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="<?= $row['prom_date_start']?>">
                                                                </div>
                                                                <div class="form-group col-xs-6">
                                                                    <label for="">Date End :</label>
                                                                    <input class="form-control" required name="txt_date_end" type="text" placeholder="date end promotion" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="<?= $row['prom_date_end']?>">
                                                                </div>
                                                                <div class="form-group col-xs-6">
                                                                    <label for="">Buy :</label>
                                                                    <input class="form-control" required="" name="txt_buy" type="text" placeholder="10" value="<?= $row['prom_buy']?>">
                                                                </div>
                                                                <div class="form-group col-xs-6">
                                                                    <label for="">Free :</label>
                                                                    <input class="form-control" required name="txt_free" type="text" placeholder="1" value="<?= $row['prom_free']?>">
                                                                </div>
                                                                <div class="form-group col-xs-12">
                                                                    <label for="note">Note:</label>
                                                                    <textarea class="form-control" rows="4" name="txt_note" placeholder="note"><?= $row['prom_note']?></textarea>
                                                                </div>
                                                                <div class="form-group col-xs-6">
                                                                    <button type="submit" name="btnupdate" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Save change</button>
                                                                    <button type="reset" class="btn btn-default">Reset</button>
                                                                </div>
                                                                <div class="form-group col-xs-offset-10 col-xs-6">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!--                                                          <div class="modal-footer">-->
                                                    <div class="modal-footer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                </div>

                <a onclick="return confirm('Are you sure to delete?');" href="promotion.php?id=<?php echo $row['prom_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                </td>
                </tr>
                <?php
											}	 
										?>
                    </tbody>
                    </table>
            </div>

        </div>
    </div>
</div>
</div>
<?php include 'footer.php';?>