<?php
//require "auto.php";
//header("Content-type:application/json"); 


$conn = new mysqli("localhost","root","","sakila");
$q=$conn->query("select * from actor limit 50");

$sve=[];
while($rw=$q->fetch_assoc()){
    array_push($sve,$rw);
}
echo json_encode($sve);


/*
$fp=fopen("daki.json","w");
fwrite($fp,json_encode($sve));
fclose($fp);
*/



die;
$strana = isset($_GET['str']) ? $_GET['str']-1 : 0;
$poStrani = 8;
$ukupnoKomada = count($sve);
$ukupnoStrana = ceil($ukupnoKomada / $poStrani);

$pageIndex=$strana * $poStrani;
$max=$pageIndex+$poStrani;

if($max > $ukupnoKomada ){
    $max = $ukupnoKomada;
}
echo "Max broj u nizu : ". $max."<br>";
echo "Pocetak broja u nizu : " .$pageIndex ."<br>";

for($i=$pageIndex;$i<$max;$i++){
    echo "<div style='border: 1px solid red;paddin: 5px;margin:5px;text-align:center;'>
    Id = <strong>{$sve[$i][0]}</strong><br>
    Ime : {$sve[$i][1]} <br>
    Prezime : {$sve[$i][2]}
    </div>"  ;
}
echo "<br><hr>";
for($i=0;$i<$ukupnoStrana;$i++){
    echo $strana == $i ? "| page ".(($i+1)." |") : "<a style='text-decoration:none;' href='?str=".($i+1)."'>  ".($i+1)." </a>";
}
