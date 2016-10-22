var menuvue = new Vue({
	el: '#sidebar-menu',
	data: {
		isberitaactive : false
		,isartikelactive : false
		,beritastyle : null
		,artikelstyle : null
		,populer : false
		,terbaru : false
		,umum : false
		,acara : false
		,pengaduan : false
		,isloginactive : false
		,androidpage : false
	}
});

var deleteArrayValue = function( arr, me ){
   var i = arr.length;
   while( i-- ) if(arr[i] === me ) arr.splice(i,1);
}