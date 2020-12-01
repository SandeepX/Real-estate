{{--hide fields if land selected--}}
<script>
    $(document).ready(function() {

        $('#property_type').on('change', function () {

            //get the selected option value
            //var packageId = $(this).val();
            //or
            //var packageId = $(this).children(":selected").val();
            var propertySubCategory = $(this).find("option:selected").data('subcat');

          //hide fields
            //updateContent(packageSlug);

            //console.log(propertySubCategory);

            if (propertySubCategory == 'land'){
               $('.land_hide').hide();
            }
            else{
                $('.land_hide').show();
            }

        });
    });
</script>