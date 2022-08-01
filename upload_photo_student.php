<?php include'config/db_connect.php';


if(isset($_POST['btn_add'])){
        $v_image = @$_FILES['txt_image'];
        $v_id = @$_POST['txt_id'];
        if($v_image["name"] != ""){
            $old_image = @$_POST['txt_old_img'];
            if(file_exists("img/student_photo/".$old_image) AND $old_image != 'blank.png'){
                unlink("img/student_photo/".$old_image);
            }

            $new_name = date("Ymd")."_".rand(1111,9999).".png";
            move_uploaded_file($v_image["tmp_name"], "img/student_photo/".$new_name);

            $query_update = "UPDATE student SET
                    stu_photo='$new_name' WHERE stu_id='$v_id'";
            
            if($connect->query($query_update)){
                header("Location: student.php");
                $sms = '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Successfull!</strong> Data update ...
                </div>'; 
            }else{
                $sms = '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Error!</strong> Query error ...
                </div>';   
            }
        }
    }

?>
<?php include 'header.php';?>
          <div class="row">
                <div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add ...</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update ...</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete ...</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <h2 class="text-primary">Upload Photo</h2>
                            <hr>
                            <a href="student.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                  
              </div>
              <div class="panel-body">
                 <form action="" method="POST" role="form" enctype="multipart/form-data">
                  <input type="hidden" name="txt_id" value="<?= @$_GET['sent_id'] ?>">
                  <input type="hidden" name="txt_old_img" value="<?= @$_GET['sent_img'] ?>">
                 <div class="row">
                   <duv class="col-xs-6">
                    <img class="img img-thumbnail img-responsive" src="img/student_photo/<?= @$_GET['stu_photo'] ?>" alt="">
                     <div class="form-group">
                       <label for="">Upload Here</label>
                       <input required="" type="file" class="form-control" id="preview" name="txt_image" onchange="loadFile(event)" />
                     </div>
                     
                   </duv>
                 </div>
                   <button type="submit" name="btn_add" class="btn btn-primary">Save</button>
                 </form>
                 
              </div>
          </div>
      </div>
  </div>
  <script>
        function loadFile(e){
        var output = document.getElementById('preview');
        output.width = 100;
        output.src = URL.createObjectURL(e.target.files[0]);
        }
    </script>
<?php include 'footer.php';?>