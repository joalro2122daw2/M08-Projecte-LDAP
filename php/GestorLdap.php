<?php 

require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;
use Laminas\Ldap\Attribute;

class GestorLdap{
    static $ou,$uid;

    static $opcions = [
        'host' => 'zend-joalro.fjeclot.net',
        'username' => "cn=admin,dc=fjeclot,dc=net",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    
    static function  mostrarDadesUsuari($uid,$ou)
    {
        /*
        $domini = 'dc=fjeclot,dc=net';
        $opcions = [
            'host' => 'zend-joalro.fjeclot.net',
            'username' => "cn=admin,$domini",
            'password' => 'fjeclot',
            'bindRequiresDn' => true,
            'accountDomainName' => 'fjeclot.net',
            'baseDn' => 'dc=fjeclot,dc=net',
        ];
        */
        $ldap = new Ldap(GestorLdap::$opcions);
        $ldap->bind();
        $entrada ='uid='.$uid.',ou='.$ou.',dc=fjeclot,dc=net';
        //echo $entrada;
        $usuari=$ldap->getEntry( $entrada);
        //echo "<b><u>".$usuari["dn"]."</b></u><br>";        
        echo '<h1>Dades del usuari</h1><br>';
        foreach ($usuari as $atribut => $dada) {
            if ($atribut != "dn") echo $atribut.": ".$dada[0].'<br>';
        }
        return $usuari;
    }
    
    static function mostrarAtributsPerAModificar($uid,$ou)
    {
        //echo "<label id='lbuid'>'$uid'</label>";
        //echo "<label id='lbou'>'$ou'</label>";
        setcookie('useruid',$uid);        
        require('../html/FormulariAtributs.html');
    }
    
    static function canviarAtribut($param)
    {                
        //echo("  Ou:".$_COOKIE['useruid']." Param: ". $param);
        $uid = $_COOKIE['useruid'];
        echo(
        "<form action='http://localhost:80/projecte/php/encaminador.php' method='POST'>".
            "<input class='ocult' type='text' name='metode' value='dadesAtribut' hidden/>".
            "Nou valor ($uid): <input id='tbNouvalor' type='text' name='tbNouvalor autofocus><br>".        
            "<input class='btEnvia' type='submit' value='Envia'>
        </form>");
        
        
        
        
        //echo("<h1 style='text-align:center;'>Canvi de valor d'atribut d'usuari</h1>");
        //echo("<label style='width:100%;text-align:center;display:block' id='lbuid'>Nou valor per a: $param  de l'usuari: $uid </label>");
        /*
        ini_set('display_errors', 0);
        #
        # Atribut a modificar --> Número d'idenficador d'usuari
        #
        $atribut= $_COOKIE['useruid'];
        $nou_contingut=6000;
        #
        # Entrada a modificar
        #
        $uid = 'usr2';
        $unorg = 'usuaris';
        $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
        #
        #Opcions de la connexió al servidor i base de dades LDAP
        $opcions = [
            'host' => 'zend-dacomo.fjeclot.net',
            'username' => 'cn=admin,dc=fjeclot,dc=net',
            'password' => 'fjeclot',
            'bindRequiresDn' => true,
            'accountDomainName' => 'fjeclot.net',
            'baseDn' => 'dc=fjeclot,dc=net',
        ];
        #
        # Modificant l'entrada
        #
        $ldap = new Ldap($opcions);
        $ldap->bind();
        $entrada = $ldap->getEntry($dn);
        if ($entrada){
            Attribute::setAttribute($entrada,$atribut,$nou_contingut);
            $ldap->update($dn, $entrada);
            echo "Atribut modificat";
        } else echo "<b>Aquesta entrada no existeix</b><br><br>";	
        */
    }
}//Fi de la classe



?>