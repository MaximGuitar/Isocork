sprint_editor.registerBlock('my_economic_benefit', function ($, $el, data) {
    data = $.extend({
        title: '',
        subtitle: '',
        summ100: '',
        pogonnie_metry: '',
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
        data.subtitle = $el.find('.sp-subtitle').val();
        data.summ100 = $el.find('.sp-summ_100').val();
        data.pogonnie_metry = $el.find('.sp-pogonnie_metry').val();
        data.items = [];

        $el.find('.my_economic_benefit__sp-item').each(function () {
            var uid = $(this).data('uid');
            if (uid && itemsCollection[uid]) {
                data.items.push(itemsCollection[uid]);
            }
        });

        return data;
    };

    this.afterRender = function () {
        $el.on('click', '.my_economic_benefit__sp-item-del', function (evt) {
            var $image = $(evt.target).closest('.my_economic_benefit__sp-item');
            deletefiles($image.data('uid'));
            $image.remove();
        });

        $.each(itemsCollection, function (uid, item) {
            renderitem(uid);
        });

        $el.on('click', '.sp-item-add', function () {
            var uid = sprint_editor.makeUid();

            itemsCollection[uid] = {
                equipmentName: '',
                priceMaterial: '',
                priceWork: '',
            };

            renderitem(uid);
        });

        $el.on('click', '.my_economic_benefit__sp-item', function (evt) {
            var uid = $(this).data('uid');
            openedit(uid, $(this));
        });
    };

    var openedit = function (uid, item=false) {
        if (!itemsCollection[uid]) {
            return;
        }

        var $btn = $el.find('.my_economic_benefit__sp-file');
        var $btninput = $btn.find('input[type=file]');

        if(item) {
            item.find('.my_economic_benefit__sp-item-title').bindWithDelay('input', function () {
                itemsCollection[uid].MaterialName = $(this).val();
            }, 500);
            item.find('.my_economic_benefit__sp-item-material').bindWithDelay('input', function () {
                itemsCollection[uid].priceMaterial = $(this).val();
            }, 500);
            item.find('.my_economic_benefit__sp-item-work').bindWithDelay('input', function () {
                itemsCollection[uid].priceWork = $(this).val();
            }, 500);
         
            
        }

        $btninput.fileupload({
            dropZone: $el,
            url: sprint_editor.getBlockWebPath('my_economic_benefit') + '/upload.php',
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
            $item.replaceWith(sprint_editor.renderTemplate('my_economic_benefit-item', {
                item: item,
                uid: uid,
                active: 1
            }));
        } else {
            $el.find('.my_economic_benefit__sp-result').append(sprint_editor.renderTemplate('my_economic_benefit-item', {
                item: item,
                uid: uid,
                active: 0
            }));
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