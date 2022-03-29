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
        setcookie('userou',$ou);
        require('../html/FormulariAtributs.html');
    }
    
    static function canviarAtribut($param)
    {                
        //echo("  Ou:".$_COOKIE['useruid']." Param: ". $param);
        $uid = $_COOKIE['useruid'];
        echo(
        "
        <link rel='stylesheet' href='../css/estils.css' type='text/css'>
        <h1>Canvi del parametre $param</h1>
        <form action='http://localhost:80/projecte/php/encaminador.php' method='POST'>
            <input class='ocult' type='text' name='put' value='dadesAtribut' hidden/>
            <input class='ocult' type='text' name='param' value='$param' hidden/>
            Nou valor per a $uid : <input id='tbNouvalor' type='text' name='tbNouvalor' autofocus/>  
            <input class='btEnvia' type='submit' value='Envia'/>               
        </form>");
    }
        
        
        static function canviarDadaUsuari($param,$valor)
        {
            //echo("  uid:".$_COOKIE['useruid']." Param: ". $param . "  Valor: " .$valor);
        //echo("<h1 style='text-align:center;'>Canvi de valor d'atribut d'usuari</h1>");
        //echo("<label style='width:100%;text-align:center;display:block' id='lbuid'>Nou valor per a: $param  de l'usuari: $uid </label>");
        
        ini_set('display_errors', 0);
        #
        # Atribut a modificar --> $param
        #
        
        #
        # Entrada a modificar
        #
        $uid= $_COOKIE['useruid'];
        $unorg = $_COOKIE['userou'];
        $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
        #
        #Opcions de la connexió al servidor i base de dades LDAP
        $opcions = [
            'host' => 'zend-joalro.fjeclot.net',
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
            Attribute::setAttribute($entrada,$param,$valor);
            $ldap->update($dn, $entrada);
            echo "Atribut modificat";
            GestorLdap::mostrarDadesUsuari($uid,$unorg);
        } else echo "<b>Aquesta entrada no existeix</b><br><br>";	
        
    }
    
    static function crearUsuari($ou,$uid,$cn,$gid,$homedirectory,$givenname,$sn,$postaladdress
        ,$telephonenumber,$title,$uidNumber,$description,$loginshell,$mobile)
        {
         //echo" $ou   $uid  $cn  $gid  $homedirectory  $givenname  $sn $postaladdress  $telephonenumber  $title  $uidNumber  $description  $loginshell  $mobile";        
         
         ini_set('display_errors', 0);
         $objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
         #
         #Afegint la nova entrada
         $domini = 'dc=fjeclot,dc=net';
         $opcions = [
             'host' => 'zend-joalro.fjeclot.net',
             'username' => 'cn=admin,dc=fjeclot,dc=net',
             'password' => 'fjeclot',
             'bindRequiresDn' => true,
             'accountDomainName' => 'fjeclot.net',
             'baseDn' => 'dc=fjeclot,dc=net',
         ];
         //--
         $ldap = new Ldap($opcions);
         $ldap->bind();
         $nova_entrada = [];
         Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
         Attribute::setAttribute($nova_entrada, 'ou', $ou);
         Attribute::setAttribute($nova_entrada, 'uid', $uid);
         Attribute::setAttribute($nova_entrada, 'uidNumber', $uidNumber);
         Attribute::setAttribute($nova_entrada, 'gidNumber', $gid);
         Attribute::setAttribute($nova_entrada, 'homeDirectory', $homedirectory);
         Attribute::setAttribute($nova_entrada, 'loginShell', $loginshell);
         Attribute::setAttribute($nova_entrada, 'cn', $cn);
         Attribute::setAttribute($nova_entrada, 'sn', $sn);
         Attribute::setAttribute($nova_entrada, 'givenName', $givenname);
         Attribute::setAttribute($nova_entrada, 'mobile', $mobile);
         Attribute::setAttribute($nova_entrada, 'postalAddress', $postaladdress);
         Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telephonenumber);
         Attribute::setAttribute($nova_entrada, 'title', $title);
         Attribute::setAttribute($nova_entrada, 'description', $description);
         $dn = 'uid='.$uid.',ou='.$ou.',dc=fjeclot,dc=net';
         if($ldap->add($dn, $nova_entrada)) echo "Usuari creat";
         else echo "Error";
        } 
                
}//Fi de la classe



?>