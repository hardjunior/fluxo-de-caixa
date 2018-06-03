<?php 
	require_once("topo.php");	
	$arrDados = $_REQUEST; 
  		
	$arrDados["acao"]      = (!empty($arrDados["acao"]))      ?   mysqli_real_escape_string($connecta,$arrDados["acao"])     :'';
	$arrDados["idUsuario"] = (!empty($arrDados["idUsuario"])) ?   mysqli_real_escape_string($connecta,$arrDados["idUsuario"]):'';
	$arrDados["DsEmail"]   = (!empty($arrDados["DsEmail"]))   ?   mysqli_real_escape_string($connecta,$arrDados["DsEmail"])  :'';
	$arrDados["NmUsuario"] = (!empty($arrDados["NmUsuario"])) ?   mysqli_real_escape_string($connecta,$arrDados["NmUsuario"]):'';
	$arrDados["DsSenha"]   = (!empty($arrDados["DsSenha"]))   ?   mysqli_real_escape_string($connecta,$arrDados["DsSenha"])  :'';
	
	if((strlen($arrDados["idUsuario"]) > 0) && ($arrDados["acao"] === "E"))
	{		
		$strSQL = "	UPDATE 
						fluxos.tsUsuario
					SET
						NmUsuario = '{$arrDados['NmUsuario']}'
						,DsEmail = '{$arrDados['DsEmail']}'
						,DsSenha = '".codificaSenha($arrDados["DsSenha"])."'				
					WHERE
						idUsuario = '{$arrDados['idUsuario']}' ";
		if(mysqli_query($connecta,$strSQL))
		{
			$strMsg = 'Dados do usuário atualizado com sucesso! ';
		   // echo "<script language='javascript'>
					// window.alert('Registro atualizados com sucesso!');
					// window.location=('listUsuario.php?acao=E&idUsuario={$arrDados["idUsuario"]}');
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
					// window.location=('listUsuario.php?acao=E&idUsuario={$arrDados["idUsuario"]}');
				// </script>";
		}
	}//fim da edição do registro
	
	else if ((strlen($arrDados["idUsuario"]) > 0) && ($arrDados["acao"] === "D"))
	{
		$arrDados["idUsuario"] = mysqli_real_escape_string ($connecta,$arrDados["idUsuario"]);
		$strSQL = "DELETE FROM 
						fluxos.tsUsuario 
					WHERE 
						idUsuario = '".$arrDados["idUsuario"]."'
					";
	
		if(mysqli_query($connecta,$strSQL))
		{ 
			$strMsg = "O usuário ".$arrDados["NmCategoria"]." foi excluido com sucesso ";
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
		if(strlen($arrDados["NmUsuario"]) <= 3)
		{
			
			header("Location: cadUsuario.php");
			$strMsg = "O campo categoria tem que ter mais de 3 caracteres ";
			exit();
		}
	
		$arrDados["NmUsuario"] = mysqli_real_escape_string($connecta,$arrDados["NmUsuario"]);
		$arrDados["DsEmail"] = mysqli_real_escape_string($connecta,$arrDados["DsEmail"]);
		$arrDados["DsSenha"] = mysqli_real_escape_string($connecta,$arrDados["DsSenha"]);	
		$strSQL = "INSERT INTO 
							fluxos.tsUsuario(NmUsuario, DsEmail, DsSenha) 
					VALUES 
							('".$arrDados["NmUsuario"]."', '".$arrDados["DsEmail"]."', '".codificaSenha($arrDados["DsSenha"])."')";
		if(mysqli_query($connecta,$strSQL))
		{ 
			$strMsg = 'Dados do usuário cadastrado com sucesso! ';
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
			, "From: hardjunior1@gmail.com");
	
		}
	}//fim do inserte

		echo "<div id='page-wrapper'>	
					<div class='row'>
        				<div class='col-lg-12' id='mensagem'>"
            			.$strMsg."<a href='listUsuario.php'> Exibir cadastros</a>      				
    				</div>";//fim mensagem para o usuário

	require_once("rodape.php");