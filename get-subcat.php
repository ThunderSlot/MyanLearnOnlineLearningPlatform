<?php

include_once "config.php";

$category_id = $_POST["category_id"];
$subCategory_id_update = $_POST["subCategory_id_update"];

if ($subCategory_id_update != null && $subCategory_id_update != '') {
    $subCategory_id_update = $_POST["subCategory_id_update"];
}
else
{
    $subCategory_id_update = '';   
}


$result = mysqli_query($conn, "SELECT * FROM subcategory where category_id = $category_id");
?>
<option value="">Select Sub Category</option>
<?php
while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row["subcategory_id"]; ?>" <?php if($subCategory_id_update == $row['subcategory_id'] ) {echo "selected";} ?> ><?php echo $row["subcategory_name"]; ?></option>
    <?php
}



?>