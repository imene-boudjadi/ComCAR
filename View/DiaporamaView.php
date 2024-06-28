<?php

require_once "../Controller/DiaporamaController.php";

class DiaporamaView {
    public function AfficherDiaporama() {
        echo '<link rel="stylesheet" type="text/css" href="../code.css">';
        echo '<div id="diaporama" class="diaporama" style=" display: flex; overflow: hidden;
        align-items: center;
        justify-content: center; height:100vh;width:85%; margin-top:-3%;">';
        
        $DiapoCont = new DiaporamaController();
        $ElementsDiapo = $DiapoCont->RecupererDiaporama();

        foreach ($ElementsDiapo as $element) {
            echo '<div  class="diaporama-image" style=" width : 100% ; height : 100vh;  display: flex;
            align-items: center;
            justify-content: center; margin-left:12%; ">';
            echo '<a href="' . $element['LienNewsPub'] . '" target="_blank"><img style=" width : 100% ; height : 90%; "  src="../' . $element['ImageDiapo'] . '" alt=""></a>';         // ouvrir les liens dans des nouvelles fenetres (_blank dans target)
            echo '</div>';
        }

        echo '</div>';
        echo '<script type="text/javascript" src="../JavaScript/Diaporama.js"></script>';
    }
}

?>
