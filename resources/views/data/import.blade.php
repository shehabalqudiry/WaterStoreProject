@extends('layouts.app')

@section('content')
@section('pageTitle', 'استراد البيانات')

<form action="{{ route('excel.load') }}" method="post">
    @csrf
    <input type="file" name="fileImport" id="">
    <input type="submit" value="Submit">
</form>

@endsection
