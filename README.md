# xmvc

### Features:
* Model-View-Controller
* Bootstrap 4
* PHP 7.4
* Authentication with JWT and Cookies Management
* Include base template App (with DateTime, Tinymce Editor, Dasboard Stats)
* Self-service registration (optional: set true on config.php)
* User management
* Profile setting
* Login attempts logs (customable for max-try login and drop access for certain times. set on config.php)

```php
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
define('SELF_REGIST', false);

// Cookies configurations
define('COOKIE_NAME', 'XS-SESSION');
define('COOKIE_PATH', '/xmvc');

// BruteForce Prevention
define('MAX_LOGIN_ATTEMPTS', 5); // attempts
define('MAX_LOGIN_INTERVAL', 10); // in minutes
```

> Notes: Change *SECRET_KEY* before using on production server! Use command 'openssl rand -base64 64' to generate random key

### Todo:
- [ ] Email Integration
- [ ] Google reCAPTCHA

Happy Coding > XS-LABS
