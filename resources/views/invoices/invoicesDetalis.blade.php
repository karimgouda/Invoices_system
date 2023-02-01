@extends('layouts.master')
@section('title')
	تفاصيل الفاتوره
@endsection
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
	
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row py-5">
					@if (session()->has('delete'))

					<div class=" w-50 m-auto alert alert-success alert-dismissable fade show " role="alert">
						<strong>{{ session()->get('delete') }}</strong>
						<button type="button" class=" close" data-dismiss="alert" aria-label="close" >
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
				@endif
					<div class="panel panel-primary tabs-style-3 m-auto">
						<div class="tab-menu-heading">
							<div class="tabs-menu ">
								<!-- Tabs -->
								<ul class="nav panel-tabs">
									<li class=""><a href="#tab11" class="active" data-toggle="tab"><i class=""></i> رقم الفاتوره</a></li>
									<li><a href="#tab12" data-toggle="tab"><i class=""></i> تاريخ الاصدار</a></li>
									<li><a href="#tab13" data-toggle="tab"><i class=""></i> تاريخ الاستحقاق</a></li>
									<li><a href="#tab14" data-toggle="tab"><i class=""></i> القسم </a></li>
									<li><a href="#tab15" data-toggle="tab"><i class=""></i> المنتج </a></li>
									<li><a href="#tab16" data-toggle="tab"><i class=""></i> مبلغ التحصيل </a></li>
									<li><a href="#tab17" data-toggle="tab"><i class=""></i> مبلغ العموله </a></li>
									<li><a href="#tab18" data-toggle="tab"><i class=""></i>  الخصم </a></li>
									<li><a href="#tab19" data-toggle="tab"><i class=""></i>  نسبه الضريبه </a></li>
									<li><a href="#tab20" data-toggle="tab"><i class=""></i>  قيمه  الضريبه </a></li>
									<li><a href="#tab21" data-toggle="tab"><i class=""></i>  الاجمالي مع الضريبه </a></li>
									<li><a href="#tab22" data-toggle="tab"><i class=""></i>   الحاله الحاليه  </a></li>
								</ul>
							</div>
						</div>
						<div class="panel-body tabs-menu-body">
							<div class="tab-content">
								
								<div class="tab-pane active" id="tab11">
									<h1 class="text-center bg-warning text-white">{{ $invoices->invoice_number }}</h1>
								</div>
								<div class="tab-pane" id="tab12">
									<h1 class=" text-center bg-warning text-white">{{ $invoices->invoice_Date }}</h1>
								</div>
								<div class="tab-pane" id="tab13">
									<h1 class=" text-center bg-warning text-white">{{ $invoices->due_date }}</h1>
								</div>
								<div class="tab-pane" id="tab14">
									<h1 class=" text-center bg-warning text-white">{{ $invoices->Section->section_name }}</h1>
								</div>
								<div class="tab-pane" id="tab15">
									<h1 class=" text-center bg-warning text-white">{{  $invoices->product  }}</h1>
								</div>
								<div class="tab-pane" id="tab16">
									<h1 class=" text-center bg-warning text-white">{{ $invoices->Amount_collection  }}</h1>
								</div>
								<div class="tab-pane" id="tab17">
									<h1 class=" text-center bg-warning text-white">{{ $invoices->Amount_commission  }}</h1>
								</div>
								<div class="tab-pane" id="tab18">
									<h1 class=" text-center bg-warning text-white">{{ $invoices->discount}}</h1>
								</div>
								<div class="tab-pane" id="tab19">
									<h1 class=" text-center bg-warning text-white">{{ $invoices->rate_vat}}</h1>
								</div>
								<div class="tab-pane" id="tab20">
									<h1 class=" text-center bg-warning text-white">{{ $invoices->value_vat}}</h1>
								</div>
								<div class="tab-pane" id="tab21">
									<h1 class=" text-center bg-warning text-white">{{ $invoices->total}}</h1>
								</div>
								<div class="tab-pane" id="tab22">
									@if ($invoices->value_status == 1)
									<h1 class="badge text-center badge-pill badge-success">{{ $invoices->status }}</h1>
									@elseif($invoices->value_status == 2)
									<h1 class="badge text-center badge-pill badge-danger">{{ $invoices->status }}</h1>
									@else
									<h1 class="badge text-center badge-pill badge-warning">{{ $invoices->status }}</h1>
									@endif
								</div>
								
								
							</div>
						</div>
					</div>
					
					<div class="col-xl-12 my-5">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Bordered Table</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">Example of Valex Bordered Table.. <a href="">Learn more</a></p>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">رقم الفاتوره</th>
												<th class="border-bottom-0">نوع المنتج</th>
												<th class="border-bottom-0">القسم</th>
												<th class="border-bottom-0">حاله الدفع</th>
												<th class="border-bottom-0">تاريخ الدفع</th>
												<th class="border-bottom-0">ملاحظات</th>
												<th class="border-bottom-0">اسم المستخدم</th>
												<th class="border-bottom-0">تاريخ الاضافه</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($details as $x )
											<tr>
												<td>{{$x->invoice_number}}</td>
												<td>{{$x->product}}</td>
												<td>{{$invoices->section->section_name}}</td>
												@if ($x->value_status == 1)
												<td><span
														class="badge badge-pill badge-success">{{ $x->status }}</span>
												</td>
											@elseif($x->value_status ==2)
												<td><span
														class="badge badge-pill badge-danger">{{ $x->status }}</span>
												</td>
											@else
												<td><span
														class="badge badge-pill badge-warning">{{ $x->status }}</span>
												</td>
											@endif
												<td>{{$invoices->payment_date}}</td>
												<td>{{$x->note}}</td>
												<td>{{$x->user}}</td>
												<td>{{$x->created_at}}</td>
											</tr>
											@endforeach
									
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					
					<div class="col-xl-12">
						
						<div class="card">
					
							<div class="card-body">
								@if (session()->has('add'))
								<div class="  w-50 m-auto  alert alert-success alert-dismissible fade show" role="alert">
									<strong>{{ session()->get('add') }}</strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							@endif
							@foreach ($errors->all() as $error)
							<div class=" w-50 m-auto alert alert-danger alert-dismissable fade show" role="alert">
								<strong>{{ $error }}</strong>
								<button type="button" class=" close" data-dismiss="alert" aria-label="close" >
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						@endforeach
								<p class="text-danger">* صيغة المرفق pdf </p>
								<h5 class="card-title">اضافة مرفقات</h5>
								<form method="post" action="{{ url('InvoiceAttachments') }}"
									enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFile"
											name="file_name" required>
										<input type="hidden" id="customFile" name="invoice_number"
											value="{{ $invoices->invoice_number }}">
										<input type="hidden" id="invoice_id" name="invoice_id"
											value="{{ $invoices->id }}">
										<label class="custom-file-label" for="customFile">حدد
											المرفق</label>
									</div><br><br>
									<button type="submit" class="btn btn-primary btn-sm "
										name="uploadedFile">تاكيد</button>
								</form>
							</div>
								<div class="d-flex justify-content-between">
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">الصفوف</th>
												<th class="wd-15p border-bottom-0">رقم الفاتوره</th>
												<th class="wd-20p border-bottom-0">اسم الملف</th>
												<th class="wd-15p border-bottom-0">اسم العميل</th>
												<th class="wd-10p border-bottom-0">تاريخ الاضافه</th>
												<th class="wd-10p border-bottom-0"> العمليات</th>
												
												
											</tr>
										</thead>
										<tbody>
											@foreach ($attachments as $y )
											<tr>
												<td>{{$loop->iteration}}</td>
												<td>{{$y->invoice_number}}</td>
												<td>{{$y->file_name}}</td>
												<td>{{$y->created_by}}</td>
												<td>{{$y->created_at}}</td>
												<td style="position: relative">

													<a class="btn btn-outline-info btn-sm"
													href="{{ url('download') }}/{{ $invoices->invoice_number }}/{{ $y->file_name }}"
													role="button"><i
														class="fas fa-download"></i>&nbsp;
													تحميل</a>

													
														<button class="btn btn-outline-danger btn-sm mt-3 " style="position: absolute; bottom: 21%; left: 30%"
															data-toggle="modal"
															data-file_name="{{ $y->file_name }}"
															data-invoice_number="{{ $y->invoice_number }}"
															data-id_file="{{ $y->id }}"
															data-target="#delete_file">حذف
														</button>
													
												</td>
											</tr>

											@endforeach
										
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
				aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						@foreach ($attachments as $x )
						<form action="{{ url("/$x->id") }}" method="post">
						@endforeach	
							@method('DELETE')
							{{ csrf_field() }}
							<div class="modal-body">
								<p class="text-center">
								<h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
								</p>
		
								<input type="hidden" name="id_file" id="id_file" value="">
								<input type="hidden" name="file_name" id="file_name" value="">
								<input type="hidden" name="invoice_number" id="invoice_number" value="">
		
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
								<button type="submit" class="btn btn-danger">تاكيد</button>
							</div>
						</form>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
	$('#delete_file').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id_file = button.data('id_file')
		var file_name = button.data('file_name')
		var invoice_number = button.data('invoice_number')
		var modal = $(this)
		modal.find('.modal-body #id_file').val(id_file);
		modal.find('.modal-body #file_name').val(file_name);
		modal.find('.modal-body #invoice_number').val(invoice_number);
	})
</script>

<script>
	// Add the following code if you want the name of the file appear on select
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>
@endsection