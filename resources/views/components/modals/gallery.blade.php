<!-- Modal Gallery Images -->
<div class="modal fade bd-example-modal-lg" id="{{ $name }}" tabindex="-1" role="dialog" aria-labelledby="{{ $name }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title font-w-400" id="{{ $name }}Label">Галерея зображень</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body modal-gallery-body p-0">
                <div class="row mx-0" style="min-height: 80vh;">
                    <div class="col-auto px-0 border-right bg-light">
                        <div class="list-group" style="width: 25rem;">
                            <a 
                                href="{{ route('admin.api.images-gallery.modal-content') }}" 
                                class="rounded-0 border-left-0 border-right-0 border-top-0 text-nowrap list-group-item list-group-item-action active"
                            >
                                <i class="fa fa-folder-open mr-2" aria-hidden="true"></i>
                                <i class="fa fa-folder mr-2 d-none" aria-hidden="true"></i>
                                Всі
                            </a>
                            @inject('imagesGroups', '\App\Models\ImagesGroup\ImagesGroup')
                            @forelse ($imagesGroups->get() as $group)
                                <a 
                                    href="{{ route('admin.api.images-gallery.modal-content', ['group_id' => $group->id]) }}" 
                                    class="rounded-0 border-left-0 border-right-0 border-top-0 text-nowrap list-group-item list-group-item-action"
                                >
                                    <i class="fa fa-folder-open mr-2 d-none" aria-hidden="true"></i>
                                    <i class="fa fa-folder mr-2" aria-hidden="true"></i>
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
                    <div class="col bg-light p-0" style="overflow-y: scroll; max-height: 80vh;">
                        <form class="modal-gallery p-4" id="modal-gallery-form">
                            {{--  --}}
                        </form>
                        <div class="d-flex flex-column justify-content-center align-items-center py-4 action-box" action="loading">
                            <span id="modal-gallery-content-preloader" class="loader fade"></span>
                            <button 
                                id="load-more-images-in-modal" 
                                type="button" 
                                class="btn btn-outline-primary px-3" >
                                Загрузить ещё
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2">
                <div class="d-flex justify-content-between w-100">
                    <button 
                        type="button" 
                        class="btn btn-outline-secondary px-3" 
                        data-dismiss="modal" >
                        Закрыть
                    </button>
                    <button 
                        id="submit_btn" 
                        type="button" 
                        class="btn btn-primary px-3" 
                        data-dismiss="modal" 
                        disabled >
                        Выбрать 
                        <span class="badge badge-light">0</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- end Modal Gallery Images -->
