<?php


class tx_mscolors_updateproductposthook {

  private $ref;
  private $attributes_ids;
  private $options_names;
  private $options_values_names;
  private $post_params;

  function updateProductPostHook(&$params, &$ref) {

    error_log('updateProductPostHook() - begin');

    $this->ref = $ref;
    $this->post_params = $ref->post['tx_multishop_pi1'];

    $product_id = $params['products_id'];
    error_log('product_id: '.$product_id);
    if (!$product_id) { return; }

    $this->loadDataFromDb($product_id);

    $colors = $ref->post['tx_multishop_pi1']['colors'];
    $is_colors = $ref->post['tx_multishop_pi1']['is_colors'];
    error_log('colors: '.print_r($colors, true));
    error_log('is_colors: '.print_r($is_colors, true));
    error_log('pa_id: '.print_r($this->post_params['pa_id'], true));
    for ($i = 0; $i < count($colors); $i++) {
      if ($is_colors[$i] == "1") {
        $attribute_id = $this->attributeId($this->optionName($i), $this->optionValueName($i));
        if (!$this->isNewAttribute($i)) {
          $this->updateColorInDbRow($product_id, $attribute_id, $colors[$i]);
        }
        else {
          $this->insertNewColorRowInDb($product_id, $attribute_id, $colors[$i]);
        }
      }
    }
    error_log("updateProductPostHook() - end");
  }


  function isNewAttribute($idx) {
    error_log('isNewAttribute() - begin');
    error_log('attribute_id: '.$this->post_params['pa_id'][$idx]);
    error_log('isNewAttribute() - end');
    return $this->post_params['pa_id'][$idx] == "";
  }


  function attributeId($option_name, $option_value_name) {
    return $this->attributes_ids[$option_name.'|'.$option_value_name];
  }

  function updateColorInDbRow($product_id, $attribute_id, $color) {
    $update_array = array(
      'name' => '',
      'code' => '',
      'image' => $color
    );
    $res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery(
      'tx_mscolors_domain_model_colors',
      'product_id = '.$product_id.' and attribute_id = '.$attribute_id, // TODO make this secure with fullQuoteStr
      $update_array
    );
  }


  function insertNewColorRowInDb($product_id, $attribute_id, $color) {
    $insert_array = array(
      'product_id' => $product_id,
      'attribute_id' => $attribute_id,
      'name' => '',
      'code' => '',
      'image' => $color
    );
    error_log("insert_array: ".print_r($insert_array, true));
    $res = $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_mscolors_domain_model_colors', $insert_array);
    error_log('insert into db result: '.$res);
  }


  function loadDataFromDb($product_id) {
    $sql = $GLOBALS['TYPO3_DB']->SELECTquery(
      'pattr.products_attributes_id, popt.products_options_id, popt.products_options_name, pval.products_options_values_id, pval.products_options_values_name', // select
      'tx_multishop_products_attributes pattr, tx_multishop_products_options popt, tx_multishop_products_options_values pval', // from
      'pattr.products_id = '.$product_id.' and pattr.options_id = popt.products_options_id and pattr.options_values_id = pval.products_options_values_id and popt.language_id = pval.language_id and popt.language_id = '.$this->ref->sys_language_uid, // where
      '', // group by
      '', // orber by
      ''  // limit
    );
    $qry = $GLOBALS ['TYPO3_DB']->sql_query($sql);
    $this->attributes_ids = array();
    $this->options_names = array();
    $this->options_values_names = array();
    while (($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($qry)) != false) {
        error_log("row: ".print_r($row, true));
        $this->attributes_ids[$row['products_options_name'].'|'.$row['products_options_values_name']] = $row['products_attributes_id'];
        $this->options_names[$row['products_options_id']] = $row['products_options_name'];
        $this->options_values_names[$row['products_options_values_id']] = $row['products_options_values_name'];
    }
    error_log('attributes_ids      : '.print_r($this->attributes_ids, true));
    error_log('options_names       : '.print_r($this->options_names, true));
    error_log('options_values_names: '.print_r($this->options_values_names, true));

  }


  function optionName($idx) {
    if ($this->post_params['is_manual_options'][$idx] == 1) {
      $option_name = $this->post_params['options'][$idx];
    }
    else {
      $option_name = $this->options_names[$this->post_params['options'][$idx]];
    }
    return $option_name;
  }


  function optionValueName($idx) {
    if ($this->post_params['is_manual_attributes'][$idx] == 1) {
      $option_value_name = $this->post_params['attributes'][$idx];
    }
    else {
      $option_value_name = $this->options_values_names[$this->post_params['attributes'][$idx]];
    }
    return $option_value_name;
  }



}


?>
