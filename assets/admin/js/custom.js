/*Alder Isaac Solís De León sexto computacion c*/
$(function($) {
    "use strict";


    $("#ajaxEditForm").attr('onsubmit', 'return false');
    $("#ajaxForm").attr('onsubmit', 'return false');

    $('.datepicker').datepicker({
      autoclose: true
    });


    function ui_single_update_active(element, active) {
        element.find('div.progress').toggleClass('d-none', !active);
        element.find('.progressbar').toggleClass('d-none', active);

        element.find('input[type="file"]').prop('disabled', active);
        element.find('.btn').toggleClass('disabled', active);

        element.find('.btn i').toggleClass('fa-circle-o-notch fa-spin', active);
        element.find('.btn i').toggleClass('fa-folder-o', !active);
    }

    function ui_single_update_progress(element, percent, active) {
        active = (typeof active === 'undefined' ? true : active);

        var bar = element.find('div.progress-bar');

        bar.width(percent + '%').attr('aria-valuenow', percent);
        bar.toggleClass('progress-bar-striped progress-bar-animated', active);

        if (percent === 0) {
            bar.html('');
        } else {
            bar.html(percent + '%');
        }
    }

    function ui_single_update_status(element, message, color) {
        color = (typeof color === 'undefined' ? 'muted' : color);

        element.find('small.status').prop('class', 'status text-' + color).html(message);
    }


    $('.drag-and-drop-zone').dmUploader({ //
        url: $('.drag-and-drop-zone').prop('action'),
        multiple: false,
        allowedTypes: 'image/*',
        extFilter: ['jpg', 'jpeg', 'png', 'svg', 'PNG', 'webp'],
        onDragEnter: function() {

            this.addClass('active');
        },
        onDragLeave: function() {

            this.removeClass('active');
        },
        onInit: function() {


            this.find('.progressbar').val('');
        },
        onComplete: function() {

        },
        onNewFile: function(id, file) {


            if (typeof FileReader !== "undefined") {
                var reader = new FileReader();
                var img = this.find('img');

                reader.onload = function(e) {
                    img.attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        },
        onBeforeUpload: function(id) {

            ui_single_update_progress(this, 0, true);
            ui_single_update_active(this, true);

            ui_single_update_status(this, 'Uploading...');
        },
        onUploadProgress: function(id, percent) {

            ui_single_update_progress(this, percent);
        },
        onUploadSuccess: function(id, data) {
            var response = JSON.stringify(data);

            let ems = document.getElementsByClassName('em');
            for (let i = 0; i < ems.length; i++) {
              ems[i].innerHTML = '';
            }


            console.log(data);



            if (data.status == "success") {
              bootnotify(data.image + "n Agregada correctamente!", '¡Listo!', 'success');
              ui_single_update_active(this, false);

              this.find('.progressbar').val("Subido Correctamente");
              this.find('.form-control[readonly]').attr('style', 'background-color: #28a745 !important; text-alignment: center !important; opacity: 1 !important;border: none !important;');
              ui_single_update_status(this, 'Subida completada.', 'success');
            }



            else if (data.status == "session_put") {
              $("#image").attr('name', data.image);
              $("#image").val(data.filename);
              ui_single_update_active(this, false);

              this.find('.progressbar').val("Subido Correctamente");
              this.find('.form-control[readonly]').attr('style', 'background-color: #28a745 !important; text-alignment: center !important; opacity: 1 !important;border: none !important;');
              ui_single_update_status(this, 'Subida completada', 'success');
            }



            else if (data.status == "reload") {
              ui_single_update_active(this, false);

              this.find('.progressbar').val("Subido Correctamente");
              this.find('.form-control[readonly]').attr('style', 'background-color: #28a745 !important; text-alignment: center !important; opacity: 1 !important;border: none !important;');
              ui_single_update_status(this, 'Subida completada.', 'success');
              location.reload();
            }


            else if(typeof data.errors.error != 'undefined') {
              if (typeof data.errors.file != 'undefined') {
                document.getElementById('err'+data.id).innerHTML = data.errors.file[0];
              }
            }
        },
        onUploadError: function(id, xhr, status, message) {

            ui_single_update_active(this, false);
            ui_single_update_status(this, 'Error: ' + message, 'danger');
        },
        onFallbackMode: function() {

        },
        onFileSizeError: function(file) {
            ui_single_update_status(this, 'Archivo que excede el límite de tamaño', 'danger');

        },
        onFileTypeError: function(file) {
            ui_single_update_status(this, 'El tipo de archivo no es una imagen', 'danger');

        },
        onFileExtError: function(file) {
            ui_single_update_status(this, 'Extensión de archivo no permitida', 'danger');

        }
    });

    $('.icp-dd').iconpicker();

    $(".summernote").each(function(i) {
      let theight;
      let $summernote = $(this);
      if ($(this).data('height')) {
        theight = $(this).data('height');
      } else {
        theight = 200;
      }
      $('.summernote').eq(i).summernote({
        height: theight,
        dialogsInBody: true,
        dialogsFade: false,
        callbacks: {
          onImageUpload: function(files) {
            // console.log(files);
            $(".request-loader").addClass('show');

            let fd = new FormData();
            fd.append('image', files[0]);

            $.ajax({
              url: imggur,
              method: 'POST',
              data: fd,
              contentType: false,
              processData: false,
              success: function(data) {
                $summernote.summernote('insertImage', data.data.link);
                $(".request-loader").removeClass('show');
                if ($summernote.parents(".modal").length > 0) {
                  if (!$("body").hasClass("modal-open")) {
                    $("body").addClass('modal-open');
                  }
                }
              }
            });
            
          },
          
          onImageLinkInsert: function(link) {
            $summernote.summernote('insertImage', link);
            if ($summernote.parents(".modal").length > 0) {
              if (!$("body").hasClass("modal-open")) {
                $("body").addClass('modal-open');
              }
            }
          }
        },

        onCreateLink: function(link) {
          
          if ($summernote.parents(".modal").length > 0) {
            if (!$("body").hasClass("modal-open")) {
              $("body").addClass('modal-open');
            }
          }

          return link;
        }
      });
    });


      
    $(document).on('click',".note-video-btn", function() {
      console.log('clicked');
      
      let i = $(this).index();

      if ($(".summernote").eq(i).parents(".modal").length > 0) {
        console.log("in modal");
        
        setTimeout(() => {
          $("body").addClass('modal-open');
        }, 500);
      }
    });



    function bootnotify(message, title, type) {
      var content = {};

      content.message = message;
      content.title = title;
      content.icon = 'fa fa-bell';

      $.notify(content,{
        type: type,
        placement: {
          from: 'top',
          align: 'right'
        },
        showProgressbar: true,
        time: 1000,
        allow_dismiss: true,
        delay: 4000,
      });
    }

    $("#submitBtn").on('click', function(e) {
      $(e.target).attr('disabled', true);

      $(".request-loader").addClass("show");

      let ajaxForm = document.getElementById('ajaxForm');
      let fd = new FormData(ajaxForm);
      let url = $("#ajaxForm").attr('action');
      let method = $("#ajaxForm").attr('method');
      // console.log(url);
      // console.log(method);

      if ($("#ajaxForm .summernote").length > 0) {
        $("#ajaxForm .summernote").each(function(i) {
          let content = $(this).summernote('code');

          fd.delete($(this).attr('name'));
          fd.append($(this).attr('name'), content);
        });
      }

      $.ajax({
        url: url,
        method: method,
        data: fd,
        contentType: false,
        processData: false,
        success: function(data) {
          console.log(data);

          $(e.target).attr('disabled', false);
          $(".request-loader").removeClass("show");

          $(".em").each(function() {
            $(this).html('');
          })

          if (data == "success") {
            location.reload();
          }


          else if(typeof data.error != 'undefined') {
            for (let x in data) {
              console.log(x);
              if (x == 'error') {
                continue;
              }
              document.getElementById('err'+x).innerHTML = data[x][0];
            }
          }
        }
      });
    });

    $(".editbtn").on('click', function() {

      let datas = $(this).data();
      delete datas['toggle'];

      for (let x in datas) {
        if ($("#in"+x).hasClass('summernote')) {
          $("#in"+x).summernote('code', datas[x]);
        } else if ($("#in"+x).data('role') == 'tagsinput') {
          if (datas[x].length > 0) {
            let arr = datas[x].split(" ");
            for (let i = 0; i < arr.length; i++) {
              $("#in"+x).tagsinput('add', arr[i]);
            }
          } else {
            $("#in"+x).tagsinput('removeAll');
          }
        } else {
          $("#in"+x).val(datas[x]);
        }
      }

    });







    $("#updateBtn").on('click', function(e) {

      $(".request-loader").addClass("show");

      let ajaxEditForm = document.getElementById('ajaxEditForm');
      let fd = new FormData(ajaxEditForm);
      let url = $("#ajaxEditForm").attr('action');
      let method = $("#ajaxEditForm").attr('method');
      // console.log(url);
      // console.log(method);

      if ($("#ajaxEditForm .summernote").length > 0) {
        $("#ajaxEditForm .summernote").each(function(i) {
          let content = $(this).summernote('code');
          fd.delete($(this).attr('name'));
          fd.append($(this).attr('name'), content);
        })
      }

      $.ajax({
        url: url,
        method: method,
        data: fd,
        contentType: false,
        processData: false,
        success: function(data) {


          $(".request-loader").removeClass("show");

          $(".em").each(function() {
            $(this).html('');
          })

          if (data == "success") {
            location.reload();
          }


          else if(typeof data.error != 'undefined') {
            for (let x in data) {
              console.log(x);
              if (x == 'error') {
                continue;
              }
              document.getElementById('eerr'+x).innerHTML = data[x][0];
            }
          }
        }
      });
    });
    
    $('.deletebtn').on('click', function(e) {
      e.preventDefault();

      $(".request-loader").addClass("show");

      swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        buttons:{
          confirm: {
            text : 'Yes, delete it!',
            className : 'btn btn-success'
          },
          cancel: {
            visible: true,
            className: 'btn btn-danger'
          }
        }
      }).then((Delete) => {
        if (Delete) {
          $(this).parent(".deleteform").submit();
        } else {
          swal.close();
          $(".request-loader").removeClass("show");
        }
      });
    });

    $(".bulk-check").on('change', function() {
      let val = $(this).data('val');
      let checked = $(this).prop('checked');
      
      if (val == 'all') {
        if (checked) {
          $(".bulk-check").each(function() {
            $(this).prop('checked', true);
          });          
        } else {
          $(".bulk-check").each(function() {
            $(this).prop('checked', false);
          });           
        }
      }

      
      let flag = 0;
      $(".bulk-check").each(function() {
        let status = $(this).prop('checked');
        
        if (status) {
          flag = 1;
        }
      }); 

      if (flag == 1) {
        $(".bulk-delete").addClass('d-inline-block');
        $(".bulk-delete").removeClass('d-none');
      } 
      else {
        $(".bulk-delete").removeClass('d-inline-block');
        $(".bulk-delete").addClass('d-none');       
      }
    });

    $('.bulk-delete').on('click', function() {

      swal({
        title: 'Estas seguro?',
        text: "¡no podras revertir esto despues!",
        type: 'warning',
        buttons:{
          confirm: {
            text : '¡Si, eliminalo!',
            className : 'btn btn-success'
          },
          cancel: {
            visible: true,
            className: 'btn btn-danger'
          }
        }
      }).then((Delete) => {
        if (Delete) {
          $(".request-loader").addClass('show');
          let href = $(this).data('href');
          let ids = [];
    
          $(".bulk-check:checked").each(function() {
            if ($(this).data('val') != 'all') {
              ids.push($(this).data('val'));
            }
          });
    
          let fd = new FormData();
          for (let i = 0; i < ids.length; i++) {
            fd.append('ids[]', ids[i]);
          }
    
          $.ajax({
            url: href,
            method: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data) {
              $(".request-loader").removeClass('show');
              if (data == "success") {
                location.reload();
              }
            }
          });
        } else {
          swal.close();
        }
      });

    });
});
