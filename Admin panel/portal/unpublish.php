<?php 
if(isset($_SESSION[PRE_FIX.'id']))
{       
    
        $url=$baseurl . 'showSounds';
        $data =array(
            "publish" =>"0"
        );
        
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
                                    <h2>Unpublish Sounds</h2>
                                    <div class="head-area">
                                    </div>
                                </div>
                                
                                <div class="right" style="padding: 10px 0;">
                                    <button onclick="addSound();" class="com-button com-submit-button com-button--large com-button--default">
                                        <div class="com-submit-button__content"><span>Add Sound</span></div>
                                    </button>
                                </div>
                                <!--start of datatable here-->


                                <table id="table_view" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th width="180px">Name</th>
                                            <th width="150px">Description</th>
                                            <th>Audio</th>
                                            <th>Duration</th>
                                            <th>Uploaded By</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        if(is_array($json_data['msg']) || is_object($json_data['msg']))
                                        {
                                            foreach ($json_data['msg'] as $singleRow): 
                                                   
                                                $local=strpos($singleRow['Sound']['audio'],'webroot');
	                                            if($local==true)
                                                {
                                                    $soundFile=$imagebaseurl.$singleRow['Sound']['audio'];
                                                }
                                                else
                                                {
                                                    $soundFile=$singleRow['Sound']['audio'];
                                                } 
                                                ?>
                                                    <tr>
                                                        <td><?php echo $singleRow['Sound']['id']; ?></td>
                                                        <td>
                                                            <?php echo $singleRow['Sound']['name']; ?>
                                                        </td>
                                                        <td>
                                                            <p><?php echo $singleRow['Sound']['description']; ?></p>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo $soundFile; ?>" target="_blank">
                                                                <span class="fas fa-play-circle" style="color:black;"></span>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <?php echo $singleRow['Sound']['duration']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $singleRow['Sound']['uploaded_by']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $singleRow['Sound']['created']; ?>
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
                                                                            <a href="process.php?action=deleteSound&sound_id=<?php echo $singleRow['Sound']['id']; ?>">
                                                                                <button type="button" class="more-menu-btn" role="menuitem">Delete</button>
                                                                            </a>
                                                                        </li>
                                                                        
                                                                        
                                                                        <?php
                                                                            if($singleRow['Sound']['publish']=="1")
                                                                            {
                                                                                ?>
                                                                                    <li class="more-menu-item" role="presentation">
                                                                                        <a href="process.php?action=changeSoundStatus&sound_id=<?php echo $singleRow['Sound']['id']; ?>&status=0">
                                                                                            <button type="button" class="more-menu-btn" role="menuitem">Unpublish</button>
                                                                                        </a>
                                                                                    </li>
                                                                                <?php 
                                                                            }
                                                                            else
                                                                            {
                                                                                ?>
                                                                                    <li class="more-menu-item" role="presentation">
                                                                                        <a href="process.php?action=changeSoundStatus&sound_id=<?php echo $singleRow['Sound']['id']; ?>&status=1">
                                                                                            <button type="button" class="more-menu-btn" role="menuitem">Publish</button>
                                                                                        </a>
                                                                                    </li>
                                                                                <?php 
                                                                            }
                                                                        ?>
                                                                        
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
                                            <th width="180px">Name</th>
                                            <th width="150px">Description</th>
                                            <th>Audio</th>
                                            <th>Duration</th>
                                            <th>Uploaded By</th>
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