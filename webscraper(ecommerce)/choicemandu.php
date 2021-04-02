<?php
    include './lib/simple_html_dom.php';
    $failed=0;

function choicemandu($link, $page, $cate)
{
    echo "Scraping $cate \n";

    for ($i = 1; $i <= $page; $i++) {
        $links = $link . '=' . $i;
        $html = file_get_html($links);
        // Find all  blocks
        foreach ($html->find('div.product-item-container') as $product) {
            // echo $product;
            $total=($i/$page)*100;
            $per=substr($total,0,5);
            echo " $per% completed    \r";

            // if ($product->find('img', 4)) {
                $item['image'] = $product->find('img', 0)->getAttribute('data-src');
            // }
            //   // $price
            $price = $product->find('span.price-new', 0)->plaintext;
            $cp = str_replace(',', '', $price);
            $item['price'] = str_replace('रू', '', $cp);
            $item['details'] = $product->find('h2.product-name-edited', 0)->plaintext;
            $item['link'] = $product->find('a', 0)->href;
            $item['cate']=$cate;
            $item['source']="choicemandu";
            
            include 'partials/dbcon.php';

            $sql="INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_img_url`,
             `product_link`, `created_by_email`, `created_by_user_id`, `created_on`, `search_keyword`, `source`) 
            VALUES (NULL, '".$item['details']."', '".$item['price']."', '".$item['image']."', '". $item['link']."',
             'admin@admin.com', '1', current_timestamp(), '".$item['cate']."', '". $item['source']."');
            ";
            // echo $sql.'<br>';
            if(mysqli_query($con,$sql)){
            //   echo $i.$cate;
            //   echo 'true';
            // sleep(3);
            echo $item['details']." inserted     \n\r";

            }
            else{
              echo " $failed failed    \r";
              $failed++;
            }
        }
    }
    echo "\n";

}

$myfile = fopen("choicemandu.txt", "r") or die("Unable to open file!");
while (!feof($myfile)) {
    $para = fgets($myfile);
    $link = explode(",", $para);
    // echo '<prev>';
    // print_r($link[0] . "," . $link[1] . "," . $link[2] . "<br>");

    choicemandu($link[0],$link[1],$link[2]);
}
fclose($myfile);
?>