<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

	session_start();

	print_r($_SESSION);

	unset($_SESSION["comprador_id"]);
	unset($_SESSION["admin_id"]);

?>

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
