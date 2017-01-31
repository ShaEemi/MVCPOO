<?php
if (SERVER == "DEV") {
	define('DEBUG', true); // debug autorisé
	define('RUN', 'NORMAL'); // run normal = code quon est en train de coder
	define('GA', false); // Google Analytics false
} else if (SERVER == "TEST") {
	define('DEBUG', true);
	define('RUN', 'NORMAL');
	define('GA', false);
} else if (SERVER == "PROD") {
	define('DEBUG', false);
	define('RUN', 'WAIT'); // page d'attende en attendand la fin de notre site
	define('GA', true);
}
define('ROOT', dirname(dirname(__DIR__)));
define('SITE_NAME', 'MyBlog');
define('DEFAULT_MODULE', 'post');
define('PAGINATION', 5);
