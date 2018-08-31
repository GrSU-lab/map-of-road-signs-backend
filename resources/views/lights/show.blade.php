<!DOCTYPE html>
<html>
<body>
<h1>{{$light}}</h1>
<br>
<h1>{{$light->pictures}}</h1>

 <form method="POST" action="/lights/{{$light->id}}/pictures">
 {{ csrf_field() }}
  Path:<br>
  <input type="text" name="image_path" value="somepath"><br>
  <input type="submit" value="Submit">
</form> 
</body>
</html> 