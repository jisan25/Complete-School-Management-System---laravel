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
</style>
<title>Employee Attendance Report </title>
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
      <p><b>Employee Attendance Report</b></p>
      </td>


    </tr>
  </table>

  <br>
  <br>
  <strong>Employee Name: </strong> {{$allData[0]['employee']['name']}}, <strong> ID No </strong> {{$allData[0]['employee']['id_no']}}, <strong> Month: </strong> {{$month}}

  <br><br>

<table id="customers">

 
    <tr>
        <td width="50%"><h4>Date</h4></td>
        <td width="50%"><h4>Attend Status</h4></td>
      </tr>
@foreach ($allData as $value)
<tr>
    <td width="50%"><h4>{{date('d-m-Y', strtotime($value->date))}}</h4></td>
    <td width="50%"><h4>{{$value->attend_status}}</h4></td>
  </tr>   
@endforeach

   <tr>
    <td colspan="2">
        <strong>Total Absent : </strong> {{$absents}} , <strong> Total Leaves: </strong> {{$leaves}}
    </td>
   </tr>
  
</table>
<br>

<i style="font-size: 10px;float: left;">Print Data: {{date("d M Y")}}</i>
<br>

<hr style="border: dotted 1px; width: 95%;color:#000000; margin-bottom: 50px">




</body>
</html>
