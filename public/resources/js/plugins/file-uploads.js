const form = document.querySelector("form"),
  fileInput = document.querySelector(".file-input"),
  progressArea = document.querySelector(".progress-area"),
  uploadedArea = document.querySelector(".uploaded-area");

// form click event
form.addEventListener("click", () => {
  fileInput.click();
});


$(fileInput).change(function (event) {
  console.log('file')
  var document = $(this).data('name');
  var files = $('#' + document)[0].files
  var file_type = ['image/jpeg', 'image/png', , 'application/pdf'];
  $(".progress-area").empty()
  for (let index = 0; index < files.length; index++) {
    if (!file_type.includes(files[index].type)) {
      error += '<div class="alert alert-danger"><b>' + files[index].name +
        '</b> Selected File must be .jpg, .png and .pdf Only.</div>';
    } else {
      uploadFile(files[index], document); //calling uploadFile with passing file name as an argument
      //$('.image_frame' + document).append(fileDisplay(files[index], index))
    }
  }
})
/* fileInput.onchange = ({
  target
}) => {
  let file = target.files[0]; //getting file [0] this means if user has selected multiple files then get first one only
  if (file) {
    let fileName = file.name; //getting file name
    if (fileName.length >= 12) { //if file name length is greater than 12 then split it and add ...
      let splitName = fileName.split('.');
      fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
    }
    uploadFile(fileName); //calling uploadFile with passing file name as an argument
  }
} */

// file upload function
function uploadFile(file, document) {
  let name = file.name;
  let splitName = name.split('.');
  name = splitName[0].substring(0, 13) + "... ." + splitName[1];
  /*  let fileLoaded = Math.floor((loaded / total) * 100); //getting percentage of loaded file size
   let fileTotal = Math.floor(total / 1000); //gettting total file size in KB from bytes
   let fileSize = file.size; */
  let layouts = '<div class="col-md">' + name +
    '<div class="progress bg-soft-success shadow-none w-100">' +
    '<div class="progress-bar progress-bar-' +
    ' bg-success" data-toggle="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>' +
    '</div></div>';

  $('.image_frame' + document).append(layouts)

}