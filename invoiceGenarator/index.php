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



//BILL INFO
$invoiceSelect = 'SELECT * FROM  `invoice_Information`';


$result = mysqli_query($connection->myConn, $invoiceSelect);
$invInfo = mysqli_fetch_assoc($result);;
//BILL TO
$invoice->set("billto",$invInfo);

//SHIP INFO
$shipSelect = 'SELECT * FROM  `ship_to`';

$resultBill = mysqli_query($connection->myConn, $shipSelect);
$shipTo = mysqli_fetch_assoc($resultBill);



//SHIP TO
$invoice->set("shipto", $shipTo);

$selectCart = 'SELECT * FROM `item_details`';
$itemResult = mysqli_query($connection->myConn,$selectCart);

$totalSum = floatval(0);


//FETCHING ITEMS FROM DB
$items = [];
    while($row = $itemResult->fetch_assoc()) {

      $total =$row['itemPrice'] * $row['itemQuantity'];

      $item = [$row['itemName'],$row['itemDesc'],$row['itemQuantity'],$row['itemPrice'],$total];
      array_push($items,$item);
        $totalSum = $total + $totalSum;
    }


foreach ($items as $i) {
    $invoice->add("items", $i); }

//TOTALS INFO
$invoice->set("totals",[
    ["СУМА", $totalSum . "лв."]
]);



//SUB INFO
$invoice->set("notes", [
    "Благодарим ви че сте наш клиент."
]);

//SHOWING INVOICE.HTML
$invoice->outputHTML();

if (isset($_POST['test'])) {
    $invoice->outputPDF(2, "invoice.pdf");
};

?
<form  method="post" >
    <input name="test" type="submit" value="Изтегли">
</form>
<br>


