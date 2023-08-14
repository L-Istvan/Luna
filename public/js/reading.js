import Chat from '/js/Chat.js';
const chat = new Chat();
var dictionaryName = document.getElementById('dictionaryName').getAttribute('data-name');
var history = "";

function generateTextfromDictionary(dictionaryName) {
    chat.showLoadingAnimation();
    setTimeout(function(){
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: '/generateTextfromDictionary',
            data: {
                dictionaryName : dictionaryName,
            },
            dataType: 'json',
            success: function(xhr){
                chat.hideLoadingAnimation();
                chat.AI(xhr);
                history = xhr;
            },
            error: function(xhr){
                chat.hideLoadingAnimation();
                toastr.error(xhr.responseJSON);
            }
        })
    }, 500);
}

function translateText(text){
    chat.showLoadingAnimation();
    $.ajax({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "POST",
        url: '/translateText',
        data: {
            text : text,
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

function selectionWords(text){
    chat.showLoadingAnimation();
    $.ajax({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "POST",
        url: '/selectionWords',
        data: {
            text : text,
        },
        dataType: 'json',
        success: function(xhr){
            chat.hideLoadingAnimation();
            chat.AI(xhr);
            history = xhr;
        },
        error: function(xhr){
            chat.hideLoadingAnimation();
            toastr.error(xhr.responseJSON);
        }
    })
}

$(document).ready(function() {
    if (dictionaryName.trim() !== "") {
        document.getElementById('generateMoreText').style.display = "block";
        const chatInputDiv = document.getElementById("chatInput");
        chatInputDiv.style.display = "none";
        document.getElementById("AI").style.display = "none";
        generateTextfromDictionary(dictionaryName);
    }
});

document.getElementById("translateText").addEventListener("click", function() {
    if(history.trim() !== "") translateText(history);
    else chat.AI("Elsőnek generálj szöveget!");
});

document.getElementById("generateMoreText").addEventListener("click", function() {
    generateTextfromDictionary(dictionaryName);
});

document.getElementById("chatInput").onkeydown = function(event) {
    if (event.keyCode === 13) {
        let chatInputValue = document.getElementById("chatInput").value;
        if (chatInputValue !== ""){
            chat.user(chatInputValue);
            selectionWords(chatInputValue);
            document.getElementById("chatInput").value = "";
        }
    }
};
