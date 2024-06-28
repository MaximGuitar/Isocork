sprint_editor.registerBlock('my_texture', function ($, $el, data, settings) {
    settings = settings || {};

    data = $.extend({
        title: '',
        items: [],
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
        data.title = $el.find('.sp-title').val();

        data.items = [];

        $el.find('.my_texture__sp-item').each(function () {
            var uid = $(this).data('uid');
            if (uid && itemsCollection[uid]) {
                data.items.push(itemsCollection[uid]);
            }

        });

        return data;
    };

    this.afterRender = function () {
        
        $el.on('click', '.my_texture__sp-item-del', function (evt) {
            var $image = $(evt.target).closest('.my_texture__sp-item');
            deletefiles($image.data('uid'));
            $image.remove();
        });

        $.each(itemsCollection, function (uid, item) {
            renderitem(uid);
        });

        $el.on('click', '.sp-item-add', function () {
            var uid = sprint_editor.makeUid();

            itemsCollection[uid] = {
                file: '',
                name: '',
                modalImage: '',
                modalText: ''
            };

            renderitem(uid);
        });

        $el.on('click', '.my_texture__sp-item', function (evt) {
            var uid = $(this).data('uid');
            openedit(uid, $(this));
        });
    };

    var openedit = function (uid, item=false) {
        if (!itemsCollection[uid]) {
            return;
        }

        var $btn = $el.find('.my_texture__sp-file');
        var $btninput = $btn.find('input[type=file]');
        var $label = $btn.find('strong');
        var $text = $label.text();

        if(item) {
            item.find('.my_texture__sp-item-title').bindWithDelay('input', function () {
                itemsCollection[uid].name = $(this).val();
            }, 500);

            let area = item.find('.trumbowyg-editor').get(0)

            area.addEventListener("DOMSubtreeModified", function() {
                itemsCollection[uid].modalText = area.innerHTML;
            });
        }

        $btninput.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('my_texture') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                itemsCollection[uid].file = result.result.file[0];

                renderitem(uid);
            },
            progressall: function (e, result) {
                var progress = parseInt(result.loaded / result.total * 100, 10);
                $label.text('Загрузка: ' + progress + '%');

                if (progress >= 100) {
                    $label.text('Загрузить фото');
                }
            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');

        var $btnModal = $el.find('.my_texture__sp-item-modal-file');
        var $btninputModal = $btnModal.find('input[type=file]');
        var $labelModal = $btn.find('strong');

        $btninputModal.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('my_texture') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                itemsCollection[uid].modalImage = result.result.file[0];

                renderitem(uid);
            },
            progressall: function (e, result) {
                var progress = parseInt(result.loaded / result.total * 100, 10);
                $labelModal.text('Загрузка: ' + progress + '%');

                if (progress >= 100) {
                    $labelModal.text('Загрузить фото');
                }
            }
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
            $item.replaceWith(sprint_editor.renderTemplate('my_texture-item', {
                item: item,
                uid: uid,
                active: 1
            }));
        } else {
            $el.find('.my_texture__sp-result').append(sprint_editor.renderTemplate('my_texture-item', {
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

    var deletefiles = function (uid) {
        if (uid && itemsCollection[uid]) {
            var items = {};
            items[uid] = itemsCollection[uid];

            sprint_editor.markImagesForDelete(items);
        }
    };
});