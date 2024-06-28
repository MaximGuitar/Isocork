sprint_editor.registerBlock('my_form_simple', function ($, $el, data) {

    data = $.extend({
        title: '',
        text: '',
    }, data);

    this.getData = function () {
        return data;
    };

    this.collectData = function () {
        data.title = $el.find('.sp-title').val();
        data.text = $el.find('.sp-text').val();
        return data;
    };
});