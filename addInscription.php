<?php
session_start();
include("connection.php");

/** Potrzebuje z sesji:
 login - nick danego usera(redaktora), kt�ry dodaje wpis
 dziennik - idDziennika, do kt�rego wpis jest dodawany
Czyli przed wywo�aniem skryptu trzeba doda� do sesji 'dziennik'!
  
 * Po przeanalizowaniu bazy uzna�em, �e gdy wpis dodaje autor pole NickRed zostaje puste.
 (Ewentualnie mo�na przerobi� zeby zawsze dodawac nick osoby dodaj�cej wpis.)
 
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
        echo '<br><span style="color: green; font-weight: bold;">Wpis zosta� dodany! </span><br>';
    } else {
        echo '<br><span style="color: red; font-weight: bold;">B��d po��czenia z baz� danych! </span><br>';
    }
}

?>

<link href="" type="text/css" rel="stylesheet"/>      
<title>Multimedialny dziennik podr�y - dodawanie zdarzenia.</title>        
<table>        
    <th>         
    <td>            
        <form name="addInscription" method="POST" action="addInscription.php">                
        <p><label for="title">Tytu� zdarzenia: </label></p>                
        <p> <input type="text" name="title" size="30" autofocus required/>                    
            <button> Uprawnienia </button>                 
        </p>                
        <p><label for="inscription">Wpis: </label></p>                
        <p><textarea name="inscription" rows="20" cols="60" required/> </textarea></p>                
        <p class="center">                    
           <input type="reset" value="Wyczy�� pola"/>                    
           <input type="submit" class="submit" name="submit" value="Zapisz"/>                
        </p>            
        </form>         
    </td>           
    </th>        
    <th>                    
        <table>               
        <tr><td><label>Za��cz zdj�cie: </label></td></tr>            
        <tr><td><button>Przegl�daj</button></td></tr>            
        <tr><td><textarea>Tu b�dzie kontener multimedi�w. </textarea></td></tr>
        <tr><td><label>Za��cz video: </label></td></tr>    
        <tr><td><button>Przegl�daj</button></td></tr>    
        <tr><td><textarea>Tu b�dzie kontener multimedi�w. </textarea> </td></tr>    
        <tr><td><label>Za��cz plik audio: </label></td></tr>    
        <tr><td><button>Przegl�daj</button></td></tr>    
        <tr><td><textarea>Tu b�dzie kontener multimedi�w. </textarea> </td></tr>                
        </table>
    </th>
</table>

<?php
} else {
    echo '<br><span style="color: red; font-weight: bold;">Nie zosta� wybrany dziennik, do kt�rego wpis ma by� dodany!</span><br>' ;
}
?>