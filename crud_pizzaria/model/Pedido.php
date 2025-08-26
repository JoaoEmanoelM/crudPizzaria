<?php

class Pedido {
	private ?int $id;
	private ?string $sabor1;
	private ?string $sabor2;
	private ?string $sabor3;
	private ?string $tamanho;
	private ?string $endereco;
	private ?string $telefoneCliente;
	private ?string $metodoPagamento;
	private ?int $id_atendente;
	private ?int $id_entregador;
	private ?int $id_sabor;

	function getId(){
		return $this->id;
	}
	function setId($id){
		$this->id=$id;
	}
	function getSabor1(){
		return $this->sabor1;
	}
	function setSabor1($sabor1){
		$this->sabor1=$sabor1;
	}
	function getSabor2(){
		return $this->sabor2;
	}
	function setSabor2($sabor2){
		$this->sabor2=$sabor2;
	}
	function getSabor3(){
		return $this->sabor3;
	}
	function setSabor3($sabor3){
		$this->sabor3=$sabor3;
	}
	function getTamanho(){
		return $this->tamanho;
	}
	function setTamanho($tamanho){
		$this->tamanho=$tamanho;
	}
	function getEndereco(){
		return $this->endereco;
	}
	function setEndereco($endereco){
		$this->endereco=$endereco;
	}
	function getTelefoneCliente(){
		return $this->telefoneCliente;
	}
	function setTelefoneCliente($telefoneCliente){
		$this->telefoneCliente=$telefoneCliente;
	}
	function getMetodoPagamento(){
		return $this->metodoPagamento;
	}
	function setMetodoPagamento($metodoPagamento){
		$this->metodoPagamento=$metodoPagamento;
	}
	function getId_atendente(){
		return $this->id_atendente;
	}
	function setId_atendente($id_atendente){
		$this->id_atendente=$id_atendente;
	}
	function getId_entregador(){
		return $this->id_entregador;
	}
	function setId_entregador($id_entregador){
		$this->id_entregador=$id_entregador;
	}
	function getId_sabor(){
		return $this->id_sabor;
	}
	function setId_sabor($id_sabor){
		$this->id_sabor=$id_sabor;
	}

}
?>