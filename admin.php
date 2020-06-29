<?php
@session_start();

$LangArray = array("ru", "uk", "en");
$DefaultLang = "ru";

$language = addslashes($_GET['lang']);

if($language) 
{
    if(!in_array($language, $LangArray)) 
    {
        $_SESSION['NowLang'] = $DefaultLang;
    } else 
    {
        $_SESSION['NowLang'] = $language;
    }
}

$CurentLang = addslashes($_SESSION['NowLang']);
include_once ("lang.".$CurentLang.".php");

if(isset($_GET['lang'])) 
{
    echo $translate['hello_admin'] .' '.  $_SESSION['name'].' ' . $_SESSION['surname'] . $translate['hello_admin2'];
}

echo '<br><a href="admin.php?lang=ru">ru</a>';
echo '<br><a href="admin.php?lang=en">en</a>';
echo '<br><a href="admin.php?lang=uk">uk</a>';
?>