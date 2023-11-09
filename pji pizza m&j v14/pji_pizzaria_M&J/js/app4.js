const cpfPop = document.querySelector('#input_cpf_usu_pop');
const cpf = document.querySelector('#input_cpf_usu');
const botao = document.querySelector("botao_confirmar_link_usu")
const botaoPop = document.querySelector("#openPopUp")

cpf.addEventListener('input', (cpf)=>{
    cpfPop.value = cpf.target.value;
    console.log('waka do waka');
});

const nome = document.querySelector('#input_nome_usu');
/*
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
*/

// window.location.href = "fjsfslfk.html"


document.querySelector("#verificarCPF").addEventListener("click", () => {
    const data = {
        cpf: cpf.value
    }
    fetch("http://localhost/pji%20pizza%20m&j%20v13/pji_pizzaria_M&J/php/3_verificarCPF.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(resp => resp.json())
    .then(resp => {
        if(resp.message){
            botaoPop.click()

        }
        else{
            
        }
    })
})
