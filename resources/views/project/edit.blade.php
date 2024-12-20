@extends('layouts.backend.master')

@section('content')

{{-- @dd($id) --}}

@livewire('project.editaccounts' ,['id'=> $id])
{{-- เป็นการเข้าถึง component ที่ตำแหน่ง app/Livewire/Project/EditAccounts --}}

@endsection
