
function loadGallery()
{
    $("#reference_gallery .gallery-admin-holder").html("Nahrávám...");
    $.get($("#reference-gallery-list-url").val(),{id:$("#reference-gallery-ownerid").val()},function(html){
        $("#reference_gallery .gallery-admin-holder").html(html);
        initGallery();
    });

}

function gallerypageadmin() {

initGallery();

if (("addEventListener" in window) && ("FileReader" in window) && ("FormData" in window)) {
    //window.addEventListener("DOMContentLoaded", init, false);
} else {
 $("#reference-gallery-file-list").html("Upload obrázků do galerie není Vaším prohlížečem podporován");
    //document.getElementById("browsers").style.display = "block";
}

$("#reference-gallery-files-upload").hide();
$("#reference-gallery-button-upload").unbind('click').click(function(){
    $("#reference-gallery-files-upload").trigger('click');
    return false;
});

//rewrite https://github.com/Integralist/XHR2-Multiple-File-Upload--with-PHP-/blob/master/upload.js
var filesUpload = document.getElementById("reference-gallery-files-upload"),
fileList = document.getElementById("reference-gallery-file-list");

function uploadFile (file) {
var li = document.createElement("div"),
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

progressBarContainer.className = "progress-bar-container";
progressBar.className = "progress-bar";
progressBarContainer.appendChild(progressBar);
li.appendChild(progressBarContainer);

// Create a new FormData object.

var formData = new FormData();

  formData.append('photos[]', file, file.name);

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
progressBarContainer.className += " uploaded";
progressBar.innerHTML = "Uploaded!";
showAlert('Obrázek '+file.name+' byl nahrán na server')
$(li).fadeOut();
loadGallery();
}, false);

xhr.onreadystatechange = function(){
console.info("readyState: ", this.readyState);
if (this.readyState == 4) {
if ((this.status >= 200 && this.status < 300) || this.status == 304) {
if (this.responseText != "done") {
 //showAlert(xhr.responseText,{mtype:'err'});
}
}
}
};

xhr.open("post", $('#reference_gallery_form').attr('action'), true);

// Set appropriate headers
xhr.send(formData);

// Present file info and append it to the list of files
fileInfo = "<div><strong>Jméno:</strong> " + file.name + "</div>";
fileInfo += "<div><strong>Velikost:</strong> " + parseInt(file.size / 1024, 10) + " kb</div>";
fileInfo += "<div><strong>Typ:</strong> " + file.type + "</div>";
div.innerHTML = fileInfo;

fileList.appendChild(li);

}

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
}

filesUpload.addEventListener("change", function () {
traverseFiles(this.files)
}, false);

}

function initGallery() {

    $("#reference_gallery .gallery-img:odd").css('background-color','lightgray')

		$("#reference_gallery .gallery-admin-list").sortable({

                    update : function (event, ui) {

                                var id = ui.item.attr('id');
                                var neib = ui.item.prev().attr('id');

                                    var RE = /^photo/;
                                if( ! RE.test(neib) ) {
                                    neib = 'photo_0';
                                }

                                $.get($("#reference-gallery-sort-url").val(),
                                    {
                                        photo: id.replace('photo_',''),
                                        neib: neib.replace('photo_',''),
                                        ownerid:$("#reference-gallery-ownerid").val()        
                                    }, function(result) {
                                        if( result == 'error' )
                                            showAlert('error',{mtype:'err'});
                                        else 
                                        { showAlert('Obrázek byl přesunut'); }
                                    }
                                 );

                           }
                });
		$(".gallery-admin-list").disableSelection();

        $('#reference_gallery .gallery-edit').unbind('click').click(function(){

            var dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
            dialog.load(
                $(this).attr('href'),
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({
                            title: 'Upravit obrázek',
                            modal: true,
                            width: 900,
                            close: function(event, ui) {$(this).remove();}
                    });

                        $("#galerieformedit input[name='ownerid']").val($("#reference-gallery-ownerid").val());

                    	var options = {
                                success: formgalerieformedit,
                                dataType:  'json'
                        };

                       $('#galerieformedit').ajaxForm(options);

                });

            return false;
        })

        $('#reference_gallery .gallery-delete').unbind('click').click(function(){
                     var that = this;
                     showConfirm('Opravdu smazat obrázek?',function(){
                            $.get( that.href, {ownerid:$("#reference-gallery-ownerid").val()},
                            function(res)
                            {
                                if( res == 'error' )
                                    showAlert('error',{mtype:'err'});
                                else {

                                showAlert("Obrázek byl odstraněn z galerie.");
                                loadGallery(); 
                                     }
                              });                         
                     });    
            return false;
        })        

}        

function formgalerieformedit(json)
{
 $('#galerieformedit').find(".form_err").remove();   

 if( json.succ == 'yes' ) {
        loadGallery();    
        showAlert("Vaše údaje byly v pořádku uloženy");
 }
 else {

                               if ( typeof(json.errors) == 'object' ) 
                               {

                                    if(json.errors[0].el=='exception')
                                    {
                                        $('#galerieformedit').find('span.error') 
                                        .after('<div class="form_err">'+json.errors[0].mess+'<br><br></div>');          
                                    }
                                    else {
                                      $('#galerieformedit').find('span.error') 
                                        .after('<div class="form_err">Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje<br><br></div>');          

                                      for ( var i=0;i<json.errors.length;i++ ) 
                                      {
                                        if ( json.errors[i].el ) 
                                        {
                                          $('#galerieformedit').find("input[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#galerieformedit').find("select[name='" + json.errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                          $('#galerieformedit').find("." + json.errors[i].el )                                            
                                            .after('<div class="form_err">' + json.errors[i].mess + '</div>');
                                         }
                                       } //end for
                                     } //end else exception 
                                  }
    }
}

