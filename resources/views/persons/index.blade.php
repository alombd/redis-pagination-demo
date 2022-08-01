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
            <input type="number" maxlength="4"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                class="form-control" id="birth-year" name='year' placeholder="Year" value="{{ $year ? $year : '' }}">
        </div>
        <div class="col-auto">
            <label for="birth-month" class="visually-hidden">Birth month</label>
            <input type="number" maxlength="2"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                class="form-control" id="birth-month" name='month' placeholder="Month" value="{{ $month ? $month : '' }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3 submit-btn">Filter</button>
        </div>
    </form>
    <div class="table-section">
        <div class="table-sub">

            {{ $personInfo->links('vendor.pagination.custom') }}

            <table class="table table-bordered  table-striped table-bordered table-hover">
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
                        <td>{{ ++$i }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->birthday }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->country }}</td>
                    </tr>
                @endforeach
            </table>

            {{ $personInfo->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
