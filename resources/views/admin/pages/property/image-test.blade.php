<html>
<head>
    <script src="{{asset('backend/node_modules/jquery/dist/jquery.min.js')}}"></script>
    <script>
        
        $(document).ready(function () {
            //for image preview after upload
            $('#upload_file').change(function () {
                preview_image();
            });
        });

        function preview_image()
        {
            var total_file=document.getElementById("upload_file").files.length;
            for(var i=0;i<total_file;i++)
            {
                $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'><br>");
            }
        }


    </script>
    <style>
        body {
            font-family: sans-serif;
            background-color: #eeeeee;
        }

        .file-upload {
            background-color: #ffffff;
            width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .file-upload-btn {
            width: 100%;
            margin: 0;
            color: #fff;
            background: #1FB264;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #15824B;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .file-upload-btn:hover {
            background: #1AA059;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .file-upload-btn:active {
            border: 0;
            transition: all .2s ease;
        }

        .file-upload-content {
            display: none;
            text-align: center;
        }

        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload-wrap {
            margin-top: 20px;
            border: 4px dashed #1FB264;
            position: relative;
        }

        .image-dropping,
        .image-upload-wrap:hover {
            background-color: #1FB264;
            border: 4px dashed #ffffff;
        }

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: #222;
        }

        .drag-text {
            text-align: center;
        }

        .drag-text h3 {
            font-weight: 100;
            text-transform: uppercase;
            color: #15824B;
            padding: 60px 0;
        }

        .file-upload-image {
            max-height: 200px;
            max-width: 200px;
            margin: auto;
            padding: 20px;
        }

        .remove-image {
            width: 200px;
            margin: 0;
            color: #fff;
            background: #cd4535;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #b02818;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .remove-image:hover {
            background: #c13b2a;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .remove-image:active {
            border: 0;
            transition: all .2s ease;
        }
    </style>
</head>
<body>
<div id="wrapper">
   {{-- <form action="upload_file.php" method="post" enctype="multipart/form-data">
        <input type="file" id="upload_file" name="upload_file[]" onchange="preview_image();" multiple/>
        <input type="submit" name='submit_image' value="Upload Image"/>
    </form>--}}

    {{--<form action="upload_file.php" method="post" enctype="multipart/form-data">
        <div class="image-upload-wrap">
        <input type="file" id="upload_file" name="upload_file[]" multiple/>
        <div class="drag-text">
            <h3>Drag and drop a file or select add Image</h3>
        </div>
        </div>

    </form>--}}
    <form action="upload_file.php" method="post" enctype="multipart/form-data">
    <div class="image-upload-wrap">
        <input class="file-upload-input" type='file' id="upload_file" name="upload_file[]" accept="image/*" multitple/>
        <div class="drag-text">
            <h3>Drag and drop a file or select add Image</h3>
        </div>
    </div>
    </form>

    <div id="image_preview"></div>


</div>
</body>
</html>