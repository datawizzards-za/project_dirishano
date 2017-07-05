function crearPopUp(texto, titulo, ancho, alto)
{
	if (document.getElementById("DivPopUpWindow") == null)
	{
		var xpos = 0, ypos = 0;
		var myWidth = 0, myHeight = 0; // Nueva Forma de Capturar el Tamaño de la Ventana del Navegador	
		if( typeof( window.innerWidth ) == 'number' ) 
		{
			//Non-IE
			myWidth = window.innerWidth;
			myHeight = window.innerHeight;
		} 
		else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) 
		{
			//IE 6+ in 'standards compliant mode'
			myWidth = document.documentElement.clientWidth;
			myHeight = document.documentElement.clientHeight;
			} else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
			//IE 4 compatible
			myWidth = document.body.clientWidth;
			myHeight = document.body.clientHeight;
		}
		xpos = myWidth;
    	ypos = myHeight;
		var formulario = document.forms[0];
		xpos = ( xpos / 2 ) - ( ancho / 2 );
		ypos = ( ypos / 2 ) - ( alto / 2 );
		if (navigator.appName.indexOf("Microsoft")!=-1)		// Si el navegador es IE pone un iframe abajo del Div 
		{  
			ly = document.createElement('iframe');          // para prevenir el sobreposicionamiento de las etiquetas SELECT
			ly.setAttribute('id',"lyPopUpWindow");
			ly.style.position="absolute";       
			ly.style.pixelWidth=ancho;
			ly.style.pixelHeight=alto;
			ly.style.pixelHeight=alto;
			ly.style.border = "0px none #cccccc";
			formulario.appendChild(ly);
			document.getElementById("lyPopUpWindow").style.left = "50px";
			document.getElementById("lyPopUpWindow").style.top = 100 + "px";
		}
		dv = document.createElement('div');
		dv.setAttribute('id',"DivPopUpWindow");
		dv.style.position="absolute";       
		dv.style.pixelWidth=ancho;
		dv.style.pixelHeight=alto;
		dv.style.backgroundColor="#F4F7F5";
		dv.style.border = "1px solid #cccccc";
		dv.innerHTML='<table width="' + ancho + '"  border="0" cellpadding="6" cellspacing="1"><tr class="tit_tabla"><td align="left"><strong>'
		+ titulo + '</strong></td></tr><tr class="tr_osc"><td align="center">'
		+ texto + '</td></tr>'
		+ '<tr><td align="center"><input name="btnAceptarPopUp" type="button" class="btn-group btn-primary wave-effects" style="padding:4px 6px;" id="btnAceptarPopUp" value="Accept" class="botones" onclick="destruirPopUp();"></td></tr></table>';
		formulario.appendChild(dv);
		document.getElementById("DivPopUpWindow").style.left = xpos + "px";
		document.getElementById("DivPopUpWindow").style.top = ypos + "px";
	}
}
function destruirPopUp()
{
	var formulario = document.forms[0];
	formulario.removeChild(document.getElementById("DivPopUpWindow"));
	if (navigator.appName.indexOf("Microsoft")!=-1) // si es IE elimina el iframe
	{
		formulario.removeChild(document.getElementById("lyPopUpWindow"));
	}
}
// ================================= POP UP =====================================

function crearPopUpConfirmacion(texto, titulo, ancho, alto, jsaccion, params)
{
	if (document.getElementById("DivPopUpWindow") == null)
	{
		var xpos = 0, ypos = 0;
		var myWidth = 0, myHeight = 0; 	
		if( typeof( window.innerWidth ) == 'number' ) 
		{
			//Non-IE
			myWidth = window.innerWidth;
			myHeight = window.innerHeight;
		} 
		else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) 
		{
			//IE 6+ in 'standards compliant mode'
			myWidth = document.documentElement.clientWidth;
			myHeight = document.documentElement.clientHeight;
			} else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
			//IE 4 compatible
			myWidth = document.body.clientWidth;
			myHeight = document.body.clientHeight;
		}
		xpos = myWidth;
    	ypos = myHeight;
		var formulario = document.forms[0];
		xpos = ( xpos / 2 ) - ( ancho / 2 );
		ypos = ( ypos / 2 ) - ( alto / 2 );
		if (navigator.appName.indexOf("Microsoft")!=-1)		 
		{  
			ly = document.createElement('iframe');          
			ly.setAttribute('id',"lyPopUpWindow");
			ly.style.position="absolute";       
			ly.style.pixelWidth=ancho;
			ly.style.pixelHeight=alto;
			ly.style.pixelHeight=alto;
			ly.style.border = "0px none #cccccc";
			formulario.appendChild(ly);
			document.getElementById("lyPopUpWindow").style.left = xpos + "px";
			document.getElementById("lyPopUpWindow").style.top = ypos + "px";
		}
		dv = document.createElement('div');
		dv.setAttribute('id',"DivPopUpWindow");
		dv.style.position="absolute";       
		dv.style.pixelWidth=ancho;
		dv.style.pixelHeight=alto;
		dv.style.backgroundColor="#F4F7F5";
		dv.style.border = "1px solid #cccccc";
		dv.innerHTML='<table width="' + ancho + '"><tr class="tit_tabla"><td align="left"><strong>'
		+ titulo + '</strong></td></tr><tr class="tr_osc"><td align="center">'
		+ texto + '</td></tr>'
		+ '<tr><td align="center"><input name="btnAceptarPopUp" type="button" class="btn-group btn-primary wave-effects" style="padding:4px 6px;color:white" id="btnAceptarPopUp" value="Accept" class="botones" onclick="'+jsaccion+'; destruirPopUp();">&nbsp;<input type="hidden" id="popUpParamsHidden" name="popUpParamsHidden" value="'+params+'"><input name="btnCancelPopUp" type="button" id="btnCancelPopUp" class="btn-group btn-danger wave-effects" style="padding:4px 6px;color:white"value="Cancel" class="botones" onclick="msgboxProcesando(false); destruirPopUp();"></td></tr></table>';
		formulario.appendChild(dv);
		document.getElementById("DivPopUpWindow").style.left = xpos + "px";
		document.getElementById("DivPopUpWindow").style.top = ypos + "px";
	}
}

// =================================/////////////////=====================================


function msgboxProcesando(activar)
{
	var ruta_imagen = "images/ajax_loading.gif"; 
	var ancho = 189; 
	var alto = 20; 
	var xpos; 
	var ypos;
	if (document.getElementById("layerProcesandoSolicitud") == null)
	{
		
		var formulario = document.getElementById("contenedor");
		dv = document.createElement('div');
		dv.setAttribute('id',"layerProcesandoSolicitud");
		dv.style.position="absolute";       
		dv.style.width=ancho+'px'; 
		dv.style.height=alto+'px'; 
		dv.style.backgroundColor="#FFFFCC";
		dv.style.border = "1px solid #cccccc";
		dv.innerHTML=' <div align="center"><table width="100%" height="' + alto + '" border="0"><tr><td align="center"> <span class="EstiloProcesando" > Procesando Solicitud... </span></td></tr></table></div>';
		formulario.appendChild(dv);
	}
	var lp = document.getElementById("layerProcesandoSolicitud"); // Obtiene la Referencia al Objeto DIV Creado
	if (activar)
	{
			
		var myWidth = 0, myHeight = 0;
		if( typeof( window.innerWidth ) == 'number' ) 
		{
			//Non-IE
			myWidth = window.innerWidth;
			myHeight = window.innerHeight;
		} 
		else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) 
		{
			//IE 6+ in 'standards compliant mode'
			myWidth = document.documentElement.clientWidth;
			myHeight = document.documentElement.clientHeight;
			} else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
			//IE 4 compatible
			myWidth = document.body.clientWidth;
			myHeight = document.body.clientHeight;
		}
		xpos = myWidth;
    	ypos = myHeight;
    	if (navigator.appName.indexOf("Microsoft")!=-1)
    	{
		    xpos = xpos - (ancho+6);//195;
		    ypos = ypos - (alto+6);//39;
		}
		else
		{
		    xpos = xpos - (ancho+26);//195;
		    ypos = ypos - (alto+15);//39;
		}
		ypos = 5; // para hacer que aparezca en la parte superior
		lp.style.visibility = "visible";
		lp.style.left = xpos + "px";
		lp.style.top = ypos + "px";
	}
	else
	{
		lp.style.visibility = "hidden";
	}
}
window.onload = function()
{
    msgboxProcesando(false);
}
// =================================/////////////////=====================================