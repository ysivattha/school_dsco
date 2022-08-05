<?php include 'config/db_connect.php';

$id = $_GET["sent_id"];
$sql = "SELECT * FROM student WHERE stu_id = $id";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);

$stu_card_id  = $row['stu_card_id'];
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
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100&family=Poppins:wght@300;400;500;600&family=Saira:wght@400;600;800&display=swap');
*{
    margin: 0px;
    padding: 0px;  
    box-sizing: border-box;  
}
.container{
    width: 100%;
    height: 100vh;
    padding: 2rem;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1.5rem;
    background-color: #fff;
}
.container .front, .container .back{
    position: relative;
    width: 192px;
    max-width: 192px;
    min-width: 192px;
    height: 336px;
    min-height: 336px;
    max-height: 336px;
    border-radius: .8rem;
    overflow: hidden;
    box-shadow: .3rem .3rem 1rem rgba(0,0,0,0.1),-.1rem -.3rem 1rem rgba(0,0,0,0.2);
}
/* .container .front::before, .container .back::before{
    content: '';
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 5px;
    background-color: rgba(0, 0, 244, 0.9);
} */
.front img ,.back img{
    width: 100%;
    height: 100%;
}
.front .contain{
    position: absolute;
    left: 0;
    top: 16.35%;
    width: 100%;
    height: 70.9%;
}
.contain .contain-box{
    position: relative;
    width: 100%;
    height: 100%;
    background-color: #fff;
    /* background-color: black; */
}
.contain-box .logo{
    position: absolute;
    top: 5px;
    left: 50%;
    width: 70px;
    height: 100px;
    transform: translateX(-50%);
    /* background-color: black; */
}
.contain-box .logo img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position:50% 100%;
}

.contain-box .style{
    position: absolute;
    right: 0;
    bottom: 0;
    background-color: rgba(238, 238, 238, 0.898);
    clip-path: polygon(100% 0, 0% 100%, 100% 100%);
    width: 85%;
    height: 77%;
}
.front form{
    padding: 1rem .7rem;
    position: absolute;
    left: 0;
    bottom: 0;
    z-index: 100;
    /* background-color: blue; */
    width: 100%;
    height: 60%;
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.box-input{
    width: 100%;
    display: grid;
    grid-template-columns: 25% 72%;
    gap: 3%;
    align-items: center;
}
.front form label{
    font-size: .5rem;
    font-family: 'Kantumruy Pro', sans-serif;
    font-weight: 600;
    text-align: end;
}
.front form input{
    width: 100%;
    border: 0;
    padding: 2px 10px;
    background-color: rgb(93, 212, 255);
    outline-color: blue;
}
.font-family{
    font-family: 'Chenla',"Source Sans Pro", sans-serif;
}
    </style>
</head>

<body>
    <div class="container">
        <div class="front">
            <img src="card_id/DSO-Front.jpg" alt="Front">
            <div class="contain">
                <div class="contain-box">
                    <div class="logo">
                        <img src="img/student_photo/<?= $row['stu_photo'] ?>">
                    </div>
                    <form action="" method="post">
                        <div class="box-input">
                            <label for="">Card ID:</label>
                            <input type="text" value="<?php echo $stu_card_id ?>">
                        </div>
                        <div class="box-input">
                            <label for="">NAME_KH:</label>
                            <input class="font-family" type="text" value="<?php echo $name_kh ?>">
                        </div>
                        <div class="box-input">
                            <label for="">NAME_EN:</label>
                            <input type="text" value="<?php echo $name_en ?>">
                        </div>
                        <div class="box-input">
                            <label for="">SEX:</label>
                            <input type="text" value="<?php echo $sex ?>">
                        </div>
                        <div class="box-input">
                            <label for="">PHONE:</label>
                            <input type="text" value="<?php echo $phone ?>">
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