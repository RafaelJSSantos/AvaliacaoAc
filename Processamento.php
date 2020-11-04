<?php
require_once __DIR__.'/Conexao.php';
$Conexao = new Conexao();

if ($_POST['Acao'] == 'EditarProduto'){
	if (empty($_POST['Descricao'])) {
		echo "Descrição inválida.";
		return;
	} else if (empty($_POST['IdProduto'])) {
		echo "Produto inválido.";
		return;
	} else if (empty($_POST['Valor'])) {
		echo "Valor não pode ser nulo.";
		return;
	} else if (empty($_POST['Quantidade'])) {
		echo "Estoque não pode ser nulo.";
		return;
	} else if (empty($_POST['CodBarra'])) {
		echo "Codigo de barra não pode ser nulo.";
		return;
	} else {

		$sSql = "UPDATE Produto
				    SET Quantidade = '{$_POST['Quantidade']}',
				    	Descricao = '{$_POST['Descricao']}',
				    	CodBarra = '{$_POST['CodBarra']}',
				    	Valor = '{$_POST['Valor']}' 
				  WHERE IdProduto = {$_POST['IdProduto']}";
		$Conexao->setConexao();
		$qQry = $Conexao->query($sSql);
		$Conexao->closeConexao();
		echo "Salvo";
		return;
	}

} else if ($_POST['Acao'] == 'ExcluirProduto'){
	$sSql = "UPDATE Produto
			    SET Excluido = 'S'
			  WHERE IdProduto = {$_POST['IdProduto']}";
	$Conexao->setConexao();
	$qQry = $Conexao->query($sSql);
	$Conexao->closeConexao();
	echo "Salvo";
	return;

} else if ($_POST['Acao'] == 'DesExcluirProduto'){
	$sSql = "UPDATE Produto
			    SET Excluido = 'N'
			  WHERE IdProduto = {$_POST['IdProduto']}";
	$Conexao->setConexao();
	$qQry = $Conexao->query($sSql);
	$Conexao->closeConexao();
	echo "Salvo";
	return;
	
} else if ($_POST['Acao'] == 'AdicionarProduto'){
	if (empty($_POST['Descricao'])) {
		echo "Descrição inválida.";
		return;
	} else if (empty($_POST['Valor'])) {
		echo "Valor não pode ser nulo.";
		return;
	} else if (empty($_POST['Quantidade'])) {
		echo "Quantidade não pode ser nula.";
		return;
	} else if (empty($_POST['CodBarra'])) {
		echo "Codigo de barra não pode ser nulo.";
		return;
	} else {

		$sSql = "INSERT INTO Produto (Descricao, Valor, Quantidade, CodBarra)
					  VALUES ({$_POST['Descricao']}, {$_POST['Valor']}, {$_POST['Quantidade']}, {$_POST['CodBarra']})";
		$Conexao->setConexao();
		$qQry = $Conexao->query($sSql);
		$Conexao->closeConexao();
		echo "Salvo";
		return;
	}

} else if ($_POST['Acao'] == 'CarregaValorProduto'){
	$sSql = "SELECT *
			   FROM Produto 
			  WHERE IdProduto = {$_POST['IdProduto']}";
	$Conexao->setConexao();
	$qQry = $Conexao->query($sSql);
	$aProduto = $Conexao->getArrayResults($qQry);
	$Conexao->closeConexao();
	print_r($aProduto[0]['Valor']);

} else if ($_POST['Acao'] == 'AdicionarVenda'){
	if (empty($_POST['IdProduto'])) {
		echo "Selecione um produto.";
		return;
	} else if (empty($_POST['Valor'])) {
		echo "Valor inválido.";
		return;
	} else if (empty($_POST['Quantidade'])) {
		echo "Quantidade inválida.";
		return;
	} else {

		$Conexao->setConexao();
		$sSql = "SELECT *
				   FROM Produto 
				  WHERE IdProduto = {$_POST['IdProduto']}";
		$qQry = $Conexao->query($sSql);
		$aProduto = $Conexao->getArrayResults($qQry);
		$iQtd = $aProduto[0]['Quantidade'];

		if ($iQtd < $_POST['Quantidade']) {
			echo "Quantidade em estoque insuficiente para a venda.";
			return;
		}

		$sSql = "INSERT INTO Venda (IdProduto, Valor, Quantidade, Data)
		VALUES ({$_POST['IdProduto']}, {$_POST['Valor']}, {$_POST['Quantidade']}, NOW())";
		$qQry = $Conexao->query($sSql);

		$iQtdNova = $iQtd - $_POST['Quantidade'];
		$sSql = "UPDATE Produto
					SET Quantidade = '{$iQtdNova}'
				  WHERE IdProduto = {$_POST['IdProduto']}";
		$qQry = $Conexao->query($sSql);

		if (isset($_POST['AtualizaProdutoValor'])) {
			$sSql = "UPDATE Produto
						SET Valor = '{$_POST['Valor']}'
					  WHERE IdProduto = {$_POST['IdProduto']}";
			$qQry = $Conexao->query($sSql);
		}

		$Conexao->closeConexao();
		echo "Salvo";
		return;
	}

} else {
	print_r($_POST);
}

