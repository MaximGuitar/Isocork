sprint_editor.registerBlock('my_compound_probkoviy_germetik', function ($, $el, data, settings) {

    settings = settings || {};

    data = $.extend({
        items: [],
        file: {},
    }, data);

    var itemsCollection = {};

    $.each(data.items, function (index, item) {
        var uid = sprint_editor.makeUid();
        itemsCollection[uid] = item;
    });

    this.getData = function () {
        return data;
    };

    this.collectData = function () {
        data.items = [];

        $el.find('.my_compound_probkoviy_germetik__sp-item').each(function () {
            var uid = $(this).data('uid');
            if (uid && itemsCollection[uid]) {
                data.items.push(itemsCollection[uid]);
            }
        });

        return data;
    };

    this.afterRender = function () {



        var $btn = $el.find('.my_compound_probkoviy_germetik__sp-file');
        var $btninput = $btn.find('input[type=file]');
        var $label = $btn.find('strong');

        $btninput.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('files') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                data.file = result.result.file[0];

                $label.text(data.file.ORIGINAL_NAME);

                renderfiles();
            },
            progressall: function (e, result) {
                var progress = parseInt(result.loaded / result.total * 100, 10);
                $label.text('Загрузка: ' + progress + '%');
            }

        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');

        $el.on('click', '.my_compound_probkoviy_germetik__sp-item-del', function (evt) {
            var $image = $(evt.target).closest('.my_compound_probkoviy_germetik__sp-item');
            deletefiles($image.data('uid'));
            $image.remove();
        });


        $el.on('click', '.my_compound_probkoviy_germetik__sp-item-del-file', function () {
            deletefiles();

            data.file = {};

            renderfiles();
        });

        $.each(itemsCollection, function (uid, item) {
            renderitem(uid);
        });


        $el.on('click', '.sp-item-del', function () {
            var $image = $el.find('.sp-x-active');
            $image.remove();
        });

        $el.on('click', '.sp-item-add', function () {
            var uid = sprint_editor.makeUid();

            itemsCollection[uid] = {
                uid: uid,
                file: '',
                text: '',
                title: '',
                button_url: '',
                button_text: ''
            };

            renderitem(uid);
        });

        $el.on('click', '.my_compound_probkoviy_germetik__sp-item', function (evt) {
            var uid = $(this).data('uid');
            openedit(uid, $(this));
        });
    };

    var openedit = function (uid, item=false) {
        if (!itemsCollection[uid]) {
            return;
        }

        var $btn = $el.find('.my_compound_probkoviy_germetik__sp-file');
        var $btninput = $btn.find('input[type=file]');

        if(item) {
            item.find('.my_compound_probkoviy_germetik__sp-title').bindWithDelay('input', function () {
                itemsCollection[uid].title = $(this).val();
            }, 500);
            item.find('.my_compound_probkoviy_germetik__sp-button_text').bindWithDelay('input', function () {
                itemsCollection[uid].button_text = $(this).val();
            }, 500);
            item.find('.my_compound_probkoviy_germetik__sp-button_url').bindWithDelay('input', function () {
                itemsCollection[uid].button_url = $(this).val();
            }, 500);
            

            let area = item.find('.trumbowyg-editor').get(0)

            area.addEventListener("DOMSubtreeModified", function() {
                itemsCollection[uid].text = area.innerHTML;
            });
        }

        $btninput.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('my_compound_probkoviy_germetik') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                itemsCollection[uid].file = result.result.file[0];

                renderitem(uid);
            },
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    };

    var renderitem = function (uid) {
        if (!itemsCollection[uid]) {
            return;
        }

        var item = itemsCollection[uid];
        var $item = $el.find('[data-uid="' + uid + '"]');

        if ($item.length > 0) {
            $item.replaceWith(sprint_editor.renderTemplate('my_compound_probkoviy_germetik-item', {
                item: item,
                uid: uid,
                active: 1
            }));
        } else {
            $el.find('.my_compound_probkoviy_germetik__sp-result').append(sprint_editor.renderTemplate('my_compound_probkoviy_germetik-item', {
                item: item,
                uid: uid,
                active: 0
            }));
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


        $el.find('.sp-text').trumbowyg({
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
        var $btn = $el.find('.my_compound_probkoviy_germetik__sp-file');
        var $label = $btn.find('strong');

        if(data.file.ORIGINAL_NAME) {
            $label.text(data.file.ORIGINAL_NAME);
        } else {
            $label.text('Загрузить');
        }
    };
    var deletefiles = function (uid) {
        if (uid && itemsCollection[uid]) {
            var items = {};
            items[uid] = itemsCollection[uid];

            sprint_editor.markImagesForDelete(items);
        }
    };
});