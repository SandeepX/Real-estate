<form id="document_form" method="post" action="{{route('documents.store',$property->id)}}" enctype="multipart/form-data">

    {{ csrf_field()}}

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <label>Lal Purja</label>
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input upload_doc" data-id="lal_purja_preview" name="lal_purja" id="lal_purja">
                    <label class="custom-file-label" for="lal_purja">Upload Lal Purja</label>
                </div>
            </div>
            <div id="lal_purja_preview">

            </div>
            <div id="db_documents">
                @if(isset($propertyDocument->lal_purja))
                    <div class="db_docs">

                        <a>
                            <i data-url="{{route('property.files.destroy',[$propertyDocument->id,'lal_purja'])}}" class='remove-db-doc fa fa-times' ></i>
                            <span class='badge badge-secondary'>{{$propertyDocument->lal_purja}}</span>
                        </a>

                        <a href="{{asset('common/images/'.$propertyDocument->lal_purja)}}" target="_blank">View</a>

                    </div>

                @endif
            </div>

        </div>

        <div class="col-sm-12 col-md-6">
            <label>Ghar Naksa</label>
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input upload_doc" data-id="ghar_naksa_preview" name="ghar_naksa" id="ghar_naksa">
                    <label class="custom-file-label" for="ghar_naksa">Upload Ghar Naksa</label>
                </div>
            </div>

            <div id="ghar_naksa_preview">

            </div>

            <div id="db_documents">
                @if(isset($propertyDocument->ghar_naksa))
                    <div class="db_docs">


                        <a>
                            <i data-url="{{route('property.files.destroy',[$propertyDocument->id,'ghar_naksa'])}}" class='remove-db-doc fa fa-times' ></i>
                            <span class='badge badge-secondary'>{{$propertyDocument->ghar_naksa}}</span>
                        </a>

                        <a href="{{asset('common/images/'.$propertyDocument->ghar_naksa)}}" target="_blank">View</a>

                    </div>

                @endif
            </div>

        </div>

        <div class="col-sm-12 col-md-6">
            <label>Trace Naksa</label>
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input upload_doc" data-id="trace_naksa_preview" name="trace_naksa" id="trace_naksa">
                    <label class="custom-file-label" for="trace_naksa">Upload Trace Naksa</label>
                </div>
            </div>

            <div id="trace_naksa_preview">

            </div>

            <div id="db_documents">
                @if(isset($propertyDocument->trace_naksa))
                    <div class="db_docs">


                        <a>
                            <i data-url="{{route('property.files.destroy',[$propertyDocument->id,'trace_naksa'])}}" class='remove-db-doc fa fa-times' ></i>
                            <span class='badge badge-secondary'>{{$propertyDocument->trace_naksa}}</span>
                        </a>

                        <a href="{{asset('common/images/'.$propertyDocument->trace_naksa)}}" target="_blank">View</a>

                    </div>

                @endif
            </div>

        </div>

        <div class="col-sm-12 col-md-6">
            <label>Blueprint</label>
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input upload_doc" data-id="blueprint_preview" name="blueprint" id="blueprint">
                    <label class="custom-file-label" for="blueprint">Upload Blueprint</label>
                </div>
            </div>

            <div id="blueprint_preview">

            </div>
            <div id="db_documents">
                @if(isset($propertyDocument->blueprint))
                    <div class="db_docs">


                        <a>
                            <i data-url="{{route('property.files.destroy',$propertyDocument->id)}}" class='remove-db-doc fa fa-times' ></i>
                            <span class='badge badge-secondary'>{{$propertyDocument->blueprint}}</span>
                        </a>

                        <a href="{{asset('common/images/'.$propertyDocument->blueprint)}}" target="_blank">View</a>

                    </div>

                @endif
            </div>


        </div>

        <div class="col-sm-12 col-md-6">
            <label>Charkilla</label>
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input upload_doc" data-id="charkilla_preview" name="charkilla" id="charkilla">
                    <label class="custom-file-label" for="charkilla">Upload Charkilla</label>
                </div>
            </div>

            <div id="charkilla_preview">

            </div>
            <div id="db_documents">
                @if(isset($propertyDocument->charkilla))
                    <div class="db_docs">


                        <a>
                            <i data-url="{{route('property.files.destroy',$propertyDocument->id)}}" class='remove-db-doc fa fa-times' ></i>
                            <span class='badge badge-secondary'>{{$propertyDocument->charkilla}}</span>
                        </a>
                        <a href="{{asset('common/images/'.$propertyDocument->charkilla)}}" target="_blank">View</a>
                    </div>

                @endif
            </div>

        </div>

        <div class="col-sm-12 col-md-6">
            <label>Tax receipt</label>
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input upload_doc" data-id="tax_receipt_preview" name="tax_receipt" id="tax_receipt">
                    <label class="custom-file-label" for="tax_receipt">Upload Tax Receipt</label>
                </div>
            </div>

            <div id="tax_receipt_preview">

            </div>
            <div id="db_documents">
                @if(isset($propertyDocument->tax_receipt))
                    <div class="db_docs">

                        <a>
                            <i data-url="{{route('property.files.destroy',$propertyDocument->id)}}" class='remove-db-doc fa fa-times' ></i>
                            <span class='badge badge-secondary'>{{$propertyDocument->tax_receipt}}</span>
                        </a>
                        <a href="{{asset('common/images/'.$propertyDocument->tax_receipt)}}" target="_blank">View</a>
                    </div>

                @endif
            </div>

        </div>

        <div class="col-lg-12">

            <button class="btn btn-primary" type="submit">Upload Documents</button>

        </div>
    </div>
</form>