<?php

echo AppUser::getIns()->getFullname()->getWholeName().' ('.AppUser::getIns()->getEmail()->getValue().')';

?>
