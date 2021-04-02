<?php
    include './lib/simple_html_dom.php';
 
function daraz($links, $page, $cate)
{
    $failed=0;
    $total=0;
    echo "Scraping $cate \n";

    for ($i = 1; $i <= $page; $i++) {
        $linkss = $links.$i;
        // echo "$linkss";
        $html = file_get_html($linkss);
        if(isset($html)) {
            $count = 0;
            foreach ($html->find('script') as $product) {
               if ($count == 3) {

               $total=($i/$page)*100;
               $per=substr($total,0,5);
               echo " $per% completed    \r";
           
                  $sfsdf = str_replace('<script>', '', $product);
                  $s = str_replace('</script>', '', $sfsdf);
                  if (strstr($s, 'window.pageData')) {
                     $filtering = str_replace('window.pageData=', '', $s);
                     $items = json_decode($filtering, true);
                     $length = sizeof($items['mods']['listItems']);
                     // echo $length;
                     for ($j = 0; $j < $length; $j++) {
                        $name= $items['mods']['listItems'][$j]['name'];
                        $image=$items['mods']['listItems'][$j]['image'];
                        $price=$items['mods']['listItems'][$j]['price'];
                        $link= $items['mods']['listItems'][$j]['productUrl'];
                        $item['cate']=$cate;
                        $item['source']="daraz";
                        if(isset($name)){
                           $item['name']=$name;

                        }
                        else{
                           $item['name']='nothing';
                        }
                       if(isset($image)){
                        $item['image'] = $image;
                           
                        }
                        else{
                           $item['image']='nothing';
                        }
                      if(isset($price)){
                        $item['price'] = $price;
                           
                        }
                        else{
                           $item['price']='nothing';
                        }
                      if(isset($link)){
                        $item['link'] =$link;
                           
                        }
                        else{
                           $item['link']='nothing';
                        }
                        
                        include 'partials/dbcon.php';

            $sql="INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_img_url`,
             `product_link`, `created_by_email`, `created_by_user_id`, `created_on`, `search_keyword`, `source`) 
            VALUES (NULL, '".$item['name']."', '".$item['price']."', '".$item['image']."', '". $item['link']."',
             'admin@admin.com', '1', current_timestamp(), '".$item['cate']."', '". $item['source']."');
            ";
            // echo $sql.'<br>';
            if(mysqli_query($con,$sql)){
            //   echo $i.$cate;
            //   echo 'true';
            // sleep(3);
            echo $item['name']." inserted     \n\r";

            }
            else{
              echo " $failed failed    \r";
              $failed++;
            }
                        // $ScrabedDeal[] = $item;
                     }
                  }
               }

               $count++;
           
            }
            // print_r($ScrabedDeal);
         }       
        }        
        echo "\n";

    }
$myfile = fopen("daraz.txt", "r") or die("Unable to open file!");
while (!feof($myfile)) {
    $para = fgets($myfile);
    $link = explode(",", $para);
    
    // print_r($link[0] . "," . $link[1] . "," . $link[2] );
    sleep(15);
    daraz($link[0],$link[1],$link[2]);
}
fclose($myfile);
?>