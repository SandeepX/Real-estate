<form id="document_form" method="post" action="{{route('user.property.files.store',$property->id)}}" enctype="multipart/form-data">

    {{ csrf_field()}}

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group message">
                <label>Upload Profile Picture</label>
            </div>
            <div class="image-upload-wrap">
                <input class="file-upload-input" type='file' id="upload_doc" name="document[]" multiple/>
                <div class="drag-text">
                    <h3>Drag and drop a file or Click here</h3>
                </div>
            </div>
            <div id="document_preview"></div>
            <div id="db_documents">
                @if(count($propertyDocuments) > 0)
                    <div class="db_docs">
                        <hr>
                        @foreach($propertyDocuments as $document)

                            <a>
                                <i data-url="{{route('user.property.files.destroy',$document->id)}}" class='remove-db-doc fa fa-times' ></i>
                                <span class='badge badge-secondary'>{{$document->document}}</span>
                            </a>

                        @endforeach
                    </div>

                @endif
            </div>
        </div>

        <div class="col-lg-12">
            <div class="send-btn">
                <button type="submit" class="btn btn-basic-info">Upload Document</button>
            </div>
        </div>
    </div>
</form>