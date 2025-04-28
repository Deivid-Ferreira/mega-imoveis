								<p class="bloco-campo-float"><label>Preço de: <span class="obrigatorio"> </span></label>
									<select class="campo" style="width:120px; margin-right:0px;" name="valor1">
										<option value="">Preço de</option>
										<option value="">Todos</option>
										<option value="40000.00" <?php echo $_SESSION['valor1'] == '40000.00' ? '/SELECTED/' : '';?> >R$ 40.000,00</option>
										<option value="50000.00" <?php echo $_SESSION['valor1'] == '50000.00' ? '/SELECTED/' : '';?>>R$ 50.000,00</option>
										<option value="60000.00" <?php echo $_SESSION['valor1'] == '60000.00' ? '/SELECTED/' : '';?>>R$ 60.000,00</option>
										<option value="80000.00" <?php echo $_SESSION['valor1'] == '80000.00' ? '/SELECTED/' : '';?>>R$ 80.000,00</option>
										<option value="100000.00" <?php echo $_SESSION['valor1'] == '100000.00' ? '/SELECTED/' : '';?>>R$ 100.000,00</option>
										<option value="120000.00" <?php echo $_SESSION['valor1'] == '120000.00' ? '/SELECTED/' : '';?>>R$ 120.000,00</option>
										<option value="140000.00" <?php echo $_SESSION['valor1'] == '140000.00' ? '/SELECTED/' : '';?>>R$ 140.000,00</option>
										<option value="160000.00" <?php echo $_SESSION['valor1'] == '160000.00' ? '/SELECTED/' : '';?>>R$ 160.000,00</option>
										<option value="180000.00" <?php echo $_SESSION['valor1'] == '180000.00' ? '/SELECTED/' : '';?>>R$ 180.000,00</option>
										<option value="200000.00" <?php echo $_SESSION['valor1'] == '200000.00' ? '/SELECTED/' : '';?>>R$ 200.000,00</option>
										<option value="220000.00" <?php echo $_SESSION['valor1'] == '220000.00' ? '/SELECTED/' : '';?>>R$ 220.000,00</option>
										<option value="250000.00" <?php echo $_SESSION['valor1'] == '250000.00' ? '/SELECTED/' : '';?>>R$ 250.000,00</option>
										<option value="280000.00" <?php echo $_SESSION['valor1'] == '280000.00' ? '/SELECTED/' : '';?>>R$ 280.000,00</option>
										<option value="300000.00" <?php echo $_SESSION['valor1'] == '300000.00' ? '/SELECTED/' : '';?>>R$ 300.000,00</option>
										<option value="400000.00" <?php echo $_SESSION['valor1'] == '400000.00' ? '/SELECTED/' : '';?>>R$ 400.000,00</option>
										<option value="500000.00" <?php echo $_SESSION['valor1'] == '500000.00' ? '/SELECTED/' : '';?>>R$ 500.000,00</option>
										<option value="600000.00" <?php echo $_SESSION['valor1'] == '600000.00' ? '/SELECTED/' : '';?>>R$ 600.000,00</option>
										<option value="800000.00" <?php echo $_SESSION['valor1'] == '800000.00' ? '/SELECTED/' : '';?>>R$ 800.000,00</option>
										<option value="acima" <?php echo $_SESSION['valor1'] == 'acima' ? '/SELECTED/' : '';?>>Acima de R$ 1.000.000,00</option>
								   </select>
								</p>
								<p class="bloco-campo-float" style="margin-right:0px;"><label>Preço até: <span class="obrigatorio"> </span></label>
									<select class="campo" style="width:120px;" name="valor2">
										<option value="">Preço até</option>
										<option value="">Todos</option>
										<option value="40000.00" <?php echo $_SESSION['valor2'] == '40000.00' ? '/SELECTED/' : '';?> >R$ 40.000,00</option>
										<option value="50000.00" <?php echo $_SESSION['valor2'] == '50000.00' ? '/SELECTED/' : '';?>>R$ 50.000,00</option>
										<option value="60000.00" <?php echo $_SESSION['valor2'] == '60000.00' ? '/SELECTED/' : '';?>>R$ 60.000,00</option>
										<option value="80000.00" <?php echo $_SESSION['valor2'] == '80000.00' ? '/SELECTED/' : '';?>>R$ 80.000,00</option>
										<option value="100000.00" <?php echo $_SESSION['valor2'] == '100000.00' ? '/SELECTED/' : '';?>>R$ 100.000,00</option>
										<option value="120000.00" <?php echo $_SESSION['valor2'] == '120000.00' ? '/SELECTED/' : '';?>>R$ 120.000,00</option>
										<option value="140000.00" <?php echo $_SESSION['valor2'] == '140000.00' ? '/SELECTED/' : '';?>>R$ 140.000,00</option>
										<option value="160000.00" <?php echo $_SESSION['valor2'] == '160000.00' ? '/SELECTED/' : '';?>>R$ 160.000,00</option>
										<option value="180000.00" <?php echo $_SESSION['valor2'] == '180000.00' ? '/SELECTED/' : '';?>>R$ 180.000,00</option>
										<option value="200000.00" <?php echo $_SESSION['valor2'] == '200000.00' ? '/SELECTED/' : '';?>>R$ 200.000,00</option>
										<option value="220000.00" <?php echo $_SESSION['valor2'] == '220000.00' ? '/SELECTED/' : '';?>>R$ 220.000,00</option>
										<option value="250000.00" <?php echo $_SESSION['valor2'] == '250000.00' ? '/SELECTED/' : '';?>>R$ 250.000,00</option>
										<option value="280000.00" <?php echo $_SESSION['valor2'] == '280000.00' ? '/SELECTED/' : '';?>>R$ 280.000,00</option>
										<option value="300000.00" <?php echo $_SESSION['valor2'] == '300000.00' ? '/SELECTED/' : '';?>>R$ 300.000,00</option>
										<option value="400000.00" <?php echo $_SESSION['valor2'] == '400000.00' ? '/SELECTED/' : '';?>>R$ 400.000,00</option>
										<option value="500000.00" <?php echo $_SESSION['valor2'] == '500000.00' ? '/SELECTED/' : '';?>>R$ 500.000,00</option>
										<option value="600000.00" <?php echo $_SESSION['valor2'] == '600000.00' ? '/SELECTED/' : '';?>>R$ 600.000,00</option>
										<option value="800000.00" <?php echo $_SESSION['valor2'] == '800000.00' ? '/SELECTED/' : '';?>>R$ 800.000,00</option>
										<option value="acima" <?php echo $_SESSION['valor2'] == 'acima' ? '/SELECTED/' : '';?>>Acima de R$ 1.000.000,00</option>
								   </select>
								</p>
								<p class="bloco-campo-float" style="margin-right:0px;">
									<label>Ordem de Cadastro: <span class="obrigatorio"> </span></label>
									<select class="campo" id="ordemFiltro" name="ordemFiltro" style="width:155px; padding:5.5px;" onChange="alteraFiltro();">
										<option value="">Selecione...</option>
										<option value="DESC" <?php echo (isset($_SESSION['ordemFiltro']) && $_SESSION['ordemFiltro'] == 'DESC') ? 'selected' : ''; ?>>Últimos Cadastros</option>
										<option value="ASC" <?php echo (isset($_SESSION['ordemFiltro']) && $_SESSION['ordemFiltro'] == 'ASC') ? 'selected' : ''; ?>>Mais Antigos</option>
									</select>
									<br class="clear"/>
								</p>
								<p class="bloco-campo-float" style="margin-right:0px;">
									<label>Última Atualização<span class="obrigatorio"> </span></label>
									<select class="campo" id="atualizacao" name="atualizacao" style="width:155px; padding:5.5px;" onChange="alteraFiltro();">
										<option value="">Selecione...</option>
										<option value="ASC" <?php echo (isset($_SESSION['atualizacao']) && $_SESSION['atualizacao'] == 'ASC') ? 'selected' : ''; ?>>Desatualizados</option>
										<option value="DESC" <?php echo (isset($_SESSION['atualizacao']) && $_SESSION['atualizacao'] == 'DESC') ? 'selected' : ''; ?>>Atualizados</option>
									</select>
									<br class="clear"/>
								</p>
								
							