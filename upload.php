<html>
<body>

<form method="POST" action="upload.php" enctype="multipart/form-data">
<label for="file">Filename:</label>
  <input type="hidden" name="MAX_FILE_SIZE" value="1024000" />
  <input type="file" name="file" id="file"/><br />
  <input type="submit" name ="submit" value="submit" /></p>
</form>

</body>
</html>




<?php 
if(isset($_FILES["file"]))
{
  if ((($_FILES["file"]["type"] == "image/gif")
  || ($_FILES["file"]["type"] == "image/jpeg")
  || ($_FILES["file"]["type"] == "image/pjpeg")
  )
  && ($_FILES["file"]["size"] < 2000000))
    {
    if ($_FILES["file"]["error"] > 0)
      {
      echo "Error: " . $_FILES["file"]["error"] . "<br />";//上传错误
      }
    else
      {
      echo "Upload: " . $_FILES["file"]["name"] . "<br />";
      echo "Type: " . $_FILES["file"]["type"] . "<br />";
      echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
      echo "Stored in: " . $_FILES["file"]["tmp_name"];

      if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
      else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
      }
    }
    else
      echo "file type or size wrong.";
}
?>

<!--
<?php
if(isset($_FILES["file"]))
{
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "h")
)
&& ($_FILES["file"]["size"] < 20000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
    }
    echo "upload succeed!";
  }
else
  {
  echo "Invalid file";
  }
}
?>
-->