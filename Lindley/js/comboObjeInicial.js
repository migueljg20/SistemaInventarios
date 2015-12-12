
function agregarInicio(){
	ajax = creaobjeto();
	var Empresa = document.getElementById('empresa').value;
	ajax.open("GET","../scripts/agregarObjetivoInicial.php?Empresa="+Empresa,true);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4)
		{			 
			 inicial.innerHTML = ajax.responseText;

		}
	}
	ajax.send(null);
}




function creaobjeto() 
{
	try 
	{
		_ajaxobj = new ActiveXObject("Msxml2.XMLHTTP");
	} 
	catch (e) 
	{
		try 
		{
			_ajaxobj = new ActiveXObject("Microsoft.XMLHTTP");
		} 
		catch (E) 
		{
			_ajaxobj = false;
		}
	}   
	if (!_ajaxobj && typeof XMLHttpRequest!='undefined')
		_ajaxobj = new XMLHttpRequest();
		
	return _ajaxobj;
}