<?php
function SystemLogWrite($data)
{
$sysfile=fopen("SystemLog/SystemLog.txt","a+")or exit("Unable to open SystemLog file!");
fwrite($sysfile,$data);
fclose($sysfile);
}
?>
