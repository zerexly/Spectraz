<?php 
if(isset($_SESSION[PRE_FIX.'id']))
{       
    
        $url=$baseurl . 'showLicense';
        $data =array();
        
        $json_data=@curl_request($data,$url);
        
        
        if($json_data['code']=="200")
        {
            
        
            $url=$baseurl . 'showCoinWorth';
            $data =array();
            
            $json_data=@curl_request($data,$url);
        ?>

        <div class="qr-content">
            <div class="qr-page-content">
                <div class="qr-page zeropadding">
                    <div class="qr-content-area">
                        <div class="qr-row">
                            <div class="qr-el">

                                <div class="page-title">
                                    <h2>Gifts Setting</h2>
                                    <div class="head-area">
                                    </div>
                                </div>
                                
                               
                                <table id="table_view" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        if(is_array($json_data['msg']) || is_object($json_data['msg']))
                                        {
                                                   
                                                ?>
                                                    <tr>
                                                        <td><?php echo $json_data['msg']['CoinWorth']['id']; ?></td>
                                                        <td>
                                                            <?php echo $json_data['msg']['CoinWorth']['price']; ?>
                                                        </td>
                                                        <td>
                                                            <span style="color:black;" onclick="editCoinWorth('<?php echo $json_data['msg']['CoinWorth']['id']; ?>');">Edit</span>
                                                        </td>
                                                        
                                                        
                                                    </tr>
                                                <?php 
                                                
                                        }
                                        
                                        
                                    ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        
            <script>
                $(document).ready(function () {
                    $('#table_view').DataTable({
                            "pageLength": 15
                        }
                    );
                });
            </script>
    <?php
    
        }
} 
else 
{
	
	echo "<script>window.location='index.php'</script>";
    die;
    
} 

?>