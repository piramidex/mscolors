      <?php


      class tx_mscolors_customajaxpage {

        function customAjaxPage(&$params, &$ref) {

          error_log("customAjaxPage hook");
          //error_log("products path: ".$ref->ms['image_paths']['products']['original']);
          //$ref->ms['image_paths']['colors']['original'] = 'uploads/tx_multishop/images/products/original';
          //error_log("colors path: ".$ref->ms['image_paths']['colors']['original']);

          // TODO: this config should go somewhere else
          $this->mscolors['icon_format']['width'] = 20;
          $this->mscolors['icon_format']['height'] = 20;
          $this->mscolors['image_paths']['colors']['root'] = 'uploads/tx_mscolors/';
          $this->mscolors['image_paths']['colors']['dir_images'] = 'uploads/tx_mscolors/images';  
          $this->mscolors['image_paths']['colors']['dir_colors'] = 'uploads/tx_mscolors/images/colors';  
          $this->mscolors['image_paths']['colors']['original'] = 'uploads/tx_mscolors/images/colors/original';  
          $this->mscolors['image_paths']['colors']['icon'] = 'uploads/tx_mscolors/images/colors/icon';  
          foreach($this->mscolors['image_paths']['colors'] as $path) {
            error_log('path: '.$ref->DOCUMENT_ROOT.$path);
            if (!is_dir($ref->DOCUMENT_ROOT.$path)) {
              t3lib_div::mkdir($ref->DOCUMENT_ROOT.$path);
            }
          }


          if ($ref->ADMIN_USER) {
            if (isset($_SERVER["CONTENT_LENGTH"])) {


              if ($ref->get['file_type'] == 'colors_image') {
      //        switch ($ref->get['file_type']) {
      //          case 'colors_image':
      //          for ($x=0; $x<$ref->ms['MODULES']['NUMBER_OF_PRODUCT_IMAGES']; $x++) {
      //              // hidden filename that is retrieved from the ajax upload
      //            $i=$x;
      //            if ($i==0) {
      //              $i='';
      //            }
      //            $field='products_image'.$i;
      //            if ($ref->get['file_type']==$field) {


              if (!is_dir($ref->DOCUMENT_ROOT.'uploads/tx_mscolors/tmp')) {
                t3lib_div::mkdir($ref->DOCUMENT_ROOT.'uploads/tx_mscolors/tmp');
              }

              $temp_file=$ref->DOCUMENT_ROOT.'uploads/tx_mscolors/tmp/'.uniqid();
              if (isset($_FILES['qqfile'])) {
                move_uploaded_file($_FILES['qqfile']['tmp_name'], $temp_file);
              } else {
                $input=fopen("php://input", "r");

                $debug_file = fopen("/Applications/XAMPP/xamppfiles/htdocs/typo3/typo3temp/debug.txt", "w");
                fwrite($debug_file, sys_get_temp_dir());
                fclose($debug_file);

                $temp=tmpfile();
                $realSize=stream_copy_to_stream($input, $temp);
                fclose($input);
                $target=fopen($temp_file, "w");
                fseek($temp, 0, SEEK_SET);
                stream_copy_to_stream($temp, $target);
                fclose($target);
              }
              error_log("temp file created");

              $size=getimagesize($temp_file);
              if ($size[0]>5 and $size[1]>5) {
                error_log("size ok");
                $imgtype=mslib_befe::exif_imagetype($temp_file);
                if ($imgtype) {
                  error_log("type ok");
                          // valid image
                  $ext=image_type_to_extension($imgtype, false);
                  if ($ext) {
                    error_log("ext ok");
                    $i=0;
                    $filename=mslib_fe::rewritenamein($ref->get['products_name']).'.'.$ext;
                    $folder=mslib_befe::getImagePrefixFolder($filename);
                    $array=explode(".", $filename);
                    if (!is_dir($ref->DOCUMENT_ROOT.$this->mscolors['image_paths']['colors']['original'].'/'.$folder)) {
                      t3lib_div::mkdir($ref->DOCUMENT_ROOT.$this->mscolors['image_paths']['colors']['original'].'/'.$folder);
                    }

                    error_log("mkdir ok");

                    $folder.='/';
                    $target=$ref->DOCUMENT_ROOT.$this->mscolors['image_paths']['colors']['original'].'/'.$folder.$filename;
                    if (file_exists($target)) {
                      error_log("file exists ok");

                      do {
                        $filename=mslib_fe::rewritenamein($ref->get['products_name']).($i>0 ? '-'.$i : '').'.'.$ext;
                        $folder_name=mslib_befe::getImagePrefixFolder($filename);
                        $array=explode(".", $filename);
                        $folder=$folder_name;
                        if (!is_dir($ref->DOCUMENT_ROOT.$this->mscolors['image_paths']['colors']['original'].'/'.$folder)) {
                          t3lib_div::mkdir($ref->DOCUMENT_ROOT.$this->mscolors['image_paths']['colors']['original'].'/'.$folder);
                        }
                        $folder.='/';
                        $target=$ref->DOCUMENT_ROOT.$this->mscolors['image_paths']['colors']['original'].'/'.$folder.$filename;
                        $i++;
                      } while (file_exists($target));
                    }

                    error_log("before copy file ok");

                    if (copy($temp_file, $target)) {
                      $filename=$this->resizeProductImage($target, $filename, $ref->DOCUMENT_ROOT.t3lib_extMgm::siteRelPath($ref->extKey), 1, $ref);
                      $result=array();
                      $result['success']=true;
                      $result['error']=false;
                      $result['filename']=$filename;
                      echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                      exit();
                    }
                  }
                }
              }

            }
          }
      //          }
      //          break;
      //        }
      //      }
        }
      //    exit();
      //    break;

      }

        public function resizeProductImage($original_path, $filename, $module_path, $run_in_background=0, $ref) {

          if (!$GLOBALS['TYPO3_CONF_VARS']['GFX']['jpg_quality']) {
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['jpg_quality']=75;
          }

          if ($filename) {

            // TODO: add preProcHook?

            if ($run_in_background) {
              $suffix_exec_param=' &> /dev/null & ';
            }

            $commands=array();
            $params='';
            if ($GLOBALS['TYPO3_CONF_VARS']['GFX']['im_version_5']=='im6') {
              $params.='-strip';
            }

            $folder=mslib_befe::getImagePrefixFolder($filename);
            foreach(array('icon') as $size) {

              $dir = PATH_site.$this->mscolors['image_paths']['colors'][$size].'/'.$folder;
              if (!is_dir($dir)) { t3lib_div::mkdir($dir); }
              $target=PATH_site.$this->mscolors['image_paths']['colors'][$size].'/'.$folder.'/'.$filename;
              copy($original_path, $target);

              $maxwidth = $this->mscolors['icon_format']['width'];
              $maxheight = $this->mscolors['icon_format']['height'];
              $commands[]=t3lib_div::imageMagickCommand('convert', $params.' -quality '.$GLOBALS['TYPO3_CONF_VARS']['GFX']['jpg_quality'].' -resize "'.$maxwidth.'x'.$maxheight.'>" "'.$target.'" "'.$target.'"', $GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path_lzw']);

              if ($ref->ms['MODULES']['PRODUCT_IMAGE_SHAPED_CORNERS'] && (in_array($size, array('300', '200')))) {
                $gravities = array('NorthWest' => 'lb', 'NorthEast' => 'rb', 'SouthWest' => 'lo', 'SouthEast' => 'ro');
                foreach($gravities as $key => $value) {
                  $commands[]=$GLOBALS['TYPO3_CONF_VARS']['GFX']["im_path"].'composite -gravity '.$key.' '.$module_path.'templates/images/curves/'.$value.'.png "'.$target.'" "'.$target.'"';
                }
              }
            }

            // TODO: add watermark processing ?

            if (count($commands)) {
              foreach ($commands as $command) {
                exec($command);
              }
            }

            // TODO: add postProcHook ?

            return $filename;
          }
        }




      }


      ?>
