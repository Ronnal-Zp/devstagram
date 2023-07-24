/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aqui tu imagen',
    acceptedFiles: '.png, .jpg, .jpeg',
    addRemoveLinks: true,
    dictRemoveFile: 'Eliminar imagen',
    dictCancelUpload: 'Cancelar subida',
    maxFiles: 1,
    uploadMultiple: false,
    init: function() {

        // Validar si la imagen ya se subio anteriormente para volver a establecerla
        if( document.querySelector('[name="imagen"]').value.trim().length > 0 ) {

            const imageUploaded = {};
            imageUploaded.size = 1000;
            imageUploaded.name = document.querySelector('[name="imagen"]').value.trim();

            // llamar al evento addedfile/thumbnail con la imagen
            this.options.addedfile.call(this, imageUploaded);
            this.options.thumbnail.call(
                this,
                imageUploaded,
                `/uploads/${imageUploaded.name}`
            );

            // agregar estilos/animaciones de subida    
            imageUploaded.previewElement.classList.add(
                'dz-success',
                'dz-complete'
            );
        }
    }
})



dropzone.on('success', function(file, response) {
    // Establecer el nombre de la imagen a subir <4107a607-4e7e-42e9-bc9c-0cb8cffef702.jpg>
    document.querySelector("[name='imagen']").value = response.imagen
})


dropzone.on('removedfile', function() {
    // Limpiar nombre de imagen
    document.querySelector("[name='imagen']").value = ''
})
