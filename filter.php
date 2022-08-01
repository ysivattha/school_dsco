 <?php  
 include'config/db_connect.php';
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $output = '';  
      $query = "  
           SELECT * FROM invoice  
           WHERE date_sell BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'  
      ";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
              <div class="panel-body">
                  <div class="table-responsive">
                      <table id="example" class="display nowrap" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                                <th>#Invoice</th>
                                <th>No</th>
                                <th>Date</th>
                                <th>Cashier Name</th>
                                <th>Customer Name</th>
                                <th>Amount</th>
                                <th>Vat</th>
                                <th>Detail</th>
                            </tr>
                            </thead>
                            <tbody> ';
           if(mysqli_num_rows($result)) 
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '
                    <tbody>  
                      <tr>
                         <td>'. $row["inv_no"] .'</td>
                         <td>'. $row["inv_no"] .'</td>  
                         <td>'. $row["inv_no"] .'</td>
                         <td>'. $row["inv_no"] .'</td>
                         <td>'. $row["inv_no"] .'</td>
                         <td>'. $row["inv_no"] .'</td>
                         <td>'. $row["inv_no"] .'</td>
                        <td><a href="detail_invoice.php?id='. $row["inv_no"] .'" class="btn btn-primary"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></td>   
                      </tr>
                     </tbody>  
                ';  
           }  
      }  
      else  
      {  
           $output .= '  
                <tbody>
                <tr>  
                     <td colspan="5">No result Found</td>  
                </tr> 
                </tbody> 
           ';  
      }
                      $output .= ' </tbody>
                            </table>
                            </div>
                        </div>';
       
        
      echo $output;  
 }  
 ?> 