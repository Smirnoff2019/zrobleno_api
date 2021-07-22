<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tender\Tender;
use App\Services\PDFFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PdfController extends Controller
{

    public function makePdfProjectTR (Request $request, Tender $tender) {
        return PDFFactory::create(route('tenders.document', $tender));
    }

    public function makeProjectTR (Request $request, Tender $tender) {
        return view('admin.pdf', [
            'record' => $tender,
        ]);
    }

    public function showProjectTR (Request $request, Tender $tender) {
        return view('admin.pdf-show', [
            'record' => $tender,
        ]);
    }
    
}
