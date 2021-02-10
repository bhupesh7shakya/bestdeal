<?php
//sastodeal
include './lib/simple_html_dom.php';
require './partials/dbcon.php';
$getsSearchQuery = $_GET['q'];


function filterPrice($price)
{
   $replaceRu = str_replace('रू', '', $price);
   $replaceSpace = str_replace(' ', '', $replaceRu);
   $replaceRs = str_replace('Rs.', '', $replaceSpace);
   $replaceFloat = str_replace('.00', '', $replaceRs);
   $replaceRs = str_replace('Rs', '', $replaceFloat);
   $replaceComma = str_replace(',', '', $replaceRs);
   $replaceComma = str_replace(',', '', $replaceRs);
   $FilteredPrice = $replaceComma;
   return $FilteredPrice;
}

if ($con->connect_error) {
   echo 'something went wrong';
} else {
   // echo 'conneted successfully';
}
$sql = 'select * from products where search_keyword="' . $getsSearchQuery . '"';
$result = mysqli_query($con, $sql);
if ($result) {
   if (mysqli_num_rows($result) != 0) {
      while ($rows = mysqli_fetch_assoc($result)) {
         // echo $rows['product_name'] . ' ' . $rows['product_price'] . ' ' . $rows['product_img_url'] . ' ' . $rows['product_link'];
      }
   } else {


      $_search = str_replace(' ', '+', $getsSearchQuery);
      $html = file_get_html('https://www.sastodeal.com/catalogsearch/result/?q=' . $_search);
      // Find all  blocks
      foreach ($html->find('div.product-item-info') as $product) {
         // echo $product;
         $image= $product->find('img.product-image-photo[src]', 0);
         if(isset($image)){
         $item['image']    =$image->src;

         }
         // $price
         $price = $product->find('span.price', 0);
         if(isset($price)){
            $pric=$price->plaintext;
            $cp = str_replace(',', '', $pric);
         $item['price'] = str_replace('रू', '', $cp);
         }
         
         $item['details'] = $product->find('a.product-item-link', 0)->plaintext;
         $item['link'] = $product->find('a.product-item-link', 0)->href;
         $ScrabedDeal[] = $item;
      }
      //durbarmart
      $html = file_get_html('https://durbarmart.com/search?q=' . $_search);
      // Find all article blocks
      // Find all article blocks
      foreach ($html->find('div.products') as $product) {
         // echo $product;
         $item['image'] = $product->find('img', 0)->src;
         $price = $product->find('div.product_price', 0)->plaintext;
         $replaceComma = str_replace(',', '', $price);
         $item['price'] = $replaceComma;
         $item['details'] = $product->find('h5', 0)->plaintext;
         $link = $product->find('a', 0)->href;
         $item['link'] = "https://durbarmart.com/products/" . $link;
         $ScrabedDeal[] = $item;
      }
      //muncha
      $html = file_get_html('https://muncha.com/Shop/Search?merchantID=1&CategoryID=0&q=' . $_search);
      // Find all article blocks
      foreach ($html->find('div.product') as $product) {
         // echo $product;
         $item['image'] = $product->find('img.product-img-primary', 0)->src;
         $price = $product->find('span.product-caption-price-new', 0)->plaintext;
         $replaceSpace = str_replace(' ', '', $price);
         $replaceRs = str_replace('Rs.', '', $replaceSpace);
         $replaceFloat = str_replace('.00', '', $replaceRs);
         $replaceRs = str_replace('Rs', '', $replaceFloat);
         $replaceComma = str_replace(',', '', $replaceRs);
         $replaceComma = str_replace(',', '', $replaceRs);
         $item['price'] = $replaceComma;
         $item['details'] = $product->find('h5.product-caption-title-sm', 0)->plaintext;
         $link = $product->find('a', 0)->href;
         $item['link'] = "https://muncha.com/" . $link;
         $ScrabedDeal[] = $item;
      }
      // mynepshop
      $html = file_get_html('https://mynepshop.com/search?id_category=0&fc=module&module=jmsadvsearch&controller=search&order=product.position.asc&search_query=' . $_search);
      /// Find all article blocks
      foreach ($html->find('div.prod-row') as $product) {
         // echo $product;
         $data = $product->find('img', 0);
         //basically it was store in $data in this website while finding src of image it save data-src which causes the no photo output
         //for example: link of this website is <img class="r" data-src="link" > while saving from scrape so to remove or replace it from null w
         // we have used string replace fucntion which first takes str_replace(find,replace,string,count)
         // echo '<textarea name="" id="" cols="30" rows="10">'.$data.'</textarea>'; this is just for debuging
         $item['image'] = str_replace("data-", "", $data);
         // echo '<textarea name="" id="" cols="40" rows="50">'.$item['image'].'</textarea>';


         $price = $product->find('span', 0)->plaintext;
         $replaceSpace = str_replace(' ', '', $price);
         $replaceRs = str_replace('Rs.', '', $replaceSpace);
         $replaceFloat = str_replace('.00', '', $replaceRs);
         $replaceRs = str_replace('Rs', '', $replaceFloat);
         $replaceComma = str_replace(',', '', $replaceRs);
         $replaceComma = str_replace(',', '', $replaceRs);
         $item['price'] = $replaceComma;

         $item['details'] = $product->find('a.product-name', 0)->plaintext;
         $item['link'] = $product->find('a.product_img_link', 0)->href;
         $ScrabedDeal[] = $item;
      }
      //style97
      $html = file_get_html('https://www.style97.com/?search_category=&s=' . $_search . '&search_posttype=product');
      // Find all article blocks
      foreach ($html->find('div.products-entry') as $product) {
         // echo $product;
         $item['image'] = $product->find('img', 0) . "<br>";
         $item['price'] = $product->find('span.woocommerce-Price-amount', 0) . "<br>";
         $item['details'] = $product->find('h4', 0)->plaintext . "<br>";
         $item['link'] = $product->find('a', 0)->href . "<br>";
         $ScrabedDeal[] = $item;
      }



      $num = sizeof($ScrabedDeal);
      $i = 0;
      while ($i < $num) {

         $insert = "INSERT INTO `products` (`product_name`, `product_price`, `product_img_url`, `product_link`, `created_by_email`, `created_by_user_id`, `created_on`, `search_keyword`) VALUES ('" . $ScrabedDeal[$i]['details'] . "', '" . $ScrabedDeal[$i]['price'] . "', '" . $ScrabedDeal[$i]['image'] . "', '" . $ScrabedDeal[$i]['link'] . "', 'admin@admin.com', '1', current_timestamp(), '" . $getsSearchQuery . "')";
         $result = mysqli_query($con, $insert);
         $i++;
         if ($result) {
            // echo 'inserted<br>';
            mysqli_query($con, "DELETE FROM `products` WHERE `products`.`product_name` = ''");
         } else {
            echo 'wrong query<br>';
         }
      }
   }
}
