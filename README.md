# Session

This is a very simple PHP session library.



## Usage

### Configuration

> \$session = new Session( \[**string** $sessionId\] );



```php
// Include core session library
require_once 'class.Session.php';

// Initialize session object
$session = new Session();
```



### Set Value

Gets a session value.

> \$session->set( **string** $key, **string** \$value );

```php
// Store username into session
$session->set('username', 'seikan');

// Remove a session variable
$session->set('password', null);
```



### Get Value

Gets a session value by key.

> **string** \$session->get( **string** $key );

```php
// Get username stored in session
$username = $session->get('username');
```



### Destroy Session

Destroys the entire session.

> \$session->destroy( );

```php
$session->destroy();
```

