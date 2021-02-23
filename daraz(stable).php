<?php
include './lib/simple_html_dom.php';
$html = file_get_html('https://www.daraz.com.np/catalog/?q=mobile&_keyori=ss&from=input&spm=a2a0e.11779170.search.go.287d2d2b69285m');
// Find all  blocks
$count = 0;
foreach ($html->find('script') as $product) {
    if ($count == 3) {

        $sfsdf = str_replace('<script>', '', $product);
        $s = str_replace('</script>', '', $sfsdf);
        if (strstr($s, 'window.pageData')) {
            $t = str_replace('window.pageData=', '', $s);
            $items = json_decode($t, true);
            $length=sizeof($items['mods']['listItems']);
            echo $length;
            for($i=0;$i<$length;$i++){
                $a['name'] = $items['mods']['listItems'][$i]['name'];
            $a['image'] = $items['mods']['listItems'][$i]['image'];
            $a['price'] = $items['mods']['listItems'][$i]['price'];
            $a['productUrl'] = $items['mods']['listItems'][$i]['productUrl'];
            $b[]=$a;
        }
            
        }
      print_r($b);
        // print_r($items[$i]);
        // print_r($$items['mods']['list$items'][$i]['name']);
        // echo'
        // <textarea name="" id="" cols="30" rows="10">'.$t.'</textarea>
        // ';
    }

    $count++;
}
