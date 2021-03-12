<?php
require_once 'autoload.php';


echo '<pre>';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!isset($products[$id])) {
    exit('Product missing');
}

if (!isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id] = 0;
}

$_SESSION['cart'][$id]++;

?>
<meta http-equiv="refresh" content="0;url=index.php??msg=added_to_cart" />
<?php
exit();
