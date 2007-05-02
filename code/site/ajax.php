<?php
  // +-------------------------------------------------------------------+
  // | Appleseed Web Community Management Software                       |
  // | http://appleseed.sourceforge.net                                  |
  // +-------------------------------------------------------------------+
  // | FILE: asd.php                                 CREATED: 05-01-2007 + 
  // | LOCATION: /code/site/                        MODIFIED: 05-01-2007 +
  // +-------------------------------------------------------------------+
  // | Copyright (c) 2004-2007 Appleseed Project                         |
  // +-------------------------------------------------------------------+
  // | This program is free software; you can redistribute it and/or     |
  // | modify it under the terms of the GNU General Public License       |
  // | as published by the Free Software Foundation; either version 2    |
  // | of the License, or (at your option) any later version.            |
  // |                                                                   |
  // | This program is distributed in the hope that it will be useful,   |
  // | but WITHOUT ANY WARRANTY; without even the implied warranty of    |
  // | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the     |
  // | GNU General Public License for more details.                      |	
  // |                                                                   |
  // | You should have received a copy of the GNU General Public License |
  // | along with this program; if not, write to:                        |
  // |                                                                   |
  // |   The Free Software Foundation, Inc.                              |
  // |   59 Temple Place - Suite 330,                                    | 
  // |   Boston, MA  02111-1307, USA.                                    |
  // |                                                                   |
  // |   http://www.gnu.org/copyleft/gpl.html                            |
  // +-------------------------------------------------------------------+
  // | AUTHORS: Michael Chisari <michael.chisari@gmail.com>              |
  // +-------------------------------------------------------------------+
  // | VERSION:      0.7.0                                               |
  // | DESCRIPTION:  AJAX Request traffic hub.                           |
  // +-------------------------------------------------------------------+

  // Change to document root directory.
  chdir ($_SERVER['DOCUMENT_ROOT']);

  // Include Lightweight Server Classes
  require_once ('code/include/classes/server.php'); 
  
  // Suppress warning reports.
  error_reporting (E_ERROR);
  
  $gACTION = $_POST['gACTION'];
  
  // Create the Server class.
  $zAJAX = new cAJAX ();
     
  //decode incoming JSON string
  $JSON = $zAJAX->JSON->decode(file_get_contents('php://input'));
  
  $gACTION = $JSON->action;
  
  switch ($gACTION) {
    case 'AJAX_GET_USER_INFORMATION':
  
      $username = $JSON->username;
      $domain = $JSON->domain;
      
      // Get user information in JSON format.
      $result = $zAJAX->GetUserInformation ($username, $domain);
      
      echo $result;
      
      exit;
    break;
    default:
    break;
  } // switch

?>