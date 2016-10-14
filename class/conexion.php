<?php
    //--------------------------------------------------------------------------
    // Example php script for fetching data from mysql database
    // by Trystan Lea : openenergymonitor.org : GNU GPL
    //--------------------------------------------------------------------------
    $host = "localhost";
    $user = "root";
    $pass = "123";


    $databaseName = "meteorologia";
    $tableName = "datos";

    //--------------------------------------------------------------------------
    // Connect to mysql database
    //--------------------------------------------------------------------------

    $con = mysql_connect($host, $user, $pass);
    $dbs = mysql_select_db($databaseName, $con);
?>
