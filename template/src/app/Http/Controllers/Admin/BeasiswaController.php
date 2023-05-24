<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBeasiswaRequest;
use App\Http\Requests\StoreBeasiswaRequest;
use App\Http\Requests\UpdateBeasiswaRequest;
use App\Models\Beasiswa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BeasiswaController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('beasiswa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Beasiswa::query()->select(sprintf('%s.*', (new Beasiswa)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'beasiswa_show';
                $editGate      = 'beasiswa_edit';
                $deleteGate    = 'beasiswa_delete';
                $crudRoutePart = 'beasiwas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('beasiswaname', function ($row) {
                return $row->beasiswaname ? $row->beasiswaname : '';
            });
            $table->editColumn('nim', function ($row) {
                return $row->nim ? $row->nim : '';
            });
            $table->editColumn('jurusan', function ($row) {
                return $row->jurusan ? $row->jurusan : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.beasiswas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('beasiswa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.beasiswas.create');
    }

    public function store(StoreBeasiswakRequest $request)
    {
        $beasiswa = Beasiswa::create($request->all());

        return redirect()->route('admin.beasiswas.index');
    }

    public function edit(Beasiswa $beasiswa)
    {
        abort_if(Gate::denies('beasiswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.beasiswas.edit', compact('beasiswa'));
    }

    public function update(UpdateBeasiswaRequest $request, Beasiswa $beasiswa)
    {
        $beasiswa->update($request->all());

        return redirect()->route('admin.beasiswas.index');
    }

    public function show(Beasiswa $beasiswa)
    {
        abort_if(Gate::denies('beasiswa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.beasiswas.show', compact('beasiswa'));
    }

    public function destroy(Beasiswa $beasiswa)
    {
        abort_if(Gate::denies('beasiswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $beasiswa->delete();

        return back();
    }

    public function massDestroy(MassDestroyBeasiswaRequest $request)
    {
        $beasiswas = Beasiswa::find(request('ids'));

        foreach ($beasiswas as $beasiswa) {
            $beasiswa->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
