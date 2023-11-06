//aparecer pop up
const cpfPop = document.querySelector('#input_cpf_usu_pop');
const cpf = document.querySelector('#input_cpf_usu');

cpf.addEventListener('input', (cpf)=>{
    cpfPop.value = cpf.target.value;
});

//mudar pra proximo input qd tecla enter
const tdsInput = document.querySelectorAll("input[id^='input_']");
let index = 0;

tdsInput.forEach(i =>{
    i.addEventListener('keyup', i =>{
        if(i.code == 'Enter'){
            if(tdsInput[index].id == i.target.id ){
                tdsInput[index +1].focus();
                index++;
            }
        }
    });
});

//submit

//pop up botao invisivel
const btnPopUp = document.querySelector('#openPopUp');
//só CPF
const btnVerifCPF =document.querySelector('#verificarCPF');

btnVerifCPF.addEventListener('click', () => {
    const cpf_usu = document.getElementById('input_cpf_usu').value;
    
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/pji%20pizza%20m&j%20v13/pji_pizzaria_M&J/php/3_verificarCPF.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.cpfEncontrado) {
                    // CPF encontrado, clique no link "openPopUp"
                    document.getElementById('openPopUp').click();
                } else {
                    // CPF não encontrado, exiba uma mensagem ou realize outras ações
                    console.log('CPF não encontrado');
                }
            } else {
                // Lidar com erros de requisição
                console.log('Erro na solicitação: ' + xhr.status);
            }
        }
    };
    
    xhr.send('cpf_usu=' + cpf_usu);
});
