<?php
$pass = 'EMpass!123';
$password = password_hash($pass, PASSWORD_DEFAULT);

echo $password;