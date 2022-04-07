const imgInp = document.getElementById('upload_file');

    imgInp.addEventListener('change', function handleChange(event) { 
        const [file] = imgInp.files;

        var extArr = ["jpg", "jpeg", "png"];

        for (var i = 0; i < imgInp.files.length; i++) {
            if (imgInp.files[i]) {
                var ext = imgInp.files[i].name.split('.').pop();
                if(extArr.includes(ext)){
                    ;
                }

                else{
                    alert("This document is not a valid format");
                    imgInp.value = "";
                    break;
                }
            }
        }
    });