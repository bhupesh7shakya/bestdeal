
<?php
echo 'this is scrapy';
//removing the execution time limit
set_time_limit(-1);

//sastodeal
include './lib/simple_html_dom.php';
require './partials/dbcon.php';
// echo 'this is scrapy';
$getsSearchQuery = $_GET['q'];
// $getsSearchQuery = 'machine gun';
function filterPrice($price)
{
   $replaceRu = str_replace('रू', '', $price);
   $replaceSpace = str_replace(' ', '', $replaceRu);
   $replaceFloat = str_replace('.00', '', $replaceSpace);
   $replaceRs = str_replace('Rs ', '', $replaceFloat);
   $replaceComma = str_replace(',', '', $replaceRs);
   $FilteredPrice = $replaceComma;
   return $FilteredPrice;
}

// $cate = array("Cheese","Storage device","Speaker", "Book", "Earphone", "Headphone", "Phones", "Washing Machine", "Gaming", "Rice Cooker", "Television", "Laptop", "Desktop", "Vaccum", "Camera", "Tablet", "Projector", "Graphics card", "Home Automation", "Cooling pad");

// echo sizeof($cate) . 'size <br>';
// foreach ($cate as $getsSearchQuery) {





   if ($con) {
      $sql = "SELECT * FROM `products` WHERE `product_name` LIKE '%" . $getsSearchQuery . "%' OR `search_keyword` LIKE '%" . $getsSearchQuery . "%'";
      $result = mysqli_query($con, $sql);
      if ($result) {
         if (mysqli_num_rows($result) != 0) {
            echo 'data found in ddatabse';
            while ($rows = mysqli_fetch_assoc($result)) {
               // echo 'data already exist';
               // echo $rows['product_name'] . ' ' . $rows['product_price'] . ' ' . $rows['product_img_url'] . ' ' . $rows['product_link'];
            }
         } else {
            // echo '<br>scraping '.$getsSearchQuery;
            echo 'scraping mode';
            $_search = str_replace(' ', '+', $getsSearchQuery);
            $html = file_get_html('https://www.sastodeal.com/catalogsearch/result/?q=' . $_search);
            if ($html) {
               // Find all  blocks
               foreach ($html->find('div.product-item-info') as $product) {
                  // echo $product;
                  $image = $product->find('img.product-image-photo[src]', 0);
                  if (isset($image)) {
                     $item['image'] = $image->src;
                  }
                  // $price
                  $price = $product->find('span.price', 0);
                  if (isset($price)) {
                     $pric = $price->plaintext;
                     $cp = str_replace(',', '', $pric);
                     $item['price'] = str_replace('रू', '', $cp);
                  }

                  $details = $product->find('a.product-item-link', 0)->plaintext;
                  if (isset($details)) {
                     $item['details'] = $details;
                  }
                  $link = $product->find('a.product-item-link', 0)->href;
                  if (isset($link)) {
                     $item['link'] = $link;
                  }
                  
                  $ScrabedDeal[] = $item;
               }
            }

            //durbarmart
            $html = file_get_html('https://durbarmart.com/search?q=' . $_search);
            // Find all article blocks
            if ($html) {
               foreach ($html->find('div.products') as $product) {
                  // echo $product;
                  $image = $product->find('img', 0);
                  if (isset($image->src)) {
                     $item['image'] = $image;
                  }
                  $price = $product->find('div[class=product_price text-right pull-right]', 0);
                  if (isset($price->plaintext)) {
                     $item['price'] = filterPrice($price);
                  }
                  $details = $product->find('h5', 0);
                  if (isset($details->plaintext)) {
                     $item['details'] = $details;
                  }
                  $link = $product->find('a', 0);
                  if (isset($link->href)) {
                     $item['link'] = "https://durbarmart.com" . $link;
                  }
                  $ScrabedDeal[] = $item;
               }
            }

            //muncha
            $html = file_get_html('https://muncha.com/Shop/Search?merchantID=1&CategoryID=0&q=' . $_search);
            // Find all article blocks
            if (isset($html)) {
               foreach ($html->find('div.product') as $product) {
                  // echo $product;
                  $image = $product->find('img.product-img-primary', 0)->src;
                  if (isset($image)) {
                     $item['image'] = $image;
                  }
                  $price = $product->find('span.product-caption-price-new', 0)->plaintext;
                  if (isset($price)) {
                     $replaceSpace = str_replace(' ', '', $price);
                     $replaceRs = str_replace('.00', '', $replaceSpace);
                     $replaceFloat = str_replace('.', '', $replaceRs);
                     $replaceRs = str_replace('Rs', '', $replaceFloat);
                     $replaceComma = str_replace(',', '', $replaceRs);
                     $replaceComma = str_replace(',', '', $replaceRs);
                     $item['price'] = $replaceComma;
                  }
                  $details = $product->find('h5.product-caption-title-sm', 0)->plaintext;

                  if (isset($details)) {
                     $item['details'] = $details;
                  }
                  $link = $product->find('a', 0)->href;
                  if (isset($link)) {
                     $item['link'] = "https://muncha.com/" . $link;
                  }
                  $ScrabedDeal[] = $item;
               }
            }
            // is on matanatice
            // mynepshop
            $html = file_get_html('https://myshopnepal.com/?s=' . $_search . '&post_type=product&v=8bc2afe7028c');
            /// Find all article blocks
            if (isset($html)) {
               foreach ($html->find('div.prod-row') as $product) {
                  // echo $product;
                  $image = $product->find('img', 0);
                  if (isset($image)) {
                     $doc = str_get_html($image);
                     $item['image'] = $doc->find('img', 0)->getAttribute('data-src');
                     //basically it was store in $data in this website while finding src of image it save data-src which causes the no photo output
                     //for example: link of this website is <img class="r" data-src="link" > while saving from scrape so to remove or replace it from null w
                     // we have used string replace fucntion which first takes str_replace(find,replace,string,count)
                  }


                  $price = $product->find('span', 0)->plaintext;
                  if (isset($price)) {
                     $replaceSpace = str_replace(' ', '', $price);
                     $replaceRs = str_replace('Rs.', '', $replaceSpace);
                     $replaceFloat = str_replace('.00', '', $replaceRs);
                     $replaceRs = str_replace('Rs', '', $replaceFloat);
                     $replaceComma = str_replace(',', '', $replaceRs);
                     $replaceComma = str_replace(',', '', $replaceRs);
                     $item['price'] = $replaceComma;
                  }

                  $details = $product->find('a.product-name', 0)->plaintext;
                  if (isset($details)) {
                     $item['details'] = $details;
                  }

                  $link = $product->find('a.product_img_link', 0)->href;
                  if (isset($link)) {
                     $item['link'] = $link;
                  }
                  $ScrabedDeal[] = $item;
               }
            }

            //style97
            $html = file_get_html('https://www.style97.com/?search_category=&s=' . $_search . '&search_posttype=product');
            // Find all article blocks
            if ($html) {
               foreach ($html->find('div.products-entry') as $product) {
                  // echo $product;
                  $image = $product->find('img', 0)->src;
                  if (isset($image)) {
                     $item['image'] = $image;
                  }
                  $price = $product->find('span.woocommerce-Price-amount', 0)->plaintext;
                  if (isset($price)) {
                     $item['price'] = filterPrice($price);
                  }
                  $details = $product->find('h4', 0)->plaintext;
                  if (isset($details)) {
                     $item['details'] = $details;
                  }
                  $link = $product->find('a', 0)->href;
                  if (isset($link)) {
                     $item['link'] = $link;
                  }
                  $ScrabedDeal[] = $item;
               }
            }

            // daraz
            $html = file_get_html('https://www.daraz.com.np/catalog/?q=' . $_search . '&_keyori=ss&from=input&spm=a2a0e.11779170.search.go.287d2d2b69285m');
            // Find all  blocks
            if ($html) {
               $count = 0;
               foreach ($html->find('script') as $product) {
                  if ($count == 3) {

                     $sfsdf = str_replace('<script>', '', $product);
                     $s = str_replace('</script>', '', $sfsdf);
                     if (strstr($s, 'window.pageData')) {
                        $filtering = str_replace('window.pageData=', '', $s);
                        $items = json_decode($filtering, true);
                        $length = sizeof($items['mods']['listItems']);
                        // echo $length;
                        for ($i = 0; $i < $length; $i++) {
                           $item['name'] = $items['mods']['listItems'][$i]['name'];
                           $item['image'] = $items['mods']['listItems'][$i]['image'];
                           $item['price'] = $items['mods']['listItems'][$i]['price'];
                           $item['productUrl'] = $items['mods']['listItems'][$i]['productUrl'];
                           $ScrabedDeal[] = $item;
                        }
                     }
                  }

                  $count++;
               }
            }

            //choicemandu
            $html = file_get_html('https://choicemandu.com/index.php?category_id=0&search=' . $_search . '&submit_search=&route=product%2Fsearch');
            // Find all  blocks
            if (isset($html)) {
               foreach ($html->find('div.product-item-container') as $product) {
                  // echo $product;
                  if ($product->find('img', 4)) {
                     $item['image'] = $product->find('img', 4)->getAttribute('data-src');
                  }
                  //   // $price
                  $price = $product->find('span.price-new', 0)->plaintext;
                  if (isset($price)) {
                     $cp = str_replace(',', '', $price);
                     $item['price'] = str_replace('रू', '', $cp);
                  }
                  $details = $product->find('h2.product-name-edited', 0)->plaintext;
                  if (isset($details)) {
                     $item['details'] = $details;
                  }

                  $link = $product->find('a', 0)->href;
                  if (isset($link)) {
                     $item['link'] = $link;
                  }
                  $ScrabedDeal[] = $item;
               }
            }

            //thulo (nepbay)
            $html = file_get_html('https://thulo.com/search/?subcats=Y&pcode_from_q=Y&pshort=Y&pfull=Y&pname=Y&pkeywords=Y&search_performed=Y&cid=0&q=' . $_search . '&security_hash=8eb95d5942d0e92e5f76915a3c85c84e');
            // Find all  blocks
            if (isset($html)) {
               foreach ($html->find('div[class=et-column4 et-grid-item-wrapper]') as $product) {
                  // echo $product;
                  $image = $product->find('img', 0);
                  if (isset($image)) {
                     $doc = str_get_html($image);
                     $item['image'] = $doc->find('img', 0)->getAttribute('data-src');
                  }
                  //in this one pass as parameter beacuse ther two class with name name in object to access second one i passed 1 as aray start from 0
                  $price = $product->find('span.ty-price-num', 1)->plaintext;
                  if (isset($price)) {
                     $cp = str_replace(',', '', $price);
                     $item['price'] = str_replace('रू', '', $cp);
                  }
                  $details = $product->find('a.product-title', 0)->plaintext;
                  if (isset($details)) {
                     $item['details'] = $details;
                  }
                  $link = $product->find('a.product-title', 0)->href;
                  if (isset($link)) {
                     $item['link'] = $link;
                  }
                  $ScrabedDeal[] = $item;
               }
            }
            // for the unlimited memory access
            ini_set('memory_limit', '-1');
            print_r($ScrabedDeal);
            if ($ScrabedDeal == null) {
               echo 'no product found!!';
            } else {
               $num = sizeof($ScrabedDeal);
               $i = 0;
               while ($i < $num) {

                  $insert = "INSERT INTO `products` (`product_name`, `product_price`, `product_img_url`, `product_link`, `created_by_email`, `created_by_user_id`, `created_on`, `search_keyword`) VALUES ('" . $ScrabedDeal[$i]['details'] . "', '" . $ScrabedDeal[$i]['price'] . "', '" . $ScrabedDeal[$i]['image'] . "', '" . $ScrabedDeal[$i]['link'] . "', 'admin@admin.com', '1', current_timestamp(), '" . $getsSearchQuery . "')";
                  $result = mysqli_query($con, $insert);
                  // echo '<br>'.$i;
                  $i++;
                  if ($result) {
                     echo 'inserted<br>';
                     
                 
                     mysqli_query($con, "DELETE FROM `products` WHERE `product_price` = '' OR product_name='' or product_img_url='' OR product_link=''");

                  } else {
                     // echo 'wrong query<br>';
                  }
               }
            }
         }
      } else {
         echo 'query milena wrong';
      }

      mysqli_query($con, "DELETE FROM `products` WHERE `product_price` = '' OR product_name='' or product_img_url='' OR product_link=''");
   } else {
      echo  'not connected to databdae';
   }
   // echo'scraping finish of '.$getsSearchQuery;
// }
?>
