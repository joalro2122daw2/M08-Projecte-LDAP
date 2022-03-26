<?php 
require_once("GestorLdap.php");


if(isset($_POST["post"]))
{

    switch ($_POST["post"]){
        case "usuari":
            GestorLdap::mostrarDadesUsuari($_POST["uid"],$_POST["ou"],true);
            break;
        case "editarUsuari":
            GestorLdap::mostrarAtributsPerAModificar($_POST["uid"],$_POST["ou"]);
            break;
        case "canviarAtribut":
            if(!empty($_POST['radio'])) {
                //echo '  ' . $_POST['radio'];
                GestorLdap::canviarAtribut($_POST["radio"]);
            } else {
                echo 'Si us plau seleccioneu una opció.';
            }            
            break;
    }
}


if(isset($_GET["get"]))
{
    switch ($_GET["get"]){
        case "mostraFormulariDadesUsuari":       
            require("../html/FormulariObtenirUsuari.html");
            break;
        case "mostraFormulariEditarUsuari":
            require("../html/FormulariObtenirUsuariPerEditar.html");
            break;
    }
}

if(isset($_POST["put"]))
{
    switch ($_POST["put"]){
        case "dadesAtribut":
            GestorLdap::canviarDadaUsuari($_POST["param"],$_POST["tbNouvalor"]);
            break;
    }
}

/*
if(isset($_PUT["metode"]))
{
    switch ($_PUT["metode"]){
        case "dadesAtribut":
            GestorLdap::mostrarDadesUsuari($_PUT["tbNouvalor"]);
            break;
        
    }
}

*/















?>