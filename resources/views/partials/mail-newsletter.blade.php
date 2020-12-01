
<head>
    <title>{{$setting->site_title}}</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Poppins', sans-serif;
	     	scroll-behavior: smooth;
	     	margin: 0px;
	     	padding: 0px;">


<section style="height: 100%; width: 75%; margin: 0px auto; padding-bottom: 20px;">
    <div style="background-color: #c8e8ff; height: 180px; padding: 20px;   text-align: center;">
        <a href="https://omlotstate.com">
            <img src="{{asset('common/images/'.$setting->site_logo)}}" alt="Logo"  style="max-width: 100%; height: auto; margin: 0px auto; display: block;">
        </a>
        <h1 style="color: #003574; text-align: center; letter-spacing: 2px; font-weight: 600; text-transform: uppercase; margin-bottom: 10px; margin-top: 10px;">
            WELCOME TO {{$setting->site_title}}
        </h1>
        <a href="https://omlotstate.com" onMouseOver="this.style.color='#53ac53'" onMouseOut="this.style.color='#fff'" style="background-color: #0d578d; color: #fff; padding: 5px 20px; width: 150px; height: 30px; line-height: 30px; font-size: 15px; text-decoration: none; display: block; text-transform: uppercase; margin: 0px auto; font-weight: 500;letter-spacing: 0.6px;">
            View our website
        </a>
    </div>
    <div style="clear: both;"></div>
    <div style="background-color: #0d578d; padding: 25px 20px;">

        @if($mailData['image'])
            <figure style="margin: 0px; padding: 0px;">
                <img src="{{asset('common/images/'.$mailData['image'])}}" alt="" style="width: 500px; display: block; margin: 0px auto;">
            </figure>
        @endif
        <h4 style="color: #fff; font-weight: 500; margin: 0px; margin-top: 10px; text-transform: capitalize; font-size: 17px;">
            -{{$mailData['title']}}
        </h4>
        <p style="margin-top: 5px; margin-left: 10px; color: #ddd; font-size: 14px; margin-bottom: 0px;">
            {!! $mailData['body'] !!}
        </p>
    </div>
    <div style="clear: both;"></div>
    <div style="background-color: #0d578d; border-top: 1px solid #cfcfcf; padding: 10px;">
        <div style="text-align: center; padding: 15px 0px;">
            <ul style="padding-left: 0px; margin-bottom: 0px; margin-top: 0px;">
                <li style="list-style: none; display: inline-block; margin-right: 5px;">
                    <a href="{{$setting->facebook}}" title="Facebook">
                        <img src="{{asset('frontend/img/facebook-icon.png')}}" style="max-width: 100%; height: auto; margin: 0px auto; display: block;" alt="">
                    </a>
                </li>
                <li style="list-style: none; display: inline-block; margin-right: 5px;">
                    <a href="{{$setting->linkedin}}" title="Linkedin">
                        <img src="{{asset('frontend/img/linkedin-icon.png')}}" style="max-width: 100%; height: auto; margin: 0px auto; display: block;" alt="">
                    </a>
                </li>
                <li style="list-style: none; display: inline-block; margin-right: 5px;">
                    <a href="{{$setting->twitter}}" title="Twitter">
                        <img src="{{asset('frontend/img/twitter-icon.png')}}"  style="max-width: 100%; height: auto; margin: 0px auto; display: block;" alt="">
                    </a>
                </li>
                <li style="list-style: none; display: inline-block; margin-right: 5px;">
                    <a href="{{$setting->instagram}}" title="Instagram">
                        <img src="{{asset('frontend/img/instagram-icon.png')}}" style="max-width: 100%; height: auto; margin: 0px auto; display: block;" alt="">
                    </a>
                </li>
            </ul>
        </div>
        <div style="height: auto; background-color: #0d578d; padding: 20px; text-align: center; padding-top: 0px;">
            <ul style="padding-left: 0px; margin-bottom: 0px; margin-top: 0px;">
                <li style="list-style: none; display: inline-block; margin-right: 5px;">
                    <a href="https://omlotstate.com" onMouseOver="this.style.color='#53ac53'" onMouseOut="this.style.color='#fff'" style="color: #fff; font-size: 14px; font-weight: 500; text-decoration: none; text-transform: uppercase; margin-right: 10px;">
                        Home
                    </a>
                </li>
                <li style="list-style: none; display: inline-block; margin-right: 5px;">
                    <a href="https://omlotstate.com/contact-us" onMouseOver="this.style.color='#53ac53'" onMouseOut="this.style.color='#fff'" style="color: #fff; font-size: 14px; font-weight: 500; text-decoration: none; text-transform: uppercase; margin-right: 10px;">
                        Contact Us
                    </a>
                </li>
                <li style="list-style: none; display: inline-block; margin-right: 5px;">
                    <a href="https://omlotstate.com/about" onMouseOver="this.style.color='#53ac53'" onMouseOut="this.style.color='#fff'" style="color: #fff; font-size: 14px; font-weight: 500; text-decoration: none; text-transform: uppercase; margin-right: 10px;">
                        About Us
                    </a>
                </li>
                <li style="list-style: none; display: inline-block; margin-right: 5px;">
                    <a href="https://omlotstate.com/all/properties" onMouseOver="this.style.color='#53ac53'" onMouseOut="this.style.color='#fff'" style="color: #fff; font-size: 14px; font-weight: 500; text-decoration: none; text-transform: uppercase; margin-right: 10px;">
                        Property
                    </a>
                </li>
                <li style="list-style: none; display: inline-block; margin-right: 5px;">
                    <a href="https://omlotstate.com/blogs" onMouseOver="this.style.color='#53ac53'" onMouseOut="this.style.color='#fff'" style="color: #fff; font-size: 14px; font-weight: 500; text-decoration: none; text-transform: uppercase; margin-right: 10px;">
                        Blog
                    </a>
                </li>
            </ul>
            <ul style="padding-left: 0px; margin-bottom: 0px; margin-top: 10px;">
                <li style="display: block; color: #ececec; font-size: 17px; font-weight: 500; letter-spacing: 1px;">
                    phone: {{$setting->phone}}, {{$setting->mobile}}</li>
                <li style="display: block; color: #ececec; font-size: 17px; font-weight: 500; letter-spacing: 1px;">
                    mail Us: {{$setting->email}}
                </li>
            </ul>
        </div>
    </div>
</section>
</body>
 