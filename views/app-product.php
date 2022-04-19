<?php
session_start();

require_once __DIR__ . '/../model/products.php';

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('LOG: " . $output . "' );</script>";
}

debug_to_console($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    // var_dump($data);
    
    $class = '\\App\\Model\\' . ucwords($data['type']);
    debug_to_console($_SERVER['REQUEST_METHOD']);
    $product = new $class();
    $product->setSKU($data['sku']);
    $product->setName($data['name']);
    $product->setType($data['type']);
    $product->setPrice($data['price']);
    $product->setAttribute($data['attribute']);

    $is_sucessful = $product->save();

    $_SESSION["success"] = true;
    $_SESSION["message"] = "Record saved successfully";

    $host  = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];

    header("Location: http://$host$uri");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCANDIWEB - Add Product</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="bg-light">
    <form id="product_form" class="products" action="/product.php" method="POST" onsubmit="submitForm">
        <section class="container mt-5">
            <div class="d-flex justify-content-between p-2">
                <h3 class="mb-0">Add Product</h3>

                <div class="d-flex">
                    <button class="w-100 btn btn-primary btn-sm px-4" type="submit" id="save">Save</button>
                    <span class="mx-2"></span>
                    <a type="button" class="btn btn-secondary btn-sm px-4" href="http://localhost/scandiweb%20junior%20task/views/front.php">Cancel</a>
                </div>
            </div>
        </section>

        <div class="py-1">
            <div class="container">
                <div class="row g-5 mt-2 px-3">

                    <div class="col-md-7 col-lg-8 mt-1">
                        <?php
                        if (isset($_SESSION['success'])) : ?>

                            <div class="alert alert-success alert-dismissible" role="alert">
                                <?php echo $_SESSION["message"] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                        <?php
                            unset($_SESSION['success']);
                        endif; ?>

                        <hr class="mb-4">

                        <div class="row g-3">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="">
                                            <label for="sku" class="form-label">SKU</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="sku" name="sku" placeholder="" value="" required>
                                                <div class="invalid-feedback">
                                                    Valid first name is required.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="">
                                            <label for="name" class="form-label">Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="" value="" required>
                                                <div class="invalid-feedback">
                                                    Valid first name is required.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="">
                                            <label for="price" class="form-label">Price</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="price" name="price" placeholder="" value="" required>
                                                <div class="invalid-feedback">
                                                    Valid first name is required.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="">
                                            <label for="type" class="form-label">Type</label>
                                            <div class="col-sm-12">
                                                <select id="productType" class="form-select" name="type" require>
                                                    <option selected disabled>Select type</option>
                                                    <option value="Book">Book</option>
                                                    <option value="Disc">Disc</option>
                                                    <option value="Furniture">Furniture</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Valid first name is required.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="col-sm-12 forfield size">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="">
                                            <label for="price" class="form-label">Size (MB)</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="size" name="attribute" placeholder="" value="" required>
                                                <div class="invalid-feedback">
                                                    Valid first name is required.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 forfield dimensions">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="">
                                            <label for="price" class="form-label">Height (CM)</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="height" name="attribute" placeholder="" value="" required>
                                                <div class="invalid-feedback">
                                                    Valid first name is required.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-100 my-2"></div>

                                    <div class="col-sm-6">
                                        <div class="">
                                            <label for="price" class="form-label">Width (CM)</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="width" name="attribute" placeholder="" value="" required>
                                                <div class="invalid-feedback">
                                                    Valid first name is required.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-100 my-2"></div>

                                    <div class="col-sm-6">
                                        <div class="">
                                            <label for="price" class="form-label">Length (CM)</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="length" name="attribute" placeholder="" value="" required>
                                                <div class="invalid-feedback">
                                                    Valid first name is required.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 forfield weight">
                                <div class="col-sm-6">
                                    <div class="">
                                        <label for="price" class="form-label">Weight (KG)</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="weight" name="attribute" placeholder="" value="" required>
                                            <div class="invalid-feedback">
                                                Valid first name is required.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <footer class="text-muted py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
        </div>
    </footer>

    <script>
        //handle form data 
        function submitForm() { 
            let formData = new FormData(document.querySelector("#product_form"));
            let userData = {};

            for (let pair of formData.entries()) {
                if (pair[1] !== "") {
                    console.log(pair[0], pair[1]);
                    userData[pair[0]] = pair[1];
                }
            }
            console.log(userData)

            const form = document.getElementById('product_form');
            form.reset();

            return userData;
        }

        // click button and POST request making
        const button = document.getElementById('save');
        button.addEventListener('click', async _ => {
            try {
                const response = await fetch('/scandiweb junior task/model/product.php', {
                    method: 'POST',
                    body: JSON.stringify(submitForm())
                });
                console.log('Completed!', response);
            } catch (err) {
                console.error(`Error: ${err}`);
            }
        });
 
        document.addEventListener('DOMContentLoaded', function(event) {

            function setAllDisplayNone() {
                document
                    .querySelectorAll(".forfield")
                    .forEach((node) => {
                        node.style.display = "none"
                    });
            }

            setAllDisplayNone();

            document
                .getElementById('productType')
                .addEventListener('change', function(event) {

                    setAllDisplayNone()

                    switch (event.target.value) {
                        case "Book":
                            document.querySelector('.weight').style.display = 'block';
                            break;
                        case "Disc":
                            document.querySelector('.size').style.display = 'block';
                            break;
                        case "Furniture":
                            document.querySelector('.dimensions').style.display = 'block';
                            break;
                    }
                })
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>