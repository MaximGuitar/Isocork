<?php
  namespace Placestart;

  use Bitrix\Main\Config\Option;
  use \Bitrix\Main\Loader;

  Loader::includeModule('iblock');

  Class Utils{
    public static function getSiteOption($option_name, $site_id = SITE_ID){
      if (!$option_name)
        return false;

      $result = Option::get('placestart.settings', $option_name."_$site_id");

      return $result ? $result : false;
    }

    public static function getContacts($site_id = SITE_ID){
      return [
        'additional_tel' => Utils::getSiteOption('site_additional_tel', $site_id),
        'tel' => Utils::getSiteOption('site_tel', $site_id),
        'email' => Utils::getSiteOption('site_email', $site_id),
        'address' => Utils::getSiteOption('site_address', $site_id),
        'vk' => Utils::getSiteOption('site_vk', $site_id),
        'youtube' => Utils::getSiteOption('site_yt', $site_id),
        'twitter' => Utils::getSiteOption('site_twitter', $site_id),
      ];
    }

    public static function wrapGroup($wrap, $string){
      $pattern = '/#(.*?)#/i';
	    return preg_replace($pattern, $wrap, $string);
    }

    public static function parseYoutubeID($video_link){
      $matches = [];

      // https://www.youtube.com/watch?v=oixYsnsZuog&feature=emb_imp_woyt
      $pattern = '/\?v=([[:alnum:]\-\_]*).*/i';
      preg_match($pattern, $video_link, $matches);
      if (isset($matches[1])) return $matches[1];

      // https://www.youtube.com/embed/oixYsnsZuog?start=1
      $pattern = '/embed\/(.+)\?/i';
      preg_match($pattern, $video_link, $matches);
      if (isset($matches[1])) return $matches[1];

      // https://youtu.be/oixYsnsZuog
      $pattern = '/youtu\.be\/(.+)/i';
      preg_match($pattern, $video_link, $matches);
      if (isset($matches[1])) return $matches[1];

      return false;
    }

    public static function getYoutubeIframeSrc($video_link){
      $id = Utils::parseYoutubeID($video_link);
	    return 'https://www.youtube.com/embed/'.$id;
    }

    public static function getYoutubeIframePreview($video_link){
      $id = Utils::parseYoutubeID($video_link);
      return [
        'LARGE' => "https://i.ytimg.com/vi/$id/maxresdefault.jpg",
        'SMALL' => "https://i.ytimg.com/vi/$id/hqdefault.jpg"
      ];
    }

    public static function getFileInfo($content_type, $size){
      $mime_types = array(
        'application/msword'            => 'doc',
        'image/jpeg'                    => 'jpg',
        'application/pdf'               => 'pdf',
        'image/png'                     => 'png',
        'application/vnd.ms-powerpoint' => 'ppt',
        'application/x-rar-compressed'  => 'rar',
        'image/tiff'                    => 'tiff',
        'text/plain'                    => 'txt',
        'application/vnd.ms-excel'      => 'xls',
        'application/zip'               => 'zip',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'   => 'docx',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'         => 'xlsx',
      );
  
      $file_size = [ 'b', 'kb', 'Mb' ];
      $file_info_output = [];
      $file_info_output[ 'size' ] = $size;
  
      $file_info_output[ 'mime' ] = $mime_types[ $content_type ];
  
      $i = 0;
      while( $file_info_output[ 'size' ] > 1024 ) {
        $file_info_output[ 'size' ] = $file_info_output[ 'size' ] / 1024;
        $i++;
      }
      $file_info_output[ 'size' ] = round($file_info_output[ 'size' ], 2) . " " . $file_size[$i]; // Размер файла
  
      return $file_info_output;
    }

    public static function ShowNavChain($template = '.default'){
      global $APPLICATION;
      $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        $template,
        Array(
          "PATH" => "",
          "SITE_ID" => "s1",
          "START_FROM" => "0"
        )
      );
    }

    public static function clearElementProps($arProps){
      $props = [];
      foreach($arProps as $key => $data){
        $props[$key] = $data['VALUE'];
      }

      return $props;
    }

    /**
     * Получает информацию о файле по его ID в системе битрикса
     * @param $ID
     * @return array
    */
    public static function getFileByID($ID){
      $arFile = \CFile::GetFileArray($ID);
      $info = self::getFileInfo($arFile['CONTENT_TYPE'], $arFile['FILE_SIZE']);

      return [
        'SRC' => $arFile['SRC'],
        'FILE_NAME' => $arFile['FILE_NAME'],
        'ORIGINAL_NAME' => $arFile['ORIGINAL_NAME'],
        'SIZE' => $info['size'],
        'MIME' => $info['mime']
      ];
    }

    /**
     * Получает картинку анонса элемента по его ID
     * @param $ID
     * @return array
    */
    public static function getElemPreview($ID, $width, $height, $type = 'exact', $quality = 95){
      $img = '';
      $res = \CIBlockElement::GetByID($ID);
      $elem = $res->GetNext();

      if ($elem['PREVIEW_PICTURE']){
        $img = self::resizeImage($elem['PREVIEW_PICTURE'], $width, $height, $type, $quality);
      }

      return $img;
    }

    public static function resizeImage($ID, $width, $height, $type = 'exact', $quality = 95){
      $types = [
        'exact' => BX_RESIZE_IMAGE_EXACT,
        'proportional' => BX_RESIZE_IMAGE_PROPORTIONAL,
        'alt' => BX_RESIZE_IMAGE_PROPORTIONAL_ALT
      ];

      $image = \CFile::ResizeImageGet(
        \CFile::GetFileArray($ID),
        [
          'width' => $width,
          'height' => $height
        ],
        $types[$type],
        true,
        false,
        false,
        $quality
      );
      
      return $image;
    }

    /**
     * Разбивает число по разрядам
     * @param $number_str
     * @return string
    */
    public static function formatNumber($number_str){
      return preg_replace('/(\d)(?=(\d{3})+([^\d]|$))/i', '$1 ', $number_str);
    }

    /**
     * Разбивает название свойства на части по символу вертикального слеша
     * @param $name
     * @return array
    */
    public static function parsePropertyName($name){
      $parts = explode("|", $name);
      if (count($parts) < 2)
        return false;
      
      $parsed_parts = [
        'number' => trim($parts[0]),
        'name' => trim($parts[1]),
        'code' => trim($parts[2]),
        'unit' => trim($parts[3]),
      ];
      
      return $parsed_parts;
    }

    /**
     * Получает список инфоблоков и типов
     * @param $type
     * @return array
    */
    public static function getIblocksList($type = ""){
      $arTypes = \CIBlockParameters::GetIBlockTypes();

      $arIBlocks = [];
      $db_iblock = \CIBlock::GetList(
        ["SORT"=>"ASC"],
        [
          "SITE_ID" => $_REQUEST["site"],
          "TYPE" => $type
        ]
      );
      while($arRes = $db_iblock->Fetch())
        $arIBlocks[$arRes["ID"]] = "[".$arRes["ID"]."] ".$arRes["NAME"];

      return [
        'types' => $arTypes,
        'iblocks' => $arIBlocks
      ];
    }
  }
?>