<?php
$page_title = "Products in Our Store";
require ('includes/header.php');
require_once('includes/database.php');

if (!filter_has_var(INPUT_GET, 'category')) {
    echo "Error: Category was not found.";
    require_once ('includes/footer.php');
    exit();
}
$category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT);

//SELECT statement
$sql = "SELECT * FROM products, category WHERE products.category_id = category.category_id AND products.category_id = " . $category;

//execute the query
$query = $conn->query($sql);

//Handle errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed : ($errno) $errmsg<br/>\n";
    $conn->close();
    require 'includes/footer.php';
    exit;
}

//if (!$row = $query->fetch_assoc()) {
//    $conn->close();
//    require 'includes/footer.php';
//    die("No products found.");
//}



?>
<!--    <div class="page-title">-->
<!--        <p>--><?php //$row['category.category_type'] ?><!--</p>&nbsp&nbsp-->
<!--        <img style="width: 36px; height: 36px" src="www/img/icons/arrow-right.svg" alt="">&nbsp&nbsp-->
<!--        <a class="current" class="page-link" href="">--><?php //$row['category_name'] ?><!--</a>-->
<!--    </div>-->

    <div id="products-list">
        <?php
        while (($row = $query->fetch_assoc()) !== null) {
            echo "<div id=\"product\">";
            echo "<a class=\"product-image\" href=\"productdetails.php?id=1", $row['product_id'], "\"><img class=\"product-image\" src=\"", $row['image'], "\" alt=\"\"></a>";
            echo "<span><div class=\"addCartButton\"><img src=\"www/img/icons/shopping-bag.svg\" alt=\"\"></div></span>";
            echo "<a href=\"productdetails.php?id=", $row['product_id'], "\" class=\"title\">", $row['name'],"</a>";
            echo "<a href='productdetails.php?id=", $row['product_id'], "' class='price'>$", $row['price'], "</a>";
            echo "</div>";
        }
        ?>

    </div>



<!--    <h2><a href=""></a></h2>-->
<!--    <table id="productlist" class="productlist">-->
<!--        <tr>-->
<!--            <th class="col1">Name</th>-->
<!--            <th class="col2">Description</th>-->
<!--            <th class="col3">Category</th>-->
<!--            <th class="col4">Price</th>-->
<!--        </tr>-->
<!--        <!-- add PHP code here to list all products from the "products" table -->-->
<!--        --><?php
//        while (($row = $query->fetch_assoc()) !== null) {
//            echo "<tr>";
//            echo "<td><a href='productdetails.php?id=", $row['product_id'], "'>", $row['name'], "</a></td>";
//            echo "<td>", $row['description'], "</td>";
//            echo "<td>", $row['category_id'], "</td>";
//            echo "<td>", $row['price'], "</td>";
//            echo "</tr>";
//        }
//        ?>
<!--    </table>-->

<?php
// clean up resultsets when we're done with them!
$query->close();

// close the connection.
$conn->close();
require ('includes/footer.php');

