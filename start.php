<?php


use PayPal\Api\Payer;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

define('SITE_URL', 'http://"192.168.10.1:8888"/clufund/checkout.php');
session_start();

	$_SESSION['user_id']=1;

	require_once __DIR__ . '/vendor/autoload.php';

$apiContext = new ApiContext(

		new OAuthTokenCredential(
			'AVz3Dx8tRX75fw1_71MZPNio4LJCEYJVj23oBmaX-ZQq1BYYyz4fpPCN0HPHJoAWr4bA9hR7-Y3HkpYS',
			'EOlMjryRAYmZG3gJxY24qsBXLhCV-Duq33yhAfH7tyvQC5X_U__UzA6KbsYnjPHDpin-jX2zgBMG7rEg')
	);

$apiContext->setConfig([

		'mode' => 'sandbox',
		'http.ConnectionTimeOut' =>30,
		'log.LogEnabled' => true,
		'log.FileName' =>'',
		'log.LogLevel' =>'FINE',
		'validation.Level' =>'log'
	]);

	$db = new PDO('mysql:host=localhost;dbname=xtestpaypal', 'root', 'admin');

	$user = $db->query("
		SELECT * FROM users
		WHERE id = :user_id, PDO::FETCH_ASSOC
	");

$creditCard = new \PayPal\Api\CreditCard();
$creditCard->setType("visa")
    ->setNumber("4417119669820331")
    ->setExpireMonth("11")
    ->setExpireYear("2019")
    ->setCvv2("012")
    ->setFirstName("Joe")
    ->setLastName("Shopper");

try {
    $creditCard->create($apiContext);
    echo $creditCard;
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
}


//
//
//public function postPayment()
//{
//    $payer = new Payer();
//    $payer->setPaymentMethod('paypal');
//
//    $item_1 = new Item();
//    $item_1->setName('Item 1') // item name
//    ->setCurrency('USD')
//        ->setQuantity(2)
//        ->setPrice('150'); // unit price
//
//    $item_2 = new Item();
//    $item_2->setName('Item 2')
//        ->setCurrency('USD')
//        ->setQuantity(4)
//        ->setPrice('70');
//
//
//    // add item to list
//    $item_list = new ItemList();
//    $item_list->setItems(array($item_1, $item_2));
//
//    $amount = new Amount();
//    $amount->setCurrency('USD')
//        ->setTotal(580);
//
//    $transaction = new Transaction();
//    $transaction->setAmount($amount)
//        ->setItemList($item_list)
//        ->setDescription('Your transaction description');
//
//    $redirect_urls = new RedirectUrls();
//    $redirect_urls->setReturnUrl(URL::route('payment.status')) // Specify return URL
//    ->setCancelUrl(URL::route('payment.status'));
//
//    $payment = new Payment();
//    $payment->setIntent('Sale')
//        ->setPayer($payer)
//        ->setRedirectUrls($redirect_urls)
//        ->setTransactions(array($transaction));
//
//    try {
//        $payment->create($this->_api_context);
//    } catch (\PayPal\Exception\PPConnectionException $ex) {
//        if (\Config::get('app.debug')) {
//            echo "Exception: " . $ex->getMessage() . PHP_EOL;
//            $err_data = json_decode($ex->getData(), true);
//            exit;
//        } else {
//            die('Some error occur, sorry for inconvenient');
//        }
//    }
//
//    foreach($payment->getLinks() as $link) {
//        if($link->getRel() == 'approval_url') {
//            $redirect_url = $link->getHref();
//            break;
//        }
//    }
//
//    // add payment ID to session
//    Session::put('paypal_payment_id', $payment->getId());
//
//    if(isset($redirect_url)) {
//        // redirect to paypal
//        return Redirect::away($redirect_url);
//    }
//
//    return Redirect::route('original.route')
//        ->with('error', 'Unknown error occurred');
//}
//
//
//	$user->execute(['user_id' => $_SESSION['user_id']]);
//
//	$user = $user->fetchObject();
