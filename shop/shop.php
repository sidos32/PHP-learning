<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Магазина на sid </title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-168191821-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-168191821-1');
    </script>




    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-P8G7CKX');</script>
    <!-- End Google Tag Manager -->



    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P8G7CKX"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


<div class="topnav">
    <a href="index.php">Начало</a>
    <a class="active" href="shop.php">Магазин</a>
    <a href="contact.php">Контакти</a>
    <a href="about.php">За нас</a>
</div>



<?php
$link = mysqli_connect("127.0.0.1", "root", "", "shop");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$sql = "SELECT * FROM `items_table`";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        ?>
        <script>

            // Measure product views / impressions
            dataLayer.push({
                'event': 'view_item_list',
                'ecommerce': {
                    'items': [
                        {
                            'item_name': <?php echo json_encode($row['item_name']); ?>,       // Name or ID is required.
                            'item_id': '<?php echo json_encode($row['item_id']); ?>',
                            'price': '<?php echo json_encode($row['price']); ?>',
                            'item_brand': '<?php echo json_encode($row['item_brand']); ?>',
                            'item_list_name': 'Search Results',
                            'item_list_id': 'SR123',
                            'quantity': '<?php echo json_encode($row['quantity']); ?>'
                        }
                        ]
                }
            });
        </script>

        <div class="card" style="width: 15rem;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg" class="card-img-top"
                 alt="Бавна връзка">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row["item_name"] ?></h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Марка: <?php echo $row["item_brand"] ?> </li>
                <li class="list-group-item">Количества: <?php echo $row["quantity"] ?></li>
                <li class="list-group-item">Цента: <?php echo $row["price"] ?>лв.</li>
            </ul>
            <div class="card-body">
                <a href="#" class="addCart">Добави в количка</a>
                <a href="#" class="clicked">Виж повече</a>
            </div>
        </div>
        <?php

    }
} else {
    echo "Няма продукти!";
}


mysqli_close($link);
?>

</body>
</html>
