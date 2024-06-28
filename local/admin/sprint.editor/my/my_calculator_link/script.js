sprint_editor.registerBlock('my_calculator_link', function ($, $el, data, settings) {
    settings = settings || {};
    data = $.extend({
        title: '',
        title1: '',
        textbtn: '',
        calclink: '',
        questionlink: '',
        file: {},
    }, data);

    this.afterRender = function () {
        renderfiles();

        var $btn = $el.find('.sp-file');
        var $btninput = $btn.find('input[type=file]');
        var $label = $btn.find('strong');
        var labeltext = $label.text();

        $btninput.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('my_calculator_link') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                deletefiles();

                $.each(result.result.file, function (index, file) {
                    data.file = file;
                });

                renderfiles();
            },
            progressall: function (e, result) {
                var progress = parseInt(result.loaded / result.total * 100, 10);

                $label.text('Загрузка: ' + progress + '%');

                if (progress >= 100) {
                    $label.text(labeltext);
                }
            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');

        $el.on('click', '.sp-item-del', function () {
            deletefiles();
            data.file = {};
            renderfiles();
        });

        if (!$.fn.trumbowyg) {
            return false;
        }

        var btns = [];
        var cssList = {};
        var plugins = {};

        if (settings.csslist && settings.csslist.value) {
            cssList = settings.csslist.value;

            plugins = {
                mycss: {
                    cssList: cssList
                }
            };

            btns = [
                ['viewHTML'],
                ['formatting'],
                ['myCss'],
                ['strong', 'em', 'underline', 'del'],
                ['link','specialChars'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['removeformat']
            ];

        } else {
            btns = [
                ['viewHTML'],
                ['formatting'],
                ['strong', 'em', 'underline', 'del'],
                ['link','specialChars'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['removeformat']
            ]
        }


        $el.find('.sp-text1').trumbowyg({
            svgPath: '/bitrix/admin/sprint.editor/assets/trumbowyg/ui/icons.svg',
            lang: 'ru',
            resetCss: true,
            removeformatPasted: true,
            autogrow: true,
            btns: btns,
            plugins: plugins
        });
        $el.find('.sp-text2').trumbowyg({
            svgPath: '/bitrix/admin/sprint.editor/assets/trumbowyg/ui/icons.svg',
            lang: 'ru',
            resetCss: true,
            removeformatPasted: true,
            autogrow: true,
            btns: btns,
            plugins: plugins
        });
    };

    var renderfiles = function () {
        $el.find('.sp-result').html(
            sprint_editor.renderTemplate('my_calculator_link-image', data)
        );
    };

    var deletefiles = function () {
        var uid = sprint_editor.makeUid();
        var items = {};
        items[uid] = {
            file: data.file
        };

        sprint_editor.markImagesForDelete(items);
    };

    this.getData = function () {
        return data;
    };

    this.collectData = function () {
        data.title = $el.find('.sp-title').val();
        data.title1 = $el.find('.sp-title1').val();
        data.textbtn = $el.find('.sp-text-btn').val();
        data.calclink = $el.find('.sp-calc-link').val();
        data.questionlink = $el.find('.sp-question-link').val();
        data.value1 = $el.find('.sp-text1').val();
        data.value2 = $el.find('.sp-text2').val();
        return data;
    };
});