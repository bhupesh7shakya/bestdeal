<?php
include './lib/simple_html_dom.php';
$html = file_get_html('https://www.sastodeal.com/catalogsearch/result/?q=laptop');
// Find all  blocks
foreach($html->find('div.product-item-info') as $product) {
// echo $product;
   $item['image']    = $product->find('img.product-image-photo[src]', 0)."<br>";
   $item['price']= $product->find('span.price', 0)."<br>";
  $item['details'] = $product->find('a.product-item-link', 0)->plaintext."<br>";
  $item['link'] = $product->find('a.product-item-link', 0)->href."<br>";
  $sastodealScrape[]=$item;
}
// echo var_dump($item['image']);
// print_r($item['image']);
print_r($sastodealScrape);


?>