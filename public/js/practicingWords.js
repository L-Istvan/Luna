var dictionaryName = document.getElementById('dictionaryName').getAttribute('data-name');
var lastQuestion = null;
var currentLanguage = 1;
var level = 1;

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
            window.AI(message);
        },
        error: function(xhr){
            toastr.error(xhr.responseJSON);
        }
    })
}

function updateContainerContent(dictionaryName) {
    var containerElement = document.getElementById('container');
    containerElement.innerHTML = `
        <div id="dictionaryName" data-name="${dictionaryName}"></div>
    `;
}

function AIHelp(){
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
            console.log(xhr);
            window.AI(xhr);
        },
        error: function(xhr){
            toastr.error(xhr.responseJSON);
        }
    })
}


document.getElementById("chatInput").onkeydown = function(event) {
    if (event.keyCode === 13) {
        chatInputValue = document.getElementById("chatInput").value;
        if (chatInputValue !== ""){
            window.user(chatInputValue);
            console.log(chatInputValue);
            sendDictionaryTable(dictionaryName,currentLanguage,lastQuestion,chatInputValue);
            document.getElementById("chatInput").value = "";
        }
    }
};


const button = document.getElementById("changeButton");
const buttonText = document.getElementById("buttonText");

// Kattintás eseménykezelő
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


$(document).ready(function() {
    sendDictionaryTable(dictionaryName,currentLanguage,"apple","");
});


