<?php 
if(isset($_SESSION[PRE_FIX.'id']))
{       
        $url=$baseurl . 'showAllPromotions';
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
                                    <h2>Promotion</h2>
                                    <div class="head-area">
                                    </div>
                                </div>
                                
                                <!--start of datatable here-->


                                <table id="table_view" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Video</th>
                                            <th>Coin</th>
                                            <th>Destination</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($json_data['msg']['Promotions'] as $singleRow): ?>

                                        <tr>
                                            <td><?php echo $singleRow['Promotion']['id']; ?></td>
                                            <td style="cursor: pointer;" onclick="viewUserDetails('<?php echo $singleRow['User']['id']; ?>')"><?php echo $singleRow['User']['username']; ?></td>
                                            
                                            <td onclick="viewVideoDetails('<?php echo $singleRow['Video']['id']; ?>')">
                                                View Video
                                            </td>
                                            <td>
                                                <?php echo $singleRow['Promotion']['coin']; ?>
                                            </td>
                                            <td>
                                                <?php echo $singleRow['Promotion']['destination']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($singleRow['Promotion']['active']=="0")
                                                    {
                                                        echo "Pending";
                                                    }
                                                    else
                                                    if($singleRow['Promotion']['active']=="1")
                                                    {
                                                        echo "Active";
                                                    }
                                                    else
                                                    if($singleRow['Promotion']['active']=="2")
                                                    {
                                                        echo "Rejected";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $singleRow['Promotion']['created']; ?>
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
                                                            <li class="more-menu-item" role="presentation" onclick="changePromotionsStatus('<?php echo $singleRow['Promotion']['id']; ?>')">
                                                                <button type="button" class="more-menu-btn" role="menuitem">Change Status</button>
                                                            </li>
                                                            
                                                            <li class="more-menu-item" role="presentation">
                                                                <a href="process.php?action=deletePromotions&id=<?php echo $singleRow['Promotion']['id']; ?>">
                                                                    <button type="button" class="more-menu-btn" role="menuitem">Delete</button>
                                                                </a>
                                                            </li>
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                                
                                            </td>
                                            
                                            
                                        </tr>

                                    <?php endforeach; ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Video</th>
                                            <th>Coin</th>
                                            <th>Destination</th>
                                            <th>Status</th>
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
                    "pageLength": 100
                }
            );
            $('#table_view2').DataTable({
                    "pageLength": 35
                }
            );
        });
        
        
    </script>
    <?php
    
} 
else 
{
	
	@header("Location: index.php");
    echo "<script>window.location='index.php'</script>";
    die;
    
} ?>