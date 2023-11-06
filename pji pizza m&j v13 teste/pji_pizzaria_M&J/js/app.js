
const imagens_pizzas = ['pizza-calabresa','Pizza_frango_requeijao','pizza-bufala','Pizza-de-atum','pizza-queijo'];
const imgs_pizzas = document.querySelectorAll('.img-pizza');
const textbox = document.querySelector('#caixa_chamariz');

let imagens =  document.querySelector('.active');

document.querySelector("button[id='seta_left']").addEventListener('click', ()=>{
    imagens =  document.querySelector('.active');
    
    imgs_pizzas.forEach(i => {
        if (imagens.lastElementChild == i){
            let img_att = i;
            mudar_texto_a_cada_img_pizza(img_att, 'e');
        }
    });
})

document.querySelector('button[id="seta_right"]').addEventListener('click', ()=>{
    imagens =  document.querySelector('.active');
    
    imgs_pizzas.forEach(i => {
        if (imagens.lastElementChild == i){
            let img_att = i;
            mudar_texto_a_cada_img_pizza(img_att, 'd');
        }
    });
})

function mudar_texto_a_cada_img_pizza(img, lado){
    let caso;

    for(let j = 0; j<5; j++){
        if(img.getAttribute('src').includes(`${imagens_pizzas[j]}`)){
            if(lado == 'd' && j!=4){
                caso = imagens_pizzas[j+1];

            } else if (lado=='d' && j==4){
                caso = imagens_pizzas[0];

            } else if(lado=='e' && j==0){
                caso = imagens_pizzas[4];

            } else {
                caso = imagens_pizzas[j-1];
            }
        }
    };

    switch(caso){
        case imagens_pizzas[0]:{
            textbox.innerHTML = "Prove nosso sabor tradicional mais vendido:<br>Calabresa!"
            break;
        }
        case imagens_pizzas[1]:{
            textbox.innerHTML = "Promoção! Compre duas pizzas e leve uma coca-cola de brinde!!"
            break;
        }
        case imagens_pizzas[2]:{
            textbox.innerHTML = "Promoção! Só hoje, as pizzas de queijo de bufala estarão com 5% de desconto!"
            break;
        }
        case imagens_pizzas[3]:{
            textbox.innerHTML = "Prove nosso sabor vegetariano:<br>Atum!"
            break;
        }
        case imagens_pizzas[4]:{
            textbox.innerHTML = "Aproveite o tradicionalíssimo mussarela!!<br>Bordas recheadas por mais R$6,00"
            break;
        }
    }
}