<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 25;

    /**
     * The message was model successfuly updated
     *
     * @var string
     */
    protected $successUpdateMessage = 'Данные успешно сохранены!';

    /**
     * The message was model successfuly created
     *
     * @var string
     */
    protected $successCreateMessage = 'Запись успешно добавлена!';

    /**
     * The message was model successfuly deleted
     *
     * @var string
     */
    protected $successDeleteMessage = 'Запись успешно удалена!';

    /**
     * The resourse index view layout name
     *
     * @var string
     */
    protected $indexLayoutName;

    /**
     * The resourse store view layout name
     *
     * @var string
     */
    protected $createLayoutName;

    /**
     * The resourse editor view layout name
     *
     * @var string
     */
    protected $editLayoutName;

    /**
     * The resourse route names prefix
     *
     * @var string
     */
    protected $routeNamePrefix = '';

    /**
     * The resourse route names
     *
     * @var array|object
     */
    protected $routeNames;

    /**
     * Make resource route names
     *
     * @return object
     */
    public function makeRouteNames(string $name = null)
    {
        if($name) $this->routeNamePrefix = $name;

        return (object) [
            'index'     => 'admin.'.$this->routeNamePrefix.'.index',
            'create'    => 'admin.'.$this->routeNamePrefix.'.create',
            'store'     => 'admin.'.$this->routeNamePrefix.'.store',
            'edit'      => 'admin.'.$this->routeNamePrefix.'.edit',
            'update'    => 'admin.'.$this->routeNamePrefix.'.update',
            'destroy'   => 'admin.'.$this->routeNamePrefix.'.destroy',
        ];
    }

    /**
     * Get a count record per page
     *
     * @param Request $request
     * @return int
     */
    public function perPageCount(Request $request)
    {
        return $request->get('per_page', $this->perPage) ?? $this->perPage;
    }

}

