(function ($) {

    var widgetName = 'widgetChatMessages';
    var settings = {};
    var methods = {
        init: function (options) {
            return this.each(function () {
                // Создаём настройки по-умолчанию, расширяя их с помощью параметров, которые были переданы
                settings = $.extend(settings, options);

                var $messages = $('#messages-block');

                $(".js-submit-message-form").on("pjax:success", function (e) {
                    $.pjax.reload({
                        container: '#messages-block',
                        async: true
                    });
                });
                $messages.on("pjax:success", function (e) {
                    methods.afterUpdateList()
                });
                methods.afterUpdateList()
            });
        },
        afterUpdateList: function(){
            var $messages = $('#messages-block');
            var $wrap = $messages.parent();
            $wrap.scrollTop($messages.height());

        },
        destroy: function () {
            return this.each(function () {
                // your code
            })
        }
    };

    $.fn[widgetName] = function (method) {

        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Метод с именем ' + method + ' не существует для jQuery.' + widgetName);
        }

    };

})(jQuery);