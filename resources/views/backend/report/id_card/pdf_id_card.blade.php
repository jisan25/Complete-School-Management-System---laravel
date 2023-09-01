<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<title>Student Id Card Report </title>
</head>
<body>

@php



@endphp

  <table id="customers">
    <tr style="text-align: center">
      <td><h2>
      <?php $image_path = '/upload/d-pathshala.png' ?> 
      <img style="text-align: center" src="{{public_path().$image_path}}" width="150px"> 
      </h2></td>
      <td style="text-align: left"><h2>D-Pathsala ERP</h2>
      <p>School Address</p>
      <p>Phone: 01846430271</p>
      <p>Email: support@dpathshala.com</p>
      <p><b>Student Id Card</b></p>
      </td>


    </tr>
  </table>

  @foreach($data as $item)

  <table id="customers">
    <tr>
      <?php $profile_image_path = '/upload/students/'.$item->student->image; ?> 

        <td> <img width="100px" src="{{  public_path().$profile_image_path }}" alt=""> </td>
        <td>Digital Pathshala</td>
        <td>Student Id Card</td>
    </tr>
    <tr>
        <td>Name : {{ $item['student']['name'] }} </td>
        <td>Session : {{ $item['student_year']['name'] }}</td>
        <td>Class : {{ $item['student_class']['name'] }}</td>
    </tr>
    <tr>
        <td>Roll : {{ $item['roll'] }}</td>
        <td>ID No : {{ $item['student']['id_no'] }}</td>
        <td>Mobile : {{ $item['student']['mobile'] }}</td>
    </tr>
  </table>
  <br>

  @endforeach
  <br>
  <br>

  <br>

<br>

<i style="font-size: 10px;float: left;">Print Data: {{date("d M Y")}}</i>





</body>
</html>
