<?php

/*
 * ---------------------------------------------------------------
 * LOAD EXTERNAL SETTINGS
 * ---------------------------------------------------------------
 */

$settings_ini = '../settings.ini';
$external_settings = parse_ini_file( $settings_ini, true );
foreach( $external_settings as $prefix=>$section ) {
	$var_prefix = strtoupper($prefix);
	foreach( $section as $key=>$setting ) {
        $var = 'MY_' . $var_prefix . '_' . strtoupper($key);
		define( $var, $setting );
	}
}

/*
 * ---------------------------------------------------------------
 * CONNECT TO THE DATABASE
 * ---------------------------------------------------------------
 */


/*
 * ---------------------------------------------------------------
 * COLLECT VARIABLES
 * ---------------------------------------------------------------
 */
$urlSegments = explode("/", $_SERVER[REQUEST_URI]);

/*
 * ---------------------------------------------------------------
 * COLLECT DATA FOR OUTPUT
 * ---------------------------------------------------------------
 */

ob_start();

// set empty array of users
$users = [];

try {

    // connect to the database
    $pdo = new PDO(
        'mysql:host='. MY_DATABASE_HOSTNAME .';dbname='. MY_DATABASE_DATABASE .';charset=utf8', 
        MY_DATABASE_USERNAME, // username
        MY_DATABASE_PASSWORD // password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // create the SELECT statement to gather users
    $sql = " 
        SELECT u.`id`, u.`username`, u.`firstname`, u.`lastname`, u.`email` 
        FROM `users` u 
        ORDER BY u.`username` ASC 
    ";

    $result = $pdo->query($sql);

    // collect results and make sure variables are UTF-8 safe
    while ($row = $result->fetch()) {
        $users[] = [
            'id' => $row['id'],
            'username' => htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8'), 
            'firstname' => htmlspecialchars($row['firstname'], ENT_QUOTES, 'UTF-8'), 
            'lastname' => htmlspecialchars($row['lastname'], ENT_QUOTES, 'UTF-8'), 
            'email' => htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8')
        ];
    }

    $dbOutput = [
        'status' => 'success',
        'message' => json_encode($users)
    ];

} catch (PDOException $e) {
    $dbOutput = [
        'status' => 'error',
        'message' => 'Unable to connect to the database server: ' . 
            $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine()
    ];
}

$output = $users;
include __DIR__.'/../templates/index.html.php';

$output = ob_get_clean();

/*
 * ---------------------------------------------------------------
 * OUTPUT LAYOUT
 * ---------------------------------------------------------------
 */

include  __DIR__ . '/../templates/layout.html.php';

/*
 * ---------------------------------------------------------------
 * CLOSE DB CONNECTION
 * Note: PHP does this automatically, but let's do this for practice
 * ---------------------------------------------------------------
 */

$pdo = null;

?>
