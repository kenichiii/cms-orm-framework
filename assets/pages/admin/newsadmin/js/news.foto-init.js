


function activateFotoFormListener()
{
    activateFotoListeners();
    
if (("addEventListener" in window) && ("FileReader" in window) && ("FormData" in window)) {

} else {
 $("#news-foto-file-output").html("Upload obrázku není Vaším prohlížečem podporován");
}

$("#news-foto-file-upload").hide();
$("#news-foto-button-upload").unbind('click').click(function(){
    $("#news-foto-file-upload").trigger('click');
    return false;
});    
    
var 
    filesUpload = document.getElementById("news-foto-file-upload"),
    fileList = document.getElementById("news-foto-file-output")
  ;


function uploadFile (file) {
        var 
            li = document.createElement("div"),
            div = document.createElement("div"),
            img,
            progressBarContainer = document.createElement("div"),
            progressBar = document.createElement("div"),
            reader,
            xhr,
            fileInfo;
  
    if (typeof FileReader !== "undefined" && (/image/i).test(file.type)) {
            img = document.createElement("img");
            $(img).attr('width',85).attr('height',85).css({'float':'left','padding-right':'12px','padding-bottom':'10px','padding-left':'10px'});
            li.appendChild(img);
            reader = new FileReader();
            reader.onload = (function (theImg) {
                                return function (evt) {
                                    theImg.src = evt.target.result;
                                };
                             }(img));

            reader.readAsDataURL(file);
     }

    li.appendChild(div);

    $(li).css({'float':'left','width':'360px'});

    progressBarContainer.className = "news-foto-progress-bar-container";
    progressBar.className = "news-foto-progress-bar";
    progressBarContainer.appendChild(progressBar);
    li.appendChild(progressBarContainer);


    // Create a new FormData object.

    var formData = new FormData();

    formData.append('photo', file, file.name);

        // Uploading - for Firefox, Google Chrome and Safari
        xhr = new XMLHttpRequest();
 
        // Update progress bar
        xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                        progressBar.style.width = (evt.loaded / evt.total) * 100 + "%";
                }
                else {
                    // No data to calculate on
                }
        }, false);
 
        // File uploaded
        xhr.addEventListener("load", function () {
                    loadFoto();
                    progressBarContainer.className += " uploaded";
                    progressBar.innerHTML = "Uploaded!";
                    showAlert('Obrázek '+file.name+' byl nahrán na server')
                    $(li).fadeOut();
        }, false);


        xhr.onreadystatechange = function(){
            //console.info("readyState: ", this.readyState);
            if (this.readyState == 4) {
                if ((this.status >= 200 && this.status < 300) || this.status == 304) {
                    if (this.responseText != "done") {
                        //showAlert(xhr.responseText,{mtype:'err'});
                    }
                }
            }
        };
 
        
        xhr.open("post", $('#news-foto-upload-form').attr('action'), true);

        // Set appropriate headers
        xhr.send(formData);
 
        // Present file info and append it to the list of files
        fileInfo = "<div><strong>Jméno:</strong> " + file.name + "</div>";
        fileInfo += "<div><strong>Velikost:</strong> " + parseInt(file.size / 1024, 10) + " kb</div>";
        fileInfo += "<div><strong>Typ:</strong> " + file.type + "</div>";
        div.innerHTML = fileInfo;

        fileList.appendChild(li);

} //uploadFile
 
function traverseFiles (files) {
    if (typeof files !== "undefined") {
        for (var i=0, l=files.length; i<l; i++) {
            if( (/image/i).test(files[i].type) )
                uploadFile(files[i])
         }
     }
    else {
        fileList.innerHTML = "No support for the File API in this web browser";
     }  
}  //traverseFiles (files)



    filesUpload.addEventListener("change", function () {
            traverseFiles(this.files)
    }, false);
    
} //activateFotoFormListener()

function activateFotoListeners()
{
    //delete button
    $("#news-foto-delete").unbind('click').click(function(){
           var that = this; 
           showConfirm('Opravdu smazat obrázek?',function(){
                            $.get( that.href, {}, function(res)
                                {
                                    if( res == 'done' )                                                                                                         
                                    {
                                        showAlert("Obrázek byl odstraněn.");
                                        loadFoto(); 
                                     }
                                else 
                                     showAlert('Error - zopakujte prosím akci',{mtype:'err'});    
                              });                         
                     }); 
                     
        return false;
    });
}

function loadFoto()
{
    $.get($("#news-foto-url").val(),{},function(img){    
        $(".news-foto-img-holder").html(img);
        activateFotoListeners();
    });
}