@extends('layouts.layout')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Task</li>
        </ol>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่องาน</th>
            <th>ประเภทงาน</th>
            <th>วันเริ่มงาน</th>
            <th>วันครบกำหนดงาน</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Row 1, Col 2</td>
            <td>Row 1, Col 3</td>
            <td>Row 1, Col 4</td>
            <td>Row 1, Col 5</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Row 2, Col 2</td>
            <td>Row 2, Col 3</td>
            <td>Row 2, Col 4</td>
            <td>Row 2, Col 5</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Row 3, Col 2</td>
            <td>Row 3, Col 3</td>
            <td>Row 3, Col 4</td>
            <td>Row 3, Col 5</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Row 4, Col 2</td>
            <td>Row 4, Col 3</td>
            <td>Row 4, Col 4</td>
            <td>Row 4, Col 5</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Row 5, Col 2</td>
            <td>Row 5, Col 3</td>
            <td>Row 5, Col 4</td>
            <td>Row 5, Col 5</td>
        </tr>
    </tbody>
</table>

@endsection
