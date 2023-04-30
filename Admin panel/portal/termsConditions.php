<?php 
if(isset($_SESSION[PRE_FIX.'id']))
{       
        
        $url=$baseurl . 'showHtmlPage';
        $data =array(
            "name" => "termsConditions"
        );
            
        $json_data=@curl_request($data,$url);
        
        ?>

        <div class="qr-content">
            <div class="qr-page-content">
                <div class="qr-page zeropadding">
                    <div class="qr-content-area">
                        <div class="qr-row">
                            <div class="qr-el">

                                <div class="page-title">
                                    <h2>Terms & Conditions</h2>
                                    <div class="head-area">
                                    </div>
                                </div>

                                <!--start of datatable here-->
                                <div class="qr-row">
                                    
                                    <form action="process.php?action=updatePage&page=termsConditions" method="post">
                                        
                                        <script src="ckEditor/ckeditor.js"></script>
                                        <script src="ckEditor/js/sample.js"></script>
                                        <div class="full_width">
                                            <div class="adjoined-bottom">
                                            	<div class="grid-container">
                                            		<div class="grid-width-100">
                                            			<textarea name="data_from" id="editor">
                                            				<?php
                                            				    echo @$json_data['msg']['HtmlPage']['text'];
                                            				?>
                                            			</textarea>
                                            		</div>
                                            	</div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="full_width">
                                            <input class="com-button com-submit-button com-button--large " value="Submit" type="submit" style="width: 100%;" align="center">
                                               
                                        </div>
                                        
                                    </form>
                                    
                                    
                                    
                                    <script>
                                    	initSample();
                                    </script>
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