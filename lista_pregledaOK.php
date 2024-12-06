<?php




session_start();

require_once("konekcijaOK.php");


print "
    <ul>
        
        <li class='odjava'><a href='logovanjeOK.php'>Odjava</a></form></li>
        <li class='pocetna'><a href='pocetnaOK.php'>Pocetna</a></form></li>

    </ul>
";





$pozdrav=$_SESSION['ime'];
$lozinka=$_SESSION['lozinka'];
$izabrana_sifra=$_SESSION['izabrana_sifra'];
$datum=$_SESSION['datum'];
$jmbg=$_SESSION['jmbg'];

print"<br>";
print"Pregled zakazanih pregleda";
print"<br>";



$upit=" SELECT * FROM klijent_pregled WHERE sifra_klijenta='$lozinka' ";
$result=mysqli_query($db,$upit);

if(mysqli_num_rows($result)>0){

    print"<table>";
    print"<tr>";

while($row=mysqli_fetch_array($result)){

    $sifra_k=$row[0];
    $sifra_p=$row[1];
    $jmbg_k=$row[2];
    $datum_p=$row[3];
    $cena_p=$row[4];
    $naziv_p=$row[5];


    print"<tr>";
   print"<td>     $sifra_k     </td>";
   print"<td>   $sifra_p    </td>";
   print"<td>    $jmbg_k  </td>";
   print"<td>     $datum_p    </td>";
   print"<td>     $cena_p    </td>";
   print"<td>      $naziv_p    </td>";
   print"</tr>";



}
print"</table>";

}


print"<br>";
print"Ukoliko želite da otkažete pregled, upišite njegovdatum i vreme";
print"<br>";



if($_SERVER["REQUEST_METHOD"] =="POST"){


    $sifra_brisanje=mysqli_real_escape_string($db,$_POST['sifra_brisanje']);
    
    
    
    $select="SELECT * FROM klijent_pregled WHERE datum_pregleda= '$sifra_brisanje' AND sifra_klijenta='$lozinka'  ";
    $rezultat=mysqli_query($db,$select);

    if(mysqli_num_rows($rezultat)>0){
        
            print"pregled postoji<br>";
        $brisanje="DELETE FROM klijent_pregled WHERE datum_pregleda='$sifra_brisanje' AND sifra_klijenta='$lozinka' ";
        $rezultat1=mysqli_query($db,$brisanje);

        if($rezultat1==TRUE){
            print"Pregled je uspesno obrisan<br>";
            header("Location: lista_pregledaOK.php");  

        }
        else{
            print"Greska prilikom brisanja pregleda, pregled ne postoji u zakazanim.";
        }
    } else {
        print"Datum nije pronadjen u tabeli, nije nista obrisano";


}
}






?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="lista_pregledaOK.php" method="POST">
        Datum i vreme pregleda:
        <input type="datetime-local" id="sifra_brisanje" name="sifra_brisanje" required>
        <br>
        
        <input type="submit" value="Potvrdi">
</form>




</body>
</html>