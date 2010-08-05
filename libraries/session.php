<?php
/**
 * @version      $Id$
 * @package      Appleseed.Framework
 * @subpackage   Library
 * @copyright    Copyright (C) 2004 - 2010 Michael Chisari. All rights reserved.
 * @link         http://opensource.appleseedproject.org
 * @license      GNU General Public License version 2.0 (See LICENSE.txt)
 */

// Restrict direct access
defined( 'APPLESEED' ) or die( 'Direct Access Denied' );

/** Session Class
 * 
 * Session management
 * 
 * @package     Appleseed.Framework
 * @subpackage  Library
 */
class cSession {
	
	protected $_Context;

	/**
	 * Constructor
	 *
	 * @access  public
	 */
	public function __construct ( ) {       
		session_start();
	}
	
	/**
	 * Set the context string to use.
	 * 
	 * @access  public
	 * @param string $pContext Which context is being used.
	 */
	public function Context ( $pContext = null ) {
		
		if ( !$pContext ) return ( $this->_Context );
		
		$this->_Context = $pContext;
		
		return ( true );
	}
	
	/**
	 * Get a session variable
	 * 
	 * @access  public
	 * @param string $pVariable Which session variable to return
	 * @param string $pDefault Default value if variable is not set
	 */
	public function Get ( $pVariable = null, $pDefault = null ) {
		
		if ( !isset ( $this->_Context ) ) {
			# @TODO: Throw a warning
			return ( false );
		}
		
		// No variable was selected, so return all the context data.
		if ( !$pVariable ) {
			return ( $_SESSION[$this->_Context] );
		}
		
		$variable = strtolower ( ltrim ( rtrim ( $pVariable ) ) );
		
		$return = $_SESSION[$this->_Context][$variable];
		
		if ( !$return ) return ( $pDefault );
		
		return ( $return );
	}

	/**
	 * Set a session variable
	 * 
	 * @access  public
	 * @param string $pVariable Which session variable to set
	 * @param string $pValue Which value to set the session variable
	 */
	public function Set ( $pVariable, $pValue ) {
		
		if ( !isset ( $this->_Context ) ) {
			# @TODO: Throw a warning
			return ( false );
		}
		
		$variable = strtolower ( ltrim ( rtrim ( $pVariable ) ) );
		
		$_SESSION[$this->_Context][$variable] = $pValue;
		
		return ( true );
	}
	
	/**
	 * Delete a session variable
	 * 
	 * @access  public
	 * @param string $pVariable Which session variable to delete
	 */
	public function Delete ( $pVariable ) {
		
		if ( !isset ( $this->_Context ) ) {
			# @TODO: Throw a warning
			return ( false );
		}
		
		$variable = strtolower ( ltrim ( rtrim ( $pVariable ) ) );
		
		unset ( $_SESSION[$this->_Context][$variable] );
		
		return ( true );
	}

	/**
	 * Clear all session variables in the current context
	 * 
	 * @access  public
	 */
	public function Clear ( ) {
		
		if ( !isset ( $this->_Context ) ) {
			# @TODO: Throw a warning
			return ( false );
		}
		
		unset ( $_SESSION[$this->_Context] );
		
		return ( true );
	}

	/**
	 * Save a set of session variables.
	 * 
	 * @access  public
	 * @param array $pData Data to save to the session
	 */
	public function Save ( $pData ) {
		
		if ( !isset ( $this->_Context ) ) {
			# @TODO: Throw a warning
			return ( false );
		}
		
		foreach ( $pData as $key => $value ) {
			$key = strtolower ( ltrim ( rtrim ( $key ) ) );
			$_SESSION[$this->_Context][$key] = $value;
		}
		
		return ( true );
	}
}