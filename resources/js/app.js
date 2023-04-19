import Dropzone from "dropzone";
Dropzone.autoDiscover = false;

try {
    const dropzone = new Dropzone(".dropzone", {
        dictDefaultMessage: "Sube aquí tu imagen",
        acceptedFiles: ".png, .jpg, .jpeg, .gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        maxFiles: 1,
        uploadMultiple: false,
    
        init: function() {
            if(document.querySelector('[name="imagen"]').value.trim()){
                const imagenPublicada = {}
                imagenPublicada.size = 1234;
                imagenPublicada.name = document.querySelector('[name="imagen"]').value;
    
                this.options.addedfile.call(this, imagenPublicada);
                this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);
    
                imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
            }
        },
    });
    dropzone.on('success', function(file, response) {
        document.querySelector('[name="imagen"]').value = response.imagen;
    });
    
    dropzone.on('removedfile', function() {
        document.querySelector('[name="imagen"]').value = '';
    });
} catch (error) {
    console.log(error);
}

// Metodos de dropzone, para ver diferentes eventos al alamacenar archivos 
// dropzone.on('sending',(file,xhr,formData)=>{
//     console.log(formData);
// });
// dropzone.on('error',(file,message)=>{
//     console.log(message);
// });
// dropzone.on('removedfile',(file,message)=>{
//     console.log(message);
// });

// Menu responsive
const btnMenu = document.getElementById('btn-menu');
const menu = document.getElementById('menu');
btnMenu.addEventListener('click',()=>{
    if (btnMenu.src.split('/')[4] === 'menu-abrir.svg') {
        btnMenu.src = './img/menu-cerrar.svg';
    } else {
        btnMenu.src = './img/menu-abrir.svg';
    }
    menu.classList.toggle('translate-y-0');
});