<?php 
if(isset($_SESSION[PRE_FIX.'id']))
{       
    
        $url=$baseurl . 'showLicense';
        $data =array();
        
        $json_data=@curl_request($data,$url);
        
        
        if($json_data['code']=="200")
        {
            
        
            $url=$baseurl . 'showGifts';
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
                                    <h2>All Gifts</h2>
                                    <div class="head-area">
                                    </div>
                                </div>
                                
                                <div class="right" style="padding: 10px 0;">
                                    <button onclick="addGifts();" class="com-button com-submit-button com-button--large com-button--default">
                                        <div class="com-submit-button__content"><span>Add Gifts</span></div>
                                    </button>
                                </div>
                                <!--start of datatable here-->


                                <table id="table_view" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Coin</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        if(is_array($json_data['msg']) || is_object($json_data['msg']))
                                        {
                                            foreach ($json_data['msg'] as $singleRow): 
                                                   
                                                ?>
                                                    <tr>
                                                        <td><?php echo $singleRow['Gift']['id']; ?></td>
                                                        <td>
                                                            <?php echo $singleRow['Gift']['title']; ?>
                                                        </td>
                                                        <td>
                                                           <a href="<?php echo imagebaseurl.$singleRow['Gift']['image']; ?>" target="_blank">View Attachment</a>
                                                        </td>
                                                        <td>
                                                           <?php echo $singleRow['Gift']['coin']; ?>
                                                        </td>
                                                        <td>
                                                           <?php echo $singleRow['Gift']['created']; ?>
                                                        </td>
                                                        <td>
                                                            <div class="more">
                                                                <button id="more-btn" class="more-btn">
                                                                    <span class="more-dot"></span>
                                                                    <span class="more-dot"></span>
                                                                    <span class="more-dot"></span>
                                                                </button>
                                                                <div class="more-menu">
                                                                    <div class="more-menu-caret">
                                                                        <div class="more-menu-caret-outer"></div>
                                                                        <div class="more-menu-caret-inner"></div>
                                                                    </div>
                                                                    <ul class="more-menu-items" tabindex="-1" role="menu" aria-labelledby="more-btn" aria-hidden="true">
                                                                        <li class="more-menu-item" onclick="editGift('<?php echo $singleRow['Gift']['id']; ?>');" role="presentation">
                                                                            <button type="button" class="more-menu-btn" role="menuitem">Edit</button>
                                                                        </li>
                                                                        <li class="more-menu-item" role="presentation">
                                                                            <a href="process.php?action=deleteGift&id=<?php echo $singleRow['Gift']['id']; ?>">
                                                                                <button type="button" class="more-menu-btn" role="menuitem">Delete</button>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        
                                                        
                                                    </tr>
                                                <?php 
                                                
                                            endforeach; 
                                        }
                                        
                                        
                                    ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Coin</th>
                                            <th>Created</th>
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