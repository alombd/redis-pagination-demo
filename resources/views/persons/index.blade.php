@extends('layout.index')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Person Information</h2>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<form class="row g-3">
    <div class="col-auto">
        <label for="birth-year" class="visually-hidden">Birth year</label>
        <input type="text" class="form-control" id="birth-year" name='birth_year' placeholder="Year">
    </div>
    <div class="col-auto">
      <label for="birth-month" class="visually-hidden">Birth month</label>
      <input type="text" class="form-control" id="birth-month" name='birth_month' placeholder="Month">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-3">Filter</button>
    </div>
</form>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Email Address</th>
        <th>Name</th>
        <th>Birthday</th>
        <th>Phone</th>
        <th>Country</th>
    </tr>
    @foreach ($personInfo as $item)
    <tr>
        <td>{{ ++$i}}</td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->birthday }}</td>
        <td>{{ $item->phone }}</td>
        <td>{{ $item->country }}</td>
    </tr>
    @endforeach
</table>

{!! $personInfo->links() !!}
@endsection