<?php

# NOVEDAD 16
if($hora!='07:00'){ pointer(170,$gridTop);click_left();wapi_sendkeys(16);
}

# MODIFICAR HORARIO
pointer(420,$gridTop);click_left();wapi_sendkeys($hora);

# JUSTIFICAR
pointer(480,$gridTop);click_left();wapi_sendkeys('justificado');
pointer(560,$gridTop);click_left();wapi_sendkeys('r');

?>