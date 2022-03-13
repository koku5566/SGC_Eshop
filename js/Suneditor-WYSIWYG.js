// Note: This file must go AFTER the other imports

if(document.querySelector("#editor") != null) {
	editorimageResize = SUNEDITOR.create('editor', {
		font: ['Arial', 'Courier New', 'Georgia', 'Verdana', 'Tahoma'],
		toolbarContainer : '#toolbar_container',
		showPathLabel : false,
		charCounter : true,
		width : 'auto',
		height : 'auto',
		minHeight: '200px',
		maxHeight: '800px',
		placeholder: "Insert text here",
		
		// To set the editor to spanish		
		//lang: SUNEDITOR_LANG['es'], 		// Include this 	https://cdn.jsdelivr.net/npm/suneditor@latest/src/lang/es.js
		
		// To use math functions 			// Include this 	https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css
		//katex:katex, 						// Import this too 	https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js
		
		buttonList : [
			['undo', 'redo', 'font', 'fontSize', 'formatBlock'],
			
			// Katex (math) deactivated
			['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'removeFormat'],
			
			// Katex (math) Activated
			//['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'math', 'removeFormat'],

			['fontColor', 'hiliteColor', 'textStyle', 'lineHeight'],
			['align', 'indent', 'outdent', 'list', 'horizontalRule'],
			['link', 'image', 'video', 'table', 'codeView']
			
			// Extra buttons that are not usually needed
			//['link', 'image', 'video', 'table', 'fullScreen', 'showBlocks', 'codeView', 'print', 'save']
		],
		callBackSave : function (contents, isChanged) {
			console.log(contents);
		}
	});

	// Compress Images
	editorimageResize.onImageUploadBefore = function (files, info, core, uploadHandler) {
		try {
			ResizeImage(files, uploadHandler)
		} catch (err) {
			uploadHandler(err.toString())
		}
	};

	// Image resize capability
	function ResizeImage (files, uploadHandler) {
		const uploadFile = files[0];
		const img = document.createElement('img');
		const canvas = document.createElement('canvas');
		const reader = new FileReader();

		reader.onload = function (e) {
			img.src = e.target.result
			img.onload = function () {
				let ctx = canvas.getContext("2d");
				ctx.drawImage(img, 0, 0);

				const MAX_WIDTH = 200;
				const MAX_HEIGHT = 100;
				let width = img.width;
				let height = img.height;

				if (width > height) {
					if (width > MAX_WIDTH) {
						height *= MAX_WIDTH / width;
						width = MAX_WIDTH;
					}
				} else {
					if (height > MAX_HEIGHT) {
						width *= MAX_HEIGHT / height;
						height = MAX_HEIGHT;
					}
				}

				canvas.width = width;
				canvas.height = height;

				ctx = canvas.getContext("2d");
				ctx.drawImage(img, 0, 0, width, height);

				canvas.toBlob(function (blob) {
					uploadHandler([new File([blob], uploadFile.name)])
				}, uploadFile.type, 1);
			}
		}
		reader.readAsDataURL(uploadFile);
	}
}

if(document.querySelector("#editor-1") != null) {
	editorimageResize = SUNEDITOR.create('editor-1', {
		font: ['Arial', 'Courier New', 'Georgia', 'Verdana', 'Tahoma'],
		toolbarContainer : '#toolbar_container-1',
		showPathLabel : false,
		charCounter : true,
		width : 'auto',
		height : 'auto',
		minHeight: '200px',
		maxHeight: '800px',
		placeholder: "Insert text here",
		
		// To set the editor to spanish		
		//lang: SUNEDITOR_LANG['es'], 		// Include this 	https://cdn.jsdelivr.net/npm/suneditor@latest/src/lang/es.js
		
		// To use math functions 			// Include this 	https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css
		//katex:katex, 						// Import this too 	https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js
		
		buttonList : [
			['undo', 'redo', 'font', 'fontSize', 'formatBlock'],
			
			// Katex (math) deactivated
			['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'removeFormat'],
			
			// Katex (math) Activated
			//['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'math', 'removeFormat'],

			['fontColor', 'hiliteColor', 'textStyle', 'lineHeight'],
			['align', 'indent', 'outdent', 'list', 'horizontalRule'],
			['link', 'image', 'video', 'table', 'codeView']
			
			// Extra buttons that are not usually needed
			//['link', 'image', 'video', 'table', 'fullScreen', 'showBlocks', 'codeView', 'print', 'save']
		],
		callBackSave : function (contents, isChanged) {
			console.log(contents);
		}
	});

	// Compress Images
	editorimageResize.onImageUploadBefore = function (files, info, core, uploadHandler) {
		try {
			ResizeImage(files, uploadHandler)
		} catch (err) {
			uploadHandler(err.toString())
		}
	};

	// Image resize capability
	function ResizeImage (files, uploadHandler) {
		const uploadFile = files[0];
		const img = document.createElement('img');
		const canvas = document.createElement('canvas');
		const reader = new FileReader();

		reader.onload = function (e) {
			img.src = e.target.result
			img.onload = function () {
				let ctx = canvas.getContext("2d");
				ctx.drawImage(img, 0, 0);

				const MAX_WIDTH = 200;
				const MAX_HEIGHT = 100;
				let width = img.width;
				let height = img.height;

				if (width > height) {
					if (width > MAX_WIDTH) {
						height *= MAX_WIDTH / width;
						width = MAX_WIDTH;
					}
				} else {
					if (height > MAX_HEIGHT) {
						width *= MAX_HEIGHT / height;
						height = MAX_HEIGHT;
					}
				}

				canvas.width = width;
				canvas.height = height;

				ctx = canvas.getContext("2d");
				ctx.drawImage(img, 0, 0, width, height);

				canvas.toBlob(function (blob) {
					uploadHandler([new File([blob], uploadFile.name)])
				}, uploadFile.type, 1);
			}
		}
		reader.readAsDataURL(uploadFile);
	}
}

if(document.querySelector("#editor-2") != null) {
	editorimageResize = SUNEDITOR.create('editor-2', {
		font: ['Arial', 'Courier New', 'Georgia', 'Verdana', 'Tahoma'],
		toolbarContainer : '#toolbar_container-2',
		showPathLabel : false,
		charCounter : true,
		width : 'auto',
		height : 'auto',
		minHeight: '200px',
		maxHeight: '800px',
		placeholder: "Insert text here",
		
		// To set the editor to spanish		
		//lang: SUNEDITOR_LANG['es'], 		// Include this 	https://cdn.jsdelivr.net/npm/suneditor@latest/src/lang/es.js
		
		// To use math functions 			// Include this 	https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css
		//katex:katex, 						// Import this too 	https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js
		
		buttonList : [
			['undo', 'redo', 'font', 'fontSize', 'formatBlock'],
			
			// Katex (math) deactivated
			['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'removeFormat'],
			
			// Katex (math) Activated
			//['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'math', 'removeFormat'],

			['fontColor', 'hiliteColor', 'textStyle', 'lineHeight'],
			['align', 'indent', 'outdent', 'list', 'horizontalRule'],
			['link', 'image', 'video', 'table', 'codeView']
			
			// Extra buttons that are not usually needed
			//['link', 'image', 'video', 'table', 'fullScreen', 'showBlocks', 'codeView', 'print', 'save']
		],
		callBackSave : function (contents, isChanged) {
			console.log(contents);
		}
	});

	// Compress Images
	editorimageResize.onImageUploadBefore = function (files, info, core, uploadHandler) {
		try {
			ResizeImage(files, uploadHandler)
		} catch (err) {
			uploadHandler(err.toString())
		}
	};

	// Image resize capability
	function ResizeImage (files, uploadHandler) {
		const uploadFile = files[0];
		const img = document.createElement('img');
		const canvas = document.createElement('canvas');
		const reader = new FileReader();

		reader.onload = function (e) {
			img.src = e.target.result
			img.onload = function () {
				let ctx = canvas.getContext("2d");
				ctx.drawImage(img, 0, 0);

				const MAX_WIDTH = 200;
				const MAX_HEIGHT = 100;
				let width = img.width;
				let height = img.height;

				if (width > height) {
					if (width > MAX_WIDTH) {
						height *= MAX_WIDTH / width;
						width = MAX_WIDTH;
					}
				} else {
					if (height > MAX_HEIGHT) {
						width *= MAX_HEIGHT / height;
						height = MAX_HEIGHT;
					}
				}

				canvas.width = width;
				canvas.height = height;

				ctx = canvas.getContext("2d");
				ctx.drawImage(img, 0, 0, width, height);

				canvas.toBlob(function (blob) {
					uploadHandler([new File([blob], uploadFile.name)])
				}, uploadFile.type, 1);
			}
		}
		reader.readAsDataURL(uploadFile);
	}
}

if(document.querySelector("#editor-3") != null) {
	editorimageResize = SUNEDITOR.create('editor-3', {
		font: ['Arial', 'Courier New', 'Georgia', 'Verdana', 'Tahoma'],
		toolbarContainer : '#toolbar_container-3',
		showPathLabel : false,
		charCounter : true,
		width : 'auto',
		height : 'auto',
		minHeight: '200px',
		maxHeight: '800px',
		placeholder: "Insert text here",
		
		// To set the editor to spanish		
		//lang: SUNEDITOR_LANG['es'], 		// Include this 	https://cdn.jsdelivr.net/npm/suneditor@latest/src/lang/es.js
		
		// To use math functions 			// Include this 	https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css
		//katex:katex, 						// Import this too 	https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js
		
		buttonList : [
			['undo', 'redo', 'font', 'fontSize', 'formatBlock'],
			
			// Katex (math) deactivated
			['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'removeFormat'],
			
			// Katex (math) Activated
			//['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'math', 'removeFormat'],

			['fontColor', 'hiliteColor', 'textStyle', 'lineHeight'],
			['align', 'indent', 'outdent', 'list', 'horizontalRule'],
			['link', 'image', 'video', 'table', 'codeView']
			
			// Extra buttons that are not usually needed
			//['link', 'image', 'video', 'table', 'fullScreen', 'showBlocks', 'codeView', 'print', 'save']
		],
		callBackSave : function (contents, isChanged) {
			console.log(contents);
		}
	});

	// Compress Images
	editorimageResize.onImageUploadBefore = function (files, info, core, uploadHandler) {
		try {
			ResizeImage(files, uploadHandler)
		} catch (err) {
			uploadHandler(err.toString())
		}
	};

	// Image resize capability
	function ResizeImage (files, uploadHandler) {
		const uploadFile = files[0];
		const img = document.createElement('img');
		const canvas = document.createElement('canvas');
		const reader = new FileReader();

		reader.onload = function (e) {
			img.src = e.target.result
			img.onload = function () {
				let ctx = canvas.getContext("2d");
				ctx.drawImage(img, 0, 0);

				const MAX_WIDTH = 200;
				const MAX_HEIGHT = 100;
				let width = img.width;
				let height = img.height;

				if (width > height) {
					if (width > MAX_WIDTH) {
						height *= MAX_WIDTH / width;
						width = MAX_WIDTH;
					}
				} else {
					if (height > MAX_HEIGHT) {
						width *= MAX_HEIGHT / height;
						height = MAX_HEIGHT;
					}
				}

				canvas.width = width;
				canvas.height = height;

				ctx = canvas.getContext("2d");
				ctx.drawImage(img, 0, 0, width, height);

				canvas.toBlob(function (blob) {
					uploadHandler([new File([blob], uploadFile.name)])
				}, uploadFile.type, 1);
			}
		}
		reader.readAsDataURL(uploadFile);
	}
}

if(document.querySelector("#editor-4") != null) {
	editorimageResize = SUNEDITOR.create('editor-4', {
		font: ['Arial', 'Courier New', 'Georgia', 'Verdana', 'Tahoma'],
		toolbarContainer : '#toolbar_container-3',
		showPathLabel : false,
		charCounter : true,
		width : 'auto',
		height : 'auto',
		minHeight: '200px',
		maxHeight: '800px',
		placeholder: "Insert text here",
		
		// To set the editor to spanish		
		//lang: SUNEDITOR_LANG['es'], 		// Include this 	https://cdn.jsdelivr.net/npm/suneditor@latest/src/lang/es.js
		
		// To use math functions 			// Include this 	https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css
		//katex:katex, 						// Import this too 	https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js
		
		buttonList : [
			['undo', 'redo', 'font', 'fontSize', 'formatBlock'],
			
			// Katex (math) deactivated
			['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'removeFormat'],
			
			// Katex (math) Activated
			//['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'math', 'removeFormat'],

			['fontColor', 'hiliteColor', 'textStyle', 'lineHeight'],
			['align', 'indent', 'outdent', 'list', 'horizontalRule'],
			['link', 'image', 'video', 'table', 'codeView']
			
			// Extra buttons that are not usually needed
			//['link', 'image', 'video', 'table', 'fullScreen', 'showBlocks', 'codeView', 'print', 'save']
		],
		callBackSave : function (contents, isChanged) {
			console.log(contents);
		}
	});

	// Compress Images
	editorimageResize.onImageUploadBefore = function (files, info, core, uploadHandler) {
		try {
			ResizeImage(files, uploadHandler)
		} catch (err) {
			uploadHandler(err.toString())
		}
	};

	// Image resize capability
	function ResizeImage (files, uploadHandler) {
		const uploadFile = files[0];
		const img = document.createElement('img');
		const canvas = document.createElement('canvas');
		const reader = new FileReader();

		reader.onload = function (e) {
			img.src = e.target.result
			img.onload = function () {
				let ctx = canvas.getContext("2d");
				ctx.drawImage(img, 0, 0);

				const MAX_WIDTH = 200;
				const MAX_HEIGHT = 100;
				let width = img.width;
				let height = img.height;

				if (width > height) {
					if (width > MAX_WIDTH) {
						height *= MAX_WIDTH / width;
						width = MAX_WIDTH;
					}
				} else {
					if (height > MAX_HEIGHT) {
						width *= MAX_HEIGHT / height;
						height = MAX_HEIGHT;
					}
				}

				canvas.width = width;
				canvas.height = height;

				ctx = canvas.getContext("2d");
				ctx.drawImage(img, 0, 0, width, height);

				canvas.toBlob(function (blob) {
					uploadHandler([new File([blob], uploadFile.name)])
				}, uploadFile.type, 1);
			}
		}
		reader.readAsDataURL(uploadFile);
	}
}