    $(document).ready(function() {
        $('#nome').focus();
    });

document.addEventListener("DOMContentLoaded", function () {
    let produtoForm = document.getElementById("produtoForm");

    produtoForm.addEventListener("submit", function (event) {
        event.preventDefault();

        let formData = new FormData(produtoForm);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", produtoForm.action, true);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                let response = JSON.parse(xhr.responseText);

                alert(response.message);

                if (response.status === "success") {
                    produtoForm.reset();
                }else{
                    produtoForm.reset();


                }
            }
        };

        xhr.send(formData);
    });
});
document.addEventListener('keydown', function(event) {
    switch(event.key) {
        case '/':
            window.location.href = '/';
            break;
        case '-':
            window.location.href = 'produtos';
            break;
        default:
            break;
    }
});
