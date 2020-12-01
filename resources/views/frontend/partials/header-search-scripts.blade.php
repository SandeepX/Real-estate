{{--select2 js--}}
<script src="{{asset('backend/assets/js/my-scripts/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

<script>
    $(document).ready(function () {

        $('#nav_search_btn').on('click',function (e) {

            e.preventDefault();

            //only forward search if keyword is not empty

            let keyword =$("#nav_search_form input[name='search']" ).val();

            if (keyword){
                $("#nav_search_form").off("submit").submit();
            }

        });
    });
</script>