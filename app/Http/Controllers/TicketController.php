<?php

namespace App\Http\Controllers;

use App\DataTables\TicketDataTable;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Repositories\TicketRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Ticket;
use App\Models\UserStory;
use Response;
use Datatables;
use Illuminate\Support\Facades\Auth;

class TicketController extends AppBaseController
{
    /** @var  TicketRepository */
    private $ticketRepository;

    public function __construct(TicketRepository $ticketRepo)
    {
        $this->ticketRepository = $ticketRepo;
    }

    /**
     * Display a listing of the Ticket.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
            if(isset($input['userStoryId'])){
                $userStories = Ticket::query()->with('userStory')->where('user_story_id',$input['userStoryId'])->select('tickets.*');
            }else{
                $userStories = Ticket::query()->with('userStory')->select('tickets.*');
            }
            return Datatables::of($userStories)->make(true);
        }
        return view('tickets.index');
    }

    /**
     * Show the form for creating a new Ticket.
     *
     * @return Response
     */
    public function create()
    {   
        $userStories = UserStory::whereHas('project', function($query){ 
            return $query->whereHas('company', function($query){ 
                return $query->whereHas('users', function($query){ 
                    return $query->where('users.id', Auth::user()->id);
                });
            });
        })->get();
        return view('tickets.create',['userStories'=>$userStories]);
    }

    /**
     * Store a newly created Ticket in storage.
     *
     * @param CreateTicketRequest $request
     *
     * @return Response
     */
    public function store(CreateTicketRequest $request)
    {
        $input = $request->all();

        $ticket = $this->ticketRepository->create($input);

        Flash::success('Ticket saved successfully.');

        return redirect(route('tickets.index'));
    }

    /**
     * Display the specified Ticket.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ticket = $this->ticketRepository->find($id);

        if (empty($ticket)) {
            Flash::error('Ticket not found');

            return redirect(route('tickets.index'));
        }

        return view('tickets.show')->with('ticket', $ticket);
    }

    /**
     * Show the form for editing the specified Ticket.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ticket = $this->ticketRepository->find($id);

        if (empty($ticket)) {
            Flash::error('Ticket not found');

            return redirect(route('tickets.index'));
        }

        $userStories = UserStory::whereHas('project', function($query){ 
            return $query->whereHas('company', function($query){ 
                return $query->whereHas('users', function($query){ 
                    return $query->where('users.id', Auth::user()->id);
                });
            });
        })->get();

        return view('tickets.edit',['ticket'=> $ticket,'userStories'=>$userStories]);
    }

    /**
     * Update the specified Ticket in storage.
     *
     * @param  int              $id
     * @param UpdateTicketRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTicketRequest $request)
    {
        $ticket = $this->ticketRepository->find($id);

        if (empty($ticket)) {
            Flash::error('Ticket not found');

            return redirect(route('tickets.index'));
        }

        $ticket = $this->ticketRepository->update($request->all(), $id);

        Flash::success('Ticket updated successfully.');

        return redirect(route('tickets.index'));
    }

    /**
     * Remove the specified Ticket from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ticket = $this->ticketRepository->find($id);

        $ticket->delete();

        return $this->sendSuccess('Ticket deleted successfully.');
    }
}
