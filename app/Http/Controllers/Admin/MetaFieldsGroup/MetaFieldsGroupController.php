<?php

namespace App\Http\Controllers\Admin\MetaFieldsGroup;

use App\Http\Controllers\Admin\Controller;
use App\Models\Meta\MetaFieldsGroup;
use App\Services\Blade\MetaFieldsService;
use Illuminate\Http\Request;

class MetaFieldsGroupController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(MetaFieldsGroup $group, array $routes, array $layouts)
    {
        $this->model = $group->with('fields');

        $this->routes  = (object) $routes;
        $this->layouts = (object) $layouts;
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view($this->layouts->index, ['records' => $this->model->latest()->paginate($request->get('per_page', $this->perPage))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view($this->layouts->create);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @method POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = $this->model->create($request->only([
            'name',
            'slug',
            'description',
        ]));

        $group->postTypes()->sync($request->get('accept_post_types', []));
        $group->taxonomies()->sync($request->get('accept_taxonomies', []));

        $metaFields = collect($request->get('fields', []));

        $groupedFields = $metaFields->mapToGroups(function ($field, $key) {
            $meta   = MetaFieldsService::createNewMeta($field);
            $parent = $field['parent_id'] ?? '';
            return ["$parent" => ["" . $key => $meta]];
        });

        $metaFields = $groupedFields->collapse()->mapWithKeys(function ($item) {
            return $item;
        });

        $result = $groupedFields->map(function ($fieldsGroup, $key) use ($metaFields) {
            if (!$key) {
                return $fieldsGroup;
            }

            $parent = $metaFields[$key];

            return $fieldsGroup->collapse()->map(function ($field, $_key) use ($parent) {
                return $field->parent()->associate($parent)->save();
            });
        });

        $group->fields()->sync($metaFields->pluck('id'));

        return redirect()
            ->route($this->routes->edit, $group->id)
            ->with('success', $this->successCreateMessage);
    }

    /**
     * Display the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @method GET
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, MetaFieldsGroup $group)
    {
        return view($this->layouts->edit, [
            'record' => $group,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @method PUT
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MetaFieldsGroup $group)
    {
        // dd($request->all());

        $group->update($request->only([
            'name',
            'slug',
            'description',
        ]));

        $group->postTypes()->sync($request->get('accept_post_types', []));
        $group->taxonomies()->sync($request->get('accept_taxonomies', []));

        $metaFields = collect($request->get('fields', []));

        $groupedFields = $metaFields->mapToGroups(function ($field, $key) {
            $meta   = MetaFieldsService::updateOrCreateMeta($field);
            $parent = $field['parent_id'] ?? '';

            return [$parent => [$key => $meta]];
        });

        $metaFields = $groupedFields->collapse()->mapWithKeys(function ($item) {
            return $item;
        });

        $result = $groupedFields->map(function ($fieldsGroup, $key) use ($metaFields) {
            if (!$key) {
                return $fieldsGroup;
            }

            $parent = $metaFields[$key];

            return $fieldsGroup->collapse()->map(function ($field, $_key) use ($parent) {
                return $field->parent()->associate($parent)->save();
            });
        });

        $group->fields()->sync($metaFields->pluck('id'));

        return back()->with('success', $this->successUpdateMessage)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @method DELETE
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MetaFieldsGroup $group)
    {
        $group->delete($group);

        return redirect()
            ->route($this->routes->index)
            ->with('success', $this->successDeleteMessage);
    }

}
