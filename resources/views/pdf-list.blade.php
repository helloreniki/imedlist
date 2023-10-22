<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users Report</title>
</head>
<body>
  <div class="">
    <h2>{{ $patient->first_name }} {{ $patient->last_name }}, {{ $patient->dob->format('d.m.Y') }}</h2>
  </div>
  <div>Address: {{ $patient->address }}</div>
  <div>Phone Number: {{ $patient->phone }}</div>
  <div>Health Insurance Number: {{ $patient->health_insurance_number }}</div>
  <hr>
  <div>Ilnesses: {{ $patient->illness }}</div>
  <div>Allergies: {{ $patient->allergies }}</div>
  <div>Emergency Contact: {{ $patient->emergency_contact }}</div>
  <hr>
  <div>
    <table>
      <thead>
        <tr>
          <th class="align-left">Drug name</th>
          <th colspan=3>Dosage</th>
        </tr>
        <tr>
          <th></th>
          <th>Morning</th>
          <th>Midday</th>
          <th>Evening</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($drugs as $drug)
          <tr>
            <td class="align-left">
              <div class="first">{{ $drug->name }} <span class="concentration">{{$drug->concentration}}<span></div>
              <div>{{ $drug->active_ingredient}}</div>
            </td>
            @if(!$drug->dosage_custom)
              <td>{{ $drug->dosage_morning }} @if($drug->dosage_morning){{ $drug->unit }} @endif</td>
              <td>{{ $drug->dosage_midday }} @if($drug->dosage_midday) {{ $drug->unit }} @endif</td>
              <td>{{ $drug->dosage_evening }} @if($drug->dosage_evening) {{ $drug->unit }} @endif</td>
            @else
              <td colspan="3">{{ $drug->dosage_custom }}</td>
            @endif
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>

<style>
table {
  border-collapse: collapse;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  text-align: center;
  min-width: 400px;
  width: 100%;
  margin: 20px 0px;
}
th, td {
  border: 1px solid black;
  padding: 8px 8px 8px 8px;
}
th {
  font-size: 16px;
}
.align-left {
  text-align: left;
}
td .first {
  font-size: 18px;
  font-weight: 500;
  text-transform: uppercase;
}
.concentration {
  text-transform: lowercase;
  font-weight: normal;
}

</style>
