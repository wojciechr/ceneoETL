<?php


require_once('db.php');
$hash = $mysqli->real_escape_string($_GET['hash']);;

if(empty($hash)){
    echo 'Nieprawidłowy HASH!';
    exit;
}

$query = 'SELECT comment FROM comments WHERE product_hash = "'.$hash.'"';
$result = $mysqli->query($query);
$comment = $result->fetch_object();
print_r($comment->comment);



// przypisanie zmniennej $file nazwy pliku 
$file = "komentarz.txt"; 


header('Content-Disposition: attachment; filename="' . $file . '"');

// uchwyt pliku, otwarcie do dopisania 
$fp = fopen($file, "w"); 

// zapisanie danych do pliku 
fwrite($fp, $result); 


// zamknięcie pliku 
fclose($fp); 

?>