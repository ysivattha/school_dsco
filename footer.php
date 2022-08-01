</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
     Develop By <a href="http://www.newday-tech.com/">Newday</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <a href="#">HOME</a>.</strong> All rights reserved.
  </footer>

            
 
  <div class="control-sidebar-bg"></div>
</div>


 <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<!-- old
<script src="bootstrap/js/bootstrap.min.js"></script>
-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
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


</body>
</html> 

