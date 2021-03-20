<?php 

//NOTE MODAL QUE ENS MOSTRARA SI HA SIGUT REGISTRAT A LA BASE DE DADES
$modal_register = "
<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
<div class='modal-dialog' role='document'>
<div class='modal-content'>
    <div class='modal-header'>
    <h5 class='modal-title' id='exampleModalLabel'>Registrat<i style='color: rgb(63, 231, 63);
    margin-left: 3px; 
    font-size: 26px;' class='fas fa-check-circle'></i></h5>
    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    </div>
    <div class='modal-body '>
    El teu usuari ha sigut registrat a Imaginest, ara rebras un correo de verificació per poder fer LogIN.
    </div>
    <div class='modal-footer'>
    <button type='button' class='btn btn-outline-success' id='tancar' data-dismiss='modal'>Tancar</button>
    </div>
</div>
</div>
</div>";

//NOTE MODAL QUE ENS MOSTRARA EN CAS DE QUE HAGI SIGUT VERIFICAT LA COMPTE
$modal_verificat = "
<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
<div class='modal-dialog' role='document'>
<div class='modal-content'>
    <div class='modal-header'>
    <h5 class='modal-title'  id='exampleModalLabel'>VERIFICAT<i style='color: rgb(63, 231, 63);
    margin-left: 3px; 
    font-size: 26px;' class='fas fa-check-circle'></i></h5>
    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    </div>
    <div class='modal-body '>
    El teu usuari ha sigut verificat ara pots accedir a Imaginest amb la teva compte.
    </div>
    <div class='modal-footer'>
    <button type='button' class='btn btn-outline-success' id='tancar' data-dismiss='modal'>Tancar</button>
    </div>
</div>
</div>
</div>";


//NOTE MODAL D'ERROR QUE ES MOSTRARA SI NO S'HA POGUT VERIFICAR LA COMPTE 
$modal_error = "
<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
<div class='modal-dialog' role='document'>
<div class='modal-content'>
    <div class='modal-header'>
    <h5 class='modal-title' style='color: rgb(255,0,0); id='exampleModalLabel'>ERROR VERIFICACIÓ<i style='color: rgb(255,0,0);
    margin-left: 3px; 
    font-size: 26px;' class='fas fa-exclamation-circle'></i></h5>
    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    </div>
    <div class='modal-body '>
    Ha hagut un error de verificació de la compte.
    </div>
    <div class='modal-footer'>
    <button type='button' class='btn btn-outline-danger' id='tancar' data-dismiss='modal'>Tancar</button>
    </div>
</div>
</div>
</div>";

//NOTE MODAL QUE ES MOSTRARA EN CAS DE QUE HI HAGI UN ERROR A L'HORA DE CANVIAR LA CONTRASENYA
$modal_error_reset = "
<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
<div class='modal-dialog' role='document'>
<div class='modal-content'>
    <div class='modal-header'>
    <h5 class='modal-title' style='color: rgb(255,0,0); id='exampleModalLabel'>ERROR AL CANVIAR CONTRASENYA<i style='color: rgb(255,0,0);
    margin-left: 3px; 
    font-size: 26px;' class='fas fa-exclamation-circle'></i></h5>
    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    </div>
    <div class='modal-body '>
    Ha hagut un error per canviar la contrasenya, torna a sol·licitar el canvi de contrasenya.
    </div>
    <div class='modal-footer'>
    <button type='button' class='btn btn-outline-danger' id='tancar' data-dismiss='modal'>Tancar</button>
    </div>
</div>
</div>
</div>";

//NOTE MODAL ON ES PODRA POSAR EL CORREO O USUARI PER CANVIAR LA COTRASENYA
$modal_reset = "
<div id='pwdModal' class='modal fade' tabindex='-1' role='dialog' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>Resetejar contrasenya</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>
        <form>
          <div class='form-group'>
            <label for='recipient-name' class='col-form-label'>Correo o Username:</label>
            <input type='text' name='reset_usermail' class='form-control' id='recipient-name'>
          </div>
        </form>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-outline-warning' data-dismiss='modal'>Tancar</button>
        <button type='submit' class='btn btn-outline-primary'>Envia el correo o username</button>
      </div>
    </div>
  </div>
</div>";


//NOTE MODAL QUE ENS DIRA QUE LA CONTRASENYA S'HA CANVIAT I REBREM UN CORREO QUE ENS HO CONFIRMARA.
$modal_canviat = "
<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
<div class='modal-dialog' role='document'>
<div class='modal-content'>
    <div class='modal-header'>
    <h5 class='modal-title' id='exampleModalLabel'>CONTRASENYA CANVIADA<i style='color: rgb(63, 231, 63);
    margin-left: 3px; 
    font-size: 26px;' class='fas fa-check-circle'></i></h5>
    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    </div>
    <div class='modal-body '>
    La contrasenya de la teva compte ha sigut canviada correctament. Rebràs un correu verificant el canvi.
    </div>
    <div class='modal-footer'>
    <button type='button' class='btn btn-outline-success' id='tancar' data-dismiss='modal'>Tancar</button>
    </div>
</div>
</div>
</div>";

//NOTE MODAL QUE ENS MOSTRARA QUE S'HA ENVIAT UN CORREO PER CANVIAR LA CONTRASENYA
$modal_correu_enviat = "
<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
<div class='modal-dialog' role='document'>
<div class='modal-content'>
    <div class='modal-header'>
    <h5 class='modal-title' id='exampleModalLabel'>CORREU RESET CONTRASENYA<i style='color: rgb(63, 231, 63);
    margin-left: 3px; 
    font-size: 26px;' class='fas fa-check-circle'></i></h5>
    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    </div>
    <div class='modal-body '>
    En breu rebrà un correu amb un link per poder efectuar el canvi de contrasenya.
    </div>
    <div class='modal-footer'>
    <button type='button' class='btn btn-outline-success' id='tancar' data-dismiss='modal'>Tancar</button>
    </div>
</div>
</div>
</div>";