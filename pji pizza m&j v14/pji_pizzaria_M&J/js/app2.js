
const cod_func_input = document.querySelector("#input_cod_func");
const nome_func_input = document.querySelector("#input_nome_func");

const aviso_cod = document.querySelector("#cod-texto-aviso-contain");
const aviso_content_cod = document.querySelector("#cod-texto-aviso");

const aviso_nome = document.querySelector("#nome-texto-aviso-contain");
const aviso_content_nome = document.querySelector("#nome-texto-aviso");

const inputs = document.querySelectorAll('input');

let codigo_func = ["joss.0308", "joao.1907", "mill.2405", "mari.2606", "mido.0401"];
let nomes_func = ["Jossana", "jossana", "João", "joão", "Millena", "millena", "Marisa", "marisa","Midori" , "midori"];

const btnSubmitFunc = document.querySelector("#submitFunc");
let inputCod;
let inputNom;

//verifica se ta certo
inputs.forEach(input => {
    input.addEventListener('input', i => {
        

        if(i.target.getAttribute('type') === 'password'){
            if(codigo_func.includes(i.target.value)){
                
                inputCod = i.target.value;
            } else {
                message(i.target);
            }
        } else {
            if(nomes_func.includes(i.target.value)){

                inputNom =  i.target.value;
            } else {
                message(i.target);
            }
        }    

        permissao(inputCod, inputNom); 
    });
});

function permissao(inputCod, inputNom){

    console.log(inputCod, inputNom);
    if (codigo_func.includes(inputCod) && nomes_func.includes(inputNom)){
        btnSubmitFunc.setAttribute('onclick', "document.getElementById('formLoginFunc').submit()");
    } else {
        btnSubmitFunc.removeAttribute('onclick');
    }
}


btnSubmitFunc.addEventListener('click', ()=>{ //some com o aviso ou aparece ele
    inputs.forEach(i => {
        if(i.getAttribute('type') === 'password'){
            if(btnSubmitFunc.getAttribute('onclick')=='null'){
                if(!aviso_cod.classList.includes('d-none')){
                    aviso_cod.setAttribute('class', aviso_cod.classList.add('d-none'));
                }
            } else {
                aviso_cod.classList.remove('d-none');
            }

        } else {
            if(btnSubmitFunc.getAttribute('onclick')=='null'){
                if(!aviso_nome.classList.includes('d-none')){
                    aviso_nome.setAttribute('class', aviso_nome.classList.add('d-none'));
                }
            } else {
                aviso_nome.classList.remove('d-none');
            }
        }

        i.blur(); //tira o digitação de dentro da box
        i.value = '';
        
    });
});

//muda mensagem conforme o valor da box
function message(i){
        if(i.getAttribute('type') == 'password'){
            if(i.value==""){
                aviso_content_cod.textContent = 'Vazio!! Insira um código!';
            } else {
                aviso_content_cod.textContent = 'Código incorreto!!';
            }
        } else {
            if(i.value==""){
                aviso_content_nome.textContent = 'Vazio!! Insira um nome!';
            } else {
                 aviso_content_nome.textContent = 'Nome inválido!!';
            }
        }  
};

//muda para a proxima box

nome_func_input.addEventListener('keyup',(e) => {
    if(e.code == 'Enter'){
        cod_func_input.focus();
    }
});



//clica o botao

cod_func_input.addEventListener('keypress', (e)=>{
    if(e.which == 13){
        document.getElementById('formLoginFunc').submit();
        btnSubmitFunc.click();
    }
});



//coloca invisivel ao digitar

nome_func_input.addEventListener('keyup', () =>{
    if((nome_func_input !== null) && (!aviso_nome.classList.contains('d-none'))){
        aviso_nome.classList.add('d-none');
    }
});



//coloca invisivel ao digitar

cod_func_input.addEventListener('keyup', () =>{
    if((cod_func_input !== null) && (!aviso_cod.classList.contains('d-none'))){
        aviso_cod.classList.add('d-none');
    }
});    
