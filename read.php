<?php
include ("connection.php");
$connection = new Connection();
include ("client.php");
$connection->selectDatabase("cdtx");

$clients = [];
if (isset($_POST['submitB'])) {
    $clients = Client::selectClientsByCity('clients', $connection->conn, $_POST['cities']);
} else {
    $clients = Client::selectAllClients("clients", $connection->conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - List of Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

      
        body {
            background-color: #e0f7fa; 
            color: #2f4f4f; 
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #00695c; 
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .btn-primary, .btn-success, .btn-danger {
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #00796b;
            border-color: #00796b;
        }

        .btn-primary:hover {
            background-color: #004d40;
            border-color: #004d40;
        }

        .btn-success {
            background-color: #388e3c;
            border-color: #388e3c;
        }

        .btn-success:hover {
            background-color: #2c6e2f;
            border-color: #2c6e2f;
        }

        .btn-danger {
            background-color: #e53935;
            border-color: #e53935;
        }

        .btn-danger:hover {
            background-color: #b71c1c;
            border-color: #b71c1c;
        }

        .row.mb-3 {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #00695c;
            color: white;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .form-select {
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-left: 5px; 
        }

        .input-group-btn button {
            border-radius: 5px;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        
    </style>
</head>
<body>

<div class="container my-5">
    <h2>List of users from database</h2>
    <a class="btn btn-primary" href="create.php" role="button">Signup</a>

    <br><br>

    <form method="post">
        <div class="input-group">
            <button class="btn btn-success" type="submit" name="submitB">Search by city</button>
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="cities"></label>
                <div class="col-sm-6">
                    <select name='cities' class="form-select">
                        <option selected>Select your city</option>
                        <?php
                        include("City.php");
                        $cities = City::selectAllCities('Cities', $connection->conn);
                        foreach ($cities as $city) {
                            echo "<option value='$city[id]'>$city[cityName]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>City Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($clients as $row) {
                $city = City::selectCityById('cities', $connection->conn, $row['idCity']);
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['firstname']}</td>
                    <td>{$row['lastname']}</td>
                    <td>{$row['email']}</td>
                    <td>{$city['cityName']}</td>
                    <td>
                        <a class='btn btn-success' role='button' href='update.php?updatedId={$row['id']}'>Edit</a>
                        <a class='btn btn-danger' role='button' href='delete.php?deletedId={$row['id']}'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
