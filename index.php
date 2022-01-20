<?php require('./dao/ProductDAO.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Index</title>
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/style.css">
    <script src="static/js/jquery-3.6.0.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h1 class="text-center justify-content-md-center orange">Product List</h1>
    <hr>
    <div class="typeListContainer">
        <?php
        $productDao = new ProductDAO();
        $productTypes = $productDao->getDistinctTypes();
        if (isset($_GET['type'])) {
            echo json_encode($productDao->getProductsByType($_GET['type']));
        }
        ?>
        <ul>
            <li><h4 class="orange">Categories</h4></li>
            <?php foreach ($productTypes
                           as $value) { ?>
                <li><a href="#" onclick="return getSelectedType(this)"><h4><?php echo $value['type']; ?></h4></a>
                </li><?php } ?>
        </ul>
        <?php if (isset($_GET['deleted'])) {
            echo "<h3 style='color:red'>Deleted successfully!</h3>";
        }
        ?>
    </div>
    <div class="fixedContainer">
        <span id="typeDisplay" class="orange typediv"></span>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Name</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody id="tableBody"></tbody>
        </table>
        <br><a href="add_products.php">I want to add a product</a>
    </div>
</div>
<script src="static/js/script.js"></script>
</body>
</html>

