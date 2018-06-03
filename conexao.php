<?php
global $connecta;
$connecta = mysqli_connect("localhost","root", "");
mysqli_select_db($connecta,"fluxos");
mysqli_query($connecta,"SET NAMES 'utf8'");