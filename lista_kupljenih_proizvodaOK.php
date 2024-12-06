<?php
session_start();

require_once("konekcijaOK.php");

$pozdrav=$_SESSION['ime'];
$lozinka=$_SESSION['lozinka'];
$izabrani_proizvod=$_SESSION['izabrani_proizvod'];
$zeljena_kolicina=$_SESSION['zeljena_kolicina'];


print "
    <ul>
        <li><p class='active'>Pozdrav $pozdrav</p></li>
        <li class='odjava'><a href='logovanjeOK.php'>Odjava</a></form></li>
        <li class='pocetna'><a href='pocetnaOK.php'>Pocetna</a></form></li>

        <li>  Obrada kupovine </li>

    </ul>
";



$uslov_kolicine="SELECT * FROM klijent_proizvod NATURAL JOIN proizvod WHERE kolicina > '$zeljena_kolicina' AND sifra_proizvoda= '$izabrani_proizvod' and sifra_klijenta='$lozinka' and kolicina_kupljena='$zeljena_kolicina' ";
$rez_kol=mysqli_query($db,$uslov_kolicine);

    if(mysqli_num_rows($rez_kol)>0){

        print"Ima na stanju -->  cena je izrazena po jedinici proizvoda ; Hvala na kupovini !";
        print"<br>";


        $update=" SELECT (kolicina-kolicina_kupljena) AS razlika FROM proizvod  natural join klijent_proizvod WHERE sifra_proizvoda= '$izabrani_proizvod' and sifra_klijenta='$lozinka' and kolicina_kupljena='$zeljena_kolicina' ";
        $rez_update=mysqli_query($db,$update);



        
if(mysqli_num_rows($rez_update)>0){

    while($red=mysqli_fetch_array($rez_update)){
        $razlika=$red[0];
       /* print"Razlika je $razlika";  */
    }
    
    
    }
    else{
    
        print"nije uspelo update";
    }
    
    
    
    $update1=" UPDATE proizvod SET kolicina= '$razlika' where sifra_proizvoda= '$izabrani_proizvod' ";
    $rezzultat1=mysqli_query($db,$update1);
    
    if($rezzultat1==TRUE){
        print"Podaci uspesno azurirani";
    
    
    }
    else{
    
        print"Podatke rucno azurirati ";
    }
    
    
    







        while($row=mysqli_fetch_array($rez_kol)){

            $sifra_kl=$row[0];
            $sifra_pr=$row[1];
            $naziv_pr=$row[2];
            $cena_p=$row[3];

            
            $def_kol=$row[4];


            print"<tr>";
            print"</tr>   $sifra_kl   </tr>";
            print"</tr>   $sifra_pr   </tr>";
            print"</tr>   $naziv_pr    </tr>";
            print"</tr>    $def_kol   </tr>";
            print"</tr>     $cena_p   </tr>";
            print"</tr>";
            print"<br>";
            print"<br>";
                


        }
    }
     else{
        print"Vaseg proizvoda nema na stanju u izabranoj kolicini :( ";
}


?>