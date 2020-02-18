Dropzone.autoDiscover = false;

$(document).ready(function() {
    initializeDropzone();

    let $locationSelect = $('.js-article-form-location');
    let $specificLocationTarget = $('.js-specific-location-target');

    $locationSelect.on('change', function(e) {
        $.ajax({
            url: $locationSelect.data('specific-location-url'),
            data: {
                location: $locationSelect.val()
            },
            success: function (html) {
                if (!html) {
                    $specificLocationTarget.find('select').remove();
                    $specificLocationTarget.addClass('d-none');

                    return;
                }

                // Replace the current field and show
                $specificLocationTarget
                    .html(html)
                    .removeClass('d-none')
            }
        });
    });
});

function initializeDropzone() {
    let formElement = document.querySelector('.js-reference-dropzone');
    if (!formElement) {
        return;
    }
    let dropzone = new Dropzone(formElement, {
        paramName: 'reference',
        init: function() {
            this.on('error', function(file, data) {
                if (data.detail) {
                    this.emit('error', file, data.detail);
                }
            });
        }
    });
}
