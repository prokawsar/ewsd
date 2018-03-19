/**
 * Created by Nahid Islam on 11/8/2017.
 */

$(document).ready(function () {
    $(".postConfirm").hide();
});

$(document).on('click','#submitIdea',function () {
    var idea = $('#posts').val();
    var files = $('input[name=file]').val();
    var user_id= $('#user_id').val();
    var cat_id= $('#category').val();
    var _token= $('input[name=_token]').val();
    var anonym = 0;


    if(document.getElementById('anonym').checked ){
        anonym = 1;
    }

    if(idea=='' || user_id==''){
        $('.validation').text("Write something !!");
    }else {

        $.ajax({
            type: 'post',
            url: '/storeidea',
            data: {
                _token: _token,
                ideas: idea,
                anonym: anonym,
                files: files,
                user_id: user_id,
                cat_id: cat_id
            },
            success: function (response) {
                console.log(response);
                $(".validation").hide();
                $(".postConfirm").show().delay(5000).fadeOut();
                $('.postConfirm').text(response['message']);
                document.getElementById("cform").reset();

                // $('#postsTable').load(location.href + " #postsTable");
            },
            error: function (response) {
                alert(response.message);
            }
        })
    }
});


$(document).on('click','#likeArea, #unlikeArea',function () {
    var ideaid = $(this).data('id');
    var userid = $(this).data('id1');
    var value = $(this).data('value');

    console.log(value);

    $.ajax({
        type: 'post',
        url: '/like',
        data: {
            _token: token,
            idea_id: ideaid,
            user_id: userid,
            value: value
        },
        success: function (response) {
            // console.log(response['message']);
            $('#'+ideaid+'areaDefine').load(location.href+ ' #'+ideaid+'areaDefine');
            // $('#reload'+postid).load(window.location.href + ' #reload'+postid);
        },

        error: function (response) {
            console.log(response['error']);
        }
    });

});



$(document).on('click','#unlikeArea2',function () {
    var ideaid = $(this).data('id');
    var userid = $(this).data('id1');

    $.ajax({
        type: 'post',
        url: '/dislike',
        data: {
            _token:token,
            idea_id: ideaid,
            user_id: userid
        },
        success: function (response) {
            // console.log(response['data']);

            $('#'+ideaid+'areaDefine').load(location.href+ ' #'+ideaid+'areaDefine');
            // $('#reload'+postid).load(window.location.href + ' #reload'+postid);
        },
        error: function (response) {
            console.log(response['data']);
        }
    });

});


function commentButtonClicked(id, user_id){

    var elementId = document.getElementById(id+'comment');
    var comment= elementId.value;
    var anonym = 0;

    if(document.getElementById('anonymComment'+id).checked ){
        anonym = 1;
    }

    if(comment==''){
       alert("Can't make an empty comment !");
    }else{

        $.ajax({
            type:'post',
            url:'/postComment',
            data:{
                _token:token,
                comment:comment,
                anonym: anonym,
                idea_id: id,
                user_id: user_id
            },
            success:function (data) {

            }
        });

        $('#reload'+id).load(window.location.href + ' #reload'+id);

    }
}


$(document).on('click','.delete',function(){
    var id=$(this).data('id');
    $('#delepostInputField').val(id);
});

$(document).on('click','.deletePost',function(){
    // alert($('#delepostInputField').val());
    if($('#delepostInputField').val()!=''){
        $.ajax({
            type:'post',
            url:'deletePost',
            data:{
                _token:token,
                id:$('#delepostInputField').val()
            },
            success:function (response) {
                $('#myModal').modal('hide');
                $('#delConfirm').text("Your this post has been removed !!");
                $('#delConfirm').css('margin-bottom','10px');
                $('#myConfessTable').load(location.href + ' #myConfessTable');
            }

        });
    }

});
