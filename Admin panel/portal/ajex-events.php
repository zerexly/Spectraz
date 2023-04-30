<?php
include("config.php");


if (@$_GET['q'] == "changePassword")
{
    $id=$_GET['id'];
    $returnURL=$_GET['returnURL'];
    
    $url=$baseurl . 'showUserDetail';

    $data = array(
        "user_id" => $id
    );

    $json_data=@curl_request($data,$url);

    $id=$json_data['msg']['User']['id'];


    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Change Password</h2>

        <div style="height:130px; overflow:scroll;">
            <form action="process.php?action=changePassword" method="post" >
                <input name="user_id" type="hidden" value="<?php echo $id; ?>" required>
                <input name="page_name" type="hidden" value="<?php echo $returnURL; ?>" required>
                <div class="full_width">
                    <label class="field_title">New Password</label>
                    <input name="password" type="text" required>
                </div>
                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php

}
else
if (@$_GET['q'] == "changeAdminUserPassword")
{
    $id=$_GET['id'];
    
    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Change Password</h2>

        <div style="height:130px; overflow:scroll;">
            <form action="process.php?action=changeAdminUserPassword" method="post" >
                <input name="user_id" type="hidden" value="<?php echo $id; ?>" required>
                <div class="full_width">
                    <label class="field_title">New Password</label>
                    <input name="password" type="text" required>
                </div>
                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php

}
else
if (@$_GET['q'] == "addSection")
{
    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Add Section</h2>

        <div style="height:130px; overflow:scroll;">
            <form action="process.php?action=addSection" method="post" >
                <div class="full_width">
                    <label class="field_title">Section Name</label>
                    <input name="name" type="text" required>
                </div>
                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php

}
else
if (@$_GET['action'] == "addStore")
{
    $url=$baseurl . 'showUsers';
    $data =array(
            "role"=>"store"
    );
    $json_data=@curl_request($data,$url);
    
    
    $url=$baseurl . 'showCountries';
    $data =array(
        "active"=>"1"        
    );
    
    $countries=@curl_request($data,$url);
    
    
    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Add Store</h2>

        <div style="height:450px; overflow:scroll;">

        <form action="process.php?action=addStore" method="post" enctype="multipart/form-data">
            
            <div style="box-shadow: 2px 0px 30px 5px rgba(0, 0, 0, 0.03); border: 1.5px dashed #ddd; height: 220px;">
                
                <div id="coverPreview" style="margin: 0px !important;height: 214px; ">
                    <label for="uploadFileCover" class="hoviringdell uploadBox" id="uploadTriggerCover" style="height: 110px; border: 0px dashed #ddd;margin-top: 45px; ">
                        <img src="frontend_public/uploads/attachment/upload.png" id="coverPlaceholderimage" style="width: 38px;">
                        <div class="uploadText" style="font-size: 12px;" id="coveruploadText">
                            <span style="color:#F69518;">Upload Cover</span><br>
                            Size 320x220
                        </div>
                    </label>
                    <input name="Cover_upload_image" class="" id="uploadFileCover" type="file" onchange="return Upload_image_desktopCover()" style="width: 100%; margin-top: 20px;display:none;">
                </div>
                
                <div id="logoPreview" style="box-shadow: 2px 0px 30px 5px rgba(0, 0, 0, 0.03); position: relative; z-index: 999999; margin:-110px 0 0 20px !important;padding: 0px; min-height:0px; width: 90px;">
                    <label for="uploadFile" class="hoviringdell uploadBox" id="uploadTrigger" style="height:90px; ">
                        <img src="frontend_public/uploads/attachment/upload.png" id="logoPlaceholderimage" style="width: 30px;margin-top: 10px;">
                        <div class="uploadText" style="font-size: 12px;" id="logouploadText">
                            <span style="color:#F69518;">Upload Logo</span><br>
                            Size 90x90
                        </div>
                    </label>
                    <input name="upload_image" class="" id="uploadFile" type="file" onchange="return Upload_image_desktop()" style="width: 100%; margin-top: 20px;display:none;">
                </div>
                
                
            </div>


            <div class="half_width float_left">
                <label class="field_title">Store Name</label>
                <input name="name" type="text" required>
            </div>
            
            <div class="half_width float_right">
                <label class="field_title">Assign User</label>
                <select name="user_id" class="form-control" required="">
                    <option value="">Select User</option>
                    <?php  foreach( $json_data['msg'] as $str => $val ): ?>

                        <option value="<?php echo $val['User']['id']; ?>" ><?php echo $val['User']['first_name']." ".$val['User']['last_name']; ?> (<?php echo $val['User']['email']; ?>)</option>

                    <?php endforeach; ?>
               </select>
            </div>
            
            <div class="full_width clear_both">
                <label class="field_title">About</label>
                <textarea name="about" type="text" required></textarea>
            </div>
            
            <div class="full_width clear_both">
                <label class="field_title">Km or Miles</label>
                <select name="distance_unit" class="form-control" required="">
                    <option value="">Select Km or Miles</option>
                    <option value="k">Km</option>
                    <option value="m">Miles</option>
               </select>
            </div>
            
            <div class="half_width float_left">
                <label class="field_title">Shipping Base Fee</label>
                <input name="shipping_base_fee" type="text" required>
            </div>
            
            <div class="half_width float_right">
                <label class="field_title">Shipping Fee Per km/mile</label>
                <input name="shipping_fee_per_distance" type="text" required>
            </div>
            
            <div class="half_width float_left">
                <label class="field_title">Country</label>
                <select name="country_id" class="form-control" required="">
                    <option value="">Select Country</option>
                    <?php  foreach( $countries['msg'] as $str => $val ): ?>
                        <option value="<?php echo $val['Country']['id']; ?>" ><?php echo $val['Country']['country']; ?></option>
                    <?php endforeach; ?>
               </select>
            </div>
            
            <div class="half_width float_right">
                <label class="field_title">City</label>
                <input name="city" type="text" required>
            </div>
            
            <div class="half_width float_left">
                <label class="field_title">State</label>
                <input name="state" type="text" required>
            </div>
            
            <div class="half_width float_right">
                <label class="field_title">Zip Code</label>
                <input name="zip_code" type="text" required>
            </div>
            
            <div class="half_width float_left">
                <label class="field_title">Location Lat</label>
                <input name="lat" type="text" required>
            </div>
            
            <div class="half_width float_right">
                <label class="field_title">Location Long</label>
                <input name="long" type="text" required>
            </div>
            
           
            <div class="full_width">
                <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                   Submit
                </button>
            </div>

        </form>
        </div>
    </div>
    <?php

}
else
if (@$_GET['action'] == "editStore")
{
    $url=$baseurl . 'showUsers';
    $data =array(
            "role"=>"store"
    );
    $json_data=@curl_request($data,$url);
    
    
    $url=$baseurl . 'showCountries';
    $data =array(
        "active"=>"1"        
    );
    
    $countries=@curl_request($data,$url);
    
    //get selected store informatoin
    
    $store_id=$_GET['id'];
    $url=$baseurl . 'showStores';
    $data =array(
            "store_id"=>$store_id
    );
    $store=@curl_request($data,$url);
    
    
    ?>
    
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Edit Store</h2>

        <div style="height:450px; overflow:scroll;">

        <form action="process.php?action=editStore" method="post" enctype="multipart/form-data">
            <input type="hidden" name="store_id" value="<?php echo $store['msg']['Store']['id']; ?>">
            
            <div style="box-shadow: 2px 0px 30px 5px rgba(0, 0, 0, 0.03); border: 1.5px dashed #ddd; height: 220px;">
                
                <div id="coverPreview" style="margin: 0px !important;height: 214px; background:url(<?php echo $imagebaseurl.$store['msg']['Store']['cover'];?>);background-size: cover;background-repeat: no-repeat;background-position: center;">
                    <label for="uploadFileCover" class="hoviringdell uploadBox" id="uploadTriggerCover" style="height: 110px; border: 0px dashed #ddd;margin-top: 45px; ">
                        <!--<img src="frontend_public/uploads/attachment/upload.png" id="coverPlaceholderimage" style="width: 38px;">-->
                        <!--<div class="uploadText" style="font-size: 12px;" id="coveruploadText">-->
                        <!--    <span style="color:#F69518;">Upload Cover</span><br>-->
                        <!--    Size 320x220-->
                        <!--</div>-->
                    </label>
                    <input name="Cover_upload_image" class="" id="uploadFileCover" type="file" onchange="return Upload_image_desktopCover()" style="width: 100%; margin-top: 20px;display:none;">
                </div>
                
                <div id="logoPreview" style="box-shadow: 2px 0px 30px 5px rgba(0, 0, 0, 0.03); position: relative; z-index: 999999; margin:-110px 0 0 20px !important;padding: 0px; min-height:0px; width: 90px;">
                    <label for="uploadFile" class="hoviringdell uploadBox" id="uploadTrigger" style="height:90px; background:url(<?php echo $imagebaseurl.$store['msg']['Store']['logo'];?>);background-size: cover;background-repeat: no-repeat;background-position: center;">
                        <!--<img src="frontend_public/uploads/attachment/upload.png" id="logoPlaceholderimage" style="width: 30px;margin-top: 10px;">-->
                        <!--<div class="uploadText" style="font-size: 12px;" id="logouploadText">-->
                        <!--    <span style="color:#F69518;">Upload Logo</span><br>-->
                        <!--    Size 90x90-->
                        <!--</div>-->
                    </label>
                    <input name="upload_image" class="" id="uploadFile" type="file" onchange="return Upload_image_desktop()" style="width: 100%; margin-top: 20px;display:none;">
                </div>
                
                
            </div>
            
            
            <div style="clear:both;"></div>


            <div class="half_width float_left">
                <label class="field_title">Store Name</label>
                <input name="name" type="text" value="<?php echo $store['msg']['Store']['name']; ?>" required>
            </div>
            
            <div class="half_width float_right">
                <label class="field_title">Assign User</label>
                <select name="user_id" class="form-control" required="">
                    <option value="">Select User</option>
                    <?php  foreach( $json_data['msg'] as $str => $val ): ?>

                        <option value="<?php echo $val['User']['id']; ?>" <?php if($store['msg']['Store']['user_id']==$val['User']['id']){ echo "selected";} ?> ><?php echo $val['User']['first_name']." ".$val['User']['last_name']; ?></option>

                    <?php endforeach; ?>
               </select>
            </div>
            
            <div class="full_width clear_both">
                <label class="field_title">About</label>
                <textarea name="about" type="text" required><?php echo $store['msg']['Store']['about']; ?></textarea>
            </div>
            
            <div class="full_width clear_both">
                <label class="field_title">Km or Miles</label>
                <select name="distance_unit" class="form-control" required="">
                    <option value="">Select Km or Miles</option>
                    <option value="k" <?php if($store['msg']['Store']['distance_unit']=="k"){ echo "selected";} ?>>Km</option>
                    <option value="m" <?php if($store['msg']['Store']['distance_unit']=="m"){ echo "selected";} ?>>Miles</option>
               </select>
            </div>
            
            <div class="half_width float_left">
                <label class="field_title">Shipping Base Fee</label>
                <input name="shipping_base_fee" type="text" required value="<?php echo $store['msg']['Store']['shipping_base_fee']; ?>">
            </div>
            
            <div class="half_width float_right">
                <label class="field_title">Shipping Fee Per km/mile</label>
                <input name="shipping_fee_per_distance" type="text" required value="<?php echo $store['msg']['Store']['shipping_fee_per_distance']; ?>">
            </div>
            
            <div class="half_width float_left">
                <label class="field_title">Country</label>
                <select name="country_id" class="form-control" required="">
                    <option value="">Select Country</option>
                    <?php  foreach( $countries['msg'] as $str => $val ): ?>
                        <option value="<?php echo $val['Country']['id']; ?>" <?php if($store['msg']['StoreLocation']['country_id']==$val['Country']['id']){ echo "selected";} ?> ><?php echo $val['Country']['country']; ?></option>
                    <?php endforeach; ?>
               </select>
            </div>
            
            <div class="half_width float_right">
                <label class="field_title">City</label>
                <input name="city" type="text" required value="<?php echo $store['msg']['StoreLocation']['city']; ?>">
            </div>
            
            <div class="half_width float_left">
                <label class="field_title">State</label>
                <input name="state" type="text" required value="<?php echo $store['msg']['StoreLocation']['state']; ?>">
            </div>
            
            <div class="half_width float_right">
                <label class="field_title">Zip Code</label>
                <input name="zip_code" type="text" required value="<?php echo $store['msg']['StoreLocation']['zip_code']; ?>">
            </div>
            
            <div class="half_width float_left">
                <label class="field_title">Location Lat</label>
                <input name="lat" type="text" required  value="<?php echo $store['msg']['StoreLocation']['lat']; ?>">
            </div>
            
            <div class="half_width float_right">
                <label class="field_title">Location Long</label>
                <input name="long" type="text" required  value="<?php echo $store['msg']['StoreLocation']['long']; ?>">
            </div>
            
           
            <div class="full_width">
                <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                   Submit
                </button>
            </div>

        </form>
        </div>
    </div>
    <?php

}
else
if (@$_GET['q'] == "addAdminUser")
{
    
    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Add Admin User</h2>

        <div style="height:320px; overflow:scroll;">
            <form action="process.php?action=addAdminUser" method="post" >
                <div class="full_width">
                    <label class="field_title">First Name</label>
                    <input name="first_name" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Last Name</label>
                    <input name="last_name" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Email</label>
                    <input name="email" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Password</label>
                    <input name="password" type="text" required>
                </div>
                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php

}
else
if (@$_GET['q'] == "addUser")
{
    $url=$baseurl . 'showCountries';
    $data = [];
    
    $countries=@curl_request($data,$url);
    //get selected store informatoin
    
    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Add User</h2>

        <div style="height:auto; overflow:scroll;">
            <form action="process.php?action=addUser" method="post" >
                <div class="full_width">
                    <label class="field_title">First Name</label>
                    <input name="first_name" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Last Name</label>
                    <input name="last_name" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Email</label>
                    <input name="email" type="text" required>
                </div>
                
                <div class="full_width">
                    <label class="field_title">Phone</label>
                    <input name="phone" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Password</label>
                    <input name="password" type="text" required>
                </div>
                
                
                <div class="full_width">
                    <label class="field_title">Country</label>
                    <select name="country_id" class="form-control" required="">
                        <option value="">Select Country</option>
                        <?php  foreach( $countries['msg'] as $str => $val ): ?>
                            <option value="<?php echo $val['Country']['id']; ?>"><?php echo $val['Country']['country']; ?></option>
                        <?php endforeach; ?>
                   </select>
                </div>
    
                
                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php

}
else
if (@$_GET['q'] == "addRider")
{
    $url=$baseurl . 'showCountries';
    $data = [];
    
    $countries=@curl_request($data,$url);
    //get selected store informatoin
    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Add Rider</h2>

        <div style="max-height:450px; overflow:scroll;">
            <form action="process.php?action=addRider" method="post" >
                <div class="full_width">
                    <label class="field_title">First Name</label>
                    <input name="first_name" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Last Name</label>
                    <input name="last_name" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Email</label>
                    <input name="email" type="text" required>
                </div>
                
                <div class="full_width">
                    <label class="field_title">Phone</label>
                    <input name="phone" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Password</label>
                    <input name="password" type="text" required>
                </div>
                
                <div class="full_width">
                    <label class="field_title">Rider Fee Per Order (eg. $4 per order)</label>
                    <input name="rider_fee_per_order" type="text" required>
                </div>
                
                <div class="full_width">
                    <label class="field_title">Country</label>
                    <select name="country_id" class="form-control" required="">
                        <option value="">Select Country</option>
                        <?php  foreach( $countries['msg'] as $str => $val ): ?>
                            <option value="<?php echo $val['Country']['id']; ?>"><?php echo $val['Country']['country']; ?></option>
                        <?php endforeach; ?>
                   </select>
                </div>
                
                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php

}
else
if (@$_GET['q'] == "addStoreStore")
{
    $url=$baseurl . 'showCountries';
    $data = [];
    
    $countries=@curl_request($data,$url);
    //get selected store informatoin
    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Add Store User</h2>

        <div style="max-height:450px; overflow:scroll;">
            <form action="process.php?action=addStoreStore" method="post" >
                <div class="full_width">
                    <label class="field_title">First Name</label>
                    <input name="first_name" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Last Name</label>
                    <input name="last_name" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Email</label>
                    <input name="email" type="text" required>
                </div>
                
                <div class="full_width">
                    <label class="field_title">Phone</label>
                    <input name="phone" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Password</label>
                    <input name="password" type="text" required>
                </div>
                
                <div class="full_width">
                    <label class="field_title">Admin Per Order Commission (eg. 4% per order)</label>
                    <input name="admin_per_order_commission" type="text" required>
                </div>
                
                <div class="full_width">
                    <label class="field_title">Country</label>
                    <select name="country_id" class="form-control" required="">
                        <option value="">Select Country</option>
                        <?php  foreach( $countries['msg'] as $str => $val ): ?>
                            <option value="<?php echo $val['Country']['id']; ?>"><?php echo $val['Country']['country']; ?></option>
                        <?php endforeach; ?>
                   </select>
                </div>
                
                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php

}
else
if(@$_GET['q'] == "editAdminUser")
{
    $id=$_GET['id'];

    $url=$baseurl . 'showAdminUsers';

    $data = array(
        "id" => $id
    );

    $json_data=@curl_request($data,$url);

    $id=$json_data['msg']['Admin']['id'];
    $first_name=$json_data['msg']['Admin']['first_name'];
    $last_name=$json_data['msg']['Admin']['last_name'];
    $email=$json_data['msg']['Admin']['email'];
    $role=$json_data['msg']['Admin']['role'];

    ?>
    
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Edit Admin User</h2>

        <div style="height:260px; overflow:scroll;">
            <form action="process.php?action=editAdminUser" method="post" >
                <input name="user_id" type="hidden" value="<?php echo $id; ?>" required>
                <div class="full_width">
                    <label class="field_title">First Name</label>
                    <input name="first_name" type="text" value="<?php echo $first_name; ?>" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Last Name</label>
                    <input name="last_name" type="text" value="<?php echo $last_name; ?>" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Email</label>
                    <input name="email" type="text" value="<?php echo $email; ?>" required>
                </div>
                
                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php

}
else
if(@$_GET['q'] == "showCategory")
{
    $id=$_GET['id'];
    $level=$_GET['level'];

    $url=$baseurl . 'showCategories';

    $data = array(
                    "level" => $id
                );

    $json_data=@curl_request($data,$url);
    //print_r($json_data);
    $json_data=$json_data['msg'];
    
    ?>
        
        <div class="category" style="border:solid 1px #fbf9f9; height: auto; width:240px;padding: 8px 8px;border-radius: 3px;background: #fcfcfc; float: left;margin-left: 10px;">
            <?php
            foreach ($json_data as $singleRow): 
                    
                    $checkImageExist=checkImageExist($imagebaseurl.$singleRow['Category']['image']);
                    if($checkImageExist=="200")
                    {
                        $checkImageExist=$imagebaseurl.$singleRow['Category']['image'];
                    }
                    else
                    {
                        $checkImageExist="frontend_public/uploads/noimage.jpg";
                    }
                    
                ?>
                     <div id="row_<?php echo $singleRow['Category']['id']; ?>" style="border: solid 1px #f5f5f5;padding:2px 8px;font-size: 13px;background: white;margin: 0 0 5px 0;cursor: pointer;">
                        
                        <div style="float: left;" onclick="showCategory('<?php echo $singleRow['Category']['id']; ?>','<?php echo $level+1;?>')" ><img src="<?php echo $checkImageExist; ?>" style="width: 30px; height: 30px;border-radius: 100%;"></div>
                        <div style="float: left;margin-top: 10px;" class="title_<?php echo $singleRow['Category']['id']; ?>" onclick="showCategory('<?php echo $singleRow['Category']['id']; ?>','<?php echo $level+1;?>')" ><?php echo $singleRow['Category']['name']; ?></div>
                        <div style="float: right; margin-top: 10px;">
                            
                            <?php
                                if($singleRow['Category']['featured']=="0")
                                {
                                   ?>
                                        <span style="font-size: 12px;margin-right: 5px;">
                                            <a href="process.php?action=favCategory&featured=1&category_id=<?php echo $singleRow['Category']['id']; ?>"><span class="far fa-star"></span></a>
                                        </span>
                                   <?php 
                                }
                                else
                                if($singleRow['Category']['featured']=="1")
                                {
                                   ?>
                                        <span style="font-size: 12px;margin-right: 5px;">
                                            <a href="process.php?action=favCategory&featured=0&category_id=<?php echo $singleRow['Category']['id']; ?>"><span class="fas fa-star" style="color:black;"></span></a>
                                        </span>
                                   <?php 
                                }
                            ?>
                            
                            <span class="editCategory" onclick="editCategoryRow('<?php echo $singleRow['Category']['id']; ?>')" style="font-size: 12px;margin-right: 5px;">
                                <span class="far fa-edit"></span>
                            </span>
                            
                            <span class="deleteCategory" onclick="deleteCategory('<?php echo $singleRow['Category']['id']; ?>')" style="font-size: 12px;">
                                <span class="far fa-trash-alt"></span>
                            </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="editBox" id="edit_<?php echo $singleRow['Category']['id']; ?>"></div>
                    
                    
                    
                    
                    
                <?php 
            endforeach;   
            ?>
            <div id="newEntry_<?php echo $level+1;?>"></div>
            <div onclick="addCategory('<?php echo $id;?>','<?php echo $level+1;?>')" style="border: dashed 2px #f5f5f5;padding:8px 8px;font-size: 13px;background: #fbfbfb;margin: 0 0 5px 0;">
                + Add New
            </div>
            <div id="addCategory_<?php echo $level+1;?>"></div>
        </div>
        <span id="dataRecived_<?php echo $level+1;?>" style="float: left;"></span>
        
    <?php

}
else
if(@$_GET['q'] == "addCategory")
{
    $id=$_GET['id'];
    $level=$_GET['level'];
    
    ?>
        <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
        <input type="hidden" id="level" name="level" value="<?php echo $level;?>">
        <div class="qr-el" id="logoPreview" style="min-height: auto; float:left; box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.03);padding: 0px;margin: 0px !important;">
            <label for="uploadFile" class="hoviringdell uploadBox" id="uploadTrigger" style="height: 80px;">
                <img src="frontend_public/uploads/attachment/upload.png" id="logoPlaceholderimage" style="width: 27px;margin-top: 6px;">
                <div class="uploadText" style="font-size: 10px;" id="logouploadText">
                    <span style="color:#F69518;">Upload Image</span><br>
                    Size 120x120 (Optional)
                </div>
            </label>
            <input name="upload_image" class="" id="uploadFile" type="file" onchange="return UploadCategoryImage(this)" style="width: 100%; margin-top: 10px;font-size: 10px; display:none;" required="required">
        </div>
        <input type="hidden" id="imageData">
       
        <input type="text" name="category_name" id="category_name" placeholder="Category Name" style="width:100%; font-size:12px;background: transparent;border: 0px;border-bottom: solid 1px grey;padding: 6px 0;">
        <input type="button" value="Submit" onclick="submitAddNewCategory()" style="width:100%;border: 0px;font-size: 12px;padding: 6px 0;border-radius: 4px;margin-top: 10px;">
    <?php

}
else
if(@$_GET['q'] == "submitAddNewCategory")
{
    $id=$_POST['id'];
    $level=$_POST['level'];
    $image=$_POST['image'];
    $image = str_replace("data:image/jpeg;base64,","",$image);
    $image = str_replace("data:image/png;base64,","",$image);
    
    $category_name=$_POST['category_name'];
    
    $url=$baseurl . 'addCategory';

    $data = array(
                    "name"=> $category_name,
                    "store_id"=> "0",
                    "level"=> $id,
                    "description"=> "",
                    "image"=>array("file_data" => $image)
                );

    $json_data=@curl_request($data,$url);
    $json_data=$json_data['msg'];
    
    //print_r($json_data);
    
    $checkImageExist=checkImageExist($imagebaseurl.$json_data['Category']['image']);
    if($checkImageExist=="200")
    {
        $checkImageExist=$imagebaseurl.$json_data['Category']['image'];
    }
    else
    {
        $checkImageExist="frontend_public/uploads/noimage.jpg";
    }
    
    ?>
        <div onclick="showCategory('<?php echo $json_data['Category']['id']; ?>','<?php echo $level;?>')" style="border: solid 1px #f5f5f5;padding:8px 8px;font-size: 13px;background: white;margin: 0 0 5px 0;">
            <img src="<?php echo $checkImageExist; ?>" style="width: 30px; height: 30px;border-radius: 100%;">
            <?php echo $json_data['Category']['name']; ?>
            
            <div style="float: right;">
                <span style="font-size: 12px;margin-right: 5px;">
                    <span class="far fa-edit"></span>
                </span>
                
                <span style="font-size: 12px;">
                    <span class="far fa-trash-alt"></span>
                </span>
            </div>
            <div class="clear"></div>
        </div>
    <?php

}
else
if(@$_GET['q'] == "editUser")
{
    $id=$_GET['id'];

    $url=$baseurl . 'showUserDetail';

    $data = array(
                    "user_id" => $id
                );

    $json_data=@curl_request($data,$url);
    
    $url=$baseurl . 'showCountries';
    $data = "";
    $country=@curl_request($data,$url);
    
    $id=$json_data['msg']['User']['id'];
    $first_name=$json_data['msg']['User']['first_name'];
    $last_name=$json_data['msg']['User']['last_name'];
    $email=$json_data['msg']['User']['email'];
    $phone=$json_data['msg']['User']['phone'];
    $role=$json_data['msg']['User']['role'];
    
    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Edit User</h2>

        <div style="height:100%; overflow:scroll;">
            <form action="process.php?action=editUser" method="post" >
                <input name="user_id" type="hidden" value="<?php echo $id; ?>" required>
                <div class="full_width">
                    <label class="field_title">First Name</label>
                    <input name="first_name" type="text" value="<?php echo $first_name; ?>" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Last Name</label>
                    <input name="last_name" type="text" value="<?php echo $last_name; ?>" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Email</label>
                    <input name="email" type="text" value="<?php echo $email; ?>" required>
                </div>
                
                <div class="full_width">
                    <label class="field_title">Phone</label>
                    <input name="phone" type="text" value="<?php echo $phone; ?>" required>
                </div>
                
                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php

}
else
if(@$_GET['q'] == "editRider")
{
    $id=$_GET['id'];

    $url=$baseurl . 'showUserDetail';

    $data = array(
                    "user_id" => $id
                );

    $json_data=@curl_request($data,$url);
    
    $url=$baseurl . 'showCountries';
    $data = "";
    $country=@curl_request($data,$url);
    
    $id=$json_data['msg']['User']['id'];
    $first_name=$json_data['msg']['User']['first_name'];
    $last_name=$json_data['msg']['User']['last_name'];
    $email=$json_data['msg']['User']['email'];
    $phone=$json_data['msg']['User']['phone'];
    $role=$json_data['msg']['User']['role'];
    $rider_fee_per_order=$json_data['msg']['User']['rider_fee_per_order'];
    $admin_per_order_commission=$json_data['msg']['User']['admin_per_order_commission'];
    
    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Edit Rider</h2>

        <div style="height:100%; overflow:scroll;">
            <form action="process.php?action=editRider" method="post" >
                <input name="user_id" type="hidden" value="<?php echo $id; ?>" required>
                <div class="full_width">
                    <label class="field_title">First Name</label>
                    <input name="first_name" type="text" value="<?php echo $first_name; ?>" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Last Name</label>
                    <input name="last_name" type="text" value="<?php echo $last_name; ?>" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Email</label>
                    <input name="email" type="text" value="<?php echo $email; ?>" required>
                </div>
                
                <div class="full_width">
                    <label class="field_title">Phone</label>
                    <input name="phone" type="text" value="<?php echo $phone; ?>" required>
                </div>
                
                
                <div class="full_width">
                    <label class="field_title">Rider Fee Per Order (eg. $4 per order)</label>
                    <input name="rider_fee_per_order" type="text" value="<?php echo $rider_fee_per_order; ?>" required>
                </div>
                
                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php

}
else
if (@$_GET['action'] == "editCountry")
{
    
    $id=$_GET['id'];

    $url=$baseurl . 'showCountries';

    $data = array(
                    "id" => $id
                );

    $json_data=@curl_request($data,$url);
    $json_data=$json_data['msg'];
    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" style="height: 500px;overflow: scroll;" >
        <h2 style="font-weight: 300;" align="center">Edit Country</h2>

        <form class="addcategory" action="?p=counties&action=editCountry" method="post" >
            <input name="id" type="hidden" value="<?php echo $id; ?>" required>
            <input name="name" type="hidden" value="<?php echo $json_data['Country']['name']; ?>" required>
            <div class="full_width">
                <label class="field_title">Country Name</label>
                <input name="country" type="text" value="<?php echo $json_data['Country']['country']; ?>" required>
            </div>

            <div class="full_width">
                <label class="field_title">iso</label>
                <input name="iso" type="text" value="<?php echo $json_data['Country']['iso']; ?>" required>
            </div>
            
            <div class="full_width">
                <label class="field_title">iso3</label>
                <input name="iso3" type="text" value="<?php echo $json_data['Country']['iso3']; ?>" required>
            </div>
            
            <div class="full_width">
                <label class="field_title">country_code</label>
                <input name="country_code" type="text" value="<?php echo $json_data['Country']['country_code']; ?>" required>
            </div>
            
            <div class="full_width">
                <label class="field_title">currency_code</label>
                <input name="currency_code" type="text" value="<?php echo $json_data['Country']['currency_code']; ?>" required>
            </div>
            
            <div class="full_width">
                <label class="field_title">currency_symbol</label>
                <input name="currency_symbol" type="text" value="<?php echo $json_data['Country']['currency_symbol']; ?>" required>
            </div>
            
            <div class="full_width">
                <label class="field_title">Active/Disable</label>
                <select name="status" class="full_width" required>
                    <option value="">Select Status</option>
                    <option value="1" <?php if($json_data['Country']['active']=="1"){ echo "selected"; } ?> >Active</option>
                    <option value="0" <?php if($json_data['Country']['active']=="0"){ echo "selected"; } ?> >Disable</option>
                </select>
            </div>
                
            <div class="full_width">
                <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                   Submit
                </button>
            </div>


        </form>

    </div>
    <?php

}


///////////////////////////////////////////////////

else
if (@$_GET['action'] == "orderDetails")
{
    $id=$_GET['id'];
    $url=$baseurl . 'showOrderDetail';

    $data = array(
                "order_id" => $id
            );

   $json_return=@curl_request($data,$url);
   
   $currency_code=$json_return['msg']['Store']['StoreLocation']['Country']['currency_code'];
   //print_r($json_return);
    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper">
        <h2 style="font-weight: 300;" align="center">Order Details (#<?php echo $id; ?>)</h2>

        <div style="height:400px; overflow:scroll;">
            
            <h3 style="font-weight: 300;" align="left">Store Details</h3>

            <div style="line-height: 25px;margin-top: 10px;">
                
                <div class="full_width" style="font-size:13px;">
                    <span class="fas fa-store-alt"></span>&nbsp;
                    <?php
                        echo $json_return['msg']['Store']['name'];
                    ?>
                </div>
                <div class="full_width" style="font-size:13px;">
                    <span class="fa fa-user"></span>&nbsp;
                    <?php
                        echo $json_return['msg']['Store']['User']['first_name']." ".$json_return['msg']['Store']['User']['last_name'];
                    ?>
                </div>
                <div class="full_width" style="font-size:13px;">
                    <span class="fa fa-envelope"></span>&nbsp;
                    <?php
                       echo $json_return['msg']['Store']['User']['email']; 
                    ?>
                </div>
                <div class="full_width" style="font-size:13px;">
                    <span class="fa fa-phone"></span>&nbsp;
                    <?php
                       echo $json_return['msg']['Store']['User']['phone']; 
                    ?>
                </div>
                <div class="full_width" style="font-size:13px;">
                    <span class="fa fa-street-view"></span>&nbsp;
                    <?php
                        echo $json_return['msg']['Store']['StoreLocation']['city'].",".$json_return['msg']['Store']['StoreLocation']['state'].",".$json_return['msg']['Store']['StoreLocation']['Country']['country'];
                    ?>
                </div>
                
            </div>
             <br>
             
            <h3 style="font-weight: 300;" align="left">Item Details</h3>

            <div style="line-height: 25px;margin-top: 10px;">
                    <?php  foreach( $json_return['msg']['OrderStoreProduct'] as $str => $val ): ?>
                        <div class="full_width" style="border-bottom: solid 1px #edecec;margin-bottom: 10px;">
                        
                            <div class="float_left">
                                <img src="<?php echo $imagebaseurl.$val['product_image']; ?>" style="width: 70px;">
                            </div>
                            <div class="half_width float_left" style="padding: 0 10px;">
                                <h4><?php echo $val['product_title']; ?></h4>
                                <p style="font-size: 13px;"><b>Price:</b><?php echo $currency_code.$val['product_price']; ?></p>
                                <p style="font-size: 13px;"><b>Quantity:</b><?php echo $val['product_quantity']; ?></p>
                            </div>
                            <div class="clear"></div>
                         </div>
                    <?php endforeach; ?>
                <p style="background: #f8f8f8;padding: 5px 10px;">Note :<?php echo $json_return['msg']['Order']['note']; ?></p>
           </div>
            <br>
            
            
            <h3 style="font-weight: 300;" align="left">Customer Details</h3>

            <div style="line-height: 25px;margin-top: 10px;">
                <div class="full_width" style="font-size:13px;">
                    <span class="fa fa-user"></span>&nbsp;
                    <?php
                        echo $json_return['msg']['User']['first_name']." ".$json_return['msg']['User']['last_name'];
                    ?>
                </div>
                <div class="full_width" style="font-size:13px;">
                    <span class="fa fa-envelope"></span>&nbsp;
                    <?php
                        echo $json_return['msg']['User']['email'];
                    ?>
                </div>
                <div class="full_width" style="font-size:13px;">
                    <span class="fa fa-phone"></span>&nbsp;
                    <?php
                        echo $json_return['msg']['User']['phone']
                    ?>
                </div>

                <div class="full_width" style="font-size:13px;">
                    <span class="fa fa-street-view"></span>&nbsp;
                    <a href="https://maps.google.com/maps?q=<?php echo $json_return['msg']['DeliveryAddress']['lat']; ?>,<?php echo $json_return['msg']['DeliveryAddress']['long']; ?>" target="_blank"><?php echo $json_return['msg']['DeliveryAddress']['street'];?></a>
                </div>


            </div>

            <br>
            <p align="left">Price:<?php echo $currency_code.$json_return['msg']['Order']['total']; ?></p>
            <p align="left">Discount:<?php echo $json_return['msg']['Order']['discount']; ?></p>
            <p align="left">Delivery Fee:<?php echo $currency_code.$json_return['msg']['Order']['delivery_fee']; ?></p>
            
            
            
            <style>
                .buttonRow div
                {
                    background: #C3242E;
                    color: white;
                    padding: 12px 65px;
                    border-radius: 3px;
                    text-align:center;
                }
                
                .buttonRow
                {
                    padding: 10px 0;
                    margin-top:20px;
                }
            </style>
            <!--<div class="buttonRow">-->
                <!--<a href="process.php?action=acceptOrder&orderID=<?php echo $id; ?>&status=1">-->
                <!--    <span>Accept</span>-->
                <!--</a>-->
                <!--<a href="process.php?action=rejectOrder">-->
                <!--    <span>Reject</span>-->
                <!--</a>-->
            <!--    <a href="dashboard.php?p=assignRider&orderID=<?php echo $id; ?>" target="_target">-->
            <!--        <div>Assign To Rider</div>-->
            <!--    </a>-->
            <!--</div>-->
            
            
        </div>
        
        
        
        
    </div>
    <?php

}
else
if (@$_GET['action'] == "getOrders")
{
    
    if(isset($_GET['filter']))
    {
        if($_GET['filter']=="completed")
        {
            $data =array (
              'status'=>'2'
            );
        }
        else
            if($_GET['filter']=="active")
        {
            $data =array (
              'status'=>'1'
            );
        }
        else
        if($_GET['filter']=="rejected")
        {
            $data =array (
              'status'=>'3'
            );
        }
        else
        {
            $data =array (
                  'status'=>'0'
                );
        }
    }
    else
    {
        $data =array (
              'status'=>'0'
            );
    }
    $url=$baseurl . 'showOrders';
    
    $json_data=@curl_request($data,$url);
   
    if($json_data['code']=="200")
    {
        foreach ($json_data['msg'] as $row): 
            ?>
                 <div class="orderRow">
                    <div class="progress">
                        <ul class="progress-bar">
                            <li><div class="blob orange"></div></li>
                            <li>
                            <li>
                        </ul>
                    </div>
                    <div class="orderDetails">
                        <span class="time">
                            <?php  
                                $date = strtotime($row['Order']['pickup_datetime']);
			                    echo date('g:i A',$date);
			                ?>
                        </span>
                        <span class="ticketNo">Order # <?php echo $row['Order']['id']; ?></span>
                        <div class="clear"></div>
                        <p class="CustomerName">
                            <?php  
                                echo ucwords($row['Order']['sender_name']);
			                ?>
                        </p>
                        <p class="dropAddress" title="<?php echo $row['Order']['receiver_location_string']; ?>">
                            <?php  
                                echo substr($row['Order']['receiver_location_string'],0,35).'..';
			                ?>
                        </p>
			            <p class="rider">
                            
                            <span class="outlineBtn">
                                <i class="fas fa-biking"></i>
                                Assign Driver
                            </span>
                        </p>        
                        
                    </div>
                   
                    <div class="clear"></div>
                </div>
            <?php 
        endforeach;
    }

}
else
if (@$_GET['action'] == "editTax")
{
    $id=$_GET['id'];

    $url=$baseurl . 'showTaxDetail';

    $data = array(
                    "id" => $id
                );

    $json_data=@curl_request($data,$url);

    $id=$json_data['msg'][0]['Tax']['id'];
    $city=$json_data['msg'][0]['Tax']['city'];
    $state=$json_data['msg'][0]['Tax']['state'];
    $tax=$json_data['msg'][0]['Tax']['tax'];
    $country=$json_data['msg'][0]['Tax']['country_id'];
    
    //get countries
    $url=$baseurl . 'showCountries';

    $data =array(
        "active"=>"1"        
    );

    $json_data=@curl_request($data,$url);

    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Edit Tax</h2>

        <div style="height:350px; overflow:scroll;">
            <form class="addcategory" action="?p=taxSetting&action=addTax" method="post" >
                <input name="id" type="hidden" value="<?php echo $id; ?>" required>

                <div class="full_width">
                    <label class="field_title">Country</label>
                    <select name="country" class="full_width" required>
                        <option value="">Select Country</option>

                        <?php  foreach( $json_data['msg'] as $str => $val ): ?>

                            <option value="<?php echo $val['Country']['id']; ?>" <?php if($country==$val['Country']['id']){ echo "selected";} ?> ><?php echo $val['Country']['country']; ?></option>

                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="full_width">
                    <label class="field_title">City</label>
                    <input name="city" type="text" value="<?php echo $city; ?>"  required>
                </div>

                <div class="full_width">
                    <label class="field_title">State</label>
                    <input name="state" type="text" value="<?php echo $state; ?>"  required>
                </div>


                <div class="full_width">
                    <label class="field_title">Tax %</label>
                    <input name="tax" type="number" value="<?php echo $tax; ?>"  required>
                </div>

                
                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>


            </form>
        </div>
    </div>
    <?php

}
else
if (@$_GET['action'] == "addTax")
{

    $url=$baseurl . 'showCountries';

    $data =array(
        "active"=>"1"        
    );

    $json_data=@curl_request($data,$url);
    
    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Add Tax</h2>

        <div style="height:320px; overflow:scroll;">
            <form class="addcategory" action="?p=taxSetting&action=addTax" method="post" >

                <div class="full_width">
                    <label class="field_title">Country</label>
                    <select name="country" class="full_width" required>
                        <option value="">Select Country</option>

                        <?php  foreach( $json_data['msg'] as $str => $val ): ?>

                            <option value="<?php echo $val['Country']['id']; ?>"><?php echo $val['Country']['country']; ?></option>

                        <?php endforeach; ?>

                    </select>
                </div>
                
                <div class="full_width">
                    <label class="field_title">City</label>
                    <input name="city" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">State</label>
                    <input name="state" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Tax %</label>
                    <input name="tax" type="number" required>
                </div>

                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
                
            </form>
        </div>
    </div>
    <?php

}
else
if (@$_GET['action'] == "addProducts")
{
    $store_id=$_GET['store_id'];
    $url=$baseurl . 'showCountries';
    $data = "";
    $json_data=@curl_request($data,$url);
    
    //select category
    $url=$baseurl . 'showCategories';
    $data =array(
        "level"=>"0"    
    );
    
    $json_data_category=@curl_request($data,$url);
    $json_data_category=$json_data_category['msg'];
    
    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Add Product</h2>

        <div style="height:450px; overflow:scroll;">
            
            <form class="addcategory" action="process.php?action=addProduct" method="post" >
                
                <input type="hidden" value="<?php echo $store_id; ?>" name="store_id">
                <div class="full_width" id="logoPreview" style="margin-bottom: 20px;">
                    <div id="previewImage"></div>
                    
                    <div style="float:left; width:80px;">
                        <label for="imageData" style="border:dashed 2px #e7e7e7;width: 80px;height: 80px;text-align: center;border-radius: 4px;">
                            <img src="frontend_public/assets-minified/images/productimg.png" id="logoPlaceholderimage" style="width: 35px;opacity: 0.7;margin-top: 20px;">
                            
                        </label>
                        <input name="imageData" class="" id="imageData" onchange="return previewImage(this)" style="width: 100%; margin-top: 20px; display:none;" required="required" type="file">
                    </div>
                    <div class="clear"></div>
                </div>
                
                
                
                
                <div class="full_width">
                    <label class="field_title">Product Title</label>
                    <input name="title" type="text" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Product Description</label>
                    <textarea name="description" type="text" required></textarea>
                </div>
                
                <?php 
                    $countData=count($json_data_category);
                    if($countData>0)
                    {
                        ?>
                            <div class="full_width">
                                <label class="field_title">Select Category</label>
                                <select name="category_id" id="category_id" class="form-control" onchange="selectCategory(this.value,'1')" required="">
                                    <option value="">Select Category</option>
                                    <?php  foreach( $json_data_category as $str => $val ): ?>
                
                                        <option value="<?php echo $val['Category']['id']; ?>" ><?php echo $val['Category']['name']; ?></option>
                
                                    <?php endforeach; ?>
                               </select>
                            </div>
                            <span id="dataRecived_1"></span>
                        <?php
                    }
                    
                     
                ?>
                    
                <div class="full_width">
                    <label class="field_title">Price</label>
                    <input name="price" type="text" required>
                </div>
                
                <div class="full_width">
                    <label class="field_title">Sale Price</label>
                    <input name="sale_price" type="text" required>
                </div>

                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
                
            </form>
        </div>
    </div>
    <?php

}
else
if (@$_GET['action'] == "editProducts")
{
    $product_id=$_GET['product_id'];
    $url=$baseurl . 'showCountries';
    $data = "";
    $json_data=@curl_request($data,$url);
    
    //select category
    $url=$baseurl . 'showCategories';
    $data =array(
        "level"=>"0"    
    );
    
    $json_data_category=@curl_request($data,$url);
    $json_data_category=$json_data_category['msg'];
    
    //get product details
    $url=$baseurl . 'showAllProducts';
    $data =array(
        "id"=>$product_id  
    );
    
    $productDetails=@curl_request($data,$url);
    $productDetails=$productDetails['msg'];
    
    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Edit Product</h2>

        <div style="height:450px; overflow:scroll;">
            
            <form class="addcategory" action="process.php?action=editProduct" method="post" >
                <input type="hidden" name="id" value="<?php echo $productDetails['Product']['id']; ?>">
                <input type="hidden" value="<?php echo $productDetails['Product']['store_id']; ?>" name="store_id">
                <div class="full_width" id="logoPreview" style="margin-bottom: 20px;">
                    <div id="previewImage">
                        
                        <?php  foreach( $productDetails['ProductImage'] as $str => $val ): ?>
                
                            <div style="float:left; width:140px; height:140px; margin-right: 10px; background:url(<?php echo $imagebaseurl.$val['image'];?>);background-size: cover; border: solid 1px #dddada; border-radius: 4px;">
                                
                                
                                <div>
                                    <span class="fas fa-times" style="color: white; background: #F85453; padding: 5px 10px; font-size: 12px; border-radius: 2px;margin: 141px 0 0 0;width: 100%;text-align: center;"> 
                                        Remove
                                    </span>
                                </div>
                                
                            </div>
    
                        <?php endforeach; ?>
                        
                    </div>
                    
                    
                    <div style="float:left; width:80px;">
                        <label for="imageData" style="border:dashed 2px #e7e7e7;width: 80px;height: 80px;text-align: center;border-radius: 4px;">
                            <img src="frontend_public/assets-minified/images/productimg.png" id="logoPlaceholderimage" style="width: 35px;opacity: 0.7;margin-top: 20px;">
                            
                        </label>
                        <input name="imageData" class="" id="imageData" onchange="return previewImage(this)" style="width: 100%; margin-top: 20px; display:none;" type="file">
                    </div>
                    <div class="clear"></div>
                </div>
                
                
                
                <br>
                <div class="full_width">
                    <label class="field_title">Product Title</label>
                    <input name="title" type="text" value="<?php echo $productDetails['Product']['title']; ?>" required>
                </div>

                <div class="full_width">
                    <label class="field_title">Product Description</label>
                    <textarea name="description" type="text" required><?php echo $productDetails['Product']['description']; ?></textarea>
                </div>
                
                <div class="full_width">
                    <label class="field_title">Current Category</label>
                    <input type="text" value="<?php echo $productDetails['Category']['name']; ?>">
                    <input type="hidden" name="category_id" value="<?php echo $productDetails['Product']['category_id']; ?>">
                </div>
                
                <?php 
                    $countData=count($json_data_category);
                    if($countData=0)
                    {
                        ?>
                            <div class="full_width">
                                <label class="field_title">Select Category</label>
                                <select name="category_id" id="category_id" class="form-control" onchange="selectCategory(this.value,'1')" required="">
                                    <option value="">Select Category</option>
                                    <?php  foreach( $json_data_category as $str => $val ): ?>
                
                                        <option value="<?php echo $val['Category']['id']; ?>" ><?php echo $val['Category']['name']; ?></option>
                
                                    <?php endforeach; ?>
                               </select>
                            </div>
                            <span id="dataRecived_1"></span>
                        <?php
                    }
                    
                     
                ?>
                    
                <div class="full_width">
                    <label class="field_title">Price</label>
                    <input name="price" type="text" value="<?php echo $productDetails['Product']['price']; ?>" required>
                </div>
                
                <div class="full_width">
                    <label class="field_title">Sale Price</label>
                    <input name="sale_price" type="text" value="<?php echo $productDetails['Product']['sale_price']; ?>" required>
                </div>

                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
                
            </form>
        </div>
    </div>
    <?php

}
else
if(@$_GET['q'] == "selectCategory")
{
    $id=$_GET['id'];
    $level=$_GET['level'];
    $next_level=$level+1;
    
    $url=$baseurl . 'showCategories';

    $data = array(
                    "level" => $id
                );

    $json_data=@curl_request($data,$url);
    
    $json_data=$json_data['msg'];
    
    $countData=count($json_data);
    if($countData>0)
    {
        ?>
            <div class="full_width">
                <label class="field_title">Select Sub Category</label>
                <select name="category_id" id="category_id" class="form-control" onchange="selectCategory(this.value,'<?php echo $next_level;?>')" required="">
                    <option value="">Select Sub Category</option>
                    <?php  foreach( $json_data as $str => $val ): ?>
    
                        <option value="<?php echo $val['Category']['id']; ?>" ><?php echo $val['Category']['name']; ?></option>
    
                    <?php endforeach; ?>
               </select>
            </div>
            <span id="dataRecived_<?php echo $next_level;?>"></span>
        <?php
    }

}
else
if(@$_GET['q'] == "deleteCategory")
{
    $category_id=$_GET['category_id'];
    
    $url=$baseurl . 'deleteCategory';

    $data = array(
        "category_id" => $category_id
    );

    $json_data=@curl_request($data,$url);
    //print_r($json_data);
    $json_data=$json_data['code'];
    
    if($json_data=="200")
    {
        echo "200";
    }
    else
    {
        echo $json_data['msg'];
    }
    
    

}
else
if(@$_GET['q'] == "editCategory")
{
    $category_id=$_GET['category_id'];
    
    // get single category
    $url=$baseurl . 'showCategories';
    $data = array(
        "category_id" => $category_id
    );
    $json_data=@curl_request($data,$url);
    
    $json_data=$json_data['msg'];
    
    $checkImageExist=checkImageExist($imagebaseurl.$json_data['Category']['image']);
    if($checkImageExist=="200")
    {
        $checkImageExist=$imagebaseurl.$json_data['Category']['image'];
    }
    else
    {
        $checkImageExist="frontend_public/uploads/noimage.jpg";
    }
    
    ?>
        <input type="hidden" id="id" name="id" value="<?php echo $category_id;?>">
        <input type="hidden" id="level" name="level" value="<?php echo $json_data['Category']['level'];?>">
        <div class="qr-el" id="logoPreview" style="min-height: auto; float:left; box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.03);padding: 0px;margin: 0px !important;">
            <label for="uploadFile" class="hoviringdell uploadBox" id="uploadTrigger" style="height: 80px; background:url('<?php echo $checkImageExist; ?>') center top / contain no-repeat;"></label>
            <input name="upload_image" class="" id="uploadFile" type="file" onchange="return UploadCategoryImage(this)" style="width: 100%; margin-top: 10px;font-size: 10px; display:none;" required="required">
        </div>
        <input type="hidden" id="imageData">
       
        <input type="text" name="category_name" id="category_name" placeholder="Category Name" value="<?php echo $json_data['Category']['name']; ?>" style="width:100%; font-size:12px;background: transparent;border: 0px;border-bottom: solid 1px grey;padding: 6px 0;">
        <input type="button" value="Submit" onclick="editCategory()" style="width:100%;border: 0px;font-size: 12px;padding: 6px 0;border-radius: 4px;margin-top: 10px;">
    <?php

}
else
if(@$_GET['q'] == "submitEditCategory")
{
    $id=$_POST['id'];
    $category_name=$_POST['category_name'];
    $level=$_POST['level'];
    $image=$_POST['image'];
    $image = str_replace("data:image/jpeg;base64,","",$image);
    $image = str_replace("data:image/png;base64,","",$image);
    
   
    
    $url=$baseurl . 'addCategory';
    
    if($image=="")
    {
       $data = array(
            "id"=> $id,
            "name"=> $category_name,
            "store_id"=> "0",
            "description"=> "",
            "level"=>$level
        ); 
    }
    else
    {
        $data = array(
            "id"=> $id,
            "name"=> $category_name,
            "store_id"=> "0",
            "description"=> "",
            "image"=>array("file_data" => $image),
            "level"=>$level
        );
    }
    
    

    $json_data=@curl_request($data,$url);
    $json_data=$json_data['code'];
    
    if($json_data=="200")
    {
        echo "200";
    }
    else
    {
        echo $json_data['msg'];
    }
    
   

}


















































//////// new popups

else
if(@$_GET['q'] == "viewUserDetails")
{
    $user_id=$_GET['user_id'];
    
    // get user details
    $url=$baseurl . 'showUserDetail';
    $data = array(
        "user_id" => $user_id
    );
    $json_data=@curl_request($data,$url);
    
    $json_data=$json_data['msg'];
    
    
    
    ?>
        
        <div class="main-container dataTables_wrapper" id="table_view_wrapper" style="height: 500px;overflow: scroll;" >
            <?php
                if(checkImageExist($imagebaseurl.$json_data['User']['profile_pic'])=="200")
                {
                    $profilePicture=$imagebaseurl.$json_data['User']['profile_pic'];
                }
                else
                {
                    $profilePicture="frontend_public/assets-minified/images/noProfile.png";
                }
            ?>
            <div style="text-align: center;">
                <img src="<?php echo $profilePicture;?>" style="width: 90px;border-radius: 100%;height: 90px;border: solid 1px #fbf7f7;">
                <h3><?php echo $json_data['User']['first_name']." ".$json_data['User']['last_name'] ;?></h3>
                <p style="font-size: 14px;color: grey;">@<?php echo $json_data['User']['username'];?></p>
            </div>
            
            <div style="text-align:center; margin:20px 0;">
                <ul style="display: inline-flex;">
                    <li style="width: 100px;list-style: none; " >
                        <div><?php echo $json_data['User']['following_count'];?></div>
                        <p style="font-size: 12px;color: grey;">Following</span>
                    </li>
                    <li style="width: 100px;list-style: none;">
                        <div><?php echo $json_data['User']['followers_count'];?></div>
                        <p style="font-size: 12px;color: grey;">Followers</span>
                    </li>
                    <li style="width: 100px;list-style: none;">
                        <div><?php echo $json_data['User']['videos_count'];?></div>
                        <p style="font-size: 12px;color: grey;">Videos</span>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            
            <div style="text-align: center;">
                <p style="font-size: 14px;color: grey;"><?php echo $json_data['User']['bio'];?></p>
            </div>
            
            
            <div>
                
                <div style="margin:20px 0;">
                    <ul style="display: inline-flex; font-size: 13px;">
                        <li style="width: 100px;list-style: none; cursor:pointer; text-align: center;padding: 10px 0; border-bottom:2px solid #666;" id="tab_publicVideos" onclick="tabName('publicVideos')">
                            <div>
                                <span class="fas fa-bars" style="font-size: 14px;margin-right: 3px;"></span>
                                Public
                            </div>
                        </li>
                        <li style="width: 100px;list-style: none; cursor:pointer; text-align: center;padding: 10px 0;" id="tab_privateVideos" onclick="tabName('privateVideos')">
                            <div>
                                <span class="fas fa-lock" style="font-size: 14px;margin-right: 3px;"></span>
                                Private
                            </div>
                        </li>
                        <li style="width: 100px;list-style: none; cursor:pointer; text-align: center;padding: 10px 0;" id="tab_profileInfo" onclick="tabName('profileInfo')">
                            <div>
                                <span class="fas fa-user" style="font-size: 14px;margin-right: 3px;"></span>
                                Profile
                            </div>
                        </li>
                        <li style="width: 100px;list-style: none; cursor:pointer; text-align: center;padding: 10px 0;" id="tab_following" onclick="tabName('following')">
                            <div>
                                <span class="fas fa-user" style="font-size: 14px;margin-right: 3px;"></span>
                                Following
                            </div>
                        </li>
                        <li style="width: 100px;list-style: none; cursor:pointer; text-align: center;padding: 10px 0;" id="tab_followers" onclick="tabName('followers')">
                            <div>
                                <span class="fas fa-user" style="font-size: 14px;margin-right: 3px;"></span>
                                Followers
                            </div>
                        </li>
                        <li style="width: 100px;list-style: none; cursor:pointer; text-align: center;padding: 10px 0;" id="tab_likedVideos" onclick="tabName('likedVideos')">
                            <div>
                                <span class="fas fa-heart" style="font-size: 14px;margin-right: 3px;"></span>
                                Liked Video
                            </div>
                            
                        </li>
                    </ul>
                </div>
                
                <div id="publicVideos" class="tab">
                    <?php
                        if(is_array($json_data['User']['Videos']['public']) || is_object($json_data['User']['Videos']['public']))
                        {
                            foreach ($json_data['User']['Videos']['public'] as $singleRow)
                            {
                                ?>
                                    <a href="<?php echo checkVideoUrl($singleRow['Video']['video']);?>" target="_blank">
                                        <div style="width: 130px;height: 230px;margin:0 0 10px 13px;float: left;background:url('<?php echo checkVideoUrl($singleRow['Video']['gif']);?>') , #eaeaea;background-size: cover;">
                                            <span class="fas fa-eye" style="color: white;margin: 207px 0 0 8px; font-size: 14px;"></span> 
                                            <span style="color: white; font-size: 12px;"><?php echo $singleRow['Video']['view']; ?></span>
                                            
                                            <span class="fas fa-heart" style="color: white;margin: 207px 0 0 8px; font-size: 14px;"></span> 
                                            <span style="color: white; font-size: 12px;"><?php echo $singleRow['Video']['like_count']; ?></span>
                                            
                                            <span class="fas fa-comment" style="color: white;margin: 207px 0 0 8px; font-size: 14px;"></span> 
                                            <span style="color: white; font-size: 12px;"><?php echo $singleRow['Video']['comment_count']; ?></span>
                                            
                                        </div>
                                    </a>
                                <?php
                            }   
                        }
                        else
                        {
                            ?>
                                <div >No Data Available</div>
                            <?php
                        }
                        
                    ?>
                    <div class="clear"></div>
                </div>
                
                <div id="privateVideos" class="tab" style="display:none">
                    <?php
                        foreach ($json_data['User']['Videos']['private'] as $singleRow)
                        {
                            ?>
                                <a href="<?php echo checkVideoUrl($singleRow['Video']['video']);?>" target="_blank">
                                    <div style="width: 130px;height: 230px;margin:0 0 10px 13px;float: left;background:url('<?php echo checkVideoUrl($singleRow['Video']['gif']);?>') , #eaeaea;background-size: cover;">
                                        <span class="fas fa-eye" style="color: white;margin: 207px 0 0 8px; font-size: 14px;"></span> 
                                        <span style="color: white; font-size: 12px;"><?php echo $singleRow['Video']['view']; ?></span>
                                        
                                        <span class="fas fa-heart" style="color: white;margin: 207px 0 0 8px; font-size: 14px;"></span> 
                                        <span style="color: white; font-size: 12px;"><?php echo $singleRow['Video']['like_count']; ?></span>
                                        
                                        <span class="fas fa-comment" style="color: white;margin: 207px 0 0 8px; font-size: 14px;"></span> 
                                        <span style="color: white; font-size: 12px;"><?php echo $singleRow['Video']['comment_count']; ?></span>
                                        
                                    </div>
                                </a>
                            <?php
                        }
                    ?>
                    <div class="clear"></div>
                </div>
                
                
                <div id="profileInfo" class="tab" style="display:none">
                    <div style="border-bottom:solid 1px #e6e6e6; padding: 10px 0 10px 10px;">
                        <div style="float:left; width:150px;font-size: 14px;">Name</div>
                        <div style="float:left; width:150px;">
                            <?php echo $json_data['User']['first_name']." ".$json_data['User']['last_name']; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="border-bottom:solid 1px #e6e6e6; padding: 10px 0 10px 10px;">
                        <div style="float:left; width:150px;font-size: 14px;">Gender</div>
                        <div style="float:left; width:150px;">
                            <?php echo $json_data['User']['gender']; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="border-bottom:solid 1px #e6e6e6; padding: 10px 0 10px 10px;">
                        <div style="float:left; width:150px;font-size: 14px;">Bio</div>
                        <div style="float:left; width:150px;">
                            <?php echo $json_data['User']['bio']; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="border-bottom:solid 1px #e6e6e6; padding: 10px 0 10px 10px;">
                        <div style="float:left; width:150px;font-size: 14px;">Website</div>
                        <div style="float:left; width:150px;">
                            <?php echo $json_data['User']['website']; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="border-bottom:solid 1px #e6e6e6; padding: 10px 0 10px 10px;">
                        <div style="float:left; width:150px;font-size: 14px;">Date Of Birth</div>
                        <div style="float:left; width:150px;">
                            <?php echo $json_data['User']['dob']; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="border-bottom:solid 1px #e6e6e6; padding: 10px 0 10px 10px;">
                        <div style="float:left; width:150px;font-size: 14px;">Email</div>
                        <div style="float:left; width:150px;">
                            <?php echo $json_data['User']['email']; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="border-bottom:solid 1px #e6e6e6; padding: 10px 0 10px 10px;">
                        <div style="float:left; width:150px;font-size: 14px;">Phone</div>
                        <div style="float:left; width:150px;">
                            <?php echo $json_data['User']['phone']; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="border-bottom:solid 1px #e6e6e6; padding: 10px 0 10px 10px;">
                        <div style="float:left; width:150px;font-size: 14px;">Username</div>
                        <div style="float:left; width:150px;">
                            <?php echo "@".$json_data['User']['username']; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="border-bottom:solid 1px #e6e6e6; padding: 10px 0 10px 10px;">
                        <div style="float:left; width:150px;font-size: 14px;">App Version</div>
                        <div style="float:left; width:150px;">
                            <?php echo $json_data['User']['version']; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="border-bottom:solid 1px #e6e6e6; padding: 10px 0 10px 10px;">
                        <div style="float:left; width:150px;font-size: 14px;">Device</div>
                        <div style="float:left; width:150px;">
                            <?php echo $json_data['User']['device']; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div style="border-bottom:solid 1px #e6e6e6; padding: 10px 0 10px 10px;">
                        <div style="float:left; width:150px;font-size: 14px;">Push Notification</div>
                        <div style="float:left; width:150px;">
                            <?php
                                if($json_data['User']['device_token']!="")
                                {
                                    echo "Enable";
                                }
                                else
                                {
                                    echo "Not Enable";
                                }
                            ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                </div>
                
                <div id="following" class="tab" style="display:none">
                    <?php
                        foreach ($json_data['User']['Following'] as $singleRow)
                        {
                            if(checkImageExist($imagebaseurl.$singleRow['FollowingList']['profile_pic'])=="200")
                            {
                                $profilePicture=$imagebaseurl.$singleRow['FollowingList']['profile_pic'];
                            }
                            else
                            {
                                $profilePicture="frontend_public/assets-minified/images/noProfile.png";
                            }
                            ?>
                                <div style="width:120px; border:solid 1px #f2f2f2; text-align:center;padding: 10px 0;margin: 0 10px 0 0;border-radius: 4px;float: left;">
                                    <img src="<?php echo $profilePicture;?>" style="width: 40px;border-radius: 100%;height:40px;border: solid 1px #fbf7f7;">
                                    <h4><?php echo $singleRow['FollowingList']['first_name']." ".$singleRow['FollowingList']['last_name'];?></h4>
                                </div>
                            <?php
                        }
                    ?>
                    <div class="clear"></div>
                </div>
                
                <div id="followers" class="tab" style="display:none">
                    <?php
                        foreach ($json_data['User']['Followers'] as $singleRow)
                        {
                            if(checkImageExist($imagebaseurl.$singleRow['FollowerList']['profile_pic'])=="200")
                            {
                                $profilePicture=$imagebaseurl.$singleRow['FollowerList']['profile_pic'];
                            }
                            else
                            {
                                $profilePicture="frontend_public/assets-minified/images/noProfile.png";
                            }
                            
                            ?>
                                <div style="width:120px; border:solid 1px #f2f2f2; text-align:center;padding: 10px 0;margin: 0 10px 0 0;border-radius: 4px;float: left;">
                                    <img src="<?php echo $profilePicture;?>" style="width: 60px;border-radius: 100%;height: 60px;border: solid 1px #fbf7f7;">
                                    <h4><?php echo $singleRow['FollowerList']['first_name']." ".$singleRow['FollowerList']['last_name'];?></h4>
                                </div>
                            <?php
                        }
                    ?>
                    <div class="clear"></div>
                </div>
                
                <div id="likedVideos" class="tab" style="display:none">
                    <?php
                        if(is_array($json_data['VideoLike']) || is_object($json_data['VideoLike']))
                        {
                            foreach ($json_data['VideoLike'] as $singleRow)
                            {
                                ?>
                                    <a href="<?php echo checkVideoUrl($singleRow['Video']['video']);?>" target="_blank">
                                        <div style="width: 130px;height: 230px;margin:0 0 10px 13px;float: left;background:url('<?php echo checkVideoUrl($singleRow['Video']['gif']);?>') , #eaeaea;background-size: cover;">
                                            <span class="fas fa-eye" style="color: white;margin: 207px 0 0 8px; font-size: 14px;"></span> 
                                            <span style="color: white; font-size: 12px;"><?php echo @$singleRow['Video']['view']; ?></span>
                                            
                                            <span class="fas fa-heart" style="color: white;margin: 207px 0 0 8px; font-size: 14px;"></span> 
                                            <span style="color: white; font-size: 12px;"><?php echo @$singleRow['Video']['like_count']; ?></span>
                                            
                                            <span class="fas fa-comment" style="color: white;margin: 207px 0 0 8px; font-size: 14px;"></span> 
                                            <span style="color: white; font-size: 12px;"><?php echo @$singleRow['Video']['comment_count']; ?></span>
                                        </div>
                                    </a>
                                <?php
                            }   
                        }
                        else
                        {
                            ?>
                                <div >No Data Available</div>
                            <?php
                        }
                        
                    ?>
                    <div class="clear"></div>
                </div>
                
            </div>
            
        </div>
        
    <?php

}
else
if(@$_GET['q'] == "viewVideoDetails")
{
    $video_id=$_GET['video_id'];
    
    // get video details
    $url=$baseurl . 'showVideoDetail';
    $data = array(
        "video_id" => $video_id
    );
    $json_data=@curl_request($data,$url);
    
    $json_data=$json_data['msg'];
    
    
    ?>
        
        <div class="main-container dataTables_wrapper" id="table_view_wrapper" style="height: 520px;overflow: scroll;">
            
            
            <div id="single_video0" data-ufb_id="116570119853344629667" data-uvideo_id="15" style="width:270px; float:left;overflow: hidden;border-radius: 5px;">
			    <video poster="<?php echo checkVideoUrl($json_data['Video']['thum']); ?>" id="bgvid" playsinline="" autoplay="true" loop="" class="sb_svideo_player sb_svideo_play" width="270px" controls>
			        <source src="<?php echo checkVideoUrl($json_data['Video']['video']); ?>" type="video/webm">
			        <source src="<?php echo checkVideoUrl($json_data['Video']['video']); ?>" type="video/mp4">
			    </video>
			    <div>
			        <form action="process.php?action=editVideoViews" method="post" enctype="multipart/form-data">
    			        <input type="hidden" name="video_id" value="<?php echo $json_data['Video']['id']; ?>">
    			        <input type="number" name="view" value="<?php echo $json_data['Video']['view']; ?>" style="width: 120px;border: solid 1px #d9d4d4;font-size: 14px;padding:2px 8px; border-radius: 3px;">
    			        <input type="submit" value="Modify Views" style="border: solid 0px;font-size: 12px;color: white;background: #dd3636;padding: 5px 10px; border-radius: 3px;">
			        </form>
			    </div>
			</div>
			
			<div style="width:340px; float:left; padding:0 0 0 10px;">
			    
			    <div>
			        <div style="width:45px; float:left; height:45px; background:url('<?php echo checkVideoUrl($json_data['User']['profile_pic']); ?>');background-size: cover;border-radius: 100%;"></div>
			        <div style="width:150px; float:left;margin: 5px 0 0 14px;">
			            <?php echo $json_data['User']['username']; ?>
			            <p style="font-size:12px; color:grey;"><?php echo $json_data['User']['first_name']." ".$json_data['User']['last_name']; ?></p>
			        </div>
			        <div class="clear"></div>
			        <br>
			        <p style="font-size:14px; color:grey;"><?php echo $json_data['Video']['description']; ?></p>
			        <p style="font-size:14px; color:grey;">
			            <span class="fas fa-music"></span>
			            <?php echo substr($json_data['Sound']['name'],0,40); ?>...
			        </p>
			        
			        <div style="border-top:solid 1px #e3e0e0; border-bottom:solid 1px #e3e0e0; margin:20px 0; padding:8px 0;">
    			        <span class="fas fa-eye" style="margin: 0 0 0 12px; font-size: 14px;"></span> 
                        <span style="font-size: 14px;"><?php echo $json_data['Video']['view']; ?></span>
                        
                        <span class="fas fa-heart" style="margin: 0 0 0 12px; font-size: 14px;"></span> 
                        <span style="font-size: 14px;"><?php echo $json_data['Video']['like_count']; ?></span>
                        
                        <span class="fas fa-comment" style="margin: 0 0 0 12px; color:#666; font-size: 14px;"></span> 
                        <span style="font-size: 14px;"><?php echo $json_data['Video']['comment_count']; ?></span>
    			    </div>
    			    
    			    <div style="margin:20px 0; padding:8px 0;height: 300px;overflow:scroll;">
    			        <?php
                            if(count($json_data['VideoComment'])=="0")
                            {
                                ?>
                                    <div align="center" style="margin:10px 0 0 0;">
                                        <span class="fas fa-comment" style="margin: 0 0 0 12px; color:grey; font-size: 60px;"></span>
                                        <h3>No Comments Available</h3>
                                    </div>
                                <?php
                            }
                            else
                            {
                                foreach ($json_data['VideoComment'] as $singleRow)
                                {
                                    ?>
                                        <div style="padding: 5px 0;border-bottom: solid 1px #ececec;" class="<?php echo $singleRow['id']; ?>_commentRow">
                    			            <div style="width:45px; float:left; height:45px; background:url('<?php echo checkVideoUrl($json_data['User']['profile_pic']); ?>');background-size: cover;border-radius: 100%;"></div>
                        			        <div style="font-size: 12px;float: right; margin-top: 10px; width:100px;">
                        			            
                        			            <p style="font-size: 12px;color:grey; cursor: pointer;" id="deleteComment" data-commentid="<?php echo $singleRow['id']; ?>">
                        			                <span class="fas fa-trash"></span> Delete
                        			            </p>
                        			        </div>
                        			        
                        			        <div style="width:150px; float:left;margin: 5px 0 0 14px;">
                        			            <?php echo $json_data['User']['first_name']." ".$json_data['User']['last_name']; ?>
                        			            <p style="font-size:12px; color:grey;padding: 6px 0;"><?php echo $singleRow['comment']; ?></p>
                        			            <p style="font-size: 11px;font-style: italic; color:grey;"><?php echo time_elapsed_string($singleRow['created']); ?></p>
                        			        </div>
                        			        <div class="clear"></div>
                    			        </div>
                                    <?php
                                }
                            }
                        ?>
    			        
    			    </div>
			     
			        
			    </div>
			    
			</div>
			<div class="clear"></div>
			
        </div>
        
    <?php

}
else
if(@$_GET['q'] == "addSound")
{
    ?>
        <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
            <h2 style="font-weight: 300;" align="center">Add Sound</h2>
    
            <div style="height:360px; overflow:scroll;">
                
                <form action="process.php?action=addSound" method="post" enctype="multipart/form-data">
                    
                    <div class="full_width">
                        <label class="field_title">Name</label>
                        <input name="name" type="text" required="">
                    </div>
    
                    <div class="full_width">
                        <label class="field_title">Description</label>
                        <textarea name="description" type="text" required></textarea>
                    </div>
    
                    <div class="full_width">
                        <label class="field_title">Sound File(.mp3)</label>
                        <input name="audio" type="file" required="" accept=".mp3" style="padding: 12px 0 0 0;">
                    </div>
                    
                    <div class="full_width">
                        <label class="field_title">Thum Image File(.jpg,.png,.jpeg)</label>
                        <input name="thum" type="file" required="" accept=".jpg,.png,.jpeg"  style="padding: 12px 0 0 0;">
                    </div>
    
                    <div class="full_width">
                        <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                           Submit
                        </button>
                    </div>
                </form>
            
            </div>
        </div>
    <?php

}
else
if(@$_GET['q'] == "addSticker")
{
    ?>
        <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
            <h2 style="font-weight: 300;" align="center">Add Sticker</h2>
    
            <div style="height:200px; overflow:scroll;">
                
                <form action="process.php?action=addSticker" method="post" enctype="multipart/form-data">
                    
                    <div class="full_width">
                        <label class="field_title">Name</label>
                        <input name="name" type="text" required="">
                    </div>
    
                    <div class="full_width">
                        <label class="field_title">Image</label>
                        <input name="image" type="file" required="" accept=".jpg,.png,.jpeg,.gif" style="padding: 12px 0 0 0;">
                    </div>
                   
                    <div class="full_width">
                        <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                           Submit
                        </button>
                    </div>
                </form>
            
            </div>
        </div>
    <?php

}
else
if(@$_GET['q'] == "hashTagVideos")
{
    $id=$_GET['id'];
    
    // get video details
    $url=$baseurl . 'showVideosAgainstHashtag';
    $data = array(
        "hashtag_id" => $id
    );
    $json_data=@curl_request($data,$url);
    
    $json_data=$json_data['msg'];
    
    ?>
    
        <div class="main-container dataTables_wrapper" id="table_view_wrapper" style="height: 500px;overflow: scroll;" >
                
            <h2 style="font-weight: 300;" align="center">
                <?php echo ucwords($json_data[0]['Hashtag']['name']);?> Videos
            </h2>
            
            <div id="publicVideos" class="tab">
                <?php
                    foreach ($json_data as $singleRow)
                    {
                        ?>
                            <a href="<?php echo checkVideoUrl($singleRow['Video']['video']);?>" target="_blank">
                                <div style="width: 130px;height: 230px;margin:0 0 10px 13px;float: left;background:url('<?php echo checkVideoUrl($singleRow['Video']['gif']);?>') , #eaeaea;background-size: cover;">
                                    <span class="fas fa-eye" style="color: white;margin: 207px 0 0 8px; font-size: 14px;"></span> 
                                    <span style="color: white; font-size: 12px;"><?php echo $singleRow['Video']['view']; ?></span>
                                    
                                    <span class="fas fa-heart" style="color: white;margin: 207px 0 0 8px; font-size: 14px;"></span> 
                                    <span style="color: white; font-size: 12px;"><?php echo $singleRow['Video']['like_count']; ?></span>
                                    
                                    <span class="fas fa-comment" style="color: white;margin: 207px 0 0 8px; font-size: 14px;"></span> 
                                    <span style="color: white; font-size: 12px;"><?php echo $singleRow['Video']['comment_count']; ?></span>
                                    
                                </div>
                            </a>
                        <?php
                    }
                ?>
                <div class="clear"></div>
            </div>
                
        </div>    
    
    <?php

}
else
if(@$_GET['q'] == "userInbox")
{
    $user_id=$_GET['user_id'];
    
    // get video details
    $url=FIREBASE_DB_URL . 'Inbox/'.$user_id.'/.json';
    $request="GET";
    $data = array();
    $json_data=@curl_request_firebase($data,$request,$url);
    
    if(is_array($json_data) || is_object($json_data))
    {
        //make a array of users
            $allUsers = array();
            foreach ($json_data as $singleRow)
            {
                $allUsers[] = array(
                    'user_id' => $singleRow['rid']
                );
            }
        //make a array of users
    
        $url=$baseurl.'showUsersInfo';
        $data = array(
                    "users"=>$allUsers
                );
        $Userinbox=@curl_request($data,$url);
    
        ?>
            <div class="main-container dataTables_wrapper" id="table_view_wrapper" style="height: 500px;overflow: scroll;" >
                
                <div style="width:180px; float:left;height: 100%;overflow: scroll;">
                    <!--<h3 style="font-weight: 300;" align="center">Inbox</h3>-->
                    <?php
                        foreach ($Userinbox['msg'] as $singleRow)
                        {
                            $checkImageExist=checkImageExist(imagebaseurl.$singleRow['User']['profile_pic']);
                            if($checkImageExist=="200")
                            {
                                $checkImageExist=imagebaseurl.$singleRow['User']['profile_pic'];
                            }
                            else
                            {
                                $checkImageExist="frontend_public/uploads/noimage.jpg";
                            }
                            ?>
                                <div class="inboxRow" data-rid="<?php echo $singleRow['User']['id']; ?>" data-userid="<?php echo $user_id; ?>" style="border-bottom: solid 1px #f2f2f2;cursor: pointer; padding: 10px 5px 10px 5px;">
                                    <div style="float:left; width:50px;">
                                        <div style="background:url('<?php echo $checkImageExist; ?>'); height: 40px;width:40px;background-size: cover;border-radius: 100%;"></div>
                                    </div>
                                    <div style="float:right; width:120px;">
                                        <h4><?php echo ucwords($singleRow['User']['first_name']." ".$singleRow['User']['last_name']); ?></h4>
                                        <!--<span style="font-size:12px; color:grey;font-style: italic;"><?php //echo $singleRow['msg']; ?></span>-->
                                    </div>
                                    <div class="clear"></div>    
                                </div>
                            <?php
                        }
                    ?>
                </div>
                <div style="width:420px; float:left;">
                    
                    <div class="messages" id="messages" style="height:500px;overflow: scroll;border: solid 1px #edeaea;">
        				<ul id="msgview"></ul>
        			</div>
                    
                </div>
                <div class="clear"></div>
                        
            </div>    
        <?php
    
    }
    else
    {
        ?>
           <div align="center">Empty Inbox</div>
        <?php
    }
}
else
if(@$_GET['q'] == "userChat")
{
    $user_id=$_GET['user_id'];
    $rid=$_GET['rid'];
    $chatNod=$user_id."-".$rid;
    
    // get video details
    $url=FIREBASE_DB_URL . 'chat/'.$chatNod.'/.json';
    $request="GET";
    $data = array();
    $json_data=@curl_request_firebase($data,$request,$url);
    
    if(is_array($json_data) || is_object($json_data))
    {
        foreach ($json_data as $singleRow)
        {
            if($user_id==$singleRow['sender_id'])
            {
                $msgStatus="replies";
            }
            else
            {
                $msgStatus="sent";
            }
            ?>
                <li class="<?php echo $msgStatus; ?>"><p><?php echo $singleRow['text']; ?></p></li>
    		<?php
        } 
    }
    else
    {
        ?>
            <div align="center">No Any Message</div>
        <?php
    }
    

}
else
if(@$_GET['q'] == "addReportReason")
{
    
    ?>
    
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Add Report Reasons</h2>

        <div style="height:120px; overflow:scroll;">
            <form action="process.php?action=addReportReason" method="post" >
                <div class="full_width">
                    <label class="field_title">Report Reason</label>
                    <input name="name" type="text" required>
                </div>

                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php

}
else
if(@$_GET['q'] == "editReportReasons")
{
    
    $id=$_GET['id'];

    $url=$baseurl . 'showReportReasons';

    $data = array(
        "id" => $id
    );

    $json_data=@curl_request($data,$url);
    
    ?>
    
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Edit Report Reasons</h2>

        <div style="height:120px; overflow:scroll;">
            <form action="process.php?action=editReportReason" method="post" >
                <input name="id" type="hidden" value="<?php echo $json_data['msg']['ReportReason']['id']; ?>" required>
                <div class="full_width">
                    <label class="field_title" >Report Reason</label>
                    <input name="name" type="text" value="<?php echo $json_data['msg']['ReportReason']['title']; ?>" required>
                </div>

                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php

}
else
if(@$_GET['q'] == "assignSection")
{
    
    $id=$_GET['id'];

    $url=$baseurl . 'showSoundSections';
    $data =array();
    
    $json_data=@curl_request($data,$url);
    
    ?>
    
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Assign Section</h2>

        <div style="height:120px; overflow:scroll;">
            <form action="process.php?action=assignSoundSection" method="post" >
                <input name="sound_id" type="hidden" value="<?php echo $id; ?>" required>
                
                <div class="full_width">
                    <label class="field_title">Assign Section</label>
                    <select name="sound_section_id" class="form-control" required="">
                        <option value="">Select Section</option>
                        <?php  foreach( $json_data['msg'] as $singleRow ): ?>
    
                            <option value="<?php echo $singleRow['SoundSection']['id']; ?>" ><?php echo $singleRow['SoundSection']['name']; ?></option>
    
                        <?php endforeach; ?>
                   </select>
                </div>

                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php

}
else
if(@$_GET['q'] == "addGifts")
{
    ?>
    
        <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
            <h2 style="font-weight: 300;" align="center">Add Gifts</h2>
    
            <div style="height:250px; overflow:scroll;">
                
                <form action="process.php?action=addGifts" method="post" enctype="multipart/form-data">
                    
                    <div class="full_width">
                        <label class="field_title">Name</label>
                        <input name="title" type="text" required="">
                    </div>
    
                    <div class="full_width">
                        <label class="field_title">Coin</label>
                        <input name="coin" type="number" required="">
                    </div>
                    
                    <div class="full_width">
                        <label class="field_title">Gift Image File(Size Should be 512x512) </label>
                        <input name="giftImage" id='giftImage' type="file" required="" accept=".jpg,.png,.jpeg" style="padding: 12px 0 0 0;">
                    </div>
    
                    <div class="full_width">
                        <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                           Submit
                        </button>
                    </div>
                </form>
            
            </div>
        </div>
        
        
        
    <?php

}
else
if(@$_GET['q'] == "editGift")
{
    
    $id=$_GET['id'];

    $url=$baseurl . 'showGifts';
    $data =array(
        "id"=> $id
    );
    
    $json_data=@curl_request($data,$url);
    
    ?>
    
        <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
            <h2 style="font-weight: 300;" align="center">Edit Gifts</h2>
    
            <div style="height:250px; overflow:scroll;">
                
                <form action="process.php?action=editGift" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $json_data['msg']['Gift']['id']; ?>">
                    <div class="full_width">
                        <label class="field_title">Name</label>
                        <input name="title" type="text" value="<?php echo $json_data['msg']['Gift']['title']; ?>" required="">
                    </div>
    
                    <div class="full_width">
                        <label class="field_title">Coin</label>
                        <input name="coin" type="number" value="<?php echo $json_data['msg']['Gift']['coin']; ?>" required="">
                    </div>
                    
                    <div class="full_width">
                        <label class="field_title">Gift Image File(Size Should be 512x512) </label>
                        <input name="giftImage" id='giftImage' type="file" accept=".jpg,.png,.jpeg" style="padding: 12px 0 0 0;">
                    </div>
    
                    <div class="full_width">
                        <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                           Submit
                        </button>
                    </div>
                </form>
            
            </div>
        </div>
        
        
        
    <?php

}
else
if(@$_GET['q'] == "editCoinWorth")
{
    ?>
    
        <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
            <h2 style="font-weight: 300;" align="center">Modify Coin Value</h2>
    
            <div style="overflow:scroll;">
                
                <form action="process.php?action=editCoinWorth" method="post" enctype="multipart/form-data">
                    
                    <div class="full_width">
                        <label class="field_title">Coin Price (Amount in USD)</label>
                        <input name="coinPrice" type="number" step="any" required="">
                    </div>
    
                    <div class="full_width">
                        <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                           Submit
                        </button>
                    </div>
                </form>
            
            </div>
        </div>
        
        
        
    <?php

}
else
if(@$_GET['q'] == "pushNotification")
{
    
    $id=$_GET['id'];

    ?>
    
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Send Push Notification</h2>

        <div style="overflow:scroll;">
            <form action="process.php?action=sendVideoPushNotificationToAllUsers" method="post" >
                <input name="id" type="hidden" value="<?php echo $id; ?>" required>
                
                <div class="full_width">
                    <label class="field_title" >Title</label>
                    <input name="title" type="text" placeholder="Robot's dance"  maxlength="40" required>
                </div>
                
                <div class="full_width clear_both">
                    <label class="field_title">Description</label>
                    <textarea name="text" type="text" placeholder="Robots now can dance. Check out this video" required maxlength="65"></textarea>
                </div>

                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
                <br>
                <p style="font-size: 12px;">Note:This will send push notification to all of the users present in your app about this particular video</p>
            </form>
        </div>
    </div>
    <?php

}
else
if(@$_GET['q'] == "pushNotificationToUser")
{
    
    $id=$_GET['id'];

    ?>
    
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
        <h2 style="font-weight: 300;" align="center">Send Push Notification</h2>

        <div style="overflow:scroll;">
            <form action="process.php?action=sendUserAccountNotificationToAllUsers" method="post" >
                <input name="id" type="hidden" value="<?php echo $id; ?>" required>
                
                <div class="full_width">
                    <label class="field_title" >Title</label>
                    <input name="title" type="text" placeholder="Welcome Qboxus"  maxlength="40" required>
                </div>
                
                <div class="full_width clear_both">
                    <label class="field_title">Description</label>
                    <textarea name="text" type="text" placeholder="Qboxus is on spectraz. check their profile for latest updates" required maxlength="65"></textarea>
                </div>

                <div class="full_width">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                       Submit
                    </button>
                </div>
                <br>
                <p style="font-size: 12px;">Note:This will send push notification to all of the users present in your app about this particular account</p>
            </form>
        </div>
    </div>
    <?php

}
if(@$_GET['q'] == "editSoundSection")
{
    
    $id=$_GET['id'];

    $url=$baseurl . 'showSoundSections';
    $data =array(
        "id"=> $id
    );
    
    $json_data=@curl_request($data,$url);
    
    
    ?>
    
        <div class="main-container dataTables_wrapper" id="table_view_wrapper" >
            <h2 style="font-weight: 300;" align="center">Edit Section</h2>
    
            <div style="height:130px; overflow:scroll;">
                <form action="process.php?action=updateSection" method="post" >
                    <input type="hidden" name="id" value="<?php echo $json_data['msg']['SoundSection']['id']; ?>">
                    <div class="full_width">
                        <label class="field_title">Section Name</label>
                        <input name="name" type="text" value="<?php echo $json_data['msg']['SoundSection']['name']; ?>" required>
                    </div>
                    <div class="full_width">
                        <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                           Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    <?php

}
else
if(@$_GET['q'] == "showVideos")
{
        $currentPage = htmlspecialchars($_GET['page'], ENT_QUOTES);
        $url = $baseurl . 'showVideos';
        
        $data =array(
            "starting_point" => $currentPage
        );
        
        $json_data = @curl_request($data, $url);

        if($json_data['code']==201)
        {
            echo 201;
        }

        if(is_array($json_data) || is_object($json_data)) 
        {
            
            foreach ($json_data['msg'] as $singleRow): 
                                                    
                ?>
                    <tr>
                        <td><?php echo $singleRow['Video']['id']; ?></td>
                        <td>
                                <?php 
                                    if($singleRow['Video']['description']=="")
                                    {
                                        echo "-";
                                    }
                                    else
                                    {
                                        echo substr($singleRow['Video']['description'],0,15);
                                    }
                                ?>
                        </td>
                        <td>
                            <a href="<?php echo checkVideoUrl($singleRow['Video']['video']); ?>" target="_blank">
                                <span class="fas fa-play-circle" style="color:black;"></span>
                            </a>
                        </td>
                        <td>
                            <?php echo $singleRow['Video']['view']; ?>
                        </td>
                        <td>
                            <?php echo $singleRow['Video']['comment_count']; ?>
                        </td>
                        <td>
                            <?php echo $singleRow['Video']['like_count']; ?>
                        </td>
                        <td>
                            <?php
                                if($singleRow['Video']['block']=="1")
                                {
                                    echo"Blocked";
                                }
                                else
                                {
                                    echo "Active";
                                }
                            ?>
                        </td>
                        <td>
                           <?php
                                if($singleRow['Video']['promote']=="1")
                                {
                                    ?>
                                        <span class="fas fa-check" style="color:green;"></span>
                                    <?php
                                }
                                else
                                {
                                    echo "-";
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
                                        <li class="more-menu-item" role="presentation" onclick="pushNotification('<?php echo $singleRow['Video']['id']; ?>')">
                                            <button type="button" class="more-menu-btn" role="menuitem">Push Notification</button>
                                        </li>
                                        
                                        <li class="more-menu-item" role="presentation" onclick="viewVideoDetails('<?php echo $singleRow['Video']['id']; ?>')">
                                            <button type="button" class="more-menu-btn" role="menuitem">View Details</button>
                                        </li>
                                        
                                        <li class="more-menu-item" role="presentation">
                                            <a href="process.php?action=deleteVideo&video_id=<?php echo $singleRow['Video']['id']; ?>">
                                                <button type="button" class="more-menu-btn" role="menuitem">Delete</button>
                                            </a>
                                        </li>
                                        
                                        <?php
                                            if($singleRow['Video']['promote']=="0")
                                            {
                                                ?>
                                                    <li class="more-menu-item" role="presentation">
                                                        <a href="process.php?action=promoteVideo&video_id=<?php echo $singleRow['Video']['id']; ?>&promote=1">
                                                            <button type="button" class="more-menu-btn" role="menuitem">Promote</button>
                                                        </a>
                                                    </li>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                    <li class="more-menu-item" role="presentation">
                                                        <a href="process.php?action=promoteVideo&video_id=<?php echo $singleRow['Video']['id']; ?>&promote=0">
                                                            <button type="button" class="more-menu-btn" role="menuitem">UnPromote</button>
                                                        </a>
                                                    </li>
                                                <?php
                                            }
                                        ?>
                                        
                                        
                                        <?php
                                            if($singleRow['Video']['block']=="0")
                                            {
                                                ?>
                                                    <li class="more-menu-item" role="presentation">
                                                        <a href="process.php?action=blockVideo&video_id=<?php echo $singleRow['Video']['id']; ?>&status=1">
                                                            <button type="button" class="more-menu-btn" role="menuitem">Block Video</button>
                                                        </a>
                                                    </li>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                    <li class="more-menu-item" role="presentation">
                                                        <a href="process.php?action=blockVideo&video_id=<?php echo $singleRow['Video']['id']; ?>&status=0">
                                                            <button type="button" class="more-menu-btn" role="menuitem">Unblock Video</button>
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
   
}
else
if(@$_GET['q'] == "showUsers")
{
        $currentPage = htmlspecialchars($_GET['page'], ENT_QUOTES);
        $url = $baseurl . 'showUsers';
        
        $data =array(
            "starting_point" => $currentPage
        );
        
        $json_data = @curl_request($data, $url);

        if($json_data['code']==201)
        {
            echo 201;
        }

        if(is_array($json_data) || is_object($json_data)) 
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
   
}
else
if (@$_GET['q'] == "changePromotionsStatus")
{
    
    $id=$_GET['id'];

    ?>
    <div class="main-container dataTables_wrapper" id="table_view_wrapper" style="height: 200px; overflow: scroll;" >
        <h2 style="font-weight: 300;" align="center">Edit Status</h2>

        <form class="addcategory" action="process.php?action=changePromotionsStatus" method="post" >
            <input name="id" type="hidden" value="<?php echo $id; ?>" required>
            
            <div class="full_width">
                <label class="field_title">Active/Disable</label>
                <select name="status" class="full_width" required>
                    <option value="">Select Status</option>
                    <option value="1">Active</option>
                    <option value="2">Reject</option>
                </select>
            </div>
                
            <div class="full_width">
                <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                   Submit
                </button>
            </div>


        </form>

    </div>
    <?php

}























?>