<?php
require_once("./entities/product.class.php");
require_once("./entities/category.class.php");

if (isset($_POST["btnsubmit"])) {
    $productName = $_POST["txtname"];
    $cateID = $_POST["txtcateID"];
    $price = $_POST["txtprice"];
    $quantity = $_POST["txtquantity"];
    $description = $_POST["txtdesc"];
    $picture = $_FILES["txtpic"];

    $newProduct = new Product($productName, $cateID, $price, $quantity, $description, $picture);
    $result = $newProduct->save();

    if (!$result)
        header("location: add_product.php?fallure");
    else
        header("location: add_product.php?inserted");
}
?>

<?php include_once("header.php"); ?>

<?php
if (isset($_GET["inserted"])) {
    echo "<script>if(confirm('Thành Công')){document.location.href='list_product.php'};</script>";
    
}

?>
<?php
if (isset($_GET["fallure"]))
    echo "<h2>Thêm sản phẩm thất bại</h2>";
?>
<form method="POST">
    <div class="row">
        <div class="lbltitle">
            <label>Tên sản phẩm</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtname" value="<?php echo isset($_POST["txtname"]) ? $_POST["txtname"] : ""; ?>" />
        </div>
    </div>

    <div class="row">
        <div class="lbltitle">
            <label>Mô tả sản phẩm</label>
        </div>
        <div class="lblinput">
            <textarea cols="21" rows="10" name="txtdesc" value="<?php echo isset($_POST["txtdesc"]) ? $_POST["txtdesc"] : ""; ?>"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="lbltitle">
            <label>Số lượng sản phẩm</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtquantity" value="<?php echo isset($_POST["txtquantity"]) ? $_POST["txtquantity"] : ""; ?>" />
        </div>
    </div>

    <div class="row">
        <div class="lbltitle">
            <label>Giá sản phẩm</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtprice" value="<?php echo isset($_POST["txtprice"]) ? $_POST["txtprice"] : ""; ?>" />
        </div>
    </div>

    <div class="row">
        <div class="lbltitle">
            <label> Chọn loại sản phẩm</label>
        </div class="lblinput">
        <select name="txtCateID">
            <option value="" selected> -- Chọn Loại --</option>
            <?php 
            $cates = Category:: list_category();
            foreach( $cates as $item){
                echo"<option value = ".$item["CateID"].">".$item["CategoryName"]."</option>";
            }
            ?>
            </select>
            </div>
    </div>

    <div class="row">
        <div class="lbltitle">
            <label> Đường dẫn hình sản phẩm</label>
        </div>
        <div class="lblinput">
           <input type="file" id="txtpic" name="txtpic" accept=".PNG, .GIF, .JPG ">
        </div>
    </div>

    <div class="row">
        <div class="submit">
            <input type="submit" name="btnsubmit" value="Thêm sản phẩm" />
        </div>
    </div>
</form>
<?php include_once("footer.php"); ?>