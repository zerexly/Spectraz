<?php 
if(isset($_SESSION[PRE_FIX.'id']))
{       
        if(isset($_GET['action'])){
            
            
            if($_GET['action']=="changeAdminPassword") 
            {
    
                $user_id = htmlspecialchars($_POST['user_id'], ENT_QUOTES);
                $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
                
                $url=$baseurl . 'editAdminUserPassword';
                
                $data = array(
    				"user_id" => $user_id,
    				"password" => $password
				);
                
                $json_data=@curl_request($data,$url);
                
                
               if($json_data['code'] !== 200)
               {
                    echo "<script>window.location='dashboard.php?p=adminUsers&action=error'</script>";
               }
               else
               {
                    echo "<script>window.location='dashboard.php?p=adminUsers&action=success'</script>";
               }
    
                
            }
            
            
        }
        
        $url=$baseurl . 'showAdminUsers';
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
                                    <h2>All Admins</h2>
                                    <div class="head-area">
                                    </div>
                                </div>
                                
                                <div class="right" style="padding: 10px 0;">
                                    <button onclick="addAdminUser();" class="com-button com-submit-button com-button--large com-button--default">
                                        <div class="com-submit-button__content"><span>Add Admin</span></div>
                                    </button>
                                </div>
                                <!--start of datatable here-->


                                <table id="table_view" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($json_data['msg'] as $singleRow): ?>

                                        <tr>
                                            <td><?php echo $singleRow['Admin']['id']; ?></td>
                                            <td style="width:150px; overflow:hidden;"><?php echo $singleRow['Admin']['first_name'] . " " . $singleRow['Admin']['last_name']; ?></td>
                                            <td>
                                                <?php echo $singleRow['Admin']['email']; ?>
                                            </td>
                                            <td>
                                                <?php echo $singleRow['Admin']['role']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($singleRow['Admin']['active']=="1")
                                                    {
                                                        echo "Active";
                                                    }
                                                    else
                                                    {
                                                        echo "Blocked";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $singleRow['Admin']['created']; ?>
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
                                                            <li class="more-menu-item" role="presentation" onclick="editAdminUser(<?php echo $singleRow['Admin']['id']; ?>)">
                                                                <button type="button" class="more-menu-btn" role="menuitem">Edit</button>
                                                            </li>
                                                            <li class="more-menu-item" role="presentation" onclick="changeAdminUserPassword('<?php echo $singleRow['Admin']['id']; ?>')">
                                                                <button type="button" class="more-menu-btn" role="menuitem">Change Password</button>
                                                            </li>
                                                            <a href="process.php?action=deleteUserAdmin&user_id=<?php echo $singleRow['Admin']['id']; ?>">
                                                                <li class="more-menu-item" role="presentation">
                                                                    <button type="button" class="more-menu-btn" role="menuitem">Delete</button>
                                                                </li>
                                                            </a>
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
                                            <th>Email</th>
                                            <th>Role</th>
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