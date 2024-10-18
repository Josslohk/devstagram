import Dropzone from "dropzone";

// Dropzone.autoDiscover = false;

// if (document.getElementById('dropzone')) {
//     const dropzone = new Dropzone(".dropzone", {
//         dictDefaultMessage: "Sube aquí tu imagen",
//         acceptedFiles: ".png, .jpg, .jpeg, .gif",
//         addRemoveLinks: true,
//         dictRemoveFile: "Borrar archivo",
//         maxFiles: 1,
        
//         uploadMultiple: false,
//         init: function() {
//             if(document.querySelector('[name="imagen"]').value.trim()){
//                 const fileName = document.querySelector('[name="imagen"]').value.trim()
//                 const file = {name: fileName, size: 1234, url:`/uploads/${fileName}`};  
                
//                 let mockfile = {
//                     name: file.name,
//                     size: file.size,
//                 };
    
//                 this.displayExistingFile(mockfile, file.url);
//             }
//         }
//     });
    
//     dropzone.on('sending', function(file, xhr, formData){
//         console.log( file );
//     });

//     dropzone.on('success', function(file, response) {
//         document.querySelector('[name="imagen"]').value = response.imagen;
//     });

//     dropzone.on('removedfile', function() {
//         document.querySelector('[name="imagen"]').value = '';
//     });
//     dropzone.on('error', function(file, message) {
//         console.log(message);
//     });
// };


// document.addEventListener('DOMContentLoaded', function () {
//     var croppieDemo = new Croppie(document.getElementById('croppie-demo'), {
//         viewport: { width: 100, height: 100, type: 'square' },
//         boundary: { width: 300, height: 300 },
//         enableExif: true
//     });

//     document.getElementById('upload').addEventListener('change', function () {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             croppieDemo.bind({
//                 url: e.target.result
//             });
//         };
//         reader.readAsDataURL(this.files[0]);
//     });

//     document.getElementById('crop-btn').addEventListener('click', function () {
//         croppieDemo.result('blob').then(function (blob) {
//             var url = URL.createObjectURL(blob);
//             document.getElementById('cropped-image').src = url;
//             document.getElementById('cropped-image').style.display = 'block';
//         });
//     });
// });

Dropzone.autoDiscover = false;

if (document.getElementById('dropzone')) {
    const dropzone = new Dropzone(".dropzone", {
        dictDefaultMessage: "Sube aquí tu imagen",
        acceptedFiles: ".png, .jpg, .jpeg, .gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        maxFiles: 1,
        uploadMultiple: false,
        autoProcessQueue: false, // No procesar automáticamente
        init: function() {
            if (document.querySelector('[name="imagen"]').value.trim()) {
                const fileName = document.querySelector('[name="imagen"]').value.trim();
                const file = { name: fileName, size: 1234, url: `/uploads/${fileName}` };
                
                let mockfile = {
                    name: file.name,
                    size: file.size,
                };

                this.displayExistingFile(mockfile, file.url);
            }
        }
    });
    let croppieDemo; // Variable global para la instancia de Croppie

    dropzone.on('addedfile', function (file) {
        if (croppieDemo) {
            return;
        };
        const reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector('.dropzone').style.display = 'none';
            document.getElementById('loading').classList.remove('hidden');
            document.getElementById('loading').classList.add('flex');
            // Si existe una instancia anterior de Croppie, destrúyela
            
            function initCroppie() {
                let viewportSize; // Valor por defecto para el viewport y boundary
                let boundarySize; // Valor por defecto para el viewport y boundary
    
                // Si la pantalla es menor a 500px, hacerlo responsivo
                if (window.innerWidth < 720 && window.innerWidth > 450) {
                    viewportSize = 250;
                    boundarySize = 300;
                } else if (window.innerWidth <= 450) {
                    viewportSize = 150;
                    boundarySize = 200;
                } else {
                    viewportSize = 350;
                    boundarySize = 400;
                }
                console.log(viewportSize);
                
                if (croppieDemo) {
                    croppieDemo.destroy(); // Destruir la instancia anterior si existe
                }
    
                croppieDemo = new Croppie(document.getElementById('croppie-demo'), {
                    viewport: { 
                        width: viewportSize, // Usar viewportSize ajustado o por defecto
                        height: viewportSize, 
                        type: 'square' 
                    },
                    boundary: { 
                        width: boundarySize, // Ancho de boundary ajustado o por defecto
                        height: boundarySize 
                    },
                    enableExif: true
                });
    
                croppieDemo.bind({
                    url: e.target.result
                }).then(function() {
                    setTimeout(function() {
                        document.getElementById('loading').classList.remove('flex');
                        document.getElementById('loading').classList.add('hidden');
                    }, 100); // Ajusta este valor si es necesario
                    document.getElementById('croppie-modal').classList.remove('hidden');
                }).catch(function() {
                    document.getElementById('loading').classList.add('hidden');
                });
                
                croppieDemo.bind({
                    url: e.target.result
                });
            }

            initCroppie();
            // function debounce(func, delay) {
            //     let timeout;
            //     return function (...args) {
            //         const context = this;
            //         clearTimeout(timeout);
            //         timeout = setTimeout(() => func.apply(context, args), delay);
            //     };
            // }
            // Ejecuta la función cuando se redimensiona la ventana
            // window.addEventListener('resize', debounce(function() {
            //     if (croppieDemo) {
            //         initCroppie();
            //     }
            // }, 300));
            // Recortar y enviar la imagen cuando se haga clic en el botón "Recortar y Subir"
            document.getElementById('crop-btn').onclick = function () {
                croppieDemo.result({
                    type: 'blob', // Para obtener el resultado como blob
                    size: { width: 1000, height: 1000 }, // Tamaño personalizado de la imagen
                    format: 'jpg' // Puedes cambiar a 'png' si lo prefieres
                }).then(function (blob) {
                    let croppedFile = new File([blob], file.name, { type: file.type });
                    
                    dropzone.removeAllFiles(true); // Limpiar Dropzone
                    dropzone.addFile(croppedFile); // Agregar el archivo recortado a Dropzone
                    dropzone.processQueue(); // Procesar el archivo recortado
            
                    // Cerrar el modal
                    document.getElementById('croppie-modal').classList.add('hidden');
            
                    // Destruir la instancia de Croppie después de procesar
                    croppieDemo.destroy();
                    croppieDemo = null; // Resetear la variable
                    document.querySelector('.dropzone').style.display = 'flex';
                });
            };
            
        };

        reader.readAsDataURL(file);
    });

    // Cerrar el modal cuando se haga clic en "Cerrar"
    document.getElementById('close-modal-btn').addEventListener('click', function () {
        document.getElementById('croppie-modal').classList.add('hidden');
        if (croppieDemo) {
            croppieDemo.destroy();
            croppieDemo = null; // Resetear la variable
            document.querySelector('.dropzone').style.display = 'flex';
            dropzone.removeAllFiles(true);
        }
    });

    dropzone.on('sending', function (file, xhr, formData) {
        console.log(file);
    });

    dropzone.on('success', function (file, response) {
        document.querySelector('[name="imagen"]').value = response.imagen;
    });

    dropzone.on('removedfile', function () {
        document.querySelector('[name="imagen"]').value = '';
    });

    dropzone.on('error', function (file, message) {
        console.log(message);
    });
};


if (document.getElementById('dropzonePerfil')) {
    const dropzone = new Dropzone(".dropzone", {
        dictDefaultMessage: "Sube aquí tu imagen",
        acceptedFiles: ".png, .jpg, .jpeg, .gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        maxFiles: 1,
        uploadMultiple: false,
        autoProcessQueue: false, // No procesar automáticamente
        init: function() {
            if (document.querySelector('[name="imagen"]').value.trim()) {
                const fileName = document.querySelector('[name="imagen"]').value.trim();
                const file = { name: fileName, size: 1234, url: `/perfiles/${fileName}` };
                
                let mockfile = {
                    name: file.name,
                    size: file.size,
                };

                this.displayExistingFile(mockfile, file.url);
            }
        }
    });
    let croppieDemo; // Variable global para la instancia de Croppie

    dropzone.on('addedfile', function (file) {
        if (croppieDemo) {
            return;
        };
        const reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector('.dropzone').style.display = 'none';
            document.getElementById('loading').classList.remove('hidden');
            document.getElementById('loading').classList.add('flex');
            // Si existe una instancia anterior de Croppie, destrúyela
            
            function initCroppie() {
                let viewportSize; // Valor por defecto para el viewport y boundary
                let boundarySize; // Valor por defecto para el viewport y boundary
    
                // Si la pantalla es menor a 500px, hacerlo responsivo
                if (window.innerWidth < 720 && window.innerWidth > 450) {
                    viewportSize = 250;
                    boundarySize = 300;
                } else if (window.innerWidth <= 450) {
                    viewportSize = 150;
                    boundarySize = 200;
                } else {
                    viewportSize = 350;
                    boundarySize = 400;
                }
                console.log(viewportSize);
                
                if (croppieDemo) {
                    croppieDemo.destroy(); // Destruir la instancia anterior si existe
                }
    
                croppieDemo = new Croppie(document.getElementById('croppie-demo'), {
                    viewport: { 
                        width: viewportSize, // Usar viewportSize ajustado o por defecto
                        height: viewportSize, 
                        type: 'circle' 
                    },
                    boundary: { 
                        width: boundarySize, // Ancho de boundary ajustado o por defecto
                        height: boundarySize 
                    },
                    enableExif: true
                });
    
                croppieDemo.bind({
                    url: e.target.result
                }).then(function() {
                    setTimeout(function() {
                        document.getElementById('loading').classList.remove('flex');
                        document.getElementById('loading').classList.add('hidden');
                    }, 100); // Ajusta este valor si es necesario
                    document.getElementById('croppie-modal').classList.remove('hidden');
                }).catch(function() {
                    document.getElementById('loading').classList.add('hidden');
                });
                
                croppieDemo.bind({
                    url: e.target.result
                });
            }

            initCroppie();
            // function debounce(func, delay) {
            //     let timeout;
            //     return function (...args) {
            //         const context = this;
            //         clearTimeout(timeout);
            //         timeout = setTimeout(() => func.apply(context, args), delay);
            //     };
            // }
            // Ejecuta la función cuando se redimensiona la ventana
            // window.addEventListener('resize', debounce(function() {
            //     if (croppieDemo) {
            //         initCroppie();
            //     }
            // }, 300));
            // Recortar y enviar la imagen cuando se haga clic en el botón "Recortar y Subir"
            document.getElementById('crop-btn').onclick = function () {
                croppieDemo.result({
                    type: 'blob', // Para obtener el resultado como blob
                    size: { width: 1000, height: 1000 }, // Tamaño personalizado de la imagen
                    format: 'jpg' // Puedes cambiar a 'png' si lo prefieres
                }).then(function (blob) {
                    let croppedFile = new File([blob], file.name, { type: file.type });
                    
                    dropzone.removeAllFiles(true); // Limpiar Dropzone
                    dropzone.addFile(croppedFile); // Agregar el archivo recortado a Dropzone
                    dropzone.processQueue(); // Procesar el archivo recortado
            
                    // Cerrar el modal
                    document.getElementById('croppie-modal').classList.add('hidden');
            
                    // Destruir la instancia de Croppie después de procesar
                    croppieDemo.destroy();
                    croppieDemo = null; // Resetear la variable
                    document.querySelector('.dropzone').style.display = 'flex';
                });
            };
            
        };

        reader.readAsDataURL(file);
    });

    // Cerrar el modal cuando se haga clic en "Cerrar"
    document.getElementById('close-modal-btn').addEventListener('click', function () {
        document.getElementById('croppie-modal').classList.add('hidden');
        if (croppieDemo) {
            croppieDemo.destroy();
            croppieDemo = null; // Resetear la variable
            document.querySelector('.dropzone').style.display = 'flex';
            dropzone.removeAllFiles(true);
        }
    });

    dropzone.on('sending', function (file, xhr, formData) {
        console.log(file);
    });

    dropzone.on('success', function (file, response) {
        document.querySelector('[name="imagen"]').value = response.imagen;
    });

    dropzone.on('removedfile', function () {
        document.querySelector('[name="imagen"]').value = '';
    });

    dropzone.on('error', function (file, message) {
        console.log(message);
    });
};

