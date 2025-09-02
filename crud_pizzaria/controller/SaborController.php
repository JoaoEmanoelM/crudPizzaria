<?php
require_once(__DIR__ . '/../model/Sabor.php');
require_once(__DIR__ . '/../dao/SaborDAO.php');

class SaborController {
    private ?Sabor $sabor;
    private ?SaborDAO $saborDAO;

    public function __construct(){
        $this->sabor = new Sabor();
        $this->saborDAO = new SaborDAO();
    }

    public function listar(){

        return $this->saborDAO->listar();

    }

    public function criaSelectForm($dados) {

    
    $qtdSabores = $dados['qtdSabores'] ?? 1;

    $sabores = $this->listar();
    if (!is_array($sabores)) $sabores = []; 

    $html = "";

    for ($i = 1; $i <= $qtdSabores; $i++) {

        $html .= "<label for='sabor{$i}'>{$i}º sabor</label>";
        $html .= "<select name='sabor{$i}' id='sabor{$i}'>";

        foreach ($sabores as $s) {
            
            $nome = $s->getNome();
            $id = $s->getId();
            $html .= "<option value='{$id}'>{$nome}</option>";
        }

        $html .= "</select><br>";
    }

    echo $html;
}

}
?>