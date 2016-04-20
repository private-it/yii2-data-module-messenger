$(function () {
    $('#messenger-form').on('pjax:success', function () {
        var container = '#' + $('#messenger-messages').find('[data-pjax-container]').attr('id');
        $.pjax.reload(container)
    });
});