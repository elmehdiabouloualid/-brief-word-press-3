<?php
//absolute path to the WordPress directory.

 $connection = mysqli_connect("localhost", "root", "", "plugin");




$sql = "SELECT * from mehdi";
if($result = mysqli_query($connection, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
        echo '<table class="table table-bordered" style="width: 99%;margin-top: 32px;">';
            echo '<thead class="thead-dark">';
        echo '<tr>';
               
                echo '<th scope="col">username</th>';
                echo '<th scope="col">descriptions</th>';
                echo '<th scope="col">Options</th>';
            echo "</tr>";
        echo "</thead>";
        while($row = mysqli_fetch_array($result)){
            echo "<tbody>";
            echo "<tr>";
               
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['descriptions'] . "</td>";
                echo "<td>" . $row['Options'] . "</td>";
            echo "</tr>";
            echo "</tbody>";
            echo "</tbody>";
        }
        echo "</table>";
        echo '<a class="btn btn-primary" href="admin.php?page=Settings" role="button">ADD</a>';
    }



}

?>