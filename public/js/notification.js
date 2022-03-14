(function (Notification) {
    $(document).ready(function () {
        Notification.hide()
        Notification.show()
    })
})({
    hide: function () {
        $(document).on('click', function (e) {
            if (e.target.closest('#notif-button') == null && e.target.closest(
                '#notif-container') == null) {
                $('#notif-container').css({
                    display: "none"
                })
            }
        })
    },
    show: function () {
        $('#notif-button').on('click', function () {
            $('#notif-container').css({
                display: ($('#notif-container').css("display") === "block" ?
                    "none" : "block")
            })
        })
    }
})
