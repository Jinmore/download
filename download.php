<?php
namespace houger;
// 下载文件
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
// 下载二维码
function get_qrcode($qrcode_url)
{
  $image_filename="./".date('Y-m-d').".jpg";
  $curl=curl_init($qrcode_url);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
  $image_data=curl_exec($curl);
  // 写入方式打开，将文件指针指向文件末尾，如果文件不存在则创建
  $handler=fopen($image_filename,'a');
  fwrite($handler,$image_data);
  fclose($handler);
}
get_qrcode("http://qr.liantu.com/api.php?text=https://jinmore.com");

?>
