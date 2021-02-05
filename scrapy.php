<?php
//sastodeal
include './lib/simple_html_dom.php';
$html = file_get_html('https://www.sastodeal.com/catalogsearch/result/?q=laptop');
// Find all  blocks
foreach($html->find('div.product-item-info') as $product) {
// echo $product;
   $item['image']    = $product->find('img.product-image-photo[src]', 0);
   $item['price']= $product->find('span.price', 0);
  $item['details'] = $product->find('a.product-item-link', 0)->plaintext;
  $item['link'] = $product->find('a.product-item-link', 0)->href;
  $ScrabedDeal[]=$item;
}
//durbarmart
$html = file_get_html('https://durbarmart.com/search?q=redmi+9');
// Find all article blocks
foreach($html->find('div.products') as $product) {
// echo $product;
   $item['image'] = $product->find('img', 0);
   $item['price']= $product->find('div.product_price', 0);
   $item['details'] = $product->find('h5', 0)->plaintext;
   $link = $product->find('a', 0)->href;
   $item['link']="https://durbarmart.com/products".$link;
   $ScrabedDeal[]=$item;
}
//muncha
$html = file_get_html('https://muncha.com/Shop/Search?merchantID=1&CategoryID=0&q=pants');
// Find all article blocks
foreach($html->find('div.product') as $product) {
// echo $product;
   $item['image'] = $product->find('img.product-img-primary', 0);
   $item['price']= $product->find('span.product-caption-price-new', 0);
   $item['details'] = $product->find('h5.product-caption-title-sm', 0)->plaintext;
  $link = $product->find('a', 0)->href;
   $item['link']="https://muncha.com/".$link;
  $ScrabedDeal[]=$item;
}
//mynepshop
$html = file_get_html('https://mynepshop.com/search?id_category=0&fc=module&module=jmsadvsearch&controller=search&order=product.position.asc&search_query=watch');
// Find all article blocks
foreach ($html->find('div.prod-row') as $product) {
    // echo $product;
    $data = $product->find('img', 0) . "<br>";
    //basically it was store in $data in this website while finding src of image it save data-src which causes the no photo output
    //for example: link of this website is <img class="r" data-src="link" > while saving from scrape so to remove or replace it from null w
    // we have used string replace fucntion which first takes str_replace(find,replace,string,count)
    // echo '<textarea name="" id="" cols="30" rows="10">'.$data.'</textarea>'; this is just for debuging
    $item['image'] = str_replace("data-", "", $data);
    // echo '<textarea name="" id="" cols="40" rows="50">'.$item['image'].'</textarea>';


    $item['price'] = $product->find('span', 0) . "<br>";
    $item['details'] = $product->find('a.product-name', 0)->plaintext . "<br>";
    $item['link'] = $product->find('a.product_img_link', 0)->href . "<br>";
    $ScrabedDeal[] = $item;
}
$html = file_get_html('https://www.style97.com/?search_category=&s=pants&search_posttype=product');
// Find all article blocks
foreach($html->find('div.products-entry') as $product) {
// echo $product;
   $item['image'] = $product->find('img', 0);
   $item['price']= $product->find('span.woocommerce-Price-amount', 0);
   $item['details'] = $product->find('h4', 0)->plaintext;
   $item['link'] = $product->find('a', 0)->href;
   $ScrabedDeal[]=$item;
}
if($ScrabedDeal!=null){
// header('location:searchResult.php');
}
?>