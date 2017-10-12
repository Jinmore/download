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
  fclose($handler);
  
}
downLoad("../cfguanjia/api.php");
