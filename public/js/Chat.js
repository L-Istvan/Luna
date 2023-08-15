class Chat {

    AI(text){
        var container = document.getElementById("container");
        var newDiv = document.createElement("div");
        newDiv.className = 'AI'
        container.appendChild(newDiv);
        var divContainer = document.createElement("div");
        divContainer.classList.add("d-flex", "align-items-baseline", "mb-4");

        var avatarDiv = document.createElement("div");
        avatarDiv.classList.add("position-relative", "avatar");

        var imgElem = document.createElement("img");
        imgElem.src = "/images/favicon.ico";
        imgElem.classList.add("img-fluid", "rounded-circle");
        imgElem.alt = "";

        avatarDiv.appendChild(imgElem);

        var peDiv = document.createElement("div");
        peDiv.classList.add("pe-2");

        var cardDiv = document.createElement("div");
        cardDiv.classList.add("card", "card-text", "d-inline-block", "p-2", "px-3", "m-1");
        cardDiv.innerHTML = text.replace(/\n/g, "<br>");

        peDiv.appendChild(cardDiv);

        divContainer.appendChild(avatarDiv);
        divContainer.appendChild(peDiv);

        var celElemek = document.getElementsByClassName("AI");
        var celElem = celElemek[celElemek.length -1 ];

        celElem.appendChild(divContainer);
        window.scrollTo(0, document.body.scrollHeight);
    }

    user(text){
        var container = document.getElementById("container");
        var newDiv = document.createElement("div");
        newDiv.className = 'user'
        container.appendChild(newDiv);

        var divContainer = document.createElement("div");
        divContainer.classList.add("d-flex", "align-items-baseline","text-end","justify-content-end", "mb-4");

        var peDiv = document.createElement("div");
        peDiv.classList.add("pe-2");

        var cardDiv = document.createElement("div");
        cardDiv.classList.add("card", "card-text", "d-inline-block", "p-2", "px-3", "m-1");
        cardDiv.textContent = text;

        var avatarDiv = document.createElement("div");
        avatarDiv.classList.add("position-relative", "avatar")
        var imgElem = document.createElement("img");
        imgElem.src = "https://nextbootstrap.netlify.app/assets/images/profiles/2.jpg";
        imgElem.classList.add("img-fluid", "rounded-circle");
        imgElem.alt = "";
        avatarDiv.appendChild(imgElem);

        peDiv.appendChild(cardDiv);

        divContainer.appendChild(peDiv);
        divContainer.appendChild(avatarDiv);

        var celElemek = document.getElementsByClassName("user");
        var celElem = celElemek[celElemek.length -1 ];

        celElem.appendChild(divContainer);
        window.scrollTo(0, document.body.scrollHeight);
    }

    showLoadingAnimation() {
        var container = document.getElementById("container");
        var loadingDiv = document.createElement("div");
        loadingDiv.className = 'loading-animation';
        loadingDiv.style.backgroundColor = 'transparent';
        loadingDiv.style.width = '100px';
        loadingDiv.style.height = '100px';
        container.appendChild(loadingDiv);

        // Create and add SVG animation on the loadingDiv
        var svgElem = document.createElement("object");
        svgElem.type = "image/svg+xml";
        svgElem.data = "/animation/loading.svg";
        loadingDiv.appendChild(svgElem);
    }

    hideLoadingAnimation() {
        var loadingDiv = document.querySelector(".loading-animation");
        if (loadingDiv) {
            loadingDiv.parentNode.removeChild(loadingDiv);
        }
    }
}

export default Chat;
