// Connect to database
$db = new mysqli($config['db']['host'], $config['db']['username'], $config['db']['password'], $config['db']['dbname']);
if($db->connect_errno > 0){ die('Unable to connect to database [' . $db->connect_error . ']'); }