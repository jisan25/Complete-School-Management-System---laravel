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
<title>Student Result Report </title>
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
      <p><b>Student Result Report</b></p>
      </td>


    </tr>
  </table>

  <br>
  <br>
  <strong>Result of: </strong> {{$allData[0]['exam_type']['name']}} 

  <br><br>

<table id="customers">

 
    <tr>
        <td width="50%"><h4>Year / Session : </h4> {{ $allData[0]['year']['name'] }}</td>
        <td width="50%"><h4>Class : </h4> {{ $allData[0]['student_class']['name'] }}</td>
      </tr>
  
</table>

<br>

<hr style="border: dotted 1px; width: 95%;color:#000000; margin-bottom: 50px">



<table>
    <tr>
      <th>SL</th>
      <th>STUDENT ID</th>
      <th>STUDENT NAME</th>
      <th>LETTER GRADE</th>
      <th>REMARKS</th>
    </tr>



    @foreach($allData as $key => $data)
    @php
    $total_marks = App\Models\StudentMarks::select('marks')->where('id_no', $data['student']['id_no'])->sum('marks');
    $total_subjects = App\Models\StudentMarks::where('id_no', $data['student']['id_no'])->count('marks');

    $mark = $total_marks / $total_subjects;

  $grade_marks = App\Models\MarksGrade::where([['start_marks','<=', (int)$mark],['end_marks', '>=',(int)$mark ]])->first();
  $grade_name = $grade_marks->grade_name;


   
    @endphp
    <tr>
        <td>{{ $key+1 }}</td>
      <td>{{ $data['student']['id_no'] }}</td>
      <td>{{ $data['student']['name'] }}</td>
      <td>{{ $grade_name }}</td>
      <td>{{$grade_marks->remarks }} </td>
    </tr>
    @endforeach
  </table>

<br>

<i style="font-size: 10px;float: left;">Print Data: {{date("d M Y")}}</i>





</body>
</html>
