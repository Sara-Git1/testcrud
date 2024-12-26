<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['role'])) {
        if ($_POST['role'] === 'personnel') {
            header('Location: create.php');
            exit();
        } else {
            header('Location: info.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil - Emsi.ma</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            color: #2f4f4f; 
            line-height: 1.6;
            padding-top: 80px; 
        }

        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 250px;
            height: auto;
        }

        h1 {
            color: #00695c; 
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        label {
            margin-right: 20px;
            cursor: pointer;
        }

        input[type="submit"] {
            background-color: #00796b;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #004d40; 
        }

        form input {
            margin-bottom: 15px;
        }

    </style>
</head>
<body>

    <img src="logo.png" alt="Logo Emsi" class="logo"> 

    <div class="container">
        <h1>Bienvenu sur le site de Emsi.ma</h1>
        <p><i>Veuillez mentionner si vous faites partie du personnel de l'administration ou d'un professeur :</i></p>

        <form action="acceuil.php" method="POST">
            <div>
                <input type="radio" id="personnel" name="role" value="personnel" required>
                <label for="personnel">Personnel de l'administration</label>
            </div>
            <div>
                <input type="radio" id="professeur" name="role" value="professeur" required>
                <label for="professeur">Professeur</label>
            </div>
            <br>
            <input type="submit" value="Valider">
        </form>
    </div>

</body>
</html>
