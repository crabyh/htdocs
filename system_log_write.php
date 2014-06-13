<?php
function systemlogwrite($data)
{
$sysfile=fopen("systemlog/systemlog.txt","a+")or exit("Unable to open SystemLog file!");
fwrite($sysfile,$data);
fclose($sysfile);
}
?>
