<?php
include './lib/simple_html_dom.php';
$html = file_get_html('https://muncha.com/Shop/Search?merchantID=1&CategoryID=0&q=pants');
// Find all article blocks
foreach($html->find('div.product') as $product) {
// echo $product;
   $item['image'] = $product->find('img.product-img-primary', 0)."<br>";
   $item['price']= $product->find('span.product-caption-price-new', 0)."<br>";
   $item['details'] = $product->find('h5.product-caption-title-sm', 0)->plaintext."<br>";
  $link = $product->find('a', 0)->href;
   $item['link']="https://muncha.com/".$link."<br>";
  $sastodealScrape[]=$item;
}
print_r($sastodealScrape);
?>