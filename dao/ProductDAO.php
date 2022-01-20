<?php
require_once('AbstractDAO.php');
require_once('./model/Product.php');

/**
 * Description of ProductDAO
 *
 * 
 */
class ProductDAO extends abstractDAO
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getProducts()
    {
        $ps = $this->PDO->prepare('SELECT * FROM products');
        $ps->execute();
        $products = $ps->fetchAll(PDO::FETCH_ASSOC);
        $productObjects = array();
        //Create a new product object, and add it to the array.
        foreach ($products as $p) {
            $product = new Product($p['id'], $p['type'], $p['code'], $p['name'], $p['price']);
            $productObjects[] = $product;
        }
        return $productObjects;
    }

    public function getProductsByType($type)
    {
        //The query method returns a mysqli_result object
        $ps = $this->PDO->prepare('SELECT * FROM products where type = :type');
        $ps->bindParam(':type', $type);
        $ps->execute();
        $products = $ps->fetchAll(PDO::FETCH_ASSOC);
//        $productObjects = array();
//        foreach ($products as $p) {
//            $product = new Product($p['id'], $p['type'], $p['code'], $p['name'], $p['price']);
//            $productObjects[] = $product;
//        }
        return $products;
    }

    public function getDistinctTypes()
    {
        $ps = $this->PDO->prepare('select distinct type from products');
        $ps->execute();
        return $ps->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduct($id)
    {
        $query = 'SELECT * FROM products WHERE id = :id';
        $ps = $this->PDO->prepare($query);
        $ps->bindParam(':id', $id);
        $bool = $ps->execute();
        if ($bool) {
            $temp = $ps->fetch(PDO::FETCH_ASSOC);
            if($temp!=null){
                return new Product($temp['id'], $temp['type'], $temp['code'], $temp['name'], $temp['price']);
            }
        }
        return false;
    }

    public function addProduct($product)
    {
        $query = 'INSERT INTO products(type,code,name,price) VALUES (:type,:code,:name,:price)';
        $ps = $this->PDO->prepare($query);
        $type = $product->getType();
        $code = $product->getCode();
        $name = $product->getName();
        $price = $product->getPrice();
        $ps->bindParam(':type', $type);
        $ps->bindParam(':code', $code);
        $ps->bindParam(':name', $name);
        $ps->bindParam(':price', $price);
        //Execute the statement
        $ps->execute();
        return $ps->errorCode();
    }

    public function deleteProduct($id)
    {
        $query = 'DELETE FROM products WHERE id = :id';
        $ps = $this->PDO->prepare($query);
        $ps->bindParam(':id', $id);
        $ps->execute();
        if ($ps->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function editProduct($product)
    {
        if ($product != null) {
            $query = 'UPDATE products SET type = :type, code = :code,name=:name,price=:price WHERE id = :id';
            $ps = $this->PDO->prepare($query);
            $type = $product->getType();
            $code = $product->getCode();
            $name = $product->getName();
            $price = $product->getPrice();
            $id = $product->getId();
            $ps->bindParam(':type', $type);
            $ps->bindParam(':code', $code);
            $ps->bindParam(':name', $name);
            $ps->bindParam(':price', $price);
            $ps->bindParam(':id', $id);
            $ps->execute();
        }
    }
}