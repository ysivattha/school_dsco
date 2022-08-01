</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->

<div class="modal fade" id="modal_start_session">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Start Session</h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST" role="form">
          <div class="row">
            <div class="col-xs-6">
              <button type="submit" name="btn_start_session" class="btn btn-primary" style="border-radius: 0px; width: 100%; height: 100px; font-size: 1.2em;">Start Session From Now</button>
            </div>
            <div class="col-xs-6">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 0px; width: 100%; height: 100px; font-size: 1.2em;">Cancel</button>
            </div>
          </div>
          
        </form>
      </div>
      <div class="modal-foot">
        <br>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_end_session">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">End Session by : <?= $show['username'] ?></h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST" role="form">
          <div class="row">
            <div class="col-xs-6">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 0px; width: 100%; height: 100px; font-size: 1.2em;">Cancel</button>
            </div>
            <div class="col-xs-6">
              <input type="hidden" name="txt_session_id" value="<?= @$row_session->os_id ?>">
              <button type="submit" name="btn_end_session" class="btn btn-primary" style="border-radius: 0px; width: 100%; height: 100px; font-size: 1.2em;">End Session From Now</button>
            </div>
          </div>
          
        </form>
      </div>
      <div class="modal-foot">
        <br>
      </div>
    </div>
  </div>
</div>


  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
     Develop By <a href="http://www.newday-tech.com/">Newday</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <a href="#">HOME</a>.</strong> All rights reserved.
  </footer>

 
 <!--  <aside class="control-sidebar control-sidebar-dark">
   
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
  
    <div class="tab-content">
      
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-desktop bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Develop By Newday </h4>

                <p></p>
              </div>
            </a>
          </li>
        </ul>
    

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
      </div>
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>
            <p>
              Some information about this general settings option
            </p>
          </div>
       
        </form>
      </div>
    </div>
  </aside> -->
 
  <div class="control-sidebar-bg"></div>
</div>
 <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> -->
<script src="offline/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="plugins/dataTables/jquery.dataTables.js"></script>



<script src="plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="dist/js/validator.min.js"></script>
<!-- Page script -->

<script>
  $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
    $('#datepicker1').datepicker({
      autoclose: true
    });
    $('#datepicker2').datepicker({
      autoclose: true
    });
    //iCheck for checkbox and radio inputs
    $("#date").datepicker({
           changeMonth : true,
           changeYear : true
    });
    $(".date1").datepicker({
           changeMonth : true,
           changeYear : true
    });

    //Colorpicker
    
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>



<script type="text/javascript">
            function total()
              {
                 var gg = 0;
                 $('.amount').each(function(i,e){
                    var amt = $(this).val()-0;
                    gg += amt;
                  });
                 $('.subtotal').val(gg);
              }


            $(function(){
              // total amount 
              $('.details').delegate('.quantity,.price','keyup',function(){
                var tr = $(this).parent().parent();
                var price = tr.find('.price').val();
                var qty   = tr.find('.quantity').val();
                var amount = price * qty;
                tr.find('.amount').val(amount.toFixed(2));
                total();
              });
              // end 

              //get pay
              $('.pay').change(function(){
                var amount = $('.amount').val()-0;
                var get      = $(this).val()-0;
                $('.rest').val((get - amount).toFixed(2));
              });
              // end 
            });
</script>

  <!--dataImport
<script src="//code.jquery.com/jquery-1.12.4.js"></script>-->
<script src= "offline/datatable/jquery.dataTables.min.js"></script>
<script src= "offline/datatable/dataTables.buttons.min.js"></script>
<script src= "offline/datatable/buttons.flash.min.js"></script>
<script src= "offline/datatable/jszip.min.js"></script>
<script src= "offline/datatable/pdfmake.min.js"></script>
<script src= "offline/datatable/vfs_fonts.js"></script>
<script src= "offline/datatable/buttons.html5.min.js"></script>
<script src= "offline/datatable/buttons.print.min.js"></script>



  <!-- <script src="offline/jquery-ui.js"></script>  -->

<!-- <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/buttons/1.2.3/js/dataTables.buttons.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/buttons/1.2.3/js/buttons.flash.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script> -->
<!-- <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script> -->
<!-- <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script> -->
<!-- <script src="https://cdn.datatables.net/buttons/1.2.3/js/buttons.html5.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/buttons/1.2.3/js/buttons.print.min.js"></script> -->

<!-- // dataimport-->
<script>
  $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel'
        ]
    } );
} );
</script>


<script>
function suggest(inputString){
    if(inputString.length == 0) {
      $('#suggestions').fadeOut();
    } else {
    $('#country').addClass('load');
      $.post("autosuggestname.php", {queryString: ""+inputString+""}, function(data){
        if(data.length >0) {
          $('#suggestions').fadeIn();
          $('#suggestionsList').html(data);
          $('#country').removeClass('load');
        }
      });
    }
  }

  function fill(thisValue) {
    $('#country').val(thisValue);
    setTimeout("$('#suggestions').fadeOut();", 600);
  }

</script>

    <script>
      $(document).ready(function(){
        $('#code').change(function(){
          var acc = $(this).val();
          $.ajax({
            url:"server.php",
            method:"POST",
            data:{accNo:acc},
            dataType:"text",
            success:function(data)
            {
              $('#result').html(data);
            }
          });
        });
      });
    </script>

<script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'm/dd/yy'   
           });  
           $(function(){  
//                $("#date").datepicker(); 
                $("#from_date").datepicker();  
                $("#to_date").datepicker1();  
           });  
           $('#filter').click(function(){  
//                var date = $('#date').val(); 
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
</script> 

    <script>
        function loadFile(e){
        var output = document.getElementById('preview');
        output.width = 200;
        output.src = URL.createObjectURL(e.target.files[0]);
        }
    </script>

</body>
</html>