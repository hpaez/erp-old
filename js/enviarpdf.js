function validarPDF(){    
	if(contrato.checked==true){
		document.form1.action='pdf/contrato.php';
		
	}else{
		document.form1.action='pdf/finiquito.php'
	}
    
	document.form1.submit();
}