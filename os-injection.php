<?php
print("Please specify the name of the file you want to see");
print("<p>");
$file=$_GET['filename'];
system("cat $file");
?>
