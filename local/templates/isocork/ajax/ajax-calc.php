<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
$inputJSON = file_get_contents('php://input');
if($inputJSON !== null):
    $result = json_decode($inputJSON, TRUE);
    
    $type = $result["type"];
    $result = [];
    if($type == 'napylyaemaya' || $type == 'shtukaturka'):
        $result['code'] = '
            <div class="calculate-form__filters">
                <p class="calculate-form__filters-title font-22">Вид работ:</p>
                <div class="form-select" data-dropdown>
                    <div class="form-select-header" data-dropdown-header>
                        <input type="hidden" name="select-work" class="form-select-header__selected" value="Фасад" data-dropdown-input data-calc="fasad">
                        <p class="form-select-header__option font-22" data-dropdown-option>Фасад</p>
                        <svg class="contact-region__svg">
                            <use href="/local/templates/isocork/static/images/sprite.svg#arrow-down"></use>
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
                        <svg class="contact-region__svg">
                            <use href="/local/templates/isocork/static/images/sprite.svg#arrow-down"></use>
                        </svg>
                    </div>

                    <div class="form-select-dropdown" data-dropdown-list>
                        <a href="#" class="form-select-dropdown__option font-22" data-calc="wall" data-select="По одной стене" data-dropdown-item data-dropdown-item-local>По одной стене</a>
                        <a href="#" class="form-select-dropdown__option font-22" data-calc="house" data-select="Всей комнаты/дома" data-dropdown-item data-dropdown-item-local>Всей комнаты/дома</a>
                    </div>
                </div>
            </div>';

            if($type == 'napylyaemaya') {
                $result['note'] = 'Внимание оконные и дверные
                    проемы при расчете площади покрываемой поверхности не вычитаются! Трубы и
                    проходящие коммуникации по конструкции в расчете не участвуют! Проверяйте
                    вводимые размеры.';
            } else {
                $result['note'] = 'Кратность упаковки 7кг и 2кг. Внимание оконные и
                дверные проемы при расчете площади покрываемой поверхности не вычитаются!
                Трубы и проходящие коммуникации по конструкции в расчете не участвуют!
                Проверяйте вводимые размеры.';
            }

            $result['unit'] = 'кг';
    ?>
    <? elseif($type == 'germetik'):
        $result['code'] = '
            <div class="calculate-form__filters">
                <p class="calculate-form__filters-title font-22">Тип:</p>
                <div class="form-select" data-dropdown>
                    <div class="form-select-header" data-dropdown-header>
                        <input type="hidden" name="select-architecture" class="form-select-header__selected" value="Колбаса 500мл." data-dropdown-input data-calc="sausage">
                        <p class="form-select-header__option font-22" data-dropdown-option>Колбаса 500мл.</p>
                        <svg class="contact-region__svg">
                            <use href="/local/templates/isocork/static/images/sprite.svg#arrow-down"></use>
                        </svg>
                    </div>

                    <div class="form-select-dropdown" data-dropdown-list>
                        <a href="#" class="form-select-dropdown__option font-22" data-calc="sausage" data-select="Колбаса 500мл." data-dropdown-item data-dropdown-item-architecture>Колбаса 500мл.</a>
                        <a href="#" class="form-select-dropdown__option font-22" data-calc="cartouche" data-select="Картуш 310мл." data-dropdown-item data-dropdown-item-architecture>Картуш 310мл.</a>
                    </div>
                </div>
            </div>
            <div class="calculate-form__filters">
                <p class="calculate-form__filters-title font-22">Ширина шва:</p>
                <div class="form-select" data-dropdown>
                    <div class="form-select-header" data-dropdown-header>
                        <input type="hidden" name="select-seam" class="form-select-header__selected" value="10мм" data-dropdown-input data-calc="10">
                        <p class="form-select-header__option font-22" data-dropdown-option>10мм</p>
                        <svg class="contact-region__svg">
                            <use href="/local/templates/isocork/static/images/sprite.svg#arrow-down"></use>
                        </svg>
                    </div>

                    <div class="form-select-dropdown" data-dropdown-list>
                        <a href="#" class="form-select-dropdown__option font-22" data-calc="10" data-select="10мм" data-dropdown-item data-dropdown-item-weight>10мм</a>
                        <a href="#" class="form-select-dropdown__option font-22" data-calc="20" data-select="20мм" data-dropdown-item data-dropdown-item-weight>20мм</a>
                    </div>
                </div>
            </div>
            <div class="calculate-form__filters">
                <p class="calculate-form__filters-title font-22">Локация:</p>
                <div class="form-select" data-dropdown>
                    <div class="form-select-header" data-dropdown-header>
                        <input type="hidden" name="select-local" class="form-select-header__selected" value="По одной стене" data-dropdown-input data-calc="wall">
                        <p class="form-select-header__option font-22" data-dropdown-option>По одной стене</p>
                        <svg class="contact-region__svg">
                            <use href="/local/templates/isocork/static/images/sprite.svg#arrow-down"></use>
                        </svg>
                    </div>

                    <div class="form-select-dropdown" data-dropdown-list data-dropdown-architecture>
                        <a href="#" class="form-select-dropdown__option font-22" data-calc="wall" data-select="По одной стене" data-formula="sausage" data-dropdown-item data-dropdown-item-local>По одной стене</a>
                        <a href="#" class="form-select-dropdown__option font-22" data-calc="house" data-select="Всей комнаты/дома" data-formula="sausage" data-dropdown-item data-dropdown-item-local>Всей комнаты/дома</a>
                        <a href="#" class="form-select-dropdown__option font-22 hidden" data-calc="joint" data-select="Стыка/шва/соединения" data-formula="cartouche" data-dropdown-item data-dropdown-item-local>Стыка/шва/соединения</a>
                    </div>
                </div>
            </div>';

        $result['note'] = 'Внимание оконные и
            дверные проемы при расчете площади покрываемой поверхности не вычитаются!
            Трубы и проходящие коммуникации по конструкции в расчете не участвуют!
            Проверяйте вводимые размеры.'; 

        $result['unit'] = 'шт.колб.';
        ?>
    <?endif;?>

    <?
        $result = json_encode($result);
        echo $result;
    ?>
<?endif;?>