
/*
썸머노트와 이미지 다중입력처리
summernote and multiple image input processing
*/

$(document).ready(function() {
$("#summernote").summernote({
  placeholder: '새로운 글을 작성해보세요.',
        height: 600,
         callbacks: {
        onImageUpload : function(files, editor, welEditable) {

             for(var i = files.length - 1; i >= 0; i--) {
                     sendFile(files[i], this);
            }
        }
    }
    });
});

function sendFile(file, el) {
var form_data = new FormData();
form_data.append('file', file);
$.ajax({
    data: form_data,
    type: "POST",
    url: '../action/editor_upload.php',
    cache: false,
    contentType: false,
    processData: false,
    success: function(url) {
        $(el).summernote('editor.insertImage', url);
    }
});
}
