@extends('layouts.backend.master')

@section('content')

@livewire('project.view' ,['id'=> $id])

@endsection
