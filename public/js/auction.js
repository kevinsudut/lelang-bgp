(function() {
    $('#form-bidding').on('submit', function(e) {
        e.preventDefault()

        const id = $(this).find("input:hidden[name=id]").val()
        const amount = $(this).find('#amount')

        axios.post(`${BASE_URL}/product/bid/bidding`, {
            id: id,
            amount: amount.val(),
        })
        .then(function(response) {
            let css = 'bg-danger'
            if (response.data.success) {
                css = 'bg-success'
                amount.val('')

                $('#no-bidding').remove()
                $('#leaderboard').html(`
                    <div class="fw-bold mb-2">Current Bid: ${response.data.leaderboard.amount} | ${response.data.leaderboard.user}</div>
                    <div class="fw-bold mb-2">Total Participant: ${response.data.leaderboard.count_participant}</div>
                    <div class="mb-2">
                        <button class="btn btn-sm btn-primary" id="btn-leaderboard">View Leaderboard</button>
                    </div>
                `)
            }
            $.message(css, response.data.message)
        })
        .catch(function(error) {
            if (error.response) {
                $.message('bg-danger', error.response.data.message)
            } else {
                $.message('bg-danger', error.message)
            }

            amount.val('')
        })
    })

    $('#btn-read-more').on('click', function() {
        $('#dots').toggle()
        $('#more').toggle()

        if ($('#dots').css('display') == 'none') {
            $(this).html('Read less')
        } else {
            $(this).html('Read more')
        }
    })

    $('#clock').countdown(END_TIME).on('update.countdown', function(event) {
        var format = '%H:%M:%S'
        if(event.offset.totalDays > 0) {
            format = ' %-d day%!d ' + format
        }

        if(event.offset.weeks > 0) {
            format = ' %-w week%!w ' + format
        }

        format = 'Time left: ' + format
        $(this).html(event.strftime(format))
    })
    .on('finish.countdown', function(event) {
        $(this).html(`
            <div class="bg-success mt-3 p-1">
                <div class="text-center text-white my-2">This bid has been finished!</div>
            </div>
        `)
        .parent().addClass('disabled')

        Notification.requestPermission().then(function (permission) {
            if (permission == 'granted') {
                const notification = new Notification('Lelang BGP Notification!', {
                    body: 'Sorry, the bid has been finished.',
                    badge: `${BASE_URL}/assets/icon144.png`,
                    icon: `${BASE_URL}/assets/icon144.png`,
                })

                const audio = new Audio(`${BASE_URL}/sounds/alarm.mp3`)
                audio.volume = 1
                audio.play()

                notification.addEventListener('click', function () {
                    notification.close()
                })
            }
        })
    })

    $('#leaderboardList').on('show.bs.modal', function (e) {
        let el = $(this).find('#leaderboard-body').find('tbody')

        axios.post(`${BASE_URL}/product/bid/leaderboard/list`, {
            id: PRODUCT_ID,
        })
        .then(function(response) {
            if (response.data) {
                el.empty()
                $.each(response.data, function(key, value) {
                    console.log(el)
                    el.append(`
                        <tr>
                            <td>${value.rank}</td>
                            <td>${value.amount}</td>
                            <td>${value.user}</td>
                        </tr>
                    `)
                })
            }
        })
        .catch(function(error) {
            if (error.response) {
                $.message('bg-danger', error.response.data.message)
            } else {
                $.message('bg-danger', error.message)
            }
        })
    })

    setInterval(function() {
        axios.post(`${BASE_URL}/product/bid/leaderboard`, {
            id: PRODUCT_ID,
        })
        .then(function(response) {
            if (response.data) {
                if (response.data.amount != undefined && response.data.user != undefined && response.data.count_participant != undefined) {
                    $('#no-bidding').remove()
                    $('#leaderboard').html(`
                        <div class="fw-bold mb-2">Current Bid: ${response.data.amount} | ${response.data.user}</div>
                        <div class="fw-bold mb-2">Total Participant: ${response.data.count_participant}</div>
                        <div class="mb-2">
                            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#leaderboardList">View Leaderboard</button>
                        </div>
                    `)
                }
            }
            // <button class="btn btn-sm btn-primary" id="btn-leaderboard"></button>
        })
        .catch(function(error) {
            if (error.response) {
                $.message('bg-danger', error.response.data.message)
            } else {
                $.message('bg-danger', error.message)
            }
        })
    }, 1000)


})()
