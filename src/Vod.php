<?php

namespace Dy7338\Aliyunvod;
/**
 * Created by PhpStorm.
 * User: xiaole
 * Date: 18/5/10
 * Time: 下午4:29
 */
require_once __DIR__ . '/../aliyun-php-sdk-core/Config.php';
require_once __DIR__.'/../aliyun-php-sdk-vod/vod/Request/V20170321/CreateUploadVideoRequest.php';
require_once __DIR__.'/../aliyun-php-sdk-vod/vod/Request/V20170321/RefreshUploadVideoRequest.php';

class Vod {
    protected $iClientProfile;
    protected $client;

    public function __construct ($accessKeyId = null, $accessKeySecret = null) {
        // accessKeyId、accessKeySecret
        $this->iClientProfile = \DefaultProfile::getProfile ("cn-shanghai", $accessKeyId, $accessKeySecret);
        $this->client = new \DefaultAcsClient($this->iClientProfile);
    }

    // 获取视频上传地址和凭证
    function create_upload_video ($title,$video_name,$description='') {
        $request = new CreateUploadVideoRequest();

        $request->setTitle ($title);        // 视频标题(必填参数)
        $request->setFileName ($video_name); // 视频源文件名称，必须包含扩展名(必填参数)

        $request->setDescription ($description);  // 视频源文件描述(可选)
//        $request->setCoverURL ("http://img.alicdn.com/tps/TB1qnJ1PVXXXXXCXXXXXXXXXXXX-700-700.png"); // 自定义视频封面(可选)
//        $request->setTags ("标签1,标签2"); // 视频标签，多个用逗号分隔(可选)

        return $this->client->getAcsResponse ($request);
    }

    // 刷新上传凭证
    function refresh_upload_video ($videoId) {
        $request = new RefreshUploadVideoRequest();
        $request->setVideoId ($videoId);
        return $this->client->getAcsResponse ($request);
    }

}