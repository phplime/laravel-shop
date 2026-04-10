@extends('backend.admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid pt-3">
                {{ $slot }}
            </div>
        </section>
    </div>
@endsection
