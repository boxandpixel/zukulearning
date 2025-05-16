// admin-author-headshot.js
jQuery(document).ready(function($){
    $('#upload_headshot_button').on('click', function(e) {
        e.preventDefault();
        var mediaUploader = wp.media({
            title: 'Upload Author Headshot',
            button: { text: 'Use this Image' },
            multiple: false
        });

        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#author_headshot').val(attachment.url);
        });

        mediaUploader.open();
    });
});
