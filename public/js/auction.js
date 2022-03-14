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
})()

var myFunc = function(){
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Read more";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Read less";
        moreText.style.display = "inline";
    }
}

$('#clock').countdown($('input[name=endtime]').val())
.on('update.countdown', function(event) {
  var format = '%H:%M:%S';
  if(event.offset.totalDays > 0) {
    format = 'Time left: %-d day%!d ' + format;
  }
  if(event.offset.weeks > 0) {
    format = 'Time left: %-w week%!w ' + format;
  }
  $(this).html(event.strftime(format));
})
.on('finish.countdown', function(event) {
  $(this).html('This offer has expired!')
    .parent().addClass('disabled');

});
