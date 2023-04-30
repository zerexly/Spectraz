<?php 
if(isset($_SESSION[PRE_FIX.'id']))
{       
    
        $url=$baseurl . 'showUsers';
        $data =array(
            "starting_point" => "0"
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
                                    <h2>All Users</h2>
                                    <div class="head-area">
                                    </div>
                                </div>
                                
                               <div id="myTabContent">
                                    <input type="hidden" id="pageCount" value="1">
                                    <table id="table_view" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Gender</th>
                                                <th>Brithday</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                        <?php 
                                            if($json_data!="")
                                            {
                                                foreach ($json_data['msg'] as $singleRow): 
                                                        
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $singleRow['User']['id']; ?></td>
                                                            <td style="width:100px; overflow:hidden;"><?php echo $singleRow['User']['first_name'] . " " . $singleRow['User']['last_name']; ?></td>
                                                            <td style="width:100px; overflow:hidden;"><?php echo $singleRow['User']['username']; ?></td>
                                                            <td>
                                                                <?php echo $singleRow['User']['gender']; ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    if($singleRow['User']['dob']=="0000-00-00")
                                                                    {
                                                                        echo "-";
                                                                    }
                                                                    else
                                                                    {
                                                                        echo $singleRow['User']['dob'];
                                                                    }
                                                                ?>
                                                                
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    if($singleRow['User']['active']=="1")
                                                                    {
                                                                        echo "Active";
                                                                    }
                                                                    else
                                                                    if($singleRow['User']['active']=="2")
                                                                    {
                                                                        echo "Blocked";
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $singleRow['User']['created']; ?>
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
                                                                            <li class="more-menu-item" role="presentation" onclick="pushNotificationToUser('<?php echo $singleRow['User']['id']; ?>')">
                                                                                <button type="button" class="more-menu-btn" role="menuitem">Push Notification</button>
                                                                            </li>
                                                                            <li class="more-menu-item" role="presentation" onclick="viewUserDetails('<?php echo $singleRow['User']['id']; ?>')">
                                                                                <button type="button" class="more-menu-btn" role="menuitem">View Details</button>
                                                                            </li>
                                                                            <li class="more-menu-item" role="presentation" onclick="userInbox('<?php echo $singleRow['User']['id']; ?>')">
                                                                                <button type="button" class="more-menu-btn" role="menuitem">Inbox</button>
                                                                            </li>
                                                                            <li class="more-menu-item" role="presentation">
                                                                                <a href="process.php?action=deleteUser&user_id=<?php echo $singleRow['User']['id']; ?>">
                                                                                    <button type="button" class="more-menu-btn" role="menuitem">Delete</button>
                                                                                </a>
                                                                            </li>
                                                                            
                                                                            <li class="more-menu-item" role="presentation">
                                                                                <?php
                                                                                    if($singleRow['User']['active']=="1")
                                                                                    {
                                                                                        ?>
                                                                                            <a href="process.php?action=blockUser&user_id=<?php echo $singleRow['User']['id']; ?>&active=2" >
                                                                                                <button type="button" class="more-menu-btn" role="menuitem">Block</button>
                                                                                            </a>
                                                                                        <?php
                                                                                    }
                                                                                    else
                                                                                    if($singleRow['User']['active']=="2")
                                                                                    {
                                                                                        ?>
                                                                                            <a href="process.php?action=blockUser&user_id=<?php echo $singleRow['User']['id']; ?>&active=1">
                                                                                                <button type="button" class="more-menu-btn" role="menuitem">Active</button>
                                                                                            </a>
                                                                                        <?php
                                                                                    }
                                                                                ?>
                                                                                
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
                                                <th>Username</th>
                                                <th>Gender</th>
                                                <th>Brithday</th>
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

            </div>
        
    <script>
        $(document).ready(function () {
            $('#table_view').DataTable({
                    "pageLength": 50
                }
            );
        });
        
        
        var scrollLoad = true;
        $(window).scroll(function()
        {
            if(scrollLoad && ($(document).height() - $(window).height())-$(window).scrollTop()<=1500)
            {
                // fetch data when we are 800px above the document end
                //var currentPage=parseInt(document.getElementById("pageCount").value);
                
                var currentPage=parseInt($("#myTabContent #pageCount").val());
                var country=parseInt($("#myTabContent #country").val());
                
                // console.log("country=>"+country);
                // console.log("currentPage=>"+currentPage);
                
                //fetch next page data
                $("#table_view tbody").append("<tr id='loadMore'><td colspan='11' style='text-align: center;'><img src='frontend_public/assets-minified/images/loader.gif' style='width: 40px;'></td></tr>");
                var xmlhttp;
                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } 
                else 
                {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () 
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
                    {
                        //console.log(xmlhttp.responseText);
                        if(xmlhttp.responseText!=201)
                        {
                            $("#myTabContent tbody").append(xmlhttp.responseText);
                            
                            $("#myTabContent #pageCount").val(currentPage+1); 
                            
                            scrollLoad = true;
                            
                            $( "#loadMore" ).remove();	
                        }
                        else
                        {
                            scrollLoad = false;
                            $( "#loadMore" ).remove();		
                        }
                    }
                }
                xmlhttp.open("GET", "ajex-events.php?q=showUsers&page="+currentPage);
                xmlhttp.send();
                //fetch next page data
                scrollLoad = false;
           }
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