
<head>
    <title>{{$setting->site_title}} Welcome Email</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Poppins', sans-serif;
	     	scroll-behavior: smooth;
	     	margin: 0px;
	     	padding: 0px;">


<section style="height: 100%;
		    width: 75%;
		    margin: 0px auto;
		    padding-bottom: 20px;">
    <div style="background-color: #c8e8ff; height: 275px;
			padding: 20px;
			text-align: center;">
        <a href="index.php">
            <img src="{{asset('common/images/'.$setting->site_logo)}}" alt="Logo" class="img-fluid"  style="max-width: 100%;
		    height: auto; margin: 0px auto;
			display: block;">
        </a>
        <h1 style="color: #003574;
		    text-align: center;
		    letter-spacing: 2px;
		    font-weight: 600;
		    text-transform: uppercase;
		    margin-bottom: 0px;
		    margin-top: 30px;">WELCOME TO {{$setting->site_title}}</h1>
        <p style="width: 60%;
			margin: 10px auto;
			margin-bottom: 25px;
			margin-top: 15px;
			color: #5c5c5d;
			font-size: 15px;
			font-weight: 500;
			letter-spacing: 0.5px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. aebfkasd haeh Omnis architecto nemo numquam..</p>
        <a href="{{route('fe.home')}}" onMouseOver="this.style.color='#53ac53'"
           onMouseOut="this.style.color='#fff'" style="background-color: #0d578d; color: #fff; padding: 10px 20px; width: 150px; height: 50px; font-size: 15px; text-decoration: none; text-transform: uppercase; font-weight: 500; letter-spacing: 0.6px;">Visit our website</a>
    </div>
    <div style="clear: both;"></div>
    <div style="background-color: #0d578d;
			padding: 20px;">
        <h5 style="color: #fff;
			letter-spacing: 2px;
			font-weight: 500;
			text-transform: uppercase;
			width: 60%;
			margin: 0px auto;
			font-size: 16px;">Dear,{{$user_name}}</h5>
        <p style="width: 60%;
			color: #fff;
			letter-spacing: 0.5px;
			font-size: 15px;
			margin: 10px auto;
			text-align: justify;">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet maxime distinctio animi. Ipsum repellat,
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio delectus iure qui nemo totam, quas voluptatibus numquam dolorum! Eligendi, aut, voluptas! Incidunt rem quod nesciunt nisi ad error sed quis!
            <br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, in? Blanditiis omnis illum, placeat libero illo vitae temporibus sequi dolore deserunt expedita fugit minima, possimus voluptatum fuga eveniet perspiciatis voluptates.
        </p>
        <h5 style="color: #fff;
			letter-spacing: 2px;
			font-weight: 400;
			text-transform: uppercase;
			width: 60%;
			margin: 0px auto;
			font-size: 14px;">Thank You.</h5>

        <div style="clear: both;"></div>
        <div style="text-align: center;
			margin-top: 20px;">
            <ul style="padding-left: 0px;
			margin-bottom: 0px;
			margin-top: 0px;">
                <li style="list-style: none;
			display: inline-block;
			margin-right: 5px;"><a href="#" title="Facebook"><img src="{{asset('frontend/img/facebook-icon.png')}}" class="img-fluid" style="max-width: 100%;
		    height: auto; margin: 0px auto;
			display: block;" alt=""></a></li>
                <li style="list-style: none;
			display: inline-block;
			margin-right: 5px;"><a href="#" title="Linkedin"><img src="{{asset('frontend/img/linkedin-icon.png')}}" class="img-fluid" style="max-width: 100%;
		    height: auto; margin: 0px auto;
			display: block;" alt=""></a></li>
                <li style="list-style: none;
			display: inline-block;
			margin-right: 5px;"><a href="#" title="Twitter"><img src="{{asset('frontend/img/twitter-icon.png')}}" class="img-fluid"  style="max-width: 100%;
		    height: auto; margin: 0px auto;
			display: block;" alt=""></a></li>
                <li style="list-style: none;
			display: inline-block;
			margin-right: 5px;"><a href="#" title="Instagram"><img src="{{asset('frontend/img/instagram-icon.png')}}" class="img-fluid" style="max-width: 100%;
		    height: auto; margin: 0px auto;
			display: block;" alt=""></a></li>
            </ul>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div style="height: auto; background-color: #0d578d;
			padding: 20px; text-align: center;
			padding-top: 0px;">
        <ul style="padding-left: 0px;
			margin-bottom: 0px;
			margin-top: 0px;">
            <li style="list-style: none;
			display: inline-block;
			margin-right: 5px;">
                <a href="index.php" onMouseOver="this.style.color='#53ac53'"
                   onMouseOut="this.style.color='#fff'" style="color: #fff;
			font-size: 14px;
			font-weight: 500;
			text-decoration: none;
			text-transform: uppercase;
			margin-right: 10px;">Home</a>
            </li>
            <li style="list-style: none;
			display: inline-block;
			margin-right: 5px;">
                <a href="contact.php" onMouseOver="this.style.color='#53ac53'"
                   onMouseOut="this.style.color='#fff'" style="color: #fff;
			font-size: 14px;
			font-weight: 500;
			text-decoration: none;
			text-transform: uppercase;
			margin-right: 10px;">Contact Us</a>
            </li>
            <li style="list-style: none;
			display: inline-block;
			margin-right: 5px;">
                <a href="about.php" onMouseOver="this.style.color='#53ac53'"
                   onMouseOut="this.style.color='#fff'" style="color: #fff;
			font-size: 14px;
			font-weight: 500;
			text-decoration: none;
			text-transform: uppercase;
			margin-right: 10px;">About Us</a>
            </li>
            <li style="list-style: none;
			display: inline-block;
			margin-right: 5px;">
                <a href="list-property.php" onMouseOver="this.style.color='#53ac53'"
                   onMouseOut="this.style.color='#fff'" style="color: #fff;
			font-size: 14px;
			font-weight: 500;
			text-decoration: none;
			text-transform: uppercase;
			margin-right: 10px;">Property</a>
            </li>
            <li style="list-style: none;
			display: inline-block;
			margin-right: 5px;">
                <a href="list-blog.php" onMouseOver="this.style.color='#53ac53'"
                   onMouseOut="this.style.color='#fff'" style="color: #fff;
			font-size: 14px;
			font-weight: 500;
			text-decoration: none;
			text-transform: uppercase;
			margin-right: 10px;">Blog</a>
            </li>
        </ul>
        <ul style="padding-left: 0px;
			margin-bottom: 0px;
			margin-top: 10px;">
            <li style="display: block;
			color: #ececec;
			font-size: 17px;
			font-weight: 500;
			letter-spacing: 1px;">phone:{{$setting->phone}},{{$setting->mobile}}</li>
            <li style="display: block;
			color: #ececec;
			font-size: 17px;
			font-weight: 500;
			letter-spacing: 1px;">mail Us:<a href="mailto:{{$setting->email}}" style="color: #ececec;">{{$setting->email}}</a></li>
        </ul>
    </div>
</section>

</body>
 