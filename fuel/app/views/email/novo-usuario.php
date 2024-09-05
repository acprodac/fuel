<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
	<tr>
		<td bgcolor="#ffffff" height="95" align="center"><img style="display: block;" width="169" height="95" border="0" src="<?php echo $baseUrl; ?>assets/img/email/logo.jpg" alt="Admin - Prodac" /></td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td bgcolor="#8dc740" height="49" align="center" valign="middle">
			<table width="600" cellpadding="0" cellspacing="0" border="0" align="center">
				<tr>
					<td align="center"><font face="Tahoma,Arial,sans-serif" color="#ffffff" size="4" style="font-size: 18px;">Olá <?php echo $userName; ?>,</font></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td bgcolor="#363232" height="10" align="center"><font size="1" style="font-size: 5px; line-height: 10px;">&nbsp;</font></td>
	</tr>
</table>
<table width="600" cellpadding="0" cellspacing="0" border="0" align="center">
	<tr>
		<td bgcolor="#ffffff" align="left" valign="middle"><font face="Tahoma,Arial,sans-serif" color="#73818d" size="4" style="font-size: 18px;"><br />
			Você foi cadastrado como administrador do site Prodac. Guarde seus dados de acesso:<br /><br />

			<table width="600" cellpadding="5" cellspacing="0" border="0" align="center">
				
					<tr>
						<td bgcolor="#9bd3ae"><font size="3" color="#7b8a96" style="font-size: 15px;"><strong>&nbsp;&nbsp;URL: </strong> <a href="<?php echo $urlAdmin; ?>" target="_blank"><?php echo $urlAdmin; ?></a><br /></font></td>
					</tr>
					<tr>
						<td bgcolor="#ffffff"><font size="3" color="#7b8a96" style="font-size: 15px;"><strong>&nbsp;&nbsp;Usuário: </strong> <?php echo $userEmail; ?><br /></font></td>
					</tr>
					<tr>
						<td bgcolor="#9bd3ae"><font size="3" color="#7b8a96" style="font-size: 15px;"><strong>&nbsp;&nbsp;Senha: </strong> <?php echo $userPasswd; ?><br /></font></td>
					</tr>
				
			</table>

			<br /></font>
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
	<tr>
		<td height="40" align="center" valign="middle" bgcolor="#8dc740"><font face="Tahoma,Arial,sans-serif" color="#ffffff" size="2" style="font-size: 12px;"><strong>© <?php echo date('Y'); ?> PRODAC.</strong> Todos os direitos reservados.</font></td>
	</tr>
</table>