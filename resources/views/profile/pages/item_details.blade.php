@extends('profile.layouts.app')
@section('content')
<main class="page-wrap item-details-page">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                    @include('profile.common_layouts.item_details_thumb', ['hideModal' => true, 'page_type' => 'single-page'])
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
<style>
    .item-details-page {
        background: var(--bg-soft);
        min-height: calc(100vh - 120px);
    }
    .singleItemPage.single-page .modal-header {
        display: none;
    }
    .singleItemPage.single-page .modal-footer {
        position: sticky;
        bottom: 0;
        background: var(--bg-card);
        border-top: 1px solid var(--border-color);
        padding: 1rem 1.5rem;
        z-index: 10;
        box-shadow: 0 -4px 12px rgba(0,0,0,0.05);
    }
    .singleItemPage.single-page .itemImg img {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
    }
</style>
@endpush
