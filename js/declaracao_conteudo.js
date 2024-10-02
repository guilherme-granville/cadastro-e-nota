document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);

    const cliente = urlParams.get('cliente');
    const cidade = urlParams.get('cidade');
    const data = urlParams.get('data');

    document.getElementById('cliente').textContent = cliente;
    document.getElementById('cidade').textContent = cidade;
    document.getElementById('data').textContent = data;

    const conteudoTabela = document.getElementById('conteudoTabela');
    let valorTotal = 0;

    for (let i = 0; urlParams.has(`product_${i}_name`); i++) {
        const name = urlParams.get(`product_${i}_name`);
        const price = parseFloat(urlParams.get(`product_${i}_price`));
        const quantity = parseInt(urlParams.get(`product_${i}_quantity`));
        const total = parseFloat(urlParams.get(`product_${i}_total`));

        valorTotal += total;

        const row = document.createElement("tr");
        row.classList.add("c14");

        row.innerHTML = `
<td class="c2 c11" colspan="7" rowspan="1">
<p class="c34"><span class="c5">${name}</span></p>
</td>
<td class="c30 c11" colspan="3" rowspan="1">
<p class="c28"><span class="c5">${price.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}</span></p>
</td>
<td class="c33 c11" colspan="2" rowspan="1">
<p class="c9"><span class="c5">${quantity}</span></p>
</td>
<td class="c11" colspan="3" rowspan="1">
<p class="c9"><span class="c5">${total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}</span></p>
</td>
`;

        conteudoTabela.appendChild(row);
    }

    document.getElementById('valorTotal').textContent = valorTotal.toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    });

    document.getElementById('printButton').addEventListener('click', function () {
        window.print();
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            window.print();
        }
    });

    window.print();
});

document.addEventListener('keydown', function(event) {
    switch(event.key) {
        case '/':
            window.location.href = '/';
            break;
        default:
            break;
    }
});