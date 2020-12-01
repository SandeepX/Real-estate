
<head>
    <title>{{$setting->site_title}}Reset Password</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Poppins', sans-serif; scroll-behavior: smooth; margin: 0px; padding: 0px;">

<section style="background-color: #0d578d;
	padding-top: 20px;
	height: 100%;
	width: 75%;
	margin: 0px auto;
	padding-bottom: 20px;">
    <div>
        <h1 style="color: #fff;
		    text-align: center;
		    letter-spacing: 2px;
		    font-weight: 600;
		    text-transform: uppercase;
		    margin-bottom: 20px;
		    margin-top: 0px;">WELCOME TO {{$setting->site_title}}</h1>
        <figure><img src="{{asset('common/images/'.$setting->site_logo)}}" style="max-width: 100%;
		    height: auto; margin: 0px auto;
			display: block;" alt=""></figure>
        <h2 style="color: #fff;
		    text-align: center;
		    letter-spacing: 2px;
		    font-weight: 600;
		    text-transform: uppercase;
		    margin: 5px 0px;">Confirm Passwor</h2>
        <p style="width: 60%;
			color: #fff;
			letter-spacing: 0.5px;
			font-size: 14px;
			font-weight: 500;
			margin: 15px auto;
			text-align: center;">
            You are receiving this email because we received a password reset request for your account.
            If you did not request a password reset, no further action is required.
        </p>

        <a href="{{$route_link}}" onMouseOver="this.style.color='#53ac53'"
           onMouseOut="this.style.color='#003574'" style="background-color: #fff;
			color: #003574;
			padding: 10px;
			margin: 15px auto;
			text-align: center;
			display: block;
			width: 200px;
			text-decoration: none;
			font-size: 16px;
			text-transform: uppercase;
			font-weight: 600;
			border-radius: 50px;
			box-shadow: 0 0 8px 0 rgb(9, 57, 93);">Reset Password</a>

        <p style="width: 60%;
			color: #fff;
			letter-spacing: 0.5px;
			font-size: 14px;
			font-weight: 500;
			margin: 15px auto;
			text-align: center;">
            Regards,
            Real Estate
        </p>
        <hr>
        <p style="width: 60%;
			color: #fff;
			letter-spacing: 0.5px;
			font-size: 14px;
			font-weight: 500;
			margin: 15px auto;
			text-align: center;">
            If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
            <a href="{{$route_link}}">{{$route_link}}</a>
        </p>


        <div style="clear: both"></div>
        <div style="text-align: center;
			margin-top: 20px;">
            <ul style="padding-left: 0px; ">
                <li style="list-style: none;
			display: inline-block;"><a href="{{$setting->facebook}}" title="Facebook" ><img src="{{asset('frontend/img/facebook-icon.png')}}" class="img-fluid" style="max-width: 100%;
		    height: auto; margin: 0px auto;
			display: block;" alt=""></a></li>
                <li style="list-style: none;
			display: inline-block;"><a href="{{$setting->linkedin}}" title="Linkedin"><img src="{{asset('frontend/img/linkedin-icon.png')}}" class="img-fluid" style="max-width: 100%;
		    height: auto; margin: 0px auto;
			display: block;" alt=""></a></li>
                <li style="list-style: none;
			display: inline-block;"><a href="{{$setting->twitter}}" title="Twitter"><img src="{{asset('frontend/img/twitter-icon.png')}}" class="img-fluid" style="max-width: 100%;
		    height: auto; margin: 0px auto;
			display: block;" alt=""></a></li>
                <li style="list-style: none;
			display: inline-block;"><a href="{{$setting->instagram}}" title="Instagram"><img src="{{asset('frontend/img/instagram-icon.png')}}" class="img-fluid" style="max-width: 100%;
		    height: auto; margin: 0px auto;
			display: block;" alt=""></a></li>
            </ul>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div style="text-align: center;">
        <ul style="margin-bottom: 0px;
			padding-left: 0px;">
            <li style="display: block!important;
			color: #ececec;
			font-size: 18px;
			font-weight: 600;
			letter-spacing: 1px;">phone: {{$setting->phone}},{{$setting->mobile}}</li>
            <li style="display: block!important;
			color: #ececec;
			font-size: 18px;
			font-weight: 600;
			letter-spacing: 1px;">mail Us: <a href="mailto:{{$setting->email}}" style="color: #ececec;">{{$setting->email}}</a></li>
        </ul>
    </div>
</section>

</body>









