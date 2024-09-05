<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<script language="JavaScript">
<!--

function valida_formulario() {
	var strMensagem;
	
	strMensagem = "";
	
	if (document.formulario.nome.value == "")
	{
		strMensagem = "Informe seu nome.\n";
	}
	
	if (document.formulario.email.value == "")
	{
		strMensagem = strMensagem + "Informe seu e-mail.\n";
	}
	
	if (strMensagem != "")
	{
		alert("Ocorreu os seguinte(s) erros.\n" + strMensagem);
	}
	else
	{
		document.formulario.action = "contato_send2.asp";
		document.formulario.method = "post";
		document.formulario.submit();
    }
}
 
//-->
</SCRIPT>
<script language="JavaScript">
<!--

function limpa_formulario(){
	document.formulario.nome.value = "";
	document.formulario.email.value = "";
	document.formulario.empresa.value = "";
	document.formulario.telefone.value = "";
	document.formulario.cep.value = "";
	document.formulario.endereco.value = "";
	document.formulario.bairro.value = "";
	document.formulario.cidade.value = "";
	document.formulario.uf.value = "";
}
//-->
</SCRIPT>
<title>:: Prodac ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<link rel="stylesheet" href="estilo.css">
<body background="designa.jpg" leftmargin="0" topmargin="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="25%"><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','253','height','133','src','menufla2','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','menufla2' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="253" height="133">
        <param name="movie" value="menufla2.swf">
        <param name="quality" value="high">
        <embed src="menufla2.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="253" height="133"></embed></object></noscript></td>
    <td width="75%"><img src="branco.gif" width="101" height="127"><a href="index.htm"><img src="branco.gif" width="227" height="127" border="0"></a><img src="branco.gif" width="132" height="12"><a href="English/index.htm"><img src="branco.gif" width="59" height="54" border="0"></a></td>
  </tr>
  <tr valign="top"> 
    <td height="531" colspan="2"> 
      <table width="100%" height="500" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="23%" height="531" valign="top">
<table width="97%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><a href="obra1.htm"><img src="branco.gif" width="161" height="25" border="0"></a></td>
              </tr>
              <tr>
                <td height="32"><a href="obra2.htm"><img src="branco.gif" width="161" height="25" border="0"></a></td>
              </tr>
              <tr>
                <td height="29"><a href="obra3.htm"><img src="branco.gif" width="161" height="25" border="0"></a></td>
              </tr>
              <tr>
                <td height="29"><a href="obra4.htm"><img src="branco.gif" width="161" height="25" border="0"></a></td>
              </tr>
              <tr>
                <td height="29"><a href="obra5.htm"><img src="branco.gif" width="161" height="25" border="0"></a></td>
              </tr>
              <tr>
                <td height="30"><a href="obra6.htm"><img src="branco.gif" width="161" height="25" border="0"></a></td>
              </tr>
              <tr>
                <td height="28"><a href="obra7.htm"><img src="branco.gif" width="161" height="25" border="0"></a></td>
              </tr>
              <tr>
                <td height="30"><a href="obra8.htm"><img src="branco.gif" width="161" height="25" border="0"></a></td>
              </tr>
              <tr>
                <td height="30"><a href="obra9.htm"><img src="branco.gif" width="161" height="25" border="0"></a></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
          </td>
          <td width="77%" height="400" valign="top">
 <form name="formulario" method="post">
<table width="96%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="400" valign="top"><img src="branco.gif" width="269" height="38"><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><br>
                  :: Cadastre-se ::</strong> </font><br>
                  <div align="justify">
                    <p align="justify"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cadastre-se 
                      e recebe nossa Mala-Direta com a apresenta&ccedil;&atilde;o 
                      da Empresa.</font></p>
                    <table cellspacing=0 cellpadding=0 width=516 border=0>
                      <tbody>
                        <tr> 
                          <td width=10 height=2>&nbsp;</td>
                          <td width=99 height=2><font color="#000000">&nbsp;</font></td>
                          <td valign=top width=407 height=2><font color="#000000">&nbsp;</font></td>
                        </tr>
                        <tr> 
                          <td width=10 height=2><font color=#19187e>&nbsp;</font></td>
                          <td width=99 height=2><div align="right"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><img height=10 
            src="seta_verde_esc.gif" width=8> <b>Nome :</b></font> <font color=#ffffff><img height=7 
            src="" width=10></font></div></td>
                          <td valign=top width=407 height=2> <font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <input 
            name=nome class=forms id="nome" size=45>
                            </font></td>
                        </tr>
                        <tr> 
                          <td height=1 colspan="3"><font color=#ffffff><img height=7 
            src="" width=21></font></td>
                        </tr>
                        <tr> 
                          <td width=10 height=2><font color=#19187e>&nbsp;</font></td>
                          <td width=99 height=2><div align="right"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><img height=10 
            src="seta_verde_esc.gif" width=8> <b>Empresa :</b></font><font color=#ffffff><img height=7 
            src="" width=10></font><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b> 
                              </b></font></div></td>
                          <td valign=top width=407 height=2> <font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <input 
            name=empresa class=forms id="empresa" size=45>
                            </font></td>
                        </tr>
                        <tr> 
                          <td colspan=3 height=7><font color=#ffffff><img height=7 
            src="" width=21></font></td>
                        </tr>
                        <tr> 
                          <td width=10 height=2>&nbsp;</td>
                          <td width=99 height=2><div align="right"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                              <b>Endereço : </b></font><font color=#ffffff><img height=7 
            src="" width=10></font></div></td>
                          <td valign=top width=407 height=2> <font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <input 
            name=endereco class=forms id="endereco" size=45>
                            </font></td>
                        </tr>
                        <tr> 
                          <td colspan=3 height=2><font color=#ffffff><img height=7 
            src="" width=21></font></td>
                        </tr>
                        <tr> 
                          <td width=10 height=2>&nbsp;</td>
                          <td width=99 height=2><div align="right"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                              <b>Bairro : </b></font><font color=#ffffff><img height=7 
            src="" width=10></font></div></td>
                          <td valign=top width=407 height=2> <font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <input 
            name=bairro class=forms id="bairro" size=45>
                            </font></td>
                        </tr>
                        <tr> 
                          <td colspan=3 height=2><font color=#ffffff><img height=7 
            src="" width=21></font></td>
                        </tr>
                        <tr> 
                          <td width=10 height=2>&nbsp;</td>
                          <td width=99 height=2><div align="right"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><img height=10 
            src="seta_verde_esc.gif" width=8> <b>Cidade :</b></font> <font color=#ffffff><img height=7 
            src="" width=10></font></div></td>
                          <td valign=top width=407 height=2> <table cellspacing=0 cellpadding=0 width="100%" border=0>
                              <tbody>
                                <tr> 
                                  <td width="47%"> <font color="#000000"> 
                                    <input name=cidade class=forms id="cidade" size=12>
                                    </font></td>
                                  <td width="13%"><font color=#000000><font 
                  face="Verdana, Arial, Helvetica, sans-serif" size=2><b><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img height=10 
            src="seta_verde_esc.gif" width=8></font> UF : </b></font></font></td>
                                  <td width="40%"><font color=#000000><font 
                  face="Verdana, Arial, Helvetica, sans-serif" size=2><b> 
                                    <input name=uf 
                  class=forms id="uf" size=17>
                                    </b></font></font></td>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                        <tr> 
                          <td colspan=3 height=2><font color=#ffffff><img height=7 
            src="" width=21></font></td>
                        </tr>
                        <tr> 
                          <td width=10 height=2>&nbsp;</td>
                          <td width=99 height=2><div align="right"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><img height=10 
            src="seta_verde_esc.gif" width=8> <b>Cep :</b></font> <font color=#ffffff><img height=7 
            src="" width=10></font></div></td>
                          <td valign=top width=407 height=2> <table cellspacing=0 cellpadding=0 width="100%" border=0>
                              <tbody>
                                <tr> 
                                  <td width="47%"> <font color="#000000"> 
                                    <input name=cep class=forms id="cep" size=12>
                                    </font></td>
                                  <td width="13%"><font color=#000000><font 
                  face="Verdana, Arial, Helvetica, sans-serif" size=2><b><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img height=10 
            src="seta_verde_esc.gif" width=8></font> Tel : </b></font></font></td>
                                  <td width="40%"><font color=#000000><font 
                  face="Verdana, Arial, Helvetica, sans-serif" size=2><b> 
                                    <input name=telefone 
                  class=forms id="telefone" size=17>
                                    </b></font></font></td>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                        <tr> 
                          <td colspan=3 height=2><font color=#ffffff><img height=7 
            src="" width=21></font></td>
                        </tr>
                        <tr> 
                          <td width=10 height=6>&nbsp;</td>
                          <td width=99 height=6><div align="right"><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><img height=10 
            src="seta_verde_esc.gif" width=8> <b>E-mail :</b></font> <font color=#ffffff><img height=7 
            src="" width=10></font></div></td>
                          <td width=407 height=6><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <input 
            name=email class=forms id="email" size=45>
                            </font></td>
                        </tr>
                        <tr> 
                          <td colspan=3 height=6><font color=#ffffff><img height=7 
            src="" width=21></font></td>
                        </tr>
                        <tr> 
                          <td width=10 height=59>&nbsp;</td>
                          <td colspan=2 height=59> <table cellspacing=0 cellpadding=0 width="100%" border=0>
                              <tr> 
                                <td width="4%" height="20">&nbsp;</td>
                                <td colspan="2" height="20">&nbsp;</td>
                                <td width="35%" colspan=2 height="20">&nbsp;</td>
                              </tr>
                              <tbody>
                                <tr> 
                                  <td width="4%" height="30">&nbsp; </td>
                                  <td colspan="2" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" color="#000000" size="2"><img height=10 
            src="seta_verde_esc.gif" width=8> Solicito uma apresenta&ccedil;&atilde;o 
                                    da empresa: </font></td>
                                  <td width="35%" colspan=2 height="30">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td width="4%">&nbsp;</td>
                                  <td width="30%"> <font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                    <input type="radio" name="optApresentacao" value="Email" checked>
                                    por e-mail</font></td>
                                  <td width="31%"> <font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                    <input type="radio" name="optApresentacao" value="Correio">
                                    pelo correio</font></td>
                                  <td width="35%" colspan=2>&nbsp;</td>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                        <tr> 
                          <td width=10 height=20>&nbsp;</td>
                          <td colspan=2 height=20><font color="#000000">&nbsp;</font></td>
                        </tr>
                        <tr> 
                          <td width=10 height=2>&nbsp;</td>
                          <td colspan=2 height=2><font color="#006666" size="2" face="Verdana, Arial, Helvetica, sans-serif"><img height=16 
            src="branco.gif" width=43><a href="javascript:limpa_formulario()"><img src="limpar.jpg" width="112" height="28" border="0"></a><img height=16 
            src="branco.gif" width=43> <a href="javascript:valida_formulario()"><img src="enviar.jpg" width="112" height="28" border="0"></a></font></td>
                        </tr>
                      </tbody>
                    </table>
                    <p align="justify">&nbsp;</p>
                    </div>
                  <p></p>
                  <p align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="tira.jpg" width="90%" height="2"><br>
                    PRO DAC Ar Condicionado LTDA.<br>
                    Rua Belford Duarte, 716- Vl. Sta. Catarina- Cep 04375-000- 
                    S&atilde;o Paulo- SP<br>
                    Fone: (11) 5566-6556 Fax: (11) 5563-5200 E-mail </font></p>
                  <p></p></td>
              </tr>
            </table>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
