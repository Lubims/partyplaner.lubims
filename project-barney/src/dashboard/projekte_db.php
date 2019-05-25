<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "alkdb";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = 'SELECT * from projekte';
    if (mysqli_query($conn, $sql)) {
    echo "";
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $count=1;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) { ?>
    <tbody>
    <tr>
    <th>
    <?php echo ['projekte_ProjektID']; ?>
    </th>
    <td>
    <?php echo $row['product_name']; ?>
    </td>
    <td>
    <?php echo $row['product_price']; ?>
    </td>
    <td>
    <?php echo $row['product_cat']; ?>
    </td>
    <td>
    <?php echo $row['product_details']; ?>
    </td>
    </tr>
    </tbody>
    <?php
    $count++;
    }
    } else {
    echo '0 results';
    }
    ?>