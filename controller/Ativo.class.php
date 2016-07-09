<?php

namespace app\controller;
/**
 * Description of Ativo
 *
 * @author thiago
 */
class Ativo extends \stphp\Controller {
  
  public function getAtivo($codigo_ativo){
    $preco_dao = new \app\model\PrecoDAO();
    $rs = $preco_dao->precaoAtivo($codigo_ativo);
    return $rs;
  }
  
  
  public function simularIFR(){
    
    //$dados = $this->getAtivo("ABEV3");
    //$dados = $this->getAtivo("LAME4");
    $dados = $this->getAtivo("LAME4");
    
    $carteira = new \app\model\Carteira();
    
    $ifr = new \app\setup\SetupIFR(30, 80);
    $simulador = new \app\simulador\Simulador($ifr, $carteira);
    $simulador->backTest($dados);
    $resultado = $simulador->getResultados();

    $resposta = new \app\view\RespostaJson();
    
    foreach ($resultado as $trade) {
      $resposta->addContent($trade, true);
    }
    
    
    
    
    //$resposta->addArray($resultado);
    return $resposta;

  }
  
}
