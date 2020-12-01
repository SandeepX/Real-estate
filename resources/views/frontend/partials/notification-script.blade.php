<!--mark as read notification -->
<script>
    $(document).ready(function () {


        $('#dropdownMenuButton').on('click',function (e) {

            //e.preventDefault();

            let dataId = $(this).data('id');

            markAsRead(dataId);

            $('span.notification-bell-span').html('');

            // Prevent infinite loop
            //$(this).unbind('click');

            // Execute default action
           // e.currentTarget.click();
        });

        $('.unread_notification').on("click", function (e) {

            e.preventDefault();

            let dataId = $(this).data('id');

            markAsRead(dataId);

            // Prevent infinite loop
            $(this).unbind('click');

            // Execute default action
            e.currentTarget.click();
        });

        function markAsRead(dataId) {

            //console.log(dataId);
            $.ajax(
                {
                    type: 'GET',
                    url: dataId,
                    datatype: "html",
                }).done(function (data) {
                //console.log(data);
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log("Error: " + errorThrown);
                console.log("Status: " + status);
                console.dir(xhr);
            });

        }

    });
</script>