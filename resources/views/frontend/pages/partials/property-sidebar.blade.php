<div class="advance-form">
    <h5>Advance Search</h5>
    @include('frontend.pages.partials.advance-search-sidebar')
</div>
<div class="emi-calculator">
    <h5>Emi Calculator</h5>

    <div id="emi_errors">
        @if( session('emiError') == 'emiError')
            @include('partials.messages')
        @endif
    </div>

    <form id="emi_form" action="{{route('fe.emi')}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">Property Price</label>
                    <input type="number" id="total_amount" step="any" name="total_amount" value="{{old('total_amount')}}" class="form-control" placeholder="RS.87,000">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">Interest Rate (%)</label>
                    <input type="number" id="interest_rate" step="any" name="interest_rate" value="{{old('interest_rate')}}" class="form-control" placeholder="15%">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">Period In Months</label>
                    <input type="number" id="period" name="period" value="{{old('period')}}" class="form-control" placeholder="10 Months">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">Down Payment</label>
                    <input type="number" id="down_payment" step="any" name="down_payment" value="{{old('down_payment')}}" class="form-control" placeholder="RS.36,300">
                </div>
            </div>

            {{--<button class="btn single-prop-emi-calculator-btn" type="submit" data-toggle="collapse" data-target="#calculate-id" aria-expanded="false" aria-controls="calculate-id">Calculate</button>--}}
            <button class="btn single-prop-emi-calculator-btn" type="submit">Calculate</button>

        </div>
    </form>

    <div class="col-lg-12">
        <div class="form-group mb-0">

            <div id="emi_result" class="">

            </div>

        </div>
    </div>

</div>
<div class="contact-us-single-prop">
    <h5>Contact Us</h5>
    <ul>
        <li>
            <i class="fas fa-phone-volume"></i>
            @if(!is_null($propertyUser))
                <p>{{$propertyUser->phone}}</p>
                <p>{{$propertyUser->mobile}}</p>
            @endif

        </li>
    </ul>
    <button type="button" class="btn request-info-btn" data-toggle="modal" data-target="#request-info-id">
        Request Us
    </button>
</div>