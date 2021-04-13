<?php
    include './lib/simple_html_dom.php';
 
function thulo($links, $page, $cate)
{
    $failed=0;
    $total=0;
    echo "Scraping $cate \n";

    for ($i = 1; $i <= $page; $i++) {
        $linkss = $links . $i;
        $html = file_get_html($linkss);

        if ($html) {
            foreach ($html->find('div[class=et-column4 et-grid-item-wrapper]') as $product) {
               // echo $product;
             

               $image = $product->find('img', 0);
               if (isset($image)) {
                 $doc = str_get_html($image);
                  $item['image'] = $doc->find('img', 0)->getAttribute('data-cfsrc');
               }
               else{
                  $item['image']='nothing';
               }
               //in this one pass as parameter beacuse ther two class with name name in object to access second one i passed 1 as aray start from 0
               $price = $product->find('span.ty-price-num', 1);
               if (isset($price)) {
                  $cp = str_replace(',', '', $price->plaintext);
                  $item['price'] = str_replace('रू', '', $cp);
               }
               else{
                  $item['price']='nothing';
               }
               $details = $product->find('a.product-title', 0);
               if (isset($details)) {
                  $item['details'] = $details->plaintext;
               }
               else{
                  $item['details']='nothing';
               }
               $link = $product->find('a.product-title', 0);
               if (isset($link)) {
                  $item['link'] = $link->href;
               }
               else{
                  $item['link']='nothing';
               }
               $item['cate']=$cate;
            $item['source']="thulo";
            //    $ScrabedDeal[] = $item;
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
            // echo $item['details']." inserted     \n\r";

            }
            else{
              echo " $failed failed    \r";
              $failed++;
            }
        }
        $total=($i/$page)*100;
        $per=substr($total,0,5);
        echo " $per% completed of $cate   \r";
         }
        // print_r($ScrabedDeal);
        
        echo "\n";

        }
    }
$myfile = fopen("files/thulo.txt", "r") or die("Unable to open file!");
while (!feof($myfile)) {
    $para = fgets($myfile);
    $link = explode(",", $para);
    
    // print_r($link[0] . "," . $link[1] . "," . $link[2] );

    thulo($link[0],$link[1],$link[2]);
}
fclose($myfile);
?>