<?php include'config/db_connect.php';

?>
<?php include 'header.php';?>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Food Stock List</li>
      </ol>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Food Stock</div>
                <div class = "panel-body">
                    <div class = "col-md-12" style="margin-bottom:30px; ">
                        <div class = "col-sm-6 col-sm-offset-1">
                            <a href="set_food1.php"><img src = "img/setfood.PNG" class = "img-responsive"></a>
                        </div>
                        <div class = "col-sm-5">
                            <a href="food_stockin.php"><img src = "img/foodin.PNG" class = "img-responsive"></a> 
                        </div>
                        <div class = "col-sm-6 col-sm-offset-1"  style="margin-top:30px;">
                            <a href="food_stockout.php"><img src = "img/foodout.PNG" class = "img-responsive"></a>   
                        </div>
                        <div class = "col-sm-5" style="margin-top:30px;">
                            <a href="food_stock_balance.php"><img src = "img/foodbalance.PNG" class = "img-responsive"></a>  
                        </div>
                       
                    </div>
                </div>
                <div class = "panel-footer">
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php';?>