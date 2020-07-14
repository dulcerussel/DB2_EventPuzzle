<?php
session_start();
error_reporting(E_ALL);


echo $_SESSION["SP_ID"];
echo $_SESSION["SPT_TYPE"];
echo $_SESSION["SP_COMPANY_NAME"];
echo $_SESSION["SP_USERNAME"];
echo $_SESSION["SP_PASSWORD"];
echo $_SESSION["SP_LNAME"];
echo $_SESSION["SP_FNAME"];
echo $_SESSION["SP_CONTACT"];
echo $_SESSION["SP_DESCRIPTION"];
echo $_SESSION["image"];



?>