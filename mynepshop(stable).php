
<?php
include './lib/simple_html_dom.php';
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
    $sastodealScrape[] = $item;
}
print_r($sastodealScrape);


?>