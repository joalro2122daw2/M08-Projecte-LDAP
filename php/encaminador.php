<?php 
require_once("GestorLdap.php");


if(isset($_POST["metode"]))
{

    switch ($_POST["metode"]){
        case "usuari":
            GestorLdap::mostrarDadesUsuari($_POST["uid"],$_POST["ou"],true);
            break;
        case "editarUsuari":
            GestorLdap::mostrarAtributsPerAModificar($_POST["uid"],$_POST["ou"]);
            break;
    }
}


if(isset($_GET["metode"]))
{
    switch ($_GET["metode"]){
        case "mostraFormulariDadesUsuari":       
            require("../html/FormulariObtenirUsuari.html");
            break;
        case "mostraFormulariEditarUsuari":
            require("../html/FormulariObtenirUsuariPerEditar.html");
            break;
    }
}



















?>