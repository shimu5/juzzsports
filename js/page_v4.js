/*
    Included using page template class.
    Includes DYN_WEB.Event, some DYN_WEB.Util
    
    dw_checkTmplHeight (push footer down on short pages)
    PP_Donate, dw_getPPBus (prices.php and donate)
    
    Break out of iframes.
*/

// break out of iframe
if ( top !== self ) {
    top.location = self.location;
}

// DYN_WEB is namespace used for code from dyn-web.com
// replacing previous use of dw_ prefix for object names
var DYN_WEB = DYN_WEB || {};

/*
    dw_event.js - version date May 2013 (added .domReady)
    .domReady is whenReady fn (slightly modified) from JavaScript the Definitive Guide
    6th edition by David Flanagan, example 17.01
*/
DYN_WEB.Event=(function(Ev){Ev.add=document.addEventListener?function(obj,etype,fp,cap){cap=cap||false;obj.addEventListener(etype,fp,cap);}:function(obj,etype,fp){obj.attachEvent('on'+etype,fp);};Ev.remove=document.removeEventListener?function(obj,etype,fp,cap){cap=cap||false;obj.removeEventListener(etype,fp,cap);}:function(obj,etype,fp){obj.detachEvent('on'+etype,fp);};Ev.DOMit=function(e){e=e?e:window.event;if(!e.target){e.target=e.srcElement;}if(!e.preventDefault){e.preventDefault=function(){e.returnValue=false;return false;};}if(!e.stopPropagation){e.stopPropagation=function(){e.cancelBubble=true;};}return e;};Ev.getTarget=function(e){e=Ev.DOMit(e);var tgt=e.target;if(tgt.nodeType!==1){tgt=tgt.parentNode;}return tgt;};Ev.domReady=(function(){var funcs=[];var ready=false;function handler(e){if(ready){return;}if(e.type==="readystatechange"&&document.readyState!=="complete"){return;}for(var i=0,len=funcs.length;i<len;i++){funcs[i].call(document);}ready=true;funcs=[];}if(document.addEventListener){document.addEventListener("DOMContentLoaded",handler,false);document.addEventListener("readystatechange",handler,false);window.addEventListener("load",handler,false);}else if(document.attachEvent){document.attachEvent("onreadystatechange",handler);window.attachEvent("onload",handler);}return function whenReady(f){if(ready){f.call(document);}else{funcs.push(f);}};})();return Ev;})(DYN_WEB.Event||{});



function dw_getWindowDims() {
    var doc = document, w = window;
    var docEl = (doc.compatMode && doc.compatMode === 'CSS1Compat')? doc.documentElement: doc.body;
    
    var width = docEl.clientWidth;
    var height = docEl.clientHeight;
    
    // mobile zoomed in?
    if ( w.innerWidth && width > w.innerWidth ) {
        width = w.innerWidth;
        height = w.innerHeight;
    }
    
    return {width: width, height: height};
}


// to push footer down on short pages
function dw_checkTmplHeight() {
    var ht = dw_getWindowDims().height;
    document.getElementById('content').style.minHeight = ht - 120 + "px";
}
dw_checkTmplHeight.timer = null;

DYN_WEB.Event.domReady( dw_checkTmplHeight );
DYN_WEB.Event.add(window, 'load', dw_checkTmplHeight);

DYN_WEB.Event.add(window, 'resize', function() {
    if ( dw_checkTmplHeight.timer ) {
        clearTimeout( dw_checkTmplHeight.timer );
    }
    dw_checkTmplHeight.timer = setTimeout( dw_checkTmplHeight, 100 );
});

