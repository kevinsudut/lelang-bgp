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
                <div class="text-center text-white my-2">This bid has bid finished!</div>
            </div>
        `)
        .parent().addClass('disabled')
    })

})()
