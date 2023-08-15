import Chat from '/js/Chat.js';
const chat = new Chat();

var lastQuestion = null;
var currentLanguage = 1;
var level = 1;
var message;
var chatInputValue = "";

function getQuestion(selectedEnglish,question,answer){
    $.ajax({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "POST",
        url: '/getQuestion',
        data: {
            selectedEnglish : selectedEnglish,
            question : question,
            answer : answer
        },
        dataType: 'json',
        success: function(xhr){
            lastQuestion = xhr['word'];
            message = xhr['message'] + xhr['word'];
            chat.AI(message);
        },
        error: function(xhr){
            console.log("HIIIBAAA");
            toastr.error(xhr.responseJSON);
        }
    })
}

function AIHelp(){
    chat.showLoadingAnimation();
    setTimeout(function() {
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: '/AIHelp',
            data: {
                lastQuestion : lastQuestion,
                level : level
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

function updateContainerContent() {
    var containerElement = document.getElementById('container');
    containerElement.innerHTML = '';
}

const button = document.getElementById("changeButton");
const buttonText = document.getElementById("buttonText");

$(document).ready(function() {
    document.getElementById("chatInput").onkeydown = function(event) {
        if (event.keyCode === 13) {
            chatInputValue = document.getElementById("chatInput").value;
            if (chatInputValue !== ""){
                chat.user(chatInputValue);
                getQuestion(currentLanguage,lastQuestion,chatInputValue);
                document.getElementById("chatInput").value = "";
            }
        }
      };

      button.addEventListener("click", function () {
        if (currentLanguage === 1) {
            buttonText.innerHTML = "<i>Válts angol kérdésekre</i>";
            currentLanguage = 0;
            updateContainerContent();
            getQuestion(currentLanguage,lastQuestion,"");
        } else {
            buttonText.innerHTML = "<i>Válts magyar kérdésekre</i>";
            currentLanguage = 1;
            updateContainerContent();
            getQuestion(currentLanguage,lastQuestion,"");
        }
    });

    document.getElementById("AIHelp").addEventListener("click", () => {
        AIHelp();
    });

    getQuestion(1,"","");
});




