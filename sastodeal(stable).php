<?php
set_time_limit(-1);
include './lib/simple_html_dom.php';
function sastodeal($no,$link,$cate){
  for($i=1;$i<=$no;$i++){
    if($html = file_get_html($link."=".$i))
    {
    // Find all  blocks
    foreach($html->find('div.product-item-info') as $product) {
      // echo $product;
         $item['image']    = $product->find('img.product-image-photo[src]', 0)->src;
         $item['price']= $product->find('span.price', 0)->plaintext;
        $item['details'] = $product->find('a.product-item-link', 0)->plaintext;
        $item['link'] = $product->find('a.product-item-link', 0)->href;
        $item['source']='sastodeal';
        $item['cate']=$cate;
      //  $sastodealScrape[]=$item;
        include 'partials/dbcon.php';

      $sql="INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_img_url`,
       `product_link`, `created_by_email`, `created_by_user_id`, `created_on`, `search_keyword`, `source`) 
      VALUES (NULL, '".$item['details']."', '".$item['price']."', '".$item['image']."', '". $item['link']."',
       'admin@admin.com', '1', current_timestamp(), '".$item['cate']."', '". $item['source']."');
      ";
      // echo $sql.'<br>';
      if(mysqli_query($con,$sql)){
        echo $i.$cate;
        echo 'true';
      }
      else{
        echo 'fasle';
      }
       
      }
    }
    else{
      echo 'error';
    }
    // return print_r($sastodealScrape);
    }
}
//this function take no of pages ,ink , and which category 
sastodeal(173,'https://www.sastodeal.com/sd-fast.html?p','food');
sastodeal(113,'https://www.sastodeal.com/electronic.html?p','electronics');
sastodeal(352,'https://www.sastodeal.com/home-and-living.html?p','home & living');
sastodeal(161,'https://www.sastodeal.com/mens-fashion.html?p','men fashion');
sastodeal(132,'https://www.sastodeal.com/womens-fashion.html?p','women fashion');
sastodeal(204,'https://www.sastodeal.com/books.html?p','book');
sastodeal(43,'https://www.sastodeal.com/kid.html?p','kids');
sastodeal(300,'https://www.sastodeal.com/flipkart-store.html?p','flipkart');
sastodeal(17,'https://www.sastodeal.com/myntra-fashion.html?p','myntra');
