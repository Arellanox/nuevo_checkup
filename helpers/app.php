<?php
$appname = 'nuevo_checkup';
$http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$servidor = $_SERVER['HTTP_HOST'];
$URL_SERVER = "{$http}{$servidor}/{$appname}";