<?php

use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount as Amounts;
use PayPal\Api\Payer;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

//include("navigation/navigation.php");

include("start.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">
    <style type="text/css">
        @import url("http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.min.css")
    </style>
    <title>Clufund</title>
</head>


<body>
<div class="container" style="margin-top: 65px;background-color: #ffffff;"><br>
<?php

if (!isset($_POST['amount'])) {
    die();
}

$amount = $_POST['amount'];
$shipping = 2.00;

$total = $amount + $shipping;
$payer = new Payer();
$payer->setPaymentMethod('paypal');

$item = new Item();
$item->setCurrency('USD')
    ->setPrice($amount);

$itemList = new ItemList();
$itemList->setItems($item);

$details = new Details();
$details->setShipping($shipping)
    ->setSubtotal($amount);

$amounts = new Amounts();
$amounts->setCurrency('USD')
    ->setTotal($total)
    ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amounts)
    ->setItemList($itemList)
    ->setDescription('PayForSomething PayPal')
    ->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(SITE_URL . '/pay.php?success=true')
    ->setCancerUrl(SITE_URL . '/pay.php?success=false');

$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions([$transaction]    );

try{
    $payment->create($paypal);
} catch (Exception $e){
    die($e);
}

$approvalUrl = $payment->getApprovalLink();

header("Location: {$approvalUrl}");


?>

</div>
</body>
<br>
<?php include("footer.php"); ?>
</html>