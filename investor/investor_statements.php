<?php 
require '../core/init.php';
?>

<?php
    $view_statements = $statements->get_statements();
?>

<?php
    
    if (isset($_POST['view_statement'])){

    }

    if (isset($_POST['download_statement'])){
   
    }

?>

<!DOCTYPE html>
<html>
<body>

<!-- INVESTOR STATEMENTS START -->

    <h1>STATEMENTS</h1>
    <br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Opening Balance</th>
                <th>Interest Accrued</th>
                <th>Withdrawal</th>
                <th>Closing Balance</th>
                <th colspan="2.5">Action</th>
            </tr>
        </thead>
        <?php foreach($view_statements as $row) { ?>
        <tr>    
            <td><?php echo $row['statement_id'];?></td>
            <td><?php echo $row['opening_balance']; ?></td>
            <td><?php echo $row['interest_accrued']; ?></td>
            <td><?php echo $row['withdrawal_amount'];?></td>
            <td><?php echo $row['closing_balance'];?></td>
            <td>
                <input type="submit" value="View" name="view_statement" />
            </td>
            <td>
                <input type="submit" value="Download" name="download_statement" />
            </td>
        </tr>
    <?php } ?>
    </table>

<!-- INVESTOR STATEMENTS END -->

</body>
</html>