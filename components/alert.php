<?php
// Controleren op succesberichten en weergeven met SweetAlert (success meldingen)
if(isset($success_msg)){
   foreach($success_msg as $success_msg){
      echo '<script>swal("'.$success_msg.'", "" ,"success");</script>';
   }
}
// Controleren op waarschuwingsberichten en weergeven met SweetAlert (waarschuwingsmeldingen)
if(isset($warning_msg)){
   foreach($warning_msg as $warning_msg){
      echo '<script>swal("'.$warning_msg.'", "" ,"warning");</script>';
   }
}
// Controleren op informatieberichten en weergeven met SweetAlert (informatiemeldingen)
if(isset($info_msg)){
   foreach($info_msg as $success_msg){
      echo '<script>swal("'.$info_msg.'", "" ,"info");</script>';
   }
}
// Controleren op foutberichten en weergeven met SweetAlert (foutmeldingen)
if(isset($error_msg)){
   foreach($error_msg as $error_msg){
      echo '<script>swal("'.$error_msg.'", "" ,"error");</script>';
   }
}

?>