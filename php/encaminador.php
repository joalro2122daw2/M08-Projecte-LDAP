<?php 
require_once("GestorLdap.php");


if(isset($_POST["metode"]))
{

    switch ($_POST["metode"]){
        case "usuari":
            GestorLdap::mostrarDadesUsuari($_POST["uid"],$_POST["ou"]);
            break;
    }
}


if(isset($_GET["metode"]))
{
    switch ($_GET["metode"]){
        case "mostraFormulariDadesUsuari":
            require("../html/FormulariObtenirUsuari.html");
            break;
    }
}



















?>