document.addEventListener("DOMContentLoaded", function() {
    const anonimaCheckbox = document.getElementById("anonima");
    const nomeInput = document.getElementById("nome");
    const emailInput = document.getElementById("email");
    const nomeLabel = document.querySelector("label[for='nome']");
    const emailLabel = document.querySelector("label[for='email']");

    function atualizarCampos() {
        if (anonimaCheckbox.checked) {
            nomeInput.disabled = true;
            emailInput.disabled = true;
            nomeInput.parentElement.style.display = "none";
            emailInput.parentElement.style.display = "none";
            nomeLabel.style.display = "none";
            emailLabel.style.display = "none";

            nomeInput.value = "";
            emailInput.value = "";
        } else {
            nomeInput.disabled = false;
            emailInput.disabled = false;
            nomeInput.parentElement.style.display = "flex";
            emailInput.parentElement.style.display = "flex";
            nomeLabel.style.display = "block";
            emailLabel.style.display = "block";
        }
    }

    anonimaCheckbox.addEventListener("change", atualizarCampos);
    atualizarCampos();
});

var chatButton = document.getElementById("chat-button");
var chatContainer = document.getElementById("chat-container");

chatButton.addEventListener("click", function() {
    chatContainer.classList.toggle("active");
});

var userInput = document.getElementById("user-input");

userInput.addEventListener("keypress", function(e) {
    if (e.key === 'Enter') {
        sendMessage();
    }
});

document.addEventListener("DOMContentLoaded", function() {
    var menuToggle = document.getElementById("menu-toggle");
    var menuItems = document.getElementById("menu-items");

    menuToggle.addEventListener("click", function() {
        if (menuItems.style.display === "block") {
            menuItems.style.display = "none";
        } else {
            menuItems.style.display = "block";
        }
    })});