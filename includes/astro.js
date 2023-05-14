/*
 * Common use functions
 */
  	function goIndex()
  	{
  		document.location.href ="index.php";
  	}
	function goBack()
	{
		window.history.back();
	}

	function menuOn()
	{
		im =document.getElementById("menu_"+arguments[0]);
		im.src ="../images/menu_"+arguments[1]+"_"+arguments[0]+"_on.jpg";
	}
	function menuOff()
	{
		im =document.getElementById("menu_"+arguments[0]);
		im.src ="../images/menu_"+arguments[1]+"_"+arguments[0]+".jpg";
	}

	function canviIdioma(lang)
	{
		pagina = document.location.href.split('?')[0];
		if (document.location.href.split('?')[1] != null) {
			pagina +="?";
		    rest  = document.location.href.split('?')[1]
			slash = rest.split('&');
			var j =0;
			while (j < slash.length)
			{
				if (slash[j] !='lang=es' && slash[j] !='lang=ca' && slash[j] !='lang=en') pagina += '&'+slash[j];
				j++;
			}
			if (j >0) pagina +="&";
			pagina +="lang="+lang;
		}
		else {
			pagina +='?lang='+lang;
		}
		
		sLanguage = lang;
		window.location.href =pagina;
	}

/*
 * Other functions
 */
 
function NBmouseover(index)
{
    var normal = document.getElementById("navbar_"+index+"_normal");
    var rollover = document.getElementById("navbar_"+index+"_rollover");
    if (normal && rollover)
    {
        normal.style.visibility = "hidden";
        rollover.style.visibility = "visible";
    }
    return true;
}

/*
 * Other functions
 */
 
function NBmouseover(index)
{
    var normal = document.getElementById("navbar_"+index+"_normal");
    var rollover = document.getElementById("navbar_"+index+"_rollover");
    if (normal && rollover)
    {
        normal.style.visibility = "hidden";
        rollover.style.visibility = "visible";
    }
    return true;
}

function NBmouseout(index)
{
    var normal = document.getElementById("navbar_"+index+"_normal");
    var rollover = document.getElementById("navbar_"+index+"_rollover");
    if (normal && rollover)
    {
        normal.style.visibility = "visible";
        rollover.style.visibility = "hidden";
    }
    return true;
}

var smallTransparentGif = "";
function fixupIEPNG(strImageID, transparentGif) 
{
    smallTransparentGif = transparentGif;
    if (windowsInternetExplorer && (browserVersion < 7))
    {
        var img = document.getElementById(strImageID);
        if (img)
        {
            var src = img.src;
            img.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "', sizingMethod='scale')";
            img.src = transparentGif;
            img.attachEvent("onpropertychange", imgPropertyChanged);
        }
    }
}

var windowsInternetExplorer = false;
var browserVersion = 0;
function detectBrowser()
{
    windowsInternetExplorer = false;
    var appVersion = navigator.appVersion;
    if ((appVersion.indexOf("MSIE") != -1) &&
        (appVersion.indexOf("Macintosh") == -1))
    {
        var temp = appVersion.split("MSIE");
        browserVersion = parseFloat(temp[1]);
        windowsInternetExplorer = true;
    }
}

var inImgPropertyChanged = false;
function imgPropertyChanged()
{
    if ((window.event.propertyName == "src") && (! inImgPropertyChanged))
    {
        inImgPropertyChanged = true;
        var el = window.event.srcElement;
        if (el.src != smallTransparentGif)
        {
            el.filters.item(0).src = el.src;
            el.src = smallTransparentGif;
        }
        inImgPropertyChanged = false;
    }
}

function fixupIEPNGBG(oBlock) 
{
    if (oBlock)
    {
        var currentBGImage = oBlock.currentStyle.backgroundImage;
        var currentBGRepeat = oBlock.currentStyle.backgroundRepeat;
        var urlStart = currentBGImage.indexOf('url(');
        var urlEnd = currentBGImage.indexOf(')', urlStart);
        var imageURL = currentBGImage.substring(urlStart + 4, urlEnd);

        if (imageURL.charAt(0) == '"')
        {
            imageURL = imageURL.substring(1);
        }
        
        if (imageURL.charAt(imageURL.length - 1) == '"')
        {
            imageURL = imageURL.substring(0, imageURL.length - 1);
        }

        var overrideRepeat = false;

        var filterStyle =
            "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" +
            imageURL +
            "', sizingMethod='crop');";

        if (RegExp("/C[0-9A-F]{8}.png$").exec(imageURL) != null)
        {
            filterStyle =
                "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" +
                imageURL +
                "', sizingMethod='scale');";

            overrideRepeat = true;
        }

        var backgroundImage = new Image();
        backgroundImage.src = imageURL;
        var tileWidth = backgroundImage.width;
        var tileHeight = backgroundImage.height; 
        
        var blockWidth = 0;
        var blockHeight = 0;
        if (oBlock.style.width)
        {
            blockWidth = parseInt(oBlock.style.width);
        }
        else
        {
            blockWidth = oBlock.offsetWidth;
        }
        if (oBlock.style.height)
        {
            blockHeight = parseInt(oBlock.style.height);
        }
        else
        {
            blockHeight = oBlock.offsetHeight;
        }

        if ((blockWidth == 0) || (blockHeight == 0))
        {
            return;
        }
        
        var wholeRows = 1;
        var wholeCols = 1;
        var extraHeight = 0;
        var extraWidth = 0;
        
        if ((currentBGRepeat.indexOf("no-repeat") != -1) ||
              ((tileWidth == 0) && (tileHeight == 0)) ||
              overrideRepeat)
        {
            tileWidth = blockWidth;
            tileHeight = blockHeight;

        }
        else if ((currentBGRepeat.indexOf("repeat-x") != -1) ||
              (tileHeight == 0))
        {
            wholeCols = Math.floor(blockWidth / tileWidth);
            extraWidth = blockWidth - (tileWidth * wholeCols);
            tileHeight = blockHeight;

        }
        else if (currentBGRepeat.indexOf("repeat-y") != -1)
        {
            wholeRows = Math.floor(blockHeight / tileHeight);
            extraHeight = blockHeight - (tileHeight * wholeRows);
            tileWidth = blockWidth;

        }
        else
        {
            wholeCols = Math.floor(blockWidth / tileWidth);
            wholeRows = Math.floor(blockHeight / tileHeight);
            extraWidth = blockWidth - (tileWidth * wholeCols);
            extraHeight = blockHeight - (tileHeight * wholeRows);
        }
        
        var wrappedContent = document.createElement("div");
        wrappedContent.style.position = "relative";
        wrappedContent.style.zIndex = "1";
        wrappedContent.style.left = "0px";
        wrappedContent.style.top = "0px";
        if (!isNaN(parseInt(oBlock.style.width)))
        {
            wrappedContent.style.width = "" + blockWidth + "px";
        }
        if (!isNaN(parseInt(oBlock.style.height)))
        {
            wrappedContent.style.height = "" + blockHeight + "px";
        }
        var pngBGFixIsWrappedContentEmpty = true;
        while (oBlock.hasChildNodes())
        {
            if (oBlock.firstChild.nodeType == 3)
            {
                if (RegExp("^ *$").exec(oBlock.firstChild.data) == null)
                {
                    pngBGFixIsWrappedContentEmpty = false;
                }
            }
            else
            {
                pngBGFixIsWrappedContentEmpty = false;
            }
            wrappedContent.appendChild(oBlock.firstChild);
        }
        if (pngBGFixIsWrappedContentEmpty)
        {
            wrappedContent.style.lineHeight = "0px";
        }
        
        var newMarkup = "";
        for (var currentRow = 0; 
             currentRow < wholeRows; 
             currentRow++)
        {
            for (currentCol = 0; 
                 currentCol < wholeCols; 
                 currentCol++)
            {
                newMarkup += "<div style=" +
                        "\"position: absolute; line-height: 0px; " +
                        "width: " + tileWidth + "px; " +
                        "height: " + tileHeight + "px; " +
                        "left:" + currentCol *  tileWidth + "px; " +
                        "top:" + currentRow *  tileHeight + "px; " +
                        "filter:" + filterStyle + 
                        "\" > </div>";
            }
            
            if (extraWidth != 0)
            {
                newMarkup += "<div style=" +
                        "\"position: absolute; line-height: 0px; " +
                        "width: " + extraWidth + "px; " +
                        "height: " + tileHeight + "px; " +
                        "left:" + currentCol *  tileWidth + "px; " +
                        "top:" + currentRow *  tileHeight + "px; " +
                        "filter:" + filterStyle + 
                        "\" > </div>";
            }
        }
        
        if (extraHeight != 0)
        {
            for (currentCol = 0; 
                 currentCol < wholeCols; 
                 currentCol++)
            {
                newMarkup += "<div style=" +
                        "\"position: absolute; line-height: 0px; " +
                        "width: " + tileWidth + "px; " +
                        "height: " + extraHeight + "px; " +
                        "left:" + currentCol *  tileWidth + "px; " +
                        "top:" + currentRow *  tileHeight + "px; " +
                        "filter:" + filterStyle + 
                        "\" > </div>";
            }
            
            if (extraWidth != 0)
            {
                newMarkup += "<div style=" +
                        "\"position: absolute; line-height: 0px; " +
                        "width: " + extraWidth + "px; " +
                        "height: " + extraHeight + "px; " +
                        "left:" + currentCol *  tileWidth + "px; " +
                        "top:" + currentRow *  tileHeight + "px; " +
                        "filter:" + filterStyle + 
                        "\" > </div>";
            }
        }
        oBlock.innerHTML = newMarkup;

        oBlock.appendChild(wrappedContent);
        oBlock.style.background= "";
    }
}

function fixupAllIEPNGBGs()
{
    if (windowsInternetExplorer && (browserVersion < 7))
    {
        try
        {
            var oDivNodes = document.getElementsByTagName('DIV');
            for (var iIndex=0; iIndex<oDivNodes.length; iIndex++)
            {
                var oNode = oDivNodes.item(iIndex);
                if (oNode.currentStyle &&
                    oNode.currentStyle.backgroundImage &&
                    (oNode.currentStyle.backgroundImage.indexOf('url(') != -1) &&
                    (oNode.currentStyle.backgroundImage.indexOf('.png")') != -1))
                {
                    fixupIEPNGBG(oNode);
                }
            }
        }
        catch (e)
        {
        }
    }
}

function onPageLoad()
{
    detectBrowser();
    fixupIEPNG("id1", "../images/transparent.gif");
    fixupIEPNG("id2", "../images/transparent.gif");
    fixupAllIEPNGBGs();
    fixupIEPNG("id3", "../images/transparent.gif");
    fixupIEPNG("id4", "../images/transparent.gif");
    fixupIEPNG("id5", "../images/transparent.gif");
    fixupIEPNG("id6", "../images/transparent.gif");
    fixupIEPNG("id7", "../images/transparent.gif");
    fixupIEPNG("id8", "../images/transparent.gif");
    fixupIEPNG("id9", "../images/transparent.gif");
    fixupIEPNG("id10", "../images/transparent.gif");
    fixupIEPNG("id11", "../images/transparent.gif");
    fixupIEPNG("id12", "../images/transparent.gif");
    return true;
}

	function setFrameTitle()
	{
		if (arguments[1]) var tt = document.getElementById("title"+arguments[1]);
		else var tt = document.getElementById("title");
		tt.innerHTML =arguments[0];
	}

function doPrint()
{
        if ( arguments.length != 0 )
        {
           var vLay = document.getElementById(arguments[0]);
        } 
        else 
        {
        	//default nlayout name
           var vLay = document.getElementById("printLayoutTable");
           if (vLay == null) vLay = document.getElementById("printLayoutTable1");
        }

        var j = window.open('','','menubar=no,scrollbars=yes,status=no,dependent=yes,toolbar=yes,height=500,width=800,left=50,top=50');
		j.document.open();
        j.document.writeln('<html>');
        j.document.writeln('<head>');
        j.document.writeln('<title>');
        j.document.writeln(document.title);
        j.document.writeln('</title>');
        j.document.writeln('<link href= "../includes/print.css" rel="stylesheet">');
        j.document.writeln('</head>');
        j.document.writeln('<body id="body">');

		var vTitulo = document.getElementById("TitleBar");
        if (vTitulo != null)
        {
            j.document.writeln("<table><tr><td>");
            j.document.writeln(vTitulo.rows[0].innerHTML);
            j.document.writeln("</td></tr></table>");
        }
		j.document.writeln(vLay.innerHTML);

        j.document.writeln('<script>');

		// Hides elements in the form like buttons...
		// Elements to hide are refered as hideLayoutTable_<seq>

		for (i=1;;i++)
		{																							   
        	var vLay = document.getElementById("hideLayoutTable_"+i);
			if (vLay == null) break;

			j.document.writeln('  var vLay'+i+' = document.getElementById("hideLayoutTable_'+i+'");');
			j.document.writeln('  vLay'+i+'.style.display="none";');
		}
        j.document.writeln('  window.print();');
        j.document.writeln('</script>');
        j.document.writeln('</body>');
        j.document.writeln('</html>');

		j.document.close();
  }
