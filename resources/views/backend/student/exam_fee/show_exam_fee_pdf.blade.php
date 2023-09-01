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
<title>{{ $data->student->name. ' - '  .$data->student_year->name. ' - Reg Fee Details'}} </title>
</head>
<body>

@php
$registrationfee = App\Models\FeeCategoryAmount::where('fee_category_id', '2')->where('class_id', $data->class_id)->first();

            $originalfee = $registrationfee->amount;
            $discount = $data['discount']['discount'];
            $discounttablefee = $discount / 100 * $originalfee;
            $finalfee = (float)$originalfee - (float)$discounttablefee;
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
      </td>
      <td>
        <img src="{{public_path('upload/students/'.$data['student']['image'])}}" width="150px" alt="image">  
        
      </td>

    </tr>
  </table>


<table id="customers">
  <tr>
    <th width="10%">SI</th>
    <th width="45%">Student Details</th>
    <th width="45% ">Student Data</th>
  </tr>
 

  <tr>
    <td>1</td>
    <td><b>Student Name</b></td>
    <td>{{ $data['student']['name'] }}</td>
  </tr>
  <tr>
    <tr>
      <td>2</td>
      <td><b>Student ID No</b></td>
      <td>{{ $data['student']['id_no'] }}</td>
    </tr>
    <tr>
      <td>3</td>
      <td><b>Student Roll</b></td>
      <td>{{ $data->roll }}</td>
    </tr>
  
  <tr>
    <td>4</td>
    <td><b>Session</b></td>
    <td>{{ $data['student_year']['name'] }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td><b>Class</b></td>
    <td>{{ $data['student_class']['name'] }}</td>
  </tr>
  <tr>
    <td>6</td>
    <td><b>{{$exam}} Fee</b></td>
    <td>{{ $originalfee }} taka</td>
  </tr>
  <tr>
    <td>7</td>
    <td><b>Discount Fee</b></td>
    <td>{{ $discount }}%</td>
  </tr>
  <tr>
    <td>8</td>
    <td><b>Fee For this Student</b></td>
    <td>{{ $finalfee }} taka</td>
  </tr>
  
  
</table>
<br>

<i style="font-size: 10px;float: left;">Print Data: {{date("d M Y")}}</i>
<br>

<hr style="border: dotted 1px; width: 95%;color:#000000; margin-bottom: 50px">

<table id="customers">
    <tr>
      <th width="10%">SI</th>
      <th width="45%">Student Details</th>
      <th width="45% ">Student Data</th>
    </tr>
   
  
    <tr>
      <td>1</td>
      <td><b>Student Name</b></td>
      <td>{{ $data['student']['name'] }}</td>
    </tr>
    <tr>
      <tr>
        <td>2</td>
        <td><b>Student ID No</b></td>
        <td>{{ $data['student']['id_no'] }}</td>
      </tr>
      <tr>
        <td>3</td>
        <td><b>Student Roll</b></td>
        <td>{{ $data->roll }}</td>
      </tr>
     
    <tr>
      <td>4</td>
      <td><b>Session</b></td>
      <td>{{ $data['student_year']['name'] }}</td>
    </tr>
    <tr>
      <td>5</td>
      <td><b>Class</b></td>
      <td>{{ $data['student_class']['name'] }}</td>
    </tr>
    <tr>
      <td>6</td>
      <td><b>{{$exam}} Fee</b></td>
      <td>{{ $originalfee }} taka</td>
    </tr>
    <tr>
      <td>7</td>
      <td><b>Discount Fee</b></td>
      <td>{{ $discount }}%</td>
    </tr>
    <tr>
      <td>8</td>
      <td><b>Fee For this Student</b></td>
      <td>{{ $finalfee }} taka</td>
    </tr>
    
    
  </table>
<br>
<i style="font-size: 10px;float: left;">Print Data: {{date("d M Y")}}</i>
</body>
</html>
