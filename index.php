﻿<?php session_start();
include("connection.php");
$nick="";
if (isset($_SESSION['login'])) {
	$nick = $_SESSION['login'];
}
if (empty($nick)) {
	echo '<br>Nie byłeś zalogowany albo zostałeś wylogowany<br><a href="login.php">Zaloguj się</a><br>';
	echo 'Lub <a href="register.php">Zarejestruj się</a>';
	exit;
}

// tresc dla zalogowanego uzytkownika
echo 'Witaj '.$nick.' zostałeś/aś pomyślnie zalogowany/a <br/>';
echo '<a href="edit.php">Edytuj swój profil</a><br />';
echo '<a href="addDiary.php">Dodaj nowy dziennik</a><br />';
echo '<a href="addEditor.php">Dodaj nowego redaktora</a><br />';
$dziennik = mysql_query("SELECT * FROM dzienniki WHERE IdDziennika='$nick'");
if (mysql_num_rows($dziennik)==1) {
$_SESSION['dziennik']=$dziennik;
echo '<a href="addInscription.php">Dodaj wpis do dziennika</a><br />';
}
$wpis = mysql_query("SELECT * FROM wpisy");
if (mysql_num_rows($wpis)!=0) {
$result = mysql_fetch_array($wpis);
echo '<a href="editInscription.php?idWpisu='.$result['IdWpis'].'">Edytuj wpis</a><br />';
}
echo '<br><a href="wyloguj.php">Wyloguj mnie</a>';
?>