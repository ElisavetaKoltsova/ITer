<?php

$dbconnect = "host=localhost port=5432 dbname=iter_sm_db user=postgres password=root";

if(!$con = pg_connect($dbconnect))
{
        die("failed to connect!");
}
        