<?php

namespace App\Http\Livewire\Admin;

use App\Models\PaidAmount;
use App\Models\Sell;
use App\Models\Setup;
use App\Models\User;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Mpdf\Mpdf;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
class CustomerPaymentComponent extends Component
{
    public $startDate, $endDate;
    use WithPagination;
    use LivewireAlert;

    public $amount, $customer, $orderBy='id', $serialize='desc', $paginate=10, $search='', $customerId, $selectall = false, $selections = [];
    protected $listeners = ['deleteConfirmed' => 'delete'];

    protected $paginationTheme = 'bootstrap';

    public function Save()
    {
        $this->validate([
            'amount' => ['required', 'numeric'],
        ]);
        if ($this->amount>$this->customer->due_amount) {
            $this->alert('error', 'You can not receive more than due amount!');
        }else{
            $this->customer->paidAmount()->create(['amount'=>$this->amount]);
            $this->customer->due_amount -= $this->amount;

            $sells = Sell::whereUser_id($this->customer->id)->whereStatus('active')->where('price_status','!=','fullpaid')->orderBy('id', 'asc')->get();
            foreach ($sells as $sell){
                if ($this->amount>0) {
                    $data = $sell->due_price;
                    if ($this->amount<=$data) {
                        $sell->due_price -= $this->amount;
                        $sell->paid_price += $this->amount;
                    }else{
                        $sell->due_price -= $data;
                        $sell->paid_price +=  $data;
                    }
                    if ($this->amount>=$data) {
                        $sell->price_status = 'fullpaid';
                    }else{
                        $sell->price_status = 'subpaid';
                    }
                    $sell->save();
                    $this->amount -= $data;
                }
            }

            $this->customer->save();
            $this->reset('amount');
            $this->alert('success', 'Successfully inserted');
        }

    }
    public function FilterSerialize($filtername)
    {
        $this->orderBy = $filtername;
        if ($this->serialize==='desc'){
            $this->serialize = 'asc';
        }else{
            $this->serialize = 'desc';
        }
    }
    public function mount($id)
    {
        $this->customer = User::find($id);
    }
    public function generate_pdf()
    {
        return response()->streamDownload(function () {
            $customer = $this->customer;
            $setup = Setup::first();
            $sells = Sell::when($this->startDate, function($query) {
                return $query->whereDate('created_at', '>=', Carbon::parse($this->startDate)->format('Y-m-d'));
            })->when($this->endDate, function($query) {
                return $query->whereDate('created_at', '<=', Carbon::parse($this->endDate)->format('Y-m-d'));
            })->whereUser_id($this->customer->id)->whereStatus('active')->orderBy('id', 'desc')->paginate($this->paginate);
            $data['total'] = $this->customer->sells()->whereStatus('active')->sum('total_price');
            $data['paid'] = $this->customer->sells()->whereStatus('active')->sum('paid_price');
            $data['due']= $this->customer->sells()->whereStatus('active')->sum('due_price');
            $data['paidAmount'] = $this->customer->paidAmount()->whereStatus('active')->sum('amount');
            $payments = $this->customer->paidAmount()->whereStatus('active')->orderBy('id', 'desc')->paginate($this->paginate);
            if ( $data['paid']!=0) {
                $data['progressBar'] = 100*$data['paid']/$data['total'];
            }

            $pdf = PDF::loadView('pdf.customerInvoices', compact('sells', 'data', 'payments', 'setup', 'customer'));
            return $pdf->stream('document.pdf');
        }, ''.$this->customer->name.'.pdf');

    }
    public function render()
    {
        $customer = $this->customer;
        $sells = Sell::when($this->startDate, function($query) {
            return $query->whereDate('created_at', '>=', Carbon::parse($this->startDate)->format('Y-m-d'));
        })->when($this->endDate, function($query) {
            return $query->whereDate('created_at', '<=', Carbon::parse($this->endDate)->format('Y-m-d'));
        })->whereUser_id($this->customer->id)->whereStatus('active')->orderBy('id', 'desc')->paginate($this->paginate);
        $data['total'] = $this->customer->sells()->whereStatus('active')->sum('total_price');
        $data['paid'] = $this->customer->sells()->whereStatus('active')->sum('paid_price');
        $data['due']= $this->customer->sells()->whereStatus('active')->sum('due_price');
        $data['paidAmount'] = $this->customer->paidAmount()->whereStatus('active')->sum('amount');
        $payments = $this->customer->paidAmount()->when($this->startDate, function($query) {
            return $query->whereDate('created_at', '>=', Carbon::parse($this->startDate)->format('Y-m-d'));
        })->when($this->endDate, function($query) {
            return $query->whereDate('created_at', '<=', Carbon::parse($this->endDate)->format('Y-m-d'));
        })->whereStatus('active')->orderBy('id', 'desc')->paginate($this->paginate);
        if ( $data['paid']!=0) {
             $data['progressBar'] = 100*$data['paid']/$data['total'];
        }
//        dd($data['progressBar']);
        return view('livewire.admin.customer-payment-component', compact('sells', 'data', 'payments', 'customer'));
    }
}
