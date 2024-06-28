<footer class="footer">
	<div class="container">
		<div class="footer__top">
			<svg class='footer__logo'>
				<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#logo'></use>
			</svg>
			<div class="footer__menu-col">
				<nav class="footer__products-menu">
					<? $APPLICATION->IncludeComponent(
						"bitrix:menu",
						"menuFooter",
						array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "submenuBurger",
							"DELAY" => "N",
							"MAX_LEVEL" => "2",
							"MENU_CACHE_GET_VARS" => array(""),
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"ROOT_MENU_TYPE" => "main",
							"USE_EXT" => "N"
						)
					); ?>
				</nav>
				<nav class="footer__general-menu">
					<? $APPLICATION->IncludeComponent(
						"bitrix:menu",
						"menuFooter",
						array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "",
							"DELAY" => "N",
							"MAX_LEVEL" => "1",
							"MENU_CACHE_GET_VARS" => array(""),
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"ROOT_MENU_TYPE" => "footer",
							"USE_EXT" => "N"
						)
					); ?>
				</nav>
			</div>

			<? $phone = $APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"] . '/includes/companyInfo/inc_phone.php');
			$email = $APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"] . '/includes/companyInfo/inc_email.php');
			$vk_link = $APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"] . '/includes/companyInfo/inc_link_vk.php');
			$ozon_link = $APPLICATION->GetFileContent($_SERVER["DOCUMENT_ROOT"] . '/includes/companyInfo/inc_link_ozon.php'); ?>
			<div class="footer__contacts-col">
				<a href="tel:<?= $phone; ?>" class="footer__contact">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/includes/companyInfo/inc_phone.php"
						)
					); ?>
				</a>
				<a href="mailto:<?= $email; ?>" class="footer__contact">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/includes/companyInfo/inc_email.php"
						)
					); ?>
				</a>
				<div class="footer__links">
					<? if ($vk_link): ?>
						<a href="<?= $vk_link; ?>" target="_blank" class="footer__soc-link">
							<svg>
								<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#vk'></use>
							</svg>

							<? if ($APPLICATION->GetShowIncludeAreas()) {
								$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									array(
										"AREA_FILE_SHOW" => "file",
										"AREA_FILE_SUFFIX" => "inc",
										"EDIT_TEMPLATE" => "",
										"PATH" => "/includes/companyInfo/inc_link_vk.php"
									)
								);
							} ?>
						</a>
					<? endif; ?>
					<? if ($ozon_link): ?>
						<a href="<?= $ozon_link; ?>" target="_blank" class="footer__soc-link">
							<svg>
								<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#ozon'></use>
							</svg>
							<? if ($APPLICATION->GetShowIncludeAreas()) {
								$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									array(
										"AREA_FILE_SHOW" => "file",
										"AREA_FILE_SUFFIX" => "inc",
										"EDIT_TEMPLATE" => "",
										"PATH" => "/includes/companyInfo/inc_link_ozon.php"
									)
								);
							} ?>
						</a>
					<? endif; ?>
				</div>
			</div>
		</div>
		<div class="footer__bottom">
			<p class="footer__text">©
				<?= date('Y') ?>
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/includes/companyInfo/inc_name.php"
					)
				); ?>
			</p>
			<a href="/politika-konfidentsialnosti/" class="footer__text footer__link">Политика конфиденциальности</a>
			<a href="/pravila-obrashcheniya-cherez-formu-onlayn-priyemnoy/" class="footer__text footer__link">Правила
				обращения через форму онлайн-приёмной</a>
			<a href="https://place-start.ru/" target="_blank" class="footer__text footer__ps-link">
				Сделано в
				<svg>
					<use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#ps-logo'></use>
				</svg>
			</a>
		</div>
	</div>
	<a href="#top" class="footer__to-top">
		<span class="footer__to-top-text inter">Наверх</span>
	</a>
</footer>

<div class="main-menu" id="main-overlay">
	<div class="main-menu__top">
		<div class="container main-menu__top-container">
			<nav class="main-menu__left-menu">
				<? $APPLICATION->IncludeComponent(
					"bitrix:menu",
					"menuBurgerTop",
					array(
						"ALLOW_MULTI_SELECT" => "N",
						"CHILD_MENU_TYPE" => "submenuBurger",
						"COMPONENT_TEMPLATE" => "horizontal_multilevel",
						"DELAY" => "N",
						"MAX_LEVEL" => "2",
						"MENU_CACHE_GET_VARS" => "",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"ROOT_MENU_TYPE" => "main",
						"USE_EXT" => "N"
					)
				); ?>
			</nav>
			<nav class="main-menu__right-menu">
				<? $APPLICATION->IncludeComponent(
					"bitrix:menu",
					"menuBurgerTopRight",
					array(
						"ALLOW_MULTI_SELECT" => "N",
						"CHILD_MENU_TYPE" => "",
						"DELAY" => "N",
						"MAX_LEVEL" => "1",
						"MENU_CACHE_GET_VARS" => array(0 => "", ),
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"ROOT_MENU_TYPE" => "mainRight",
						"USE_EXT" => "N"
					)
				); ?>
			</nav>
		</div>
	</div>
	<div class="main-menu__footer">
		<div class="container main-menu__footer-container">
			<a href="tel: <?= $phone; ?>" class="main-menu__tel main-menu__contact lora">
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/includes/companyInfo/inc_phone.php"
					)
				); ?>
			</a>
			<a href="mailto: <?= $email; ?>" class="main-menu__contact main-menu__email lora">
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/includes/companyInfo/inc_email.php"
					)
				); ?>
			</a>
			<? $APPLICATION->IncludeComponent(
				"bitrix:menu",
				"menuBurgerBottom",
				array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "",
					"DELAY" => "N",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => array(""),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "mainFooter",
					"USE_EXT" => "N"
				)
			); ?>
		</div>
	</div>
	<!-- <button class="main-menu__btn inter">
		<span>Расчёт стоимости</span>
	</button> -->
</div>

<div class="custom-modal" id="modal-project">
	<div class="custom-modal__wrapper">
		<button class="close-modal close-modal-event" type="button">
			<svg class="close-modal__svg" role="image">
				<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#close-modal"></use>
			</svg>
		</button>
		<div class="custom-modal-body">
			<div class="project-container">
			</div>
		</div>
	</div>
</div>

<div class="custom-modal" id="modal-contact">
	<div class="custom-modal__wrapper--contact">
		<button class="close-modal close-modal-event" type="button">
			<svg class="close-modal__svg" role="image">
				<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#close-modal"></use>
			</svg>
		</button>
		<div class="custom-modal-body">
			<div class="modal-contact__container">
				<div class="modal-contact__head"></div>
				<div class="modal-contact__form-wrap">
					<form action="" class="modal-contact__form" data-form>
						<input type="hidden" name="form-id" value="form-callback-dealer">
						<input type="hidden" name="form-title" value="ООО «Русская пробка»">
						<input type="hidden" name="form-address" value="Пермь">
						<input type="hidden" name="recaptcha-value" value="">

						<div class="modal-contact__form-row">
							<div class="modal-contact__form-row__text">
								<h4 class="modal-contact__form__title">CВЯЗАТЬСЯ С НАМИ</h4>
								<p class="modal-contact__form__text">Укажите свой телефон и наш менеджер свяжется с вами
								</p>
							</div>
							<div class="form-elem modal-contact__form-elem">
								<input type="tel" name="tel" class="form-input" placeholder="Телефон*" value="">
								<p class="form-placeholder">Телефон*</p>
							</div>
						</div>
						<div class="modal-contact__form-row">
							<div class="form-recaptcha" data-recaptcha="1">
								<div class="g-recaptcha" data-sitekey="6LdyPysjAAAAAOIVNzcbxZiG6jOm06jzWhhlpoGH"></div>
							</div>
							<button data-submit-btn="" class="contact-form__btn btn btn--orange btn--inline">
								<svg class="btn__arrow">
									<use href="/local/templates/isocork/static/images/sprite.svg#arrow-to-right"></use>
								</svg>
								Отправить запрос
							</button>
						</div>
						<p class="personal modal-contact__personal">
							Нажимая кнопку, вы соглашаетесь <a href="/obrabotka-personalnykh-dannykh/"
								class="personal__link">на&nbsp;обработку персональных данных</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="custom-modal" id="modal-seo">
	<div class="custom-modal__wrapper--seo">
		<button class="close-modal close-modal-event" type="button">
			<svg class="close-modal__svg" role="image">
				<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#close-modal"></use>
			</svg>
		</button>
		<div class="custom-modal-body modal-seo" modal-container>
			<div class="modal-seo__container">
				<div class="modal-seo__image-wrap">
					<img src="<?= SITE_TEMPLATE_PATH ?>/static/images/cork.jpg" alt="">
				</div>
				<div class="modal-text modal-seo__text">

				</div>
			</div>
		</div>
	</div>
</div>

<div class="custom-modal" id="modal-order_tabs">
	<div class="custom-modal__wrapper--seo">
		<button class="close-modal close-modal-event" type="button">
			<svg class="close-modal__svg" role="image">
				<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#close-modal"></use>
			</svg>
		</button>
		<div class="custom-modal-body modal-order_tabs" modal-container>
			<div class="modal-order_tabs__container">
				<div class="modal-order_tabs__image-wrap">
					<img src="<?= SITE_TEMPLATE_PATH ?>/static/images/cork.jpg" alt="">
				</div>
				<div class="modal-text modal-order_tabs__text">
					<h2>Повышенная теплоизоляция</h2>
					<p>Как может применяться пробка с учетом ее теплоизоляционных свойств?
						Пробка может применяться как утеплитель и отделочный декоративный
						материал одновременно. Такое применение позволяет сэкономить на утеплении.
						Можно просто нанести пробковое напыление на стену и потом покрыть вторым колерованным слоем.
						Если хотите сильно утеплить дом, то можно нанести
						пробковое напыление на утеплитель.</p>
					<p>Почему такой подход выгоднее с финансовой точки зрения?
						Приведем пример. Вы хотите сильно утеплить дом. Для фасада вам нужен
						утеплитель толщиной 150 мм. Он дорогой и плюс вам понадобятся другие
						материалы для монтажа и отделки стен. </p>

					<p>На чем можно сэкономить? Вы можете</p>
					<ul>
						<li>Приобрести утеплитель толщиной 100 мм, что обойдется дешевле</li>
						<li>Оставшиеся 50 мм восполнить напыляемой пробкой</li>
						<li>Напыляемую пробку нанести сразу на утеплитель без его укрепления(без сетки, слоя штукатурки
							и окрашивания). </li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="custom-modal" id="modal-just_text">
	<div class="custom-modal__wrapper--seo">
		<button class="close-modal close-modal-event" type="button">
			<svg class="close-modal__svg" role="image">
				<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#close-modal"></use>
			</svg>
		</button>
		<div class="custom-modal-body modal-just_text" modal-container>
			<div class="modal-just_text__container">


			</div>
		</div>
	</div>
</div>


<div class="custom-modal" id="modal-infoblock">
	<div class="custom-modal__wrapper--seo">
		<button class="close-modal close-modal-event" type="button">
			<svg class="close-modal__svg" role="image">
				<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#close-modal"></use>
			</svg>
		</button>
		<div class="custom-modal-body modal-infoblock" modal-container>
			<div class="modal-infoblock__container">

			</div>
		</div>

	</div>
</div>


<div class="custom-modal" id="modal-feedback">
	<div class="custom-modal__wrapper--feedback">
		<button class="close-modal close-modal-event" type="button">
			<svg class="close-modal__svg" role="image">
				<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#close-modal"></use>
			</svg>
		</button>
		<div class="custom-modal-body">
			<div class="modal-feedback__container">
				<div class="modal-feedback__form-wrap">
					<form action="" class="modal-contact__form" data-form>
						<input type="hidden" name="form-id" value="form-callback">
						<input type="hidden" name="recaptcha-value" value="">
						<div class="modal-feedback__form-row__text">
							<h4 class="modal-feedback__form__title">CВЯЗАТЬСЯ С НАМИ</h4>
							<p class="modal-feedback__form__text inter">Укажите свой телефон и наш менеджер свяжется с
								вами</p>
						</div>
						<div class="form-elem modal-feedback__form-elem">
							<input type="tel" name="tel" class="form-input form-input--black" placeholder="Телефон*"
								value="">
							<p class="form-placeholder form-placeholder--black">Телефон*</p>
						</div>
						<div class="form-recaptcha modal-feedback__recaptcha" data-recaptcha="2">
							<div class="g-recaptcha" data-sitekey="6LdyPysjAAAAAOIVNzcbxZiG6jOm06jzWhhlpoGH"></div>
						</div>
						<button data-submit-btn=""
							class="contact-form__btn modal-feedback__btn btn btn--filled btn--inline">
							<svg class="btn__arrow">
								<use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right"></use>
							</svg>
							Отправить запрос
						</button>
						<p class="personal modal-feedback__personal">
							Нажимая кнопку, вы соглашаетесь <a href="/obrabotka-personalnykh-dannykh/"
								class="personal__link">на&nbsp;обработку персональных данных</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://www.google.com/recaptcha/api.js" defer></script>
</body>

</html>