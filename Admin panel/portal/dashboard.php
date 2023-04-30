<?php 
include("header.php"); 
if(isset($_SESSION[PRE_FIX.'id']))
{
?>
<div class="mainwrapper allusers">
    <div class="qr-layout">
	
	<?php require_once("rightsidebar.php"); ?> 
	
	
		<?php 
		
		if(isset($_GET['p']))
		{ 
		    if( $_GET['p'] == "users" ) 
           	{ 
    			include("users.php");
    		}
    		
    		if( $_GET['p'] == "videos" ) 
           	{ 
    			include("videos.php");
    		}
    		
    		if( $_GET['p'] == "promotion" ) 
           	{ 
    			include("promotion.php");
    		}
    		
    		if( $_GET['p'] == "stickers" ) 
           	{ 
    			include("stickers.php");
    		}
    		
    		if( $_GET['p'] == "sounds" ) 
           	{ 
    			include("sounds.php");
    		}
    		
    		if( $_GET['p'] == "unpublishSound" ) 
           	{ 
    			include("unpublish.php");
    		}
    		
    		if( $_GET['p'] == "soundSection" ) 
           	{ 
    			include("soundSection.php");
    		}
    		
    		if( $_GET['p'] == "verificationRequest" ) 
           	{ 
    			include("verificationRequest.php");
    		}
    		
    		if( $_GET['p'] == "appSliders" ) 
           	{ 
    			include("appSliders.php");
    		}
    		
    		if( $_GET['p'] == "changePassword" ) 
           	{ 
    			include("changePassword.php");
    		}
    		
    		if( $_GET['p'] == "reportReasons" ) 
           	{ 
    			include("reportReasons.php");
    		}
    		
    		if( $_GET['p'] == "reportedUsers" ) 
           	{ 
    			include("reportedUsers.php");
    		}
    		
    		if( $_GET['p'] == "reportedVideo" ) 
           	{ 
    			include("reportedVideo.php");
    		}
    		
    		if( $_GET['p'] == "hashTag" ) 
           	{ 
    			include("hashTag.php");
    		}
    		
    		if( $_GET['p'] == "pushNotification" ) 
           	{ 
    			include("pushNotification.php");
    		}
    		
    		if( $_GET['p'] == "privacyPolicy" ) 
           	{ 
    			include("privacyPolicy.php");
    		}
    		
    		if( $_GET['p'] == "termsConditions" ) 
           	{ 
    			include("termsConditions.php");
    		}
    		
    		if( $_GET['p'] == "gifts" ) 
           	{ 
    			include("gifts.php");
    		}
    		
    		if( $_GET['p'] == "adminUsers" ) 
           	{ 
    			include("adminUsers.php");
    		}
    		
    		if( $_GET['p'] == "giftsSetting" ) 
           	{ 
    			include("giftsSetting.php");
    		}
    		
    		if( $_GET['p'] == "withdrawRequest" ) 
           	{ 
    			include("withdrawRequest.php");
    		}
    		
    		
    		
    		
    		
    	
    		
		}
		
		?>
	</div>
</div>

<?php 
require_once("footer.php"); 
}
else
{
    echo "<script>window.location='index.php'</script>";
}


?>