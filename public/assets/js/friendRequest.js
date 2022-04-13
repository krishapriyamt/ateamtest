$(function () {

$('.addfriend').on('click',function(){

    var id = $(this).attr('data-val');
    var status = 0;
    $.ajax({
        type:'POST',
        url:'/user/request_send',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{friend_id : id, status : status
        },
        success: function( msg ) {

            if(msg == 'success'){
                window.location.reload();
            }
            
        }
    });


});
$('.acceptfriend').on('click',function(){

    var id = $(this).attr('data-val');
    var status = 1;
    $.ajax({
        type:'POST',
        url:'/user/accept_request',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{id : id, status : status
        },
        success: function( msg ) {

            if(msg == 'success'){
                window.location.reload();
            }
            
        }
    });


});

});