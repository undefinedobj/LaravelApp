<?php

use Illuminate\Support\Facades\Storage;

/**
 * save_image_file      保存图片文件 ,存在Storage::disk('uploads') 目录下
 *
 * @var $file object     上传的图片文件,具体是在 request 中的 UploadedFile 类型的对象
 * @var $prefix_name     string 可选保存的文件名前缀
 * @var $disk string     文件路径
 * @return bool/string   如果通过验证 则返回在新的文件名
 */
if (!function_exists('save_image_file')) {

    function save_image_file(&$file, $prefix_name='images', $disk='picture')
    {
        $file = $file ?? null;

        if ($file != null && $file->isValid()) {
            // 获取文件相关信息

            $ext = $file->getClientOriginalExtension();     // 扩展名

            if ($ext == "" && $file->getClientOriginalName() == 'blob') {
                $ext = 'png';
            }
            if (!preg_match('/jpg|png|gif$/is', $ext)) {
                return false;
            }

            // $type = $file->getClientMimeType();     // image/jpeg
            $realPath = $file->getRealPath();   //临时文件的绝对路径

            $filename = $prefix_name . '-' .uniqid() . '.' . $ext;

            $path = '/'.$prefix_name.'/'.date('Y').'/'.date('m').'/'.date('d').'/'.$filename;

            $bool = Storage::disk($disk)->put($path, file_get_contents($realPath));

            if (!$bool) return false;

            return config('app.url').'/uploads'.$path;
        }

        return false;
    }
}
