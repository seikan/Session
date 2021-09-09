<?php

/**
 * Session: A very simple PHP session library.
 *
 * Copyright (c) 2017 Sei Kan
 *
 * Distributed under the terms of the MIT License.
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright  2017 Sei Kan <seikan.dev@gmail.com>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 *
 * @see       https://github.com/seikan/Session
 */
class Session
{
	/**
	 * Object to hold session variables.
	 *
	 * @var object
	 */
	protected $session;

	/**
	 * An unique ID for the session.
	 *
	 * @var string
	 */
	protected $sessionId;

	/**
	 * Initialize session object.
	 *
	 * @param string $sessionId
	 */
	public function __construct($sessionId = null)
	{
		if (!session_id()) {
			session_start();
		}

		$this->sessionId = ($sessionId) ? $sessionId : md5($_SERVER['HTTP_HOST'] . '_session');

		if (isset($_SESSION[$this->sessionId]) && ($this->session = json_decode($_SESSION[$this->sessionId], true)) === null) {
			return;
		}

		if (!isset($_SESSION[$this->sessionId])) {
			$_SESSION[$this->sessionId] = json_encode([]);
		}

		$this->session = json_decode($_SESSION[$this->sessionId], true);
	}

	/**
	 * Retrieve a session value by key.
	 *
	 * @param string $key
	 */
	public function get($key)
	{
		return (isset($this->session[$key])) ? $this->session[$key] : null;
	}

	/**
	 * Set a session variable by key and value.
	 *
	 * @param string $key
	 * @param string $value
	 */
	public function set($key, $value = null)
	{
		$this->session[$key] = $value;

		if ($value === null) {
			unset($this->session[$key]);
		}

		$_SESSION[$this->sessionId] = json_encode($this->session);
	}
	
	/**
	 * Delete a session variable by key.
	 *
	 * @param string $key
	 */
	public function delete($key)
	{
		if(isset($this->session[$key])) {
			unset($this->session[$key]);
		}
		
		$_SESSION[$this->sessionId] = json_encode($this->session);
	}

	/**
	 * Destroy the entire session variables.
	 */
	public function destroy()
	{
		unset($_SESSION[$this->sessionId]);
		$this->session = null;
	}
}
