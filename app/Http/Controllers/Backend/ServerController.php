<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCheckRequest;
use App\Http\Requests\AddHostRequest;
use App\Models\Host;
use Illuminate\Http\Request;
use Spatie\ServerMonitor\CheckRepository;
use Spatie\ServerMonitor\HostRepository;
use Spatie\ServerMonitor\Models\Enums\CheckStatus;

class ServerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all hosts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request):\Illuminate\Contracts\Support\Renderable
    {
        $hosts = HostRepository::all()->forPage($request->get('page'), $request->get('limit'));

        return view('server.index')->with(compact('hosts'));
    }

    /**
     * Show the details of the host
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request, Host $host):\Illuminate\Contracts\Support\Renderable
    {
        $host->loadMissing('checks');

        return view('server.show', compact('host'));
    }

    /**
     * Add new host with Checks
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add(Request $request):\Illuminate\Contracts\Support\Renderable
    {
        $checks = array_flip(config('server-monitor.checks'));

        return view('server.add', compact('checks'));
    }

    /**
     * Store new check for Host
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddHostRequest $request):\Illuminate\Http\RedirectResponse
    {
        $host = Host::create($request->except(['_token', 'checks']));

        $host->checks()->saveMany(collect($request->checks)->map(function (string $checkName) {
            $checkModel = CheckRepository::determineCheckModel();

            return new $checkModel([
                'type' => $checkName,
                'status' => CheckStatus::NOT_YET_CHECKED,
                'custom_properties' => [],
            ]);
        }));

        return redirect()->route('server.show', $host);
    }

    /**
     * Add checks to host
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addCheck(Request $request, Host $host):\Illuminate\Contracts\Support\Renderable
    {
        $host->loadMissing('checks');

        // Get available Checks
        $availableChecks = array_values(
            array_diff(
                array_flip(
                    config('server-monitor.checks')
                ),
                $host->checks->pluck('type')->toArray()
            )
        );
        if (empty($availableChecks)) {
            return back(422);
        }

        return view('server.check.add', compact('host', 'availableChecks'));
    }

    /**
     * Store new check for Host
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCheck(AddCheckRequest $request, Host $host):\Illuminate\Http\RedirectResponse
    {
        $host->checks()->saveMany(collect($request->name)->map(function (string $checkName) {
            $checkModel = CheckRepository::determineCheckModel();

            return new $checkModel([
                'type' => $checkName,
                'status' => CheckStatus::NOT_YET_CHECKED,
                'custom_properties' => [],
            ]);
        }));

        return redirect()->route('server.show', $host);
    }
}
