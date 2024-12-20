
<?php

$con = mysqli_connect("localhost","root","","kamesh");

$_user=$_POST['pd'];
$_pass= $_POST['ps'];

$sql = "INSERT INTO details(name,password) VALUE('$_user','$$_pass')";


$result=mysqli_query($con,$sql);

if($result)
{
    echo "added";
}
else
{
    echo "not";
}





?>

