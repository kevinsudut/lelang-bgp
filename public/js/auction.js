(function() {
    $('#form-bidding').on('submit', function(e) {
        e.preventDefault()

        const id = $(this).find("input[type='hidden']").val()
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
})()
