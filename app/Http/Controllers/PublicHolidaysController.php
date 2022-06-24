<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddPublicHolidayRequest;
use App\Http\Requests\EditPublicHolidayRequest;
use App\Services\PublicHolidaysService;


class PublicHolidaysController extends Controller
{
    private PublicHolidaysService $holidaysService;

    public function __construct(PublicHolidaysService $holidaysService)
    {
        $this->holidaysService = $holidaysService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidays = $this->holidaysService->all();

        return view('publicHolidays.index', ['holidays' => $holidays]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = $this->holidaysService->getCountries();

        return view('publicHolidays.create', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPublicHolidayRequest $request)
    {
        $this->holidaysService->store($request);

        return redirect(route('holidays.index'))->with('status', 'Public holiday added!');
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
        $holiday = $this->holidaysService->getById($id);
        $countries = $this->holidaysService->getCountries();

        return view('publicHolidays.edit', compact([
            'holiday',
            'countries',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPublicHolidayRequest $request, int $id)
    {
        $this->holidaysService->update($id, $request);

        return redirect(route('holidays.index'))->with('status', 'Public holiday edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->holidaysService->delete($id);

        return redirect(route('holidays.index'))->with('status', 'Public holiday deleted!');
    }
}
