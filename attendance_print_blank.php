<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
    body {        
        width: 210mm;
        height: 100%;
        margin-top: 30px;
        margin-left: 5px;
        margin-right: 0px;
        padding: 0;
        font-size: 12pt; 
    }
    * {
    box-sizing: border-box;
    }

    /* Create three equal columns that floats next to each other */
    .column {
    float: left;
    width: 33.33%;
    padding: 10px;
    }
    .column2 {
    float: left;
    width: 40%;
    padding: 10px;
    }

    /* Clear floats after the columns */
    .row:after {
    content: "";
    display: table;
    clear: both;
    }

    .textcenter{
        text-align: center;
    }

    /* table 1 */
    table, td, th {  
    border: 1px solid #ddd;
    text-align: left;
    }

    table {
    border-collapse: collapse;
    width: 100%;
    }

    th, td {
    padding: 7px;
    }
    </style>
</head>

<body>
<?php include 'config/db_connect.php'; ?>
<?php
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

    $id = $_GET["edit_id"]; 
    $today = date('Y-m-d');
    $sql = "SELECT * FROM course_student
                        LEFT JOIN course ON course.co_id=course_student.cs_course_id
                        LEFT JOIN employee ON employee.emp_id=course.co_teacher
                        LEFT JOIN class ON class.cl_id=course.co_class
                        WHERE cs_course_id ='$id'
                                                ";
    $result = mysqli_query($connect, $sql);
    $row = $result->fetch_assoc();

    $v_teacher = $row['emp_name_kh'];
    $v_class_id = $row['co_class'];
    $v_class = $row['cl_name'];
    $v_course = $row['co_name'];
    $v_time = $row['co_time'];
    $v_generation = $row['co_generation'];
?>

    <div class="textcenter">
        <h2 style="font-family:Khmer; color:black">តារាងវត្តមានសិស្ស</h2>
    </div>
    <div class="row">
        <div class="column">
                    <p style="font-family:Khmer; color:black">
                        គ្រូបង្រៀន : 
                        <?php
                            echo $v_teacher;
                        ?>
                    </p>
                    <p style="font-family:Khmer; color:black">
                        ថ្នាក់់ :
                        <?php
                            echo $v_class;
                        ?>
                    </p>
                    <p style="font-family:Khmer; color:black">
                        វគ្គសិក្សា :
                        <?php
                            echo $v_course;
                        ?>
                    </p>
        </div>
        <div class="column"></div>
        <div class="column">
                    
                    <p style="font-family:Khmer; color:black">
                        ម៉ោងសិក្សា :
                        <?php
                            echo $v_time;
                        ?>
                    </p>
                    <p style="font-family:Khmer; color:black">
                        ជំនាន់ :
                        <?php
                            echo $v_generation;
                        ?>
                    </p>
        </div>
    </div>
    <div class="row textcenter">
        <span style="font-family:Khmer; color:black">
            <b>
                ចាប់ពីថ្ងៃទី: ___________________ ដល់ ___________________
            </b>
        </span>
    </div>
    <div class="row ">
    <br>
        <table>
            <thead>
                <tr>
                    <th style="background-color:#D3D3D3; text-align:center; width:2px; font-family:Khmer; ">លរ</th>
                    <th style="background-color:#D3D3D3; text-align:center; font-family:Khmer; ">សិស្សឈ្មោះ</th>
                    <th style="background-color:#D3D3D3; text-align:center; width:3px ; font-family:Khmer; ">ភេទ</th>
                    <th style="background-color:#D3D3D3; text-align:center; width:6% ; font-family:Khmer; ">ច័ន្ទ</th>
                    <th style="background-color:#D3D3D3; text-align:center; width:6% ; font-family:Khmer; ">អង្គារ</th>
                    <th style="background-color:#D3D3D3; text-align:center; width:6% ; font-family:Khmer; ">ពុធ</th>
                    <th style="background-color:#D3D3D3; text-align:center; width:6% ; font-family:Khmer; ">ព្រហស្បត្តិ៍</th>
                    <th style="background-color:#D3D3D3; text-align:center; width:6% ; font-family:Khmer; ">សុក្រ</th>
                    <th style="background-color:#D3D3D3; text-align:center; width:200px ; font-family:Khmer; ">ផ្សេងៗ</th>
                </tr>
            </thead>
            <tbody>
                        <?php         
                                $sql_sub = "SELECT * FROM course_student
                                                    LEFT JOIN course ON course.co_id=course_student.cs_course_id
                                                    LEFT JOIN employee ON employee.emp_id=course.co_teacher
                                                    LEFT JOIN class ON class.cl_id=course.co_class
                                                    LEFT JOIN student ON student.stu_id=course_student.cs_student_id
                                                    WHERE cs_course_id ='$id'
                                                                ";
                                $result_sub = mysqli_query($connect, $sql_sub);
                                                                
                                $i= 1;
                                while($row_sub = $result_sub->fetch_assoc()) 
                                {		
                                    $v_student_en =$row_sub['stu_name_en'];
                                    $v_student_kh =$row_sub['stu_name_kh'];
                                    $v_sex =$row_sub['stu_sex'];
                        ?>
                <tr>
                    <td> <?php echo $i++;?> </td>
                    <td style="font-family:Khmer; color:black"> 
                        <?php echo $v_student_kh;?> ​<?php echo $v_student_en;?>
                    </td>
                    <td> <?php echo $v_sex;?> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                        <?php
                            }	 
                        ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="column">
        </div>
        <div class="column"></div>
        <div class="column">
                    <p style="font-family:Khmer; color:black">
                        ថ្ងៃខែឆ្នាំ: _____/_______/_______
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 ហត្ថលេខាគ្រូ
                    </p>
                    <p style="font-family:Khmer; color:black">
                        <br><br>
                        ឈ្មោះ _____________________
                    </p>
        </div>
    </div>
    
</body>
</html>