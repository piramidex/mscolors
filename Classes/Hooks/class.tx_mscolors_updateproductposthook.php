<?php


class tx_mscolors_updateproductposthook {

  function updateProductPostHook(&$params, &$ref) {

    error_log('updateProductPostHook() - begin');

    $product_id = $params['products_id'];
    error_log('product_id: '.$product_id);
    if (!$product_id) { return; }

    $attributes_ids = $ref->post['tx_multishop_pi1']['attributes_ids'];
    $colors = $ref->post['tx_multishop_pi1']['colors'];
    error_log('attributes_ids: '.print_r($attributes_ids, true));
    error_log('colors: '.print_r($colors, true));
    for ($i = 0; $i < count($attributes_ids); $i++) {
      $update_array = array(
        'name' => '',
        'code' => '',
        'image' => $colors[$i]
      );
      $res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery(
        'tx_mscolors_domain_model_colors',
        'product_id = '.$product_id.' and attribute_id = '.$attributes_ids[$i], // TODO make this secure with fullQuoteStr
        $update_array
      );
    }

    error_log("updateProductPostHook() - end");
  }


}


?>
