<?php

require_once(ROOT .  DS.  'app' . DS. 'Vendor' . DS  . 'google' . DS  . 'vendor'. DS . 'autoload.php');
require_once(ROOT .  DS.  'app' . DS. 'Vendor' . DS  . 'aws' . DS  . 'vendor'. DS . 'autoload.php');
use Aws\S3\S3Client;
App::uses('Utility', 'Lib');
class Regular
{







    static function local_video_upload($user_id, $param, $sound_details,$video_details,$duet){






        $original_video_file_path = (new self)->uploadOriginalVideoFileIntoTemporaryFolder($param,$user_id);

        if(!$original_video_file_path){

            $error['code'] = 201;
            $error['msg'] = "Something went wrong in uploading file into the folder. check your max upload size or check if fileupload is On in your php.ini file";

            echo json_encode($error);
            die();



        }

        $final_video = (new self)->addBlackBackgroundInTheVideo($original_video_file_path);

        if(count($video_details) > 0){

            //duet feature

            $original_video_file_path =  (new self)->duet($final_video,$video_details['Video']['video'],$duet);
            $final_video =  $original_video_file_path;


        }

        $gif = (new self)->videoToGif($original_video_file_path,$user_id);
        $thumb = (new self)->videoToThumb($original_video_file_path,$user_id);


        //$optimized_file_path = (new self)->optimizeVideoSize($original_video_file_path);






        if(count($sound_details) < 1){
            $mp3_file_name = "";
            $mp3_file = (new self)->convertVideoToAudio($final_video,$user_id);

            if($mp3_file) {


                $mp3_file_name = explode('/', $mp3_file);
                $mp3_file_name = "audio/" . $mp3_file_name[4];


                $output['audio'] = $mp3_file_name;

            }else{


                $output['audio'] = "";
            }

            $final_video_file_path = $final_video;
        }else {




            $mp3_file_name = "";
            $video_path_with_audio = (new self)->mergeVideoWithSound($user_id,$final_video, $sound_details['Sound']['audio']);
            $output['audio'] = "";
            $final_video_file_path = $video_path_with_audio;

        }






        $video_file_name = explode('/', $final_video_file_path);

        $video_file_name =  "video/".$video_file_name[3];

        $gif_file_name = explode('/', $gif);
        $gif_file_name =  "gif/".$gif_file_name[3];

        $thumb_file_name = explode('/', $thumb);
        $thumb_file_name = "thum/".$thumb_file_name[3];



            if(strlen($mp3_file_name) > 2){



                $final_output['audio'] = $mp3_file;


            }else{

                $final_output['audio'] = "";
            }
            $final_output['video'] = $final_video_file_path;
            $final_output['gif'] = $gif;
            $final_output['thum'] = $thumb;


           (new self)->unlinkFile($original_video_file_path);
            //(new self)->unlinkFile($gif);
            //(new self)->unlinkFile($thumb);
            //(new self)->unlinkFile($original_video_file_path);


            return $final_output;





    }
    static function unlinkFile($file_path){
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        return true;
    }

    function uploadOriginalVideoFileIntoTemporaryFolder($param,$user_id)
    {

        $fileName = uniqid().$user_id;
        $folder = UPLOADS_FOLDER_URI;
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        if($param == "image"){

            $ext = ".png";

        }else
            if($param == "video"){

                $ext = ".mp4";

            }else
                if($param == "audio"){

                    $ext = ".mp3";

                }
        $filePath = $folder . "/" . $fileName . $ext;

        if (move_uploaded_file($_FILES[$param]['tmp_name'], $filePath)) {


            return $filePath;

        }else{

            return false;
        }
    }



    static function multipartFileUpload($user_id, $param, $sound_details)
    {



        $original_video_file_path = (new self)->uploadOriginalVideoFileIntoTemporaryFolder($param);



        $gif = (new self)->videoToGif($original_video_file_path,$user_id);
        $thumb = (new self)->videoToThumb($original_video_file_path,$user_id);

        if(count($sound_details) < 1){

            $mp3_file = (new self)->convertVideoToAudio($original_video_file_path,$user_id);
            $output['audio'] = $mp3_file;
        }else {


            $video_path_with_audio = (new self)->mergeVideoWithSound($user_id, $original_video_file_path, $sound_details['Sound']['audio']);
            $output['audio'] = $video_path_with_audio;


        }
        $optimized_file_path = (new self)->optimizeVideoSize($original_video_file_path);
        $final_video = (new self)->addBlackBackgroundInTheVideo($optimized_file_path,$user_id);


        $output['video'] = $final_video;

        $output['thum'] = $thumb;
        $output['gif'] = $gif;
        $output['error'] = 0;


        unlink($original_video_file_path);
        return $output;









    }


    function optimizeVideoSize($original_video_path){

        $without_extension_file_name = pathinfo($original_video_path, PATHINFO_FILENAME);


        $pieces = explode('/', $original_video_path);

        $str = implode('/', array_slice($pieces, 0, -1));




        $optimizeResultFile = $str.'/'.$without_extension_file_name."_optimize.mp4";

        $cmd_new = "ffmpeg -i $original_video_path -c:v libx264 -crf 28 $optimizeResultFile";
        exec($cmd_new);
        return $optimizeResultFile;




    }


    function addBlackBackgroundInTheVideo($optimizeResultFile){



        $without_extension_file_name = pathinfo($optimizeResultFile, PATHINFO_FILENAME);


        $pieces = explode('/', $optimizeResultFile);

        $str = implode('/', array_slice($pieces, 0, -1));




        $black_background = $str.'/'.$without_extension_file_name."black.mp4";


        $command_new = "ffmpeg -i $optimizeResultFile -vf 'scale=720:1280:force_original_aspect_ratio=decrease,pad=720:1280:(ow-iw)/2:(oh-ih)/2,setsar=1' $black_background";
        exec($command_new);

        return $black_background;

    }


    function convertVideoToAudio($original_video_file_path,$user_id){

        $fileName = uniqid().$user_id;
        $folder = UPLOADS_FOLDER_URI.'/audio/';
        $mp3_file = $folder.$fileName.".mp3";
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $cmd ="ffprobe -i $original_video_file_path -show_streams -select_streams a -loglevel error";
        exec($cmd,$output);
        if(count($output)>0) {

            $command_new = "ffmpeg -i $original_video_file_path -b:a 192K -vn $mp3_file";
            exec($command_new,$output);
            return $mp3_file;
        }


    }

    function videoToGif($original_video_file_path,$user_id){
        $fileName = uniqid().$user_id;
        $folder = UPLOADS_FOLDER_URI.'/gif/';
        $genrateGifPath = $folder.$fileName.".gif";
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $gif = "ffmpeg -ss 3 -t 2 -i $original_video_file_path -vf 'fps=10,scale=320:-1:flags=lanczos,split[s0][s1];[s0]palettegen[p];[s1][p]paletteuse' -loop 0 $genrateGifPath";

        exec($gif,$output);

        return $genrateGifPath;

    }

    function videoToThumb($original_video_file_path,$user_id){
        $fileName = uniqid().$user_id;
        $without_extension_file_name = pathinfo($original_video_file_path, PATHINFO_FILENAME);


        $pieces = explode('/', $original_video_file_path);

        $str = implode('/', array_slice($pieces, 0, -1));




        $thumb_path = $str.'/'.$without_extension_file_name."thumb.png";

        $thumb_cmd = "ffmpeg -i $original_video_file_path -vf fps=3 $thumb_path";

        exec($thumb_cmd,$output);


        return $thumb_path;
    }


    static function duet($video1_path,$video2_path,$duet){


        $without_extension_file_name = pathinfo($video1_path, PATHINFO_FILENAME);


        $pieces = explode('/', $video1_path);

        $str = implode('/', array_slice($pieces, 0, -1));




        $duetMergePathOutput = $str.'/'.$without_extension_file_name."duet.mp4";


        $command_new = "ffmpeg -i $video1_path   -i $video2_path   -filter_complex '[0:v]pad=iw*2:ih[int];[int][1:v]overlay=W/2:0[vid]'   -map [vid]   -c:v libx264   -crf 23   -preset veryfast $duetMergePathOutput";


        exec($command_new);


        return $duetMergePathOutput;
    }





    function mergeVideoWithSound($user_id,$video_path,$audio){

        $fileName = uniqid().$user_id;
        $folder = UPLOADS_FOLDER_URI . '/' . $user_id;
        $with_new_audio = $folder.$fileName."audio.mp4";
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $cmd ="ffprobe -i $video_path -show_streams -select_streams a -loglevel error";
        exec($cmd,$if_audio_exist);

        if(count($if_audio_exist)>0) {
            //replace audio

            $cmd_new = "ffmpeg -i $video_path -i $audio -c:v copy -c:a aac -shortest -map 0:v:0 -map 1:a:0 $with_new_audio";
            exec($cmd_new);


        }else{

            //add audio
            $cmd_new = "ffmpeg -i $video_path -i $audio -c:v copy -c:a aac -shortest $with_new_audio";
            exec($cmd_new);

        }

        return $with_new_audio;
    }

}