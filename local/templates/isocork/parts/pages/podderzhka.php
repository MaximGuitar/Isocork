<div class="page page--100">
    <div class="page-with-sidebar">
        <div class="page-sidebar">
            <div class="page-sidebar__wrap">
                <div id="breadcrumbs" class="breadcrumbs--white">
                    <?
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
                    ?>
                </div>
                <ul class="sidebar-list">
                </ul>
            </div>
        </div>
        <div class="page-content--sidebar">
            <div class="page-content__container">
                <?
                    CModule::IncludeModule('iblock');
                    $arFilter = Array("IBLOCK_ID"=>2, "ID"=>45);
                    $res = CIBlockElement::GetList(Array(), $arFilter);
                    if ($ob = $res->GetNextElement()){;
                        $arProps = $ob->GetProperties();
                        $arFields = $ob->GetFields();
                    } 
                ?>

                <?if($arFields['NAME']):?>
                    <h1 class="section-title--87 m-40"><?=$arFields['NAME'];?></h1>
                <?else:?>
                    <h1 class="section-title--87 m-40">Поддержка</h1>
                <?endif;?>
                <?if($arProps['PAGE_DESCRIPTION']['VALUE']['TEXT']):?>
                    <div class="modal-text page-description"><p><?=htmlspecialcharsBack($arProps['PAGE_DESCRIPTION']['VALUE']['TEXT']);?></p></div>
                <?endif;?>

                <section class="section-calculate">
                    <h2 class="section-title--87 m-38">Калькулятор</h2>
                    <?if($arProps['PAGE_CALC_TEXT']['VALUE']['TEXT']):?>
                        <div class="modal-text section-subtitle"><p><?=htmlspecialcharsBack($arProps['PAGE_CALC_TEXT']['VALUE']['TEXT']);?></p></div>
                    <?endif;?>

                    <div class="calculate-form">
                        <form action="" class="" data-form>
                            <input type="hidden" name="form-id" value="form-calc">
                            <input type="hidden" name="form-title" value="Калькулятор">
                            <input type="hidden" name="recaptcha-value" value="">
                            <input type="hidden" name="form-result" value="Итого: 0 кг">
                            <div class="calculate-form__row">
                                <div class="calculate-form__filters-select" data-calc-wrap>
                                    <?
                                        $arFilter = Array("IBLOCK_ID"=>1,'ACTIVE' => 'Y');
                                        $resFirst = CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount" => 1));
                                        $name = $resFirst->GetNext()['NAME'];
                                    ?>
                                    <div class="calculate-form__filters" data-visible>
                                        <p class="calculate-form__filters-title font-22">Тип продукции:</p>
                                        <div class="form-select" data-dropdown>
                                            <div class="form-select-header" data-dropdown-header>
                                                <input type="hidden" name="select-type" class="form-select-header__selected" value="Напыляемая пробка" data-dropdown-input data-calc="napylyaemaya" data-calc-type>
                                                <p class="form-select-header__option font-22" data-dropdown-option>Напыляемая пробка</p>
                                                <svg class='contact-region__svg'>
                                                    <use href='<?= SITE_TEMPLATE_PATH ?>/static/images/sprite.svg#arrow-down'></use>
                                                </svg>
                                            </div>
                        
                                            <div class="form-select-dropdown" data-dropdown-list>
                                                <a href="#" class="form-select-dropdown__option font-22" data-calc="napylyaemaya" data-select="Напыляемая пробка" data-dropdown-item data-dropdown-item-type>Напыляемая пробка</a>
                                                <a href="#" class="form-select-dropdown__option font-22" data-calc="shtukaturka" data-select="Пробковая штукатурка" data-dropdown-item data-dropdown-item-type>Пробковая штукатурка</a>
                                                <a href="#" class="form-select-dropdown__option font-22" data-calc="germetik" data-select="Пробковый герметик" data-dropdown-item data-dropdown-item-type>Пробковый герметик</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="calculate-form__filters">
                                        <p class="calculate-form__filters-title font-22">Вид работ:</p>
                                        <div class="form-select" data-dropdown>
                                            <div class="form-select-header" data-dropdown-header>
                                                <input type="hidden" name="select-work" class="form-select-header__selected" value="Фасад" data-dropdown-input data-calc="fasad">
                                                <p class="form-select-header__option font-22" data-dropdown-option>Фасад</p>
                                                <svg class='contact-region__svg'>
                                                    <use href='/local/templates/isocork/static/images/sprite.svg#arrow-down'></use>
                                                </svg>
                                            </div>
                                            <div class="form-select-dropdown" data-dropdown-list>
                                                <a href="#" class="form-select-dropdown__option font-22" data-calc="fasad" data-select="Фасад" data-dropdown-item data-dropdown-item-architecture>Фасад</a>
                                                <a href="#" class="form-select-dropdown__option font-22" data-calc="interior" data-select="Интерьер" data-dropdown-item data-dropdown-item-architecture>Интерьер</a>
                                                <a href="#" class="form-select-dropdown__option font-22" data-calc="ceil" data-select="Потолок" data-dropdown-item data-dropdown-item-architecture>Потолок</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="calculate-form__filters">
                                        <p class="calculate-form__filters-title font-22">Локация:</p> 
                                        <div class="form-select" data-dropdown>
                                            <div class="form-select-header" data-dropdown-header>
                                                <input type="hidden" name="select-local" class="form-select-header__selected" value="По одной стене" data-dropdown-input data-calc="wall">
                                                <p class="form-select-header__option font-22" data-dropdown-option>По одной стене</p>
                                                <svg class='contact-region__svg'>
                                                    <use href='/local/templates/isocork/static/images/sprite.svg#arrow-down'></use>
                                                </svg>
                                            </div>

                                            <div class="form-select-dropdown" data-dropdown-list>
                                                <a href="#" class="form-select-dropdown__option font-22" data-calc="wall" data-select="По одной стене" data-dropdown-item data-dropdown-item-local>По одной стене</a>
                                                <a href="#" class="form-select-dropdown__option font-22" data-calc="house" data-select="Всей комнаты/дома" data-dropdown-item data-dropdown-item-local>Всей комнаты/дома</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="calculate-form__row">
                                <p class="calculate-form__filters-title font-22">Размеры строения:</p>
                                <div class="calculate-form__params">
                                    <div class="calculate-form__params-item">
                                        <p class="font-22">Высота, м</p>
                                        <input type="number" name="height" class="form-number" placeholder="0" />
                                    </div>
                                    <div class="calculate-form__params-item">
                                        <p class="font-22">Длина, м</p>
                                        <input type="number" name="lenght" class="form-number" placeholder="0" />
                                    </div>
                                    <div class="calculate-form__params-item">
                                        <p class="font-22">Ширина, м</p>
                                        <input type="number" name="weight" class="form-number" placeholder="0" />
                                    </div>
                                    <div class="calculate-form__params-item hidden">
                                        <p class="font-22">Диаметр бревна, м</p>
                                        <input type="number" name="diameter" class="form-number" placeholder="0" />
                                    </div>
                                </div>
                            </div>
                            <div class="calculate-form__notes modal-text"><p>*Примечание: <span class="calculate-form__notes-text">Кратность упаковки 12кг. Внимание оконные и дверные проемы при расчете площади покрываемой поверхности не вычитаются! Трубы и
проходящие коммуникации по конструкции в расчете не участвуют! Проверяйте вводимые размеры.</span></p></div>
                            <div class="calculate-form__feedback-wrap">
                                <div class="calculate-form__result">Итого: <span class="calculate-form__result-num">0</span> <span class="calculate-form__result-unit">кг</span></div>
                                <div class="calculate-form__feedback">
                                    <div class="form-elem contact-form__form-elem grid-area--name">
                                        <input type="text" name="name" class="form-input form-input--black" placeholder="Имя*">
                                        <p class="form-placeholder form-placeholder--black">Имя*</p>
                                    </div>
                                    <div class="form-elem contact-form__form-elem grid-area--phone">
                                        <input type="tel" name="tel" class="form-input form-input--black" placeholder="Телефон*">
                                        <p class="form-placeholder form-placeholder--black">Телефон*</p>
                                    </div>
                                    <div class="form-elem contact-form__form-elem grid-area--mail">
                                        <input type="email" name="email" class="form-input form-input--black" placeholder="Email*">
                                        <p class="form-placeholder form-placeholder--black">Email*</p>
                                    </div>
                                    <div class="form-radio grid-area--type">
                                        <label class="form-radio__item">
                                            <input name="type" type="radio" value="Физическое лицо" checked="">
                                            <span class="form-radio__title">Физическое лицо</span>
                                        </label>
                                        <label class="form-radio__item">
                                            <input name="type" type="radio" value="Юридическое лицо">
                                            <span class="form-radio__title">Юридическое лицо</span>
                                        </label>
                                    </div>
                                    <p class="personal personal--dark calculate-form__personal grid-area--personal personal--desktop">
                                        Нажимая кнопку, вы соглашаетесь <a href="/obrabotka-personalnykh-dannykh/" class="personal__link">на&nbsp;обработку персональных данных</a>
                                    </p>
                                    <div class="calculate-form__btn-wrap grid-area--btn">
                                        <button data-submit-btn="" class="calculate-form__btn btn btn--filled btn--inline">
                                            <svg class="btn__arrow">
                                                <use href="/local/templates/isocork/static/images/sprite.svg#arrow-to-right"></use>
                                            </svg>
                                            Отправить запрос
                                        </button>
                                        <p class="personal personal--dark calculate-form__personal personal--mobile">
                                            Нажимая кнопку, вы соглашаетесь <a href="/obrabotka-personalnykh-dannykh/" class="personal__link">на&nbsp;обработку персональных данных</a>
                                        </p>
                                        <div class="form-recaptcha">
                                            <div class="g-recaptcha" data-sitekey="6LdyPysjAAAAAOIVNzcbxZiG6jOm06jzWhhlpoGH"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                <div class="content">
                    <?$content = $APPLICATION->IncludeComponent(
                        "sprint.editor:blocks",
                        "custom",
                        Array(
                            "ELEMENT_ID" => 45,
                            "IBLOCK_ID" => 2,
                            "PROPERTY_CODE" => "CONTENT",
                        ),
                        $component,
                        Array(
                            "HIDE_ICONS" => "Y"
                        )
                    );
                    ?>
                </div>

                <section class="section-reception">
                    <h2 class="section-title--87 m-40">Онлайн-приёмная руководителя</h2>
                    <?if($arProps['PAGE_RECEPTION_TEXT']['VALUE']['TEXT']):?>
                        <div class="modal-text section-subtitle"><p><?=htmlspecialcharsBack($arProps['PAGE_RECEPTION_TEXT']['VALUE']['TEXT']);?></p></div>
                    <?endif;?>
                    <form action="" class="contact-form" data-form="">
                        <input type="hidden" name="form-id" value="form-dealer"> 
                        <input type="hidden" name="form-title" value="Онлайн-приёмная руководителя">    
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
                        
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>