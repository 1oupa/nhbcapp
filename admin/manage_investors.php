<?php 
require '../core/init.php';
?>

<?php
    $view_investors = $investors->get_investors();
?>

<?php
    if (isset($_POST['edit'])){
   
    }

    if (isset($_POST['statements'])){
   
    }

    if (isset($_GET['delete'])){

        $investor_id = $_GET['delete'];
        $investors->delete_investor($investor_id);

        header('Location:manage_investors.php');
    }
?>

<!DOCTYPE html>
<html>
<body>

<!-- MANAGE INVESTORS START -->

    <h1>MANAGE INVESTORS</h1>
    <br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Contact</th>
                <th>Organisation</th>
                <th>Address</th>
                <th colspan="2.5">Action</th>
            </tr>
        </thead>
        <?php foreach($view_investors as $row) { ?>
        <tr>
            <td><?php echo $row['investor_id']; ?></td>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name'];?></td>
            <td><?php echo $row['contact'];?></td>
            <td><?php echo $row['organisation'];?></td>
            <td><?php echo $row['addr1']." ".$row['addr2']." ".$row['addr3']." ".$row['addr4'];?></td>
            <td>
                <input type="submit" value="Edit" name="edit" />
                
            </td>
            <td>
                <input type="submit" value="Statements" name="statements" />
            </td>
            <td>
                <input type="submit" value="Delete" name="delete" 
                onclick='return confirm("Are you sure you want to delete this investor (<?php echo $row['first_name']." ".$row['last_name']; ?>)?")'/>
                <a href="manage_investor.php?delete=<?php echo $row['investor_id']; ?>" class="delete" >delete</a>
            </td>
        </tr>
    <?php } ?>
    </table>

<!-- MANAGE INVESTORS END -->

</body>
</html>