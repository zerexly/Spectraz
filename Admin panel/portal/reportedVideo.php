<?php 
if(isset($_SESSION[PRE_FIX.'id']))
{       
    
        $url=$baseurl . 'showReportedVideos';
        $data =array();
        
            
        $json_data=@curl_request($data,$url);
        
        $allusers = [];
        if ($json_data['code'] == 200) {
            $allusers = $json_data['msg'];
        }

        ?>

        <div class="qr-content">
            <div class="qr-page-content">
                <div class="qr-page zeropadding">
                    <div class="qr-content-area">
                        <div class="qr-row">
                            <div class="qr-el">

                                <div class="page-title">
                                    <h2>All Reported Videos</h2>
                                    <div class="head-area">
                                    </div>
                                </div>
                               
                                <table id="table_view" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Reported User</th>
                                            <th>Video ID</th>
                                            <th>Report Title</th>
                                            <th>Description</th>
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
                                                        <td><?php echo $singleRow['ReportVideo']['id']; ?></td>
                                                        <td><?php echo $singleRow['User']['username']; ?></td>
                                                        <td><?php echo $singleRow['Video']['id']; ?></td>
                                                        <td>
                                                            <?php echo $singleRow['ReportVideo']['report_reason_title']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $singleRow['ReportVideo']['description']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $singleRow['ReportVideo']['created']; ?>
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
                                                                        <li class="more-menu-item" role="presentation">
                                                                            <a href="process.php?action=deleteReportedVideo&id=<?php echo $singleRow['ReportVideo']['id']; ?>">
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
                                            <th>Reported User</th>
                                            <th>Video ID</th>
                                            <th>Report Title</th>
                                            <th>Description</th>
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
else 
{
	
	echo "<script>window.location='index.php'</script>";
    die;
    
} 

?>