<?php

namespace Modules\Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Blog\Entities\Reservation;
use Modules\Blog\Http\Requests\CreateReservationRequest;
use Modules\Blog\Http\Requests\UpdateReservationRequest;
use Modules\Blog\Repositories\ReservationRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Support\Facades\Auth;

class ReservationController extends AdminBaseController
{
    /**
     * @var ReservationRepository
     */
    private $reservation;

    public function __construct(ReservationRepository $reservation)
    {
        parent::__construct();

        $this->reservation = $reservation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::id();
        $reservations = $this->reservation->all();

        return view('blog::admin.reservations.index', compact('reservations', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('blog::admin.reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateReservationRequest $request
     * @return Response
     */
    public function store(CreateReservationRequest $request)
    {
        dd($request);
        $this->reservation->create($request->all());

        return redirect()->route('admin.blog.reservation.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('blog::reservations.title.reservations')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Reservation $reservation
     * @return Response
     */
    public function edit(Reservation $reservation)
    {
        return view('blog::admin.reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Reservation $reservation
     * @param  UpdateReservationRequest $request
     * @return Response
     */
    public function update(Reservation $reservation, UpdateReservationRequest $request)
    {

        $this->reservation->update($reservation, $request->all());

        return redirect()->route('admin.blog.reservation.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('blog::reservations.title.reservations')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Reservation $reservation
     * @return Response
     */
    public function destroy(Reservation $reservation)
    {
        dd($reservation);
        $this->reservation->destroy($reservation);

        return redirect()->route('admin.blog.reservation.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('blog::reservations.title.reservations')]));
    }
}
