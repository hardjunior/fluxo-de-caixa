<?php 
	require_once("topo.php");
	$arrDados = $_REQUEST;
	
	 
	
	$arrDados["acao"]        = (!empty($arrDados["acao"]))        ? mysqli_real_escape_string($connecta,$arrDados["acao"])       :'';
	$arrDados["idCategoria"] = (!empty($arrDados["idCategoria"])) ? mysqli_real_escape_string($connecta,$arrDados["idCategoria"]):'';
	$arrDados["NmCategoria"] = (!empty($arrDados["NmCategoria"])) ? mysqli_real_escape_string($connecta,$arrDados["NmCategoria"]):'';
	$arrDados["FgStatus"]    = (!empty($arrDados["FgStatus"]))    ? mysqli_real_escape_string($connecta,$arrDados["FgStatus"]):'';
	
	if((strlen($arrDados["idCategoria"]) > 0) && ($arrDados["acao"] === "E"))
	{

		$strSQL = 	"	UPDATE 
							fluxos.teCategoria
						SET
							 NmCategoria = 	'{$arrDados['NmCategoria']}'						
							,FgStatus = 	'{$arrDados['FgStatus']}'									
						WHERE
							idCategoria = 	'{$arrDados['idCategoria']}' 
					";
		if(mysqli_query($connecta,$strSQL))
		{
		   $strMsg = 'Categoria atualizado com sucesso! ';
		   		// <script language='javascript'>
					// window.alert('Registro atualizados com sucesso!');
					// window.location=('cadCategoria.php?acao=idCategoria={$arrDados["idCategoria"]}');
				// </script>";
		}
		else
		{
			$strMsg = "Erro na query ".mysql_error($connecta)." O administrador foi avisado. ";
			mail("hardjunior1@gmail.com", "Erro Mysql"
			, "Erro : ".mysql_error($connecta)."===>".date("d/m/Y H:i:s")
			, "From: hardjunior1@gmail.com");
				// "<script language='javascript'>
					// window.alert('Houve um erro no banco de dados!');
					// window.location=('cadCategorias.php?idCategoria={$arrDados["idCategoria"]}');
				// </script>";
		}
	}//fim da edição do registro
	
	else if ((strlen($arrDados["idCategoria"]) > 0) && ($arrDados["acao"] === "D"))
	//else if ((strlen($arrDados["idCategoria"]) > 0) && ($arrDados["acao"] === "D"))
	{
		
		$arrDados["idCategoria"] = mysqli_real_escape_string ($connecta,$arrDados["idCategoria"]);
		$strSQL = "DELETE FROM fluxos.teCategoria 
					WHERE 
					idCategoria = '{$arrDados["idCategoria"]}'
					";
	
		if(mysqli_query($connecta,$strSQL))
		{ 
			$strMsg = "O código ".$arrDados["idCategoria"]." foi excluida com sucesso. ";
		}
		else
		{
			if (condition) 
			{
				$strMsg = "A categoria nao pode ser excluida porque está em uso!";
			} 
			else 
			{
				$strMsg = "Erro na query ".mysqli_error($connecta)." O administrador foi avisado. ";
				mail("hardjunior1@gmail.com", "Erro Mysql"
				, "Erro : ".mysqli_error($connecta)."===>".date("d/m/Y H:i:s")
				, "From: hardjunior1@gmail.com");
			}
			
			
			
		}
	
	}//fim do delete
	
	else
	{
		if(strlen($arrDados["NmCategoria"]) <= 3)
		{
			//var_dump($arrDados);
			header("Location: cadCategoria.php");
			$strMsg = "O campo categoria tem que ter mais de 3 caracteres";
			exit();
		}
		if(strlen($arrDados["FgStatus"]) == -1 )
		{
			//var_dump($arrDados);
			header("Location: cadCategoria.php");
			$strMsg = "Marque uma opção do para o status";
			exit();
		}
	
		$arrDados["NmCategoria"] = mysqli_real_escape_string($connecta,$arrDados["NmCategoria"]);
		$arrDados["FgStatus"] = mysqli_real_escape_string($connecta,$arrDados["FgStatus"]);
		$strSQL = 	"		
						INSERT INTO 
							fluxos.teCategoria(NmCategoria, FgStatus) 
						VALUES 
						(
							'{$arrDados["NmCategoria"]}'
							,'{$arrDados["FgStatus"]}'	
						)
	  				";	
						
		if(mysqli_query($connecta,$strSQL))
		{ 
			$strMsg = "Categoria cadastrada com sucesso! ";
		}
		else
		{
			$strMsg = "Erro no query ".mysqli_error($connecta)." O administrador foi avisado. ";
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
			, "From: jhouper@hotmail.com");
	
		}
	}//fim do inserte
	echo "<div id='page-wrapper'>	
			<div class='row'>
        		<div class='col-lg-12' id='mensagem'>"
            		.$strMsg."<a href='listCategoria.php'> Exibir cadastros</a>      				
    			</div>";//fim mensagem para o usuário
	require_once("rodape.php");