
<!--jquery validation-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

    $(document).ready(function () {

        $('#emi_form').validate({ // initialize the plugin
            rules: {
                total_amount: {
                    required: true
                },
                interest_rate:"required",
                period: "required",
                down_payment:"required",
            },
            /*messages: {
                total_amount: {
                    required: "Reqyi",
                },
                interest_rate: {
                    required: "Please Select Team Category",
                },
                period: {
                    required: "Please Select Designation",
                },
                down_payment: {
                    required: "Please Select Designation",
                },


            },*/
        });

    });
</script>

<script>

    let emiData={
        'total_amount' :'',
        'interest_rate':'',
        'period':'',
        'down_payment':'',
    }

    let form = $('#emi_form');
    $('#emi_form').submit(function(event){

        event.stopPropagation();
        event.preventDefault();

        let emiUrl = "{{route('fe.emi')}}";

        emiData['total_amount'] = $('#total_amount').val();
        emiData['interest_rate'] = $('#interest_rate').val();
        emiData['period'] = $('#period').val();
        emiData['down_payment'] = $('#down_payment').val();

        if(form.valid() === true){
            updateContent(emiUrl);
        }

    });

    function updateContent(emiUrl) {
        $.ajax(
            {
                type: 'GET',
                url: emiUrl,
                datatype: "html",
                data: emiData,
            })
            .done(function (data) {

           // console.log(data);
            $("#emi_result").empty().html(data);
            $("#emi_result").addClass('calculate-show-div');
        }).fail(function (data) {

           /* $.each(errors.errors,function (k,v) {
              console.log(v);
            });
            */
        });

    }
</script>


