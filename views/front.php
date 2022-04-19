<?php

require_once __DIR__ . '/../model/products.php';

use App\Model\Products;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['method'] == 'delete') {
    # code...

    $products = new Products();

    $products_ids = $_POST['product'];
    //var_dump($products_ids);
    $products->deleteSelected($products_ids);

    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://$host/");
    exit();
}

$products = new Products();
$result = $products->selectAll();
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SCANDIWEB - Store Front</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>

<body>
    <form action="/" method="post">
        <input type="hidden" name="method" value="delete" />

        <section class="container mt-5">
            <div class="d-flex justify-content-between p-2">
                <h3 class="mb-0">Product List</h3>

                <div>
                    <a type="button" class="btn btn-primary" href="http://localhost/scandiweb%20junior%20task/views/app-product.php">Add</a>
                    <button type="submit" value="<?= $row['id'] ?>" class="btn btn-danger">Mass Delete</button>
                </div>
            </div>
        </section>

        <main>
            <div class="album py-4">
                <div class="container">

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">

                        <?php foreach ($result as $product) : ?>

                            <div class="col">
                                <div class="card shadow-sm" style="height: 18rem;">
                                    <div class="p-3">
                                        <input class="delete-checkbox form-check-input" type="checkbox" name="product[]" value="<?php echo $product->getSKU(); ?>" />
                                    </div>

                                    <div class="mt-4">
                                        <div class="card-body text-center">
                                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $product->getSKU(); ?></h6>
                                            <h5 class="card-title mb-3"><?php echo $product->getName(); ?></h5>
                                            <p class="mb-0"><?php echo number_format($product->getPrice(), 2) . ' $'; ?></p>
                                            <p class="mb-0"><?php echo $product->getAttribute(); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>

                </div>

        </main>
    </form>

    <footer class="text-muted py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>