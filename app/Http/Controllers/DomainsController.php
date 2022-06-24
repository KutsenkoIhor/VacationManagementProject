<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddDomainRequest;
use App\Http\Requests\EditDomainRequest;
use App\Services\Settings\DomainsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class DomainsController extends Controller
{
    private DomainsService $domainsService;

    public function __construct(DomainsService $domainsService)
    {
        $this->domainsService = $domainsService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Factory|View|Application
    {
        $domains = $this->domainsService->all();

        return view('settings.domains.index', ['domains' => $domains]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Factory|View|Application
    {
        return view('settings.domains.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddDomainRequest $request): Redirector|RedirectResponse|Application
    {
        $this->domainsService->store($request);

        return redirect(route('domains.index'))->with('status', 'Allowed domain added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id): Factory|View|Application
    {
        $domain = $this->domainsService->getById($id);

        return view('settings.domains.edit', compact([
            'domain',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, EditDomainRequest $request): Redirector|RedirectResponse|Application
    {
        $this->domainsService->update($id, $request);

        return redirect(route('domains.index'))->with('status', 'Allowed domain edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): Redirector|RedirectResponse|Application
    {
        $this->domainsService->delete($id);

        return redirect(route('domains.index'))->with('status', 'Allowed domain deleted!');
    }
}
