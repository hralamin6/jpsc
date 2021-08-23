<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class CustomController extends Controller
{
    public function generate_pdf()
    {
//        return response()->streamDownload(function () {
        $mpdf = new Mpdf(['default_font_size'=>'12', 'default_font'=>'nikosh']);

        $sells = Sell::whereUser_id($this->customer->id)->whereStatus('active')->orderBy('id', 'desc')->paginate($this->paginate);
        $data['total'] = $this->customer->sell()->whereStatus('active')->sum('total_price');
        $data['paid'] = $this->customer->sell()->whereStatus('active')->sum('paid_price');
        $data['due']= $this->customer->sell()->whereStatus('active')->sum('due_price');
        $data['paidAmount'] = $this->customer->paidAmount()->whereStatus('active')->sum('amount');
        $payments = $this->customer->paidAmount()->whereStatus('active')->orderBy('id', 'desc')->paginate($this->paginate);
        if ( $data['paid']!=0) {
            $data['progressBar'] = 100*$data['paid']/$data['total'];
        }

        $pdf = PDF::loadView('pdf.customerInvoices', compact('sells', 'data', 'payments'));
//            return $pdf->stream('document.pdf');
        return view('pdf.customerInvoices');
//        }, ''.$this->customer->name.'.pdf');

    }

}
