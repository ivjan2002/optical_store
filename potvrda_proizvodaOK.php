<?php

session_start();

require_once("konekcijaOK.php");

$pozdrav=$_SESSION['ime'];
$lozinka=$_SESSION['lozinka'];
$izabrani_proizvod=$_SESSION['izabrani_proizvod'];


print "
    <ul>
        <li><p class='active'>Pozdrav $pozdrav</p></li>
        <li class='odjava'><a href='logovanjeOK.php'>Odjava</a></form></li>
        <li>  Porucite odabrani proizvod </li>

    </ul>
";


/*  USLOV ZA STANJE   */ 
$uslov="SELECT * FROM proizvod WHERE sifra_proizvoda='$izabrani_proizvod' ";
$rez=mysqli_query($db,$uslov);



    while($row=mysqli_fetch_array($rez)){
        $sif=$row[0];
        $naz=$row[1];
        $kol=$row[2];
        $cena=$row[3];
        
        
        
        print"<tr>";
        print"<td>  $sif  </td>";
        print"<td>   $naz  </td>";
        print"<td> Stanje:  $kol  </td>";
        print"<td> Cena:   $cena  </td>";
        
        print"</tr>";
     }
     
print"<br>";
print"Unesite zeljenu kolicinu";


if(ISSET($_POST["zeljena_kolicina"]) ){
     
    $zeljena_kolicina=mysqli_real_escape_string($db,$_POST["zeljena_kolicina"]);
    $_SESSION['zeljena_kolicina']=$zeljena_kolicina;

    
    if(!empty($_POST["zeljena_kolicina"])  ){


            $insert=" INSERT INTO klijent_proizvod(sifra_klijenta,sifra_proizvoda,naziv_proizvoda, kolicina_kupljena, cena)
            VALUES ('$lozinka', '$izabrani_proizvod' ,'$naz', '$zeljena_kolicina','$cena')";
            $result=mysqli_query($db,$insert);


        if($result==TRUE){
            header("Location: lista_kupljenih_proizvodaOK.php");
        }
        else{

            print"Niste uneli kolicinu ";
        }


    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forma za potvrdu proizvoda</title>
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
        <h2>Unos količine proizvoda</h2>
        <form action="potvrda_proizvodaOK.php" method="POST">
            <label for="zeljena_kolicina">Unesite željenu količinu:</label>
            <input type="text" name="zeljena_kolicina" id="zeljena_kolicina">

            <input type="submit" value="Potvrdi">
        </form>
    </div>
</body>
</html>
