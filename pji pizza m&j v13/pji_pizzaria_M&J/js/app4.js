const cpfPop = document.querySelector('#input_cpf_usu_pop');
const cpf = document.querySelector('#input_cpf_usu');
const botao = document.querySelector("botao_confirmar_link_usu")

cpf.addEventListener('input', (cpf)=>{
    cpfPop.value = cpf.target.value;
    console.log('waka do waka');
});

const nome = document.querySelector('#input_nome_usu');

const forms = document.querySelector("#FormularioCliente");
document.forms.FormularioCliente.addEventListener('submit', (event) => {
       let n = nome.textvalue;
       let submit = true;
       console.log('nhoi')
    
   if (n.trim() === "") { // Use trim() para remover espaços em branco extras
            submit = false;
    }
    
       if (!submit) {
            botao.setAttribute('href','#');
         }
         else
        forms.submit();
})
