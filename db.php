<?php
/**
 * Created by PhpStorm.
 * User: Minaa
 * Date: 11/19/2019
 * Time: 3:57 PM
 */

$servername = "localhost";
$dbname = "ketabnak";
$conn = @new mysqli($servername
    , $_SERVER['PHP_AUTH_USER'] // Username
    , $_SERVER['PHP_AUTH_PW'] // Password
    , $dbname);
// Check Auth
if (!isset($_SERVER['PHP_AUTH_USER'])
    || $conn->connect_error
) {
    header('WWW-Authenticate: Basic realm="Mina"');
    header('HTTP/1.0 401 Unauthorized');
    // die("Connection failed: " . $conn->connect_error);
    echo "
        <div id=\"main\">
            <div id=\"head\"></div>
            <div id=\"book-body\">
                An Error was occurred in Connect to DataBase
            </div>
        </div>
        ";
    exit;
}
