<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="css/estils.css" type="text/css">
</head>
<h1> Menú LDAP de joalro</h1>
<body>
	<form action="http://localhost:80/projecte/php/encaminador.php" method="GET">
		<input class="ocult" type="text" name="get" value="mostraFormulariDadesUsuari" hidden/>
		<input class="btMenu" type="submit" value="Mostrar dades d'usuari"/>
	</form>
	<form action="http://localhost:80/projecte/php/encaminador.php" method="GET">
		<input class="ocult" type="text" name="get" value="mostraFormulariEditarUsuari" hidden/>
		<input class="btMenu" type="submit" value="Editar usuari"/>
	</form>
	<form action="http://localhost:80/projecte/php/encaminador.php" method="GET">
		<input class="ocult" type="text" name="get" value="mostraFormulariCrearUsuari" hidden/>
		<input class="btMenu" type="submit" value="Afegir nou usuari"/>
	</form>
	<form action="http://localhost:80/projecte/php/encaminador.php" method="GET">
		<input class="ocult" type="text" name="get" value="mostraFormulariEsborrarUsuari" hidden/>
		<input class="btMenu" type="submit" value="Esborrar usuari"/>
	</form>
</body>
</html>

