<?php
class Entregador {
	private ?int $id;
	private ?string  $nome;
	private ?string $endereco;
	private ?string $telefone;
	private ?int $salarioBase;
	private ?int $comissao;
	private ?string $placaMoto;
	private ?string $modeloMoto;

	function getId(){
		return $this->id;
	}
	function setId($id){
		$this->id=$id;
	}
	function getNome(){
		return $this->nome;
	}
	function setNome($nome){
		$this->nome=$nome;
	}
	function getEndereco(){
		return $this->endereco;
	}
	function setEndereco($endereco){
		$this->endereco=$endereco;
	}
	function getTelefone(){
		return $this->telefone;
	}
	function setTelefone($telefone){
		$this->telefone=$telefone;
	}
	function getSalarioBase(){
		return $this->salarioBase;
	}
	function setSalarioBase($salarioBase){
		$this->salarioBase=$salarioBase;
	}
	function getComissao(){
		return $this->comissao;
	}
	function setComissao($comissao){
		$this->comissao=$comissao;
	}
	function getPlacaMoto(){
		return $this->placaMoto;
	}
	function setPlacaMoto($placaMoto){
		$this->placaMoto=$placaMoto;
	}
	function getModeloMoto(){
		return $this->modeloMoto;
	}
	function setModeloMoto($modeloMoto){
		$this->modeloMoto=$modeloMoto;
	}

}
?>