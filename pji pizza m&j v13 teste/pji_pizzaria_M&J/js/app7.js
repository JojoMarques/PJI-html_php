
const nota = document.querySelector('#nt_fiscal');
const sombra = document.querySelector('#bloco-sombra');

const estNota = window.getComputedStyle(nota);
const estSombra = window.getComputedStyle(sombra);


let mhsombra = estSombra.getPropertyValue('max-height');
let mhnota = estNota.getPropertyValue('max-height');

sombra.style.maxHeight = `${parseInt(mhnota.substring(0,2))-46.4}%`;

console.log(mhnota.substring(0,2));