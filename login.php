<?php
include 'config.php';
login:
echo "[?] Nomor HPmu : ";
$hp = trim(fgets(STDIN));
echo "[?] Password   : ";
$pass = trim(fgets(STDIN));
$body = '{"username":"'.$hp.'","password":"'.$pass.'"}';
$headers = xH($body);
$run = xLogin($body,$headers,$urllogin);
$xJ = json_decode($run, true);
$xM = $xJ["success"];
if($xM==true){
$sk = $xJ["data"]["secret_key"];
$nama = $xJ["data"]["fullname"];
$bl = $xJ["data"]["balance"];
echo "[?] Halo $nama saldo kamu sisa $bl";
sleep(2);
echo "\n[?] Secret Key : $sk\n";
} else {
echo "[?] Username atau password salah\n";
goto login;
}

