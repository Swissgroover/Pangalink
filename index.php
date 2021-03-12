<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>tooted</title>
</head>

<body>
    <?php
    require_once 'autoload.php';

    $msg = filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_STRING);
    $paymentAction = filter_input(INPUT_GET, 'payment_action', FILTER_SANITIZE_STRING);


    if (isset($msg) && !empty($msg)) {
        echo '<p>message: ' . $msg . '</p>';
    }

    if (isset($paymentAction) && !empty($paymentAction)) {
        echo '<p>message:' . $paymentAction . '</p>';
        unset($_SESSION['cart']);
    }

    ?>
    <div style="
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    align-content: center;
    justify-content: space-evenly;
    ">
        <?php if (!empty($products)) : foreach ($products as $product) {
        ?><p>
                    <?php echo $product['name']; ?> <br>
                    <?php echo $product['price']; ?> <br>
                    <img src="<?php echo $product['image']; ?>"><br>
                    <a href="add.php?id=<?php echo $product['id']; ?>">Add to cart</a>
                </p>
        <?php }
        endif; ?>
    </div><br>
    <div style="
    background-color: #27D0EA;
    color: white;
    padding: 15px 32px;
    text-align: center;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    ">
        <a href="cart.php">CART</a>
    </div>
</body>

</html>