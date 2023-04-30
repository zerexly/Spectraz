/*ajax calls design*/
$(document).ready(function () {
    $('#datetimepicker8').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
    $('#datetimepicker9').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });

    $(".websiteshow").click(function () {
        $("#urlinfo").show("slow");
    });
    $(".profileshow").click(function () {
        $("#urlinfo").hide("slow");
    });


    //$(".enterlocation").keyup(function () {
        // alert("123");
        // var placeofappend = $('.search_result_sujjested');
        // placeofappend.empty();
        // var dInput = this.value;
        // var spiner = $(".seachspiner i");
        // var data = {
        //     "search": dInput
        // };
        // if (dInput.length < 1) {
        //     placeofappend.css('opacity', '0');
        // }
        // if (dInput.length > 2) {
        //     spiner.show();
        //     jQuery.ajax({
        //         type: "POST",
        //         url: "ajax-events.php?action=showLocation",
        //         data: data,
        //         dataType: "text",
        //         success: function (response) {
        //             spiner.hide();
        //             placeofappend.css('opacity', '0.9');
        //             response = $.parseJSON(response);
        //             if (response.length > 0) {
        //                 $.each(response, function (i, j) {
        //                     content = "<div class='locationmain' onclick='addLocation(this)'>" +
        //                         "<p>" + j.location + "</p>" +
        //                         "<input type='hidden' class='valueoflocation' value='" + j.location + "'>" +
        //                         "</div>";
        //                     placeofappend.append(content);
        //                 });
        //             } else {
        //                 placeofappend.css('opacity', '0.9');
        //                 placeofappend.html("No Match");
        //             }
        //         }
        //     });
        // }
    //});
    

   
});

/*ajax related functions*/


function search_country_keyword()
{
    var placeofappend = $('.search_result_sujjested');
    placeofappend.empty();
    var dInput = document.getElementById('search_location').value;

    var spiner = $(".seachspiner i");
    var data = {
        "search": dInput
    };
    if (dInput.length < 1) {
        //placeofappend.css('opacity', '0');
    }
    if (dInput.length > 0) {
        spiner.show();
        jQuery.ajax({
            type: "POST",
            url: "ajax-events.php?action=showLocation",
            data: data,
            dataType: "text",
            success: function (response) {
                spiner.hide();
                placeofappend.css('display', 'block');
                //response = $.parseJSON(response);
                
                console.log(response);
                if (response.length > 0 && response!="201") 
                {
                    // $.each(response, function (i, j) {
                    //     content = "<div class='locationmain' onclick='addLocation(this)'>" +
                    //         "<p>" + j.location + "</p>" +
                    //         "<input type='hidden' class='valueoflocation' value='" + j.location + "'>" +
                    //         "</div>";
                    //     placeofappend.append(content);
                    // });
                    placeofappend.html(response);
                } 
                else 
                {
                    // placeofappend.css('opacity', '0.9');
                    placeofappend.html("No Match");
                }
            }
        });
    }
}

function search_user_keyword(user_id)
{
    var placeofappend = $('.search_result_sujjested');
    placeofappend.empty();
    var dInput = document.getElementById('search_location').value;
    
    var spiner = $(".seachspiner i");
    var data = {
        "search": dInput,
        "user_id": user_id
    };
    if (dInput.length < 1) {
        //placeofappend.css('opacity', '0');
    }
    if (dInput.length > 0) {
        spiner.show();
        jQuery.ajax({
            type: "POST",
            url: "ajax-events.php?action=search_user_keyword",
            data: data,
            dataType: "text",
            success: function (response) {
                spiner.hide();
                placeofappend.css('display', 'block');
                //response = $.parseJSON(response);
                
                console.log(response);
                if (response.length > 0 && response!="201") 
                {
                    // $.each(response, function (i, j) {
                    //     content = "<div class='locationmain' onclick='addLocation(this)'>" +
                    //         "<p>" + j.location + "</p>" +
                    //         "<input type='hidden' class='valueoflocation' value='" + j.location + "'>" +
                    //         "</div>";
                    //     placeofappend.append(content);
                    // });
                    placeofappend.html(response);
                } 
                else 
                {
                    // placeofappend.css('opacity', '0.9');
                    placeofappend.html("No Match");
                }
            }
        });
    }
}

function addLocation(country,country_id,state_id,city_id) 
{
    var hideopacity = $('.search_result_sujjested');
    object = country;
    //shownvalue = $(object).find(".valueoflocation").val();
    //var encodedData = window.btoa(country);
    //var placeofappend = $('.appendSearchResult');
    
    //check if country already selected
    
    var get_country_id = document.getElementsByName('country_id[]'); 
    var get_state_id = document.getElementsByName('state_id[]'); 
    var get_city_id = document.getElementsByName('city_id[]'); 
    
    for (var i = 0; i < get_country_id.length; i++) 
    { 
        var get_country_id_each_input_field = get_country_id[i].value;
        var get_state_id_each_input_field = get_state_id[i].value;
        var get_city_id_each_input_field = get_city_id[i].value;
        
        //alert(get_country_id_each_input_field+"="+country_id+" "+get_state_id_each_input_field+"="+state_id+" "+get_city_id_each_input_field+"="+city_id);
        
        if(get_country_id_each_input_field==country_id && get_state_id_each_input_field==state_id && get_city_id_each_input_field==city_id)
        {
            alert('This country already selected');
            hideopacity.css('display', 'none');
            hideopacity.html('');
            $('#search_location').val("");
            return false
        }
        
        
        if(get_country_id_each_input_field==country_id && state_id=="0" && city_id=="0")
        {
            alert('There are overlapping locations.');
            hideopacity.css('display', 'none');
            hideopacity.html('');
            $('#search_location').val("");
            return false
        }
    } 
    
    // 
    
    
    content = 
        "<div class='searchBar searchBarUS az_searchBarUS' onclick='removeLocation(this)' >" +
            " <h2 class='allYear US' style='margin: 0px;'>" + country + "</h2>" +
            " <div><i class=\"fa fa-check-circle-o\" aria-hidden=\"true\"></i></div>" +
            "<input type='hidden' name='selectedlocations[]' id='selectedlocations[]' class='selectedlocations' value='" + country + "'>"+
            "<input type='hidden' name='country_id[]' id='country_id[]' class='selectedlocations' value='" + country_id + "'>"+
            "<input type='hidden' name='state_id[]' id='state_id[]' class='selectedlocations' value='" + state_id + "'>"+
            "<input type='hidden' name='city_id[]' id='city_id[]' class='selectedlocations' value='" + city_id + "'>"+
        "</div>";
    $('.appendSearchResult').append(content);
    hideopacity.css('display', 'none');
    hideopacity.html('');
    $('#search_location').val("");
    
    
    
    //calculate reach on select location
    
    var input = document.getElementsByName('selectedlocations[]'); 
    
    var country_id = document.getElementsByName('country_id[]'); 
    var state_id = document.getElementsByName('state_id[]'); 
    var city_id = document.getElementsByName('city_id[]'); 
    
    var countries="";
    for (var i = 0; i < input.length; i++) 
    { 
        var a = input[i];
        
        countries+='{"name":"'+a.value+'","country_id":"'+country_id[i].value+'","city_id":"'+city_id[i].value+'","state_id":"'+state_id[i].value+'"}'+",";
        
    } 
    
    //alert(countries);
    
    
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            console.log(xmlhttp.responseText);
            
            document.getElementById('selected_country_reach').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajax-events.php?action=calculate_countries_reach&countries_array="+countries);
    xmlhttp.send();
    
    

}

function select_influencer_move_on_budget()
{
    $("#preloader").removeClass('hidePreloader');
    
    
    var user_id = document.getElementsByName('user_id[]'); 
    
    var users_array="";
    for (var i = 0; i < user_id.length; i++) 
    { 
        var a = user_id[i];
        
        users_array+='{"user_id":"'+a.value+'"}'+",";
        
    } 
    document.getElementById('data_influencer').value = users_array;
    document.getElementById('data_audience_id').value = "0";
    
    
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
            $("#preloader").addClass('hidePreloader');
            
            var slider = new Slider("#basic", {
                tooltip: 'always'
            });
            
            var slider = new Slider("#vertical", {
                tooltip: 'always'
            });
            
            document.getElementById('budget').value="30$";
            document.getElementById('days').value="1";
        }
    }
    xmlhttp.open("GET", "showbudget.php");
    xmlhttp.send();
}


function addInfluencer(influencer,userid) 
{
    var hideopacity = $('.search_result_sujjested');
    object = influencer;
    
    //shownvalue = $(object).find(".valueoflocation").val();
    //var encodedData = window.btoa(country);
    //var placeofappend = $('.appendSearchResult');
    
    //check if user already selected
    
    var get_user_id = document.getElementsByName('user_id[]'); 
    
    for (var i = 0; i < get_user_id.length; i++) 
    { 
        var user_id_each_input_field = get_user_id[i].value;
        
        if(user_id_each_input_field==userid)
        {
            alert('This user already selected');
            hideopacity.css('display', 'none');
            hideopacity.html('');
            $('#search_location').val("");
            
            return false
        }
    } 
    
    // 
    
    var influencer_filter=influencer.replace(/[^\w\s]/g,' ');
    content = 
        "<div class='searchBar searchBarUS az_searchBarUS' onclick='removeLocation(this)' >" +
            " <h2 class='allYear US' style='margin: 0px;'>" + influencer_filter + "</h2>" +
            " <div><i class=\"fa fa-check-circle-o\" aria-hidden=\"true\"></i></div>" +
            "<input type='hidden' name='user_id[]' id='user_id[]' class='selectedlocations' value='" + userid + "'>"
        "</div>";
    $('.appendSearchResult').append(content);
    hideopacity.css('display', 'none');
    hideopacity.html('');
    $('#search_location').val("");
    
    
    
    //calculate reach on select location
    
    var user_id = document.getElementsByName('user_id[]'); 
    
    var influencer_user="";
    for (var i = 0; i < user_id.length; i++) 
    { 
        var a = user_id[i];
        influencer_user+='{"user_id":"'+a.value+'"},';
    } 
    
    //alert(countries);
    
    console.log(influencer_user);
    
    
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            console.log(xmlhttp.responseText);
            
            document.getElementById('selected_country_reach').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajax-events.php?action=calculate_influencer_user_reach&influencer_user_array="+influencer_user);
    xmlhttp.send();
    
    

}

function removeLocation($this) {

    object = $this;
    shownvalue = $(object);
    shownvalue.empty();
    
    $($this).css('display', 'none');
        
    //console.log(shownvalue);
    
    //calculate reach on select location
    
    var input = document.getElementsByName('selectedlocations[]'); 
    
    var country_id = document.getElementsByName('country_id[]'); 
    var state_id = document.getElementsByName('state_id[]'); 
    var city_id = document.getElementsByName('city_id[]'); 
    
    var countries="";
    for (var i = 0; i < input.length; i++) 
    { 
        var a = input[i];
        
        countries+='{"name":"'+a.value+'","country_id":"'+country_id[i].value+'","city_id":"'+city_id[i].value+'","state_id":"'+state_id[i].value+'"}'+",";
        
    } 
    
    //alert(countries);
    
    
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            console.log(xmlhttp.responseText);
            
            document.getElementById('selected_country_reach').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "ajax-events.php?action=calculate_countries_reach&countries_array="+countries);
    xmlhttp.send();

}


function destination_option_website() 
{
    $('#websitediv').show();
    $('.btnNext').removeAttr("disabled");
    $('.btnNext').attr("onclick","showAudience()");
    document.getElementById('data_my_profile').value="";
}

function destination_option_profile() 
{
    $('#websitediv').hide();
    $('.btnNext').removeAttr("disabled");
    $('.btnNext').attr("onclick","showAudience()");
    document.getElementById('data_website_url').value="My_Profile";
}

function select_audience_id(data,raw_data_destination)
{
    $('.btnNext').removeAttr("disabled");
    $('.btnNext').attr("onclick","select_audience_id_next()");
    document.getElementById('data_audience_id').value=data;
    document.getElementById('raw_data_destination').value=raw_data_destination;
}

function select_audience_id_next()
{
    var data_audience_id=document.getElementById('data_audience_id').value;
    
    if(data_audience_id=="")
    {
        alert("You must select audience");
    }
    else
    {
        budget_and_duration();
    }
}

function budget_and_duration_reach(days)
{
    document.getElementById('budget_and_duration_reach').innerHTML = days;
}

function budget_and_duration()
{
    $("#preloader").removeClass('hidePreloader');
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
            $("#preloader").addClass('hidePreloader');
            
            var slider = new Slider("#basic", {
                tooltip: 'always'
            });
            
            var slider = new Slider("#vertical", {
                tooltip: 'always'
            });
            
            document.getElementById('budget').value="30$";
            document.getElementById('days').value="1";
            
        }
    }
    xmlhttp.open("GET", "showbudget.php");
    xmlhttp.send();
    
}


function review_promotion()
{
    var basic=document.getElementById('basic').value;
    var vertical=document.getElementById('vertical').value;
    var data_website_url=document.getElementById('data_website_url').value;
    var raw_data_destination=document.getElementById('raw_data_destination').value;
    var data_influencer=document.getElementById('data_influencer').value;
    
    document.getElementById('budget').value=basic;
    document.getElementById('days').value=vertical;
    
    $("#preloader").removeClass('hidePreloader');
    
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
            $("#preloader").addClass('hidePreloader');
            
            document.getElementById('data_price').innerHTML=basic;
            document.getElementById('data_days').innerHTML=vertical;
            document.getElementById('data_destination').innerHTML=data_website_url;
            
            if(data_influencer=="")
            {
                document.getElementById('raw_audience_data').innerHTML=raw_data_destination;
            }
            else
            {
                document.getElementById('raw_audience_data').innerHTML="Influencers";
            }
            
        }
    }
    xmlhttp.open("GET", "addPromotion.php");
    xmlhttp.send();
}

function showAudience(value)
{
    
    if(value=="noaction")
    {
        $("#preloader").removeClass('hidePreloader');
        var xmlhttp;
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //alert(xmlhttp.responseText);
                document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
                $("#preloader").addClass('hidePreloader');
            }
        }
        xmlhttp.open("GET", "showAudience.php");
        xmlhttp.send();
    }
    else
    {
        var profileshow=document.getElementById('profileshow');
        var websiteshow=document.getElementById('websiteshow');
        if (websiteshow.checked == true)
        {   
            var websiteurl=document.getElementById('websiteurl').value;
            if(websiteurl=="")
            {
                alert("You must fill website URL");
                
            }
            else
            {
                
                var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
                if(!regex.test(websiteurl)) 
                {
                    alert("Please enter valid URL.");
                } 
                else 
                {
                    document.getElementById('data_website_url').value=websiteurl;
                
                    $("#preloader").removeClass('hidePreloader');
                    var xmlhttp;
                    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {// code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            //alert(xmlhttp.responseText);
                            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
                            $("#preloader").addClass('hidePreloader');
                        }
                    }
                    xmlhttp.open("GET", "showAudience.php");
                    xmlhttp.send();
                }
                
                
            }
        } 
        if(profileshow.checked == true)
        {
            document.getElementById('data_my_profile').value="my_profile";
            $("#preloader").removeClass('hidePreloader');
            var xmlhttp;
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    //alert(xmlhttp.responseText);
                    document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
                    $("#preloader").addClass('hidePreloader');
                }
            }
            xmlhttp.open("GET", "showAudience.php");
            xmlhttp.send();
        }
        
    }
    
    
}


function showAddAudience()
{
    $("#preloader").removeClass('hidePreloader');
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
            $("#preloader").addClass('hidePreloader');
            
            
            //
            var age_range=document.getElementById('age_range').value;
            var male=document.getElementById('male').value;
            var female=document.getElementById('female').value;
            
            document.getElementById('selected_age_range').innerHTML = age_range;
            
            if(male=="male" && female=="female")
            {
                document.getElementById('selected_gender').innerHTML = "All";
            }
            else
            if(male=="male" && female=="")
            {
                document.getElementById('selected_gender').innerHTML = "Male";
            }
            else
            if(male=="" && female=="female")
            {
                document.getElementById('selected_gender').innerHTML = "Female";
            }
            
            
        }
    }
    xmlhttp.open("GET", "addAudience.php");
    xmlhttp.send();
    
    
    
}

function back_on_audience()
{
    $("#preloader").removeClass('hidePreloader');
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
            $("#preloader").addClass('hidePreloader');
        }
    }
    xmlhttp.open("GET", "showAudience.php");
    xmlhttp.send();
}

function back_on_add_audience()
{
    $("#preloader").removeClass('hidePreloader');
    var audience_name=document.getElementById('raw_audience_name').value;
    
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            //console.log(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
            document.getElementById('audience_name').value = audience_name;
            $("#preloader").addClass('hidePreloader');
            
            
            //// keep current data
            var age_range=document.getElementById('age_range').value;
            var male=document.getElementById('male').value;
            var female=document.getElementById('female').value;
            
            document.getElementById('selected_age_range').innerHTML = age_range;
            
            if(male=="male" && female=="female")
            {
                document.getElementById('selected_gender').innerHTML = "All";
            }
            else
            if(male=="male" && female=="")
            {
                document.getElementById('selected_gender').innerHTML = "Male";
            }
            else
            if(male=="" && female=="female")
            {
                document.getElementById('selected_gender').innerHTML = "Female";
            }
            
            // calcualte reach for Create Audience page 
            var countries = document.getElementById('countries').value; 
            
            if(countries!="")
            {
                var xmlhttp_1;
                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp_1 = new XMLHttpRequest();
                } else {// code for IE6, IE5
                    xmlhttp_1 = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp_1.onreadystatechange = function () {
                    if (xmlhttp_1.readyState == 4 && xmlhttp_1.status == 200) {
                        //console.log(xmlhttp_1.responseText);
                        document.getElementById('create_audience_reach').innerHTML = xmlhttp_1.responseText;
                    }
                }
                xmlhttp_1.open("GET", "ajax-events.php?action=calculate_create_audience_reach&countries_array="+countries+"&male="+male+"&female="+female+"&age_range="+age_range);
                xmlhttp_1.send();   
            }
            
        }
    }
    xmlhttp.open("GET", "addAudience.php");
    xmlhttp.send();
}

function back_on_destination_home()
{
    $("#preloader").removeClass('hidePreloader');
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
            $("#preloader").addClass('hidePreloader');
        }
    }
    xmlhttp.open("GET", "destination.php");
    xmlhttp.send();
}



function selectAgeGender()
{
    $("#preloader").removeClass('hidePreloader');
    var audience_name=document.getElementById('audience_name').value;
    var audience_name=audience_name.replace(/[^\w\s]/g,'');
    document.getElementById('raw_audience_name').value=audience_name;
    
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
            
            $("#preloader").addClass('hidePreloader');
            
            var slider = new Slider("#range2", {
            	min: 0,
            	max: 100,
            	value: [18, 60],
            	range: true,
            	tooltip: 'always'
            });
        }
    }
    xmlhttp.open("GET", "selectAgeGender.php");
    xmlhttp.send();
}

function selectLocations()
{
    $("#preloader").removeClass('hidePreloader');
    
    var audience_name=document.getElementById('audience_name').value;
    var audience_name=audience_name.replace(/[^\w\s]/g,'');
    document.getElementById('raw_audience_name').value=audience_name;
    
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
            $("#preloader").addClass('hidePreloader');
            
            var slider = new Slider("#range2", {
            	min: 0,
            	max: 100,
            	value: [18, 60],
            	range: true,
            	tooltip: 'always'
            });
        }
    }
    xmlhttp.open("GET", "selectLocations.php");
    xmlhttp.send();
}
 

function add_age_gender()
{
    var age_range=document.getElementById('range2').value;
    var male=document.getElementById('male');
    var female=document.getElementById('female');
    
    
    $("#age_and_gender_data #age_range").val(age_range);
    if (male.checked == true)
    {
        //alert("male");
        $("#age_and_gender_data #male").val("male");
    } 
    else
    {
        $("#age_and_gender_data #male").val("");
    }
    
    if (female.checked == true)
    {
        //alert("female");
        $("#age_and_gender_data #female").val("female");
    } 
    else
    {
        $("#age_and_gender_data #female").val("");
    }
    
    
    if(male.checked == false && female.checked == false)
    {
        alert("You must select male or female");
    }
    else
    {
        back_on_add_audience();
    }
    
    
    
    
}

function add_Audience()
{
    var audience_name=document.getElementById('audience_name').value;
    var user_id=document.getElementById('user_id').value;
    var age_range=document.getElementById('age_range').value;
    var male=document.getElementById('male').value;
    var female=document.getElementById('female').value;
    var countries=document.getElementById('countries').value;
    
    
    
    var audience_name=audience_name.replace(/[^\w\s]/g,'');
    //console.log(audience_name);
    
    if(audience_name=="")
    {
        alert("Audience name missing");
        return false;
    }
    
    if(age_range=="")
    {
        alert("Age range required");
        return false;
    }
    
    if(countries=="")
    {
        alert("Audience Location required");
        return false;
    }
    
    if(male=="" && female=="")
    {
        alert("You must select male or female");
        return false;
    }
    
    $("#preloader").removeClass('hidePreloader');
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () 
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            //alert(countries);
            //console.log(xmlhttp.responseText);
            if(xmlhttp.responseText==200)
            {
                showAudience('noaction');
                document.getElementById('age_range').value="";
                document.getElementById('male').value="";
                document.getElementById('female').value="";
                document.getElementById('countries').value="";
                $("#preloader").addClass('hidePreloader');
            }
            else
            {
                $("#preloader").addClass('hidePreloader');
                alert("Problem in adding audience Please contact administrator");
            }
        }
    }
    xmlhttp.open("GET", "ajax-events.php?action=add_Audience&male="+male+"&female="+female+"&countries="+countries+"&age_range="+age_range+"&audience_name="+audience_name+"&user_id="+user_id);
    xmlhttp.send();
    
}


function select_country()
{
    var input = document.getElementsByName('selectedlocations[]'); 
    
    var country_id = document.getElementsByName('country_id[]'); 
    var state_id = document.getElementsByName('state_id[]'); 
    var city_id = document.getElementsByName('city_id[]'); 
    
    var countries="";
    for (var i = 0; i < input.length; i++) 
    { 
        var a = input[i];
        
        countries+='{"name":"'+a.value+'","country_id":"'+country_id[i].value+'","city_id":"'+city_id[i].value+'","state_id":"'+state_id[i].value+'"}'+",";
        
    } 
    
    // countries.replace(/,\s*$/, "");
    
    var countries_final = countries.replace(/,\s*$/, "");
    //console.log(countries_final);
    
    $("#age_and_gender_data #countries").val("["+countries_final+"]");
    
    back_on_add_audience();
}

function create_promotion()
{
    var data_audience_id=document.getElementById('data_audience_id').value;
    var budget=document.getElementById('budget').value;
    var days=document.getElementById('days').value;
    var user_id=document.getElementById('user_id').value;
    var video_id=document.getElementById('video_id').value;
    var data_website_url=document.getElementById('data_website_url').value;
    var data_influencer=document.getElementById('data_influencer').value;


    $("#preloader").removeClass('hidePreloader');
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () 
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            console.log(xmlhttp.responseText);
            var response=xmlhttp.responseText;
            if(response=="error")
            {
                $("#preloader").addClass('hidePreloader');
                alert("Problem in creating compaign Please contact administrator");
                //alert(response);
            }
            else
            {
                window.location='index.php?payment=paypal&session_id='+response+'&video_id='+video_id+'&budget='+budget;
                $("#preloader").addClass('hidePreloader');
            }
        }
    }
    xmlhttp.open("GET", "ajax-events.php?action=create_promotion&data_audience_id="+data_audience_id+"&budget="+budget+"&days="+days+"&user_id="+user_id+"&video_id="+video_id+"&data_website_url="+data_website_url+"&data_influencer="+data_influencer);
    xmlhttp.send();
    
}


function promoteWithInfluencer()
{
    $("#preloader").removeClass('hidePreloader');
    
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            document.getElementById('contentReceived').innerHTML = xmlhttp.responseText;
            $("#preloader").addClass('hidePreloader');
            
        }
    }
    xmlhttp.open("GET", "promoteInfluencer.php");
    xmlhttp.send();
}

function deleteAudience(id)
{
    $("#preloader").removeClass('hidePreloader');
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () 
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            var response=xmlhttp.responseText;
            if(response=="200")
            {
                
                $("#"+id+"_audienceRow").html('');
                $("#preloader").addClass('hidePreloader');
                
            }
            else
            {
                $("#preloader").addClass('hidePreloader');
                //alert("Problem In Delete Audience Please contact administrator");
                alert(response);
            }
        }
    }
    xmlhttp.open("GET", "ajax-events.php?action=deleteAudience&id="+id);
    xmlhttp.send();
}


function popupmessgae() {
    var modal = document.getElementById("myModal");
    var modal2 = $("#myModal");
    jQuery.ajax({
        type: "POST",
        url: "ajax-events.php?action=modaldata",
        data: "",
        dataType: "text",
        success: function (response) {
			modal2.html(response);
        }
    });

    modal.style.display = "block";
}

function closepopup() {
	var modal = document.getElementById("myModal");
    modal.style.display = "none";
}



/*end of ajax related functions*/
/*extra functions*/


(function () {
    $("#range").slider({
        range: "min",
        max: 70000,
        value: 50,
        slide: function (e, ui) {
            $("#currentVal").html(ui.value);
        }
    });

}).call(this);


$(window).on('load', function () {
    $('.loading').hide();
    $('.wrapper').show();
});


var slider = new Slider("#range2", {
	min: 0,
	max: 100,
	value: [18, 60],
	range: true,
	tooltip: 'always'
});

var slider = new Slider("#range3", {
    tooltip: 'always'
});

var slider = new Slider("#dayslider3", {
    tooltip: 'always'
});