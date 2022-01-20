<?php
require_once('./dao/productDAO.php');
if (isset($_GET['action'])) {

    if ($_GET['action'] === "query") {
        $productDao = new ProductDAO();
        $products = $productDao->getProductsByType($_GET['type']);
        echo json_encode($products);
    }

    if ($_GET['action'] === "delete") {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $productDAO = new productDAO();
            $productDAO->deleteProduct($_GET['id']);
            header('Location:index.php');
        }
    }

    if (($_GET['action']) === "toEdit") {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            header("Location:add_products.php?id=" . $_GET['id']);
        }
    }
}
