$(document).ready(function() {
    $('#FormCarrera').bootstrapValidator({
        fields: {
            /*
             * Nombre (s)
             * Requerido
             * Letras
             * Rango (2,64)
             */
            Nombre: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        min: 2,
                        max: 64,
                        message: 'Campo longitud Min(4) Max (64) caracteres.'
                    },
                    regexp: {
                        regexp: /^([A-Za-zÑñáéíóúÁÉÍÓÚ ]+)$/,
                        message: 'Campo con caracteres invalidos.'
                    },
                    // Crear un request Ajax
                    // se envia { Nombre: 'el valor' } para validarlo
                    remote: {
                        message: 'Registro ya existe.',
                        type: 'POST',
                        url: ROOT + 'carrera/_comprobarNombre/',
                        data: function (validator) {
                            return {
                                Id: validator.getFieldElements('Id').val()
                            };
                        }
                    }
                }
            },
            /*
             * siglas
             * Requerido
             * Letras
             * Rango (3,4)
             */
            Siglas: {
                message: 'El Campo invalido.',
                validators: {
                    notEmpty: {
                        message: 'Campo requerido.'
                    },
                    stringLength: {
                        min: 3,
                        message: 'Campo longitud Min(3) caracteres.'
                    },
                    regexp: {
                        regexp: /^([A-Z]+)$/,
                        message: 'Campo con caracteres invalidos.'
                    }
                }
            }
        }
    });
});

