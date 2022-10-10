@extends('layouts.master')
@section('title', 'জমির ভবিষ্যত ব্যবহারা')
@section('content')
    <p class="m-0 text-black-50">জমির ভবিষ্যত ব্যবহারা</p>
    <hr>
    <!-- Top Statistics -->
    <div class="card card-default">
        <div class="card-header card-header-border-bottom p-3">
            <div class="col-md-6">
                জমির ভবিষ্যত ব্যবহার
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('LandUseFuture/Create') }}" class="btn btn-primary btn-sm"><i class="mdi mdi-plus-circle-outline mr-1"></i>জমির ভবিষ্যত ব্যবহার যোগ করুন</a>
            </div>
        </div>
        <div class="card-body p-2">
            @include('includes.message')
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ক্র নং</th>
                            <th class="text-center">জমির ভবিষ্যত ব্যবহার</th>
                            <th class="text-right">মূল্য (টাকাই)</th>
                            <th class="text-center">অবস্থা</th>
                            <th class="text-center">কার্যক্রম</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php( $initialNumber = (($model->currentPage() -1) * $model->perPage())+1)
                    @foreach($model as $row)
                           <tr>
                               <td class="text-center" style="width: 10%;">{{ \App\Http\Helpers\Helper::ConvertToBangla($initialNumber++) }}</td>
                               <td>{{ $row->flut_name }}</td>
                               <td class="text-right">{{ \App\Http\Helpers\Helper::ConvertToBangla($row->cost) }}</td>
                               <td class="text-center">
                                   @if($row->status === 1)
                                       <a href="{{ route('LandUseFuture/Disable',['id'=>$row->id]) }}" style="font-size: 25px;"><span class="text-success"><i class="mdi mdi-toggle-switch-outline"></i></span></a>
                                   @else
                                       <a href="{{ route('LandUseFuture/Enable',['id'=>$row->id]) }}" style="font-size: 25px;"><span class="text-danger"><i class="mdi mdi-toggle-switch-off-outline"></i></span></a>
                                   @endif
                               </td>
                               <td class="text-right" style="width: 15%;">

                                   <form action="{{ route('LandUseFuture/Delete', ['id'=>$row->id]) }}" method="post" id="confirm-form-alert-{{ $row->id }}">
                                       @csrf
                                       <a href="{{ route('LandUseFuture/Edit',['id'=>$row->id]) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="সম্পাদন করুন"><i class="mdi mdi-square-edit-outline mr-1"></i></a>
                                       @method('delete')
                                       <button type="submit" class="btn btn-danger btn-sm" onclick="return ConfirmForm('confirm-form-alert-{{ $row->id }}');" data-toggle="tooltip" data-placement="top" title="মুছে ফেলুন"><i class="mdi mdi-delete mr-1"></i> </button>
                                   </form>
                               </td>
                           </tr>
                       @endforeach
                    </tbody>
                </table>
                <nav class="float-right" aria-label="Page navigation example">
                    {{ $model -> links() }}
                </nav>
            </div>
        </div>
    </div>
@endsection
