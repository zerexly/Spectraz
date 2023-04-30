<html>
<head>
    <title>woow</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../app/webroot/analytics/css/style.css">
</head>
<body>

<?php


$total_view_count_all_time = $analytics_data['DataAnalytics']['total_view_count_all_time'];
$total_view_count_week = $analytics_data['DataAnalytics']['total_view_count_week'];
$total_view_count_month = $analytics_data['DataAnalytics']['total_view_count_month'];
$popular = $analytics_data['DataAnalytics']['popular'];
$accounts_reached_all_time_total = $analytics_data['AccountsReached']['all_time_total'];
$accounts_reached_last_week = $analytics_data['AccountsReached']['last_week'];
$accounts_reached_last_week_count = $analytics_data['AccountsReached']['last_week_count'];
$accounts_reached_compare = $analytics_data['AccountsReached']['compare'];
$traffic_source_countries = $analytics_data['TrafficSource']['country'];
$traffic_source_cities = $analytics_data['TrafficSource']['city'];
$age_range_all = $analytics_data['AgeRange']['all'];
$age_range_male = $analytics_data['AgeRange']['male'];
$age_range_female = $analytics_data['AgeRange']['female'];
$followers_total_count = $analytics_data['Followers']['total_count'];
$followers_gender_based = $analytics_data['Followers']['gender_based'];


?>
<div class="main" style="text-align: center;">
    <div class="mainIn mainHeader">
        <div class="headIn">
            <div class="fonthead">
                <i class="allIcons fa fa-chevron-left"></i>
                <span style="font-weight: 500;">Data</span>
                <span class="analaitcihead">Analytics</span>
            </div>
        </div>
    </div>
    <div class="mainIn ">
        <div class="fsImage">
            <div class="numberTime">
                <div class="wrapper_info">
                    <h2 class="number"><?php echo $total_view_count_all_time?></h2>
                    <p class="time">view Time (<span>YTD</span>)</p>
                </div>
                <div style="display: flex; justify-content: center;">
                            <span class="timeAdd">
                                <h2 class="number"><?php echo $total_view_count_week ?></h2>
                                <p class="time">week</p>
                            </span>
                    <span class="timeAdd">
                                <h2 class="number"><?php echo $total_view_count_month ?></h2>
                                <p class="time">month</p>
                            </span>
                </div>
            </div>
        </div>
        <div class="fsbottom">
            <h2>
                <i class="allIcons fa fa-users"></i>
                <span class="fsText" style="font-weight: 500;"><?php echo $popular ?></span>
            </h2>
        </div>

    </div>

    <!--<div class="mainIn">
        <div class="secondIn">
            <div class="playTimeLeft">
                <h2 class="textPlaytime">Total Play Time</h2>
            </div>
            <div class="playTimeRight">
                <h2>
                           <span style="font-weight: 500;">
                               <span class="hour">0</span>h:<span class="minute">0</span>m:<span class="second">0</span>s
                            </span>
                </h2>
            </div>
        </div>

    </div>-->
    <div class="mainIn ">
        <div class="secondIn thirdIn">
            <div class="playTimeLeft"><h2 class="textPlaytime">Accounts Reached</h2></div>
            <div class="playTimeRight"><h2 class="accNumber"><?php echo  $accounts_reached_all_time_total ?></h2></div>
        </div>

    </div>
    <div class="mainIn ageRange">
        <h2>Traffic Sources</h2>
    </div>
    <div class="mainIn counttriesss">
        <div class="containers">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#city" aria-expanded="true">Cities</a></li>
                <li class=""><a data-toggle="tab" href="#country" aria-expanded="false">Countries</a></li>
            </ul>
            <div style="clear:both">
            </div>
            <div class="tab-content tabContent">
                <div id="city" class="tab-pane fade active in">
                    <?php foreach($traffic_source_cities as $cities){?>
                        <div class="progressMain">


                            <h3 class="countryProgress"><?php echo $cities['city']?></h3>
                            <div class="unitedState">
                                <div class="unitedChild" style="width: 17%;background-color: rgb(20, 20, 114);"></div>
                            </div>
                            <h3 class="progressPercentage"><?php echo $cities['percentage']?></h3>
                        </div>
                    <?php } ?>
                    <!-- <div class="progressMain">
                         <h3 class="countryProgress">Turkey</h3>
                         <div class="unitedState">
                             <div class="unitedChild" style="width: 10%;background-color: rgb(27, 27, 167);"></div>
                         </div>
                         <h3 class="progressPercentage">10%</h3>
                     </div>
                     <div class="progressMain">
                         <h3 class="countryProgress">Brazil</h3>
                         <div class="unitedState">
                             <div class="unitedChild" style="width: 8.4%;background-color: rgb(71, 71, 218);"></div>
                         </div>
                         <h3 class="progressPercentage">8.4%</h3>
                     </div>
                     <div class="progressMain">
                         <h3 class="countryProgress">Russia</h3>
                         <div class="unitedState">
                             <div class="unitedChild" style="width: 4.8%;background-color: rgb(101, 101, 230);"></div>
                         </div>
                         <h3 class="progressPercentage">4.8%</h3>
                     </div>
                     <div class="progressMain">
                         <h3 class="countryProgress">Iran</h3>
                         <div class="unitedState">
                             <div class="unitedChild" style="width: 4.6%;background-color: rgb(135, 135, 235);"></div>
                         </div>
                         <h3 class="progressPercentage">4.6%</h3>
                     </div>-->
                </div>
                <div id="country" class="tab-pane fade">
                    <?php foreach($traffic_source_countries as $countries){?>
                        <div class="progressMain">
                            <h3 class="countryProgress"><?php echo $countries['country']?></h3>
                            <div class="unitedState">
                                <div class="unitedChild" style="width: 17%;background-color: rgb(20, 20, 114);"></div>
                            </div>
                            <h3 class="progressPercentage"><?php echo $countries['percentage']?></h3>
                        </div>
                    <?php }?>
                    <!--
                    <div class="progressMain">
                        <h3 class="countryProgress">Turkey</h3>
                        <div class="unitedState">
                            <div class="unitedChild" style="width: 10%;background-color: rgb(27, 27, 167);"></div>
                        </div>
                        <h3 class="progressPercentage">10%</h3>
                    </div>
                    <div class="progressMain">
                        <h3 class="countryProgress">Brazil</h3>
                        <div class="unitedState">
                            <div class="unitedChild" style="width: 8.4%;background-color: rgb(71, 71, 218);"></div>
                        </div>
                        <h3 class="progressPercentage">8.4%</h3>
                    </div>
                    <div class="progressMain">
                        <h3 class="countryProgress">Russia</h3>
                        <div class="unitedState">
                            <div class="unitedChild" style="width: 4.8%;background-color: rgb(101, 101, 230);"></div>
                        </div>
                        <h3 class="progressPercentage">4.8%</h3>
                    </div>
                    <div class="progressMain">
                        <h3 class="countryProgress">Iran</h3>
                        <div class="unitedState">
                            <div class="unitedChild" style="width: 4.6%;background-color: rgb(135, 135, 235);"></div>
                        </div>
                        <h3 class="progressPercentage">4.6%</h3>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
    <div class="mainIn ageRange">
        <h2 class="age">Age Range</h2>
    </div>
    <div class="mainIn ">
        <div class="containers">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true">All</a></li>
                <li><a data-toggle="tab" href="#men" aria-expanded="false">Men</a></li>
                <li><a data-toggle="tab" href="#women" aria-expanded="false">Women</a></li>
            </ul>
            <div style="clear:both"></div>
            <div class="tab-content tabContent">
                <div id="all" class="tab-pane fade in active">
                    <?php foreach($age_range_all as $all){?>
                        <div class="progressMain">
                            <h3 class="countryProgress"><span class="ageFrom"><?php echo $all['age_range'] ?></span></h3>
                            <div class="unitedState">
                                <div class="unitedChild" style="width: 1.5%;background-color: rgb(147, 147, 235);"></div>
                            </div>
                            <h3 class="progressPercentage"><?php echo $all['percentage'] ?>%</h3>
                        </div>
                    <?php } ?>

                </div>
                <div id="men" class="tab-pane fade">
                    <?php foreach($age_range_male as $male){?>
                        <div class="progressMain">
                            <h3 class="countryProgress"><span class="ageFrom"><?php echo $male['age_range'] ?></span></h3>
                            <div class="unitedState">
                                <div class="unitedChild" style="width: 1.5%;background-color: rgb(147, 147, 235);"></div>
                            </div>
                            <h3 class="progressPercentage"><?php echo $male['percentage'] ?>%</h3>
                        </div>
                    <?php } ?>

                </div>
                <div id="women" class="tab-pane fade">
                    <?php foreach($age_range_female as $female){?>
                        <div class="progressMain">
                            <h3 class="countryProgress"><span class="ageFrom"><?php echo $female['age_range'] ?></span></h3>
                            <div class="unitedState">
                                <div class="unitedChild" style="width: 1.5%;background-color: rgb(147, 147, 235);"></div>
                            </div>
                            <h3 class="progressPercentage"><?php echo $female['percentage'] ?>%</h3>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="mainIn ageRange">
        <h2>Accounts Reached</h2>
    </div>
    <div class="mainIn">
        <div>
            <h3 class="accountsLine"><span class="accountsNumber"><?php echo $accounts_reached_all_time_total ?> </span> accounts</h3>
            <h3 class="accountsLine working"><span class="workPercentage"><?php  echo number_format((float)$accounts_reached_compare, 2, '.', '');?></h3>
        </div>
        <div>
            <canvas id="barChartDay1"></canvas>
        </div>
        <p class="daysReached"><?php  echo number_format((float)$accounts_reached_compare, 2, '.', '');?></span></p>
    </div>
    <!-- <div class="mainIn">
         <div style="display: flex; justify-content: space-between; ">
             <div class="impressions">
                 <h2>Impressions</h2>
             </div>
             <div class="impressionsRight">
                 <h2 class="impressionsNumber">523</h2>
             </div>
         </div>
         <h3 class="accountsLine impressionTime"><span class="workPercentage">-16.8</span>% vs <span class="monthFrom">Aug 20</span>
             - <span class="monthTo">Aug 26</span></h3>
     </div>-->
    <div class="mainIn">
        <div style="display: flex; justify-content: space-between;">
            <div class="impressions"><h2>Account Activity</h2></div>
            <div class="activityNumber"><h2></h2></div>
        </div>
        <div class="wrapingmargin">
            <div style="display: flex; justify-content: space-between;">
                <div class="impressions">
                    <h3 style="text-align: left">Profile Visits</h3>
                    <div class="accountsLine impressionTime"><span class="workPercentage"><?php  echo number_format((float)$accounts_reached_compare, 2, '.', '');?></div>
                </div>
                <div class="websiteNumber">
                    <h3><?php  echo $accounts_reached_last_week_count?></h3>
                </div>
            </div>


        </div><!--
        <div class="wrapingmargin">
            <div style="display: flex; justify-content: space-between;">
                <div class="impressions">
                    <h3>Website Tapes</h3>
                </div>
                <div class="websiteNumber">
                    <h3>2</h3>
                </div>
            </div>


            <h3 class="accountsLine impressionTime"><span class="workPercentage">-0</span>% vs <span class="monthFrom">Aug 20</span>
                - <span class="monthTo">Aug 26</span></h3>
        </div>-->
    </div>

    <div class="mainIn ageRange">
        <h2 class=""><span class="">Followers</span></h2>
    </div>

    <div class="mainIn nineSection">
        <h5 class="followers"><span><?php echo $followers_total_count?> </span>followers</h5>
        <canvas id="myChart1" width="500px" height="200px" class="chartjs-render-monitor"
                style=" width: 520px; height: 200px;"></canvas>
        <div style="display: flex; justify-content: space-around;">
            <div style="margin: 0;">


                <?php

                $male_key = array_search("male", array_column( $followers_gender_based, 'gender'));
                $female_key = array_search("female", array_column( $followers_gender_based, 'gender'));

            
                ?>


                <h2 class="menPers"><?php

                    if(strlen($male_key) > 0) {

                        echo $followers_gender_based[$male_key]['percentage'];

                    }else{

                        echo "0";
                    }

                    ?>%</h2>
                <h4 class="followers men" style="margin: 0%;">Men</h4>
            </div>
            <div>
                <h2 class="menPers"><?php

                    if(strlen($female_key) > 0) {

                        echo $followers_gender_based[$female_key]['percentage'];

                    }else{

                        echo "0";
                    }

                    ?>%</h2>
                <h4 class="followers Women" style="margin: 0%;">Women</h4>
            </div>
        </div>
    </div>

    <!--<div class="mainIn tenthSection">
        <div class="containers">
            <div style="float: left;" class="activeTime">
                <h2>Most Active Time</h2>
            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#hours" aria-expanded="true">Hours</a></li>
                <li class=""><a data-toggle="tab" href="#days" aria-expanded="false">Days</a></li>
            </ul>
            <div style="clear:both">
            </div>
            <div class="containerCarousel">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            Wednesday
                            <div class="tab-content">
                                <div id="hours" class="tab-pane fade active in">
                                    <canvas id="barChartWed"></canvas>
                                </div>
                                <div id="days" class="tab-pane fade">
                                    <canvas id="barChartWedHour"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            Friday
                            <div class="tab-content">
                                <div id="hours" class="tab-pane fade active in">
                                    <canvas id="barChartFri"></canvas>
                                </div>
                                <div id="days" class="tab-pane fade">
                                    <canvas id="barChartFriHour"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class=" left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="prev glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class=" right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="next glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>-->


</div>
</body>
<footer>


    <script src="../app/webroot/analytics/js/chart.js"></script>
    <script src="../app/webroot/analytics/js/script.js"></script>
    <script src="../app/webroot/analytics/js/jquery.min.js"></script>
    <script src="../app/webroot/analytics/js/bootstrap.min.js"></script>
    <?php

    $accounts_reached_last_week_array_days = array();
    $accounts_reached_last_week_array_total_count = array();
    if(count($accounts_reached_last_week) > 0){

        foreach ($accounts_reached_last_week as $key=>$val){
            $accounts_reached_last_week_array_days[$key] = $val['day'];
            $accounts_reached_last_week_array_total_count[$key] = $val['total_count'];
        }
    }



    $followers_gender_based_array = array();
    $followers_gender_based_array_total_count = array();
    if(count( $followers_gender_based) > 0){

        foreach ( $followers_gender_based as $key=>$val){
            $followers_gender_based_array[$key] = $val['gender'];
            $followers_gender_based_array_total_count[$key] = $val['percentage'];
        }
    }





    ?>


</footer>

<script type="text/javascript">
    var jArray_days = <?php echo json_encode($accounts_reached_last_week_array_days); ?>;
    var jArray_days_count = <?php echo json_encode($accounts_reached_last_week_array_total_count); ?>;


    var jArray_followers_gender = <?php echo json_encode($followers_gender_based_array); ?>;
    var jArray_followers_count = <?php echo json_encode($followers_gender_based_array_total_count); ?>;

    var ctx = document.getElementById("myChart1").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: jArray_followers_gender,
            datasets: [{
                backgroundColor: ["rgb(44, 226, 44)"," green"],
                data: jArray_followers_count
            }]
        }
    });
    var barchart = document.getElementById("barChartDay1").getContext('2d');
    barchart.canvas.parentNode.style.width = '';
    var myBarChart = new Chart(barchart, {
        type: 'bar',
        data: {
            labels: jArray_days,
            datasets: [
                {
                    label: "Account Reached",
                    backgroundColor: ["#3e95cd", "#3e95cd","#3e95cd","#3e95cd","#3e95cd","#3e95cd","#3e95cd"],
                    data: jArray_days_count
                }
            ]
        },
        options: {
            legend: { display: false },
            //tooltips: {enabled: false},
            // events: {[]},

            hover: {mode: null},
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        display: false
                    }
                }]
            }
        }
    });

</script>
</html>