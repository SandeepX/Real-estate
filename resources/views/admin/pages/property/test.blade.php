@extends('admin.layout.master')

@section('title','Add Property')

@section('content')
    <div class="fields">
        <div class="entry input-group col-xs-3">
            <input class="form-control" name="fields[]" type="text" placeholder="Type something" />
            <span class="input-group-btn">
                            <button class="btn btn-success btn-add" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
        </div>
    </div>



@endsection

@push('scripts')
    <script>


     $(document).on('click', '.btn-add', function(e)
     {
         e.preventDefault();

         var controlForm = $('.fields:first'),
             currentEntry = $(this).parents('.entry:first'),
             newEntry = $(currentEntry.clone()).appendTo(controlForm);

         newEntry.find('input').val('');
         controlForm.find('.entry:not(:last) .btn-add')
             .removeClass('btn-add').addClass('btn-remove')
             .removeClass('btn-success').addClass('btn-danger')
             .html('<span class="glyphicon glyphicon-minus"></span>');
     }).on('click', '.btn-remove', function(e)
     {
         $(this).parents('.entry:first').remove();

         e.preventDefault();
         return false;
     });


    </script>
@endpush