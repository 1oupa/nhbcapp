<?php 
require '../core/init.php';
?>

<?php
    $view_products = $products->get_products();
?>

<?php
    if (isset($_POST['add_details'])){
        $capital			        = htmlentities($_POST['capital']);  
        $start_date		            = htmlentities($_POST['start_date']);  
        $product_type		        = htmlentities($_POST['product_type']);  

        $investments->insert_investment($capital, $start_date, $product_type);
        header('Location:manage_investors.php');
    }
?>

<!DOCTYPE html>
<html>
<body>

    <h1>CREATE INVESTOR</h1>
    <br>

<!-- INVESTMENT DETAILS ADD START -->

    <form method="post" action="">
        <h3>INVESTMENT DETAILS</h3>    
        <label>Capital Invested</label>
            <input type="text" name="capital"/>
        <br>
        <label>Start Date</label>
            <input type="date" name="start_date" />
        <br>
        <label>Interest Type</label>
            <select name="product_type">
                <option value="fixed">Fixed</option>
                <option value="variable">Variable</option>
            </select>
        <br>
       <input type="submit" value="Complete Account" name="add_details" />
   </form>

<!-- INVESTMENT DETAILS ADD END -->

</body>
</html>