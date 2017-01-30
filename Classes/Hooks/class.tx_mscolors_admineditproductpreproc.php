<?php

class tx_mscolors_admineditproductpreproc {

  function adminEditProductPreProc(&$params, &$ref) {

    error_log('begin: mscolors-admingEditProductPreProc');
    // Hook code:
    // if (is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/multishop/scripts/admin_pages/includes/admin_edit_product.php']['adminEditProductPreProc'])) {
    //   $params=array(
    //     'subpartArray'=>&$subpartArray,
    //     'product'=>&$product,
    //     'plugins_extra_tab'=>&$plugins_extra_tab
    //   );
    //   xdebug_break();
    //   foreach ($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/multishop/scripts/admin_pages/includes/admin_edit_product.php']['adminEditProductPreProc'] as $funcRef) {
    //     //echo $funcRef;
    //     t3lib_div::callUserFunction($funcRef, $params, $ref);
    //   }
    // }

    $product = &$params['product'];
    /*
     * attributes tab
    */
    $attributes_tab_block='';
    // product Attribute
    if (!$ref->ms['MODULES']['DISABLE_PRODUCT_ATTRIBUTES_TAB_IN_EDITOR']) {
      $attributes_tab_block.='
      <input name="options_form" type="hidden" value="1" />
      <script type="text/javascript">

      var tmp_new_attr_id = 1;

      jQuery(document).ready(function($) {

        jQuery(document).on("click", "#addAttributes", function(event) {
          $(this).parent().parent().hide();
          if ($(\'#add_attributes_holder>td\').html() !=\'\' && $(\'#add_attributes_holder>td\').html() !=\'&nbsp;\') {
            return false;
          }
          var new_attributes_html=\'\';
          new_attributes_html+=\'<span class="new_product_attributes">'.$ref->pi_getLL('admin_label_add_new_product_attributes').'</span><div class="wrap-attributes-item" rel="new">\';
          new_attributes_html+=\'<table>\';
          new_attributes_html+=\'<tr class="option_row">\';

          new_attributes_html+=\'<td class="product_attribute_option">\';
          new_attributes_html+=\'<input type="hidden" name="tx_multishop_pi1[options][]" id="tmp_options_sb" style="width:200px" />\';
          new_attributes_html+=\'<input type="hidden" name="tx_multishop_pi1[is_manual_options][]" value="0" />\';
          new_attributes_html+=\'<input type="hidden" name="tx_multishop_pi1[pa_id][]" value="0" />\';
          new_attributes_html+=\'</td>\';

          new_attributes_html+=\'<td class="product_attribute_value">\';
          new_attributes_html+=\'<input type="hidden" name="tx_multishop_pi1[attributes][]" id="tmp_attributes_sb" style="width:200px" />\';
          new_attributes_html+=\'<input type="hidden" name="tx_multishop_pi1[is_manual_attributes][]" value="0" />\';
          new_attributes_html+=\'</td>\';';


error_log('addColorSelector returned value: '.$this->addColorSelector($ref));

$attributes_tab_block .= '
          new_attributes_html += \'<td class="product_attribute_color">\';
          new_attributes_html += \'<input type="hidden" name="tx_multishop_pi1[colors][]" id="input_color_image_new\' + tmp_new_attr_id + \'" value="" />\';
          new_attributes_html += \'<input type="hidden" name="tx_multishop_pi1[is_colors][]" value="0" id="input_is_color_new\' + tmp_new_attr_id + \'"/>\';
          new_attributes_html += \'<input type="hidden" name="ajax_mscolors_test" value="0" />\';
          new_attributes_html += \'</td>\';
';
    //$attributes_tab_block .= $this->addColorSelector($ref);

error_log('attributes_tab_block: '.$attributes_tab_block);



    $attributes_tab_block .= '

          new_attributes_html+=\'<td class="product_attribute_prefix">\';
          new_attributes_html+=\'<select name="tx_multishop_pi1[prefix][]">\';
          new_attributes_html+=\'<option value="">&nbsp;</option>\';
          new_attributes_html+=\'<option value="+" selected="selected">+</option>\';
          new_attributes_html+=\'<option value="-">-</option>\';
          new_attributes_html+=\'</select>\';
          new_attributes_html+=\'</td>\';

          new_attributes_html+=\'<td class="product_attribute_price">\';
          new_attributes_html+=\'<div class="msAttributesField">\';
          new_attributes_html+=\''.mslib_fe::currency().' <input type="text" name="display_name" id="display_name" class="msAttributesPriceExcludingVat">\';
          new_attributes_html+=\'<label for="display_name">'.$ref->pi_getLL('excluding_vat').'</label>\';
          new_attributes_html+=\'</div>\';
          new_attributes_html+=\'<div class="msAttributesField">\';
          new_attributes_html+=\''.mslib_fe::currency().' <input type="text" name="display_name" id="display_name" class="msAttributesPriceIncludingVat">\';
          new_attributes_html+=\'<label for="display_name">'.$ref->pi_getLL('including_vat').'</label>\';
          new_attributes_html+=\'</div>\';
          new_attributes_html+=\'<div class="msAttributesField hidden">\';
          new_attributes_html+=\'<input type="hidden" name="tx_multishop_pi1[price][]" />\';
          new_attributes_html+=\'</div>\';
          new_attributes_html+=\'</td>\';

          new_attributes_html+=\'<td>\';
          new_attributes_html+=\'<input type="button" value="'.htmlspecialchars($ref->pi_getLL('save')).'" class="msadmin_button save_new_attributes">&nbsp;<input type="button" value="'.htmlspecialchars($ref->pi_getLL('cancel')).'" class="msadmin_button delete_tmp_product_attributes">\';
          new_attributes_html+=\'</td>\';
          new_attributes_html+=\'</tr>\';

          new_attributes_html+=\'</table>\';
          new_attributes_html+=\'</div>\';
          $(\'#add_attributes_holder>td\').html(new_attributes_html);';


  //$attributes_tab_block .= $this->addColorSelectorScript($ref);

  $attributes_tab_block .= '
          // init selec2
          select2_sb("#tmp_options_sb", "'.$ref->pi_getLL('admin_label_choose_option').'", "new_product_attribute_options_dropdown", "'.mslib_fe::typolink(',2002', '&tx_multishop_pi1[page_section]=admin_ajax_product_attributes&tx_multishop_pi1[admin_ajax_product_attributes]=get_attributes_options').'");
          
          select2_values_sb("#tmp_attributes_sb", "'.$ref->pi_getLL('admin_label_choose_attribute').'", "new_product_attribute_values_dropdown", "'.mslib_fe::typolink(',2002', '&tx_multishop_pi1[page_section]=admin_ajax_product_attributes&tx_multishop_pi1[admin_ajax_product_attributes]=get_attributes_values').'");
          event.preventDefault();
        });


        jQuery(document).on("click", ".add_new_attributes_values", function(event) {
          var option_id=$(this).attr("rel");
          var d = new Date();
          var n = d.getTime();
          var new_option_cn="product_attribute_options" + n;
          var new_value_cn="product_attribute_values" + n;
          // cloned the first row of the option group
          var element_cloned=$($(this).parent().prev()).children().first().clone();
          // give the cloned row proper background color
          if ($($(this).parent().prev()).children().last().hasClass("odd_item_row")) {
            $(element_cloned).removeClass("odd_item_row").addClass("new_attributes even_item_row");
          } else {
            $(element_cloned).removeClass("even_item_row").addClass("new_attributes odd_item_row");
          }
          $(element_cloned).removeAttr("id");
          $(element_cloned).attr("rel", "new");
          // cleaned up the cloned value
          $(element_cloned).find("td.product_attribute_option>div").remove();
          $(element_cloned).find("td.product_attribute_value>div").remove();
          $(element_cloned).find("input[class^=\'product_attribute_options\']").attr("class", function(i, c){
            var classes_name=c.split(" ");
            var class_name="";
            $.each(classes_name, function(i, x){
              if (x.indexOf("product_attribute_options")!==-1) {
                class_name=x;
              }
            });
            $(this).removeClass(class_name).addClass(new_option_cn);
            // clear the pa_id
            $(this).next().next().val("");
          });
          $(element_cloned).find("input[class^=\'product_attribute_values\']").attr("class", function(i, c){
            var classes_name=c.split(" ");
            var class_name="";
            $.each(classes_name, function(i, x){
              if (x.indexOf("product_attribute_values")!==-1) {
                class_name=x;
              }
            });
            $(this).removeClass(class_name).addClass(new_value_cn);
            $(this).removeAttr("id");
            $(this).val("");
            $(this).next().removeAttr("id");
            $(this).next().val("");
          });
          $(element_cloned).find("div.product_attribute_prefix>select").val("+");
          $(element_cloned).find("div.msAttributesField>input").val("0.00");
          // add new shiny cloned attributes row
          $($(this).parent().prev()).append(element_cloned);

          // init selec2
          select2_sb(".product_attribute_options" + n, "'.$ref->pi_getLL('admin_label_choose_option').'", "new_product_attribute_options_dropdown", "'.mslib_fe::typolink(',2002', '&tx_multishop_pi1[page_section]=admin_ajax_product_attributes&tx_multishop_pi1[admin_ajax_product_attributes]=get_attributes_options').'");
          select2_values_sb(".product_attribute_values" + n, "'.$ref->pi_getLL('admin_label_choose_attribute').'", "new_product_attribute_values_dropdown", "'.mslib_fe::typolink(',2002', '&tx_multishop_pi1[page_section]=admin_ajax_product_attributes&tx_multishop_pi1[admin_ajax_product_attributes]=get_attributes_values').'");
          event.preventDefault();';

          $attributes_tab_block .= 'var new_attributes_html = \'<td class="product_attribute_color">\'; '.$this->addColorSelector($ref).'; new_attributes_html += \'</td>\'; ';
          $attributes_tab_block .= '$(element_cloned).find("td.product_attribute_color").replaceWith(new_attributes_html);';
          $attributes_tab_block .= $this->addColorSelectorScript($ref);

          $attributes_tab_block .= '
          var cloned_option_name = $(element_cloned).find("span[class^=\'select2-chosen\']").html();
          if (cloned_option_name.toUpperCase() == "COLOR") {
            $(element_cloned).find("input[name*=\'is_colors\']").attr("value", "1");
          }
          else {
            $(element_cloned).find("input[name*=\'is_colors\']").attr("value", "0");
            $(element_cloned).find("img[id*=\'color_image\']").remove();
            $(element_cloned).find("div[id*=\'color_image\']").remove();
          }

        });




        jQuery(document).on("click", ".save_new_attributes", function(){
          var pa_main_divwrapper=$(this).parent().parent().parent().parent().parent();
          var pa_option_sb=$("#tmp_options_sb").select2("data");
          var pa_attributes_sb=$("#tmp_attributes_sb").select2("data");
          if (pa_option_sb !== null && pa_attributes_sb !== null) {
            var selected_pa_option_id=pa_option_sb.id;
            var selected_pa_option_text=pa_option_sb.text;
          } else {
            var selected_pa_option_id="";
            var selected_pa_option_text="";
          }
          var target_liwrapper_id="#products_attributes_item_" + selected_pa_option_id + " > div.items_wrapper";
          if (selected_pa_option_id != "") {
            var delete_button_html=\'<input type="button" value="'.htmlspecialchars($ref->pi_getLL('delete')).'" class="msadmin_button delete_product_attributes">\';
            // add class for marker
            $(pa_main_divwrapper).addClass("new_attributes");
            // check for the main tr if it exists
            if ($("#product_attributes_content_row").length===0) {
              var new_tr=\'<tr id="product_attributes_content_row"><td colspan="5"><ul id="products_attributes_items"></ul></td></tr>\';
              $(new_tr).insertBefore("#add_attributes_holder");
              // activate sortable on ul > li
              sort_li();
            }
            // destroy select2 before moving to <li>
            $("#tmp_options_sb").select2("destroy");
            $("#tmp_attributes_sb").select2("destroy");
            // check if the <li> is exist
            if ($(target_liwrapper_id).length) {
              // directly append if exist
              if ($(target_liwrapper_id).children().last().hasClass("odd_item_row")) {
                $(pa_main_divwrapper).addClass("even_item_row");
              } else {
                $(pa_main_divwrapper).addClass("odd_item_row");
              }
              // rewrite the button
              $(this).parent().empty().html(delete_button_html);
              // flush it to existing li
              $(target_liwrapper_id).append(pa_main_divwrapper);
              if ($(target_liwrapper_id).is(":hidden")) {
                $(target_liwrapper_id).prev().children().removeClass("items_wrapper_folded").addClass("items_wrapper_unfolded").html("fold");
                $(target_liwrapper_id).show();
              }
            } else {
              var li_class="odd_group_row";
              if ($(".products_attributes_items").children().last().hasClass("odd_group_row")) {
                li_class="even_group_row";
              }
              var new_li = $("<li/>", {
                id: "products_attributes_item_" + selected_pa_option_id,
                alt: selected_pa_option_text,
                class: "products_attributes_item " + li_class
              });
              $(new_li).append(\'<span class="option_name">\' + selected_pa_option_text + \' <a href="#" class="items_wrapper_unfolded">fold</a></span><div class="items_wrapper"></div><div class="add_new_attributes"><input type="button" class="msadmin_button add_new_attributes_values" value="'.$ref->pi_getLL('admin_add_new_value').' [+]" rel="\' + selected_pa_option_id + \'" /></div>\');
              $(pa_main_divwrapper).addClass("odd_item_row");
              // rewrite the button
              $(this).parent().empty().html(delete_button_html);
              // flush it to existing li
              $(new_li).children("div.items_wrapper").append(pa_main_divwrapper);
              // flush new li to the newly created tr > ul
              $("#products_attributes_items").append(new_li);
              // activate sorting for li children
              sort_li_children();
            }
            // appended to select2 class name for newly created select2 instantiation
            // so it wont refresh others select2 elements
            var d = new Date();
            var n = d.getTime();
            $("#tmp_options_sb").addClass("product_attribute_options" + n);
            $("#tmp_attributes_sb").addClass("product_attribute_values" + n);
            // remove id for reuse later
            $("#tmp_options_sb").removeAttr("id");
            $("#tmp_attributes_sb").removeAttr("id");
            // init the select2 for new product attributes
            select2_sb(".product_attribute_options" + n, "'.$ref->pi_getLL('admin_label_choose_option').'", "product_attribute_options_dropdown", "'.mslib_fe::typolink(',2002', '&tx_multishop_pi1[page_section]=admin_ajax_product_attributes&tx_multishop_pi1[admin_ajax_product_attributes]=get_attributes_options').'");
            select2_values_sb(".product_attribute_values" + n, "'.$ref->pi_getLL('admin_label_choose_attribute').'", "product_attribute_values_dropdown", "'.mslib_fe::typolink(',2002', '&tx_multishop_pi1[page_section]=admin_ajax_product_attributes&tx_multishop_pi1[admin_ajax_product_attributes]=get_attributes_values').'");
            // clear the temp holder
            $("tr#add_attributes_holder > td").html("&nbsp;");
            $("#add_attributes_button").show();
          } else {
            msDialog("ERROR","'.$ref->pi_getLL('admin_label_please_select_options_and_attributes_value').'");
          }
        });



        $(document).on("click", "#manual_button", function(event) {
          jQuery("#attributes_header").show();
        });




        $(document).on("click", "span.option_name", function(e){
          e.preventDefault();
          var self = $(this).children("a");
          var li_this=$(self).parent().parent();
          if($(self).hasClass("items_wrapper_unfolded")) {
            $(li_this).children("div.items_wrapper").hide();
            $(li_this).children("div.add_new_attributes").hide();
            $(self).removeClass("items_wrapper_unfolded");
            $(self).addClass("items_wrapper_folded").html("unfold");
          } else {
            $(li_this).children("div.items_wrapper").show();
            $(li_this).children("div.add_new_attributes").show();
            $(self).removeClass("items_wrapper_folded");
            $(self).addClass("items_wrapper_unfolded").html("fold");
          }
        });




        jQuery(document).on("click", ".delete_product_attributes", function(){
          var pa_main_divwrapper=$(this).parent().parent().parent().parent().parent();
          var pa_main_liwrapper=$(pa_main_divwrapper).parent();
          var product_attribute_id=$(pa_main_divwrapper).attr("rel");
          if (product_attribute_id != "new") {
            href = "'.mslib_fe::typolink(',2002', '&tx_multishop_pi1[page_section]=admin_ajax_product_attributes&tx_multishop_pi1[admin_ajax_product_attributes]=delete_product_attributes&pid='.$product['products_id']).'";
            jQuery.ajax({
              type:"POST",
              url:href,
              data: "paid=" + product_attribute_id,
              success: function(msg) {
                //do something with the sorted data
              }
            });
          }
          $(pa_main_divwrapper).remove();
          if ($(pa_main_liwrapper).children().length === 0) {
            $(pa_main_liwrapper).parent().remove();
          }
        });




        jQuery(document).on("click", ".delete_tmp_product_attributes", function(){
          var pa_main_divwrapper=$(this).parent().parent().parent().parent().parent();
          $(pa_main_divwrapper).remove();

          $("tr#add_attributes_holder > td").html("&nbsp;");
          $("#add_attributes_button").show();
        });



        var select2_sb = function(selector_str, placeholder, dropdowncss, ajax_url) {
          $(selector_str).select2({
            placeholder: placeholder,
            createSearchChoice:function(term, data) {
              if (attributesOptions[term] === undefined) {
                attributesOptions[term]={id: term, text: term};
              }
              return {id:term, text:term};
            },
            minimumInputLength: 0,
            query: function(query) {
              if (attributesSearchOptions[query.term] !== undefined) {
                query.callback({results: attributesSearchOptions[query.term]});
              } else {
                $.ajax(ajax_url, {
                  data: {
                    q: query.term
                  },
                  dataType: "json"
                }).done(function(data) {
                  attributesSearchOptions[query.term]=data;
                  query.callback({results: data});
                });
              }
            },
            initSelection: function(element, callback) {
              var id=$(element).val();
              if (id!=="") {
                if (attributesOptions[id] !== undefined) {
                  callback(attributesOptions[id]);
                } else {
                  $.ajax(ajax_url, {
                    data: {
                      preselected_id: id
                    },
                    dataType: "json"
                  }).done(function(data) {
                    attributesOptions[data.id]={id: data.id, text: data.text};
                    callback(data);
                  });
                }
              }
            },
            formatResult: function(data){
              if (data.text === undefined) {
                $.each(data, function(i,val){
                  return val.text;
                });
              } else {
                return data.text;
              }
            },
            formatSelection: function(data){
              if (data.text === undefined) {
                return data[0].text;
              } else {
                return data.text;
              }
            },
            dropdownCssClass: dropdowncss,
            escapeMarkup: function (m) { return m; }
          }).on("select2-selecting", function(e) {
            if (e.object.id == e.object.text) {
              $(this).next().val("1");
            } else {
              $(this).next().val("0");
            }
          }).on("change", function(e) {
            if ($(this).select2("data").text.toUpperCase() == "COLOR") {
              $(this).select2("container").parent().parent().find("input[name*=colors]").remove()
              var new_attributes_html = \'\'; '.$this->addColorSelector($ref).'
              $(this).select2("container").parent().parent().find("td[class*=\'product_attribute_color\']").prepend(new_attributes_html);
              '.$this->addColorSelectorScript($ref).'
            }
            else {
              $(this).select2("container").parent().parent().find("input[name*=is_colors]").attr("value", 0);
              $(this).select2("container").parent().parent().find("img[id*=\'color_image\']").remove();
              $(this).select2("container").parent().parent().find("div[id*=\'color_image\']").remove();
            }
          });
        }





        var select2_values_sb = function(selector_str, placeholder, dropdowncss, ajax_url) {
          $(selector_str).select2({
            placeholder: placeholder,
            createSearchChoice:function(term, data) {
              if ($(data).filter(function() {
                return this.text.localeCompare(term)===0;
              }).length===0) {
                if (attributesValues[term] === undefined) {
                  attributesValues[term]={id: term, text: term};
                }
                return {id:term, text:term};
              }
            },
            minimumInputLength: 0,
            query: function(query) {
              if (attributesSearchValues[query.term] !== undefined) {
                query.callback({results: attributesSearchValues[query.term]});
              } else {
                $.ajax(ajax_url, {
                  data: {
                    q: query.term + "||optid=" +  $(selector_str).parent().prev().children("input").val()
                  },
                  dataType: "json"
                }).done(function(data) {
                  attributesSearchValues[query.term]=data;
                  query.callback({results: data});
                });
              }
            },
            initSelection: function(element, callback) {
              var id=$(element).val();
              if (id!=="") {
                if (attributesValues[id] !== undefined) {
                  callback(attributesValues[id]);
                } else {
                  $.ajax(ajax_url, {
                    data: {
                      preselected_id: id,
                    },
                    dataType: "json"
                  }).done(function(data) {
                    attributesValues[data.id]={id: data.id, text: data.text};
                    callback(data);
                  });
                }
              }
            },
            formatResult: function(data){
              var tmp_data=data.text.split("||");
              return tmp_data[0];
            },
            formatSelection: function(data){
              if (data.text === undefined) {
                return data[0].text;
              } else {
                return data.text;
              }
            },
            dropdownCssClass: dropdowncss,
            escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
          }).on("select2-selecting", function(e) {
            if (e.object.id == e.object.text) {
              $(this).next().val("1");
            } else {
              $(this).next().val("0");
            }
          });;
        }




        var sort_li = function () {
          jQuery("#products_attributes_items").sortable({
            '.($product['products_id'] ? '
            update: function(e, ui) {
              href = "'.mslib_fe::typolink(',2002', '&tx_multishop_pi1[page_section]=admin_ajax_product_attributes&tx_multishop_pi1[admin_ajax_product_attributes]=sort_product_attributes_option&pid='.$product['products_id']).'";
              jQuery(this).sortable("refresh");
              sorted = jQuery(this).sortable("serialize", "id");
              jQuery.ajax({
                type:"POST",
                url:href,
                data:sorted,
                success: function(msg) {
                  //do something with the sorted data
                }
              });
            },
            ' : '').'
            cursor:"move",
            items:">li.products_attributes_item"
          });
        }




        var sort_li_children = function () {
          jQuery(".items_wrapper").sortable({
            '.($product['products_id'] ? '
            update: function(e, ui) {
              href = "'.mslib_fe::typolink(',2002', '&tx_multishop_pi1[page_section]=admin_ajax_product_attributes&tx_multishop_pi1[admin_ajax_product_attributes]=sort_product_attributes_value&pid='.$product['products_id']).'";
              jQuery(this).sortable("refresh");
              sorted = jQuery(this).sortable("serialize", "id");
              jQuery.ajax({
                type:"POST",
                url:href,
                data:sorted,
                success: function(msg) {
                  //do something with the sorted data
                }
              });
            },
            ' : '').'
            cursor:"move",
            items:">div.wrap-attributes-item"
          });
        }
        sort_li();
        sort_li_children();
        $(".items_wrapper").hide();
        $(".add_new_attributes").hide();
        select2_sb(".product_attribute_options", "'.$ref->pi_getLL('admin_label_choose_option').'", "product_attribute_options_dropdown", "'.mslib_fe::typolink(',2002', '&tx_multishop_pi1[page_section]=admin_ajax_product_attributes&tx_multishop_pi1[admin_ajax_product_attributes]=get_attributes_options').'");
        select2_values_sb(".product_attribute_values", "'.$ref->pi_getLL('admin_label_choose_attribute').'", "product_attribute_values_dropdown", "'.mslib_fe::typolink(',2002', '&tx_multishop_pi1[page_section]=admin_ajax_product_attributes&tx_multishop_pi1[admin_ajax_product_attributes]=get_attributes_values').'");
      });
      </script>
      <h1>'.$ref->pi_getLL('admin_product_attributes').'</h1>
      ';






      if ($ref->get['cid']) {
        // optional predefined attributes menu
        $catCustomSettings=mslib_fe::loadInherentCustomSettingsByCategory($ref->get['cid']);
        $productOptions=array();
        if ($product['products_id']) {
          $productOptions=mslib_fe::getProductOptions($product['products_id']);
        }
        // ADMIN_PREDEFINED_ATTRIBUTE_FIELDS
        if ($catCustomSettings ['ADMIN_PREDEFINED_ATTRIBUTE_FIELDS']) {
          $fields=explode(";", $catCustomSettings ['ADMIN_PREDEFINED_ATTRIBUTE_FIELDS']);
          if (is_array($fields) and count($fields)) {
            $attributes_tab_block.='
            <style>
              #predefined_attributes
              {
                width:100%;
              }
              #predefined_attributes label
              {
                color: #999;
                font-size:12px;
                font-weight:bold;
              }
              #predefined_attributes .options_attributes
              {
                width:150px;float:left;overflow:hidden;
                padding-bottom:10px;
              }
            </style>
      <div class="wrap-attributes" id="msEditProductInputAttributes">
      <table width="100%" cellpadding="2" cellspacing="2">
        <tr class="option_row2" >
           <td>
            <div id="predefined_attributes">
            ';
            foreach ($fields as $field) {
              if (strstr($field, ":")) {
                $array=explode(":", $field);
                if (strstr($array [1], '{asc}')) {
                  $order_by='asc';
                  $array [1]=str_replace('{asc}', '', $array [1]);
                } elseif (strstr($array [1], '{desc}')) {
                  $order_by='desc';
                  $array [1]=str_replace('{desc}', '', $array [1]);
                } else {
                  $order_column='povp.sort_order';
                  $order_by='asc';
                }
                $option_id=$array [0];
                $list_type=$array [1];
                $query=$GLOBALS ['TYPO3_DB']->SELECTquery('*', // SELECT ...
                  'tx_multishop_products_options', // FROM ...
                  'products_options_id=\''.$option_id.'\' and language_id=\''.$ref->sys_language_uid.'\'', // WHERE.
                  '', // GROUP BY...
                  '', // ORDER BY...
                  '') // LIMIT ...
                ;
                $res=$GLOBALS ['TYPO3_DB']->sql_query($query);
                if ($GLOBALS ['TYPO3_DB']->sql_num_rows($res)>0) {
                  $i=0;
                  while (($row=$GLOBALS ['TYPO3_DB']->sql_fetch_assoc($res))!=false) {
                    $query_opt_2_values=$GLOBALS ['TYPO3_DB']->SELECTquery('pov.products_options_values_id, pov.products_options_values_name', // SELECT
                      // ...
                      'tx_multishop_products_options_values pov, tx_multishop_products_options_values_to_products_options povp', // FROM
                      // ...
                      "pov.language_id='".$ref->sys_language_uid."' and povp.products_options_id = ".$option_id." and pov.products_options_values_id=povp.products_options_values_id", // WHERE.
                      '', // GROUP BY...
                      'povp.sort_order '.$order_by, // ORDER BY...
                      '') // LIMIT ...
                    ;
                    $res_opt_2_values=$GLOBALS ['TYPO3_DB']->sql_query($query_opt_2_values);
                    if ($GLOBALS ['TYPO3_DB']->sql_num_rows($res_opt_2_values)>0) {
                      $attributes_tab_block.='<div class="options_attributes"><label>'.$row ['products_options_name'].'</label>';
                      if ($list_type=='list') {
                        $attributes_tab_block.='
                          <div class="options_attributes_wrapper">
                               <select class="option-attributes" name="predefined_option['.$option_id.'][]" id="option'.$option_id.'"><option value="">'.htmlspecialchars('None').'</option>';
                        while (($row_opt_2_values=$GLOBALS ['TYPO3_DB']->sql_fetch_assoc($res_opt_2_values))!=false) {
                          $selected=(is_array($productOptions [$option_id]) and in_array($row_opt_2_values ['products_options_values_id'], $productOptions [$option_id])) ? " selected" : "";
                          $attributes_tab_block.='<option value="'.$row_opt_2_values ['products_options_values_id'].'"'.$selected.'>'.htmlspecialchars($row_opt_2_values ['products_options_values_name']).'</option>'."\n";
                        }
                        $attributes_tab_block.='</select></div>'."\n";
                      } elseif ($list_type=='multiple') {
                        $attributes_tab_block.='
                          <div class="options_attributes_wrapper">
                          <select class="option-attributes option-attributes-multiple" name="predefined_option['.$option_id.'][]" id="option'.$option_id.'" size="10" style=";height:100px;" multiple="multiple"><option value="">'.htmlspecialchars('None').'</option>';
                        while (($row_opt_2_values=$GLOBALS ['TYPO3_DB']->sql_fetch_assoc($res_opt_2_values))!=false) {
                          $selected=(is_array($productOptions [$option_id]) and in_array($row_opt_2_values ['products_options_values_id'], $productOptions [$option_id])) ? " selected" : "";
                          $attributes_tab_block.='<option value="'.$row_opt_2_values ['products_options_values_id'].'"'.$selected.'>'.htmlspecialchars($row_opt_2_values ['products_options_values_name']).'</option>'."\n";
                        }
                        $attributes_tab_block.='</select></div>'."\n";
                      } elseif ($list_type=='checkbox') {
                        $attributes_tab_block.='<div class="options_attributes_wrapper">
                          <input name="predefined_option['.$option_id.'][]" type="hidden" value="" />
                          ';
                        while (($row_opt_2_values=$GLOBALS ['TYPO3_DB']->sql_fetch_assoc($res_opt_2_values))!=false) {
                          $selected=(is_array($productOptions [$option_id]) and in_array($row_opt_2_values ['products_options_values_id'], $productOptions [$option_id])) ? " checked" : "";
                          $attributes_tab_block.='<div class="option_attributes_radio"><input type="checkbox" name="predefined_option['.$option_id.'][]" value="'.$row_opt_2_values ['products_options_values_id'].'" class="option-attributes" id="option'.$option_id.'"'.$selected.'>'.htmlspecialchars($row_opt_2_values ['products_options_values_name']).'</div>'."\n";
                        }
                        $attributes_tab_block.='</div>'."\n";
                      } elseif ($list_type=='radio') {
                        $attributes_tab_block.='<div class="options_attributes_wrapper">
            <div class="option_attributes_radio">
              <input type="radio" name="predefined_option['.$option_id.'][]" id="option'.$option_id.'" value=""  class="option-attributes">'.htmlspecialchars('None').'
            </div>
                          ';
                        while (($row_opt_2_values=$GLOBALS ['TYPO3_DB']->sql_fetch_assoc($res_opt_2_values))!=false) {
                          $selected=(is_array($productOptions [$option_id]) and in_array($row_opt_2_values ['products_options_values_id'], $productOptions [$option_id])) ? " checked" : "";
                          $attributes_tab_block.='<div class="option_attributes_radio"><input type="radio" name="predefined_option['.$option_id.'][]" id="option'.$option_id.'" value="'.$row_opt_2_values ['products_options_values_id'].'" class="option-attributes"'.$selected.'>'.htmlspecialchars($row_opt_2_values ['products_options_values_name']).'</div>'."\n";
                        }
                        $attributes_tab_block.='</div>'."\n";
                      }
                      $attributes_tab_block.='</div>'."\n";
                    }
                    $i++;
                  }
                }
              }
            }
            $attributes_tab_block.='</div>
            </td></tr></table>
            </div>
            '."\n";
          }
        }
      }
      // end optional predefined attributes menu



      error_log('populate attributes from the database');


      // Retrieve colors data from db
      $sql_colors = $GLOBALS ['TYPO3_DB']->SELECTquery(
        'attribute_id, name, code, image', // SELECT ...
        'tx_mscolors_domain_model_colors', // FROM ...
        'product_id = '.$product['products_id'], //WHERE ...
        '', // GROUP BY...
        '', // ORDER BY...
        '' // LIMIT ...
      );
      $qry_colors = $GLOBALS ['TYPO3_DB']->sql_query($sql_colors);
      $colors_data = array();
      while (($row = $GLOBALS ['TYPO3_DB']->sql_fetch_assoc($qry_colors)) != false) {
          $colors_data[$row['attribute_id']] = $row;
       }
       error_log('colors_data: '.print_r($colors_data, true));


      // Retrieve attributes from db
      $sql_pa=$GLOBALS ['TYPO3_DB']->SELECTquery('popt.required,popt.products_options_id, popt.products_options_name, popt.listtype, patrib.*', // SELECT ...
        'tx_multishop_products_options popt, tx_multishop_products_attributes patrib', // FROM ...
        "patrib.products_id='".$product['products_id']."' and popt.language_id = '0' and patrib.options_id = popt.products_options_id", // WHERE.
        '', // GROUP BY...
        'patrib.sort_order_option_name, patrib.sort_order_option_value', // ORDER BY...
        '' // LIMIT ...
      );
      $qry_pa=$GLOBALS ['TYPO3_DB']->sql_query($sql_pa);
      $attributes_tab_block.='<table width="100%" cellpadding="2" cellspacing="2" id="product_attributes_table">';
      $js_select2_cache='';
      $js_select2_cache_options=array();
      $js_select2_cache_values=array();
      $js_select2_cache='
      <script type="text/javascript">
        var attributesSearchOptions=[];
        var attributesSearchValues=[];
        var attributesOptions=[];
        var attributesValues=[];'."\n";
      error_log('products_id: '.$product['products_id']);
      if ($product['products_id']) {
        if ($GLOBALS['TYPO3_DB']->sql_num_rows($qry_pa)>0) {
          error_log("processing attribute row from database");
          $ctr=1;
          $options_data=array();
          $attributes_data=array();
          while (($row=$GLOBALS ['TYPO3_DB']->sql_fetch_assoc($qry_pa))!=false) {
            $row['options_values_name']=mslib_fe::getNameOptions($row['options_values_id']);
            $options_data[$row['products_options_id']]=$row['products_options_name'];
            $attributes_data[$row['products_options_id']][]=$row;
            // js cache
            $js_select2_cache_options[$row['products_options_id']]='attributesOptions['.$row['products_options_id'].']={id:"'.$row['products_options_id'].'", text:"'.$row['products_options_name'].'"}';
            $js_select2_cache_values[$row['options_values_id']]='attributesValues['.$row['options_values_id'].']={id:"'.$row['options_values_id'].'", text:"'.$row['options_values_name'].'"}';
          }
          if (count($options_data)) {
            $attributes_tab_block.='<tr id="product_attributes_content_row">';
            $attributes_tab_block.='<td colspan="5"><ul id="products_attributes_items">';
            foreach ($options_data as $option_id=>$option_name) {
              if (!isset($group_row_type) || $group_row_type=='even_group_row') {
                $group_row_type='odd_group_row';
              } else {
                $group_row_type='even_group_row';
              }
              $attributes_tab_block.='<li id="products_attributes_item_'.$option_id.'" alt="'.$option_name.'" class="products_attributes_item '.$group_row_type.'">
              <span class="option_name">'.$option_name.' <a href="#" class="items_wrapper_folded">unfold</a></span>
              <div class="items_wrapper">
              ';
              foreach ($attributes_data[$option_id] as $attribute_data) {
                if (!isset($item_row_type) || $item_row_type=='even_item_row') {
                  $item_row_type='odd_item_row';
                } else {
                  $item_row_type='even_item_row';
                }
                $attributes_tab_block .= '<div class="wrap-attributes-item '.$item_row_type.'" id="item_product_attribute_'.$attribute_data['products_attributes_id'].'" rel="'.$attribute_data['products_attributes_id'].'">';
                $attributes_tab_block .= '<table>';
                $attributes_tab_block .= '<tr class="option_row">';

                $attributes_tab_block .= '<td class="product_attribute_option">';
                $attributes_tab_block .= '<input type="hidden" name="tx_multishop_pi1[options][]" id="option_'.$attribute_data['products_attributes_id'].'" class="product_attribute_options" value="'.$option_id.'" style="width:200px" />';
                $attributes_tab_block .= '<input type="hidden" name="tx_multishop_pi1[is_manual_options][]" id="manual_option_'.$attribute_data['products_attributes_id'].'" value="0" />';
                $attributes_tab_block .= '<input type="hidden" name="tx_multishop_pi1[pa_id][]" value="'.$attribute_data['products_attributes_id'].'" />';
                $attributes_tab_block .= '</td>';

                $attributes_tab_block .= '<td class="product_attribute_value">';
                $attributes_tab_block .= '<input type="hidden" name="tx_multishop_pi1[attributes][]" id="attribute_'.$attribute_data['products_attributes_id'].'" class="product_attribute_values" value="'.$attribute_data['options_values_id'].'" style="width:200px" />';
                $attributes_tab_block .= '<input type="hidden" name="tx_multishop_pi1[is_manual_attributes][]" id="manual_attributes_'.$attribute_data['products_attributes_id'].'" value="0" />';
                $attributes_tab_block .= '</td>';


                // ---- Color image ----
                if (strcasecmp($option_name, 'color') == 0) {
                  $attributes_tab_block .= '<td class="product_attribute_color">';
                  $attributes_tab_block .= '<img id="img_color_image_'.$attribute_data['products_attributes_id'].'" src="'.$colors_data[$attribute_data['products_attributes_id']]['image'].'" />';
                  $attributes_tab_block .= '<div  id="color_image_'.$attribute_data['products_attributes_id'].'"> <noscript> <input type="file" name="tx_mscolors_test" accept="image/*" /> </noscript> </div>';
                  $attributes_tab_block .= '<input type="hidden" name="tx_multishop_pi1[colors][]" id="input_color_image_'.$attribute_data['products_attributes_id'].'" value="'.$colors_data[$attribute_data['products_attributes_id']]['image'].'" />';
                  $attributes_tab_block .= '<input type="hidden" name="tx_multishop_pi1[is_colors][]" value="1" />';
                  $attributes_tab_block .= '<input type="hidden" name="ajax_mscolors_test" value="0" />';
                  $attributes_tab_block .= '<script> jQuery(document).ready(function($) { '.$this->addColorSelectorScript2($ref, $attribute_data['products_attributes_id']).' }); </script>';
                  $attributes_tab_block .= '</td>';
                }
                else {
                  $attributes_tab_block .= '<td class="product_attribute_color">';
                  $attributes_tab_block .= '<input type="hidden" name="tx_multishop_pi1[attributes_ids][]" value="'.$attribute_data['products_attributes_id'].'" />';
                  $attributes_tab_block .= '<input type="hidden" name="tx_multishop_pi1[colors][]" id="input_color_image_'.$attribute_data['products_attributes_id'].'" value="" />';
                  $attributes_tab_block .= '<input type="hidden" name="tx_multishop_pi1[is_colors][]" value="0" />';
                  $attributes_tab_block .= '</td>';
                }
                // -----------------


                $attributes_tab_block .= '<td class="product_attribute_prefix">';
                $attributes_tab_block .= '<select name="tx_multishop_pi1[prefix][]">';
                $attributes_tab_block .= '<option value="">&nbsp;</option>';
                $attributes_tab_block .= '<option value="+"'.($attribute_data['price_prefix']=='+' ? ' selected="selected"' : '').'>+</option>';
                $attributes_tab_block .= '<option value="-"'.($attribute_data['price_prefix']=='-' ? ' selected="selected"' : '').'>-</option>';
                $attributes_tab_block .= '</select>';
                //$attributes_tab_block.='<input type="text" name="tx_multishop_pi1[prefix][]" value="'.$attribute_data['price_prefix'].'" />';
                $attributes_tab_block.='</td>';
                // recalc price to display
                $attributes_tax=mslib_fe::taxDecimalCrop(($attribute_data['options_values_price']*$product_tax_rate)/100);
                $attribute_price_display=mslib_fe::taxDecimalCrop($attribute_data['options_values_price'], 2, false);
                $attribute_price_display_incl=mslib_fe::taxDecimalCrop($attribute_data['options_values_price']+$attributes_tax, 2, false);
                $attributes_tab_block.='<td>
                      <div class="msAttributesField">'.mslib_fe::currency().' <input type="text" id="display_name" name="display_name" class="msAttributesPriceExcludingVat" value="'.$attribute_price_display.'"><label for="display_name">'.$ref->pi_getLL('excluding_vat').'</label></div>
                      <div class="msAttributesField">'.mslib_fe::currency().' <input type="text" name="display_name" id="display_name" class="msAttributesPriceIncludingVat" value="'.$attribute_price_display_incl.'"><label for="display_name">'.$ref->pi_getLL('including_vat').'</label></div>
                      <div class="msAttributesField hidden"><input type="hidden" name="tx_multishop_pi1[price][]" value="'.$attribute_data['options_values_price'].'" /></div>
                    </td>';
                $attributes_tab_block.='<td class="product_attribute_price"><input type="button" value="'.htmlspecialchars($ref->pi_getLL('delete')).'" class="msadmin_button delete_product_attributes"></td>';
                $attributes_tab_block.='</tr>';
                $attributes_tab_block.='</table>';
                $attributes_tab_block.='</div>';


              }
              $attributes_tab_block.='</div><div class="add_new_attributes"><input type="button" class="msadmin_button add_new_attributes_values" value="'.$ref->pi_getLL('admin_add_new_value').' [+]" rel="'.$option_id.'" /></div>';
              $attributes_tab_block.='</li>';
            }
            $attributes_tab_block.='</ul></td>';
            $attributes_tab_block.='</tr>';
          }
        }
        $count_js_cache_options=count($js_select2_cache_options);
        $count_js_cache_values=count($js_select2_cache_values);
        if ($count_js_cache_options) {
          $js_select2_cache.=implode(";\n", $js_select2_cache_options);
        }
        if ($count_js_cache_values) {
          if ($count_js_cache_options) {
            $js_select2_cache.=";\n";
          }
          $js_select2_cache.=implode(";\n", $js_select2_cache_values).";\n";
        }
      }
      $js_select2_cache.='</script>';
      if (!empty($js_select2_cache)) {
        $GLOBALS['TSFE']->additionalHeaderData['js_select2_cache']=$js_select2_cache;
      }
      $attributes_tab_block.='<tr id="add_attributes_holder">
          <td colspan="5">&nbsp;</td>
      </tr>';
      $attributes_tab_block.='<tr id="add_attributes_button">
          <td colspan="5" align="right"><input id="addAttributes" type="button" class="msadmin_button" value="'.$ref->pi_getLL('admin_add_new_attribute').' [+]"></td>
      </tr>
      </table>
      <script>
      $(document).on("keyup", ".msAttributesPriceExcludingVat", function() {
        productPrice(true, $(this));
      });
      $(document).on("keyup", ".msAttributesPriceIncludingVat", function() {
        productPrice(false, $(this));
      });
      </script>
      ';
    }



      // upload script

             $images_tab_block.='<script>
            jQuery(document).ready(function($) {';
            for ($x=0; $x<$reference->ms['MODULES']['NUMBER_OF_PRODUCT_IMAGES']; $x++) {
//              $i=$x;
//              if ($i==0) {
//                $i='';
//              }
                $i = $x+1;
                $images_tab_block.='
                var products_name=$("#products_name_0").val();
                var uploader'.$i.' = new qq.FileUploader({
                  element: document.getElementById(\'variants_image_'.$variant['variant_id'].'_'.$i.'\'),
                  action: \''.mslib_fe::typolink(',2002', '&tx_multishop_pi1[page_section]=custom_page').'\',
                  params: {
                    products_name: products_name,
                    file_type: \'products_image'.$i.'\'
                  },
                  template: \'<div class="qq-uploader">\' +
                  \'<div class="qq-upload-drop-area"><span>'.$reference->pi_getLL('admin_label_drop_files_here_to_upload').'</span></div>\' +
                  \'<div class="qq-upload-button">'.addslashes(htmlspecialchars($reference->pi_getLL('choose_image'))).'</div>\' +
                  \'<ul class="qq-upload-list"></ul>\' +
                  \'</div>\',
                  onComplete: function(id, fileName, responseJSON){
                    var filenameServer = responseJSON[\'filename\'];
                    $("#ajax_variants_image_'.$variant['variant_id'].'_'.$i.'").val(filenameServer);
                  },
                  debug: false
                });';
              }
              $images_tab_block.='
              $(\'#products_name_0\').change(function() {
                var products_name=$("#products_name_0").val();';
                for ($x=0; $x<$reference->ms['MODULES']['NUMBER_OF_PRODUCT_IMAGES']; $x++) {
//                  $i=$x;
//                  if ($i==0) {
//                    $i='';
//                  }
                  $i = $x+1;
                  $images_tab_block.='
                  uploader'.$i.'.setParams({
                   products_name: products_name,
                   file_type: \'products_image'.$i.'\'
                 });';
               }
                $images_tab_block.='
              });
            });
          </script>';
    // product Attribute eof


          error_log('attributes_tab_block: '.$attributes_tab_block);


    $params['subpartArray']['###INPUT_ATTRIBUTES_BLOCK###'] = $attributes_tab_block;

    error_log('end: mscolors-admingEditProductPreProc');


  }


  function addColorSelector(&$ref) {
          $i = 'test';
          $html = '
          new_attributes_html += \'<img id="img_color_image_new\' + tmp_new_attr_id + \'" src="" />\';
          new_attributes_html += \'<div  id="color_image_new\' + tmp_new_attr_id + \'"> <noscript> <input type="file" name="tx_mscolors_test" accept="image/*" /> </noscript> </div>\';
          new_attributes_html += \'<input type="hidden" name="tx_multishop_pi1[colors][]" id="input_color_image_new\' + tmp_new_attr_id + \'" value="" />\';
          new_attributes_html += \'<input type="hidden" name="tx_multishop_pi1[is_colors][]" value="1" id="input_is_color_new\' + tmp_new_attr_id + \'"/>\';
          new_attributes_html += \'<input type="hidden" name="ajax_mscolors_test" value="0" />\';
          ';
          return $html;
  }


  function addColorSelectorScript(&$ref) {
    $i = 'test';
    $html = '
            var products_name=$("#products_name_0").val();
            var element = document.getElementById("tx_mscolors_test2");
            var element2 = $("td.product_attribute_color>div", $("#add_attributes_holder"));
            var uploader'.$i.' = new qq.FileUploader({
                  element: document.getElementById("color_image_new" + tmp_new_attr_id),
                  action: "'.mslib_fe::typolink(',2002', '&tx_multishop_pi1[page_section]=custom_page').'",
                  params: {
                    products_name: products_name,
                    file_type: "colors_image",
                    color_image_id: tmp_new_attr_id,
                  },
                  template: \'<div class="qq-uploader">\' +
                  \'<div class="qq-upload-drop-area"><span>'.$ref->pi_getLL('admin_label_drop_files_here_to_upload').'</span></div>\' +
                  \'<div class="qq-upload-button">'.addslashes(htmlspecialchars($ref->pi_getLL('choose_image'))).'</div>\' +
                  \'<ul class="qq-upload-list"></ul>\' +
                  \'</div>\',
                  onComplete: function(id, fileName, responseJSON){
                    var filenameServer = responseJSON["filename"];
                    var urlColorImage = responseJSON["urlColorImage"];
                    var color_image_id = responseJSON["colorImageId"];
                    $("#ajax_mscolors_test").val(filenameServer);
                    $("#img_color_image_new" + color_image_id).attr("src", urlColorImage);
                    $("#input_color_image_new" + color_image_id).attr("value", urlColorImage);
                  },
                  debug: false
                });

            tmp_new_attr_id = tmp_new_attr_id + 1;
    ';
    return $html;
  }



  function addColorSelectorScript2(&$ref, $attribute_id) {

    $i = 'test';

    $html = '

            var products_name=$("#products_name_0").val();
            // var element = document.getElementById("tx_mscolors_test2");
            // var element2 = $("td.product_attribute_color>div", $("#add_attributes_holder"));
            var uploadertest2 = new qq.FileUploader({
                  element: document.getElementById("color_image_" + '.$attribute_id.'),
                  action: "'.mslib_fe::typolink(',2002', '&tx_multishop_pi1[page_section]=custom_page').'",
                  params: {
                    products_name: products_name,
                    file_type: "colors_image",
                    color_image_id: '.$attribute_id.',
                  },
                  template: \'<div class="qq-uploader">\' +
                  \'<div class="qq-upload-drop-area"><span>'.$ref->pi_getLL('admin_label_drop_files_here_to_upload').'</span></div>\' +
                  \'<div class="qq-upload-button">'.addslashes(htmlspecialchars($ref->pi_getLL('choose_image'))).'</div>\' +
                  \'<ul class="qq-upload-list"></ul>\' +
                  \'</div>\',
                  onComplete: function(id, fileName, responseJSON) {
                    var filenameServer = responseJSON["filename"];
                    var urlColorImage = responseJSON["urlColorImage"];
                    var color_image_id = responseJSON["colorImageId"];
                    $("#ajax_mscolors_test").val(filenameServer);
                    $("#img_color_image_" + color_image_id).attr("src", urlColorImage);
                    $("#input_color_image_" + color_image_id).attr("value", urlColorImage);
                  },
                  debug: false
                });

    ';



    return $html;

  }

}

?>
