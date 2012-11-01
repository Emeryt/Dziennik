﻿<?php
session_start();
include("connection.php");

/** Potrzebuje z sesji:
 login - nick danego usera(redaktora), który dodaje wpis
 dziennik - idDziennika, do którego wpis jest dodawany
Czyli przed wywołaniem skryptu trzeba dodał do sesji 'dziennik'!
  
 * Po przeanalizowaniu bazy uznałem, że gdy wpis dodaje autor pole NickRed zostaje puste.
 (Ewentualnie można przerobić zeby zawsze dodawac nick osoby dodającej wpis.)
 
 **/

if (isset($_SESSION['dziennik'])) {
if(isset($_POST['submit'])) {
    $login = $_SESSION['login'];
    $dziennik = $_SESSION['dziennik'];
    $tytul = $_POST['title'];
    $wpis = $_POST['inscription'];
    $data = date("Y-m-d");
    
    if ($login == $dziennik) {
        $query=mysql_query("INSERT INTO wpisy (IdDziennika,Tytul,Tekst,DataWpisu) VALUES('$dziennik','$tytul','$wpis','$data')");
    } else {
        $query=mysql_query("INSERT INTO wpisy (IdDziennika,NickRed,Tytul,Tekst,DataWpisu) VALUES('$dziennik','$login','$tytul','$wpis','$data')");
    }
    if ($query) {
        echo '<br><span style="color: green; font-weight: bold;">Wpis został dodany! </span><br>';
    } else {
        echo '<br><span style="color: red; font-weight: bold;">Błąd połączenia z bazą danych! </span><br>';
    }
}

?>

<link href="" type="text/css" rel="stylesheet"/>      
<title>Multimedialny dziennik podróży - dodawanie zdarzenia.</title>        
<table>        
    <th>         
    <td>            
        <form name="addInscription" method="POST" action="addInscription.php">                
        <p><label for="title">Tytuł zdarzenia: </label></p>                
        <p> <input type="text" name="title" size="30" autofocus required="required"/>                    
            <button> Uprawnienia </button>                 
        </p>                
        <p><label for="inscription">Wpis: </label></p>                
        <p><textarea name="inscription" rows="20" cols="60" required="required"/></textarea></p>                
        <p class="center">                    
           <input type="reset" value="Wyczyść pola"/>                    
           <input type="submit" class="submit" name="submit" value="Zapisz"/>                
        </p>            
        </form>         
    </td>           
    </th>        
    <th>                    
        <table>               
        <tr><td><label>Załącz zdjęcie: </label></td></tr>            
        <tr><td><button>Przeglądaj</button></td></tr>            
        <tr><td><textarea>Tu będzie kontener multimediów. </textarea></td></tr>
        <tr><td><label>Załącz video: </label></td></tr>    
        <tr><td><button>Przeglądaj</button></td></tr>    
        <tr><td><textarea>Tu będzie kontener multimediów. </textarea> </td></tr>    
        <tr><td><label>Załącz plik audio: </label></td></tr>    
        <tr><td><button>Przeglądaj</button></td></tr>    
        <tr><td><textarea>Tu będzie kontener multimediów. </textarea> </td></tr>                
        </table>
    </th>
</table>

<?php
} else {
    echo '<br><span style="color: red; font-weight: bold;">Nie został wybrany dziennik, do którego wpis ma być dodany!</span><br>' ;
}
?>