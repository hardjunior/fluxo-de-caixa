<?php 
	require_once("topo.php");
	$arrDados = $_REQUEST; 
	//echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";var_dump($arrDados);exit;
  	//var_dump($arrDados);exit;
	$arrDados["acao"]                = (!empty($arrDados["acao"]))                ? mysqli_real_escape_string($connecta,$arrDados["acao"])               : '';
	$arrDados["idMovimento"]         = (!empty($arrDados["idMovimento"]) )        ? mysqli_real_escape_string($connecta,$arrDados["idMovimento"])        : '';
	$arrDados["FgTipo"]              = (!empty($arrDados["FgTipo"]))              ? mysqli_real_escape_string($connecta,$arrDados["FgTipo"])             : '';
	$arrDados["DtMovimento"]         = (!empty($arrDados["DtMovimento"]))         ? mysqli_real_escape_string($connecta,$arrDados["DtMovimento"])        : '';
	$arrDados["DsMovimento"]         = (!empty($arrDados["DsMovimento"]))         ? mysqli_real_escape_string($connecta,$arrDados["DsMovimento"])        : '';
	$arrDados["NuValor"]             = (!empty($arrDados["NuValor"]))             ? mysqli_real_escape_string($connecta,$arrDados["NuValor"])            : '';
	$arrDados["FgStatus"]            = (!empty($arrDados["FgStatus"]))            ? mysqli_real_escape_string($connecta,$arrDados["FgStatus"])           : '';
	$arrDados["tsUsuario_idUsuario"] = (!empty($arrDados["tsUsuario_idUsuario"])) ? mysqli_real_escape_string($connecta,$arrDados["tsUsuario_idUsuario"]): '';
	$arrDados["idCategoria"]         = (!empty($arrDados["idCategoria"]))         ? mysqli_real_escape_string($connecta,$arrDados["idCategoria"])        : '';
	
	if((strlen($arrDados["idMovimento"]) > 0) && ($arrDados["acao"]==="E"))
	{		
		$strSQL = 	"
						UPDATE 
							fluxos.tuMovimento
						SET
							 FgTipo = '{$arrDados['FgTipo']}'
							, DtMovimento = '{$arrDados['DtMovimento']}'
							, DsMovimento = '{$arrDados['DsMovimento']}'
							, NuValor = '{$arrDados['NuValor']}'
							, FgStatus = '{$arrDados['FgStatus']}'								
							, tsUsuario_idUsuario = '{$arrDados['tsUsuario_idUsuario']}'	
							, teCategoria_idCategoria = '{$arrDados['teCategoria_idCategoria']}'					
						WHERE
							idMovimento = '{$arrDados['idMovimento']}' 
					";
		if(mysqli_query($connecta,$strSQL))
		{
			$strMsg = 'Registro atualizado com sucesso! ';
		   // echo "<script language='javascript'>
					// window.alert('Registro atualizados com sucesso!');
					// window.location=('listMovimento.php?acao=E&idMovimento={$arrDados["idMovimento"]}');
				// </script>";
		}
		else
		{
			$strMsg = "Erro na query ".mysqli_error($connecta)." O administrador foi avisado. ";
			mail("hardjunior1@gmail.com", "Erro Mysql"
			, "Erro : ".mysqli_error($connecta)."===>".date("d/m/Y H:i:s")
			, "From: hardjunior1@gmail.com");
			// echo "<script language='javascript'>
					// window.alert('Houve um erro no banco de dados!');
					// window.location=('listMovimento.php?acao=E&idMovimento={$arrDados["idMovimento"]}');
				// </script>";
		}
	}//fim da edição do registro
	
	else if ((strlen($arrDados["idMovimento"]) > 0) && ($arrDados["acao"] === "D"))
	{
		$arrDados["idMovimento"] = mysqli_real_escape_string($connecta,$arrDados["idMovimento"]);
		
		$strSQL = 	"
						DELETE FROM 
							fluxos.tuMovimento 
						WHERE 
							idMovimento = '{$arrDados["idMovimento"]}'
					";
	
		if(mysqli_query($connecta,$strSQL))
		{ 
			$strMsg = "O registro de código {$arrDados["idMovimento"]} foi excluido com sucesso! ";
		}
		else
		{
			$strMsg = "Erro na query ".mysqli_error($connecta)." O administrador foi avisado. ";
			mail("hardjunior1@gmail.com", "Erro Mysql"
			, "Erro : ".mysqli_error($connecta)."===>".date("d/m/Y H:i:s")
			, "From: hardjunior1@gmail.com");
		}
	}//fim do delete
    else
	{
		
		/*if(strlen($arrDados["NmUsuario"]) <= 3)
		{
			
			header("Location: cadUsuario.php");
			$strMsg = "O campo categoria tem que ter mais de 3 caracteres";
			exit();
		}

		$arrDados["idMovimento"] = mysqli_real_escape_string($arrDados["idMovimento"]);
		$arrDados["FgTipo"] = mysqli_real_escape_string($arrDados["FgTipo"]);
		$arrDados["DtMovimento"] = mysqli_real_escape_string($arrDados["DtMovimento"]);
		$arrDados["DsMovimento"] = mysqli_real_escape_string($arrDados["DsMovimento"]);
		$arrDados["NuValor"] = mysqli_real_escape_string($arrDados["NuValor"]);
		$arrDados["FgStatus"] = mysqli_real_escape_string($arrDados["FgStatus"]);		
		$arrDados["tsUsuario_idUsuario"] = mysqli_real_escape_string($arrDados["tsUsuario_idUsuario"]);
		$arrDados["idCategoria"] = mysqli_real_escape_string($arrDados["idCategoria"]);	*/
		
		$strSQL = 	"	
						INSERT INTO 
							fluxos.tuMovimento
							(	
								FgTipo, DtMovimento, DsMovimento, NuValor, FgStatus
								, tsUsuario_idUsuario, teCategoria_idCategoria) 
						VALUES 
							(
								'{$arrDados["FgTipo"]}'
								,'{$arrDados["DtMovimento"]}'
								,'{$arrDados["DsMovimento"]}'
								,'{$arrDados["NuValor"]}'
								,'{$arrDados["FgStatus"]}'
								,'{$arrDados["tsUsuario_idUsuario"]}'
								,'{$arrDados["teCategoria_idCategoria"]}'
							)
					";
		if(mysqli_query($connecta,$strSQL))
		{ 
			$strMsg = "Movimento cadastrado com sucesso! ";
		}
		else
		{
			$strMsg = "Erro na query ".mysqli_error($connecta)." O administrador foi avisado. ";			
			/*
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			
			$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
			$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
			$headers .= 'Cco: birthdayarchive@example.com' . "\r\n";
			$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
	       */ 			
			mail("hardjunior1@gmail.com", "Erro Mysql"
			, "Erro : ".mysqli_error($connecta)."===>".date("d/m/Y H:i:s")
			, "From: hardjunior1@gmail.com");
	
		}
	}//fim do inserte
		echo "<div id='page-wrapper'>	
			<div class='row'>
        		<div class='col-lg-12' id='mensagem'>"
            		.$strMsg."<a href='listMovimento.php'> Exibir cadastros</a>      				
    			</div>";//fim mensagem para o usuário
		require_once("rodape.php");