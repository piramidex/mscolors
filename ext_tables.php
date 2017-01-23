<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Multishop Colors');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_mscolors_domain_model_colors', 'EXT:mscolors/Resources/Private/Language/locallang_csh_tx_mscolors_domain_model_colors.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mscolors_domain_model_colors');
$GLOBALS['TCA']['tx_mscolors_domain_model_colors'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:mscolors/Resources/Private/Language/locallang_db.xlf:tx_mscolors_domain_model_colors',
		'label' => 'product_id',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'product_id,attribute_id,name,code,image,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Colors.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_mscolors_domain_model_colors.gif'
	),
);

require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('mscolors').'/Classes/Hooks/class.tx_mscolors_admineditproductpreproc.php');
require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('mscolors').'/Classes/Hooks/class.tx_mscolors_customajaxpage.php');
require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('mscolors').'/Classes/Hooks/class.tx_mscolors_updateproductposthook.php');


