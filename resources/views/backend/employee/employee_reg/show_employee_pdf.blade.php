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
<title>{{ 'Employee - ' . $data->name. ' Information'}} </title>
</head>
<body>


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
      </td>
      <td>
        <img src="{{public_path('upload/employees/'.$data['image'])}}" width="160px" alt="image">  
        
      </td>

    </tr>
  </table>


<table id="customers">
  <tr>
    <th width="10%">SI</th>
    <th width="45%">Employee Details</th>
    <th width="45% ">Employee Data</th>
  </tr>
 

  <tr>
    <td>1</td>
    <td><b>Employee Name</b></td>
    <td>{{ $data['name'] }}</td>
  </tr>
  <tr>
    <tr>
      <td>2</td>
      <td><b>Designation</b></td>
      <td>{{ $data['designation']['name'] }}</td>
    </tr>
    <tr>
      <td>3</td>
      <td><b>Employee Id</b></td>
      <td>{{ $data->id_no }}</td>
    </tr>
    <tr>
    <td>4</td>
    <td><b>Father's Name</b></td>
    <td>{{ $data['fname'] }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td><b>Mother's Name</b></td>
    <td>{{ $data['mname'] }}</td>
  </tr>
  <tr>
    <td>6</td>
    <td><b>Mobile</b></td>
    <td>{{ $data['mobile'] }}</td>
  </tr>
  <tr>
    <td>7</td>
    <td><b>Address</b></td>
    <td>{{ $data['address'] }}</td>
  </tr>
  <tr>
    <td>8</td>
    <td><b>Gender</b></td>
    <td>{{ $data['gender'] }}</td>
  </tr>
  <tr>
    <td>9</td>
    <td><b>Religion</b></td>
    <td>{{ $data['religion'] }}</td>
  </tr>
  <tr>
    <td>10</td>
    <td><b>Date of Birth</b></td>
    <td>{{ date('d-m-Y', strtotime($data['dob'])) }}</td>
  </tr>
  <tr>
    <td>11</td>
    <td><b>Join Date</b></td>
    <td>{{ date('d-m-Y', strtotime($data['join_date'])) }}</td>
  </tr>
  <tr>
    <td>12</td>
    <td><b>Employee Salary</b></td>
    <td>{{ $data['salary'] }}</td>
  </tr>
  
</table>
<br>
<br>

<i style="font-size: 10px;float: left;">Print Data: {{date("d M Y")}}</i>

</body>
</html>
