<?php
session_start();

require_once("konekcijaOK.php");

print "Morate se registrovati: ";

if(ISSET($_POST["novo_ime"], $_POST["nova_lozinka"], $_POST["pol"], $_POST["email"] )){
        
    $novo_ime=mysqli_real_escape_string($db,$_POST["novo_ime"]);
    $nova_lozinka=mysqli_real_escape_string($db,$_POST["nova_lozinka"]);
    $pol=mysqli_real_escape_string($db,$_POST["pol"]);
    $email=mysqli_real_escape_string($db,$_POST["email"]);

    

    if(!empty($_POST["novo_ime"]) &&  !empty($_POST["nova_lozinka"]) && !empty($_POST["pol"]) && !empty($_POST["email"]) ){

    $upis=" INSERT INTO klijent(sifra_klijenta, ime_prezime, pol, mejl_adresa) VALUES ( '$nova_lozinka', '$novo_ime', '$pol', '$email' ) ";
    $result1=mysqli_query($db,$upis);

    if($result1==TRUE){
    
        header("Location: logovanjeOK.php");
    
    }
}
    else{
        print"Niste uneli sva polja za registraciju";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <style>
        /* Reset osnovnih stilova */
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
            width: 350px;
        }

        form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        form input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        form label {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        form br {
            margin-bottom: 10px;
        }

        /* Naslov forme */
        form::before {
            content: "Registracija";
            display: block;
            font-size: 22px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <form action="registracijaOK.php" method="POST">
        <label for="nova_lozinka">Unesite šifru:</label>
        <input type="text" name="nova_lozinka" id="nova_lozinka">

        <label for="novo_ime">Unesite ime:</label>
        <input type="text" name="novo_ime" id="novo_ime">

        <label for="pol">Unesite pol (M/Ž):</label>
        <input type="text" name="pol" id="pol">

        <label for="email">Unesite mejl adresu:</label>
        <input type="text" name="email" id="email">

        <input type="submit" value="Potvrdi unos">
    </form>
</body>
</html>
