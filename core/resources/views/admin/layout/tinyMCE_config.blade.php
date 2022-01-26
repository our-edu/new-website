<script>
    var route_prefix = "{{$target ?? url('/admin/laravel-filemanager')}}";
</script>
<script src="https://cdn.tiny.cloud/1/xmijoht0f7ok5jrcyi5edggd475hfzd86dbvw4urzf3f4ps9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.tiny.cloud/1/xmijoht0f7ok5jrcyi5edggd475hfzd86dbvw4urzf3f4ps9/tinymce/5/jquery.tinymce.min.js" referrerpolicy="origin"></script>

<script>
    var editor_config = {
        path_absolute : "",
        selector: "#article_content",
        theme: 'silver',
        toolbar_mode: 'wrap',
        plugins: [
            "link image","print preview   importcss tinydrive  code autolink autosave save directionality  visualblocks visualchars fullscreen media  template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists  wordcount   textpattern noneditable help   charmap  quickbars  emoticons "
        ],
        toolbar: 'undo redo | bold italic underline strikethrough | code insertfile image media pageembed template link anchor codesample |fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat  | fullscreen  preview   | a11ycheck ltr rtl ',
        relative_urls: false,
        document_base_url: '',
        convert_urls: false,
        remove_script_host : true,
        height: 500,
        width: 1100,
        min_height: 100,
        min_width: 400,
        templates: [

        ],
        file_picker_callback : function(callback, value, meta) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + route_prefix+'?editor=' + meta.fieldname;
            if (meta.filetype == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.openUrl({
                url : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no",
                onMessage: (api, message) => {
                    callback(message.content);
                }
            });
        },
        verify_html: false,
        valid_elements : "@[id|class|style|title|dir<ltr?rtl|lang|xml::lang|onclick|ondblclick|"
            + "onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|"
            + "onkeydown|onkeyup],a[rel|rev|charset|hreflang|tabindex|accesskey|type|"
            + "name|href|target|title|class|onfocus|onblur],strong/b,em,i,strike,u,"
            + "#p,-ol[type|compact],-ul[type|compact],-li,br,img[longdesc|usemap|"
            + "src|border|alt=|title|hspace|vspace|width|height|align],-sub,-sup,"
            + "-blockquote,-table[border=0|cellspacing|cellpadding|width|frame|rules|"
            + "height|align|summary|bgcolor|background|bordercolor],-tr[rowspan|width|"
            + "height|align|valign|bgcolor|background|bordercolor],tbody,thead,tfoot,"
            + "#td[colspan|rowspan|width|height|align|valign|bgcolor|background|bordercolor"
            + "|scope],#th[colspan|rowspan|width|height|align|valign|scope],caption,-div,"
            + "-span,-i,-code,-pre,address,-h1,-h2,-h3,-h4,-h5,-section,-h6,hr[size|noshade],-font[face"
            + "|size|color],dd,dl,dt,cite,abbr,acronym,del[datetime|cite],ins[datetime|cite],"
            + "object[classid|width|height|codebase|*],param[name|value|_value],embed[type|width"
            + "|height|src|*],script[src|type],map[name],area[shape|coords|href|alt|target],bdo,"
            + "button,col[align|char|charoff|span|valign|width],colgroup[align|char|charoff|span|"
            + "valign|width],dfn,fieldset,form[action|accept|accept-charset|enctype|method],"
            + "input[accept|alt|checked|disabled|maxlength|name|readonly|size|src|type|value],"
            + "kbd,label[for],legend,noscript,optgroup[label|disabled],option[disabled|label|selected|value],"
            + "q[cite],samp,select[disabled|multiple|name|size],small,"
            + "textarea[cols|rows|disabled|name|readonly],tt,var,big"|"article",

    };

    tinymce.init(editor_config);
</script>

