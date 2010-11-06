<?php
$extensionClassesPath = t3lib_extMgm::extPath('wow_armory') . 'Classes/';
return array(
	'tx_wowarmory_domain_model_character' => $extensionClassesPath . 'Domain/Model/Character.php',
	'tx_wowarmory_domain_repository_characterrepository' => $extensionClassesPath . 'Domain/Repository/CharacterRepository.php',
	'tx_wowarmory_domain_validator_charactervalidator' => $extensionClassesPath . 'Domain/Validator/CharacterValidator.php',	
	'tx_wowarmory_controller_charactercontroller' => $extensionClassesPath . 'Controller/CharacterController.php'
);
?>