file_upload();
let input_file

function file_upload() {
  $('.file-input').change(function () {
    input_file = [];
    var document = $(this).data('name');
    var files = $('#' + document)[0].files
    var url = $(this).data('url');
    $('.image_frame' + document).empty()
    for (let index = 0; index < files.length; index++) {
      $('.image_frame' + document).append(fileDisplay(files[index], index, document))
      fileUpload(files[index], document, index, input_file, url)
    }
    console.log('.' + document + '-file')

  })
}

function fileUpload(file, document, index, input_file, url) {
  let request = new XMLHttpRequest();
  let data = new FormData();
  data.append('file', file)
  data.append('_token', $('.token').val())
  data.append('_documents', document)
  data.append('_file_number', index)

  let uploadProgress = $('.progress-bar-' + document + '-' + index)
  request.upload.onloadstart = function (e) {
    //console.log('Start Upload')
    uploadProgress.css({
      width: '0%'
    })
  }
  request.upload.onprogress = function (e) {
    percentage = (e.total / e.loaded) * 100
    uploadProgress.css({
      width: percentage + '%'
    })
    //console.log('uploading')
  }
  request.upload.onloadend = function (e) {
    //console.log('End uploading')
    uploadProgress.max = e.total
  }

  request.open("POST", url, true);
  request.send(data)
  request.onload = function () {
    if (request.readyState === request.DONE) {
      if (request.status === 200) {
        input_file.push(request.responseText)
        file_name = JSON.stringify(input_file);
        $('.' + document + '-file').val(file_name)
      }
    }
  };
}

function fileDisplay(files, index, document) {
  var layout = "<div class='col-md'>" +
    files.name.substring(0, 10).concat('...') +
    '<div class="progress bg-soft-success shadow-none w-100" style="height: 6px">' +
    '<div class="progress-bar progress-bar-' + document + '-' + index +
    ' bg-success" data-toggle="progress-bar" ></div>' +
    '</div>' +
    "</div>";
  return layout;
}