<?php
session_start();

require_once("konekcijaOK.php");

$pozdrav=$_SESSION['ime'];
$lozinka=$_SESSION['lozinka'];


print "
    <ul>
        <li><p class='active'>Pozdrav $pozdrav</p></li>
        <li class='odjava'><a href='logovanjeOK.php'>Odjava</a></form></li>
        

    </ul>
";





$pregled="SELECT * FROM pregled";
$result=mysqli_query($db,$pregled);

print"Pregledi";

if(mysqli_num_rows($result)>0){

    print"<table>";
    print"<tr>";
    print"<th>sifra pregleda</th>";
    print"<th>naziv pregleda</th>";
    print"<th>cena pregleda</th>";
    
    

    while($i=mysqli_fetch_array($result))
    {
    
        $sifra=$i[0];
        $naziv=$i[1];
        $adresa=$i[2];
        

        print"<tr>";
        print"<td>$sifra</td>";
        print"<td>$naziv</td>";
        print"<td>$adresa</td>";
        print"</tr>";

    }
   print"</table>";
}






if(ISSET($_POST["izabrana_sifra"] ) && !empty($_POST["izabrana_sifra"])){

    $izabrana_sifra=mysqli_real_escape_string($db,$_POST["izabrana_sifra"]);
    $_SESSION['izabrana_sifra']=$izabrana_sifra;

    $upit="SELECT * FROM pregled WHERE sifra_pregleda='$izabrana_sifra'  ";
    $rezultat=mysqli_query($db,$upit);

    if(mysqli_num_rows($rezultat)==1){
        header("Location: potvrda_pregledaOK.php");

    }
   
    else{
        print"Ponovite unos sifre";
    }


}

print"<br>";
print"<br>";


print"Proizvodi";
print"<br>";

$proizvodi="SELECT * FROM proizvod ";
$result1=mysqli_query($db,$proizvodi);

if(mysqli_num_rows($result1)>0){
    
    print"<table>";
    print"<tr>";
    print"<th>sifra proizvoda</th>";
    print"<th>naziv proizvoda</th>";
    print"<th>kolicina proizvoda</th>";
    print"<th>cena proizvoda</th>";
    
    

    while($j=mysqli_fetch_array($result1))
    {
    
        $sif=$j[0];
        $naz=$j[1];
        $kol=$j[2];
        $cena=$j[3];
        
        
        
        print"<tr>";
        print"<td>$sif</td>";
        print"<td>$naz</td>";
        print"<td>$kol</td>";
        print"<td>$cena</td>";
        
        print"</tr>";

    
    }
    
   print"</table>";
}

print"<br>";


if(ISSET($_POST["izabrani_proizvod"] ) && !empty($_POST["izabrani_proizvod"])){

    $izabrani_proizvod=mysqli_real_escape_string($db,$_POST["izabrani_proizvod"]);
    $_SESSION['izabrani_proizvod']=$izabrani_proizvod;

    $upit3="SELECT * FROM proizvod WHERE sifra_proizvoda='$izabrani_proizvod'  ";
    $rezultat3=mysqli_query($db,$upit3);

    if(mysqli_num_rows($rezultat3)==1){
        header("Location: potvrda_proizvodaOK.php");

    }
   
    else{
        print"Ponovite unos sifre";
    }


}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forma za unos</title>
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

        form input[type="text"] {
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
        <h2>Forma za unos</h2>
        <form action="pocetnaOK.php" method="POST">
            <label for="izabrana_sifra">Unesite šifru pregleda:</label>
            <input type="text" name="izabrana_sifra" id="izabrana_sifra">

            <input type="submit" value="Potvrdi">

            <label for="izabrani_proizvod">Unesite šifru proizvoda koji želite da poručite:</label>
            <input type="text" name="izabrani_proizvod" id="izabrani_proizvod">

            <input type="submit" value="Potvrdi">
        </form>
    </div>
</body>
</html>


