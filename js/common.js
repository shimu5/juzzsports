var ajaxPreviewHtml = "<img src='/images/loading.gif' border='0' align='absmiddle' /><b>Loading...</b>";

function getAjaxListOfData(divname, url)
{	
	divname = "#" + divname;
	jQuery(divname).html(ajaxPreviewHtml).load(url);
}

function openPopupWinComs(url,width,height,mx,my)
{
	window.name = 'mainWin'; // needed to make sure existing popup isn't reused in some cases 
    prevWin = open(url, "prevWin", "toolbar=no,width="+width+",height="+height+",directories=no,status=no,scrollbars=yes, resize=no, menubar=no");
    prevWin.focus();    
}

