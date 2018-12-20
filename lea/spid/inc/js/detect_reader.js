//Netscape---detection
var isAcrobat,isBeatnik,isCosmo,isFlash,isMPlayer,isQuickT,isRPlayer,isSVG;
isAcrobat = navigator.mimeTypes &&
navigator.mimeTypes["application/pdf"] &&
navigator.mimeTypes["application/pdf"].enabledPlugin;
isBeatnik = navigator.mimeTypes &&
navigator.mimeTypes["application/x-beatnik"] &&
navigator.mimeTypes["application/x-beatnik"].enabledPlugin;
isCosmo = navigator.mimeTypes &&
navigator.mimeTypes["application/x-cosmo"] &&
navigator.mimeTypes["application/x-cosmo"].enabledPlugin;
isFlash = navigator.mimeTypes &&
navigator.mimeTypes["application/x-shockwave-flash"] &&
navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin;
isMPlayer = navigator.mimeTypes &&
navigator.mimeTypes["application/x-mediaplayer"] &&
navigator.mimeTypes["application/x-mediaplayer"].enabledPlugin;
isQuickT = navigator.mimeTypes &&
navigator.mimeTypes["video/quicktime"] &&
navigator.mimeTypes["video/quicktime"].enabledPlugin;
isRPlayer = navigator.mimeTypes &&
navigator.mimeTypes["application/x-realplayer"] &&
navigator.mimeTypes["application/x-realplayer"].enabledPlugin; //"audio/x-pn-realaudio-plugin"
isSVG = navigator.mimeTypes &&
navigator.mimeTypes[" image/svg+xml"] &&
navigator.mimeTypes[" image/svg+xml"].enabledPlugin;

var msg="";
var isReader=false;
if (isAcrobat) {msg = msg + "-Adobe Acrobat Reader detected \n";isReader=true;}
if (isBeatnik) {msg = msg + "-Beatnik detected \n";}
if (isCosmo) {msg = msg + "-Cosmo 3D detected \n";}
if (isFlash) {msg = msg + "-Macromedia Flashwave detected \n";}
if (isMPlayer) {msg = msg + "-Windows MediaPlayer detected \n";}
if (isQuickT) {msg = msg + "-Apple QuickTime detected \n";}
if (isRPlayer) {msg = msg + "-RealPlayer detected \n";}
if (isSVG) {msg = msg + "-Adobe SVG Viewer detected \n";}
if (msg==""){ msg="None Plug-in detected";}


function get_result() {
	document.getElementById('text1').value = msg;
}

function get_reader() {
	return isReader;
}
