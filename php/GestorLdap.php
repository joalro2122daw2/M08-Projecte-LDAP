<?php 

require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

class GestorLdap{
    
    static function  mostrarDadesUsuari($uid,$ou)
    {
        $domini = 'dc=fjeclot,dc=net';
        $opcions = [
            'host' => 'zend-joalro.fjeclot.net',
            'username' => "cn=admin,$domini",
            'password' => 'fjeclot',
            'bindRequiresDn' => true,
            'accountDomainName' => 'fjeclot.net',
            'baseDn' => 'dc=fjeclot,dc=net',
        ];
        $ldap = new Ldap($opcions);
        $ldap->bind();
        $entrada ='uid='.$uid.',ou='.$ou.',dc=fjeclot,dc=net';
        //echo $entrada;
        $usuari=$ldap->getEntry( $entrada);
        //echo "<b><u>".$usuari["dn"]."</b></u><br>";
        echo '<h1>Dades del usuari</h1><br>';
        foreach ($usuari as $atribut => $dada) {
            if ($atribut != "dn") echo $atribut.": ".$dada[0].'<br>';
        }
    }
    
}



?>