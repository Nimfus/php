<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingStoreRequest;
use App\Http\Requests\SettingUpdateRequest;
use App\Models\Setting;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SettingsController extends DashboardController
{
    /**
     * @var Setting
     */
    protected $setting;

    /**
     * SettingsController constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param ViewFactory $viewFactory
     * @param Setting $setting
     */
    public function __construct(Request $request, Response $response, ViewFactory $viewFactory, Setting $setting)
    {
        parent::__construct($request, $response, $viewFactory);
        $this->setting = $setting;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $settings = $this->setting->paginate(20);

        return $this->viewFactory->make('admin-panel.settings.index', compact('settings'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return $this->viewFactory->make('admin-panel.settings.form');
    }

    /**
     * @param SettingStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(SettingStoreRequest $request): RedirectResponse
    {
        $this->setting->create([
            'name' => $request->get('name'),
            'value' => $request->get('value'),
            'description' => $request->get('description')
        ]);

        return redirect('dashboard/settings')->with('success', 'Settings successfully created');
    }

    /**
     * @param int $id
     *
     * @return View
     */
    public function edit(int $id): View
    {
        $setting = $this->setting->find($id);

        return $this->viewFactory->make('admin-panel.settings.form', compact('setting'));
    }

    /**
     * @param SettingUpdateRequest $request
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function update(SettingUpdateRequest $request, int $id): RedirectResponse
    {
        $setting = $this->setting->find($id);
        $setting->update($request->all());

        return redirect('dashboard/settings')->with('success', 'Settings successfully updated');
    }

    /**
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->setting->find($id)->delete();

        return redirect('dashboard/settings')->with('success', 'Settings successfully deleted');
    }
}