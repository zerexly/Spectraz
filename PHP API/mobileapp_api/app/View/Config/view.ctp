<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php


if(count($data['video_detail']) > 0)
{

            $current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $base_url = substr($current_url, 0, strpos($current_url, "view"));
        if (strlen($base_url) < 1) {

            $base_url = $current_url;
        }

$base_url = substr($base_url, 0, strrpos( $base_url, '/'));
$base_url = $base_url."/";

$video_detail = $data['video_detail'];
$key = 'http';
$video_url =  $video_detail['Video']['video'];
$title =  "video";
$user_pic =  $video_detail['User']['profile_pic'];
$user_image = $base_url.$user_pic;

if (strpos($video_url, $key) !== false) {


    $thumb_url = $video_detail['Video']['thum'];
    $video_url = $video_detail['Video']['video'];

}else{

    $thumb_url = $video_detail['Video']['thum'];

    $thumb_url = $base_url.$thumb_url;

   // $video_url = $base_url['Video']['video'];

    $video_url = $base_url.$video_url;

}

?>
    <title><?php echo $title; ?></title>
    <script src="https://kit.fontawesome.com/ac9b11d13d.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable=no">
    <style>
        body {
            font-family: "sofiapro-semibold",PingFangSC,sans-serif;
            margin: 0;
            padding: 0;
        }
        a {
            text-decoration: none;
            color: #000;
        }
        a:hover {
            text-decoration: none;
            color: #000;
        }
        .container {
            width: 375px;
            margin: 0 auto;
        }
        .videoPost {
            position: relative;
        }
        .profileImgInText img {
            width: 40px;
            border-radius: 25px;
        }
        .reactonSide {
            position: absolute;
            bottom: 0;
            display: inline-grid;
            color: #fff;
            text-align: center;
            /* margin: 195px 15px 0 0; */
            float: right;
            right: 15px;
            top: 260px;
            height: 230px;
            display: none;
        }
        .videoContent {
            font-size: 15px;
            font-weight: 400;
            position: relative;
            width: 70%;
            color: white;
            left: 10px;
            margin-top: -150px;
            z-index: 9999;
        }
        .reactonSide {
            color: #fff;
        }
        .reactonSide a {
            margin: 0 0 18px 0;
            color: #fff;
        }
        .reactonSide a .fas, .reactonSide a .fa {
            font-size: 25px;
        }
        .titleName {
            margin: 9px 0;
        }
        .videoContent h5 {
            margin: 0;
        }
        .videoContent h6 {
            margin: 6px 0;
        }
        .opratingBar img {
            width: 30px;
            margin: 0 10px;
        }
        .opratingBar {
            position: absolute;
            margin: 45px 0 0 0;
            background: #000;
            padding: 8px 3px;
        }
    </style>

</head>
<body>

<?php



    ?>

    <div class="container">
        <div class="innertiktikideo">
            <div class="videoPost">
                <video controls  poster="<?= $thumb_url ?>"  autoplay width="375">
                    <source src="<?= $video_url ?>" type="video/ogg" >
                    <source src="<?= $video_url ?>" type="video/mp4">
                </video>
            </div>
            <div class="videoContent">
                <div class="profileImgInText">
                    <a href="#">
                        <img src="<?= ($user_image != "" ? $user_image : "assets/images/profile.png") ?>">
                    </a>
                </div>
                <h4 class="titleName"><?= $video_detail['User']['first_name']." ".$video_detail['User']['last_name'] ?></h4>
                <h5 class="videoDescription"><?= $video_detail['Video']['description'] ?></h5>
                <h6>sound track refference</h6>
            </div>
            <div class="reactonSide">
                <a href="#">
                    <img src="<?= ($user_image != "" ? $user_image : "assets/images/profile.png") ?>">
                </a>
                <a href="#">
                    <i class="fa fa-heart">
                        <small><?= count($video_detail) ?></small>
                    </i>
                </a>
                <a href="#">
                    <i class="fas fa-comment-dots">
                        <small><?=  count($video_detail) ?></small>
                    </i>
                </a>
                <a href="#">
                    <i class="fa fa-share"></i>
                </a>
            </div>
        </div>
    </div>
    <?php
}else{
        //echo $this->Html->url('/');


require("config.ctp");
}
?>


</body>
</html> 