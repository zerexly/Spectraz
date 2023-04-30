<div align="center">
    <label for="file" class="hoviringdell uploadBox" id="uploadTrigger" style="height: 160px; border: 2px dashed #ddd; margin-bottom: 15px;">
        <div id="UploadingFile" class="uploadText" style="padding-top:10px;">
            <div class="uploadText" style="padding-top:60px;">
                <?php if ($data['code'] < 201){?>
                <span style="color:#F69518;">File Uploaded</span>
                <? }else{?>

                    <span style="color:#F69518;">error</span>

                <?php }?>
            </div>
        </div>
    </label>
</div>