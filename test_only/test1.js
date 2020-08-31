function image_upload(){
  var image_form = document.getElementById('image-form');
      formData = new FormData(image_form);
      $.ajax({

        url:"upload.php",
        type:"post",
        data:formData,
        contentType: false,
        cache: false,
        processData : false,
      }).done(function(data){
        document.getElementById('image-url').innerHTML = data;
      });
}
