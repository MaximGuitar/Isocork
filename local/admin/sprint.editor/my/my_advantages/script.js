sprint_editor.registerBlock('my_advantages', function ($, $el, data, settings) {

    settings = settings || {};

    data = $.extend({
        titleDescription: '',
        file: {},
        filepdf: {},
        title: '',
        word: '',
        endtext: '',
        items: []
    }, data);

    var itemsCollection = {};

    var areas = [
        {
            dataKey: 'text',
            blockName: 'text',
            container: '.sp-text-description'
        },
    ];

    $.each(data.items, function (index, item) {
        var uid = sprint_editor.makeUid();
        itemsCollection[uid] = item;
    });

    this.getData = function () {
        return data;
    };

    this.collectData = function () {
        data.desc = $el.find('.sp-text-description').val();
        data.word = $el.find('.my_advantages__sp-word-bg').val();
        data.endtext = $el.find('.my_advantages__sp-endtext').val();
        data.title = $el.find('.my_advantages__sp-title').val();
        data.titleDescription = $el.find('.sp-title').val();

        data.items = [];

        $el.find('.my_advantages__sp-item').each(function () {
            var uid = $(this).data('uid');
            if (uid && itemsCollection[uid]) {
                data.items.push(itemsCollection[uid]);
            }
        });

        return data;
    };

    this.afterRender = function () {
        renderfiles();








        var $btn = $el.find('.sp-file');
        var $btninput = $btn.find('input[type=file]');
        var $label = $btn.find('strong');
        var labeltext = $label.text();

        $btninput.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('my_advantages') + '/upload.php',
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


        var $pdfbutton = $el.find('.my_advantages__sp-filepdf');
        var $btninputpdf = $pdfbutton.find('input[type=file]');
        var $labelpdf = $pdfbutton.find('strong');

        $btninputpdf.fileupload({
            url: sprint_editor.getBlockWebPath('files') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                data.filepdf = result.result.file[0];

                $labelpdf.text(data.filepdf.ORIGINAL_NAME);

                renderfiles();
            },
            progressall: function (e, result) {
                var progress = parseInt(result.loaded / result.total * 100, 10);
                $labelpdf.text('Загрузка: ' + progress + '%');
            }

        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');




        $el.on('click', '.sp-item-del', function () {
            deletefiles();

            data.file = {};
            data.filepdf = {};

            renderfiles();
        });

        $el.on('click', '.my_advantages__sp-item-del', function (evt) {
            var $image = $(evt.target).closest('.my_advantages__sp-item');;
            deletefiles($image.data('uid'));
            $image.remove();
        });

        $.each(itemsCollection, function (uid, item) {
            renderitem(uid);
        });


        $el.on('click', '.sp-item-del', function () {
            var $image = $el.find('.sp-x-active');
            deletefiles($image.data('uid'));
            $image.remove();
        });

        $el.on('click', '.sp-item-add', function () {
            var uid = sprint_editor.makeUid();

            itemsCollection[uid] = {
                file: '',
                desc: '',
                modalImage: '',
                modalText: '',
                hoverText: ''
            };

            renderitem(uid);

        });

        $el.on('click', '.my_advantages__sp-item', function () {
            var uid = $(this).data('uid');
            openedit(uid, $(this));
        });

        var removeIntent = false;
        // $el.find('.my_advantages__sp-result').sortable({
        //     items: ".my_advantages__sp-item",
        //     placeholder: "sp-placeholder",
        //     over: function () {
        //         removeIntent = false;
        //     },
        //     out: function () {
        //         removeIntent = true;
        //     },
        //     beforeStop: function (event, ui) {
        //         if (removeIntent) {
        //             deletefiles(ui.item.data('uid'));
        //             ui.item.remove();
        //         } else {
        //             ui.item.removeAttr('style');
        //         }
        //     }
        // });

    };

    var renderfiles = function () {
        $el.find('.sp-result').html(
            sprint_editor.renderTemplate('my_advantages-image', data)
        );
    };

    var deletefiles = function () {
        var uid = sprint_editor.makeUid();
        var items = {};
        items[uid] = {
            file: data.file,

        };

        sprint_editor.markImagesForDelete(items);
    };

    this.beforeDelete = function () {
        deletefiles();
    }

    var openedit = function (uid, item = false) {
        if (!itemsCollection[uid]) {
            return;
        }

        var $btn = $el.find('.my_advantages__sp-file');
        var $btninput = $btn.find('input[type=file]');

        if (item) {
            item.find('.my_advantages__sp-item-desc').bindWithDelay('input', function () {
                itemsCollection[uid].desc = $(this).val();
            }, 500);

            let area = item.find('.trumbowyg-editor').get(0)

            area.addEventListener("DOMSubtreeModified", function () {
                itemsCollection[uid].modalText = area.innerHTML;
            });

            let area1 = item.find('.trumbowyg-editor').get(1)
            area1.addEventListener("DOMSubtreeModified", function () {
                itemsCollection[uid].hoverText = area1.innerHTML;
            });
        }

        $btninput.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('my_advantages') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                itemsCollection[uid].file = result.result.file[0];

                renderitem(uid);
            },
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');

        var $btnModal = $el.find('.my_advantages__sp-item-modal-file');
        var $btninputModal = $btnModal.find('input[type=file]');
        var $labelModal = $btn.find('strong');

        $btninputModal.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('my_advantages') + '/upload.php',
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
            $item.replaceWith(sprint_editor.renderTemplate('my_advantages-item', {
                item: item,
                uid: uid,
                active: 1
            }));

        } else {
            $el.find('.my_advantages__sp-result').append(sprint_editor.renderTemplate('my_advantages-item', {
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
                ['link', 'specialChars'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['removeformat']
            ];

        } else {
            btns = [
                ['viewHTML'],
                ['formatting'],
                ['strong', 'em', 'underline', 'del'],
                ['link', 'specialChars'],
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
        $el.find('.sp-text-hover').trumbowyg({
            svgPath: '/bitrix/admin/sprint.editor/assets/trumbowyg/ui/icons.svg',
            lang: 'ru',
            resetCss: true,
            removeformatPasted: true,
            autogrow: true,
            btns: btns,
            plugins: plugins
        });
    };

    this.getAreas = function () {
        return areas;
    };
});