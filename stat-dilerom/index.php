<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Стать дилером");
?>
      
<?$APPLICATION->IncludeComponent(
	"placestart:text.page",
	"textPage",
	Array(
		"ELEMENT_ID" => "65",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "content"
	)
);?>
 <div class="container">
        <!--<h2 class="section-title no-uppercase">
            <?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "/includes/inc_contact_title.php"
				)
			);?> 
        </h2>-->
        <div class="contact-text-wrap">
            <div class="modal-text">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/includes/inc_contact_left_text.php"
                    )
                );?> 
            </div>
            <div class="modal-text">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/includes/inc_contact_right_text.php"
                    )
                );?> 
            </div>
        </div>
        
    </div>
</div>

        <form action="" class="contact-form" data-form="">
            <input type="hidden" name="form-id" value="form-dealer"> 
            <input type="hidden" name="form-title" value="Стать дилером">    
            <input type="hidden" name="recaptcha-value" value="">
            <div class="form-elem contact-form__form-elem">
                <input type="text" name="name" class="form-input form-input--black" placeholder="Имя*">
                <p class="form-placeholder form-placeholder--black">Имя*</p>
            </div>
            <div class="form-elem contact-form__form-elem">
                <input type="text" name="lastname" class="form-input form-input--black" placeholder="Фамилия">
                <p class="form-placeholder form-placeholder--black">Фамилия</p>
            </div>
            <div class="form-elem contact-form__form-elem">
                <input type="text" name="middlename" class="form-input form-input--black" placeholder="Отчество">
                <p class="form-placeholder form-placeholder--black">Отчество</p>
            </div>
            <div class="form-elem contact-form__form-elem">
                <input type="tel" name="tel" class="form-input form-input--black" placeholder="Телефон*">
                <p class="form-placeholder form-placeholder--black">Телефон*</p>
            </div>
            <div class="form-elem contact-form__form-elem">
                <input type="email" name="email" class="form-input form-input--black" placeholder="Email*">
                <p class="form-placeholder form-placeholder--black">Email*</p>
            </div>
            <div class="form-elem contact-form__form-elem">
                <input type="text" name="company" class="form-input form-input--black" placeholder="Организация">
                <p class="form-placeholder form-placeholder--black">Организация</p>
            </div>
            <div class="form-elem form-textarea contact-form__form-elem contact-form__form-elem--full">
                <textarea name="message" cols="30" rows="6" maxlength="400" class="form-input form-input--textarea form-input--black" placeholder="Сообщение"></textarea>
                <p class="form-placeholder form-placeholder--textarea form-placeholder--black">Сообщение</p>
            </div>
            <label class="form-elem contact-form__form-file contact-form__form-elem--full" for="file-uploader">
                <input type="file" name="file" id="file-uploader" accept=".jpeg, .png, .pdf, .docx, .pptx">
                <div class="file-information">
                    <p class="file-title">Прикрепить файл</p>
                    <p class="file-text">Макс. допустимый размер файла: 3072kb. Типы файлов: jpeg, png, pdf, docx, pptx</p>
                </div>
            </label>
            <div class="contact-form__recaptcha">
                <div class="form-recaptcha">
                    <div class="g-recaptcha" data-sitekey="6LdyPysjAAAAAOIVNzcbxZiG6jOm06jzWhhlpoGH"></div>
                </div>
            </div>
            <div class="contact-form__personal-wrap"><input name="pers" id="pers" type="radio" value="yes"><label for="pers">Я прочитал и принимаю <a href="/pravila-obrashcheniya-cherez-formu-onlayn-priyemnoy/" class="personal__link">Правила обращения через форму онлайн-приёмной</a></label></div>
            <div class="contact-form__btn-wrap">
                <button data-submit-btn="" class="contact-form__btn btn btn--filled btn--inline">
                    <svg class="btn__arrow">
                        <use href="<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-to-right"></use>
                    </svg>
                    Отправить обращение
                </button>
                <p class="personal personal--dark contact-form__personal">
                    Нажимая кнопку, вы соглашаетесь <a href="/obrabotka-personalnykh-dannykh/" class="personal__link">на&nbsp;обработку персональных данных</a>
                </p>
            </div>
            
        </form><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>