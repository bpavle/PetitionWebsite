<?php

$link=mysqli_connect("localhost:3308", "root","","petition");

$sql="DELETE FROM sign WHERE Sign_id='41';"
echo $sql;

mysqli_qery($link,$sql);

mysqli_close($link);

?>