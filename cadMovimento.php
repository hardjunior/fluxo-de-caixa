<?php require_once("topo.php");
	$arrDados = $_GET;
	//echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";var_dump($arrDados);exit;
	$arrDados["acao"]                    = (!empty($arrDados["acao"]))                    ? mysqli_real_escape_string($connecta,$arrDados["acao"])                   :'';
	$arrDados["idMovimento"]             = (!empty($arrDados["idMovimento"]))             ? mysqli_real_escape_string($connecta,$arrDados["idMovimento"])            :'';
	$arrDados["FgTipo"]                  = (!empty($arrDados["FgTipo"]))                  ? mysqli_real_escape_string($connecta,$arrDados["FgTipo"])                 :'';
	$arrDados["DtMovimento"]             = (!empty($arrDados["DtMovimento"]))             ? mysqli_real_escape_string($connecta,$arrDados["DtMovimento"])            :'';
	$arrDados["DsMovimento"]             = (!empty($arrDados["DsMovimento"]))             ? mysqli_real_escape_string($connecta,$arrDados["DsMovimento"])            :'';
	$arrDados["NuValor"]                 = (!empty($arrDados["NuValor"]))                 ? mysqli_real_escape_string($connecta,$arrDados["NuValor"])                :'';
	$arrDados["FgStatus"]                = (!empty($arrDados["FgStatus"]))                ? mysqli_real_escape_string($connecta,$arrDados["FgStatus"])               :'';		
	$arrDados["tsUsuario_idUsuario"]     = (!empty($arrDados["tsUsuario_idUsuario"]))     ? mysqli_real_escape_string($connecta,$arrDados["tsUsuario_idUsuario"])    :'';
	$arrDados["teCategoria_idCategoria"] = (!empty($arrDados["teCategoria_idCategoria"])) ? mysqli_real_escape_string($connecta,$arrDados["teCategoria_idCategoria"]):'';
	 
	$idMovimento = (!empty($_GET["idMovimento"])) and $_GET["idMovimento"]==""?0:$_GET["idMovimento"];
	if($idMovimento!=0)
	{
		$strSQL = "	SELECT 	
							m.DtMovimento
							, m.DsMovimento
							, m.FgTipo
							, m.NuValor
							, m.FgStatus
							, m.teCategoria_idCategoria
							, m.tsUsuario_idUsuario
					FROM 	
							tuMovimento AS m											
					WHERE 
							idMovimento = '{$arrDados["idMovimento"]}' ";
		// $strSQL = "	SELECT 	
							// u.NmUsuario, c.NmCategoria, m.idMovimento, m.DtMovimento,  
							// m.FgTipo, m.DsMovimento, m.NuValor, m.FgStatus
					// FROM 	
							// tsUsuario AS u INNER JOIN tuMovimento As m
					// ON 		
							// u.idUsuario = m.tsUsuario_idUsuario	INNER JOIN teCategoria AS c  
					// ON 		
							// c.idCategoria = m.teCategoria_idCategoria											
					// WHERE 
							// idMovimento = '{$arrDados["idMovimento"]}' ";
						
	
		$objRow = mysqli_fetch_array(mysqli_query($connecta,$strSQL));
	}
?>
       <div id="page-wrapper">
            <h1>Registo de movimentos</h1>
          	<div class="col-lg-12">      
        		<div class="panel panel-default">
            		<div class="panel-body">
            			<form class="form-horizontal" name="formCadMov" id="formCadMov" action="movimentos.php" method="post">            				
							<div class="form-group">														
								<div class="col-sm-3">
									<label for="DtMovimento">Data</label>
									<div class="input-group">
								      	<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
								      	<input type="hidden" name="acao" id="acao" value="E" />
								      	
								      	<input type="hidden" name="idMovimento" id="idMovimento" value="<?= (!empty($arrDados['idMovimento'])) ? $arrDados['idMovimento'] : ''; ?>" />
								      	<input type="hidden" name="tsUsuario_idUsuario" id="tsUsuario_idUsuario" value="<?= (!empty($_SESSION['idUsuario'])) ? $_SESSION['idUsuario']:''; ?>" />
								      	<!-- <input type="hidden" class="form-control" name="DtMovimento" id="DtMovimento" value="<?= (!empty(m.DtMovimento)) ? date_format(m.DtMovimento, '%d/%m/%Y'):''; ?>"> -->
								      	<!-- <input type="text" name="teCategoria_idCategoria" id="teCategoria_idCategoria" value="<?= (!empty($arrDados['idCategoria'])) ?  "idCategoria".$arrDados['idCategoria']:''; ?>" />	 -->							      	
								      	
								      	<input type="date" class="form-control" name="DtMovimento" id="DtMovimento" value="<?= (!empty($objRow['DtMovimento'])) ? $objRow['DtMovimento'] :''; ?>">							      	
									</div><span id="erro"></span>
								</div>                   
							</div>														
       						<div class="form-group">					
								<div class="col-sm-3">
									<label for="DsEmail">Categoria</label>
									<div class="input-group">
								      	<div class="input-group-addon"><i class="fa fa-bullseye"></i></div>								      	
								      	<select id="teCategoria_idCategoria" name="teCategoria_idCategoria" class="form-control">
								      		<option>Selecione a categoria</option>
								      			
								      		<?php 
									      		$strSQL = 	"	
									      						SELECT 	
									      							idCategoria
																	, NmCategoria												
																FROM 
																	teCategoria
															";
												$objRs = mysqli_query($connecta,$strSQL);
											if (mysqli_num_rows($objRs)>0)
									      		while ($retorna = mysqli_fetch_array($objRs))
												{
													echo "<option ";
													echo ( (!empty($objRow["teCategoria_idCategoria"])) and ($retorna["idCategoria"] === $objRow["teCategoria_idCategoria"]) )? 
													" selected = 'selected ' ":"";
													echo " value='{$retorna['idCategoria']}'>{$retorna['NmCategoria']}";
													echo "</option>";													
												}
											?>
										</select>
									</div>									
								</div>                   
							</div>							
							<div class="form-group">
								<div class="col-sm-4">
									<label for="DsMovimento">Descrição do movimento</label>
									<div class="input-group">
								      	<div class="input-group-addon"><i class="fa fa-edit"></i></div>	      	
								      	<input type="text" class="form-control" name="DsMovimento" id="DsMovimento" placeholder="Descrição do movimento" maxlength="255" value="<?= (!empty($objRow['DsMovimento'])) ? $objRow['DsMovimento'] : ''; ?>" />
									</div>
								</div> 
							</div>
							<div class="form-group">
								<div class="col-sm-2">
									<label for="NuValor">Valor</label>
									<div class="input-group">
								      	<div class="input-group-addon">€</div>									      	
								      	<input class="form-control" name="NuValor" id="NuValor" type="text" placeholder="Valor" maxlength="10" value="<?= (!empty($objRow['NuValor'])) ? $objRow['NuValor'] : ''; ?>">
									</div>
								</div> 
							</div>
							<div class="form-group">
								<div class="col-sm-3">
									<label for="FgTipo">Tipo</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-flag-checkered"></i></div>
								      	<select id="FgTipo" name="FgTipo" class="form-control">
								      		<option>Selecione o tipo</option>
											<option value="D" <?= (!empty($objRow["FgTipo"])) and $objRow["FgTipo"]==="D" ? "selected = 'selected'" : ""; ?> >Dispesa</option>
											<option value="R" <?= (!empty($objRow["FgTipo"])) and $objRow["FgTipo"]==="R" ? "selected = 'selected'" : ""; ?> >Receita</option>
											</select> 
										<br />	
									</div><span id="errof"></span>
								</div>                   
							</div>
							<div class="form-group">														
								<div class="col-sm-3">
									<label for="FgStatus">Status</label><br />
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-flag-checkered"></i></div>					
										<select id="FgStatus" name="FgStatus" class="form-control">
											<option>Selecione o status</option>
											<option value="A" <?= (!empty($objRow["FgStatus"])) and $objRow["FgStatus"]==="A"?" selected = 'selected' ":""; ?> >Ativo</option>
											<option value="B" <?= (!empty($objRow["FgStatus"])) and $objRow["FgStatus"]==="B"?" selected = 'selected' ":""; ?> >Bloqueado</option>
										</select> 
										<br />
									</div><span id="errof"></span>
								</div>                   
							</div>				           
			  			</form>
					</div>
				  	<div class="modal-footer">					       
				        <button name="btnSalvar" id="btnSalvar" class="btn btn-success">Salvar</button>
				        <a href="listMovimento.php"><button name="cancelar" id="cancelar" class="btn btn-default" data-dismiss="modal">Cancelar</button></a>
				  	</div>
				</div>
			</div>
			<script language="JavaScript">
				//function validaCampo(){
				document.getElementById("btnSalvar").onclick = function () 
				{
					var nome = document.getElementById("DtMovimento").value;			
					if(nome.length == "")
					{ 
						document.getElementById("erro").innerHTML="<font color='red'>Campo data é obrigatório</font>";
						//window.alert("Este campo é obrigatório!");
						return false;
					}
					else 
					{
						document.getElementById("erro").innerHTML="";
						
					};
					document.getElementById("formCadMov").submit();   
				};
				//};
			</script>
			<?php require_once("rodape.php"); ?>