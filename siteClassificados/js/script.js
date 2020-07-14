//somente letras maiusculas
/*$(function(){
    $('.campoSigla').keyup(function(){
         this.value = this.value.toUpperCase();
         this.value = this.value.replace(/[^A-Z]/g,'');
    });
}); */

//mascara de campo para telefone celular
$(document).ready(function(){
    $('#telefone').mask('(00)00000-0000');
});

//somente numeros com jquery
$(function(){
    $('.val').keyup(function(){
        // this.value = this.value.toUpperCase();
         this.value = this.value.replace(/[^0-9]/g,'');
    });
});

function mostrarSenha(){
    
    const senha = document.querySelector('#senha')
    
    if(senha.type == 'password')
    {
        senha.type = 'text'
    }
    else
    {
        senha.type = 'password'
    }
}




