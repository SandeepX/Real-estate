<div class="row">

    <div class="col-lg-12">
        <div class="my-prop-wrapper m-t-0">
            <h3>My Managers</h3>
            <div class="table-responsive pad-10">
            <table class="manager-table table-bordered">
                <thead>
                    <tr>
                        <th>Property</th>
                        <th>Manager</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($userPropertiesWithManager as $property)
                    <tr>
                        <td class="manger-tbl-td">
                            @if($property->featured_image)
                                <img src="{{asset('common/images/'.$property->featured_image)}}" alt="listing-photo" class="img-fluid">
                            @else
                                <img src="{{asset('common/images/no-photo.png')}}" alt="listing-photo" class="img-fluid">
                            @endif
                            <div class="manager-tbl-td-div">
                                <h4><a href="{{route('user.property.edit',$property->slug)}}">{{$property->title}}</a></h4>
                                <h5 class=""><i class="flaticon-pin"></i> {{$property->address ? $property->address->address : ''}} </h5>
                                <h6 class="table-property-price">Rs.{{$property->price}}/{{$property->price_postfix}}</h6>
                            </div>



                        </td>

                        <td>{{$property->information ? $property->information->manager_id ? $property->information->manager->name : 'No manager' :'No Manager'}}</td>

                        <td>{{$property->information && $property->information->isApprovedManager == 1 ? 'Active' : 'Pending'}}</td>

                        <td class="action">
                            <a class="edit_btn btn btn-edit-manager " href="{{route('user.property.manager.edit',$property->slug)}}">Edit Manager</a>

                            @if($property->information && $property->information->isApprovedManager == 1)
                                <form action="{{route('user.property.manager.delete',$property->slug)}}"
                                      method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit"
                                            class="btn btn-delete-manager"
                                            onclick="return confirm('Are you sure you want to delete the Manager?');">Delete Manager</button>
                                </form>
                            @endif

                        </td>
                    </tr>
                @empty
                    <tr>

                        <td class="no-data-content" colspan="5">

                            <h5 class=""><i class="flaticon-pin"></i> Currently You Don't Have Any Managers Assigned. </h5>
                        </td>


                    </tr>
                @endforelse

                </tbody>
            </table>
            </div>
        </div>

        <div class="col-12">
            {{$userPropertiesWithManager->links()}}
        </div>
    </div>
</div>