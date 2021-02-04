<?php
include './lib/simple_html_dom.php';
$html = file_get_html('https://durbarmart.com/search?q=redmi+9');
// Find all article blocks
foreach($html->find('div.products') as $product) {
// echo $product;
   $item['image'] = $product->find('img', 0)."<br>";
   $item['price']= $product->find('div.product_price', 0)."<br>";
   $item['details'] = $product->find('h5', 0)->plaintext."<br>";
   $link = $product->find('a', 0)->href."<br>";
   $item['link']="https://durbarmart.com/products/".$link;
   $sastodealScrape[]=$item;
}
print_r($sastodealScrape);
?>