<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple invitations</title>
    <link href="../style/style2.css" rel="stylesheet">
</head>
<body >
    <nav>
        <ul>
            <li><a href="../invitation_info/information_s.html">Качи покана</a></li>
            <li><a href="../invitations/uploadedinv_students.php">Качени покани</a></li>
            <li><a href="../filters/filter.html">Филтрирай покани</a></li>
        </ul>
    </nav> 
    <header>
        <h1>Качени покани</h1>
    </header>
    <table>
        <tr>
            <th>№</th>
            <th>Заглавие</th>
            <th>Дата на презентиране</th>
            <th>Час</th>
            <th>Предмет</th>
            <th>Място на презентиране</th>
        </tr>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "invitations_generator");
        if($conn->connect_error)
        {
            die("Connection failed:".$conn->connect_error);
        }

        $sql = "select * from `invitations`";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                echo "<tr><th>".$row["id"]."</th><th>".$row['title']."</th><th>".$row['date']."</th><th>".$row['time']."</th><th>".$row['subject']."</th><th>".$row['place']."</th></tr>";
            }
            echo "</table>";
        }
        ?>
    </table>
</body>
</main>
</html>