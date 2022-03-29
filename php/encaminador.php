<?php 
require_once("GestorLdap.php");

/* POSTS */
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

/* GETS */
if(isset($_GET["get"]))
{
    switch ($_GET["get"]){
        case "mostraFormulariDadesUsuari":       
            require("../html/FormulariObtenirUsuari.html");
            break;
        case "mostraFormulariEditarUsuari":
            require("../html/FormulariObtenirUsuariPerEditar.html");
            break;
        case "mostraFormulariCrearUsuari":
            require("../html/FormulariCrearUsuari.html");
            break;
        case "mostraFormulariEsborrarUsuari":
            require("../html/FormulariObtenirUsuariPerEsborrar.html");
            break;
    }
}

/* PUTS */
if(isset($_POST["put"]))
{
    switch ($_POST["put"]){
        case "dadesAtribut":
            GestorLdap::canviarDadaUsuari($_POST["param"],$_POST["tbNouvalor"]);
            break;
        case "crearUsuari":
            GestorLdap::crearUsuari($_POST["ou"],$_POST["uid"],$_POST["cn"],$_POST["gid"],$_POST["homedirectory"],
            $_POST["givenname"],$_POST["sn"],$_POST["postaladdress"],$_POST["telephonenumber"],$_POST["title"],
            $_POST["uidNumber"],$_POST["description"],$_POST["loginshell"],$_POST["mobile"]);
            break;
        }
}

/* DELETES */
if(isset($_POST["delete"]))
{
    switch($_POST["delete"]){
        case "esborrarUsuari":
            GestorLdap::esborrarUsuari($_POST["ou"],$_POST["uid"]);
            break;
    }
}

















?>