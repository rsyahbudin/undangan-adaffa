@extends('layouts.app')

@section('title', 'Undangan ' . $guest->name)

@section('content')
<div id="flipbook-container" class="w-full h-screen flex justify-center items-center p-5 box-border bg-black">
    <div id="flipbook">
        @include('invitation.pages.cover')
        @include('invitation.pages.welcome')
        @include('invitation.pages.couple')
        @include('invitation.pages.events')
        @include('invitation.pages.rsvp')
        @include('invitation.pages.thankyou')
    </div>
</div>

@include('invitation.pages.script')
@endsection