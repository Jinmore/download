<?php
function downLoad($file)
{
   //设置响应主体-处理方式：附件
   header("Content-Disposition:attachment;filename=".basename($file));
   //获取文件类型
   $fileinfo=new Finfo(FILEINFO_MIME_TYPE);
   $mime=$fileinfo->file($file);
   //设置响应主体类型
   header("Content-Type:".$mime);
   //设置响应文件大小
   header("Content-Length".filesize($file));
   //文件处理,只读模式打开
   $handler=fopen($file,'r');
   while(!feof($handler)){
     echo fgets($handler,1024);
   }
   //关闭文件句柄
  fclose($handler);

}

$url =  "http://pan.baidu.com/share/qrcode?w=150&h=150&url=http://www.baidu.com"; // 要下载的文件

$curl = curl_init($url);
$filename ="../abc.jpg";
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
$imageData = curl_exec($curl);
curl_close($curl);
//写入方式打开，将文件指针指向文件末尾。如果文件不存在则尝试创建之。
$handler = @fopen($filename, 'a');
fwrite($handler, $imageData);
fclose($handler);
?>
