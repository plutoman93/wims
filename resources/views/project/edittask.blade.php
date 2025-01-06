@extends('layouts.backend.master')

@section('content')

@livewire('project.edittasks',['id' => $id])

@endsection
