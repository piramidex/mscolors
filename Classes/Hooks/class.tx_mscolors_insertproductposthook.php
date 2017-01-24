<?php


class tx_mscolors_insertproductposthook {

  function insertProductPostHook(&$params, &$ref) {

    error_log('insertProductPostHook() - begin');

    $product_id = $params['products_id'];
    error_log('product_id: '.$product_id);
    if (!$product_id) { return; }

    $post_params = $ref->post['tx_multishop_pi1'];

    $sql_attrs_ids = $GLOBALS ['TYPO3_DB']->SELECTquery(
      'pattr.products_attributes_id, popt.products_options_id, popt.products_options_name, pval.products_options_values_id, pval.products_options_values_name', // select
      'tx_multishop_products_attributes pattr, tx_multishop_products_options popt, tx_multishop_products_options_values pval', // from
      'pattr.products_id = '.$product_id.' and pattr.options_id = popt.products_options_id and pattr.options_values_id = pval.products_options_values_id and popt.language_id = pval.language_id and popt.language_id = '.$ref->sys_language_uid, // where
      '', // group by
      '', // orber by
      ''  // limit
    );
    $qry_attrs_ids = $GLOBALS ['TYPO3_DB']->sql_query($sql_attrs_ids);
    $attributes_ids = array();
    $options_names[] = array();
    $options_values_names = array();
    while (($row = $GLOBALS ['TYPO3_DB']->sql_fetch_assoc($qry_attrs_ids)) != false) {
        error_log("row: ".print_r($row, true));
        $attributes_ids[$row['products_options_name'].'|'.$row['products_options_values_name']] = $row['products_attributes_id'];
        $options_names[$row['products_options_id']] = $row['products_options_name'];
        $options_values_names[$row['products_options_values_id']] = $row['products_options_values_name'];
    }
    error_log('attributes_ids: '.print_r($attributes_ids, true));
    error_log('options_names: '.print_r($options_names, true));
    error_log('options_values_names: '.print_r($options_values_names, true));

    $colors = $post_params['colors'];
    $is_colors = $post_params['is_colors'];
    error_log('colors: '.print_r($colors, true));
    error_log('is_colors: '.print_r($is_colors, true));
    for ($i = 0; $i < count($colors); $i++) {
      if ($is_colors[$i] == "1") {
        $option_name = $this->optionName($i, $post_params, $options_names);
        $option_value_name = $this->optionValueName($i, $post_params, $options_values_names);
        error_log("option_name: ".$option_name);
        error_log("option_value_name: ".$option_value_name);
        $insert_array = array(
          'product_id' => $product_id,
          'attribute_id' => $attributes_ids[$option_name.'|'.$option_value_name],
          'name' => '',
          'code' => '',
          'image' => $colors[$i]
        );
        error_log("insert_array: ".print_r($insert_array, true));
        $res = $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_mscolors_domain_model_colors', $insert_array);
        error_log('insert into db result: '.$res);
      }
    }

    error_log("insertProductPostHook() - end");
  }


  function optionName($idx, $post_params, $options_names) {
    if ($post_params['is_manual_options'][$idx] == 1) {
      $option_name = $post_params['options'][$idx];
    }
    else {
      $option_name = $options_names[$post_params['options'][$idx]];
    }
    return $option_name;
  }


  function optionValueName($idx, $post_params, $options_values_names) {
    if ($post_params['is_manual_attributes'][$idx] == 1) {
      $option_value_name = $post_params['attributes'][$idx];
    }
    else {
      $option_value_name = $options_values_names[$post_params['attributes'][$idx]];
    }
    return $option_value_name;
  }

}

?>
