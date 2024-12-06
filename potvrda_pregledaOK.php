<?php

session_start();

require_once("konekcijaOK.php");

$pozdrav=$_SESSION['ime'];
$lozinka=$_SESSION['lozinka'];
$izabrana_sifra=$_SESSION['izabrana_sifra'];


print "
    <ul>
        <li><p class='active'>Pozdrav $pozdrav</p></li>
        <li class='odjava'><a href='logovanjeOK.php'>Odjava</a></form></li>
        <li> Zakažite pregled </li>

    </ul>
";

$prikaz="SELECT * FROM pregled WHERE sifra_pregleda='$izabrana_sifra' ";
$result=mysqli_query($db,$prikaz);

while($row=mysqli_fetch_array($result)){
   $sifra=$row[0];
   $naziv=$row[1];
   $cena=$row[2];
   print"<tr>";
   print"<td>   $sifra  </td>";
   print"<td>   $naziv</td>";
   print"<td>    $cena   </td>";
   print"</tr>";

}


if(ISSET($_POST["datum"], $_POST["jmbg"])  ){


    $datum=mysqli_real_escape_string($db,$_POST["datum"]);
    $jmbg=mysqli_real_escape_string($db,$_POST["jmbg"]);

    $_SESSION['datum']=$datum;
    $_SESSION['jmbg']=$jmbg;


if(!empty($_POST["datum"]) && !empty($_POST["jmbg"])){

$insert=" INSERT INTO klijent_pregled(sifra_klijenta, sifra_pregleda, jmbg_klijenta, datum_pregleda, cena_pregleda, naziv_pregleda)
 VALUES('$lozinka','$izabrana_sifra', '$jmbg','$datum', '$cena', '$naziv') ";
$result1=mysqli_query($db,$insert);

if($result1==TRUE){

    header("Location: lista_pregledaOK.php");

}
else{
    print"Niste uneli sva polja";
}

}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forma za potvrdu pregleda</title>
    <style>
        /* Reset osnovnih stilova */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        form input[type="text"],
        form input[type="datetime-local"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        form input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        form label {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Potvrda pregleda</h2>
        <form action="potvrda_pregledaOK.php" method="POST">
            <label for="datum">Unesite datum i vreme pregleda:</label>
            <input type="datetime-local" name="datum" id="datum">

            <label for="jmbg">Unesite JMBG:</label>
            <input type="text" name="jmbg" id="jmbg">

            <input type="submit" value="Potvrdi">
        </form>
    </div>
</body>
</html>
