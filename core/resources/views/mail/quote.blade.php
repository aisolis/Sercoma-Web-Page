<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documento</title>
    <style>
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
</head>
<body>
    <table>
        @foreach ($fields as $key => $field)
            @php
            if (is_array($field)) {
                $str = implode(", ", $field);
                $value = $str;
            } else {
                $value = $field;
            }
            @endphp

            <tr>
                <th>{{str_replace("_"," ",$key)}}</th>
                <th>{{$value}}</th>
            </tr>
        @endforeach

    </table>
</body>
</html>
