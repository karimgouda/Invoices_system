<?php

namespace App\Http\Controllers;

use App\Models\Invoice_attachments;
use App\Models\invoices;
use App\Models\Invoices_detalis;
use App\Models\section;
use App\Models\User;
use App\Notifications\InvoicePaid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::all();
        $role = Auth::user()->role;
        return view('invoices.invioces',['invoices'=>$invoices,'role'=>$role]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $sections = section::all();
            return view('invoices.add',['sections'=>$sections]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        invoices::create([
            'invoice_number'=>$request->invoice_number,
            'invoice_Date'=>$request->invoice_Date,
            'due_date'=>$request->Due_date,
            'product'=>$request->product,
            'section_id'=>$request->Section,
            'Amount_collection'=>$request->Amount_collection,
            'Amount_commission'=>$request->Amount_Commission,
            'discount'=>$request->Discount,
            'rate_vat'=>$request->Rate_VAT,
            'value_vat'=>$request->Value_VAT,
            'total'=>$request->Total,
            'status'=>'غير مدفوعه',
            'value_status'=>2,  
            'note'=>$request->note,
        ]);


        $invoice_id = invoices::latest()->first()->id;
            Invoices_detalis::create([
                'id_Invoice' =>$invoice_id,
                'invoice_number'=>$request->invoice_number,
                'product'=>$request->product,
                'section'=>$request->Section,
                'status'=>'غير مدفوعه',
                'value_status'=>2,
                'note'=>$request->note,
                'user'=>(Auth::user()->name)
            ]);



            if($request->has('pic')){
                $request->validate([
                    'pic'=>'required|mimes:pdf|max:20000'
                ],[
                    'pic.required'=>'يرجي اخال المرفق',
                    'pic.mimes:pdf'=>'pdf خطأ تم حفظ الفاتوره ولم يتم حفظ المرفق لابد ان يكون '
                ]);

                 $invoice_id = invoices::latest()->first()->id;
                 $image = $request->file('pic');
                 $file_name = $image->getClientOriginalName();
                 $invoice_number = $request->invoice_number;

                 $attachments = new Invoice_attachments();
                 $attachments->file_name = $file_name;
                 $attachments->invoice_number = $invoice_number;
                 $attachments->created_by = Auth::user()->name;
                $attachments->invoice_id = $invoice_id;
                $attachments->save();

                $imageName = $request->pic->getClientOriginalName();
                $request->pic->move(public_path('Attachments/'.$invoice_number),$imageName);

            }
            // $user = User::get();
            // Notification::send($user, new InvoicePaid($invoice_id));            
            session()->flash('add','تم اضافه الفاتوره بنجاح');
            return redirect('invoices');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices,$id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.status_update',['invoices'=>$invoices]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = invoices::where('id',$id)->first();
        $sections = section::all();
        return view('invoices.edit_invoices',['invoices'=>$invoices,'sections'=>$sections]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $invoices = invoices::findOrFail($request->invoice_id);

        $invoices->update([
            'invoice_number'=>$request->invoice_number,
            'invoice_Date'=>$request->invoice_Date,
            'due_date'=>$request->Due_date,
            'product'=>$request->product,
            'section_id'=>$request->Section,
            'Amount_collection'=>$request->Amount_collection,
            'Amount_commission'=>$request->Amount_Commission,
            'discount'=>$request->Discount,
            'rate_vat'=>$request->Rate_VAT,
            'value_vat'=>$request->Value_VAT,
            'total'=>$request->Total,
            'status'=>'غير مدفوعه',
            'value_status'=>2,
            'note'=>$request->note,
        ]);
        session()->flash('edit');
        return redirect('invoices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $id = $request->invoice_id;
      $invoices = invoices::where('id',$id)->first();
      $detalis = Invoice_attachments::where('invoice_id',$id)->first();
  
          if(!empty($detalis->invoice_number)){
            Storage::disk('public_uploads')->deleteDirectory($detalis->invoice_number);
          }

          $invoices->forceDelete();
          session()->flash('delete');
          return back();

     
    }

    public function getProducts($id){
        
        $product = DB::table("products")->where("section_id",$id)->pluck("product_name","id");
        return json_encode($product);
    }

    public function Status_Update(Request $request , $id){
        $invoices = invoices::findOrFail($id);
        
        if($request->Status === 'مدفوعه'){
            $invoices->update([
                'value_status' =>1,
                'status' => $request->Status,
                'payment_date'=>$request->Payment_Date
            ]);

            Invoices_detalis::create([
                'id_Invoice'=> $request->invoice_id,
                'invoice_number'=> $request->invoice_number,
                'product'=> $request->product,
                'section'=> $request->Section,
                'status'=> $request->Status,
                'value_status'=> 1,
                'note'=> $request->note,
                'payment_date'=> $request->Payment_Date,
                'user'=> (Auth::user()->name),
            ]);
        }else{
            
            $invoices->update([
                'value_status' => 3,
                'status' => $request->Status,
                'payment_date'=>$request->Payment_Date
            ]);

            Invoices_detalis::create([
                    'id_Invoice'=> $request->invoice_id,
                    'invoice_number'=> $request->invoice_number,
                'product'=> $request->product,
                'section'=> $request->Section,
                'status'=> $request->Status,
                'value_status'=>3,
                'note'=> $request->note,
                'payment_date'=> $request->Payment_Date,
                'user'=> (Auth::user()->name),
            ]);

        }
        session()->flash('Status_Update');
        return redirect('/invoices');
    }


    public function Invoice_Paid(){
        $invoices = invoices::where('value_status',3)->get();
        return view('invoices.invoices_Paid',['invoices'=>$invoices]);
    }
    public function Invoice_unPaid(){
        $invoices = invoices::where('value_status',2)->get();
        return view('invoices.invoices_unPaid',['invoices'=>$invoices]);
    }
  
    public function Print_invoice($id){
        $invoices = invoices::where('id',$id)->first();
        return view('invoices.Print_invoice',['invoices'=>$invoices]);
    }
   

}
