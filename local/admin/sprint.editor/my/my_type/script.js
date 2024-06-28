sprint_editor.registerBlock('my_type', function ($, $el, data, settings) {

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

        $el.find('.my_type__sp-item').each(function () {
            var uid = $(this).data('uid');
            if (uid && itemsCollection[uid]) {
                data.items.push(itemsCollection[uid]);
            }

        });

        return data;
    };

    this.afterRender = function () {

        $el.on('click', '.my_type__sp-item-del', function (evt) {
            var $image = $(evt.target).closest('.my_type__sp-item');
            deletefiles($image.data('uid'));
            $image.remove();

            disabledButton();
        });

        $.each(itemsCollection, function (uid, item) {
            renderitem(uid);
        });


        $el.on('click', '.sp-item-del', function () {
            var $image = $el.find('.sp-x-active');
            $image.remove();

            disabledButton();
        });

        $el.on('click', '.sp-item-add', function () {
            var uid = sprint_editor.makeUid();

            itemsCollection[uid] = {
                uid: uid,
                file: '',
                fileIcon: '',
                desc: '',
                text: ''
            };

            renderitem(uid);
        });

        $el.on('click', '.my_type__sp-item', function (evt) {
            var uid = $(this).data('uid');
            openedit(uid, $(this));
        });
    };

    var openedit = function (uid, item=false) {
        if (!itemsCollection[uid]) {
            return;
        }

        var $btn = $el.find('.my_type__sp-file');
        var $btninput = $btn.find('input[type=file]');

        if(item) {
            item.find('.my_type__sp-item-desc').bindWithDelay('input', function () {
                itemsCollection[uid].desc = $(this).val();
            }, 500);

            let area = item.find('.trumbowyg-editor').get(0)

            area.addEventListener("DOMSubtreeModified", function() {
                itemsCollection[uid].text = area.innerHTML;
            });
        }

        $btninput.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('my_type') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                itemsCollection[uid].file = result.result.file[0];

                renderitem(uid);
            },
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');

        var $btnIcon = $el.find('.my_type__sp-file-icon');
        var $btninputIcon = $btnIcon.find('input[type=file]');

        $btninputIcon.fileupload({
            url: sprint_editor.getBlockWebPath('my_type') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                itemsCollection[uid].fileIcon = result.result.file[0];

                renderitem(uid);
            },
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    };

    var disabledButton = function() {
        if($el.find('.my_type__sp-item').length >= 3) {
            $el.find('.sp-item-add').addClass('disabled');
        } else {
            $el.find('.sp-item-add').removeClass('disabled');
        }
    }

    var renderitem = function (uid) {
        if (!itemsCollection[uid]) {
            return;
        }

        var item = itemsCollection[uid];
        var $item = $el.find('[data-uid="' + uid + '"]');

        if ($item.length > 0) {
            $item.replaceWith(sprint_editor.renderTemplate('my_type-item', {
                item: item,
                uid: uid,
                active: 1
            }));
        } else {
            $el.find('.my_type__sp-result').append(sprint_editor.renderTemplate('my_type-item', {
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

        disabledButton();
        
    };

    var deletefiles = function (uid) {
        if (uid && itemsCollection[uid]) {
            var items = {};
            items[uid] = itemsCollection[uid];

            sprint_editor.markImagesForDelete(items);
        }
    };

    // this.getAreas = function(){
    //     return areas;
    // };
});