    $(document).ready(function() {
        $('#clienteInput').focus();
    });
    
function adicionarRomaneio() {
    const cliente = document.getElementById('clienteInput').value;
    const data = document.getElementById('data').value;

    const url = `nota?cliente=${encodeURIComponent(cliente)}&data=${encodeURIComponent(data)}`;

    window.location.href = url;
}
document.addEventListener('keydown', function(event) {
    switch(event.key) {
        case '+':
            window.location.href = 'cadastro';
            break;
        case '-':
            window.location.href = 'produtos';
            break;
        case 'Enter':
            adicionarRomaneio();
            break;
        default:
            break;
    }
});