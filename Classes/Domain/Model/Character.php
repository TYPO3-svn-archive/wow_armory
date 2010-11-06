<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2009 Jochen Rau <jochen.rau@typoplanet.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * A character
 *
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_wowarmory_Domain_Model_Character extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * The character's name.
	 *
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 80)
	 */
	protected $name = '';

	/**
	 * The character's realm.
	 *
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 80)
	 */
	protected $realm = '';

	/**
	 * Constructs a new Character
	 *
	 */
	public function __construct() {
	}

	/**
	 * Sets this character's name
	 *
	 * @param string $name The character's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the character's name
	 *
	 * @return string The character's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this character's realm
	 *
	 * @param string $name The character's realm
	 * @return void
	 */
	public function setRealm($realm) {
		$this->realm = $realm;
	}

	/**
	 * Returns the character's realm
	 *
	 * @return string The character's realm
	 */
	public function getRealm() {
		return $this->realm;
	}

}
?>