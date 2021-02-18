<table border="1">
<tr>
    <th>id</th>
    <th>product name</th>
    <th>Product link</th>
    <th>product img</th>
    <th>price</th>
</tr>
    
<?php

require('./partials/dbcon.php');
$sql = 'select * from products ';
$result = mysqli_query($con, $sql);
if ($result) {
  if (mysqli_num_rows($result) != 0) {
    while ($rows = mysqli_fetch_assoc($result)) {
        // echo'
        // <tr>
        //     <td> '. $rows['product_id'].'</td>
        //     <td> '. $rows['product_name'].'</td>
        //     <td> '. $rows['product_link'].'</td>
        //     <td> '. $rows['product_img_url'].'</td>
        //     <td> '. $rows['product_price'].'</td>
        // </tr>
        // ';
       $item['id']= $rows['product_id'];
       $item['name']= $rows['product_name'];
       $item['link']= $rows['product_link'];
       $item['img']= $rows['product_img_url'];
       $item['price']= $rows['product_price'];

       $deals[]=$item;
       
        
    }
    // echo 'unsorted<br>';
    $num=sizeof($deals);
    // $g=0;
    // while($g<$num)
    // {
    // print_r( $deals[$g]['price']);echo" ";print_r( $deals[$g]['name']);
    // echo '<br>';
    //     $g++;
    // }

    for($i=0;$i<$num;$i++){
        for($j=0;$j<$num;$j++){
            if((int)$deals[$j]['price']>(int)$deals[$j+1]['price']){
                $temp =$deals[$j];
                $deals[$j]=$deals[$j+1];
                $deals[$j+1]=$temp;
            }
        }
    }
    echo 'sorted<br>';
    $g=0;
    while($g<$num)
    {
    echo'
        <tr>
            <td> '. $deals[$g]['id'].'</td>
            <td> '. $deals[$g]['name'].'</td>
            <td> '. $deals[$g]['link'].'</td>
            <td> '. $deals[$g]['img'].'</td>
            <td> '. $deals[$g]['price'].'</td>
        </tr>
        ';
        $g++;
    }
    // echo var_dump((int)$deals[0]['price']);
}
}



?>

</table>