<?php include'config/db_connect.php';

$id = $_GET["sent_id"];
$sql = "SELECT * FROM student WHERE stu_id = $id";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);	

$card_id  = $row['stu_id'];
$name_kh  = $row['stu_name_kh'];
$name_en  = $row['stu_name_en'];
$sex  = $row['stu_sex'];
$phone  = $row['stu_phone'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="NameCard" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="card_id/idCard.css">
    <title>ID Card</title>
</head>
<body>
    <div class="container">
        <div class="front">
            <img src="card_id/DSO-Front.jpg" alt="Front">
            <div class="contain">
                <div class="contain-box">
                    <div class="logo">
                        <img src="img/student_photo/<?= $row['stu_photo'] ?>" >
                    </div>
                    <form action="" method="post">
                        <div class="box-input">
                            <label for="">Card ID:</label>
                        <input type="text" value="<?php echo $card_id ?>" >
                        </div>
                        <div class="box-input">
                            <label for="">NAME_KH:</label>
                        <input type="text" value="<?php echo $name_kh ?>" >
                        </div>
                        <div class="box-input">
                            <label for="">NAME_EN:</label>
                        <input type="text" value="<?php echo $name_en ?>" >
                        </div>
                        <div class="box-input">
                            <label for="">SEX:</label>
                        <input type="text" value="<?php echo $sex ?>" >
                        </div>
                        <div class="box-input">
                            <label for="">PHONE:</label>
                        <input type="text" value="<?php echo $phone ?>" >
                        </div>
                    </form>
                    <div class="style"></div>
                </div>
            </div>
        </div>
        <div class="back">
            <img src="card_id/DSO-Back.jpg" alt="Back">
        </div>
    </div>
</body>
</html>