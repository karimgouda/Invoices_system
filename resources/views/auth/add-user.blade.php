@extends('layouts.master')
@section('css')
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
<style>
					
	.demo{
		width: 50% !important;
		margin: auto !important;
		padding: 2rem 1rem !important;
		background-color: #fff !important;
		border-radius: 10px !important;
		text-align: center !important;
		box-shadow: 8px 8px 8px #faea10 !important;
	}
	h1{
		font-size: 2rem;
		color: #07001f;
		margin-bottom: 1.2rem;
		font-family:Georgia, 'Times New Roman', Times, serif ;
		font-style: italic;
	}
	form input , textarea{
		display: block !important;
		margin: auto !important;
		width: 92% !important;
		outline: none !important;
		border: 1px solid #fff !important;
		padding: 12px 20px !important;
		margin-bottom: 10px !important;
		border-radius: 20px !important;
		background-color: #e4e4e4 !important;
	}
	button{
		font-size: 1rem;
		margin-top: 1.8rem;
		padding: 10px 0;
		outline: none;
		border: none;
		width: 70%;
		background-color: rgb(17, 107, 143);
		color: #fff;
		border-radius: 20px
	}

</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">اضافه</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ مستخدم</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@if (session()->has('add'))
<script>
	window.onload = function(){
		notif({
			msg:"تم اضافه المستخدم بنجاح بنجاح",
			type:"success"
		})
	}
</script>
@endif
				<div class="container-fluid">
			  
				  <div class=" demo ">
					  <h1>اضافه مستخدم</h1>
					  <form action="{{url("new-user")}}"  method="POST" >
						  @csrf
						  <label for="title">الاسم</label>
						  <input type="text" name="name" class=" form-control " id="title">
						  @error('name')
							<p class=" text-danger">{{$message }}</p>  
						  @enderror
						  <label for="title">البريد الالكترةني</label>
						  <input type="email" name="email" class=" form-control " id="title">
						  @error('email')
							<p class=" text-danger">{{$message }}</p>  
						  @enderror
			  
					  <label for="title">كلمه المرور</label>
					  <input type="password" name="password" class=" form-control " id="title">
					  @error('password')
					  <p class=" text-danger">{{$message }}</p>  
					@enderror
					  <label for="role"> اكتب نوع المستخدم</label>
					  <input type="text" name="role" id="role" class=" form-control w-75 m-auto ">
					  @error('role')
					  <p class=" text-danger">{{$message }}</p>  
					@enderror
				
			  
						  <button type="submit" class=" mt-3">تسجيل</button>
					  </form>
				  </div>
				
				</div>

@endsection
@section('js')
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection