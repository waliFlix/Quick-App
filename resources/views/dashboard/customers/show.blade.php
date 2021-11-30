@extends('layouts.dashboard.app', [
	'modals' => ['transfer', 'customer', 'chequeInput'],
	'datatable' => true,
])

@section('title')
    العميل: {{ $customer->name }}
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['العملاء','عرض'])
        @slot('url', [route('customers.index'), '#'])
        @slot('icon', ['users', 'eye'])
    @endcomponent
        <div class="box">
            <div class="box-header">
                <table class="table table-borderd">
                    <tr>
                        <th>الاسم</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th>الهاتف</th>
                        <td>{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <th>الرصيد</th>
                        <td>{{ number_format(abs($customer->balance())) }} <strong class="badge badge-{{ $customer->balanceClass() }}">{{ $customer->balanceType() }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <th>الايميل</th>
                        <td>{{ $customer->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>رقم الهاتف الاضافي</th>
                        <td>{{ $customer->secendPhone }}
                        </td>
                    </tr>


                    <tr>
                        <th>الخيارات</th>
                        <td>
                            <a class="btn btn-primary btn-xs" href="{{ route('customers.statement', $customer) }}"><i class="fa fa-list"></i> كشف حساب </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>



@endsection
@push('js')
    <script>
        $(function(){
            $('form').on('submit', (e) => {
                $(e.target).append($('input#active-tab'))
            })
            $('.nav.nav-tabs > li > a').click(function(){
            //     let tab = $(this).attr('href') + "";
            //     $('input#active-tab').val(tab.substring(5, tab.length))
            // })
            // $('input[name=from_date], input[name=to_date]').change(function(){
            //     $('input[name=using_dates]').prop('checked', true)
            // })
        })
    </script>
@endpush
