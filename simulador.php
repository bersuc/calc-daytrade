<html><head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
</head>
<center>

<body>
<style type="text/css" media="screen">
.arrow-up {
	width:0px; 
	height:0px; 
	border-left:7px solid transparent;
	border-right:7px solid transparent;
	
	border-bottom:7px solid green;
}

.arrow-down {
	width:0px; 
	height:0px; 
	border-left:7px solid transparent;
	border-right:7px solid transparent;
	
	border-top:7px solid red;
}
</style>

<?php

//Pega o valor do campo nome do formulário:
$compra = number_format($compra,2,',','');
$compra = $_POST['compra'];


//Pega o valor do campo assunto do formulário:
$venda = number_format($venda,2,',','');
$venda = $_POST['venda'];

//Pega o valor do campo assunto do formulário:
$corretagem = number_format($corretagem,2,',','');
$corretagem = $_POST['corretagem'];

//Pega o valor do campo email do formulário:
$qtd = $_POST['qtd'];

if ($compra == ""){
	exit;
};

//Pega o valor do campo email do formulário:
$corretagem = $_POST['corretagem'];

//maths
$financeirovenda = $venda * $qtd;
$financeirocompra = $compra * $qtd;
$retorno = $financeirovenda - $financeirocompra;
$percentual = $retorno / $financeirocompra;
$percentual = $percentual * 100;
$lucro = $financeirovenda - $financeirocompra - $corretagem;

//formating floating numbers
$financeirocompra = number_format($financeirocompra,2,',','');
$financeirovenda = number_format($financeirovenda,2,',','');
$lucro = number_format($lucro,2,',','');
$percentual = number_format($percentual,2,',','');

$emolumentos = $financeirocompra + $financeirovenda;
$emolumentos = $emolumentos * 0.00025;
$emolumentos = $emolumentos / 100;

$irrf2 = $lucro * 0.19;
$irrf = $lucro * 0.01;
$liquido = $lucro - $emolumentos - $irrf;

//formating floating numbers 2
$emolumentos = number_format($emolumentos,2,',','');
$retorno = number_format($retorno,2,',','');
$liquido = number_format($liquido,2,',','');
$irrf2 = number_format($irrf2,2,',','');
$irrf = number_format($irrf,2,',','');

?>


<table border="0" width="400" cellpadding="0" cellspacing="0">
<tr>
	<td colspan="2"><center><h3>Dados da operação</h3></center></td>
</tr>
<tr>
	<td>Financeiro Investido:</td>
	<td>R$ <?php print $financeirocompra ?></td>
</tr>
<tr>
	<td>Financeiro Final:</td>
	<td>R$ <?php print $financeirovenda ?></td>
</tr>


<?php
//se a operação tiver resultado positivo
if ($percentual > 0){
?>

<tr>
	<td>Lucro na Operação:</td>
	<td>
	
		<table>
			<tr>
				<td><div class="arrow-up"></div></td>
				<td><font color=green><?php print " $percentual" ?> %</font></div></td>
		</table>
	
	</td>

</tr>


<?php 
	;
} elseif ($percentual == 0) {

?>

<tr>
	<td>Lucro na Operação:</td>
	<td><font>Operação no Zero a Zero</font></td>

</tr>


<?php 
	;
} else {

?>



<tr>
	<td>Lucro na Operação:</td>
	<td>
		<table>
			<tr>
				<td><div class="arrow-down"></div></td>
				<td><font color=red><?php print " $percentual" ?> %</font></div></td>
		</table>	
	</td>

</tr>


<?php
	;
};
?>


<tr>
	<td>Lucro com corretagem:</td>
	<td>R$ <?php print  $lucro ?></td>
</tr>
<tr>
	<td>Lucro sem corretagem:</td>
	<td>R$ <?php print  $retorno ?></td>
</tr>
<tr>
	<td>Total de emolumentos: </td>
	<td>R$ <?php print  $emolumentos ?></td>
</tr>

<?php  
if ($financeirovenda > $financeirocompra) {
?>

<tr>
	<td>Imposto de renda retido na fonte:</td>
	<td>R$ <?php print $irrf ?></td>
</tr>
<tr>
	<td>Total de Imposto de Renda Devido:</td>
	<td>R$ <?php print $irrf2?></td>
</tr>
<tr height=15>
	<td></td>
	<td></td>
</tr>
<tr>
	<td>Resultado Líquido: </td>
	<td>R$ <?php print  $liquido?></td>
</tr>

<?php 
	;
} elseif ($financeirocompra == $financeirovenda)
{
?>

<tr>
	<td>Imposto de renda retido na fonte:</td>
	<td>0</td>
</tr>
<tr>
	<td>Total de Imposto de Renda Devido:</td>
	<td>0</td>
</tr>


<?php 
	;
} else
{
?>
<tr>
	<td>Imposto de renda retido na fonte:</td>
	<td>Operaçao com Prejuízo</td>
</tr>
<tr>
	<td>Total de Imposto de Renda Devido:</td>
	<td>0</td>
</tr>
<?php 
	;
};

?>
</table>
<center><br><br>
	<input type="submit" value="Voltar" onClick="history.go(-1);return true;" name="voltar"/>
</center>
<?php 
	;
?> 
<br><br><br>
<center>
  <font color="#666666" size=2><em>Informamos que esse sistema deverá ser usado somente como demonstração, <br>
    pois é de caráter experimental e não garantimos informações 100% corretas. Informações calculadas com base em operação daytrade</em>.</font>
</center>
</body>
</html>