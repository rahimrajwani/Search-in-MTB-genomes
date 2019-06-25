<?php 
echo file_get_contents("header.html");
?>
<?php 
$updatelog=shell_exec("tail Database/Update.log");
echo "<p><pre> $updatelog </pre></p>";
?>
<?php echo file_get_contents("footer.html"); ?>