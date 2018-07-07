jQuery(document).ready(function() {
  let mediaUploader;
  $('#upload_picure_button').on('click',function(e) {
    e.preventDefault();
    if(mediaUploader){
      mediaUploader.open();
      return;
    }
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Выберите изображение ',
      button:{
        text:'Выбрать'
      },
      multiple:false
    });

    mediaUploader.on('select',function() {
      attachment = mediaUploader.state().get('selection').first().toJSON();
      $('#profile_picture').val(attachment.url);
    });

    mediaUploader.open();
  });
});
