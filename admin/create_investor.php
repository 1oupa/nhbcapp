<?php 
require '../core/init.php';
?>

<?php
    if (isset($_POST['create_investor'])){
        $first_name     = htmlentities($_POST['first_name']);  
        $last_name 		= htmlentities($_POST['last_name']);
        $cell           = htmlentities($_POST['cell']);  
        $organisation 	= htmlentities($_POST['organisation']);
        $addr1          = htmlentities($_POST['addr1']);  
        $addr2 			= htmlentities($_POST['addr2']);  
        $addr3          = htmlentities($_POST['addr3']);  
        $addr4    		= htmlentities($_POST['addr4']);  
        
        $investors->insert_investor($first_name,$last_name,$cell,$organisation,
                                    $addr1,$addr2,$addr3,$addr4);
        header('Location:investment_details.php');
    }

?>

<!DOCTYPE html>
<html>
<body>

    <h1>CREATE INVESTOR</h1>
    <br>

<!-- CREATE NEW INVESTOR ACCOUNT START -->

    <form method="post" action="">
    <h2>CREATE NEW INVESTOR ACCOUNT</h2>
        <h3>PERSONAL DETAILS</h3>    
        <label>First Name</label>
            <input type="text" name="first_name"/>
        <br>
        <label>Last Name</label>
            <input type="text" name="last_name" />
        <br>
        <label>Cell</label>
            <input type="text" name="cell"/>
        <br>
        <label>Organisation</label>
            <input type="text" name="organisation"/>
        <br>
        <label>Street</label>
            <input type="text" name="addr1"/>
        <br>
        <label>Surburb</label>
            <input type="text" name="addr2"/>
        <br>
        <label>City/Town</label>
            <input type="text" name="addr3"/>
        <br>
        <label>Province</label>
            <input type="text" name="addr4"/>
        <br>
            <input type="submit" value="Create" name="create_investor" />
    </form>

<!-- CREATE NEW INVESTOR ACCOUNT END -->

</body>
</html>