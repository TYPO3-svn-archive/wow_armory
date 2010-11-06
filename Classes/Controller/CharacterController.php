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
 * The character controller for the Character package
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_wowarmory_Controller_CharacterController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_wowarmory_Domain_Model_CharacterRepository
	 */
	protected $characterRepository;

	/**
	 * @var Tx_wowarmory_Domain_Model_AdministratorRepository
	 */
	protected $administratorRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		$this->characterRepository = t3lib_div::makeInstance('Tx_wowarmory_Domain_Repository_CharacterRepository');
	}

	/**
	 * Index action for this controller. Displays a list of characters.
	 *
	 * @return string The rendered view
	 */
	public function indexAction() {
		$this->view->assign('characters', $this->characterRepository->findAll());
	}

	/**
	 * Displays a form for creating a new character
	 *
	 * @param Tx_wowarmory_Domain_Model_Character $newCharacter A fresh character object taken as a basis for the rendering
	 * @return string An HTML form for creating a new character
	 * @dontvalidate $newCharacter
	 */
	public function newAction(Tx_wowarmory_Domain_Model_Character $newCharacter = NULL) {
		$this->view->assign('newCharacter', $newCharacter);
	}

	/**
	 * Creates a new character
	 *
	 * @param Tx_wowarmory_Domain_Model_Character $newCharacter A fresh Character object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_wowarmory_Domain_Model_Character $newCharacter) {
		$this->characterRepository->add($newCharacter);
		$this->flashMessages->add('Your new character was created.');
		$this->redirect('index');
	}
	
	/**
	 * Edits an existing character
	 *
	 * @param Tx_wowarmory_Domain_Model_Character $character The character to be edited. This might also be a clone of the original character already containing modifications if the edit form has been submitted, contained errors and therefore ended up in this action again.
	 * @return string Form for editing the existing character
	 * @dontvalidate $character
	 */
	public function editAction(Tx_wowarmory_Domain_Model_Character $character) {
		$this->view->assign('character', $character);
	}

	/**
	 * Updates an existing character
	 *
	 * @param Tx_wowarmory_Domain_Model_Character $character A not yet persisted clone of the original character containing the modifications
	 * @return void
	 */
	public function updateAction(Tx_wowarmory_Domain_Model_Character $character) {
		$this->characterRepository->update($character);
		$this->flashMessages->add('Your character has been updated.');
		$this->redirect('index');
	}

	/**
	 * Deletes an existing character
	 *
	 * @param Tx_wowarmory_Domain_Model_Character $character The character to delete
	 * @return void
	 */
	public function deleteAction(Tx_wowarmory_Domain_Model_Character $character) {
		$this->characterRepository->remove($character);
		$this->flashMessages->add('Your character has been removed.');
		$this->redirect('index');
	}

	/**
	 * Deletes an existing character
	 *
	 * @return void
	 */
	public function deleteAllAction() {
		$this->characterRepository->removeAll();
		$this->redirect('index');
	}

	/**
	 * Returns a sample character populated with generic data. It is also an example how to handle objects and repositories in general.
	 *
	 * @param int $characterNumber The number of the character
	 * @param Tx_wowarmory_Domain_Model_Person $author The author of posts
	 * @return Tx_wowarmory_Domain_Model_Character The character object
	 */
	private function getCharacter($characterNumber, $author) {
		$character = new Tx_wowarmory_Domain_Model_Character;
		return $character;
	}
	
	/**
	 * Override getErrorFlashMessage to present
	 * nice flash error messages.
	 *
	 * @return string
	 */
	protected function getErrorFlashMessage() {
		switch ($this->actionMethodName) {
			case 'updateAction' :
				return 'Could not update the character:';
			case 'createAction' :
				return 'Could not create the new character:';
			default :
				return parent::getErrorFlashMessage();
		}
	}

}

?>