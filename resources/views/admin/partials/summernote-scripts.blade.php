<script src="{{asset('backend/node_modules/summernote/dist/summernote-bs4.js')}}"></script>
<script>
    (function ($) {
        "use strict";

        $('#summernote').summernote({

            tabsize: 2,
            height: 200,
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New',
                'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Roboto','Poppins'],
            fontNamesIgnoreCheck: ['Poppins','Roboto'],
        });

        $('#summernote').summernote('fontName', 'Poppins');

        $('.summernote').summernote({

            tabsize: 2,
            height: 200,
            fontNames: ['Poppins','Arial', 'Arial Black', 'Comic Sans MS', 'Courier New',
                'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Roboto','Poppins'],
            fontNamesIgnoreCheck: ['Poppins','Roboto'],
        });

        $('.summernote').summernote('fontName', 'Poppins');

    })(jQuery);
</script>