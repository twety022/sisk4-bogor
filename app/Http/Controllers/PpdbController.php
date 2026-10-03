<?php

namespace App\Http\Controllers;

use App\Models\PpdbInfo;
use App\Models\PpdbPathway;
use App\Models\PpdbSchedule;

class PpdbController extends Controller
{
    public function index()
    {
        $info = PpdbInfo::first() ?? new PpdbInfo([
            'academic_year' => '-',
            'intro_content' => 'Informasi PPDB belum diisi.',
            'requirements'  => [],
        ]);

        return view('ppdb.index', [
            'info'      => $info,
            'schedules' => PpdbSchedule::active()->get(),
            'pathways'  => PpdbPathway::active()->get(),
        ]);
    }
}
