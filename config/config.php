<?php
/**'

Y88b    / ,d88~~\      888          e      888~~\  ,d88~~\
 Y88b  /  8888         888         d8b     888   | 8888
  Y88b/   `Y88b   ____ 888        /Y88b    888 _/  `Y88b
  /Y88b    `Y88b,      888       /  Y88b   888  \   `Y88b,
 /  Y88b     8888      888      /____Y88b  888   |    8888
/    Y88b \__88P'      888____ /      Y88b 888__/  \__88P'

D.H.L © 2021

'*/

define('DEVELOPMENT_ENVIRONMENT', true);

// Use command 'openssl rand -base64 64' to generate random key
define('SECRET_KEY', '79nvFvET3GAg4PF29GM0Gwki/2//sgtiLNtsHpV+PXARPvrFXOKbkbRbU3qHjYW9s0W5/aQX5m1DRUWOcSa66g');

// Global
define('BASE_PATH', 'https://localhost/xmvc');
define('DEFAULT_CONTROLLER', 'dashboard');

// Database configurations
define('DB_XX', 'mysql:host=localhost;dbname=xmvcdb;charset=utf8mb4');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// Allow self service user registration
define('SELF_REGIST', true);

// Cookies configurations
define('COOKIE_NAME', 'XS-SESSION');
define('COOKIE_PATH', '/xmvc');

// BruteForce Prevention
define('MAX_LOGIN_ATTEMPTS', 5); // attempts
define('MAX_LOGIN_INTERVAL', 10); // in minutes
