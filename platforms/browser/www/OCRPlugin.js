var OCRPlugin = { 
	name="com.jcesarmobile.OCRPlugin" value="OCRPlugin"
	callNativeFunction: function (success, fail, resultType) { 
 
		return Cordova.exec( success, fail, "com.jcesarmobile.OCRPlugin", "recogniseOCR", [resultType]); 
		} 
	};