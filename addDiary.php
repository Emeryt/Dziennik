﻿<?php
session_start();
include ("connection.php");
$komunikaty = '';

/** Początek dodawania nowego dziennika **/
if ($_POST['wyslij'] && $_SESSION['zalogowany']){
$nick = $_SESSION['login'];
$spr1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM dzienniki WHERE IdDziennika='".$nick."' LIMIT 1"));
$nazwa = $_POST['name_diary'];
$options = $_POST['opt'];
$spr2 = strlen($nazwa);

if ($spr1[0]>=1){
$komunikaty.="Posiadasz już swój dziennik w systemie.<br />";
$stop = true;
}
else{
if ($spr2 < 4){
$komunikaty.="Nazwa dziennika powinna zawierać co najmniej 4 znaki.<br />";
}
if (!($komunikaty)){
if ($options == able){
$opt = ''.'TAK';
}
else{
$opt = ''.'NIE';
}
$result = mysql_query("INSERT INTO `dzienniki` (IdDziennika, Komentarze, Nazwa) VALUES ('".$nick."','".$opt."','".$nazwa."')");

if ($result){
 $komunikaty.="Dziennik o nazwie ".$nazwa." został dodany";
}
else { 
$komunikaty.=mysql_error();
}
}
}

/** Koniec dodawania nowego dziennika **/
}



?>
<?php
if ($_SESSION['zalogowany']){
$nick = $_SESSION['login'];
$spr1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM dzienniki WHERE IdDziennika='".$nick."' LIMIT 1"));
if ($spr1[0]>=1 && !$result){
$komunikaty.="Posiadasz już swój dziennik w systemie.<br />";
$stop = true;
}
?>
<title>Strona glowna</title>
<link rel="stylesheet" type="text/css" href="Data/cssFP.css">
<script type="text/javascript" src="jquery-1.8.2.min.js"></script>

</head>
<body>
<div id="inside">
<fieldset>
<h4>Utworz dziennik</h4>
<?php if ($komunikaty && !$result){ echo '<font color="red"><b>'.$komunikaty.'</b></font>';}
	else { echo '<font color="blue">'.$komunikaty.'</font>';}?>
<p>Nazwa dziennika:</p>
<form action="addDiary.php" method="POST">
<input type="text" id="newDiary_name" name="name_diary" size="40" value="Tutaj wpisz nazwę dziennika" required="required">
<p>Mozliwosc komentowania wpisow</p>
<input type="radio" name="opt" value="able" checked="yes">Wlacz<br>
<input type="radio" name="opt" value="disable">Wylacz
<br><br>
<input type="submit" class="submit" name="wyslij" value="Wyślij" <?php if ($stop) { echo'disabled="disabled"';}?>>
</form>
</fieldset>
</div>
<script>
$(document).ready(function() {
 $("#newDiary_name").click(function() {
  $(this).attr("value","");
  $(this).css("color","black");
  }); 
});
</script>
</body>
<?php 
}
else
echo '<br>Nie byłeś zalogowany albo zostałeś wylogowany<br><a href="login.php">Zaloguj się</a><br>'
?>