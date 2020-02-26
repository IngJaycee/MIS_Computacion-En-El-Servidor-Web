<?php

// define("DB_HOST_URL", "sql308.epizy.com");
$DB_HOST_URL    = "sql308.epizy.com";
// define("DB_USER_NAME", "epiz_25016279");
$DB_USER_NAME   = "epiz_25016279";
// define("DB_PASS", "B6eeqljrYeZ");
$DB_PASS        = "B6eeqljrYeZ";

$DB_NAME        = "computacionEnServidor";
$DSN            = "mysql:host=$DB_HOST_URL;dbname=$DB_USER_NAME";
$options        = array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    );
?>