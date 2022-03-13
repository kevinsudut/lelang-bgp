$.message = function (status, content) {
    var el = $('#message')
    el.find('div #message-content').text(content)
    el.addClass(status)
    el.show("fast", function () {
        setTimeout(function () {
            el.find('div #message-content').text('')
            el.hide("fast", function () {
                el.removeClass(status)
            })
        }, 2500)
    })
}

$(document).on('click', '#message-close', function () {
    $('#message').hide()
})
