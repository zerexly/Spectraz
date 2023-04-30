<?php
include('functions.php');
include('../app/Config/constant.php');
date_default_timezone_set('Asia/Karachi');

//dont modify the folders
$image_baseurl = BASE_URL."";
$baseurl = BASE_URL."api/";


$basePath=explode("payment",__DIR__);
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
require __DIR__  . '/vendor/autoload.php';

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use Razorpay\Api\Api;


$baseURL="http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
//$baseURL=str_replace("payment/","",$baseURL);
$baseURL=explode("payment",$baseURL);
define("BASE_URL", $baseURL[0]);

/***********************************====Paypal=====**************************************/
// https://developer.paypal.com/webapps/developer/applications/myapps
//paypal return URl configration 
define("SET_RETURN_URL", BASE_URL."session_id=".$_GET['session_id']);
define("SET_CANCEL_URL", BASE_URL."video_id=".$_GET['video_id']);

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        PAYPAL_CLIENT_ID,     // ClientID
        PAYPAL_CLIENT_SECRET      // ClientSecret
    )
);

// $apiContext->setConfig([
//  'mode' => 'live',
// ]);


//print_r($_GET);
if (@$_GET['payment'] == 'paypal')
{
    try
    {
        $budget=@$_GET['budget'];
        // login with paypal module
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new \PayPal\Api\Amount();
        $amount->setTotal($budget);
        $amount->setCurrency(PAYPAL_CURRENCY);

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(SET_RETURN_URL)
            ->setCancelUrl(SET_CANCEL_URL);

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);


        $payment->create($apiContext);
        // login with paypal module

        echo "<script>window.location='".$payment->getApprovalLink() ."'</script>";

        // echo "<pre>";
        //     echo $payment;
        //     echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
        // echo "</pre>";

    }
    catch (\PayPal\Exception\PayPalConnectionException $ex)
    {
        // This will print the detailed information on the exception.
        //REALLY HELPFUL FOR DEBUGGING
        echo $ex->getData();
    }
}

?>
