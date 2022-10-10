@extends('layouts.master')
@section('title', 'চিঠি সমূহ')
@section('content')
    <p class="m-0 text-black-50">চিঠি সমূহ</p>
    <hr>
    <!-- Top Statistics -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            চিঠি সমূহ
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('failed') }}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-up"></i> অনিস্পত্তি আবেদন সমূহ</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('includes.message')
                    <div class="table-responsive" style="min-height: 150px; padding-top: 10px; width: 100%; overflow-y: auto">
                        @if(count($letter_issues) > 0)
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <td class="text-center">ক্র নং</td>
                                    <td class="text-center">চিঠির ধরণ</td>
                                    <td class="text-center">বিষয়</td>
                                    <td class="text-center">প্রেরণের তথ্য</td>
                                    <td class="text-center">শেষ তারিখ</td>
                                    <td class="text-right">কার্যক্রম</td>
                                </tr>
                                </thead>
                                <tbody>
                                @php($sl = 1)
                                @foreach($letter_issues as $letter)
                                    <tr>
                                        <td class="text-center">{{ \App\Http\Helpers\Helper::ConvertToBangla($sl++) }}</td>
                                        <td>{{ $letter->letterType->name }}</td>
                                        <td>{{ $letter->subject }}</td>
                                        <td>
                                            @if($letter->is_issued == 1)
                                                <small>প্রেরণ হয়েছে</small>
                                                <br>
                                                <small>প্রেরণের তারিখঃ {{ \App\Http\Helpers\Helper::ConvertToBangla(date('d/m/Y', strtotime($letter->issue_date))) }} </small>
                                                <br>
                                                <small>{{ $letter->is_read == 1 ? 'আবেদনকারী দেখেছে' : 'আবেদনকারী দেখেনি' }}</small>
                                                <br>
                                                <small>{{ $letter->is_solved == 1 ? 'সমাধান হয়েছে' : 'সমাধান হয়নি' }}</small>
                                            @else
                                                <span>প্রেরণ হয়নি</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($letter->expired_date < date('Y-m-d'))
                                                <span class="text-danger">{{ \App\Http\Helpers\Helper::ConvertToBangla(date('d/m/Y', strtotime($letter->expired_date))) }}</span>
                                            @else
                                                <span class="text-success">{{ \App\Http\Helpers\Helper::ConvertToBangla(date('d/m/Y', strtotime($letter->expired_date))) }}</span>
                                            @endif
                                        </td>
                                        <td class="text-right" style="width: 15%">
                                            <button class="btn btn-sm btn-info" onclick="return ShowInPopUp('{{ route("letter/show", ["id" => encrypt($letter->id), "app_id" => encrypt($id)]) }}', 'চিঠির বিস্তারিত')" data-toggle="tooltip" data-placement="top" title="বিস্তারিত"><i class="fas fa-desktop"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <h4 class="text-center text-secondary">এই আবেদন এর কোন চিঠি নাই</h4>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        ShowInPopUp = (url, title) => {
            $.ajax({
                type: "GET",
                url: url,
                success: function (res) {
                    $('#common-modal .modal-title').html(title);
                    $('#common-modal .modal-body').html(res);
                    $('#common-modal').modal("show");
                }
            });
        }
    </script>
@endsection
