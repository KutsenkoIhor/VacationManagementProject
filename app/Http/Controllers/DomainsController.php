<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddDomainRequest;
use App\Http\Requests\EditDomainRequest;
use App\Repositories\Interfaces\DomainsRepositoryInterface;

class DomainsController extends Controller
{
    private $domainRepository;

    public function __construct(DomainsRepositoryInterface $domainsRepository)
    {
        $this->domainRepository = $domainsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domains = $this->domainRepository->all();

        return view('settings.domains.index', ['domains' => $domains]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.domains.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddDomainRequest $request)
    {
        $this->domainRepository->store($request);

        return redirect(route('domains.index'))->with('status', 'Allowed domain added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $domain = $this->domainRepository->getById((int) $id);

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
    public function update(int $id, EditDomainRequest $request)
    {
        $this->domainRepository->update((int) $id, $request);

        return redirect(route('domains.index'))->with('status', 'Allowed domain edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->domainRepository->delete((int) $id);

        return redirect(route('domains.index'))->with('status', 'Allowed domain deleted!');
    }
}
