import Chat from '/js/Chat.js';
const chat = new Chat();

var chatInputValue = "";

function getQuestionCorrect(input){
    chat.showLoadingAnimation();
    setTimeout(function() {
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: '/getQuestionCorrect',
            data: {
                input : input,
            },
            dataType: 'json',
            success: function(xhr){
                chat.hideLoadingAnimation();
                chat.AI(xhr);
            },
            error: function(xhr){
                chat.hideLoadingAnimation();
                toastr.error(xhr.responseJSON);
            }
        })
    },500);
}

$(document).ready(function() {
    document.getElementById("chatInput").onkeydown = function(event) {
        if (event.keyCode === 13) {
            chatInputValue = document.getElementById("chatInput").value;
            if (chatInputValue !== ""){
                chat.user(chatInputValue);
                getQuestionCorrect(chatInputValue);
                document.getElementById("chatInput").value = "";
            }
        }
      };
});
