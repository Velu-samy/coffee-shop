<?php
$con = mysqli_connect("localhost","root","","kamesh");

$n=$_POST['ppo'];
$p=$_POST['poped'];



$sql="SELECT * FROM details WHERE name='$n' AND password = '$p'";
$result = mysqli_query($con,$sql);

$row = mysqli_fetch_row($result);

if($row>0){
    header("Location:../frontend/dashboard.html");

}
else
{
    echo "invalid password or username";
}



?>