<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

if(TYPO3_MODE === 'BE'){
	// create new main category "module"
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'wow',
		'',
		'',
		array(),
		array(
			'access' => 'user,group',
			'icon'   => null,
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xml',
		)
	);
	// register armory module
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'wow',
		'wow_armory',
		'top',
		array( // An array holding the controller-action-combinations that are accessible
			'Character' => 'index,new,create,delete,deleteAll,edit,update',	// The first controller and its first action will be the default
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/Resources/Public/Icons/icon_module.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_smod.xml',
		)
	);
}

/**
 * Add labels for context sensitive help (CSH)
 */
t3lib_extMgm::addLLrefForTCAdescr('_MOD_wow_armory', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh.xml');

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'World of Warcraft - Armory');

t3lib_extMgm::allowTableOnStandardPages('tx_wowarmory_domain_model_character');

$TCA['tx_wowarmory_domain_model_character'] = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:wow_armory/Resources/Private/Language/locallang_db.xml:tx_wowarmory_domain_model_character',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'versioningWS' => 2,
		'versioning_followPages' => true,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/icon_tx_wowarmory_domain_model_character.gif'
	)
);

?>