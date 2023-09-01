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
<title> Monthly / Yearly Profit Report </title>
</head>
<body>

@php


$student_fee = App\Models\AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');

$other_cost = App\Models\AccountOtherCost::whereBetween('date', [$sdate, $edate])->sum('amount');

$emp_salary = App\Models\AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');


$total_cost = $other_cost + $emp_salary;
$profit = $student_fee - $total_cost;

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
      <p><b>Monthly and Yearly Profit</b></p>
      </td>
    

    </tr>
  </table>


<table id="customers">
  <tr>
    <td colspan="2" style="text-align: center">
        <h4>Reporting Date: {{ date('d M Y', strtotime($sdate))}} - {{ date('d M Y', strtotime($edate)) }}</h4>
    </td>
  </tr>
 

  <tr>
    <td width="50%"><h4>Purpose</h4></td>
    <td width="50%"><h4>Amount</h4></td>
  </tr>
  <tr>
    <tr>
      <td>Student Fee</td>
      <td>{{ $student_fee }}</td>
    </tr>
    <tr>
      <td>Employee Salary</td>
      <td>{{ $emp_salary }}</td>
    </tr>
  
  <tr>
    <td>Other Cose</td>
    <td>{{ $other_cost }}</td>
  </tr>
  <tr>
    <td>Total Cost</td>
    <td>{{ $total_cost }}</td>
  </tr>
  <tr>
    <td>Profit</td>
    <td>{{ $profit }}</td>
  </tr>
  
  
  
</table>
<br>

<i style="font-size: 10px;float: left;">Print Data: {{date("d M Y")}}</i>
<br>





</body>
</html>
