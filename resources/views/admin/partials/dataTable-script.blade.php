
{{--script for data tables--}}
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>

<!--data table to excel-->
<script>
    $(document).ready(function() {
        $('#data-table1').DataTable( {
            dom: '<"html5buttons" B>lTfgitp',
            select: {
                style: 'multi'
            },
            buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 1, 2, 3 ]
                    },

                    text: '<i class="fa fa-file-excel-o"></i>',
                    attr: {
                        title: 'Export to Excel',
                    },

                },

            ]
        } );
    } );
</script>

{{--
tag change ni garna milxa datatable
<script>
    $(document).ready(function() {
        $('#data-table1').DataTable( {
            dom: '<"html5buttons" B>lTfgitp',
            select: {
                style: 'multi'
            },
            buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 1, 2, 3 ]
                    },
                    text: 'Copy to clipboard',
                    tag: 'img',
                    attr: {
                        src:'{{asset('frontend/img/android.png')}}'
                    },
                },

            ]
        } );
    } );
</script>--}}
