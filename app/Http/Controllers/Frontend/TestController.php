<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use App\Models\Article;

class TestController extends Controller
{
    // 测试
    public function index()
    {
        $article = new Article();
        echo $article->getTable();exit();

        $arr = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];
        object($arr, ['key3' => 'value3']);
        print_r($arr);
        exit();
        $auth   = new Auth(config('blog.qiniuAccessKey'), config('blog.qiniuSecretKey'));
        $bucket = 'linlm1994';
        // 生成上传Token
        $token = $auth->uploadToken($bucket);
        // 构建 UploadManager 对象
        $uploadMgr = new UploadManager();
        // 要上传文件的本地路径
        $filePath = './images/focus_weixin.png';
        // 上传到七牛后保存的文件名
        $key             = 'my-php-logo1.png';
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {
            var_dump($err);
        } else {
            var_dump($ret);
        }
    }
}
