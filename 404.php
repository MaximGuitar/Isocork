<?

include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");
?>

<div class="page page-404">
    <div class="container">
        <div id="breadcrumbs">
            <ul class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                <li itemscope="" itemtype="http://schema.org/ListItem">
                    <a href="/">Главная</a>
                    <meta itemprop="position" content="1">
                    —
                </li>
                <li itemscope="" itemtype="http://schema.org/ListItem">
                    <span itemprop="name">404</span>
                    <meta itemprop="position" content="2">
                </li>
            </ul>
        </div>
        <div class="page-404__text">
            <h1 class="page-404__title">упс...</h1>
            <div class="page-404__text-wrap content-text">
                Страница не найдена. Возможно она удалена, перемещена или никогда не существовала — проверьте правильность написания адреса или перейдите <a href="/">на главную</a>
            </div>
        </div>
        <div class="page-404__image-wrap">
            <img src="<?=SITE_TEMPLATE_PATH;?>/static/images/image-404.png" alt="404" class="page-404__image">
        </div>
        
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>