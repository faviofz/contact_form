<?php

require_once "functions.php";

$aErrores = array();
$aMensajes = array();
$patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";


if (!empty($_POST)) {
    print_r($_POST);

    // Comprobando datos requiridos
    if (isset($_POST['nombre']) && isset($_POST['email'])) {
        // Nombre:
        if (empty($_POST['nombre'])) {
            $aErrores[] = "Debe ingresar un nombre";
        } else {
            // Comprueba mediante una expresion regular, que sólo contenga letras y espacios
            if (preg_match($patron_texto, $_POST['nombre'])) {
                $aMensajes[] = "Nombre: {$_POST['nombre']}";
            } else {
                $aErrores[] = "El nombre sólo puede contener letras y espacios";
            }
        }

        // Email:
        if (empty($_POST['email'])) {
            $aErrores[] = "Debe ingresar un email";
        } else {
            // Comprueba si se ingresó un email válido
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $aMensajes[] = "Email: {$_POST['email']}";
            } else {
                $aErrores[] = "Ingrese un email válido";
            }
        }

        // Telefono/Celular
        if (isset($_POST['tel-num']) && !empty($_POST['tel-num'])) {
            if (is_numeric($_POST['tel-num'])) {
                $aMensajes[] = "Teléfono/Celular: {$_POST['tel-num']}";
            } else {
                $aErrores[] = "El campo Teléfono/Celular debe contener números";
            }
        }

        if (isset($_POST['mensaje']) && !empty($_POST['mensaje'])) {
            if (preg_match("/\w/", $_POST['mensaje'])) {
                $aMensajes[] = "Mensaje: {$_POST['mensaje']}";
            } else {
                $aErrores[] = "El campo Mensaje solo debe contener letras y numeros";
            }
        }
    } else {
        echo "<p>No se han completado los datos requeridos</p>";
    }

    if (count($aErrores)) {
        var_dump($aErrores);
    } else {
        var_dump($aMensajes);
        send_mail($_POST['nombre'], $_POST['email'], $_POST['mensaje']);
    }
} else {
    echo "<p>No se ha enviado el formulario</p>";
}
