<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

// Register hooks

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/multishop/scripts/admin_pages/includes/admin_edit_product.php']['adminEditProductPreProc'][] = 'tx_mscolors_admineditproductpreproc->adminEditProductPreProc';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/multishop/pi1/classes/class.mslib_fe.php']['customAjaxPage'][] = 'tx_mscolors_customajaxpage->customAjaxPage';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/multishop/scripts/admin_pages/includes/admin_edit_product.php']['updateProductPostHook'][] = 'tx_mscolors_updateproductposthook->updateProductPostHook';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/multishop/scripts/admin_pages/includes/admin_edit_product.php']['insertProductPostHook'][] = 'tx_mscolors_insertproductposthook->insertProductPostHook';

?>
