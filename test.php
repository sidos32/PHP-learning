<?php


interface PaymentInterface {
    public function payNow();
}



class PayPal
{
    public function  payNow(){echo "Payed with PayPal";}
}


Class Visa
{
public function  payNow(){echo "Payed with Visa";}
}



Class Cash
{
    public function  payNow(){echo "Payed with Cash";}
}

Class BuyProduct
{

    public function  pay(Cash $paymentType){
        $paymentType->payNow();
    }

}

$paymentType = new Cash();
$buyProduct = new BuyProduct();
$buyProduct->pay($paymentType);

