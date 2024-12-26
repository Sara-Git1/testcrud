<?php
$errorMsg = "";
$fnameValue = "";
$lnameValue = "";
$emailValue = "";
$successMsg = "";

include("connection.php");
$connection = new Connection();
include("client.php");
$connection->selectDatabase("cdtx");

if (isset($_POST['submit'])) {

    $fnameValue = $_POST['firstName'];
    $lnameValue = $_POST['lastName'];
    $emailValue = $_POST['email'];
    $passValue = $_POST['password'];
    $idCityValue = $_POST['cities'];

    if (empty($fnameValue) || empty($lnameValue) || empty($emailValue) || empty($passValue)) {
        $errorMsg = "All fields must be filled in";
    } else if (strlen($passValue) < 8) {
        $errorMsg = "Password must contain at least 8 characters";
    } else if (preg_match('/[A-Z]+/', $passValue) == 0) {
        $errorMsg = "Password must contain at least one capital letter";
    } 
    else {
        $client = new Client($fnameValue, $lnameValue, $emailValue, $passValue, $idCityValue);
        $client->insertClient("clients", $connection->conn);
        $errorMsg = Client::$errorMsg;
        $successMsg = Client::$successMsg;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Emsi</title>
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
            max-width: 800px;
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

        
        .alert {
            margin-bottom: 20px;
        }

        
        .form-control {
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        
        .row.mb-3 {
            margin-bottom: 15px;
        }

        
        .btn-primary {
            background-color: #00796b; 
            border-color: #00796b;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #004d40; 
            border-color: #004d40;
        }

        .btn-outline-primary {
            border-color: #00796b;
            color: #00796b;
            font-size: 1rem;
            border-radius: 5px;
            padding: 10px 20px;
        }

        .btn-outline-primary:hover {
            background-color: #00796b;
            color: white;
        }

        .offset-sm-1 {
            margin-left: 10%;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 250px;
            height: auto;
        }

      
    </style>
</head>
<body>

    <img src="logo.png" alt="Logo Emsi" class="logo"> 

    <div class="container">

        <h2>Enregistrer un professeur avec sa ville</h2>

        <?php if (!empty($errorMsg)) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $errorMsg; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php if (!empty($successMsg)) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo $successMsg; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-form-label col-sm-3" for="fname">First Name:</label>
                <div class="col-sm-6">
                    <input value="<?php echo $fnameValue; ?>" class="form-control" type="text" id="fname" name="firstName">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-3" for="lname">Last Name:</label>
                <div class="col-sm-6">
                    <input value="<?php echo $lnameValue; ?>" class="form-control" type="text" id="lname" name="lastName">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-3" for="email">Email:</label>
                <div class="col-sm-6">
                    <input value="<?php echo $emailValue; ?>" class="form-control" type="email" id="email" name="email">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-3" for="cities">Cities:</label>
                <div class="col-sm-6">
                    <select name="cities" class="form-select">
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
            <div class="row mb-3">
                <label class="col-form-label col-sm-3" for="password">Password:</label>
                <div class="col-sm-6">
                    <input class="form-control" type="password" id="password" name="password">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button name="submit" type="submit" class="btn btn-primary">Signup</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="#">Login</a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>
