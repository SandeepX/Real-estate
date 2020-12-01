<script>



    $(document).ready(function () {

        let searchData={
            'sale_status' :'',
            'property_type' :'',
            'sale_status':'',
            'property_type':'',
            'municipal':'',
            'features' :[],
            'bedrooms':'',
            'bathrooms':'',
            'min_price':'',
            'max_price':'',
            'min_area':'',
            'max_area':'',
            'sort_by' :'',
        }
        $('#sale_status').on('change', function () {

            var saleStatusId = $(this).children(":selected").val();
            searchData['sale_status']= saleStatusId;

            //console.log(searchData['sale_status']);
        });

        $('#property_type').on('change', function () {

            var propertyType = $(this).children(":selected").val();
            searchData['property_type']= propertyType;

            //console.log(searchData['property_type']);
        });
        $('#municipal').on('change', function () {

            var municipalId = $(this).children(":selected").val();
            searchData['municipal']= municipalId;

            //console.log(searchData['municipalId']);
        });
        $('#bedrooms').on('change', function () {

            var bedrooms = $(this).children(":selected").val();
            searchData['bedrooms']= bedrooms;

            //console.log(searchData['municipalId']);
        });
        $('#bathrooms').on('change', function () {

            var bathrooms = $(this).children(":selected").val();
            searchData['bathrooms']= bathrooms;

            //console.log(searchData['municipalId']);
        });

        $('#sort_by').on('change', function () {

            var sortBy = $(this).children(":selected").val();
            searchData['sort_by']= sortBy;

            let searchUrl = "{{route('fe.advance.search')}}";

            updateContent(searchUrl,searchData);
        });



        $('#advance_search_form').submit(function(event){

            event.stopPropagation();
            event.preventDefault();
            let searchUrl = "{{route('fe.advance.search')}}";

            var features = [];
            $.each($("input[name='features[]']:checked"), function(){
                features.push($(this).val());
            });
            searchData['features']=features;
            searchData['min_price'] = $('#min_price').val();
            searchData['max_price'] = $('#max_price').val();
            searchData['min_area'] = $('#min_area').val();
            searchData['max_area'] = $('#max_area').val();

            updateContent(searchUrl,searchData);
        });

        function updateContent(searchUrl) {
            $.ajax(
                {
                    type: 'GET',
                    url: searchUrl,
                    datatype: "html",
                    data: searchData,
                }).done(function (data) {

                //console.log(data);
                $(".dynamic_content").empty().html(data);
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log("Error: " + errorThrown);
                console.log("Status: " + status);
                console.dir(xhr);
            });

        }
    });
</script>