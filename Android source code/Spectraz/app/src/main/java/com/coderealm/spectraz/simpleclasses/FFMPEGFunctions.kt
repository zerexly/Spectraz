package com.coderealm.spectraz.simpleclasses

import android.app.Activity
import android.content.Context
import android.os.Bundle
import android.util.Log
import com.coderealm.spectraz.Constants
import com.coderealm.spectraz.interfaces.FragmentCallBack
import com.simform.videooperations.*
import java.io.File


object FFMPEGFunctions {


    fun createImageVideo(activity: Activity,input: String,
                         videoCompression:String,
                        callback:FragmentCallBack) {
        var output = Common.getFilePath(activity, Common.VIDEO)
        Log.d(Constants.tag,"output: $output")

        val query = imageToVideo(activity,input, output,videoCompression)
        CallBackOfQuery().callQuery(query, object : FFmpegCallBack {
            override fun process(logMessage: LogMessage) {
                var message=logMessage.text
                Log.d("FFMPEG_","process: ${message}")
                if (message.contains("size=") && message.contains("time="))
                {
                    message = Functions.decodeFFMPEGMessage(message)
                    val bundle=Bundle()
                    bundle.putString("action","process")
                    bundle.putString("message",message)
                    callback.onResponce(bundle)
                }

            }

            override fun success() {
                Log.d(Constants.tag,"success: ")
                val bundle=Bundle()
                bundle.putString("action","success")
                bundle.putString("path",output)
                callback.onResponce(bundle)
            }

            override fun cancel() {
                Log.d(Constants.tag,"cancel: ")
                val bundle=Bundle()
                bundle.putString("action","cancel")
                callback.onResponce(bundle)
            }

            override fun failed() {
                Log.d(Constants.tag,"failed: ")
                val bundle=Bundle()
                bundle.putString("action","failed")
                callback.onResponce(bundle)
            }
        })
    }


    fun addImageProcess(stickerPath: String,
                       videoFile:File, outputPath:String,
                        frameRate:String,videoCompression:String,
                        callback:FragmentCallBack) {

        val query = addVideoWaterMark(videoFile.absolutePath, stickerPath, outputPath,frameRate,videoCompression)
        CallBackOfQuery().callQuery(query, object : FFmpegCallBack {
            override fun process(logMessage: LogMessage) {
                var message=logMessage.text
                Log.d("FFMPEG_","process: ${message}")
                if (message.contains("size=") && message.contains("time="))
                {
                    message = Functions.decodeFFMPEGMessage(message)
                    val bundle=Bundle()
                    bundle.putString("action","process")
                    bundle.putString("message",message)
                    callback.onResponce(bundle)
                }

            }

            override fun success() {
                Log.d(Constants.tag,"success: ")
                val bundle=Bundle()
                bundle.putString("action","success")
                bundle.putString("path",outputPath)
                callback.onResponce(bundle)
            }

            override fun cancel() {
                Log.d(Constants.tag,"cancel: ")
                val bundle=Bundle()
                bundle.putString("action","cancel")
                callback.onResponce(bundle)
            }

            override fun failed() {
                Log.d(Constants.tag,"failed: ")
                val bundle=Bundle()
                bundle.putString("action","failed")
                callback.onResponce(bundle)
            }
        })
    }


    fun trimVideoProcess(videoFile:File, outputPath:String,
                         startTimeString:String,endTimeString:String,
                         frameRate:String,videoCompression:String,
                         callback: FragmentCallBack) {

        val query = cutVideo(videoFile.absolutePath, startTimeString, endTimeString, outputPath,frameRate,videoCompression)
        CallBackOfQuery().callQuery(query, object : FFmpegCallBack {
            override fun process(logMessage: LogMessage) {
                var message=logMessage.text
                Log.d("FFMPEG_","process: ${message}")
                if (message.contains("size=") && message.contains("time="))
                {
                    message = Functions.decodeFFMPEGMessage(message)
                    val bundle=Bundle()
                    bundle.putString("action","process")
                    bundle.putString("message",message)
                    callback.onResponce(bundle)
                }
            }

            override fun success() {
                Log.d("FFMPEG_","success: ")
                val bundle=Bundle()
                bundle.putString("action","success")
                bundle.putString("path",outputPath)
                callback.onResponce(bundle)
            }

            override fun cancel() {
                Log.d("FFMPEG_","cancel: ")
                val bundle=Bundle()
                bundle.putString("action","cancel")
                callback.onResponce(bundle)
            }

            override fun failed() {
                Log.d("FFMPEG_","failed: ")
                val bundle=Bundle()
                bundle.putString("action","failed")
                callback.onResponce(bundle)
            }
        })
    }


    fun compressVideoProcess(context: Context, videoFile:File,
                             width:Int, height:Int,
                             frameRate:Int,videoCompression:String,
                             callback: FragmentCallBack) {
        val outputPath = Common.getFilePath(context, Common.VIDEO)
        val query = compressor(videoFile.absolutePath, width, height, outputPath,frameRate,videoCompression)
        CallBackOfQuery().callQuery(query, object : FFmpegCallBack {
            override fun process(logMessage: LogMessage) {
                var message=logMessage.text
                Log.d("FFMPEG_","process: ${message}")
                if (message.contains("size=") && message.contains("time="))
                {
                    message = Functions.decodeFFMPEGMessage(message)
                    val bundle=Bundle()
                    bundle.putString("action","process")
                    bundle.putString("message",message)
                    callback.onResponce(bundle)
                }

            }

            override fun success() {
                Log.d("FFMPEG_","success: ")
                val bundle=Bundle()
                bundle.putString("action","success")
                bundle.putString("path",outputPath)
                callback.onResponce(bundle)
            }

            override fun cancel() {
                Log.d("FFMPEG_","cancel: ")
                val bundle=Bundle()
                bundle.putString("action","cancel")
                callback.onResponce(bundle)
            }

            override fun failed() {
                Log.d("FFMPEG_","failed: ")
                val bundle=Bundle()
                bundle.putString("action","failed")
                callback.onResponce(bundle)
            }
        })
    }




    fun videoSpeedProcess(context: Context,inputPath:String,speedTabPosition:Int,
                          frameRate:Int,videoCompression:String,
                          callback: FragmentCallBack) {
        val outputPath = Common.getFilePath(context, Common.VIDEO)
        var setpts:Double=1.0
        var atempo:Double=1.0
        Log.d(Constants.tag,"speedTabPosition: $speedTabPosition")
        when(speedTabPosition)
        {
            0->{
                setpts=2.0
                atempo=0.5
            }
            1->{
                setpts=1.5
                atempo=0.75
            }
            2->{
                setpts=1.0
                atempo=1.0
            }
            3->{
                setpts=0.75
                atempo=1.5
            }
            4->{
                setpts=0.5
                atempo=2.0
            }else->{
            setpts=1.0
            atempo=1.0
        }

        }

        val query = videoMotion(inputPath, outputPath,setpts,atempo,frameRate,videoCompression)
        CallBackOfQuery().callQuery(query, object : FFmpegCallBack {
            override fun process(logMessage: LogMessage) {
                var message=logMessage.text
                Log.d("FFMPEG_","process: ${message}")
                if (message.contains("size=") && message.contains("time="))
                {
                    message = Functions.decodeFFMPEGMessage(message)
                    val bundle=Bundle()
                    bundle.putString("action","process")
                    bundle.putString("message",message)
                    callback.onResponce(bundle)
                }

            }

            override fun success() {
                Log.d("FFMPEG_","success: ")
                val bundle=Bundle()
                bundle.putString("action","success")
                try {
                    Functions.copyFile(File(outputPath), File(inputPath))
                    Functions.clearFilesCacheBeforeOperation(File(outputPath))
                } catch (e: Exception) {
                    Functions.printLog(Constants.tag, "" + e)
                }
                bundle.putString("path",inputPath)
                callback.onResponce(bundle)
            }

            override fun cancel() {
                Log.d("FFMPEG_","cancel: ")
                val bundle=Bundle()
                bundle.putString("action","cancel")
                callback.onResponce(bundle)
            }

            override fun failed() {
                Log.d("FFMPEG_","failed: ")
                val bundle=Bundle()
                bundle.putString("action","failed")
                callback.onResponce(bundle)
            }
        })
    }




    fun videoHorizentalFlipProcess(context:Context,inputPath:String,
                                   frameRate:Int,videoCompression:String,
                                   callback: FragmentCallBack) {

        val outputPath = Common.getFilePath(context, Common.VIDEO)
        val query = videoHorizentalFlip(inputPath, outputPath,frameRate,videoCompression)
        CallBackOfQuery().callQuery(query, object : FFmpegCallBack {
            override fun process(logMessage: LogMessage) {
                var message=logMessage.text
                Log.d("FFMPEG_","process: ${message}")
                if (message.contains("size=") && message.contains("time="))
                {
                    message = Functions.decodeFFMPEGMessage(message)
                    val bundle=Bundle()
                    bundle.putString("action","process")
                    bundle.putString("message",message)
                    callback.onResponce(bundle)
                }

            }

            override fun success() {
                Log.d("FFMPEG_","success: ")
                val bundle=Bundle()
                bundle.putString("action","success")
                try {
                    Functions.copyFile(File(outputPath), File(inputPath))
                    Functions.clearFilesCacheBeforeOperation(File(outputPath))
                } catch (e: Exception) {
                    Functions.printLog(Constants.tag, "" + e)
                }
                bundle.putString("path",inputPath)
                callback.onResponce(bundle)
            }

            override fun cancel() {
                Log.d("FFMPEG_","cancel: ")
                val bundle=Bundle()
                bundle.putString("action","cancel")
                callback.onResponce(bundle)
            }

            override fun failed() {
                Log.d("FFMPEG_","failed: ")
                val bundle=Bundle()
                bundle.putString("action","failed")
                callback.onResponce(bundle)
            }
        })
    }


    fun imageToVideo(activity:Activity,input: String, output:String,videoCompression:String): Array<String> {
        Log.d(Constants.tag,"ImagePath: ${input}")

        val fade = "fade=type=in:duration=1,fade=type=out:duration=0.5:start_time=4.5"
        val inputs: ArrayList<String> = ArrayList()
        inputs.apply {
            add("-loop")
            add("1")
            add("-i")
            add(input)
            add("-b:v")
            add("${videoCompression}k")
            add("-b:a")
            add("48000")
            add("-s")
            add("${Functions.getPhoneResolution(activity).widthPixels}x${Functions.getPhoneResolution(activity).heightPixels}")
            add("-vf")
            add("format=yuv420p,$fade")
            add("-t")
            add("5")
            add("-preset")
            add("ultrafast")
            add(output)
        }
        return inputs.toArray(arrayOfNulls<String>(inputs.size))
    }




    fun addVideoWaterMark(inputVideo: String, imageInput: String, output: String,frameRate:String,videoCompression:String): Array<String> {
        val inputs: ArrayList<String> = ArrayList()
        inputs.apply {
            add("-i")
            add(inputVideo)
            add("-i")
            add(imageInput)
            add("-filter_complex")
            add("overlay=0.0f:0.0f")
            add("-b:v")
            add("${videoCompression}k")
            add("-b:a")
            add("48000")
            add("-r")
            add("$frameRate")
            add("-preset")
            add("ultrafast")
            add(output)
        }
        return inputs.toArray(arrayOfNulls<String>(inputs.size))
    }



    fun compressor(inputVideo: String, width: Int?, height: Int?, outputVideo: String,frameRate:Int,videoCompression:String): Array<String> {
        Common.getFrameRate(inputVideo)
        val inputs: ArrayList<String> = ArrayList()
        inputs.apply {
            add("-y")
            add("-i")
            add(inputVideo)
            add("-s")
            add("${width}x${height}")
            add("-r")
            add("${if (frameRate >= 10) frameRate - 5 else frameRate}")
            add("-vcodec")
            add("mpeg4")
            add("-b:v")
            add("${videoCompression}k")
            add("-b:a")
            add("48000")
            add("-ac")
            add("2")
            add("-ar")
            add("22050")
            add("-preset")
            add("ultrafast")
            add(outputVideo)
        }
        return inputs.toArray(arrayOfNulls<String>(inputs.size))
    }



    fun cutVideo(inputVideoPath: String, startTime: String?, endTime: String?, output: String,frameRate:String,videoCompression:String): Array<String> { Common.getFrameRate(inputVideoPath)
        val inputs: ArrayList<String> = ArrayList()
        inputs.apply {
            add("-i")
            add(inputVideoPath)
            add("-ss")
            add(startTime.toString())
            add("-to")
            add(endTime.toString())
            add("-b:v")
            add("${videoCompression}k")
            add("-b:a")
            add("48000")
            add("-r")
            add("$frameRate")
            add(output)
        }
        return inputs.toArray(arrayOfNulls<String>(inputs.size))
    }


    fun videoMotion(inputVideo: String, output: String, setpts: Double, atempo: Double,frameRate:Int,videoCompression:String): Array<String> {
        val inputs: ArrayList<String> = ArrayList()
        inputs.apply {
            add("-y")
            add("-i")
            add(inputVideo)
            add("-filter_complex")
            add("[0:v]setpts=${setpts}*PTS[v];[0:a]atempo=${atempo}[a]")
            add("-map")
            add("[v]")
            add("-map")
            add("[a]")
            add("-b:v")
            add("${videoCompression}k")
            add("-b:a")
            add("48000")
            add("-r")
            add("$frameRate")
            add("-vcodec")
            add("mpeg4")
            add("-preset")
            add("ultrafast")
            add(output)
        }
        return inputs.toArray(arrayOfNulls<String>(inputs.size))
    }


    fun videoHorizentalFlip(inputVideo: String, output: String,frameRate:Int,videoCompression:String): Array<String> {
        val inputs: ArrayList<String> = ArrayList()
        inputs.apply {
            add("-y")
            add("-i")
            add(inputVideo)
            add("-b:v")
            add("${videoCompression}k")
            add("-b:a")
            add("48000")
            add("-r")
            add("$frameRate")
            add("-vf")
            add("hflip")
            add("-c:a")
            add("copy")
            add("-preset")
            add("ultrafast")
            add(output)
        }
        return inputs.toArray(arrayOfNulls<String>(inputs.size))
    }

}