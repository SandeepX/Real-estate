<section class="second-parallax">
    <div class="container">
        <div class="row second-parallax-row">
            <div class="col-lg-7">
                <h4>Subscribe us to get monthly newsletter</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero minus dignissimos ad, doloremque similique maxime! Blanditiis.</p>
            </div>
            <div class="col-lg-5 parallax-subscribe-index">

                @if( session('subscribe') == 'subscribe')
                    @include('partials.messages')
                @endif

                <form role="form" method="post" action="{{route('fe.storeSubscriber')}}">
                    {{ csrf_field()}}

                    <div class="row">
                        <div class="col-lg-9 p-r-0">
                            <input type="email" name="email" placeholder="abc@gmail.com" class="form-control" required>
                        </div>
                        <div class="col-lg-3 p-l-0">
                            <button type="submit" class="btn subscribe-btn">Subscribe</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>