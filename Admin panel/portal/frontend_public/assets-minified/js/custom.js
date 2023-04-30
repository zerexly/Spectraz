$(document).ready(function() {

    $(document).on("click",".more", function (e) {
        $(this).toggleClass("show-more-menu");
    });



    $('html').click(function(e) {
        if(!$(e.target).hasClass('more') )
        {

            $(".more").removeClass("show-more-menu");
        }
    })

});


function ConfirmDelete()
{
  var x = confirm("Are you sure you want to delete?");
  if (x)
      return true;
  else
    return false;
}

function myFunction(data) {
    var x = document.getElementById(data);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

function ClosePopup() {

    document.getElementById("PopupParent").style.display = "none";
    document.getElementById('contentReceived').innerHTML = "";

}
$(document).ready(function(){
    setTimeout(function(){
        $('#error_message').fadeOut();
    }, 3000);
    setTimeout(function(){
        $('#sucess_message').fadeOut();
    }, 3000);

    var password = document.getElementById("new-password")
        , confirm_password = document.getElementById("confirme-password");

    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

});



// change password popup

function changePassword(id,returnURL) 
{
    
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=changePassword&id="+id+"&returnURL="+returnURL);
    xmlhttp.send();
}


function changeAdminUserPassword(id) 
{
    
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=changeAdminUserPassword&id="+id);
    xmlhttp.send();
}

function addAdminUser() 
{
    
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=addAdminUser");
    xmlhttp.send();
}


function addStore() 
{
    
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?action=addStore");
    xmlhttp.send();
}


function editAdminUser(id) 
{
    
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=editAdminUser&id="+id);
    xmlhttp.send();
}


function addUser()
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=addUser");
    xmlhttp.send();
}

function addRider()
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=addRider");
    xmlhttp.send();
}

function editUser(id) 
{
    
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=editUser&id="+id);
    xmlhttp.send();
}

function editRider(id) 
{
    
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=editRider&id="+id);
    xmlhttp.send();
}



function submitAddNewCategory()
{
    
    var id=document.getElementById("id").value;
    var level=document.getElementById("level").value;
    var category_name=document.getElementById("category_name").value;
    var image=document.getElementById("imageData").value;
    
    
    $.post("ajex-events.php?q=submitAddNewCategory", {image: image,id:id,category_name:category_name,level:level}, function(result){
        $('#newEntry_'+level).append(result);
        document.getElementById('addCategory_'+level).innerHTML ="";
        
    });
    
    
    // var xmlhttp;
    // if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
    //     xmlhttp = new XMLHttpRequest();
    // } else {// code for IE6, IE5
    //     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    // }
    // xmlhttp.onreadystatechange = function () {
    //     if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    //         $('#newEntry_'+level).append(xmlhttp.responseText);
    //         document.getElementById('addCategory_'+level).innerHTML ="";
    //     }
    // }
    // xmlhttp.open("GET", "ajex-events.php?q=submitAddNewCategory&id="+id+"&level="+level+"&category_name="+category_name+"&image="+image);
    // xmlhttp.send();
}


function encodeImgtoBase64(element) 
{

      var img = element.files[0];
      var reader = new FileReader();
      reader.onloadend = function() {
          document.getElementById('imageData').value=reader.result;
      }

      reader.readAsDataURL(img);
}
    
function UploadCategoryImage(imageData)
{

    var fileUpload = document.getElementById('uploadFile');

    var regex = new RegExp('([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.jpeg)$');
    if (regex.test(fileUpload.value.toLowerCase())) {

      if (typeof (fileUpload.files) != 'undefined') {

        var reader = new FileReader()

        reader.readAsDataURL(fileUpload.files[0])
        reader.onload = function (e) {

          var image = new Image()

          image.src = e.target.result

          image.onload = function () {
            var height = this.height
            var width = this.width

            if (height == 120 && width == 120) {
                
                encodeImgtoBase64(imageData);
                
              //document.getElementById("sliderImageform").submit();
                document.getElementById('uploadTrigger').style.background="url("+image.src+")";
                document.getElementById('uploadTrigger').style.backgroundPosition ="top";
                document.getElementById('uploadTrigger').style.backgroundRepeat ="no-repeat";
                document.getElementById('uploadTrigger').style.backgroundSize ="contain";
                
                document.getElementById('logouploadText').style.display ="none";
                document.getElementById('logoPlaceholderimage').style.display ="none";
                
            } 
            else 
            {

              alert('Size 120x120')
              return false;
            }
          }

        }
      } else {
        alert('This browser does not support HTML5.')
        return false;
      }
    } else {
      alert('Please select a valid Image file.')
      return false;
    }
}
        
function Upload_image_desktop() 
{

    var fileUpload = document.getElementById('uploadFile')

    var regex = new RegExp('([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png)$')
    if (regex.test(fileUpload.value.toLowerCase())) {

      if (typeof (fileUpload.files) != 'undefined') {

        var reader = new FileReader()

        reader.readAsDataURL(fileUpload.files[0])
        reader.onload = function (e) {

          var image = new Image()

          image.src = e.target.result

          image.onload = function () {
            var height = this.height
            var width = this.width

            if (height == 90 && width == 90) {

                //document.getElementById("sliderImageform").submit();
                document.getElementById('uploadTrigger').style.background="url("+image.src+")";
                document.getElementById('uploadTrigger').style.backgroundPosition ="top";
                document.getElementById('uploadTrigger').style.backgroundRepeat ="no-repeat";
                document.getElementById('uploadTrigger').style.backgroundSize ="contain";
                
                document.getElementById('logouploadText').style.display ="none";
                document.getElementById('logoPlaceholderimage').style.display ="none";
                
            } else {

              alert('Size 90x90')
              return false
            }
          }

        }
      } else {
        alert('This browser does not support HTML5.')
        return false
      }
    } else {
      alert('Please select a valid Image file.')
      return false
    }
}
    
function Upload_image_desktopCover () 
{

    var fileUpload = document.getElementById('uploadFileCover');

    var regex = new RegExp('([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png)$')
    if (regex.test(fileUpload.value.toLowerCase())) {

      if (typeof (fileUpload.files) != 'undefined') {

        var reader = new FileReader()

        reader.readAsDataURL(fileUpload.files[0])
        reader.onload = function (e) {

          var image = new Image()

          image.src = e.target.result

          image.onload = function () {
            var height = this.height
            var width = this.width

            if (height == 220 && width == 320) 
            {
                document.getElementById('coverPreview').style.background="url("+image.src+")";
                document.getElementById('coverPreview').style.backgroundPosition ="center";
                document.getElementById('coverPreview').style.backgroundRepeat ="no-repeat";
                document.getElementById('coverPreview').style.backgroundSize ="cover";
                
                document.getElementById('coveruploadText').style.display ="none";
                document.getElementById('coverPlaceholderimage').style.display ="none";
                
                //"background-repeat: no-repeat; background-position: top;"
              //document.getElementById("sliderImageform").submit();

            } else {

              alert('Size 320x220')
              return false
            }
          }

        }
      } else {
        alert('This browser does not support HTML5.')
        return false
      }
    } else {
      alert('Please select a valid Image file.')
      return false
    }
}


function editStore(store_id)
{
    
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?action=editStore&id="+store_id);
    xmlhttp.send();
    
}

function addProducts(store_id)
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?action=addProducts&store_id="+store_id);
    xmlhttp.send();
}

function editProducts(product_id)
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?action=editProducts&product_id="+product_id);
    xmlhttp.send();
}


function previewImage(element)
{
      var img = element.files[0];
      var reader = new FileReader();
      //console.log(element);
      reader.onloadend = function() {
          //alert(reader.result);
          var previewData='<div style="float:left; width:140px;margin-right: 5px;"><label style="width: 140px;height: 140px;text-align: center;border-radius: 4px; overflow: hidden;"><img src="'+reader.result+'" id="logoPlaceholderimage" style="width:100%;height: 100%;"></label><input name="productImage[]" class="" id="productImage[]" value='+reader.result+' type="hidden"> <div><span class="fas fa-times" style="color: white; background: #F85453; padding: 5px 10px; font-size: 12px; border-radius: 2px;margin:0px 0 0 0;width: 100%;text-align: center;">Remove</span></div></div>';
          //document.getElementById('previewImage').append(previewData);
          $( "#previewImage" ).append(previewData);
      }
      reader.readAsDataURL(img);
}


// jQuery(".deleteCategory").on("click", function(){
//     var category_id = jQuery(this).attr("data-category-id");
    
//     if (confirm('Are you sure you want to delete?')) 
//     {
        
//     } 
//     else 
//     {
//         return false;
//     }
    
//     var xmlhttp;
//     if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
//         xmlhttp = new XMLHttpRequest();
//     } else {// code for IE6, IE5
//         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//     }
//     xmlhttp.onreadystatechange = function () {
//         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//             //alert(xmlhttp.responseText);
//             if(xmlhttp.responseText=="200")
//             {
//                 document.getElementById('row_'+category_id).style.display="none";
//             }
//             else
//             {
//                 alert(xmlhttp.responseText);
//             }
            
//         }
//     }
//     xmlhttp.open("GET", "ajex-events.php?q=deleteCategory&category_id="+category_id);
//     xmlhttp.send();  
        
  
// });

function deleteCategory(id)
{
    var category_id = id;
    
    if (confirm('Are you sure you want to delete?')) 
    {
        
    } 
    else 
    {
        return false;
    }
    
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            if(xmlhttp.responseText=="200")
            {
                document.getElementById('row_'+category_id).style.display="none";
            }
            else
            {
                alert(xmlhttp.responseText);
            }
            
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=deleteCategory&category_id="+category_id);
    xmlhttp.send();  
        
  
}


// jQuery(".editCategory").on("click", function(){
    
//     var category_id = jQuery(this).attr("data-category-id");
    
//     $(".editBox").html("");
//     document.getElementById('edit_'+category_id).innerHTML = "loading...";

//     var xmlhttp;
//     if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
//         xmlhttp = new XMLHttpRequest();
//     } else {// code for IE6, IE5
//         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//     }
//     xmlhttp.onreadystatechange = function () {
//         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//             //alert(xmlhttp.responseText);
//             document.getElementById('edit_'+category_id).innerHTML = xmlhttp.responseText;
//         }
//     }
//     xmlhttp.open("GET", "ajex-events.php?q=editCategory&category_id="+category_id);
//     xmlhttp.send();  
        
  
// });


function editCategoryRow(id)
{
    var category_id = id;
    
    $(".editBox").html("");
    document.getElementById('edit_'+category_id).innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            document.getElementById('edit_'+category_id).innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=editCategory&category_id="+category_id);
    xmlhttp.send();
}


function editCategory()
{
    var id=document.getElementById("id").value;
    var category_name=document.getElementById("category_name").value;
    var level=document.getElementById("level").value;
    var image=document.getElementById("imageData").value;
    
    
    $.post("ajex-events.php?q=submitEditCategory", {image: image,id:id,category_name:category_name,level:level}, function(result){
        
        if(result=="200")
        {
            $(".editBox").html("");
            $('.title_'+id).html(category_name)
        }
        else
        {
            alert(result);
        }
        //$('#newEntry_'+level).append(result);
    });
}


function addStoreStore()
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=addStoreStore");
    xmlhttp.send();
}

function viewUserDetails(user_id)
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=viewUserDetails&user_id="+user_id);
    xmlhttp.send();
}

function viewVideoDetails(video_id)
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=viewVideoDetails&video_id="+video_id);
    xmlhttp.send();
}


function tabName(tab) 
{
  var i;
  var x = document.getElementsByClassName("tab");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; 
  }
  document.getElementById(tab).style.display = "block"; 
  
    document.getElementById("tab_publicVideos").style.borderBottom = "";
    document.getElementById("tab_privateVideos").style.borderBottom = "";
    document.getElementById("tab_profileInfo").style.borderBottom = "";
    document.getElementById("tab_following").style.borderBottom = "";
    document.getElementById("tab_followers").style.borderBottom = "";
    document.getElementById("tab_likedVideos").style.borderBottom = "";

  if(tab=="publicVideos")
  {
    document.getElementById("tab_publicVideos").style.borderBottom = "2px solid #666";
  }
  else
  if(tab=="privateVideos")
  {
    document.getElementById("tab_privateVideos").style.borderBottom = "2px solid #666";
  }
  else
  if(tab=="profileInfo")
  {
    document.getElementById("tab_profileInfo").style.borderBottom = "2px solid #666";
  }
  else
  if(tab=="following")
  {
    document.getElementById("tab_following").style.borderBottom = "2px solid #666";
  }
  else
  if(tab=="followers")
  {
    document.getElementById("tab_followers").style.borderBottom = "2px solid #666";
  }
  else
  if(tab=="likedVideos")
  {
    document.getElementById("tab_likedVideos").style.borderBottom = "2px solid #666";
  }
   
}


function addSound()
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=addSound");
    xmlhttp.send();
}


function addSticker()
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=addSticker");
    xmlhttp.send();
}

function hashTagVideos(id)
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=hashTagVideos&id="+id);
    xmlhttp.send();
}

function userInbox(user_id)
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=userInbox&user_id="+user_id);
    xmlhttp.send();
} 

jQuery(document).on("click", ".inboxRow", function(){
    var rid	=	jQuery(this).attr("data-rid");
    var user_id	=	jQuery(this).attr("data-userid");
    
    $.ajax({url: "ajex-events.php?q=userChat&rid="+rid+"&user_id="+user_id, success: function(result){
      $("#messages #msgview").html(result);
    }});

});


jQuery(document).on("click", "#deleteComment", function(){
    var comment_id	=	jQuery(this).attr("data-commentid");
    $.ajax({url: "process.php?action=deleteComment&comment_id="+comment_id, success: function(result){
      
    if(result=="200")
    {
        $("."+comment_id+"_commentRow").hide();
    }
        
    }});

});


function addReportReason()
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=addReportReason");
    xmlhttp.send();
} 

function editReportReasons(id)
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=editReportReasons&id="+id);
    xmlhttp.send();
}

function addSection()
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=addSection");
    xmlhttp.send();
}


function assignSection(id)
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=assignSection&id="+id);
    xmlhttp.send();
}

function addGifts()
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=addGifts");
    xmlhttp.send();
}

function editCoinWorth(id)
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=editCoinWorth&id="+id);
    xmlhttp.send();
}

function editGift(id)
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=editGift&id="+id);
    xmlhttp.send();
}

function pushNotification(id)
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=pushNotification&id="+id);
    xmlhttp.send();
}

function pushNotificationToUser(id)
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=pushNotificationToUser&id="+id);
    xmlhttp.send();
}

function editSoundSection(id)
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=editSoundSection&id="+id);
    xmlhttp.send();
}



function changePromotionsStatus(id)
{
    document.getElementById("PopupParent").style.display = "block";
    document.getElementById("contentReceived").innerHTML = "loading...";

    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajex-events.php?q=changePromotionsStatus&id="+id);
    xmlhttp.send();
}



