$(function () {
    var container = '#' + $('#messenger-messages').find('[data-pjax-container]').attr('id');
    $('#messenger-form').on('pjax:success', function () {
        $.pjax.reload(container);
    });
    setInterval(function(){
        $.pjax.reload(container);
    }, 1000);
});