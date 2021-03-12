<?php
require_once 'autoload.php';

$total = 0;
$paymentAction = filter_input(INPUT_GET, 'payment_action', FILTER_SANITIZE_STRING);
if (isset($paymentAction) && !empty($paymentAction)) {
    echo '<p>message: ' . $paymentAction . '</p>';
}

?>
<table border="1" width="100%">
    <tr>
        <th width="20%">Image</th>
        <th width="55%">Name</th>
        <th width="20%">Price</th>
        <th width="5%"></th>
    </tr>
    <?php if (!empty($_SESSION['cart'])) : foreach ($_SESSION['cart'] as $id => $amount) { ?>
            <?php $product = $products[$id]; ?>
            <?php $rowTotal = $product['price'] * $amount; ?>
            <?php $total += $rowTotal; ?>

            <tr>
                <td><img src="<?php echo $product['image']; ?>"></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $rowTotal; ?></td>
                <td><a href="delete.php?id=<?php echo $product['id']; ?>"></td>

            </tr>
    <?php }
    endif; ?>
    <tr>
        <td></td>
        <td></td>
        <td><?php echo $total; ?>
        <td>

    </tr>
</table>


<?php


$private_key = openssl_pkey_get_private(
    "-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEA1YZO+FskT5wHkjwYNfb47huzt5s4GHnt5VzRVbPHOMkMqEuL
8/XWJg8fEAjHepLGx3XFy2i1eZK2y9u1wjn7r/juErNMipH4ryi4DlCkmxxweWzY
oKN4TprCs+eAZ8z7MAec/755F21AMjZ8zIpfBOBGPLYqyvowGwXKVKCNUNoECj2Z
j6OZagfKdXCgHOvDeL2PABLJPyAUfxkSI4vnA5e603DVEYoNfwJPWyCZvyLM4pLg
Va4KSHUtec0ANWNqcmU1vPKtifRhN91ddMd2WWe2SYHyK2ieTNRO5B55pPGrrJOx
xOkifQydlM8asAoIPMVbWwV1zMfrhqLab63HhQIDAQABAoIBAGMUAUzIrd6q3fCD
JhDUWsnR3OCTi8H/wd2t5gzIcObuk4r8EyLOreHXHmjIShecR9SB15f9LEgPRfbu
KjbHxPvwnDfdLuUVurk8QbuSu+6lkaMmWJahg8+ljDcCcti3is7MmZMqBPJT5Xfn
RJ18j36puq2tMcohsXS4iRwfq7MZvVefsmoSPZ024dBNUHMwtWsMM/3H/+2Nzv1I
BzKSWl1a/Ch1e1zzaJ2lZXybHMEufXNYM31JAuvpgIVSRymRi2mbprWkj9/GWF3i
b+IPUBs/eWJoRKCpgpMxngHbrnI6P60Hhc5gj4bE7GR9TnmNkqBw1srRjlS5ozne
Fd5ouHkCgYEA+b00YRdNiOUpY596qhy2R7VLvLxqXqaWUVwkgWADnMAYUnvIy3Bo
BO0iUiJsCswslQLfSVI6eEvvQQEsGktimC5BcLDqmfjoxawcgGRt7nP1Q0IgARar
ZwYhhYcCCwS2b+LzlyusZRhWT6X9dsygV99rdh5bz+U7xlC3dOVAc1sCgYEA2uCv
GBhlWtLIwhAsETz2W6h+EdKMxfAfyc+9jm9wAP5OC/+e+yV2PJ6ewTdJNr1k6dIm
qSrpgjg4157f3N/HB63MDGxTdTLxpPjy1h9+GTU9NO/DiNrWRnCi+9ga1IE2a0ol
SnuNIp7YUkPLrANeRbAkG+zNzac7Zch0Nnp2Bp8CgYBJMuzMXHEsY8bK3W6tt7ax
s/DcA/nFflxmwnQsu4CzjBZU7tU+09aZQwwhONekHo4eqvXZXtGmetNIoVhU6K2g
X0ZtCl3o/Wz0q2q7MzSJhNFpglMxHnzkuIZQxe6SXjI+/y1YrMNd6lE6DTQKgxWo
S+MKfwF4IP9xNC1hhORsKwKBgQDYJirD0NPG7YH0o6PhIiLoQWy+jP8YOhoqYkz/
7GzfjkPk9Xs66bPqCXsdtEtJE6AkiLRFO2t+fackyHCq3xLeMnPfkNqaUsTv9ilZ
65/LpRfcvyqKbBJPXcyWiMN2OGRVb9ODyp+GIPffxbPNG0Zt65S9Pw2+mfe+fEbH
xgfoYQKBgDVoPGgxrMKgE9wHu4IWuSYsgyvngKFGY1+SB8pIkq06ZgMPmvoFHVXM
O4HKg2Qq8M/9jwPvoaEdgoXT4cgVdwcLffVoE42T4DHja5TwhzffhXtUXaBHXMrI
MV6ksZLUtYTcMYpRAtMPph/ILckv7JNg6Dz/izQfYsS7dNhua07F
-----END RSA PRIVATE KEY-----"
);

// STEP 2. Define payment information
// ==================================

$fields = array(
    "VK_SERVICE"     => "1011",
    "VK_VERSION"     => "008",
    "VK_SND_ID"      => "uid13",
    "VK_STAMP"       => "12345",
    "VK_AMOUNT"      => "$total",
    "VK_CURR"        => "EUR",
    "VK_ACC"         => "EE152200221234567897",
    "VK_NAME"        => "Karl Gregor",
    "VK_REF"         => "1234561",
    "VK_LANG"        => "EST",
    "VK_MSG"         => "Makse selgitus",
    "VK_RETURN"      => "https://store.ta19rauniste.itmajakas.ee/?payment_action=success",
    "VK_CANCEL"      => "https://store.ta19rauniste.itmajakas.ee/cart.php?payment_action=cancel",
    "VK_DATETIME"    => "2021-03-10T12:35:03+0000",
    "VK_ENCODING"    => "utf-8",
);

// STEP 3. Generate data to be signed
// ==================================

// Data to be signed is in the form of XXXYYYYY where XXX is 3 char
// zero padded length of the value and YYY the value itself
// NB! Swedbank expects symbol count, not byte count with UTF-8,
// so use `mb_strlen` instead of `strlen` to detect the length of a string

$data = str_pad(mb_strlen($fields["VK_SERVICE"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_SERVICE"] .    /* 1011 */
    str_pad(mb_strlen($fields["VK_VERSION"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_VERSION"] .    /* 008 */
    str_pad(mb_strlen($fields["VK_SND_ID"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_SND_ID"] .     /* uid13 */
    str_pad(mb_strlen($fields["VK_STAMP"], "UTF-8"),   3, "0", STR_PAD_LEFT) . $fields["VK_STAMP"] .      /* 12345 */
    str_pad(mb_strlen($fields["VK_AMOUNT"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_AMOUNT"] .     /* 150 */
    str_pad(mb_strlen($fields["VK_CURR"], "UTF-8"),    3, "0", STR_PAD_LEFT) . $fields["VK_CURR"] .       /* EUR */
    str_pad(mb_strlen($fields["VK_ACC"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_ACC"] .        /* EE152200221234567897 */
    str_pad(mb_strlen($fields["VK_NAME"], "UTF-8"),    3, "0", STR_PAD_LEFT) . $fields["VK_NAME"] .       /* ÕIE MÄGER */
    str_pad(mb_strlen($fields["VK_REF"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_REF"] .        /* 1234561 */
    str_pad(mb_strlen($fields["VK_MSG"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_MSG"] .        /* Torso Tiger */
    str_pad(mb_strlen($fields["VK_RETURN"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_RETURN"] .     /* http://localhost/project/6048b286225f9c38ecb12b07?payment_action=success */
    str_pad(mb_strlen($fields["VK_CANCEL"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_CANCEL"] .     /* http://localhost/project/6048b286225f9c38ecb12b07?payment_action=cancel */
    str_pad(mb_strlen($fields["VK_DATETIME"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_DATETIME"];    /* 2021-03-10T11:51:37+0000 */

/* $data = "0041011003008005uid1300512345003150003EUR020EE152200221234567897009ÕIE MÄGER0071234561011Torso Tiger072http://localhost/project/6048b286225f9c38ecb12b07?payment_action=success071http://localhost/project/6048b286225f9c38ecb12b07?payment_action=cancel0242021-03-10T11:51:37+0000"; */

// STEP 4. Sign the data with RSA-SHA1 to generate MAC code
// ========================================================

openssl_sign($data, $signature, $private_key, OPENSSL_ALGO_SHA1);

/* t7nSrKNj+RimlIpQdrDRUh60llsPaK4CYbJ7g5fmstaHGid/5Hn4h+ydZhO3H5sWzDSdBPIAsNxGfLolJnzJTMAR0f6aC+13RSW0vWzzCQQACiMiRHe5fe2yn1FjYSHp1x7t0exhOt3ez4wfVG7i09wbVWEsonwSDbOg7k3083E6+S4Ss6rMISdr5BpCiS606XTp622Rn1/ipxWi6lujZWf6v4tkexUUEeIV4v5tPaRAuViOkDS1LkXCR7ta0QeV7ZbYlClvCYBycuOO9hn5yvyvXD0SJrWPIAmLMm+K/YHnz1KjquYBtacBbk7uG6cZlMJWBHcDfKVecxpkwz9J3g== */
$fields["VK_MAC"] = base64_encode($signature);

// STEP 5. Generate POST form with payment data that will be sent to the bank
// ==========================================================================
?>

<form method="post" action="http://localhost/banklink/swedbank">
    <!-- include all values as hidden form fields -->
    <?php foreach ($fields as $key => $val) : ?>
        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($val); ?>" />
    <?php endforeach; ?>

    <!-- draw table output for demo -->
    <table>
        <tr>
            <td colspan="2"><input type="submit" value="Edasi panga lehele" /></td>
        </tr>
    </table>
</form>