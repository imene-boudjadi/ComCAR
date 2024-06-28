<?php

require_once "../Controller/MenuController.php";

class MenuView {

    public function AfficherMenu() {
        echo '<div>';
        echo '<link rel="stylesheet" type="text/css" href="../code.css">';
        // echo '<div style="margin-top:3%;">';
        echo '<ul class="menuUser" style="list-style-type: none;  padding: 0;overflow: hidden;  background-color: #333333; width: 75%; margin-top:0%;  margin-left: 10%;">';
        $MenuCont = new MenuController();
        $ElementsMenu = $MenuCont->RecupererElementsMenu();
        foreach ($ElementsMenu as $ElementMenu) {
            echo '<li style="float: left;"><a href="../routers/' . $ElementMenu['NomElement'] . '.php">' . $ElementMenu['NomElement'] . '</a></li>';        }
        echo '<style>
                .menuUser li a{display: block; color: white;text-align: center;text-decoration: none;padding: 13px 35.5px;}
                .menuUser li a:hover { color: #333333; background-color: #DCDCDC;} 
            </style>';
        echo '</ul>';
        echo '</div>';
    }

    public function AfficherPiedPage() {
        echo '<div>';
        echo '<footer>';
        echo '<ul style="list-style: none; margin-left: 10%; margin-bottom: -4%;">';
        $MenuCont = new MenuController();
        $ElementsMenu = $MenuCont->RecupererElementsMenu();
        foreach ($ElementsMenu as $ElementMenu) {
            echo '<li style="display: inline-block; margin-right: 8px; margin-top:50px;"><a style="color:#333333;padding: 10px 30px;" href="../routers/' . $ElementMenu['NomElement'] . '.php">' . $ElementMenu['NomElement'] . '</a></li>';
        }
        echo '</ul>';
        echo '</footer>';
        echo '</div>';
    }

}
?>
