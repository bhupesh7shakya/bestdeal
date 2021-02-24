<?php
include './lib/simple_html_dom.php';
$html = file_get_html('https://choicemandu.com/index.php?category_id=0&search=mobile&submit_search=&route=product%2Fsearch');
// Find all  blocks
foreach($html->find('div.product-item-container') as $product) {
// echo $product;
if($product->find('img', 4)){
    $item['image']= $product->find('img', 4)->getAttribute('data-src');

}
//   // $price
   $price= $product->find('span.price-new', 0)->plaintext;
   $cp=str_replace(',','',$price);
  $item['price']=str_replace('रू','',$cp);
  $item['details'] = $product->find('h2.product-name-edited', 0)->plaintext;
  $item['link'] = $product->find('a', 0)->href;
  $ScrabedDeal[]=$item;
  
}
print_r($ScrabedDeal);
// echo'
// <textarea name="" id="" cols="30" rows="10">'.$ScrabedDeal[1]['image'].'</textarea>
// <textarea name="" id="" cols="30" rows="10">'.$ScrabedDeal[1]['price'].'</textarea>
// <textarea name="" id="" cols="30" rows="10">'.$ScrabedDeal[1]['details'].'</textarea>
// <textarea name="" id="" cols="30" rows="10">'.$ScrabedDeal[1]['link'].'</textarea>
// ';


?>

