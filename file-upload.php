<?php
include_once "config.php";

$current_path = $_FILES['file']['tmp_name'];
$filename = $_FILES['file']['name'];
$new_path = dirname(__FILE__) . '/' . $filename;

move_uploaded_file($current_path, $new_path);

try {
    $db = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_passwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    if (!file_exists($new_path)) {
        throw new Exception("File $new_path not found!");
    }
    $f = fopen($new_path, 'r+');

    $data = array();
    while ($data[] = fgetcsv($f, 0, $delimiter)) {
    }

    if (empty($data)) {
        throw new Exception("Empty data. Check the source file.");
    }
    $i = 0;
    foreach ($data as $entry => $value) {


        if ($i == 0) {
            continue;
        }
        if (!is_array($entry) || empty($entry[0])) {
            continue;
        }

        $i++;

        print_r($entry);

        $sql = "UPDATE 
        `pf_products` 
        SET 
        `price` = '$entry[1]', `price_opt1` = '$entry[1]', `price_opt2` = '$entry[1]', `price_opt3` = '$entry[1]', `price_opt4` = '$entry[1]',
        `price_dealer` = '$entry[6]', 
        `price_sale`   = '$entry[7]', 
        `price_pack`   = '$entry[8]', 
        `price_cost`   = '$entry[9]', 
        `50g`          = '$entry[10]', 
        `100g`         = '$entry[11]', 
        `500g`         = '$entry[12]', 
        `5kg`          = '$entry[13]'
        WHERE 
        `pf_products`.`product_id` = $entry[0]";
        $affectedRowsNumber = $db->exec($sql);

        //echo "Обновлено строк: $affectedRowsNumber";
    }
    $i--;
    print "\n\n $i rows were successfully processed";
} catch (Exception $e) {
    print "Error: " . $e->getMessage();
}

?>
<a href="/">назад</a>