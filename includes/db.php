<?php 
$db = array("DB_HOST"=>"localhost","DB_USER"=>"root","DB_PASS"=>"","DB_NAME"=>"cms",);
foreach ($db as $key => $value)
{
    define($key , $value);
}
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if (!$connection)
{
    die ('<h1>connecting failed</h1>');
    
}
?>