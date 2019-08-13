window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');

    $( document ).ready(function() {
        $('.js-option-switch').click(function () {
            let btn = $(this);
            $(btn.attr('data-input')).attr('disabled', function(i, v) { return !v; });
            if (btn.hasClass('btn-outline-danger')) {
                btn
                    .html('Add')
                    .removeClass('btn-outline-danger')
                    .addClass('btn-outline-primary');
            } else {
                btn
                    .html('Remove')
                    .removeClass('btn-outline-primary')
                    .addClass('btn-outline-danger');
            }

            return false;
        });

        $('#deleteModal').on('show.bs.modal', function (event) {
            $('#deleteProductBtn')
                .attr('data-href', $(event.relatedTarget).data('href'));
        });

        $('#deleteProductBtn').click(function () {
            let btn = $(this),
            deleteForm = $('<form>', {
                'action': btn.data('href'),
                'method': 'POST'
            }).append($('<input>', {
                'name': '_method',
                'value': 'DELETE',
                'type': 'hidden'
            })).append($('<input>', {
                'name': '_token',
                'value': $('meta[name="csrf-token"]')[0].content,
                'type': 'hidden'
            }));
            $(document.body).append(deleteForm);
            deleteForm.submit();

            return false;
        });

    });

} catch (e) {}
