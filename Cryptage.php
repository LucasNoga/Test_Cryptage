<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="../js/jquery.min.js"></script>
	</head>
	<body>
	<?
		//les algos
		echo 'liste des algorithmes que l\'on peut utiliser<br>';
		foreach(mcrypt_list_algorithms() as $v){
			var_dump($v);
			echo "<br>";
		}
		//les modes
		echo '<br>liste des modes<br>';
		foreach(mcrypt_list_modes() as $v){
			var_dump($v);
			echo "<br>";
		}
		//ouverture d'un module
		echo '<br>Exemple de ressources pour crypter<br>';
		
		echo "mcrypt_module_open('des', '', 'ofb', '') --->   ";
		$td = mcrypt_module_open('des', '', 'ofb', '');
		var_dump($td);
		echo "<br>";
		
		echo "mcrypt_module_open('loki97', '', 'ecb', '') --->   ";
		$td = mcrypt_module_open('loki97', '', 'ecb', '');
		var_dump($td);
		echo "<br>";
		
		echo "mcrypt_module_open('gost', '', 'cbc', '') --->   ";
		$td = mcrypt_module_open('gost', '', 'cbc', '');
		var_dump($td);
		echo "<br>";
		
		echo "mcrypt_module_open('rc2', '', 'cfb', '') --->   ";
		$td = mcrypt_module_open('rc2', '', 'cfb', '');
		var_dump($td);
		echo "<br><br>";

		echo "crypatge de la chaine<br>";
		/* Charge un chiffrement */
		$z = mcrypt_module_open('rijndael-256', '', 'ofb', '');
		echo '$td = '.$z.'<br>';

		/* Crée le VI et détermine la taille de la clé */
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($z), MCRYPT_DEV_RANDOM);
		echo '$iv = '.$iv.'<br>';
		$ks = mcrypt_enc_get_key_size($z);
		echo '$ks = '.$ks.'<br>';

		/* Crée la clé */
		$key = substr(md5('clé secrete'), 0, $ks);
		echo '$key = '.$key.'<br>';
		
		/* Intialise le chiffrement */
		mcrypt_generic_init($z, $key, $iv);

		/* Chiffre les données */
		$encrypted = mcrypt_generic($z, 'C\'est un donnée importante');
		echo '$encrypted = '.$encrypted. '<br>' ;

		/* Libère le gestionnaire de chiffrement */
		mcrypt_generic_deinit($z);

		/* Initialise le module de chiffrement pour le déchiffrement */
		mcrypt_generic_init($z, $key, $iv);

		/* Déchiffre les données */
		$decrypted = mdecrypt_generic($z, $encrypted);
		echo '$decrypted = '.$decrypted.'<br>';

		/* Libère le gestionnaire de déchiffrement, et ferme le module */
		mcrypt_generic_deinit($z);
		mcrypt_module_close($z);

	?>



	</body>
</html>