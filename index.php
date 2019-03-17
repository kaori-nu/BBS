<?php
// ファイルの存在確認 
 $file_name = "data.txt";
 if (!file_exists($file_name)){
   touch ($file_name);
 }
