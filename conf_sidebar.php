<?php
include "config.php";



while ($row = $tables->fetch_all()){
    foreach ($row as $item) {
        $scroll = "";
        if(strlen($item[0]) >= 18){
            $scroll = "scroll-text";
        }else{
            $scroll="";
        };

        echo  '<li class="nav-item menu-items">
                        <a class="nav-link "  href="controller.php?table='.$item[0].'">
                          <span class="menu-icon">
                            <i class="mdi mdi-table-large"></i>
                          </span>
                            <span class="menu-title" id="scroll-container"  style="width: 150px !important; overflow: hidden;" ><p class="pt-3" style="" id="'.$scroll.'">'.$item[0].'</p></span>
                        </a>
                    </li>';
    }
}