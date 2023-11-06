
const tdsCheckboxes = document.querySelectorAll('input[type="checkbox"]');
const tdsInputNum = document.querySelectorAll('input[id^="inputPizza_"]');

const btnAdd = document.querySelectorAll('button[id^="btn_mais"]');
const btnRem = document.querySelectorAll('button[id^="btn_menos"]');

const tdslabel = document.querySelectorAll('label[id^="lbl_"]');

const tdspreco = document.querySelectorAll('p[id^="preco_"]');

tdsCheckboxes.forEach(c => {
    c.addEventListener('change', c=>{ //torna os botões desativados (pizza indisponível)
        let numCheck = parseInt(c.target.id.substring(6)-1);
        
        if(!c.target.checked){
            //invalida qualquer valor
            tdsInputNum[numCheck].value = null;

            //coloca o atributo desativador
            tdsInputNum[numCheck].setAttribute('disabled','');
            btnAdd[numCheck].setAttribute('disabled','');
            btnRem[numCheck].setAttribute('disabled','');

            //mudando o visual:
            tdslabel[numCheck].classList.add('cor-cinza-escuro');
            tdslabel[numCheck].classList.remove('efeito-de-input-zoom-05');

            tdsInputNum[numCheck].classList.remove('input-3');
            tdsInputNum[numCheck].classList.add('input-3-noHover');

            btnAdd[numCheck].classList.add('fundo-cinza-escuro');
            btnRem[numCheck].classList.add('fundo-cinza');

            tdspreco[numCheck].classList.add('cor-cinza');
        } else {
            //tira o atributo desativador
            tdsInputNum[numCheck].removeAttribute('disabled');
            btnAdd[numCheck].removeAttribute('disabled');
            btnRem[numCheck].removeAttribute('disabled');

            //mudando o visual:
            tdslabel[numCheck].classList.remove('cor-cinza-escuro');
            tdslabel[numCheck].classList.add('efeito-de-input-zoom-05');

            tdsInputNum[numCheck].classList.remove('input-3-noHover');
            tdsInputNum[numCheck].classList.add('input-3');

            btnAdd[numCheck].classList.remove('fundo-cinza-escuro');
            btnRem[numCheck].classList.remove('fundo-cinza');

            tdspreco[numCheck].classList.remove('cor-cinza');
        }
    });
});

btnAdd.forEach(btnmais =>{
    btnmais.addEventListener('click', (btnmais)=>{
        
        for(let i = 0; i < tdsInputNum.length; i++){
            if(parseInt(btnmais.target.id.substring(9)-1) == (i)){
                tdsInputNum[i].value ++; //adiciona uma unidade a cada clique
                sumTotal(i)
            }
        }
    });
});


//cálculo do total
const inputTotal = document.querySelector('#total');

function sumTotal(i){
    //arruma vírgula e tira o R$
    const preco = document.querySelector(`#preco_${i+1}`).textContent.split('$')[1].replace(",", ".") * 1;

    if(inputTotal.value == "")
        inputTotal.value = preco
    else
        inputTotal.value = (Number.parseFloat(inputTotal.value) + preco).toFixed(2)
}

function subTotal(i){
    const preco = document.querySelector(`#preco_${i+1}`).textContent.split('$')[1].replace(",", ".") * 1;

    if(inputTotal.value == "")
        inputTotal.value = preco
    else
        inputTotal.value = (Number.parseFloat(inputTotal.value) - preco).toFixed(2)
}

btnRem.forEach(btnmenos =>{
    btnmenos.addEventListener('click', (btnmenos)=>{
        
        for(let i = 0; i < tdsInputNum.length; i++){
            if(parseInt(btnmenos.target.id.substring(10)-1) == (i)){
                if(tdsInputNum[i].value > 0){
                    tdsInputNum[i].value --; //remove uma unidade por clique, se houver alguma unidade
                    subTotal(i)
                } 
                if(tdsInputNum[i].value == 0){ //se estiver vazio, volta ao valor padrão "-"
                    tdsInputNum[i].value = null;
                }
                
            }
        }
    });
});

//mudar pra proximo input qd tecla enter

tdsInputNum.forEach(i =>{
    i.addEventListener('keyup', i =>{
        if(i.code == 'Enter'){
            for(let index = 0 ; index < tdsInputNum.length -1; index++){
                if(tdsInputNum[index].id == i.target.id ){
                    tdsInputNum[index +1].focus();
                }
            }
        }
    });
});

//clica o botao

document.querySelector("#inputPizza_20").addEventListener('keypress', (e)=>{
    if(e.which == 13){
        document.querySelector("button_retangular").click();
        document.querySelector("#botao_finalizar_link").click();
    }
});


// Adiciona um ouvinte de eventos de input a cada campo
tdsInputNum.forEach(campo => {
    campo.addEventListener('input', (evento) => {
        const id = evento.target.id.split('_')[1]; // Extrai o número do id do input
        const quantidade = parseInt(evento.target.value) || 0; // Obtém a quantidade do input

        // Obtém o preço associado ao id e remove o R$
        const preco = parseFloat(document.querySelector(`#preco_${id}`).textContent.split('R$')[1].replace(',', '.')) || 0;

        // Calcula o preço total para este item (quantidade * preço)
        const precoTotalItem = quantidade * preco;

        // Atualiza o preço total na interface
        atualizarPrecoTotal();
    });
});

// Função para atualizar o preço total com base em todos os campos de entrada
function atualizarPrecoTotal() {
    let total = 0;

    tdsInputNum.forEach(campo => {
        const id = campo.id.split('_')[1];
        const quantidade = parseInt(campo.value) || 0;
        const preco = parseFloat(document.querySelector(`#preco_${id}`).textContent.split('R$')[1].replace(',', '.')) || 0;
        total += quantidade * preco;
    });

    const campoTotal = document.querySelector('#total');
    campoTotal.value = total.toFixed(2);
}

// Chame a função inicialmente para calcular o preço total ao carregar a página
atualizarPrecoTotal();
