<?php
include 'config.php';
function masukk($urllogin){
echo "===== LOGIN =====";
login:
echo "\n[?] Nomor HPmu : ";
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
}
function datar($urlregis){
	echo "===== REGISTER =====";
register:
echo "\n[?] Username   : ";
$user = trim(fgets(STDIN));
echo "[?] Nomor HPmu : ";
$hp = trim(fgets(STDIN));
echo "[?] Password   : ";
$pass = trim(fgets(STDIN));
$body = '{"fullname":"'.$user.'","username":"'.$hp.'","password":"'.$pass.'","referral_code":""}';
$headers = xH($body);
$run = xRegis($body,$headers,$urlregis);
$xJ = json_decode($run, true);
$xM = $xJ["success"];
if($xM==true){
echo "[?] Message : Success Register\n";
}else{
	echo "[?] Message : Kesalahan tidak diketahui\n";
	goto register;
	}
	}
//
function deposit($urldepo){
depo:
echo "[?] Masukan Nominal Deposit Contoh 5,000 : ";
$xD = trim(fgets(STDIN));
$body = '{"amount":"Rp'.$xD.'"}';
$headers = xH($body);
$run = xDepo($body,$headers,$urldepo);
$xJ = json_decode($run, true);
$xM = $xJ["success"];
if($xM==true){
	$id= $xJ["data"]["id"];
	$info = $xJ["data"]["amount"];
	echo "[?] ID Deposit $id";
	echo "\n[?] Silahkan bayar dengan Nominal $info ke Qris Berikut\n";
	system("xdg-open https://wnrstore.com/uploads/global/qris.jpeg");
	goto depo;
	} else {
		echo "[?] Kesalahan tidak diketahui\n";
		die;
		}
	}





echo "[1] Login";
echo "\n[2] Register";
echo "\n[3] Deposit";
echo "\n[?] Masukan Pilihanmu : ";
$xS = trim(fgets(STDIN));
switch ($xS){
	case 1:
	$anu = masukk($urllogin);
	die;
	case 2:
	$anu = datar($urlregis);
	die;
	case 3:
	$anu = deposit($urldepo);
	die;
	}