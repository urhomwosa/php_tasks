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
    
    $host  = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];
    
    if ($is_sucessful == true) {
        header("Location: http://localhost/scandiweb%20junior%20task/views/front.php");
    }
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
    <form id="product_form" class="products" action="#"  method="POST" >
        <section class="container mt-5">
            <div class="d-flex justify-content-between p-2">
                <h3 class="mb-0">Add Product</h3>

                <div class="d-flex">
                    <button class="w-100 btn btn-primary btn-sm px-4" type="button" id="save">Save</button>
                    <span class="mx-2"></span>
                    <a type="button" class="btn btn-secondary btn-sm px-4" href="http://localhost/scandiweb%20junior%20task/views/front.php">Cancel</a>
                </div>
            </div>
        </section>

        <div class="py-1">
            <div class="container">
                <div class="row g-5 mt-2 px-3">

                    <div class="col-md-7 col-lg-8 mt-1">
                        
                        <hr class="mb-4">

                        <div class="row g-3">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="">
                                            <label for="sku" class="form-label">SKU</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="sku" name="sku" placeholder="" value="" >
                                                <div id="skuErrorMessage"> </div>
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
                                                <input type="text" class="form-control" id="name" name="name" placeholder="" value="" >
                                                <div id="nameErrorMessage"> </div>
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
                                                <input type="number" class="form-control" id="price" name="price" placeholder="" value="" >
                                                <div id="priceErrorMessage"> </div>
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
                                                <select id="productType" class="form-select" name="type" >
                                                    <option selected disabled>Select type</option>
                                                    <option value="Book">Book</option>
                                                    <option value="Disc">Disc</option>
                                                    <option value="Furniture">Furniture</option>
                                                </select>
                                                <div id="productTypeErrorMessage"> </div>
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
                                                <input type="text" class="form-control" id="size" name="attribute" placeholder="" value="" onkeyup="addSizeToAttribute();">
                                                <div id="sizeErrorMessage"> </div>
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
                                                <input type="text" class="form-control" id="height" name="attribute" placeholder="" value=""  onkeyup="addHeightToAttribute();">
                                                <div id="heightErrorMessage"> </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-100 my-2"></div>

                                    <div class="col-sm-6">
                                        <div class="">
                                            <label for="price" class="form-label">Width (CM)</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="width" name="attribute" placeholder="" value="" onkeyup="addWidthToAttribute();" >
                                                <div id="widthErrorMessage"> </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-100 my-2"></div>

                                    <div class="col-sm-6">
                                        <div class="">
                                            <label for="price" class="form-label">Length (CM)</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="length" name="attribute" placeholder="" value="" onkeyup="addLengthToAttribute();">
                                                <div id="lengthErrorMessage"> </div>
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
                                            <input type="text" class="form-control" id="weight" name="attribute" placeholder="" value="" onkeyup="addWeightToAttribute();">
                                            <div id="weightErrorMessage"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="attribute" id="attribute" hidden>
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
        //handle form data, handle form data when save button is clicked

        // click button and POST request making
        const button = document.getElementById('save');
                var attribute = document.getElementById("attribute");
            function addSizeToAttribute(){
                var size = document.getElementById("size").value;
                attribute.value = size;
               }

            function addWeightToAttribute(){
                var weight = document.getElementById("weight").value;
                attribute.value = weight;
             }

             function addHeightToAttribute(){
                 var height = document.getElementById("height").value;

                var width= document.getElementById("width").value;

                var length = document.getElementById("length").value;
                attribute.value = height +"x"+width+"x"+length;
               }

               function addWidthToAttribute(){
                    var height = document.getElementById("height").value;

                    var width= document.getElementById("width").value;

                    var length = document.getElementById("length").value;
                    attribute.value = height +"x"+width+"x"+length;
                }

            function addLengthToAttribute(){
                var height = document.getElementById("height").value;

                var width= document.getElementById("width").value;

                var length = document.getElementById("length").value;
                attribute.value = height +"x"+width+"x"+length;
             }


        button.addEventListener('click', async _ => {
            var sku = document.getElementById("sku").value;
                var name = document.getElementById("name").value;
                var price = document.getElementById("price").value;
                var producttype = document.getElementById("productType").value;
                var size = document.getElementById("size").value;
                var height = document.getElementById("height").value;
                var width = document.getElementById("width").value;
                var length = document.getElementById("length").value;
                var weight = document.getElementById("weight").value;
                var attribute = document.getElementById("attribute");
                //validate producttype
                if(productType==""){
                  document.getElementById("productTypeErrorMessage").innerHTML= "Please provide product type. product type is required.";
                }
                else{
                    if (productType == "Furniture") {
                         //validate width input field
                            if(width==""){
                                document.getElementById("widthErrorMessage").innerHTML= "Please provide width. width is required.";
                            }
                            if (!/^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(width)) { 
                                document.getElementById("widthErrorMessage").innerHTML= "Invalid width. Please provide numerical values.";
                            }
                        //end validate width input
                         //validate heigth input field
                         if(height==""){
                                document.getElementById("heightErrorMessage").innerHTML= "Please provide height. height is required.";
                            }
                            if (!/^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(height)) { 
                                document.getElementById("heightErrorMessage").innerHTML= "Invalid height. Please provide numerical values.";
                            }
                        //end validate height input
                         //validate length  input field
                         if(length==""){
                                document.getElementById("lengthErrorMessage").innerHTML= "Please provide length. length is required.";
                            }
                            if (!/^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(length)) { 
                                document.getElementById("lengthErrorMessage").innerHTML= "Invalid length. Please provide numerical values.";
                            }
                        //end validate length input
                        attribute.value = height + "x" + width + "x" + length;

                    }
                    else if(productType == "Disc"){
                        //validate size input field
                        if(size==""){
                            document.getElementById("sizeErrorMessage").innerHTML= "Please provide SIZE. SIZE is required.";
                        }
                        if (!/^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(size)) { 
                            document.getElementById("sizeErrorMessage").innerHTML= "Invalid size. Please provide numerical values.";
                        }
                        //end validate size input

                    }
                        
                    else if(productType == "Book"){
                        //validate weigth input field
                        if(weight==""){
                            document.getElementById("weightErrorMessage").innerHTML= "Please provide weight. weight is required.";
                        }
                        if (!/^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(size)) { 
                            document.getElementById("weightErrorMessage").innerHTML= "Invalid weight. Please provide numerical values.";
                        }
                    
                        //end validate weigth input
                        attribute.value = weigth;

                    }//end validate producttype
                    else{
                    if(sku==""){
                                 document.getElementById("skuErrorMessage").innerHTML= "Please provide SKU. SKU is required.";
                         }
                //validate name input field
                    if(name==""){ 
                             document.getElementById("nameErrorMessage").innerHTML= "Please provide NAME. NAME is required.";
                    }
                    if (!/^[a-zA-Z]*$/g.test(name)) { 
                            document.getElementById("nameErrorMessage").innerHTML= "Name should be only letters, ";
                    }
                 // end validate name input field
                 //validate price input field
                    if(price==""){
                        document.getElementById("priceErrorMessage").innerHTML= "Please provide PRICE. PRICE is required.";
                    }
                    if (!/^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(price)) { 
                        document.getElementById("priceErrorMessage").innerHTML= "Invalid price. Please provide numerical values.";
                    }
                //end validate price input field
                  
                else{
                    const form = document.getElementById('product_form');
                        form.submit();  
                }
                    }
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


//change of type switch
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

