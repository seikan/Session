<?php

require_once 'class.Session.php';

$session = new Session();

// Set a session variable
$session->set('username', 'seikan');

// Retrieve
echo $session->get('username');

// Remove a session variable
$session->set('username', null);

// Destroy entire session
$session->destroy();
