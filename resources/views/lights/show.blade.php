<!DOCTYPE html>
<html>
<head>
<link href="\assets\css\colorbox.css" rel="stylesheet">
<title>Page Title</title>
</head>
<body>
<h1>{{$light}}</h1>
<br>
<h1>{{$light->pictures}}</h1>

<script type="text/javascript" src="\assets\js\jquery.js"></script>
<script type="text/javascript" src="\assets\js\jquery.colorbox-min.js"></script>
 <form method="POST" action="/lights/{{$light->id}}/pictures">
 {{ csrf_field() }}
  Path:<br>
  <label for="feature_image">Feature Image</label>
<input type="text" id="feature_image" name="image_path" value="">
<a href="" class="popup_selector" data-inputid="feature_image">Select Image</a>
<input type="submit" value="Submit">
<script type="text/javascript" src="/packages/barryvdh/elfinder/js/standalonepopup.min.js"></script>
</form> 
</body>
</html> 