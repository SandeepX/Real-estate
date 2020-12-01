<section class="index-property partners-block bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="featured-prop-title">Our Clients/Sponsers</h3>
                <div class="bod-bot-div"></div>
            </div>
            <div class="col-md-12">
                <div class="partners-carousel owl-carousel partner-nav right-position">

                    @foreach($sponsers as $sponser)
                        @if($sponser->company_logo)
                            <div class="partner-item">
                                <a href="{{$sponser->company_website}}" target="_blank">
                                    <img src="{{asset('common/images/'.$sponser->company_logo)}}" alt="partner" class="img-fluid">
                                </a>
                            </div>
                        @endif


                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>