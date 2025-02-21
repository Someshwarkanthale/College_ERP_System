<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com'; // Gmail SMTP host
$config['smtp_port'] = 587; // Gmail SMTP port
$config['smtp_user'] = ''; // Your email address
$config['smtp_pass'] = ''; // Your email password
$config['mailtype'] = 'html'; // Email format
$config['charset']  = 'utf-8';
$config['newline']  = "\r\n";
$config['smtp_crypto'] = 'tls'; // Use TLS encryption
