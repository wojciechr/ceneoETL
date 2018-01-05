<?php
require_once('lib/simple_html_dom.php');
require_once('db.php');

$url = $_GET['url'];
$type = $_GET['type'];

$content = file_get_contents($url);

if($type == 'get'){
    echo json_encode(htmlspecialchars($content));
    exit;
}

$html = str_get_html($content);
$ret = $html->find('ol li');
$product = $html->find('.product-name', 0)->plaintext;
$comments = [];
$i = 0;
foreach($ret as $li) {
    $class = $li->attr['class'];
    if (strpos($class, 'js_product-review') !== false) {
        $user = $li->find('div.reviewer-name-line', 0)->plaintext;
        $text = $li->find('p.product-review-body', 0)->plaintext;
        $stars = $li->find('span.review-score-count', 0)->plaintext;
        $time = $li->find('span.review-time time', 0)->plaintext;
        $pros = $li->find('div.pros-cell ul', 0)->plaintext;
        $cons = $li->find('div.cons-cell ul', 0)->plaintext;
        $recommended = $li->find('em.product-recommended', 0)->plaintext;

        if (!empty($user))
            $comments[$i]['name'] = $user;
        if (!empty($text))
            $comments[$i]['text'] = $text;
        if (!empty($stars))
            $comments[$i]['stars'] = $stars;
        if (!empty($time))
            $comments[$i]['time'] = $time;
        if (!empty($pros))
            $comments[$i]['pros'] = $pros;
        if (!empty($cons))
            $comments[$i]['cons'] = $cons;
        if (!empty($recommended))
            $comments[$i]['recommended'] = $recommended;

        $comments[$i]['product'] = $product;
        if (!empty($user))
            $i++;
    }
}

if($type == 'list') {
    echo json_encode($comments);
    exit;
}

if($type == 'save') {
    $hash = generateRandomString(32);
    $query = "INSERT INTO products (name, hash) VALUES ('$product', '$hash')";
    $mysqli->query($query);
    $productId = $mysqli->insert_id;

    foreach($comments as $comment){
        $name = $comment['name'];
        $text = $comment['text'];
        $stars = $comment['stars'];
        $time = $comment['time'];
        $pros = $comment['pros'];
        $cons = $comment['cons'];
        $recommended = $comment['recommended'];

        $hash1 = generateRandomString(32);
        $query = "INSERT INTO `comments`(`product_hash`, `user`, `comment`, `stars`, `recommended`, `date`, `pros`, `cons`, `hash`) VALUES ('$hash','$name','$text','$stars','$recommended','$time','$pros','$cons','$hash1');";
        $mysqli->query($query);
    }

    echo json_encode($hash);
    exit;
}


function generateRandomString($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

