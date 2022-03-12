"use strict";
(function (Timer) {
    Timer.update()
    setInterval(function () {
        Timer.update()
    }, 1000)
})({
    normalize: function (date) {
        const offset = 3600000 * 7 // GMT+7
        const utc = date.getTime() + date.getTimezoneOffset() * 60000 // normalize GMT+0
        return new Date(utc + offset)
    },
    getTime: function () {
        let time = new Date()
        $.ajax({
            'url': `${BASE_URL}/time`,
            'dataType': 'json',
            'contentType': 'application/json; charset=utf-8',
            'async': false,
        }).done(function (response) {
            time = new Date(response.time)
        })
        return time
    },
    max: 60,
    count: 0,
    current: new Date(),
    toString: function () {
        const weekday = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Des'],
            lnth = ['st', 'nd', 'rd', 'th'],
            date = this.normalize(this.current),
            d = date.getDate(),
            nth = (d > 3 && d < 21 || d > 23) ? lnth[3] : lnth[Math.max(d % 10, 3)],
            y = date.getFullYear(),
            h = date.getHours(),
            m = date.getMinutes(),
            s = date.getSeconds(),
            // tZ = date.toString().match(/([A-Z]+[\+-][0-9]+)/)[1],
            strDate = `${month[date.getMonth()]} ${('0' + d).slice(-2)}${nth} ${y}`,
            strTime = `${('0' + h).slice(-2)}:${('0' + m).slice(-2)}:${('0' + s).slice(-2)}`
        return `${weekday[date.getDay()]}, ${strDate} ${strTime} GMT`
    },
    request: function () {
        this.current = new Date(this.current.setSeconds(this.current.getSeconds() + 1))
        if (this.count === 0) {
            this.current = this.getTime()
        }
        this.count = (this.count + 1) % this.max
    },
    update: function () {
        this.request()
        $('#time').text(this.toString())
    },
})
