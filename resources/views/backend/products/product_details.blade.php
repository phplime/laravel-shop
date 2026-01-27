@extends('backend.vendor.layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body p-0">
                @include("profile.common_layouts.item_details_thumb",['page_type'=>'singlePage','hideModal'=>true])
            </div>
        </div>
    </div>
</div>
@endsection