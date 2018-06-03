<?php require_once("topo.php");
	$arrDados = $_GET;
	
	$arrDados["idCategoria"] = (!empty($arrDados["idCategoria"])) ? mysqli_real_escape_string($connecta,$arrDados["idCategoria"]) : ''; 
	$idCategoria = $arrDados["idCategoria"]==""?0:$_GET["idCategoria"];
	if($idCategoria!=0)
	{
		$strSQL = "SELECT
						 NmCategoria
						, FgStatus
					FROM
						teCategoria
					WHERE
						idCategoria = '{$arrDados["idCategoria"]}' "; 
	
		$objRow = mysqli_fetch_array(mysqli_query($connecta,$strSQL));
	}
?>
       <div id="page-wrapper">
            <h1>Cadastro de categoria</h1>
          	<div class="col-lg-12">      
        		<div class="panel panel-default">
            		<div class="panel-body">
            			<form class="form-horizontal" name="formCadCat" id="formCadCat" action="categorias.php" method="post">
							<div class="form-group">														
								<div class="col-sm-3">
									<label for="NmCategoria">Categoria</label>
									<div class="input-group">
								      	<div class="input-group-addon"><i class="fa fa-table fa-fw"></i></div>
								      	<input type="hidden" name="idCategoria" id="idCategoria" value="<?= (!empty($arrDados["idCategoria"])) ? $arrDados["idCategoria"] : ''; ?>" />
								      	<input type="hidden" name="acao" id="acao" value="E" />								      	
								      	<input class="form-control" name="NmCategoria" id="NmCategoria" type="text" placeholder="Nome" maxlength="100" value="<?= (!empty($objRow['NmCategoria'])) ? $objRow['NmCategoria'] : ''; ?>">
									</div><span id="erron"></span>
								</div>                   
							</div>
							<div class="form-group">														
								<div class="col-sm-3">
									<label for="FgStatus">Status</label><br />
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-flag-checkered"></i></div>						      	
										<select id="FgStatus" name="FgStatus" class="form-control">
											<option>Selecione o status</option>
											<option value="A" <?= ( (!empty($objRow["FgStatus"])) and ($objRow["FgStatus"]==="A") )?" selected = 'selected' ":""; ?> >Ativo</option>
											<option value="B" <?= ( (!empty($objRow["FgStatus"])) and ($objRow["FgStatus"]==="B") )?" selected = 'selected' ":""; ?> >Bloqueado</option>
											</select> 
										<br />
									</div><span id="errof"></span>
								</div>                   
							</div>				            
			  			</form>
					</div>
				  	<div class="modal-footer">					       
				        <button name="btnSalvar" id="btnSalvar" class="btn btn-success">Salvar</button>
				        <a href="listCategoria.php"><button name="cancelar" id="cancelar" class="btn btn-default" data-dismiss="modal">Cancelar</button></a>
				  	</div>
				</div>
			</div>
			<script language="JavaScript">
				//function validaCampo(){
				document.getElementById("btnSalvar").onclick = function () 
				{
					var nome = document.getElementById("NmCategoria").value;			
					if(nome.length <= 3)
					{ 
						document.getElementById("erron").innerHTML="<font color='red'>O nome da categoria dever ter no minimo 3 caracter</font>";
						//window.alert("Este campo é obrigatório!");
						return false;
					}
					else 
					{
						document.getElementById("erron").innerHTML="";
					};
					var FgStatus = document.getElementById("FgStatus").value;			
					if(FgStatus == "")
					{ 
						document.getElementById("errof").innerHTML="<font color='red'>Escolha uma opção para o status</font>";
						//window.alert("Este campo é obrigatório!");
						return false;
					}
					else 
					{
						document.getElementById("errof").innerHTML="";
					};
					
					document.getElementById("formCadCat").submit();   
				};
				//};
			</script>
		<?php require_once("rodape.php"); ?>