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
<title>{{ $details['0']['employee']->name. ' - Monthly Salary'}} </title>
</head>
<body>

@php

$date = date('Y-m', strtotime($details['0']->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }

    $totalAttend = App\Models\EmployeeAttendance::with(['employee'])->where($where)->where('employee_id', $details['0']->employee_id)->get();
    $absentCount = count($totalAttend->where('attend_status', 'absent'));

    $salary = (float)$details['0']['employee']['salary'];
    $salaryPerDay = (float)$salary / 30;
    $totalSalaryMinus =  (float)$absentCount * (float)($salaryPerDay);
    $totalSalary = (float)$salary - (float)$totalSalaryMinus;

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
      <p><b>Employee Monthly Salary</b></p>
      </td>
      <td>
        <img src="{{public_path('upload/employees/'.$details['0']['employee']['image'])}}" width="160px" alt="image">  
        
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
    <td>{{ $details['0']['employee']['name'] }}</td>
  </tr>
  <tr>
    <tr>
      <td>2</td>
      <td><b>Basic Salary</b></td>
      <td>{{ $details['0']['employee']['salary'] }}</td>
    </tr>
    <tr>
      <td>3</td>
      <td><b>Total Absent in This Month</b></td>
      <td>{{ $absentCount }}</td>
    </tr>
  
  <tr>
    <td>4</td>
    <td><b>Month</b></td>
    <td>{{ date('M Y', strtotime($details['0']['date'])) }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td><b>Salary this month</b></td>
    <td>{{ $totalSalary }}</td>
  </tr>
  
  
  
</table>
<br>

<i style="font-size: 10px;float: left;">Print Data: {{date("d M Y")}}</i>
<br>

<hr style="border: dotted 1px; width: 95%;color:#000000; margin-bottom: 50px">

<table id="customers">
    <tr>
      <th width="10%">SI</th>
      <th width="45%">Employee Details</th>
      <th width="45% ">Employee Data</th>
    </tr>
   
  
    <tr>
      <td>1</td>
      <td><b>Employee Name</b></td>
      <td>{{ $details['0']['employee']['name'] }}</td>
    </tr>
    <tr>
      <tr>
        <td>2</td>
        <td><b>Basic Salary</b></td>
        <td>{{ $details['0']['employee']['salary'] }}</td>
      </tr>
      <tr>
        <td>3</td>
        <td><b>Total Absent in This Month</b></td>
        <td>{{ $absentCount }}</td>
      </tr>
    
    <tr>
      <td>4</td>
      <td><b>Month</b></td>
      <td>{{ date('M Y', strtotime($details['0']['date'])) }}</td>
    </tr>
    <tr>
      <td>5</td>
      <td><b>Salary this month</b></td>
      <td>{{ $totalSalary }}</td>
    </tr>
    
    
    
  </table>
  <br>
  
  <i style="font-size: 10px;float: left;">Print Data: {{date("d M Y")}}</i>
  <br>


</body>
</html>
