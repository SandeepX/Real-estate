<!-- Form -->
<form id="document_form" method="post" action="{{route('documents.store',$property->id)}}" enctype="multipart/form-data">

    {{ csrf_field()}}
    <div class="card-body">

        <div class="image-upload-wrap">
            <input class="file-upload-input" type='file' id="upload_doc" name="document[]" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                   required multiple/>
            <div class="drag-text">
                <h3>Drag and drop a file or select add Documents</h3>
            </div>
        </div>

        <div id="document_preview"></div>
        <div id="db_documents">
            @if(count($propertyDocuments) > 0)
                <div class="db_docs">
                    <hr>
                    @foreach($propertyDocuments as $document)
                      {{--  <a class='parent_images'>
                            <i data-url="{{route('property.images.destroy',$image->id)}}" class='remove-db-img fa fa-times' ></i>
                            <img class='img'  src="{{asset('common/images/'.$image->image)}}">
                        </a>--}}
                        <a>
                            <i data-url="{{route('property.files.destroy',$document->id)}}" class='remove-db-doc fa fa-times' ></i>
                            <span class='badge badge-secondary'>{{$document->document}}</span>
                        </a>

                    @endforeach
                </div>

            @endif
        </div>


    </div>

    <button class="btn btn-primary" type="submit">Upload Documents</button>

</form>