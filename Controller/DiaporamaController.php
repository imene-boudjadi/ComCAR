<?php

require_once '../Model/DiaporamaModel.php';
require_once '../View/DiaporamaView.php';

class DiaporamaController {

    public function RecupererDiaporama() {
        $modelDiaporama = new DiaporamaModel();
        $r = $modelDiaporama->getDiaporama();
        return $r;
    }

    public function AfficherDiaporama() {
        $viewDiaporama = new DiaporamaView();
        $viewDiaporama->AfficherDiaporama();
    }
}

?>


