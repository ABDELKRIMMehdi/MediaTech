<?php

$conn = pg_connect("host=postgresql-unten95.alwaysdata.net port=5432 dbname=unten95_2_mediateque user=unten95 password=Bianca95800");

if(!$conn){
    die("Connection failed");
}