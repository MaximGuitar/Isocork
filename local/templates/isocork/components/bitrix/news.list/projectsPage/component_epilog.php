<?
/**
 * @var CMain $APPLICATION
 * @var array $arResult
 */
  
// callback function
$replacer = function ($matches) use ($APPLICATION) {
  ob_start();
  // тут вставляем разменту, вызовы компонентов, в общем все что нужно вывести
  // в метке #INNER_BLOCK_123# мы можем передать в качестве числа например код инфоблока
  // и использовать его так :
  $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "template.php",  
        Array(
            "COMPONENT_TEMPLATE" => "template.php",
            "PATH" => "",
            "SITE_ID" => "s1",
            "START_FROM" => "0"
        )
    );
    
  return ob_get_clean();
};

// находим метку и заменяем ее на результат работы нашей функции
echo preg_replace_callback(
  "/#INNER_BLOCK#/",
  $replacer,
  $arResult["CACHED_TPL"]
);