import Chat from '/js/Chat.js';
const chat = new Chat();

var dictionaryName = document.getElementById('dictionaryName').getAttribute('data-name');
var lastQuestion = null;
var currentLanguage = 1;
var level = 1;
var message;

function sendDictionaryTable(dictionaryName,selectedEnglish,question,answer){
    $.ajax({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "POST",
        url: '/sendDictionaryName',
        data: {
            dictionaryName : dictionaryName,
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
            toastr.error(xhr.responseJSON);
        }
    })
}

function updateContainerContent(dictionaryName) {
    var containerElement = document.getElementById('container');
    containerElement.innerHTML = `
        <div id="dictionaryName" data-name="${dictionaryName}"></div>`;
}

function AIHelp(){
    chat.showLoadingAnimation();
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
}


const button = document.getElementById("changeButton");
const buttonText = document.getElementById("buttonText");

button.addEventListener("click", function () {
    if (currentLanguage === 1) {
        buttonText.innerHTML = "<i>Válts angol kérdésekre</i>";
        currentLanguage = 0;
        updateContainerContent(dictionaryName);
        sendDictionaryTable(dictionaryName,currentLanguage,lastQuestion,"");
    } else {
        buttonText.innerHTML = "<i>Válts magyar kérdésekre</i>";
        currentLanguage = 1;
    }
});

document.addEventListener("DOMContentLoaded", function() {
    let chatInputValue;
    document.getElementById("chatInput").onkeydown = function(event) {
        if (event.keyCode === 13) {
            chatInputValue = document.getElementById("chatInput").value;
            if (chatInputValue !== ""){
                chat.user(chatInputValue);
                sendDictionaryTable(dictionaryName,currentLanguage,lastQuestion,chatInputValue);
                document.getElementById("chatInput").value = "";
            }
        }
      };
});

document.getElementById("AIHelp").addEventListener("click", () => {
    AIHelp();
});


$(document).ready(function() {
    sendDictionaryTable(dictionaryName,currentLanguage,"+++","");
});
