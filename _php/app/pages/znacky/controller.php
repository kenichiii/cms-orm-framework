<?php

    $zngrid = new Znacky_Grid();
    $znacky = $zngrid->setDeletedCond()
            ->where(' and active=1')
            ->orderBy('h1 ASC')
            ->getData()
         ;
