<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Cache;
//use Illuminate\Support\Facades\Storage;
use Mail;

class StudentController extends Controller
{

    public function mail()
    {
////1.发送纯文本
//        Mail::raw('邮件的内容', function($message){
//            //可以指定发送邮件的账户和名称
//           $message->from('1037759696@qq.com', 'lupeng');
//            //发送邮件的主题
//            $message->subject('邮件的主题 测试');
//            //指定发送对方
//            $message->to('1037759696@qq.com');
//        });
////2发送html
        Mail::send('student.mail', ['name' => 'sean'], function ($message) {
            $message->to('1037759696@qq.com');
        });
    }


    //
    public function upload(Request $request)
    {
        if ($request->isMethod('post')) {
//            var_dump($_FILES);
            $file = $request->file('source');
            //文件是否上传成功
            if ($file->isValid()) {
                //原文件名
                $orignalName = $file->getClientOriginalName();
                //扩展名
                $ext = $file->getClientOriginalExtension();
                //临时绝对路径

                $realPath = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s') . '_' . uniqid() . '.' . $ext;

                $bool = Storage::disk('upload')->put($filename, file_get_contents($realPath));
//                $file->getClientMimeType();

                var_dump($bool);
            }


            exit;
        }
        return view('student.upload');
    }

    public function queue()
    {
        dispatch(new SendEmail('1037759696@qq.com'));
    }
}
