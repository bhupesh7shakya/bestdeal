<?php
include './lib/simple_html_dom.php';
$html = file_get_html('https://www.style97.com/?search_category=&s=pants&search_posttype=product');
// Find all article blocks
foreach($html->find('div.products-entry') as $product) {
// echo $product;
   $item['image'] = $product->find('img', 0)."<br>";
   $item['price']= $product->find('span.woocommerce-Price-amount', 0)."<br>";
   $item['details'] = $product->find('h4', 0)->plaintext."<br>";
   $item['link'] = $product->find('a', 0)->href."<br>";
   $sastodealScrape[]=$item;
}
print_r($sastodealScrape);
?>