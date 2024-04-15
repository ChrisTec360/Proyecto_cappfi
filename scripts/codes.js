//regresar al index.html
document.getElementById("backRegister").addEventListener("click", function(){
    window.location.href = "index.html";
});

//descartado
document.getElementById("loginRegresa").addEventListener("click", function(){
    window.location.href = "index.html";
});

/*crear cuenta*/
const formulary = document.getElementById('formulariocrearcuenta');
const inputs = document.querySelectorAll('#formulariocrearcuenta input');

const expresiones = {
    nombre: /^[a-zA-ZÀ-ÿ\s]{3,16}$/,
    contraseñausuario: /^.{6,20}$/
}

const validaFormulary = (e) => {
    switch(e.target.name){
        case "nombre":
            if(expresiones.nombre.test(e.target.value)){
                document.getElementById('grupo__nombre').classList.remove('formulary__group-incorrecto');
                document.getElementById('grupo__nombre').classList.add('formulary__group-correcto');
                document.querySelector('#grupo__nombre .formulario_input-error').classList.remove('formulario_input-error-activo');
            }  
            else{
                document.getElementById('grupo__nombre').classList.add('formulary_input-error-activo');
                document.getElementById('grupo__nombre').classList.remove('formulary__group-correcto');
                document.querySelector('#grupo__nombre .formulario_input-error').classList.add('formulario_input-error-activo');
            } 
    
        break;
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validaFormulary);
    input.addEventListener('blur', validaFormulary);

});


formulary.addEventListener('submit', (e) =>{
    e.preventDefault();
});


document.getElementById("cancelarCambioContraseña").addEventListener("click", function(){
    window.location.href = "/peachepes/menuproductos.php";
});

