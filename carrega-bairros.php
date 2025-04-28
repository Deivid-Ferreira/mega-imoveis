<?php
	include ('f/conf/config.php');

	if($_GET['codCidade'] != ""){

		$codCidade = $_GET['codCidade'];
?>
	<div class="bairro-busca">
		<p class="campo-select">	
			<select class="select2 form-control campo" id="idSelect2" name="bairro[]" multiple="" style="width:240px; display: none;">
				<optgroup label="Selecione os bairros">

<?php
		$sql = "SELECT DISTINCT B.* FROM bairros B inner join imoveis I on B.codBairro = I.codBairro WHERE B.statusBairro = 'T' and I.statusImovel = 'T' and I.codCidade = ".$codCidade." ORDER BY B.nomeBairro ASC";
		$result = $conn->query($sql);
		while($dadosBairro = $result->fetch_assoc()){
?>
					<option value="<?php echo $dadosBairro['codBairro'];?>"><?php echo $dadosBairro['nomeBairro'];?></option>	
<?php
		}
?>
			</select>
		</p>
	</div>
	<script>
		var $rf = jQuery.noConflict();
		$rf(".select2").select2({
			placeholder: "Selecione...",
			multiple: true,
			allowClear: true						
		});				
	</script>
<?php
	}else{
?>
	<div class="bairro-busca">
		<p class="campo-select">	
			<select class="select2 form-control campo" id="idSelect2" name="bairro[]" multiple="" style="width:240px; display: none;">
				<optgroup label="Selecione os bairros">

<?php
		$sql = "SELECT DISTINCT B.* FROM bairros B inner join imoveis I on B.codBairro = I.codBairro WHERE B.statusBairro = 'T' and I.statusImovel = 'T' ORDER BY B.nomeBairro ASC";
		$result = $conn->query($sql);
		while($dadosBairro = $result->fetch_assoc()){
?>
					<option value="<?php echo $dadosBairro['codBairro'];?>"><?php echo $dadosBairro['nomeBairro'];?></option>	
<?php
		}
?>
			</select>
		</p>
	</div>
	<script>
		var $rf = jQuery.noConflict();
		$rf(".select2").select2({
			placeholder: "Selecione...",
			multiple: true,
			allowClear: true						
		});				
	</script>
<?php		
	}
?>
