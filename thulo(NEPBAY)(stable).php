<?php
include './lib/simple_html_dom.php';
$html = file_get_html('https://thulo.com/search/?subcats=Y&pcode_from_q=Y&pshort=Y&pfull=Y&pname=Y&pkeywords=Y&search_performed=Y&cid=0&q=laptop&security_hash=8eb95d5942d0e92e5f76915a3c85c84e');
// Find all  blocks
foreach ($html->find('div[class=et-column4 et-grid-item-wrapper]') as $product) {
    // echo $product;
    $data = $product->find('img', 0);
    $doc = str_get_html($data);
    $item['image'] = $doc->find('img', 0)->getAttribute('data-src');
   //in this one pass as parameter beacuse ther two class with name name in object to access second one i passed 1 as aray start from 0
    $price = $product->find('span.ty-price-num', 1)->plaintext;
    $cp = str_replace(',', '', $price);
    $item['price'] = str_replace('रू', '', $cp);
    $item['details'] = $product->find('a.product-title', 0)->plaintext;
    $item['link'] = $product->find('a.product-title', 0)->href;
    $ScrabedDeal[] = $item;
}
print_r($ScrabedDeal[1]);
// echo'
// <textarea name="" id="" cols="30" rows="10">'.$ScrabedDeal[1]['image'].'</textarea>
// <textarea name="" id="" cols="30" rows="10">'.$ScrabedDeal[1]['price'].'</textarea>
// <textarea name="" id="" cols="30" rows="10">'.$ScrabedDeal[1]['details'].'</textarea>
// <textarea name="" id="" cols="30" rows="10">'.$ScrabedDeal[1]['link'].'</textarea>
// ';
