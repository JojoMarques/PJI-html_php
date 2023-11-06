let titulo_func = document.querySelector(".titulo-func");
let dados_func =document.querySelector('#dados_func');

let codigo_func = ["joss.0308", "joao.1907", "mill.2405", "mari.2606", "mido.0401"];
let nomes_func = ["Jossana", "João", "Millena", "Marisa", "Midori"];

let id_nome;
let id_cod;

function getvalores(nom, cod) {
    this.nom_id = nom;
    this.cod_id = cod;
}

let v = new getvalores(2,2);

titulo_func.textContent =`Bem vindo(a) - ${nomes_func[v.nom_id]}`;
dados_func.innerHTML = `nome do funcionário: ${nomes_func[v.nom_id]} <br> <br> código do funcionário: ${codigo_func[v.cod_id]}`;


document.querySelector('#pic_funcionario').setAttribute('src', `../assets/images/membros/${nomes_func[v.nom_id]}.png`);


//
document.querySelector('#texto_botao_pedido').addEventListener('mouseover', ()=>{
    document.querySelector('.botao-seta-mais-escuro').style.opacity = '100%';
})

document.querySelector('#texto_botao_pedido').addEventListener('mouseleave', ()=>{
    document.querySelector('.botao-seta-mais-escuro').style.opacity = '0%';
})