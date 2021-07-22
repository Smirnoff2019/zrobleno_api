jQuery.get('api/v1/post/', {
    data: {
        id: 1
    }
})
    .done(function(res) {
        console.log('res', res)
    })
    .fail(function(res) {
        console.log('res', res)
    })
