document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp(){
    const fechaInput = document.querySelector('#fecha'); //El input de la fecha
    fechaInput.addEventListener('input', (e)=>{ //Cuando se cambie
        const fechaSeleccionada = e.target.value; //Obtenga ese valor

        window.location = `?fecha=${fechaSeleccionada}`; //manda una llave al get con la fecha seleccionada
    });
}