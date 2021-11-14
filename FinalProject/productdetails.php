<?php
/** Author: your name
 *  Date: today's date
 *  Description:
 */
$page_title = "Product Details";
require_once ('includes/header.php');
require_once('includes/database.php');

//if product id cannot retrieved, terminate the script
if (!filter_has_var(INPUT_GET, "id")) {
    echo "Error: Product ID was not found";
    require_once('includes/footer.php');
    exit();

}
//retrieve product id from a query string variable.
$product_id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

//MySQL SELECT statement
$sql = "SELECT * FROM products WHERE product_id=$product_id";

//execute the query
$query = $conn->query($sql);

//Handle errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    $error = "Selection failed: ($errno) $errmsg<br/>";
    $conn->close();
    require_once('includes/footer.php');
    exit;
}

if (!$row = $query->fetch_assoc()) {
    $conn->close();
    require 'includes/footer.php';
    die("Product not found.");
}

?>

<div id="product-details">
    <img src="<?php echo $row['image'] ?>" alt="">
    <div id="product-details-info">
        <p class="title"><?php echo $row['name'] ?> <span class="calories"><?php echo $row['calories'] ?> kcal</span></p>
        <p class="price">$<?php echo $row['price'] ?></p>
        <p class="description"><?php echo $row['description'] ?></p>
        <button class="addToOrder-button">Add To Order</button>
        <div class="line"></div>
        <p class="ingredients">Ingredients</p>
        <p class="ingredients-list"><?php echo $row['ingredients'] ?></p>
    </div>
</div>

<!--    <h2>Product Details</h2>-->
<!--    <table id="productdetails" class="productdetails">-->
<!--        <tr>-->
<!--            <td class="col1">-->
<!--                <-- display product image -->
<!--                <img src="--><?php //$row['images'] ?><!--" alt="">-->
<!--            </td>-->
<!--            <td class="col2">-->
<!--                <h4>Name:</h4>-->
<!--                <h4>Category:</h4>-->
<!--                <h4>Calories:</h4>-->
<!--                <h4>Price:</h4>-->
<!--                <h4>Ingredients:</h4>-->
<!--                <h4>Description:</h4>-->
<!--            </td>-->
<!--            <td class="col3">-->
<!--                <p>--><?php //echo $row['name'] ?><!--</p>-->
<!--                <p>--><?php //echo $row['category_id'] ?><!--</p>-->
<!--                <p>--><?php //echo $row['calories'] ?><!--</p>-->
<!--                <p>--><?php //echo $row['price'] ?><!--</p>-->
<!--                <p>--><?php //echo $row['ingredients'] ?><!--</p>-->
<!--                <p>--><?php //echo $row['description'] ?><!--</p>-->
<!--            </td>-->
<!--        </tr>-->
<!--    </table>-->

<?php
require_once ('includes/footer.php');
