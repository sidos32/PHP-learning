<?php
include 'createCon.php';
require dirname(__DIR__) . DIRECTORY_SEPARATOR . "invoiceGenarator/invoicr.php";
$invoice = new Invoicr();

//OUT COMPANY INFORMATION
$invoice->set("company", [
    (isset($_SERVER['HTTPS']) ? "https://" : "http://") .
    $_SERVER['HTTP_HOST'] .
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) .
    "Dota-2-Logo.png",
    __DIR__ . DIRECTORY_SEPARATOR . "Dota-2-Logo.png",
    "АРИЗОНА ЕООД",
    " кв. Овча купел, ул. Народно Хоро, гр. София, 1000",
    "Phone: 123456789",
    "http://arizona.bg",
    "abv@abv.bg"
]);


//CREATING CONNECTION TO DB
$connection = new createCon();
$connection->connect();


$invoiceSelect = 'SELECT * FROM  `invoice_Information`';

$result = mysqli_query($connection->myConn, $invoiceSelect);
$invInfo = mysqli_fetch_assoc($result);;

$billAndShipSelect = 'SELECT * FROM  `ship_to`'; //BILL AND SHIP INFO

$resultBill = mysqli_query($connection->myConn, $billAndShipSelect);
$shipAndBill = mysqli_fetch_assoc($resultBill);

//BILL TO
$invoice->set("billto",$invInfo);

//SHIP TO
$invoice->set("shipto", $shipAndBill);

$selectCart = 'SELECT * FROM `item_details`';
$itemResult = mysqli_query($connection->myConn,$selectCart);

$totalSum = floatval(0);

$items = [];
    while($row = $itemResult->fetch_assoc()) {

      $total =$row['itemPrice'] * $row['itemQuantity'];

      $item = [$row['itemName'],$row['itemDesc'],$row['itemQuantity'],$row['itemPrice'],$total];
      array_push($items,$item);
        $totalSum = $total + $totalSum;
    }


foreach ($items as $i) {
    $invoice->add("items", $i); }

//TOTALS
$invoice->set("totals",[
    ["СУМА", $totalSum . "лв."]
]);




$invoice->set("notes", [
    "Благодарим ви че сте наш клиент."
]);

$invoice->outputHTML();

if (isset($_POST['test'])) {
    $invoice->outputPDF(2, "invoice.pdf");
};

?>
<form  method="post" >
    <input name="test" type="submit" value="Изтегли">
</form>
<br>


