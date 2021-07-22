@inject('statuses', 'App\Services\Blade\StatusesService')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <a href="#collapse-portfolio-{{ $newPortfolioID = time()+rand(1, 1000) }}" 
                class="" 
                role="button" 
                data-toggle="collapse" 
                aria-expanded="true"
            >Нове портфоліо</a>
        </h5>
    </div>
    <div id="collapse-portfolio-0" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
            <input type="hidden" name="portfolios[{{ $newPortfolioID }}][id]" value="{{ $newPortfolioID }}">
            <x-input
                id="portfolio-inp-name-{{ $newPortfolioID }}"
                type="text"
                label="Назва:"
                name="portfolios[{{ $newPortfolioID }}][name]"
                value=""
                placeholder="Введіть назву..."
            >
            </x-input>

            <x-input
                type="text"
                label="Ярлик:"
                name="portfolios[{{ $newPortfolioID }}][slug]"
                data-slugable
                data-slugify="input#portfolio-inp-name-{{ $newPortfolioID }}"
                value=""
                placeholder="Додайте ярлык"
            >
            </x-input>

            <x-input
                type="number"
                label="Загальна площа:"
                name="portfolios[{{ $newPortfolioID }}][total_area]"
                value=""
                placeholder="34"
            >
            </x-input>

            <x-input
                type="number"
                label="Тривалість:"
                name="portfolios[{{ $newPortfolioID }}][duration]"
                value=""
                placeholder="31"
            >
            </x-input>

            <x-input
                type="number"
                label="Бюджет:"
                name="portfolios[{{ $newPortfolioID }}][budget]"
                value=""
                placeholder="120650"
            >
            </x-input>

            <x-input-image
                label="Обкладинка:"
                name="portfolios[{{ $newPortfolioID }}][image_id]"
                mode="single"
                modal="modal-galery-for-meta"
            >
            </x-input-image>

            <div class="border border-silver p-3 w-100 bg-light mb-3">

                <h5 class="mb-3">Зображення портфоліо:</h5>

                <div id="portfolios-images-area-{{ $newPortfolioID }}">
                    <x-input-image
                        label="Зображення:"
                        name="portfolios[{{ $newPortfolioID }}][images][]"
                        mode="single"
                        modal="modal-galery-for-meta"
                    >
                    </x-input-image>
                </div>
                
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary px-4 append-new-contractor-portfolio-image" data-append-action="{{ route('admin.api.append-field') }}" data-append-area="#portfolios-images-area-{{ $newPortfolioID }}" data-append-method="find" data-append-data='@json(['label' => 'Зображення', 'name' => 'portfolios['.$newPortfolioID.'][images][]', 'type' => 'image'])'>+ Додати зображення</button>
                </div>

            </div>

            <x-select
                label="Статус:"
                name="portfolios[{{ $newPortfolioID }}][status_id]"
                value=""
                :options="$statuses->common()"
            >
            </x-select>
        </div>
    </div>
</div>