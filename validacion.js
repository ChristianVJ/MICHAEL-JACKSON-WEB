
////////////////////////////////////////////////////////////////////////
//////////////////////////// INICIAR SESIÓN ////////////////////////////
////////////////////////////////////////////////////////////////////////

function comprueba_iniciar_sesion(f)
{

    var msn = '';
    if (f.usuario.value === '')
        msn += 'El nombre de usuario en blanco\n';
    else if (f.usuario.value.length > 20)
        msn += 'El nombre de usuario solo permite 20 caracteres\n';

    if (f.clave.value === '')
        msn += 'Contraseña en blanco\n';
    else if (f.clave.value.length > 20)
        msn += 'Contraseña solo permite 20 caracteres\n';

    if (msn !== '')
    {
        alert(msn);
        return false;
    }
    return true;
}

////////////////////////////////////////////////////////////////////////
//////////////////////////// EDITAR PRECIO ////////////////////////////
////////////////////////////////////////////////////////////////////////

function comprueba_editar_precio(f)
{
    var msn = '';

    if (f.nuevo_precio.value === '')
        msn += 'El precio está en blanco.\n';
    else if (f.nuevo_precio.value.length > 5)
        msn += 'El precio no admite más de 5 cifras.\n';
    else if (!/^([0-9])*[.]?[0-9]*$/.test(f.nuevo_precio.value))
        msn += 'El precio debe ser numérico.\n';

        if (msn !== '')
        {
            alert(msn);
            return false;
        }
        return true;
    }


//////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////// EMAIL ////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

function validarEmail(email)
{
    var aux  = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
    if (!aux.test(email)) {
        return false;
    }
    return true;
}
