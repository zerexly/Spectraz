<style>
    .uploadBox {
        border: 1.5px dashed #ddd;
        text-align: center;
        border-radius: 3px;
        width: 100%;
        cursor: pointer;
    }

    .uploadBox .uploadText {
        font-size: 16px;
        color: #C6C6C6;
        margin-bottom: 20px;
    }
    body{font-family: arial;}


</style>
<form method="POST" id="uploadFile" action="importJsonFile" enctype="multipart/form-data">
    <label for="file" class="hoviringdell uploadBox" id="uploadTrigger" style="height: 160px; border: 2px dashed #ddd; margin-bottom: 15px;">
        <div id="UploadingFile" class="uploadText" style="padding-top:10px;">
            <div class="uploadText" style="padding-top:60px;">
                <span style="color:#F69518;">Upload SQL File</span><br>
                (.json format only)
            </div>
        </div>
    </label>

    <input name="json" accept=".json" type="file" id="file" style="display:none;/>
    <input type=" submit"="" value="Submit">
</form>

<script>
    document.getElementById("uploadFile").onchange = function () {
        submitJsonFile();
    };


    function submitJsonFile()
    {
        document.getElementById("uploadFile").submit();
        document.getElementById("UploadingFile").innerHTML="<img src='../app/webroot/img/ajax-loader-large.gif' width='80px'><br><span style='color:#F69518;'>Uplaoding File</span>";

    }
</script>