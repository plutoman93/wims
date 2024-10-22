@extends('layouts.backend.master')

@section('content')

{{-- @dd($id) --}}

@livewire('project.edit' ,['id'=> $id])

@endsection
