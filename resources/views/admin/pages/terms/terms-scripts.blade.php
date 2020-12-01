<!-- adding dynamic fields scripts-->
<script>

    //for dynamic field add
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.fields:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
       // newEntry.find('textarea').val('');
        newEntry.find('textarea').val('');

        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="fa fa-minus "></span>');
    }).on('click', '.btn-remove', function(e)
    {
        $(this).parents('.entry:first').remove();

        e.preventDefault();
        return false;
    });


</script>

<!--wysiwg scripts-->
<script src="{{asset('backend/node_modules/summernote/dist/summernote-bs4.js')}}"></script>
<script>
    (function ($) {
        "use strict";

        $('.summernote').summernote({
            tabsize: 2,
            height: 200
        });

    })(jQuery);
</script>