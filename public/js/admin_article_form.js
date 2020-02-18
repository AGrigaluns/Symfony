Dropzone.autoDiscover = false;

$(document).ready(function() {
    let referenceList = new ReferenceList($('.js-reference-list'));

    initializeDropzone(referenceList);

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

// todo - use Webpack Encore so ES6 syntax is transpiled to ES5

class ReferenceList
{
    constructor($element) {
        this.$element = $element;
        this.references = [];
        this.render();
        $.ajax({
            url: this.$element.data('url')
        }).then(data => {
            this.references = data;
            this.render();
        })
    }

    addReference(reference) {
        this.references.push(reference);
        this.render();
    }

    render() {
        const itemsHtml = this.references.map(reference => {
            return `
<li class="list-group-item d-flex justify-content-between align-items-center">
    ${reference.originalFilename}
    <span>
        <a href="/admin/article/references/${reference.id}/download"><span class="fa fa-download"></span></a>
    </span>
</li>
`
        });
        this.$element.html(itemsHtml.join(''));
    }
}

/**
 * @param {ReferenceList} referenceList
 */
function initializeDropzone(referenceList) {
    let formElement = document.querySelector('.js-reference-dropzone');
    if (!formElement) {
        return;
    }
    let dropzone = new Dropzone(formElement, {
        paramName: 'reference',
        init: function() {
            this.on('success', function (file, data) {
                referenceList.addReference(data);
            });

            this.on('error', function(file, data) {
                if (data.detail) {
                    this.emit('error', file, data.detail);
                }
            });
        }
    });
}
