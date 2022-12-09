<?php

namespace Bytelaunch\Nutristudents\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;

use Bytelaunch\Nutristudents\Models\HelpState;
use Bytelaunch\Nutristudents\Actions\HelpStates\CreateHelpStateAction;
use Bytelaunch\Nutristudents\Actions\HelpStates\UpdateHelpStateAction;
use Bytelaunch\Nutristudents\Actions\HelpStates\DeleteHelpStateAction;

use Illuminate\Support\Facades\Route;


class HelpStateController extends Controller
{

    public function index(Request $request) : Response
    {
        $helpstates_data  = HelpState::orderBy('name','asc')->get();

        return Jetstream::inertia()->render($request, 'HelpStates/HelpStates', [
               'helpstates_data' => $helpstates_data,
        ]);
    }


    public function create(Request $request)
    {
        return Jetstream::inertia()->render($request, 'HelpStates/HelpStates-add', [

        ]);
    }


    public function store(Request $request)
    {

        $request->validate([
          'helpstate_name' => 'required|string',
          'helpstate_page' => 'required|unique:help_states,page_url',
        ],[
          'helpstate_name.required' => 'This field is required.',
          'helpstate_page.required' => 'This field is required.',
        ]);

        //dd($request->all());
        $helpstate = (new CreateHelpStateAction())
            ->setName($request->helpstate_name)
            ->setPage(strtolower($request->helpstate_page))
            ->setYoutubeID($request->helpstate_youtube)
            ->setContent($request->helpstate_content)
            ->create();

        return redirect()->route('help-states');

    }


    public function edit(Request $request, HelpState $helpstate)
    {
        $helpstate_data = HelpState::find($helpstate->id);

        return Jetstream::inertia()->render($request, 'HelpStates/HelpStates-edit', [
                'helpstate' => $helpstate_data,
        ]);
    }


    public function update(Request $request, HelpState $helpstate)
    {
        $request->validate([
          'helpstate_name' => 'required|string',
          'helpstate_page' => 'required',
        ],[
          'helpstate_name.required' => 'This field is required.',
          'helpstate_page.required' => 'This field is required.',
        ]);


        $helpstate = (new UpdateHelpStateAction())
            ->setHelpState($helpstate)
            ->setName($request->helpstate_name)
            ->setPage(strtolower($request->helpstate_page))
            ->setYoutubeID($request->helpstate_youtube)
            ->setContent($request->helpstate_content)
            ->update();

        return redirect()->route('help-states');
    }



    public function destroy(HelpState $helpstate)
    {
        $remove_helpstate = (new DeleteHelpStateAction())
            ->sourceHelpState($helpstate)
            ->deleteHelpState();

        return redirect()->route('help-states');
    }



    public function search(Request $request)
    {

        $term         = $request->json('term');
        $hs_search    = HelpState::whereRaw("LOWER(name) LIKE '%".strtolower($term)."%'")->orderBy('name','asc')->get();

        return response()->json($hs_search);
    }


    public function getCurrentHelpStateInfo(Request $request)
    {
          $route_name  = $request->json('route_name');

          $helpstate = HelpState::where("page_url",$route_name)->orderBy('name','asc')->first();

          return response()->json($helpstate);
    }
}
