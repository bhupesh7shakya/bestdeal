<?php
// $i=0;
// $a=$_GET['loop'];
// echo $a;
$i = 0;
do {
    echo "<script>document.getElementById('i').innerHTML=".$i."</script>";
    $i++;
    // $a=$_GET['loop'];
    sleep(1);

} while ($i<=5);


?>