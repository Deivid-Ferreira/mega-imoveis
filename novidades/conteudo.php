						<div id="conteudo-interno">
							<div id="bloco-titulo">	
								<p class="titulo">NOVIDADES</p>
							</div>
							<div id="conteudo-blog">
								<div id="mostra-blog"  class="wow animate__animated animate__fadeIn">
<?php
	$sqlConta = "SELECT * FROM blog N inner join blogImagens NI on N.codBlog = NI.codBlog WHERE N.statusBlog = 'T' and N.dataProBlog <= '".date('Y-m-d')." ".date('H:i:s')."'";
	$resultConta = $conn->query($sqlConta);
	$dadosConta = $resultConta->fetch_assoc();
	$registros = mysqli_num_rows($resultConta);
	
	if($url[3] == 1 || $url[3] == ""){
		$pagina = 1;
		$sqlBlog = "SELECT DISTINCT N.* FROM blog N inner join blogImagens NI on N.codBlog = NI.codBlog WHERE statusBlog = 'T' and N.dataProBlog <= '".date('Y-m-d')." ".date('H:i:s')."' ORDER BY N.dataBlog DESC, N.codBlog DESC LIMIT 0,12";
	}else{
		$pagina = $url[3];
		$paginaFinal = $pagina * 12;
		$paginaInicial = $paginaFinal - 12;
		$sqlBlog = "SELECT DISTINCT N.* FROM blog N inner join blogImagens NI on N.codBlog = NI.codBlog WHERE statusBlog = 'T' and N.dataProBlog <= '".date('Y-m-d')." ".date('H:i:s')."' ORDER BY N.dataBlog DESC, N.codBlog DESC LIMIT ".$paginaInicial.",12";
	}

	$cont = 0;
	$cont2 = 0;
	
	$resultBlog = $conn->query($sqlBlog);
	while($dadosBlog = $resultBlog->fetch_assoc()){

		$mostrando = $mostrando + 1;

		$cont++;
		$cont2++;
				
		$sqlImagem = "SELECT * FROM blogImagens WHERE codBlog = ".$dadosBlog['codBlog']." ORDER BY capaBlogImagem ASC, codBlogImagem ASC LIMIT 0,1";
		$resultImagem = $conn->query($sqlImagem);
		$dadosImagem = $resultImagem->fetch_assoc();

		if($cont == 3){
			$cont = 0;
			$margin = "margin-right:0px;";
		}else{

			$margin = " margin-right:40px;";
		}			
?>
									<div id="bloco-blog">
										<a title="<?php echo $dadosBlog['nomeBlog']; ?>" href="<?php echo $configUrl . 'novidades/' . $dadosBlog['codBlog'] . '-' . $dadosBlog['urlBlog'] . '/'; ?>">
											<p class="imagem" style="background:transparent url('<?php echo $configUrlGer . 'f/blog/' . $dadosImagem['codBlog'] . '-' . $dadosImagem['codBlogImagem'] . '-O.'.$dadosImagem['extBlogImagem']; ?>') center top no-repeat; background-size:cover, 100%;">
												<div id="fundo">
													<div class="bloco-nome">
														<p class="nome"><?php echo $dadosBlog['nomeBlog']; ?></p>
													</div>
													<div class="bloco-descricao">
														<p class="descricao"><?php echo strip_tags($dadosBlog['descricaoBlog']); ?></p>
													</div>
													<div id="fundo-confira">
														<p class="confira">Ler mais<img src="<?php echo $configUrl . 'f/i/quebrado/seta-confira.svg'; ?>" width="15" alt=""></p>
													</div>
												</div>
											</p>
										</a>
									</div>
<?php		
	}
?>		
								<br class="clear"/>
								</div>
							</div>
<?php
	if($cont2 == 0){
?>							
							<p class="embreve" style="font-size: 16px; font-weight: bold; text-align: center; color: #132B51; padding-top: 159px;">Em Breve</p>
<?php
	}
?>
<?php
if($cont2 == 1){
	$regPorPagina = 12;
	$area = "blog";
	include ('f/conf/paginacao.php');
}
?>								
							
						</div>
