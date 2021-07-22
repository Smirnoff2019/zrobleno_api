@extends('layouts.app')

@section('body-class', 'bg-silver')

@section('content')
    <h3 class="my-3 font-w-400">
        {{ Breadcrumbs::currentTitle() }}
        @if($routes->create)
            <button class="btn btn-sm btn-light border-silver px-3 ml-2" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Додати изображение</button>
        @endif
    </h3>

    <div class="collapse mb-3" id="collapseExample">
        <div class="card alert-primary shadow-sm">
            <form action="{{ route($routes->store) }}" method="POST" enctype="multipart/form-data" class="card-body w-100 p-0" id="upload-image-form">
                @csrf
                <div class="h-100 w-100">
                    <input type="file" class="custom-file-input cursor-pointer" id="customFile" name="image">
                    <label class="custom-file-label alert-primary text-center w-100 d-flex flex-column justify-content-center" for="customFile">
                        <p class="font-weight-normal lead">Перетяните файл в эту область</p>
                        <p class="lead">или</p>
                        <p><span class="btn btn-outline-primary px-3" type="button">Выберите файл</span></p>
                    </label>
                </div>
            </form>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col"> --}}
            <div class="d-flex border border-silver bg-white rounded-lg" style="min-height: 80vh">

                <div class="border-right bg-light">
                    <div class="list-group" style="width: 25rem;">
                        <a 
                            href="{{ route($routes->index) }}" 
                            class="rounded-0 border-left-0 border-right-0 border-top-0 text-nowrap list-group-item list-group-item-action
                                @if(!$request->get('group_id')) active @endif"
                        >
                            @if(!$request->get('group_id'))  
                                <i class="fa fa-folder-open mr-2" aria-hidden="true"></i>
                            @else 
                                <i class="fa fa-folder mr-2" aria-hidden="true"></i>
                            @endif 
                            Всі
                        </a>
                    @forelse ($imagesGroups as $group)
                        <a 
                            href="{{ $request->fullUrlWithQuery(['group_id' => $group->id]) }}" 
                            class="rounded-0 
                                border-left-0 border-right-0 border-top-0
                                @if($loop->first) border-top-0 @endif 
                                @if($request->get('group_id') == $group->id) active @endif 
                                text-nowrap 
                                list-group-item list-group-item-action
                            "
                        >
                            @if($request->get('group_id') == $group->id)  
                                <i class="fa fa-folder-open mr-2" aria-hidden="true"></i>
                            @else 
                                <i class="fa fa-folder mr-2" aria-hidden="true"></i>
                            @endif 
                            {{ $group->name }}
                        </a>
                    @empty
                        
                    @endforelse
                        <div class="collapse" id="create-new-images-group-form">
                            <form action="{{ route('admin.images.groups.store') }}" method="POST" id="create-new-images-group-form" class="d-flex align-items-center flex-nowrap rounded-0 text-nowrap border-left-0 border-right-0 list-group-item list-group-item-action">
                                @csrf
                                <i class="fa fa-folder mr-2" aria-hidden="true"></i>
                                <input type="text" name="name" value="Vestibulum at eros" class="border-primary form-control form-control-sm">
                            </form>
                        </div>
                        <a data-toggle="collapse" href="#create-new-images-group-form" class="btn btn-sm btn-light text-muted" id="create-new-images-group-btn">
                            <i class="fa fa-plus mr-2" aria-hidden="true"></i>
                            Додати
                        </a>
                    </div>
                </div>

                <div class="w-100 border-silver bg-white *shadow-sm">

                    <div class="card-body images-gallery" id="images-gallery-cur-page">
                        
                        @each('includes.gallery-image-card', $records, 'image', 'includes.empty')

                    </div>
                    <div class="d-flex justify-content-center">
                        <span class="spinner-border text-muted d-none my-5"></span>
                        <button class="btn btn-outline-primary my-5 px-4 @if(!$records->hasMorePages()) d-none @endif" id="upload-next-gallery-content-btn" data-next-page-url="{{ $records->withPath('/admin/api/gallery/images')->nextPageUrl() }}">Загрузить ещё</button>
                    </div>
                </div>

            </div>
            
        {{-- </div> --}}
        {{-- <div class="col-4">
            <div class="card bg-light shadow-sm">

            </div>
        </div> --}}
    {{-- </div> --}}
@endsection

@push('modals')
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="edit-image-frame" tabindex="-1" role="dialog" aria-labelledby="edit-image-frame" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endpush
