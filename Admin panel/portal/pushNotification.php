<?php 
if(isset($_SESSION[PRE_FIX.'id']))
{       
        ?>

        <div class="qr-content">
            <div class="qr-page-content">
                <div class="qr-page zeropadding">
                    <div class="qr-content-area">
                        <div class="qr-row">
                            <div class="qr-el">

                                <div class="page-title">
                                    <h2>Push Notification</h2>
                                    <div class="head-area">
                                    </div>
                                </div>

                                <!--start of datatable here-->
                                <img src='frontend_public/uploads/firebasePush.png' style="width: 100%;border-radius: 3px;">
                                <br><br>
                                <div class="qr-row">
                                    <form action="process.php?action=pushNotification" method="post" style="width: 100%;">
                                        <div class="full_width">
                                            <textarea name="text" required="" type="text" style="width: 100%; height: 212px;"></textarea>
                                        </div>
                                        <div class="full_width">
                                            <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;" align="center">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        
   
    <?php
    
} 
else 
{
	
	@header("Location: index.php");
    echo "<script>window.location='index.php'</script>";
    die;
    
} ?>