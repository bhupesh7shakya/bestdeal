//bholi colllage ma debug garne
<?php
    include './lib/simple_html_dom.php';
 
function mynepshop($links, $page, $cate)
{
    $failed=0;
    $total=0;
    echo "Scraping $cate \n";

    for ($i = 1; $i <= $page; $i++) {
        $linkss = $links . $i;
        $html = file_get_html($linkss);

        if($html) {
            foreach ($html->find('div.prod-row') as $product) {
               // echo $product;
               $image = $product->find('img', 0);
               if (isset($image)) {
                  $doc = str_get_html($image);
                  $item['image'] = $doc->find('img', 0)->getAttribute('data-src');
                  //basically it was store in $data in this website while finding src of image it save data-src which causes the no photo output
                  //for example: link of this website is <img class="r" data-src="link" > while saving from scrape so to remove or replace it from nothing w
                  // we have used string replace fucntion which first takes str_replace(find,replace,string,count)
               }
               else{
                  $item['image']='nothing';
               }


               $price = $product->find('span', 0);
               if (isset($price)) {
                  $replaceSpace = str_replace(' ', '', $price->plaintext);
                  $replaceRs = str_replace('Rs.', '', $replaceSpace);
                  $replaceFloat = str_replace('.00', '', $replaceRs);
                  $replaceRs = str_replace('Rs', '', $replaceFloat);
                  $replaceComma = str_replace(',', '', $replaceRs);
                  $replaceComma = str_replace(',', '', $replaceRs);
                  $item['price'] = $replaceComma;
               }
               else{
                  $item['price']='nothing';
               }

               $details = $product->find('a.product-name', 0);
               if (isset($details)) {
                  $item['details'] = $details->plaintext;
               }
               else{
                  $item['details']='nothing';
               }

               $link = $product->find('a.product_img_link', 0);
               if (isset($link)) {
                  $item['link'] = $link->href;
               }
               else{
                  $item['link']='nothing';
               }
               $ScrabedDeal[] = $item;
               print($ScrabedDeal);
            
            }
         }
        
        echo "\n";

        }
    }
$myfile = fopen("files/mynepshop.txt", "r") or die("Unable to open file!");
while (!feof($myfile)) {
    $para = fgets($myfile);
    $link = explode(",", $para);
    
    // print_r($link[0] . "," . $link[1] . "," . $link[2] );

    mynepshop($link[0],$link[1],$link[2]);
}
fclose($myfile);
?>