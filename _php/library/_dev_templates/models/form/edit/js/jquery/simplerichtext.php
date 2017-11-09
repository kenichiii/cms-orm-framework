


     form.find("textarea[name='<?php echo $this->getCollum() ?>']").tinymce({
                                    // Location of TinyMCE script
                                    script_url : '/assets/libs/tinymce/tinymce.min.js',
                    width: 600,
                    height: 200,
                    language: "cs",
                    fullpage_default_encoding: "utf-8",
                    entity_encoding:	'raw',
                    statusbar : false,
                                    plugins : "",
                                    toolbar: "undo redo  | bold italic  | bullist numlist |  code",
                                    menubar: "edit" //tools

                    });

