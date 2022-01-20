<?php require_once('./dao/ProductDAO.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add</title>
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/style.css">
    <script src="static/js/jquery-3.6.0.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
    <script src="static/js/script.js"></script>
</head>
<body>

<div class="container">
    <h1 class="text-center justify-content-md-center orange">Add Products</h1>
    <hr>
    <?php
    $productDAO = new ProductDAO();
    $product = null;
    if ($_GET != null) {
        if (isset($_GET['id'])) {
            $product = $productDAO->getProduct($_GET['id']);
        }
    }

    ?>
    <div class="addProductContainer">
        <div id="warning"></div>
        <form method="post" onsubmit="return checkValues();">
            <table>
                <tr>
                    <td>Type:</td>
                    <td><input type="text" id="prodType" name="type" value=<?php if ($product != null) {
                            echo $product->getType();
                        } else {
                            echo "";
                        } ?>></td>
                </tr>
                <tr>
                    <td>Code:</td>
                    <td><input type="text" name="code" id="code" value=<?php if ($product != null) {
                            echo $product->getCode();
                        } else {
                            echo "";
                        } ?>></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="text" name="price" id="price" value=<?php if ($product != null) {
                            echo $product->getPrice();
                        } else {
                            echo "";
                        } ?>></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="name" id="prodName" value=<?php if ($product != null) {
                            echo $product->getName();
                        } else {
                            echo "";
                        } ?>></td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <button type="reset">Reset</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit">Submit</button>
                    </td>
                </tr>
            </table>
            <input hidden=hidden type="text" name="id" id="id" value=<?php if ($product != null) {
                echo $product->getId();
            } else {
                echo "";
            } ?>>
        </form>
        <br><a href="index.php">Back to index page</a>
    </div>

</div>

<?php
//prepare the sql statement
if ($_POST != null) {
    if ($_POST['name'] != null && $_POST['code'] != null && $_POST['type'] != null && $_POST['price'] != null) {
        $product = new Product($_POST['id'], $_POST['type'], $_POST['code'], $_POST['name'], $_POST['price']);
        if ($product->getId() != null) {
            $productDAO->editProduct($product);
        } else {
            $productDAO->addProduct($product);
        }
        header('Location:index.php');
    }
}
?>

</body>
</html>