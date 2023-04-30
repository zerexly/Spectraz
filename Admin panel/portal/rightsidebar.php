<div class="qr-sidebar">
    <div class="qr-sidebar-title-area">
        <div class="logo-area">
            <div class="qr-logo">
                <a href="#"> <img src="frontend_public/uploads/attachment/logo.png" alt=""> </a>
            </div>
        </div>
        <div class="burger-icon"> ☰</div>
    </div>

  
        <div class="not-mobile">
            <ul>
                
                <li>
                    <a href="dashboard.php?p=users" class="<?php if (strpos($_SERVER['REQUEST_URI'], "users") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fa fa-users"></i> Users
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=videos" class="<?php if (strpos($_SERVER['REQUEST_URI'], "videos") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fab fa-youtube"></i> Videos
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=stickers" class="<?php if (strpos($_SERVER['REQUEST_URI'], "stickers") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-image"></i> All Stickers
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=sounds" class="<?php if (strpos($_SERVER['REQUEST_URI'], "sounds") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-music"></i> All Sound
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=unpublishSound" class="<?php if (strpos($_SERVER['REQUEST_URI'], "unpublishSound") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-music"></i> Unpublish Sound
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=soundSection" class="<?php if (strpos($_SERVER['REQUEST_URI'], "soundSection") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-th-list"></i> Sound Section
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=verificationRequest" class="<?php if (strpos($_SERVER['REQUEST_URI'], "verificationRequest") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-user-check"></i> Verification Request
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=appSliders" class="<?php if (strpos($_SERVER['REQUEST_URI'], "appSliders") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-image"></i> App Sliders
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=hashTag" class="<?php if (strpos($_SERVER['REQUEST_URI'], "hashTag") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-hashtag"></i> Hashtag
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=promotion" class="<?php if (strpos($_SERVER['REQUEST_URI'], "promotion") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-hashtag"></i> Promotion
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=reportReasons" class="<?php if (strpos($_SERVER['REQUEST_URI'], "reportReasons") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-ban"></i> Report Reasons
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=reportedVideo" class="<?php if (strpos($_SERVER['REQUEST_URI'], "reportedVideo") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-ban"></i> Reported Videos
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=reportedUsers" class="<?php if (strpos($_SERVER['REQUEST_URI'], "reportedUsers") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-ban"></i> Reported Users
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=pushNotification" class="<?php if (strpos($_SERVER['REQUEST_URI'], "pushNotification") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-bullhorn"></i> Push Notification
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=privacyPolicy" class="<?php if (strpos($_SERVER['REQUEST_URI'], "privacyPolicy") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="far fa-file"></i> Privacy Policy
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=termsConditions" class="<?php if (strpos($_SERVER['REQUEST_URI'], "termsConditions") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="far fa-file-alt"></i> Terms and Conditions
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=gifts" class="<?php if (strpos($_SERVER['REQUEST_URI'], "gifts") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-gift"></i>
                        Gifts
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=giftsSetting" class="<?php if (strpos($_SERVER['REQUEST_URI'], "giftsSetting") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-gift"></i>
                        Gift Setting
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=withdrawRequest" class="<?php if (strpos($_SERVER['REQUEST_URI'], "withdrawRequest") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-hand-holding-usd"></i>
                        Withdraw Request
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=adminUsers" class="<?php if (strpos($_SERVER['REQUEST_URI'], "adminUsers") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fas fa-user-shield"></i>
                        Admin Users
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=changePassword" class="<?php if (strpos($_SERVER['REQUEST_URI'], "changePassword") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="fa fa-unlock-alt"></i>
                        Change Password
                    </a>
                </li>
                
                <li>
                    <a href="dashboard.php?p=logout" class="<?php if (strpos($_SERVER['REQUEST_URI'], "logout") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="right-align fa fa-sign-out-alt"></i> Logout
                    </a>
                </li>
                
            </ul>
            <div class='clear'></div>
        </div>
        <div class="mobile-only"></div>
        
</div>