<?php  
// constante generale
define("DB_CHARSET", "utf8");
// param connexion
define("DB_host", "myhost");
define("DB_PORT", "myport");
if (SERVER == "PROD") {
	define("DB_NAME", "myserverdbname");
	define("DB_USER", "myserverlogin");
	define("DB_PASSWORD", "myserverpassword");
	define("PREFIXE", "prefixeProdTable");
} else if (SERVER == "TEST") {
	define("DB_NAME", "myserverdbname");
	define("DB_USER", "myserverlogin");
	define("DB_PASSWORD", "myserverpassword");
	define("PREFIXE", "prefixeTestTable");
} else {
	define("DB_NAME", "mylocaldbname");
	define("DB_USER", "mylocallogin");
	define("DB_PASSWORD", "mylocalpassword");
	define("PREFIXE", "prefixeLocalTable");
}
