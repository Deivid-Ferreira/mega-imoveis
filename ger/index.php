<?php
ob_start();
session_start();

date_default_timezone_set('America/Sao_Paulo');


include ('f/conf/config.php');
include ('f/conf/functions.php');
include ('f/conf/controleAcesso.php');

if($_COOKIE['loginAprovado'.$cookie] != ""){
 
if($controleUsuario == "tem usuario"){

$url = explode("/", $_SERVER['REQUEST_URI']);

	if($url[10] != ""){
		$arquivoRetornar = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/'.$url[9].'/'.$url[10].'/';
		
		if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/'.$url[9].'/'.$url[10].'/conteudo.php')){
			$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/'.$url[9].'/'.$url[10].'/conteudo.php';
		}else
			if(is_numeric($url[10])){
				if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'/'.$url[9].'.php')){
					$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'/'.$url[9].'.php';
				}else
					if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'/conteudo.php')){
						$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'/conteudo.php';
					}
			}else
				if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/detalhes.php')){
					$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/detalhes.php';
				}else
					if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php')){
						$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php';
					}else
						if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'.php')){
							$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'.php';
						}
					
	}else		
		if($url[9] != ""){
			$arquivoRetornar = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/'.$url[9].'/';
			
			if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/'.$url[9].'/conteudo.php')){
				$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/'.$url[9].'/conteudo.php';
			}else
				if(is_numeric($url[9])){
					if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[8].'.php')){
						$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[8].'.php';
					}else
						if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'/conteudo.php')){
							$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'/conteudo.php';
						}
				}else
					if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/detalhes.php')){
						$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/detalhes.php';
					}else
						if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php')){
							$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php';
						}else
							if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'.php')){
								$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'.php';
							}
						
		}else		
			if($url[8] != ""){
								
				$arquivoRetornar = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/';
				
				if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/conteudo.php')){
					$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'/conteudo.php';
				}else
					if(is_numeric($url[8])){
						if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php')){
							$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php';
						}else
							if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'.php')){
								$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[7].'.php';
							}
					}else
						if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php')){
							$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php';
						}else
							if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php')){
								$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php';
							}else
								if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'.php')){
									$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/'.$url[8].'.php';
								}
							
 			}else		
				if($url[7] != ""){
															
					$arquivoRetornar = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/';

					if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/conteudo.php')){
						$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'/conteudo.php';
					}else
						if(is_numeric($url[7])){
							if($url[4] == "cheques"){
								if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php')){
									$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php';
								}
							}else
							if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'.php')){
								$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'.php';
							}else								
								if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php')){
									$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php';
								}
						}else
							if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php')){
								$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/detalhes.php';
							}else
								if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/detalhes.php')){
									$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/detalhes.php';
								}else
									if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'.php')){
										$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/'.$url[7].'.php';
									}
				}else		
					if($url[6] != ""){
						$arquivoRetornar = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/';


						if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/conteudo.php')){
							$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'/conteudo.php';
						}else
							if(is_numeric($url[6])){
								if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'.php')){
									$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'.php';
								}else
									if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/conteudo.php')){
										$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/conteudo.php';
									}else
									if(file_exists($url[3].'/'.$url[5].'/conteudo.php')){
										$arquivo = $url[3].'/'.$url[5].'/conteudo.php';
									}else
									if(file_exists($url[3].'/'.$url[4].'.php')){
										$arquivo = $url[3].'/'.$url[4].'.php';
									}else
										if(file_exists('administrativo/contratos/consultas/conteudo.php')){
											$arquivo = 'administrativo/contratos/consultas/conteudo.php';
										}else
											if(file_exists($url[3].'/'.$url[4].'/detalhes.php')){
												$arquivo = $url[3].'/'.$url[4].'/detalhes.php';
											}
							}else
								if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/detalhes.php')){
									$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/detalhes.php';
								}else
									if(file_exists($url[3].'/'.$url[4].'/detalhes.php')){
										$arquivo = $url[3].'/'.$url[4].'/detalhes.php';
									}else
										if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php')){
											$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/'.$url[6].'.php';
										}else
											if(file_exists($url[3].'/dados-registro/detalhes.php')){
												$arquivo = $url[3].'/dados-registro/detalhes.php';
											}
										
					}else
						if($url[5] != ""){
							$arquivoRetornar = $url[3].'/'.$url[4].'/'.$url[5].'/';


							if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/conteudo.php')){
								$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/conteudo.php';
							}else
								if(is_numeric($url[5])){
									if(file_exists($url[3].'/'.$url[4].'/conteudo.php')){
										$arquivo = $url[3].'/'.$url[4].'/conteudo.php';
									}else
										if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'.php')){
											$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'.php';
										}else
											if(file_exists($url[3].'/detalhes.php')){
												$arquivo = $url[3].'/detalhes.php';
											}else
												if(file_exists($url[2].'/detalhes.php')){
													$arquivo = $url[2].'/detalhes.php';
												}
								}else
									if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'/detalhes.php')){
										$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'/detalhes.php';
									}else
										if(file_exists($url[3].'/dados-registro/detalhes.php')){
											$arquivo = $url[3].'/dados-registro/detalhes.php';
										}else
											if(file_exists($url[3].'/detalhes.php')){
												$arquivo = $url[3].'/detalhes.php';
											}else
												if(file_exists($url[3].'/'.$url[4].'/'.$url[5].'.php')){
													$arquivo = $url[3].'/'.$url[4].'/'.$url[5].'.php';
												}else
												if(file_exists($url[2].'/dados-produto.php')){
													$arquivo = $url[2].'/dados-produto.php';
												}
						}else		
							if($url[4] != ""){
								$arquivoRetornar = $url[3].'/'.$url[4].'/';


								if($url[4] == "financeiro-geral"){
									$arquivo = $url[3].'/financeiros-geral/conteudo.php';
								}else
								if(file_exists($url[3].'/'.$url[4].'/conteudo.php')){
									$arquivo = $url[3].'/'.$url[4].'/conteudo.php';
								}else
									if(is_numeric($url[4])){
										if(file_exists($url[3].'/conteudo.php')){
											$arquivo = $url[3].'/conteudo.php';
										}else
											if(file_exists($url[2].'/detalhes.php')){
												$arquivo = $url[2].'/detalhes.php';
											}
											
									}else
										if(file_exists($url[3].'/'.$url[4].'.php')){
											$arquivo = $url[3].'/'.$url[4].'.php';
										}else
											if(file_exists($url[2].'/detalhes.php')){
													$arquivo = $url[2].'/detalhes.php';
											}else
												if(file_exists($url[2].'/detalhes.php')){
													$arquivo = $url[2].'/detalhes.php';
												}else
													if(file_exists($url[3].'/'.$url[4].'.php')){
														$arquivo = $url[3].'/'.$url[4].'.php';
													}
										
								}else
									if($url[3] != ""){
									$arquivoRetornar = $url[3].'/';
									
											if(file_exists($url[3].'/conteudo.php')){
												$arquivo = $url[3].'/conteudo.php';
											}else
												if(file_exists($url[3].'.php')){
													$arquivo = $url[3].'.php';
												}	
									}else
										if($url[3] == ""){
											$arquivoRetornar = "";


											$arquivo = 'atendimento/leads/conteudo.php';
										}else{
											$arquivo = '404/conteudo.php';
										}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $nomeEmpresa;?></title>

        <link rel="shortcut icon" href="<?php echo $configUrlGer;?>f/i/icon.png" />
        <link rel="stylesheet" href="<?php echo $configUrlGer;?>f/c/estilo.css" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $configUrlGer;?>f/j/auto_complete_softbest/auto_complete_softbest.css" media="all" title="Layout padrão" />

		<script src="https://code.jquery.com/jquery-3.7.0.js"  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js" integrity="sha512-Eezs+g9Lq4TCCq0wae01s9PuNWzHYoCMkE97e2qdkYthpI0pzC3UGB03lgEHn2XM85hDOUF6qgqqszs+iXU4UA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script type="text/javascript" src="<?php echo $configUrlGer;?>f/j/auto_complete_softbest/auto_complete_softbest.js"></script>
        <script src="<?php echo $configUrlGer;?>f/j/js/mascaras.js" type="text/javascript"></script>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<link href="<?php echo $configUrlGer;?>f/c/select2.min.css" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
		
		<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>	

		<script type="text/javascript">
			function mostraItens(item){		
				document.getElementById('menu-dinamico').style.display="block";
				document.getElementById('menu-normal').style.display="none";

				if(item == 6){
					document.getElementById('cadastros').style.display="block";
					document.getElementById('atendimento').style.display="none";
					document.getElementById('imoveis').style.display="none";
				}else
				if(item == 5){
					document.getElementById('cadastros').style.display="none";
					document.getElementById('atendimento').style.display="block";
					document.getElementById('imoveis').style.display="none";
				}else
				if(item == 4){
					document.getElementById('cadastros').style.display="none";
					document.getElementById('atendimento').style.display="none";
					document.getElementById('imoveis').style.display="block";
				}
			}
		</script>		
   </head>
    <body>
		<div id="tudo">
<?php
	include("capa/topo.php");
?>
			<div id="conteudo">
<?php
	include($arquivo);
?>
			</div>
<?php
	include("capa/rodape.php");
?>
		</div>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
			 CKEDITOR.ClassicEditor.create(document.querySelector('.textarea'), {
					height: 500,
					toolbar: {
						items: [
							'exportPDF','exportWord', '|',
							'findAndReplace', 'selectAll', '|',
							'heading', '|',
							'bold', 'italic', 'strikethrough', 'underline', 'code', 'removeFormat', '|',
							'bulletedList', 'numberedList', 'todoList', '|',
							'outdent', 'indent', '|',
							'undo', 'redo',
							'-',
							'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
							'alignment', '|',
							'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'htmlEmbed', '|',
							'specialCharacters', 'horizontalLine', 'pageBreak', '|',
							 '|',
							'sourceEditing'
						],
						shouldNotGroupWhenFull: true
					},
					// Changing the language of the interface requires loading the language file using the <script> tag.
					// language: 'es',
					list: {
						properties: {
							styles: true,
							startIndex: true,
							reversed: true
						}
					},
					// https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
					heading: {
						options: [
							{ model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
							{ model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
							{ model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
							{ model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
							{ model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
							{ model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
							{ model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
						]
					},
					// https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
					placeholder: 'Welcome to CKEditor 5!',
					// https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
					fontFamily: {
						options: [
							'default',
							'Arial, Helvetica, sans-serif',
							'Courier New, Courier, monospace',
							'Georgia, serif',
							'Lucida Sans Unicode, Lucida Grande, sans-serif',
							'Tahoma, Geneva, sans-serif',
							'Times New Roman, Times, serif',
							'Trebuchet MS, Helvetica, sans-serif',
							'Verdana, Geneva, sans-serif'
						],
						supportAllValues: true
					},
					// https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
					fontSize: {
						options: [ 10, 12, 14, 'default', 18, 20, 22 ],
						supportAllValues: true
					},
					// Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
					// https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
					htmlSupport: {
						allow: [
							{
								name: /.*/,
								attributes: true,
								classes: true,
								styles: true
							}
						]
					},
					// Be careful with enabling previews
					// https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
					htmlEmbed: {
						showPreviews: true
					},
					// https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
					link: {
						decorators: {
							addTargetToExternalLinks: true,
							defaultProtocol: 'https://',
							toggleDownloadable: {
								mode: 'manual',
								label: 'Downloadable',
								attributes: {
									download: 'file'
								}
							}
						}
					},
					// https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
					mention: {
						feeds: [
							{
								marker: '@',
								feed: [
									'@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
									'@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
									'@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
									'@sugar', '@sweet', '@topping', '@wafer'
								],
								minimumCharacters: 1
							}
						]
					},
					// The "superbuild" contains more premium features that require additional configuration, disable them below.
					// Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
					removePlugins: [
						// These two are commercial, but you can try them out without registering to a trial.
						// 'ExportPdf',
						// 'ExportWord',
						'AIAssistant',
						'CKBox',
						'CKFinder',
						'EasyImage',
						// This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
						// https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
						// Storing images as Base64 is usually a very bad idea.
						// Replace it on production website with other solutions:
						// https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
						// 'Base64UploadAdapter',
						'MultiLevelList',
						'RealTimeCollaborativeComments',
						'RealTimeCollaborativeTrackChanges',
						'RealTimeCollaborativeRevisionHistory',
						'PresenceList',
						'Comments',
						'TrackChanges',
						'TrackChangesData',
						'RevisionHistory',
						'Pagination',
						'WProofreader',
						// Careful, with the Mathtype plugin CKEditor will not load when loading this sample
						// from a local file system (file://) - load this site via HTTP server if you enable MathType.
						'MathType',
						// The following features are part of the Productivity Pack and require additional license.
						'SlashCommand',
						'Template',
						'DocumentOutline',
						'FormatPainter',
						'TableOfContents',
						'PasteFromOfficeEnhanced',
						'CaseChange'
					]
					})
					.then(editor => {
					})
					.catch(error => {
						console.error('Erro ao inicializar o CKEditor 5:', error);
					});
			});		
		</script>						
    </body>
</html>
<?php
	}else{
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."controle-acesso.php'>";
	}

	}else{
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=".$configUrl."login.php'>";
	}

	$conn->close();	
?>
