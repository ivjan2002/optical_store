<?php
session_start();

require_once("konekcijaOK.php");


print "
    <ul>
        
        <li class='odjava'><a href='registracijaOK.php'>Registracija</a></form></li>

    </ul>
";

if(ISSET($_POST["ime"], $_POST["lozinka"]) && !empty($_POST["ime"]) && !empty($_POST["lozinka"]) ){

    $ime=mysqli_real_escape_string($db,$_POST["ime"]);
    $lozinka=mysqli_real_escape_string($db,$_POST["lozinka"]);

    $_SESSION['ime']=$ime;
    $_SESSION['lozinka']=$lozinka;

    $upit="SELECT * FROM klijent WHERE sifra_klijenta='$lozinka' AND ime_prezime='$ime' ";
    $result=mysqli_query($db,$upit);

    if(mysqli_num_rows($result)==1){
        header("Location: pocetnaOK.php");

    }

    else{
        

        header("Location: registracijaOK.php");
        


    }


    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Resetovanje osnovnih stilova */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        form input[type="text"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        form label {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        form br {
            margin-bottom: 10px;
        }

        /* Dodavanje lepog naslova */
        form::before {
            content: "Prijava";
            display: block;
            font-size: 20px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <form action="logovanjeOK.php" method="POST">
        <label for="ime">Ime</label>
        <input type="text" name="ime" id="ime">
        <label for="lozinka">Lozinka</label>
        <input type="password" name="lozinka" id="lozinka">
        <input type="submit" value="Prijavi se">
    </form>
</body>
</html>


