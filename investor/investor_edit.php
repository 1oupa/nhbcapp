<?php 
require '../core/init.php';
$investor_id = 1;
?>

<?php
    $view_investor = $investors->investor_data($investor_id);
?>

<?php  
    if (isset($_POST['update_investor'])){

        $first_name     = htmlentities($_POST['first_name']);  
        $last_name 		= htmlentities($_POST['last_name']);
        $cell           = htmlentities($_POST['cell']);  
        $organisation 	= htmlentities($_POST['organisation']);
        $addr1          = htmlentities($_POST['addr1']);  
        $addr2 			= htmlentities($_POST['addr2']);  
        $addr3          = htmlentities($_POST['addr3']);  
        $addr4    		= htmlentities($_POST['addr4']);  
        
        $investors->update_investor($first_name,$last_name,$cell,$organisation,
                                    $addr1,$addr2,$addr3,$addr4);

        header('Location:../admin/manage_investors.php');
    }
?>

<!DOCTYPE html>
<html>
<body>

<!-- INVESTOR EDIT START -->
    <h1>Welcome,</h1>
    <p>INVESTOR DASHBOARD UNDER CONSTRUCTION</p>
    <br>

    <h1>ADMIN PROFILE</h1>
    <br>
    <h3>INVESTOR DETAILS</h3>
    <form method="post" action="">
    <?php foreach($view_investor as $row) { ?>
        <label>First Name</label>
            <input type="text" name="first_name" value="<?php echo $row['first_name']?>"/>
            <br>
        <label>Last Name</label>
            <input type="text" name="last_name" value="<?php echo $row['last_name']?>"/>
            <br>
        <label>Contact</label>
            <input type="text" name="contact" value="<?php echo $row['contact']?>"/>
            <br>            
        <label>Organisation</label>
            <input type="text" name="organisation" value="<?php echo $row['organisation']?>"/>
            <br>
        <label>Street</label>
            <input type="text" name="addr1" value="<?php echo $row['addr1']?>"/>
            <br>
        <label>Surburb</label>
            <input type="text" name="addr2" value="<?php echo $row['addr2']?>"/>
            <br>
        <label>City</label>
            <input type="text" name="addr3" value="<?php echo $row['addr3']?>"/>
            <br>
        <label>Province</label>
            <input type="text" name="addr4" value="<?php echo $row['addr4']?>"/>
            <br>
        <input type="submit" value="Update" name="update_investor" />
    <?php }?>
    </form>
    <br>
    <h3>INVESTMENT DETAILS</h3>

<!-- INVESTOR EDIT END -->
</body>
</html>