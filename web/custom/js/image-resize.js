// PART 1 CONVERT TO BS64
document.getElementById('inp_file').addEventListener('change', fileChange, false);

// FUNCTION TO BLOB
function fileChange(e) {

  $('.image-preview').hide();
  $('.spinner-preview').show();

  document.getElementById('inp_img').value = '';

  var file = e.target.files[0];

  if (file && file !== 'undefined') {

    if (file.type == "image/jpeg" || file.type == "image/png") {

      var reader = new FileReader();
      reader.onload = function (readerEvent) {

        var image = new Image();
        image.onload = function (imageEvent) {
          var max_size = 300;
          var w = image.width;
          var h = image.height;

          if (w > h) {
            if (w > max_size) {
              h *= max_size / w;
              w = max_size;
            }
          } else {
            if (h > max_size) {
              w *= max_size / h;
              h = max_size;
            }
          }

          var canvas = document.createElement('canvas');
          canvas.width = w;
          canvas.height = h;
          canvas.getContext('2d').drawImage(image, 0, 0, w, h);

          if (file.type == "image/jpeg") {
            var dataURL = canvas.toDataURL("image/jpeg", 1.0);
          } else {
            var dataURL = canvas.toDataURL("image/png");
          }
          document.getElementById('inp_img').value = dataURL;
        }
        image.src = readerEvent.target.result;
      }
      reader.readAsDataURL(file);
    } else {
      swal("Ops!", "O arquivo não é válido", "error");
      document.getElementById('inp_file').value = '';
      $('.spinner-preview').hide();
      $('.image-preview').show();
    }

  } else {
    $('.spinner-preview').hide();
    $('.image-preview').show();
    return false;
  }

}

// PART 2 PREVIEW JS
function resize() {

  //define the width to resize e.g 600px
  var resize_width = 600; //without px

  //get the image selected
  var item = document.querySelector('#inp_file').files[0];

  if (item && item !== 'undefined') {

    //create a FileReader
    var reader = new FileReader();

    //image turned to base64-encoded Data URI.
    reader.readAsDataURL(item);
    reader.name = item.name; //get the image's name
    reader.size = item.size; //get the image's size
    reader.onload = function (event) {
      var img = new Image(); //create a image
      img.src = event.target.result; //result is base64-encoded Data URI
      img.name = event.target.name; //set name (optional)
      img.size = event.target.size; //set size (optional)
      img.onload = function (el) {
        var elem = document.createElement('canvas'); //create a canvas

        //scale the image to 600 (width) and keep aspect ratio
        var scaleFactor = resize_width / el.target.width;
        elem.width = resize_width;
        elem.height = el.target.height * scaleFactor;

        //draw in canvas
        var ctx = elem.getContext('2d');
        ctx.drawImage(el.target, 0, 0, elem.width, elem.height);

        //get the base64-encoded Data URI from the resize image
        var srcEncoded = ctx.canvas.toDataURL(el.target, 'image/jpeg', 0);

        //assign it to thumb src
        document.querySelector('#image').src = srcEncoded;

        $('.spinner-preview').hide();
        $('.image-preview').show();

        // $('#inp_file').files[0] = srcEncoded;
        /*Now you can send "srcEncoded" to the server and
        convert it to a png o jpg. Also can send
        "el.target.name" that is the file's name.*/

      }
    }

  } else {
    $('.spinner-preview').hide();
    $('.image-preview').show();
    return false;
  }

}